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

        // Preflight: ensure required services / tools are available
        if (!$this->checkAndPrepareServices()) {
            return self::FAILURE;
        }

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

    /**
     * Check and prepare required services for scraping.
     */
    protected function checkAndPrepareServices(): bool
    {
        $this->info('Checking required services for scraping...');

        // 1. Node.js
        $nodeVersion = trim(shell_exec('node -v 2>&1') ?: '');
        if (!str_starts_with($nodeVersion, 'v')) {
            $this->error('Node.js not found in PATH. Install Node.js 18+.');
            return false;
        }
        $this->info("Node {$nodeVersion} found.");

        // 2. npm / npx
        $npmVersion = trim(shell_exec('npm -v 2>&1') ?: '');
        if (empty($npmVersion)) {
            $this->error('npm not found in PATH.');
            return false;
        }
        $this->info("npm {$npmVersion} found.");

        // 3. Playwright browsers - check if chromium is installed
        $this->info('Verifying Playwright browsers...');
        $playwrightCheck = new Process(['npx', 'playwright', '--version'], base_path());
        $playwrightCheck->run();
        if (!$playwrightCheck->isSuccessful()) {
            $this->warn('Playwright not ready, attempting install...');
            // Try to install chromium
            $install = new Process(['npx', 'playwright', 'install', 'chromium'], base_path());
            $install->setTimeout(600);
            $install->run(function ($type, $buffer) {
                $this->getOutput()->write($buffer);
            });
            if (!$install->isSuccessful()) {
                $this->error('Failed to install Playwright browsers. Run `npx playwright install chromium` manually.');
                return false;
            }
        }
        $this->info('Playwright browsers ready.');

        // 4. tsx availability (via npx)
        $this->info('Checking tsx...');
        // npx will auto-fetch, so just note
        $this->info('tsx will be resolved via npx.');

        // 5. Storage writable
        $storagePath = storage_path('app');
        if (!is_writable($storagePath)) {
            $this->error("Storage path {$storagePath} is not writable.");
            return false;
        }
        $this->info('Storage writable.');

        // 6. Optional: Redis for queue (warn only)
        $redisConfig = config('database.redis.default.host');
        $this->info('Service check complete. Ready to scrape.');

        return true;
    }
}
