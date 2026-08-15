<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsImageService
{
    /**
     * Process an article's image: download if available, generate if not.
     */
    public function processArticleImage(News $article): bool
    {
        // If article already has an image, skip
        if ($article->hasImage()) {
            return true;
        }

        // Try to download the original image
        if ($this->downloadImage($article)) {
            return true;
        }

        // Try to scrape image from article page
        if ($this->scrapeImageFromPage($article)) {
            return true;
        }

        // If all else fails, generate with AI
        if ($this->generateAiImage($article)) {
            return true;
        }

        Log::warning("Failed to get image for article: {$article->slug}");

        return false;
    }

    /**
     * Download the featured image from the article's image URL.
     */
    protected function downloadImage(News $article): bool
    {
        $imageUrl = $article->image;
        if (empty($imageUrl)) {
            return false;
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'Jareeda News Fetcher/1.0',
                ])
                ->get($imageUrl);

            if (!$response->successful()) {
                Log::warning("Failed to download image: HTTP {$response->status()} for {$imageUrl}");

                return false;
            }

            $contentType = $response->header('Content-Type', '');
            if (!str_starts_with($contentType, 'image/')) {
                Log::warning("Not an image response: {$contentType} for {$imageUrl}");

                return false;
            }

            $extension = $this->getExtensionFromContentType($contentType);
            $filename = 'news/' . Str::slug($article->slug) . '.' . $extension;
            $path = storage_path('app/public/' . $filename);

            File::ensureDirectoryExists(dirname($path));
            File::put($path, $response->body());

            $article->update([
                'image' => asset('storage/' . $filename),
                'image_alt' => $article->getTitle(),
            ]);

            Log::info("Downloaded image for article: {$article->slug}");

            return true;
        } catch (\Exception $e) {
            Log::error("Error downloading image for {$article->slug}: {$e->getMessage()}");

            return false;
        }
    }

    /**
     * Scrape the article page for an OG image or first image.
     */
    protected function scrapeImageFromPage(News $article): bool
    {
        $url = $article->url;
        if (empty($url)) {
            return false;
        }

        try {
            $response = Http::timeout(20)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; JareedaBot/1.0)',
                ])
                ->get($url);

            if (!$response->successful()) {
                return false;
            }

            $html = $response->body();
            $imageUrl = null;

            // Try og:image meta tag first (most reliable)
            if (preg_match('/<meta[^>]+property=["\']og:image["\'][^>]+content=["\']([^"\']+)/i', $html, $m)) {
                $imageUrl = $m[1];
            } elseif (preg_match('/<meta[^>]+content=["\']([^"\']+)["\'][^>]+property=["\']og:image["\']/', $html, $m)) {
                $imageUrl = $m[1];
            }

            // Try twitter:image
            if (!$imageUrl && preg_match('/<meta[^>]+name=["\']twitter:image["\'][^>]+content=["\']([^"\']+)/i', $html, $m)) {
                $imageUrl = $m[1];
            }

            // Try first article image
            if (!$imageUrl && preg_match('/<article[^>]*>.*?<img[^>]+src=["\']([^"\']+)/is', $html, $m)) {
                $imageUrl = $m[1];
            }

            // Try first image on page
            if (!$imageUrl && preg_match('/<img[^>]+src=["\']([^"\']+)/i', $html, $m)) {
                $imageUrl = $m[1];
            }

            if (empty($imageUrl)) {
                return false;
            }

            // Make absolute URL
            if (str_starts_with($imageUrl, '//')) {
                $imageUrl = 'https:' . $imageUrl;
            } elseif (str_starts_with($imageUrl, '/')) {
                $parsed = parse_url($url);
                $imageUrl = $parsed['scheme'] . '://' . $parsed['host'] . $imageUrl;
            }

            // Download the image
            $imgResponse = Http::timeout(20)
                ->withHeaders(['User-Agent' => 'Jareeda News Fetcher/1.0'])
                ->get($imageUrl);

            if (!$imgResponse->successful()) {
                return false;
            }

            $contentType = $imgResponse->header('Content-Type', '');
            if (!str_starts_with($contentType, 'image/')) {
                return false;
            }

            $extension = $this->getExtensionFromContentType($contentType);
            $filename = 'news/' . Str::slug($article->slug) . '.' . $extension;
            $path = storage_path('app/public/' . $filename);

            File::ensureDirectoryExists(dirname($path));
            File::put($path, $imgResponse->body());

            $article->update([
                'image' => asset('storage/' . $filename),
                'image_alt' => $article->getTitle(),
            ]);

            Log::info("Scraped image for article: {$article->slug} from {$imageUrl}");

            return true;
        } catch (\Exception $e) {
            Log::error("Error scraping image for {$article->slug}: {$e->getMessage()}");

            return false;
        }
    }

    /**
     * Generate an AI image using Unsloth FLUX2.
     */
    protected function generateAiImage(News $article): bool
    {
        $unslothService = app(UnslothImageService::class);

        if (!$unslothService->isHealthy()) {
            Log::warning('Unsloth API not available for image generation');

            return false;
        }

        try {
            $result = $unslothService->generate(
                prompt: $this->buildImagePrompt($article),
                options: [
                    'width' => 1024,
                    'height' => 768,
                ]
            );

            if (!$result || !isset($result['path'])) {
                Log::warning("AI image generation failed for article: {$article->slug}");

                return false;
            }

            // Update the article with the generated image
            $article->update([
                'ai_generated_image' => true,
                'ai_generated_image_path' => $result['path'],
                'image_alt' => $article->getTitle() . ' (AI Generated)',
            ]);

            Log::info("Generated AI image for article: {$article->slug}");

            return true;
        } catch (\Exception $e) {
            Log::error("Error generating AI image for {$article->slug}: {$e->getMessage()}");

            return false;
        }
    }

    /**
     * Build a prompt for AI image generation based on the article.
     */
    protected function buildImagePrompt(News $article): string
    {
        $title = $article->getTitle();
        $category = $article->category ?? 'news';
        $source = $article->source ?? 'Bahrain';

        $prompt = "Editorial photograph illustration for news article: \"{$title}\". ";
        $prompt .= 'Professional journalistic photography style, ';
        $prompt .= 'clean composition, ';
        $prompt .= 'appropriate for newspaper publication. ';
        $prompt .= 'High quality, detailed, realistic. ';
        $prompt .= "Context: {$category} news from {$source}.";

        return $prompt;
    }

    /**
     * Get file extension from Content-Type header.
     */
    protected function getExtensionFromContentType(string $contentType): string
    {
        return match ($contentType) {
            'image/jpeg', 'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/svg+xml' => 'svg',
            default => 'jpg',
        };
    }

    /**
     * Process images for multiple articles.
     *
     * @param \Illuminate\Database\Eloquent\Collection<int, News> $articles
     */
    public function processArticleImages($articles): array
    {
        $results = [
            'processed' => 0,
            'downloaded' => 0,
            'generated' => 0,
            'failed' => 0,
        ];

        foreach ($articles as $article) {
            if ($article->hasImage()) {
                $results['processed']++;

                continue;
            }

            // Try download first
            if ($this->downloadImage($article)) {
                $results['downloaded']++;
                $results['processed']++;

                continue;
            }

            // Try scraping from article page
            if ($this->scrapeImageFromPage($article)) {
                $results['downloaded']++;
                $results['processed']++;

                continue;
            }

            // Try AI generation
            if ($this->generateAiImage($article)) {
                $results['generated']++;
                $results['processed']++;

                continue;
            }

            $results['failed']++;
        }

        return $results;
    }
}
