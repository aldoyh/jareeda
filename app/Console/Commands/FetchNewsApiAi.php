<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchNewsApiAi extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:fetch-newsapi
                            {--days=7 : Number of days to look back}
                            {--limit=100 : Maximum articles to fetch}
                            {--language=en,ar : Comma-separated languages}
                            {--force : Ignore cache and fetch fresh}';

    /**
     * The console command description.
     */
    protected $description = 'Fetch Bahrain news from NewsAPI.ai with caching to preserve API tokens';

    /**
     * Cache key prefix.
     */
    protected string $cachePrefix = 'newsapi_bahrain_';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $apiKey = config('services.newsapi.key');

        if (empty($apiKey)) {
            $this->error('NEWSAPI_KEY not set in .env');

            return self::FAILURE;
        }

        $days = (int) $this->option('days');
        $limit = (int) $this->option('limit');
        $languages = array_map('trim', explode(',', $this->option('language')));
        $force = $this->option('force');

        $cacheKey = $this->cachePrefix . md5(serialize([$days, $limit, $languages]));
        $cacheTTL = 12 * 3600; // 12 hours cache

        // Check cache first
        if (!$force && Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);
            $this->info("Using cached results (fetched {$cached['fetched_at']})");
            $this->info('Cached articles: ' . count($cached['articles']));

            return $this->processCachedArticles($cached['articles']);
        }

        $this->info('Fetching Bahrain news from NewsAPI.ai...');
        $this->info('Languages: ' . implode(', ', $languages));
        $this->info("Period: last {$days} days");
        $this->newLine();

        $allArticles = [];

        foreach ($languages as $lang) {
            $this->info("Fetching {$lang} articles...");

            try {
                $articles = $this->fetchFromNewsApi($apiKey, $lang, $days, $limit);
                $allArticles = array_merge($allArticles, $articles);
                $this->info('  Found: ' . count($articles) . ' articles');
            } catch (\Exception $e) {
                $this->error("  Error: {$e->getMessage()}");
            }
        }

        // Deduplicate by URL
        $allArticles = $this->deduplicateArticles($allArticles);

        // Cache the results
        Cache::put($cacheKey, [
            'articles' => $allArticles,
            'fetched_at' => now()->toDateTimeString(),
            'token_usage' => $this->estimateTokenUsage($allArticles),
        ], $cacheTTL);

        $this->newLine();
        $this->info('Total unique articles: ' . count($allArticles));
        $this->info('Estimated tokens used: ~' . $this->estimateTokenUsage($allArticles));
        $this->info('Results cached for 12 hours');

        return $this->processCachedArticles($allArticles);
    }

    /**
     * Fetch articles from NewsAPI.ai.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function fetchFromNewsApi(string $apiKey, string $language, int $days, int $limit): array
    {
        $startDate = now()->subDays($days)->format('Y-m-d');
        $endDate = now()->format('Y-m-d');

        // NewsAPI.ai uses Event Registry API
        $baseUrl = 'https://eventregistry.org/api/v1/article/getArticles';

        $payload = [
            'action' => 'getArticles',
            'keyword' => 'Bahrain',
            'sourceLanguage' => [$language],
            'dateStart' => $startDate,
            'dateEnd' => $endDate,
            'articlesPage' => 1,
            'articlesCount' => min($limit, 100),
            'articlesSortBy' => 'date',
            'articlesSortByAsc' => false,
            'dataType' => ['news'],
            'includeArticleImage' => true,
            'includeArticleBody' => true,
            'includeArticleCategories' => true,
            'includeArticleAuthors' => true,
            'apiKey' => $apiKey,
        ];

        $response = Http::timeout(60)
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->post($baseUrl, $payload);

        if (!$response->successful()) {
            throw new \RuntimeException("API error: HTTP {$response->status()} - {$response->body()}");
        }

        $data = $response->json();

        if (!isset($data['articles']['results'])) {
            throw new \RuntimeException('Unexpected API response structure');
        }

        $articles = [];

        foreach ($data['articles']['results'] as $item) {
            $articles[] = [
                'title' => $item['title'] ?? '',
                'body' => $item['body'] ?? '',
                'url' => $item['url'] ?? '',
                'image' => $item['image'] ?? null,
                'source' => $item['source']['title'] ?? $item['source']['uri'] ?? '',
                'author' => !empty($item['authors']) ? $item['authors'][0]['name'] ?? '' : '',
                'language' => $item['lang'] ?? $language,
                'published_at' => $item['dateTime'] ?? $item['date'] ?? '',
                'category' => !empty($item['categories']) ? $item['categories'][0]['label'] ?? '' : '',
                'sentiment' => $item['sentiment'] ?? null,
                'event_uri' => $item['eventUri'] ?? null,
            ];
        }

        return $articles;
    }

    /**
     * Process cached articles into database.
     */
    protected function processCachedArticles(array $articles): int
    {
        $totalFetched = 0;
        $totalSkipped = 0;

        foreach ($articles as $article) {
            if (empty($article['title']) || empty($article['url'])) {
                continue;
            }

            if ($this->articleExists($article['url'], $article['title'])) {
                $totalSkipped++;

                continue;
            }

            $this->storeArticle($article);
            $totalFetched++;

            if ($totalFetched % 10 === 0) {
                $this->line("  Processed {$totalFetched} articles...");
            }
        }

        $this->newLine();
        $this->info("Stored: {$totalFetched} articles, Skipped: {$totalSkipped} duplicates");

        return self::SUCCESS;
    }

    /**
     * Deduplicate articles by URL.
     *
     * @param array<int, array<string, mixed>> $articles
     * @return array<int, array<string, mixed>>
     */
    protected function deduplicateArticles(array $articles): array
    {
        $seen = [];
        $unique = [];

        foreach ($articles as $article) {
            $url = $article['url'] ?? '';
            if (!empty($url) && !isset($seen[$url])) {
                $seen[$url] = true;
                $unique[] = $article;
            }
        }

        return $unique;
    }

    /**
     * Estimate token usage for caching metrics.
     */
    protected function estimateTokenUsage(array $articles): int
    {
        $totalChars = 0;
        foreach ($articles as $article) {
            $totalChars += mb_strlen($article['title'] ?? '');
            $totalChars += mb_strlen($article['body'] ?? '');
        }

        // Rough estimate: 1 token ≈ 4 characters
        return (int) ceil($totalChars / 4);
    }

    /**
     * Check if article already exists.
     */
    protected function articleExists(string $url, string $title = ''): bool
    {
        if (!empty($url)) {
            return News::where('url', $url)->exists();
        }

        if (!empty($title)) {
            return News::where('title', $title)->exists();
        }

        return false;
    }

    /**
     * Store an article in the database.
     */
    protected function storeArticle(array $article): void
    {
        $slug = Str::slug($article['title']);

        $originalSlug = $slug;
        $counter = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $language = $this->detectLanguage($article['title'] . ' ' . ($article['body'] ?? ''));
        $excerpt = Str::limit(strip_tags($article['body'] ?? ''), 300);

        News::create([
            'slug' => $slug,
            'title' => ['en' => $article['title']],
            'body' => ['en' => $article['body'] ?? ''],
            'excerpt' => ['en' => $excerpt],
            'url' => $article['url'],
            'source' => $article['source'] ?? null,
            'author' => $article['author'] ?: null,
            'image' => $article['image'] ?? null,
            'image_alt' => $article['title'],
            'category' => $article['category'] ?? null,
            'language' => $language,
            'published_at' => !empty($article['published_at']) ? $article['published_at'] : now(),
        ]);
    }

    /**
     * Detect if text is primarily Arabic.
     */
    protected function detectLanguage(string $text): string
    {
        preg_match_all('/[\x{0600}-\x{06FF}]/u', $text, $arabic);
        $arabicCount = count($arabic[0]);

        preg_match_all('/[a-zA-Z]/', $text, $latin);
        $latinCount = count($latin[0]);

        $total = $arabicCount + $latinCount;
        if ($total > 0 && ($arabicCount / $total) > 0.3) {
            return 'ar';
        }

        return 'en';
    }
}
