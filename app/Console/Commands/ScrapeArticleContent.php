<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class ScrapeArticleContent extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:scrape-content
                            {--limit=50 : Maximum articles to scrape}
                            {--fresh-only : Only scrape articles with empty body}';

    /**
     * The console command description.
     */
    protected $description = 'Scrape full article content from source URLs using Playwright';

    /**
     * Path to the scraper script.
     */
    protected string $scraperScript = __DIR__ . '/../../scripts/scrape-articles.ts';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $limit = (int) $this->option('limit');
        $freshOnly = $this->option('fresh-only');

        $this->info('Preparing articles for scraping...');

        $query = News::query()
            ->whereNotNull('url')
            ->where('url', '!=', '');

        if ($freshOnly) {
            $query->where(function ($q) {
                $q->whereNull('body')
                    ->orWhere('body', 'like', '%"en":""%')
                    ->orWhere('body', 'like', '%"en":"%"');
            });
        }

        // Only scrape articles with short bodies (likely just RSS excerpts)
        $query->where(function ($q) {
            $q->whereRaw("json_extract(body, '$.en') IS NULL")
                ->orWhereRaw("length(json_extract(body, '$.en')) < 200");
        });

        $articles = $query->limit($limit)->get();

        if ($articles->isEmpty()) {
            $this->info('No articles need scraping.');

            return self::SUCCESS;
        }

        $this->info("Found {$articles->count()} articles to scrape.");

        // Prepare URLs file for Playwright
        $urlsFile = storage_path('app/scraper-urls.json');
        $articlesData = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'url' => $article->url,
                'slug' => $article->slug,
            ];
        })->toArray();

        File::put($urlsFile, json_encode($articlesData, JSON_PRETTY_PRINT));

        $this->info('Running Playwright scraper...');

        // Run the Playwright scraper
        $result = $this->runPlaywrightScraper($urlsFile);

        // Process results
        $resultsFile = storage_path('app/scraper-results.json');
        if (!File::exists($resultsFile)) {
            $this->error('Scraper results not found.');

            return self::FAILURE;
        }

        $results = json_decode(File::get($resultsFile), true);
        $scraped = 0;
        $failed = 0;

        foreach ($results as $result) {
            $article = News::find($result['id'] ?? null);
            if (!$article) {
                continue;
            }

            if (!empty($result['body']) && mb_strlen($result['body']) > mb_strlen($article->getBody() ?? '')) {
                $body = ['en' => $result['body']];
                $excerpt = ['en' => Str::limit(strip_tags($result['body']), 300)];

                // Try to get better title
                $title = $article->getTitle();
                if (!empty($result['title']) && mb_strlen($result['title']) > mb_strlen($title)) {
                    $title = $result['title'];
                }

                // Try to get image from page
                $image = $article->image;
                if (empty($image) && !empty($result['image'])) {
                    $image = $result['image'];
                }

                $article->update([
                    'title' => ['en' => $title],
                    'body' => $body,
                    'excerpt' => $excerpt,
                    'image' => $image,
                ]);

                $scraped++;
            } else {
                $failed++;
            }
        }

        $this->newLine();
        $this->info('Scraping complete:');
        $this->line("  Updated: {$scraped}");
        $this->line("  Failed/Skipped: {$failed}");

        // Cleanup
        File::delete([$urlsFile, $resultsFile]);

        return self::SUCCESS;
    }

    /**
     * Run the Playwright scraper script.
     */
    protected function runPlaywrightScraper(string $urlsFile): int
    {
        $scriptPath = base_path('scripts/scrape-articles.ts');

        if (!File::exists($scriptPath)) {
            $this->error("Scraper script not found at {$scriptPath}");

            return 1;
        }

        $process = new Process([
            'npx', 'tsx', $scriptPath, $urlsFile,
        ], base_path());

        $process->setTimeout(300);
        $process->run(function ($type, $buffer) {
            if ($type === Process::OUT) {
                $this->getOutput()->write($buffer);
            } elseif ($type === Process::ERR) {
                if ($this->getOutput()->isVerbose()) {
                    $this->error($buffer);
                }
            }
        });

        return $process->getExitCode();
    }
}
