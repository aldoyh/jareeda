<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FetchMissingImages extends Command
{
    protected $signature = 'news:fetch-missing-images
        {--limit= : Maximum number of articles to process}
        {--dry-run : Show what would be done without fetching}';

    protected $description = 'Fetch images for articles that are missing them by following Google News redirects and scraping og:image';

    public function handle(): int
    {
        $query = News::query()
            ->where(function ($q) {
                $q->whereNull('image')->orWhere('image', '');
            })
            ->where(function ($q) {
                $q->whereNull('ai_generated_image_path')->orWhere('ai_generated_image_path', '');
            });

        if ($limit = $this->option('limit')) {
            $query->limit((int) $limit);
        }

        $articles = $query->get();

        if ($articles->isEmpty()) {
            $this->info('All articles already have images.');

            return self::SUCCESS;
        }

        $this->info("Found {$articles->count()} articles without images.");
        $this->newLine();

        $fetched = 0;
        $failed = 0;

        foreach ($articles as $index => $article) {
            $title = is_array($article->title) ? ($article->title['en'] ?? reset($article->title)) : $article->title;

            $this->line(sprintf(
                '[%d/%d] %s',
                $index + 1,
                $articles->count(),
                Str::limit($title, 60)
            ));

            if ($this->option('dry-run')) {
                $this->line('  URL: ' . ($article->url ?? 'none'));
                $fetched++;

                continue;
            }

            $imageUrl = $this->fetchImageFromUrl($article->url);

            if ($imageUrl) {
                $storagePath = 'news-images/' . $article->id . '_' . time() . '.jpg';

                $imageContent = Http::timeout(15)
                    ->withHeaders(['User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36'])
                    ->get($imageUrl)
                    ->body();

                if (mb_strlen($imageContent) > 1000) {
                    Storage::disk('public')->put($storagePath, $imageContent);

                    $article->update([
                        'image' => Storage::url($storagePath),
                    ]);

                    $this->info('  ✓ Fetched: ' . basename($imageUrl));
                    $fetched++;
                } else {
                    $this->warn('  ✗ Image too small or empty');
                    $failed++;
                }
            } else {
                $this->warn('  ✗ No image found');
                $failed++;
            }

            // Rate limiting
            usleep(500000);
        }

        $this->newLine();
        $this->info("Done. Fetched: {$fetched}, Failed: {$failed}");

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    /**
     * Follow a URL (possibly Google News redirect) and find og:image.
     */
    private function fetchImageFromUrl(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        try {
            // Follow redirects to get the actual URL
            $response = Http::timeout(10)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                    'Accept' => 'text/html,application/xhtml+xml',
                ])
                ->withOptions(['allow_redirects' => ['max_redirects' => 5]])
                ->get($url);

            if (!$response->successful()) {
                return null;
            }

            $html = $response->body();
            $finalUrl = $url;

            // Try to find og:image in the HTML
            if (preg_match('/<meta\s+property="og:image"\s+content="([^"]+)"/i', $html, $matches)) {
                return $this->resolveUrl($finalUrl, $matches[1]);
            }

            if (preg_match('/<meta\s+content="([^"]+)"\s+property="og:image"/i', $html, $matches)) {
                return $this->resolveUrl($finalUrl, $matches[1]);
            }

            // Try twitter:image
            if (preg_match('/<meta\s+name="twitter:image"\s+content="([^"]+)"/i', $html, $matches)) {
                return $this->resolveUrl($finalUrl, $matches[1]);
            }

            // Try to find first large image in the content
            if (preg_match('/<img[^>]+src="([^"]+)"[^>]*>/i', $html, $matches)) {
                $imgUrl = $this->resolveUrl($finalUrl, $matches[1]);
                if ($this->isValidImageUrl($imgUrl)) {
                    return $imgUrl;
                }
            }

        } catch (\Exception $e) {
            $this->warn('  Error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Resolve a relative URL against a base URL.
     */
    private function resolveUrl(string $baseUrl, string $relativeUrl): string
    {
        if (str_starts_with($relativeUrl, 'http')) {
            return $relativeUrl;
        }

        $parts = parse_url($baseUrl);
        if (!$parts) {
            return $relativeUrl;
        }

        $scheme = $parts['scheme'] ?? 'https';
        $host = $parts['host'] ?? '';

        if (str_starts_with($relativeUrl, '//')) {
            return $scheme . ':' . $relativeUrl;
        }

        if (str_starts_with($relativeUrl, '/')) {
            return $scheme . '://' . $host . $relativeUrl;
        }

        $path = $parts['path'] ?? '/';
        $path = dirname($path) . '/' . $relativeUrl;

        return $scheme . '://' . $host . $path;
    }

    /**
     * Check if a URL looks like a valid image URL.
     */
    private function isValidImageUrl(string $url): bool
    {
        $path = parse_url($url, PHP_URL_PATH) ?? '';

        return preg_match('/\.(jpg|jpeg|png|gif|webp|avif)/i', $path) === 1
            || str_contains($url, 'image')
            || str_contains($url, 'img');
    }
}
