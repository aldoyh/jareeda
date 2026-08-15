<?php

namespace App\Console\Commands;

use App\Jobs\GenerateArticleImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateArticleImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unsloth:generate-images
                            {--limit= : Maximum number of articles to process}
                            {--force : Force regeneration for articles that already have AI images}
                            {--dry-run : Show what would be processed without actually dispatching jobs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate AI images for articles without images using Unsloth FLUX2';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $limit = $this->option('limit');
        $force = $this->option('force');
        $dryRun = $this->option('dry-run');

        $this->info('Scanning for articles without images...');

        $query = DB::table('news')
            ->whereNull('image')
            ->where(function ($query) use ($force) {
                if ($force) {
                    $query->where(function ($q) {
                        $q->whereNull('ai_generated_image')
                            ->orWhere('ai_generated_image', false);
                    });
                } else {
                    $query->whereNull('ai_generated_image')
                        ->orWhere('ai_generated_image', false);
                }
            });

        $count = $query->count();

        if ($count === 0) {
            $this->info('No articles found that need images.');

            return self::SUCCESS;
        }

        $this->info("Found {$count} articles without images.");

        if ($limit) {
            $this->info("Limiting to {$limit} articles.");
        }

        if ($dryRun) {
            $this->info('Dry run - showing articles that would be processed:');
            $articles = $query->limit($limit ?? 10)->get();

            foreach ($articles as $article) {
                $title = $article->title_en ?? $article->title;
                $this->line("  - [{$article->id}] {$title}");
            }

            return self::SUCCESS;
        }

        if (!$this->confirm("Dispatch {$count} image generation jobs?")) {
            $this->info('Cancelled.');

            return self::SUCCESS;
        }

        $articles = $limit ? $query->limit($limit)->get() : $query->get();

        $dispatched = 0;
        foreach ($articles as $article) {
            GenerateArticleImage::dispatch($article->id);
            $dispatched++;

            if ($dispatched % 10 === 0) {
                $this->line("  Dispatched {$dispatched}/{$count} jobs...");
            }
        }

        $this->info("Successfully dispatched {$dispatched} image generation jobs.");
        $this->info('Jobs are being processed in the background by queue workers.');
        $this->info('Monitor progress with: php artisan queue:work --queue=ai-images');

        return self::SUCCESS;
    }
}
