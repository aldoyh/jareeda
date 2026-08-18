<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchNewsDataIo extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:fetch-newsdata
                            {--search=bahrain : Search term}
                            {--limit=100 : Maximum articles to fetch}
                            {--pages=10 : Maximum pages to fetch}
                            {--format=json : Output format (json/html/csv)}
                            {--no-cache : Skip cache and force fresh API calls}
                            {--force : Ignore cache and fetch fresh}';

    /**
     * The console command description.
     */
    protected $description = 'Fetch news from NewsData.io API with full pagination support';

    /**
     * NewsData.io API configuration.
     */
    protected string $apiKey = 'pub_f18d2e1fdf174573b89a8e698fbc873a';

    protected string $baseUrl = 'https://newsdata.io/api/1/latest';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $search = $this->option('search');
        $limit = (int) $this->option('limit');
        $maxPages = (int) $this->option('pages');
        $force = $this->option('force') || $this->option('no-cache');

        $this->info("🔍 Fetching news from NewsData.io for: '{$search}'");
        $this->info("   Max pages: {$maxPages}, Max articles: {$limit}");
        $this->newLine();

        // Check cache first
        $cacheKey = 'newsdata_' . md5($search . $limit . $maxPages);
        $cacheTTL = 3600; // 1 hour

        if (!$force && Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);
            $this->info("✓ Using cached results (fetched {$cached['fetched_at']})");
            $articles = $cached['articles'];
        } else {
            $articles = $this->fetchFromApi($search, $maxPages, $limit);

            // Cache the results
            Cache::put($cacheKey, [
                'articles' => $articles,
                'fetched_at' => now()->toDateTimeString(),
            ], $cacheTTL);

            $this->info('✓ Results cached for 1 hour');
        }

        $this->newLine();
        $this->info('Total articles fetched: ' . count($articles));

        // Store in database
        return $this->storeArticles($articles);
    }

    /**
     * Fetch articles from NewsData.io API with pagination.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function fetchFromApi(string $search, int $maxPages, int $limit): array
    {
        $allItems = [];
        $nextPage = null;
        $pageCount = 0;

        while ($pageCount < $maxPages && count($allItems) < $limit) {
            $pageCount++;

            $url = $this->baseUrl . '?' . http_build_query([
                'apikey' => $this->apiKey,
                'q' => $search,
                'country' => 'us',
                'language' => 'en,ar',
                'page' => $nextPage,
            ]);

            $this->line("📄 Fetching page {$pageCount}...");

            try {
                $response = Http::timeout(30)
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'User-Agent' => 'JareedaBot/1.0',
                    ])
                    ->get($url);

                if ($response->failed()) {
                    $this->error("   ❌ HTTP Error: {$response->status()}");
                    break;
                }

                $data = $response->json();

                if (isset($data['status']) && $data['status'] !== 'success') {
                    $this->error('   ❌ API Error: ' . ($data['message'] ?? 'Unknown'));
                    break;
                }

                if (isset($data['results']) && is_array($data['results'])) {
                    $addedCount = 0;
                    $blockedKeywords = ['[removed]', '404 not found', '403 forbidden', 'access denied', 'page not found'];

                    foreach ($data['results'] as $item) {
                        $title = mb_trim($item['title'] ?? '');
                        if (empty($title) || mb_strtolower($title) === 'no title') {
                            continue;
                        }

                        $isProblematic = false;
                        $textToCheck = mb_strtolower($title);
                        foreach ($blockedKeywords as $keyword) {
                            if (str_contains($textToCheck, $keyword)) {
                                $isProblematic = true;
                                break;
                            }
                        }

                        if ($isProblematic) {
                            continue;
                        }

                        $content = $item['content'] ?? '';
                        if (str_contains($content, 'ONLY AVAILABLE IN PAID PLANS')) {
                            $content = '';
                        }

                        $description = $item['description'] ?? '';
                        if (str_contains($description, 'ONLY AVAILABLE IN PAID PLANS')) {
                            $description = '';
                        }

                        $allItems[] = [
                            'title' => $title,
                            'description' => $description,
                            'content' => $content,
                            'link' => $item['link'] ?? '',
                            'image' => $item['image_url'] ?? null,
                            'source' => $item['source_id'] ?? 'Unknown',
                            'pubdate' => $item['pubDate'] ?? now()->toDateTimeString(),
                            'category' => $item['category'][0] ?? 'general',
                        ];
                        $addedCount++;
                    }

                    $this->line("   ✓ Added {$addedCount} valid items (total: " . count($allItems) . ')');
                } else {
                    $this->line('   ℹ️  No results in this page');
                }

                // Check for next page
                if (isset($data['nextPage'])) {
                    $nextPage = $data['nextPage'];
                    $this->line('   → Next page available, continuing...', 'comment');
                } else {
                    $this->line('   → No more pages available');
                    break;
                }

                // Rate limiting
                if ($pageCount < $maxPages) {
                    sleep(1);
                }
            } catch (\Exception $e) {
                $this->error("   ❌ Error: {$e->getMessage()}");
                break;
            }
        }

        $this->info("✅ Fetch complete: {$pageCount} pages, " . count($allItems) . ' total items');

        return $allItems;
    }

    /**
     * Store articles in the database.
     */
    protected function storeArticles(array $articles): int
    {
        $totalStored = 0;
        $totalSkipped = 0;

        foreach ($articles as $article) {
            if (empty($article['title']) || empty($article['link'])) {
                continue;
            }

            if ($this->articleExists($article['link'], $article['title'])) {
                $totalSkipped++;

                continue;
            }

            $this->storeArticle($article);
            $totalStored++;

            if ($totalStored % 10 === 0) {
                $this->line("  Processed {$totalStored} articles...");
            }
        }

        $this->newLine();
        $this->info("Stored: {$totalStored} articles, Skipped: {$totalSkipped} duplicates");

        return self::SUCCESS;
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

        $language = $this->detectLanguage($article['title'] . ' ' . ($article['content'] ?? $article['description'] ?? ''));
        $excerpt = Str::limit(strip_tags($article['description'] ?? $article['content'] ?? ''), 300);

        News::create([
            'slug' => $slug,
            'title' => ['en' => $article['title']],
            'body' => ['en' => $article['content'] ?: $article['description'] ?? ''],
            'excerpt' => ['en' => $excerpt],
            'url' => $article['link'],
            'source' => $article['source'] ?? null,
            'author' => null,
            'image' => $article['image'] ?? null,
            'image_alt' => $article['title'],
            'category' => $article['category'] ?? null,
            'language' => $language,
            'published_at' => !empty($article['pubdate']) ? $article['pubdate'] : now(),
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
