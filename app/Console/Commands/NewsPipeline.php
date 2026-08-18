<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use App\Services\UnslothImageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NewsPipeline extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:pipeline
                            {--days=7 : Number of days to look back}
                            {--limit=500 : Maximum articles per source}
                            {--images : Generate images for articles without them}
                            {--unsloth : Use Unsloth FLUX2 for image generation}
                            {--force : Ignore cache and fetch fresh}';

    /**
     * The console command description.
     */
    protected $description = 'Full news pipeline: fetch from all sources, deduplicate, and generate images';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Starting Jareeda News Pipeline');
        $this->info('================================');
        $this->newLine();

        $days = (int) $this->option('days');
        $limit = (int) $this->option('limit');
        $generateImages = $this->option('images');
        $useUnsloth = $this->option('unsloth');
        $force = $this->option('force');

        $initialCount = News::count();
        $this->info("Current articles: {$initialCount}");
        $this->newLine();

        // Step 1: Fetch from all sources
        $this->info('📰 Step 1: Fetching articles from all sources');
        $this->line('----------------------------------------------');

        $fetched = 0;

        // Source 1: RSS Feeds
        $this->line('Fetching from RSS feeds...');
        try {
            $rssCount = $this->fetchFromRss($days, $limit);
            $fetched += $rssCount;
            $this->info("  ✅ RSS: {$rssCount} new articles");
        } catch (\Exception $e) {
            $this->error("  ❌ RSS failed: {$e->getMessage()}");
        }

        // Source 2: NewsAPI.ai
        $this->line('Fetching from NewsAPI.ai...');
        try {
            $newsApiCount = $this->fetchFromNewsApi($days, $limit, $force);
            $fetched += $newsApiCount;
            $this->info("  ✅ NewsAPI.ai: {$newsApiCount} new articles");
        } catch (\Exception $e) {
            $this->error("  ❌ NewsAPI.ai failed: {$e->getMessage()}");
        }

        // Source 3: NewsData.io
        $this->line('Fetching from NewsData.io...');
        try {
            $newsDataCount = $this->fetchFromNewsData($days, $limit, $force);
            $fetched += $newsDataCount;
            $this->info("  ✅ NewsData.io: {$newsDataCount} new articles");
        } catch (\Exception $e) {
            $this->error("  ❌ NewsData.io failed: {$e->getMessage()}");
        }

        $this->newLine();
        $this->info("Total new articles fetched: {$fetched}");

        // Step 2: Deduplicate
        $this->newLine();
        $this->info('🔄 Step 2: Deduplicating articles');
        $this->line('----------------------------------------------');

        $deletedCount = $this->deduplicateArticles();
        $this->info("Duplicates removed: {$deletedCount}");

        // Step 3: Generate images
        if ($generateImages) {
            $this->newLine();
            $this->info('🎨 Step 3: Generating images for articles');
            $this->line('----------------------------------------------');

            $articlesWithoutImages = News::whereNull('image')
                ->orWhere('image', '')
                ->count();

            $this->info("Articles without images: {$articlesWithoutImages}");

            if ($articlesWithoutImages > 0) {
                if ($useUnsloth) {
                    $imageCount = $this->generateUnslothImages(min($articlesWithoutImages, 50));
                } else {
                    $imageCount = $this->generatePlaceholderImages(min($articlesWithoutImages, 50));
                }
                $this->info("Images generated: {$imageCount}");
            }
        }

        // Final stats
        $this->newLine();
        $this->info('📊 Pipeline Complete');
        $this->line('================================');

        $finalCount = News::count();
        $withImages = News::whereNotNull('image')->where('image', '!=', '')->count();
        $totalPages = (int) ceil($finalCount / 20);

        $this->info("Total articles: {$finalCount}");
        $this->info("With images: {$withImages}");
        $this->info("Total pages: {$totalPages}");
        $this->info('New articles added: ' . ($finalCount - $initialCount));

        $this->newLine();
        $this->info('Run `php artisan view:clear && php artisan cache:clear` to refresh the site');

        return self::SUCCESS;
    }

    /**
     * Fetch articles from RSS feeds.
     */
    protected function fetchFromRss(int $days, int $limit): int
    {
        $feeds = [
            'google-news-bahrain' => 'https://news.google.com/rss/search?q=Bahrain+when:7d&hl=en',
            'google-news-bahrain-ar' => 'https://news.google.com/rss/search?q=%D8%A8%D8%AD%D8%B1%D9%8A%D9%86+when:7d&hl=ar',
            'bbc-mideast' => 'https://feeds.bbci.co.uk/news/world/middle_east/rss.xml',
            'gulf-news-bahrain' => 'https://gulfnews.com/rss/bahrain',
            'khaleej-times-bahrain' => 'https://www.khaleejtimes.com/rss/bahrain',
            'bahrain-mirror' => 'https://bahrainmirror.com/rss.xml',
            'alayam' => 'https://feeds.feedburner.com/alayam',
            'aljazeera-bahrain' => 'https://www.aljazeera.com/xml/rss/all.xml',
        ];

        $count = 0;

        foreach ($feeds as $name => $url) {
            try {
                $response = Http::timeout(15)->get($url);

                if ($response->failed()) {
                    $this->line("  Skipping {$name}: HTTP {$response->status()}");

                    continue;
                }

                $xml = @simplexml_load_string($response->body());

                if (!$xml) {
                    $this->line("  Skipping {$name}: Invalid XML");

                    continue;
                }

                $items = $xml->channel->item ?? [];
                $limitPerFeed = (int) ceil($limit / count($feeds));

                foreach ($items as $item) {
                    if ($count >= $limit) {
                        break 2;
                    }

                    $title = mb_trim((string) ($item->title ?? ''));
                    $link = mb_trim((string) ($item->link ?? ''));
                    $description = mb_trim((string) ($item->description ?? ''));

                    if (empty($title) || empty($link)) {
                        continue;
                    }

                    // Check for duplicates by URL first, then by title
                    if ($this->articleExists($link, $title)) {
                        continue;
                    }

                    $lang = str_contains($name, '-ar') ? 'ar' : 'en';
                    $publishedAt = isset($item->pubDate) ? $this->parseRssDate((string) $item->pubDate) : now();

                    News::create([
                        'title' => $title,
                        'slug' => Str::slug($title),
                        'excerpt' => Str::limit(strip_tags($description), 300),
                        'body' => $description,
                        'url' => $link,
                        'source' => $name,
                        'locale' => $lang,
                        'status' => 'published',
                        'is_featured' => false,
                        'published_at' => $publishedAt,
                    ]);

                    $count++;

                    if ($count >= $limitPerFeed) {
                        break;
                    }
                }
            } catch (\Exception $e) {
                $this->line("  Skipping {$name}: {$e->getMessage()}");
            }
        }

        return $count;
    }

    /**
     * Fetch articles from NewsAPI.ai.
     */
    protected function fetchFromNewsApi(int $days, int $limit, bool $force): int
    {
        $apiKey = config('services.newsapi.key');

        if (empty($apiKey)) {
            $this->line('  NEWSAPI_KEY not configured');

            return 0;
        }

        $count = 0;
        $languages = ['en', 'ar'];

        foreach ($languages as $lang) {
            $cacheKey = "newsapi_bahrain_{$lang}_{$days}_{$limit}";
            $cacheTTL = 12 * 3600;

            if (!$force && Cache::has($cacheKey)) {
                $cached = Cache::get($cacheKey);
                $this->line("  Using cached results for {$lang}");

                foreach ($cached['articles'] as $article) {
                    if ($count >= $limit) {
                        break;
                    }

                    if ($this->articleExists($article['url'] ?? '', $article['title'])) {
                        continue;
                    }

                    News::create([
                        'title' => $article['title'],
                        'slug' => Str::slug($article['title']),
                        'excerpt' => Str::limit(strip_tags($article['description'] ?? ''), 300),
                        'body' => $article['description'] ?? '',
                        'url' => $article['url'] ?? '',
                        'image' => $article['image'] ?? null,
                        'source' => $article['source'] ?? 'newsapi',
                        'locale' => $lang,
                        'status' => 'published',
                        'is_featured' => false,
                        'published_at' => $article['published_at'] ?? now(),
                    ]);

                    $count++;
                }

                continue;
            }

            $startDate = now()->subDays($days)->format('Y-m-d');
            $endDate = now()->format('Y-m-d');

            $response = Http::withHeaders([
                'X-Api-Key' => $apiKey,
            ])->timeout(30)->get('https://newsapi.org/v2/everything', [
                'q' => 'Bahrain',
                'language' => $lang,
                'from' => $startDate,
                'to' => $endDate,
                'pageSize' => min($limit, 100),
                'sortBy' => 'publishedAt',
                'apiKey' => $apiKey,
            ]);

            if ($response->failed()) {
                $this->line("  NewsAPI.ai failed for {$lang}: HTTP {$response->status()}");

                continue;
            }

            $data = $response->json();
            $articles = $data['articles'] ?? [];

            $cacheData = [
                'articles' => $articles,
                'fetched_at' => now()->toDateTimeString(),
            ];
            Cache::put($cacheKey, $cacheData, $cacheTTL);

            foreach ($articles as $article) {
                if ($count >= $limit) {
                    break;
                }

                $title = $article['title'] ?? '';

                if (empty($title) || $this->articleExists($article['url'] ?? '', $title)) {
                    continue;
                }

                $body = '';
                if (isset($article['body'])) {
                    $body = $article['body'];
                } elseif (isset($article['text'])) {
                    $body = $article['text'];
                }

                $image = $article['image'] ?? $article['thumbnail'] ?? null;

                News::create([
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'excerpt' => Str::limit(strip_tags($article['description'] ?? $body), 300),
                    'body' => $body,
                    'url' => $article['url'] ?? '',
                    'image' => $image,
                    'source' => $article['source'] ?? 'newsapi',
                    'locale' => $lang,
                    'status' => 'published',
                    'is_featured' => false,
                    'published_at' => $article['published_at'] ?? now(),
                ]);

                $count++;
            }
        }

        return $count;
    }

    /**
     * Fetch articles from NewsData.io.
     */
    protected function fetchFromNewsData(int $days, int $limit, bool $force): int
    {
        $apiKey = env('NEWSDATA_API_KEY');

        if (empty($apiKey)) {
            $this->line('  NEWSDATA_API_KEY not configured');

            return 0;
        }

        $count = 0;
        $languages = ['en', 'ar'];

        foreach ($languages as $lang) {
            $page = 1;
            $fetchedForLang = 0;

            while ($fetchedForLang < $limit) {
                $response = Http::withHeaders([
                    'X-KEY' => $apiKey,
                ])->timeout(30)->get('https://newsdata.io/api/1/latest', [
                    'q' => 'Bahrain',
                    'language' => $lang,
                    'from' => now()->subDays($days)->format('Y-m-d'),
                    'page' => $page,
                ]);

                if ($response->failed()) {
                    $this->line("  NewsData.io failed for {$lang}: HTTP {$response->status()}");

                    break;
                }

                $data = $response->json();
                $articles = $data['results'] ?? [];

                if (empty($articles)) {
                    break;
                }

                foreach ($articles as $article) {
                    if ($fetchedForLang >= $limit) {
                        break 2;
                    }

                    $title = $article['title'] ?? '';

                    if (empty($title) || $this->articleExists($article['link'] ?? '', $title)) {
                        continue;
                    }

                    News::create([
                        'title' => $title,
                        'slug' => Str::slug($title),
                        'excerpt' => Str::limit(strip_tags($article['description'] ?? ''), 300),
                        'body' => $article['content'] ?? $article['description'] ?? '',
                        'url' => $article['link'] ?? '',
                        'image' => $article['image_url'] ?? null,
                        'source' => $article['source_name'] ?? 'newsdata',
                        'locale' => $lang,
                        'status' => 'published',
                        'is_featured' => false,
                        'published_at' => $article['pubDate'] ?? now(),
                    ]);

                    $count++;
                    $fetchedForLang++;
                }

                $page++;

                if (isset($data['nextPage']) && $data['nextPage'] !== null) {
                    continue;
                }

                break;
            }
        }

        return $count;
    }

    /**
     * Check if article already exists by URL or title.
     */
    protected function articleExists(string $url, string $title): bool
    {
        if (!empty($url)) {
            return News::where('url', $url)->exists();
        }

        return News::where('title', $title)->exists();
    }

    /**
     * Remove duplicate articles by URL first, then by title.
     */
    protected function deduplicateArticles(): int
    {
        $deleted = 0;

        // Remove duplicates by URL (keep most recent)
        $urlDuplicates = News::query()
            ->whereNotNull('url')
            ->where('url', '!=', '')
            ->select('url', News::raw('COUNT(*) as count'))
            ->groupBy('url')
            ->having('count', '>', 1)
            ->get();

        foreach ($urlDuplicates as $duplicate) {
            $articles = News::where('url', $duplicate->url)
                ->orderBy('created_at', 'desc')
                ->get();

            $keep = $articles->first();
            $toDelete = $articles->slice(1);

            foreach ($toDelete as $article) {
                $article->delete();
                $deleted++;
            }
        }

        // Remove duplicates by title (keep most recent)
        $titleDuplicates = News::query()
            ->select('title', News::raw('COUNT(*) as count'))
            ->groupBy('title')
            ->having('count', '>', 1)
            ->get();

        foreach ($titleDuplicates as $duplicate) {
            $articles = News::where('title', $duplicate->title)
                ->orderBy('created_at', 'desc')
                ->get();

            $keep = $articles->first();
            $toDelete = $articles->slice(1);

            foreach ($toDelete as $article) {
                $article->delete();
                $deleted++;
            }
        }

        return $deleted;
    }

    /**
     * Generate placeholder images for articles without images.
     */
    protected function generatePlaceholderImages(int $limit): int
    {
        $articles = News::where(function ($q) {
            $q->whereNull('image')
                ->orWhere('image', '');
        })->limit($limit)->get();

        $count = 0;

        foreach ($articles as $article) {
            $slug = $article->slug ?? Str::slug($article->title);
            $filename = $article->id . '_' . time() . '.svg';
            $path = public_path('storage/news/' . $filename);

            // Create directory if it doesn't exist
            $dir = dirname($path);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Generate unique color based on article title
            $hash = md5($article->title);
            $hue = hexdec(mb_substr($hash, 0, 3)) % 360;
            $color = "hsl({$hue}, 40%, 25%)";
            $textColor = "hsl({$hue}, 30%, 80%)";

            $title = htmlspecialchars($article->title);
            $words = explode(' ', $title);
            $line1 = htmlspecialchars(implode(' ', array_slice($words, 0, 3)));
            $line2 = htmlspecialchars(implode(' ', array_slice($words, 3, 3)));

            $svg = <<<SVG
            <svg xmlns="http://www.w3.org/2000/svg" width="800" height="450" viewBox="0 0 800 450">
              <rect width="800" height="450" fill="{$color}"/>
              <rect x="20" y="20" width="760" height="410" fill="none" stroke="{$textColor}" stroke-width="2" opacity="0.3"/>
              <text x="400" y="180" text-anchor="middle" font-family="Georgia, serif" font-size="36" fill="{$textColor}" opacity="0.9">{$line1}</text>
              <text x="400" y="230" text-anchor="middle" font-family="Georgia, serif" font-size="36" fill="{$textColor}" opacity="0.9">{$line2}</text>
              <text x="400" y="320" text-anchor="middle" font-family="Georgia, serif" font-size="18" fill="{$textColor}" opacity="0.5">JAREEDA</text>
            </svg>
            SVG;

            file_put_contents($path, $svg);

            $article->update([
                'image' => 'storage/news/' . $filename,
            ]);

            $count++;
        }

        return $count;
    }

    /**
     * Generate images using Unsloth FLUX2.
     */
    protected function generateUnslothImages(int $limit): int
    {
        $imageService = app(UnslothImageService::class);

        if (!$imageService->isHealthy()) {
            $this->line('  Unsloth not available, falling back to placeholders');

            return $this->generatePlaceholderImages($limit);
        }

        $articles = News::where(function ($q) {
            $q->whereNull('image')
                ->orWhere('image', '');
        })->limit($limit)->get();

        $count = 0;

        foreach ($articles as $article) {
            try {
                $prompt = 'Newspaper style photo for: ' . Str::limit($article->title, 100);
                $result = $imageService->generate($prompt, [
                    'width' => 1024,
                    'height' => 768,
                ]);

                if ($result && isset($result['path'])) {
                    $article->update(['image' => $result['path']]);
                    $count++;
                    $this->line("  Generated: {$article->title}");
                } else {
                    // Fallback to placeholder
                    $this->generatePlaceholderImageForArticle($article);
                    $count++;
                }
            } catch (\Exception $e) {
                $this->line("  Failed for {$article->title}: {$e->getMessage()}");
                $this->generatePlaceholderImageForArticle($article);
                $count++;
            }
        }

        return $count;
    }

    /**
     * Generate a placeholder image for a specific article.
     */
    protected function generatePlaceholderImageForArticle(News $article): void
    {
        $filename = $article->id . '_' . time() . '.svg';
        $path = public_path('storage/news/' . $filename);

        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $hash = md5($article->title);
        $hue = hexdec(mb_substr($hash, 0, 3)) % 360;
        $color = "hsl({$hue}, 40%, 25%)";
        $textColor = "hsl({$hue}, 30%, 80%)";

        $title = htmlspecialchars($article->title);
        $words = explode(' ', $title);
        $line1 = htmlspecialchars(implode(' ', array_slice($words, 0, 3)));
        $line2 = htmlspecialchars(implode(' ', array_slice($words, 3, 3)));

        $svg = <<<SVG
        <svg xmlns="http://www.w3.org/2000/svg" width="800" height="450" viewBox="0 0 800 450">
          <rect width="800" height="450" fill="{$color}"/>
          <rect x="20" y="20" width="760" height="410" fill="none" stroke="{$textColor}" stroke-width="2" opacity="0.3"/>
          <text x="400" y="180" text-anchor="middle" font-family="Georgia, serif" font-size="36" fill="{$textColor}" opacity="0.9">{$line1}</text>
          <text x="400" y="230" text-anchor="middle" font-family="Georgia, serif" font-size="36" fill="{$textColor}" opacity="0.9">{$line2}</text>
          <text x="400" y="320" text-anchor="middle" font-family="Georgia, serif" font-size="18" fill="{$textColor}" opacity="0.5">JAREEDA</text>
        </svg>
        SVG;

        file_put_contents($path, $svg);

        $article->update([
            'image' => 'storage/news/' . $filename,
        ]);
    }

    /**
     * Parse RSS date format.
     */
    protected function parseRssDate(string $date): \Carbon\Carbon
    {
        try {
            return \Carbon\Carbon::parse($date);
        } catch (\Exception $e) {
            return now();
        }
    }
}
