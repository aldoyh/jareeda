<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use App\Services\UnslothImageService;
use Illuminate\Console\Command;

class GenerateUnslothImages extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:generate-unsloth-images
                            {--limit=10 : Maximum images to generate}
                            {--force : Regenerate even if image exists}';

    /**
     * The console command description.
     */
    protected $description = 'Generate AI images for articles without images using Unsloth FLUX2';

    /**
     * Execute the console command.
     */
    public function handle(UnslothImageService $imageService): int
    {
        $limit = (int) $this->option('limit');
        $force = $this->option('force');

        // Check if Unsloth is healthy
        if (!$imageService->isHealthy()) {
            $this->error('❌ Unsloth service is not running or not accessible');
            $this->info('   Make sure Unsloth Studio is running on port 8888');

            return self::FAILURE;
        }

        $this->info('🎨 Generating AI images for articles using Unsloth FLUX2');
        $this->newLine();

        // Get articles without images
        $query = News::query()
            ->where(function ($q) {
                $q->whereNull('image')
                    ->orWhere('image', '');
            });

        if (!$force) {
            $query->where(function ($q) {
                $q->whereNull('image')
                    ->orWhere('image', '')
                    ->orWhere('image', 'LIKE', '%svg%');
            });
        }

        $articles = $query->limit($limit)->get();

        if ($articles->isEmpty()) {
            $this->info('✓ All articles already have images');

            return self::SUCCESS;
        }

        $this->info("Found {$articles->count()} articles without images");
        $this->newLine();

        $generated = 0;
        $failed = 0;

        foreach ($articles as $article) {
            $title = is_array($article->title) ? ($article->title['en'] ?? reset($article->title)) : $article->title;
            $excerpt = is_array($article->excerpt) ? ($article->excerpt['en'] ?? reset($article->excerpt)) : $article->excerpt;

            $this->line('📰 Generating image for: ' . mb_substr($title, 0, 60) . '...');

            try {
                $prompt = $imageService->buildPrompt(
                    $title,
                    $excerpt,
                    $article->category
                );

                $result = $imageService->generate($prompt, [
                    'width' => 1024,
                    'height' => 768,
                ]);

                // Update article with generated image
                $article->update([
                    'image' => $result['url'],
                    'image_alt' => $title,
                ]);

                $generated++;
                $this->line("   ✅ Generated: {$result['path']}", 'info');

                // Rate limiting - wait between generations
                sleep(2);
            } catch (\Exception $e) {
                $failed++;
                $this->error("   ❌ Failed: {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info("Done! Generated: {$generated}, Failed: {$failed}");

        return self::SUCCESS;
    }
}
