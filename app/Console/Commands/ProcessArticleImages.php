<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use App\Services\NewsImageService;
use Illuminate\Console\Command;

class ProcessArticleImages extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:process-images
                            {--limit=20 : Maximum number of articles to process}
                            {--dry-run : Show what would be processed without actually doing it}';

    /**
     * The console command description.
     */
    protected $description = 'Process images for news articles that are missing featured images';

    /**
     * Execute the console command.
     */
    public function handle(NewsImageService $imageService): int
    {
        $limit = (int) $this->option('limit');
        $dryRun = $this->option('dry-run');

        $this->info('Finding articles without images...');

        $articles = News::query()
            ->whereNull('image')
            ->whereNull('ai_generated_image_path')
            ->where('ai_generated_image', false)
            ->limit($limit)
            ->get();

        if ($articles->isEmpty()) {
            $this->info('No articles need image processing.');

            return self::SUCCESS;
        }

        $this->info("Found {$articles->count()} articles without images.");

        if ($dryRun) {
            foreach ($articles as $article) {
                $this->line("  - [{$article->id}] {$article->getTitle()}");
            }

            return self::SUCCESS;
        }

        $this->line('Processing images...');
        $this->newLine();

        $results = $imageService->processArticleImages($articles);

        $this->newLine();
        $this->info('Results:');
        $this->line("  Downloaded: {$results['downloaded']}");
        $this->line("  Generated:  {$results['generated']}");
        $this->line("  Failed:     {$results['failed']}");
        $this->line("  Total:      {$results['processed']}");

        return self::SUCCESS;
    }
}
