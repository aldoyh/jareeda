<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class GenerateDiffusionBeeImages extends Command
{
    protected $signature = 'news:generate-images
        {--limit= : Maximum number of articles to process}
        {--dry-run : Show what would be done without generating}
        {--force : Regenerate even for articles that already have images}';

    protected $description = 'Generate images for articles without images using DiffusionBee';

    private string $backendPath = '/Applications/DiffusionBee.app/Contents/Resources/core/diffusionbee_backend';

    private string $scriptPath = 'scripts/diffusionbee_standalone.php';

    public function handle(): int
    {
        if (!file_exists($this->backendPath)) {
            $this->error('DiffusionBee backend not found at: ' . $this->backendPath);
            $this->error('Install DiffusionBee from https://diffusionbee.com');

            return self::FAILURE;
        }

        $query = News::query()
            ->whereNull('image')
            ->orWhere('image', '')
            ->orWhere('image', 'null');

        if (!$this->option('force')) {
            $query->where(function ($q) {
                $q->whereNull('ai_generated_image_path')
                    ->orWhere('ai_generated_image_path', '');
            });
        }

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

        $generated = 0;
        $failed = 0;

        foreach ($articles as $index => $article) {
            $title = is_array($article->title) ? ($article->title['en'] ?? reset($article->title)) : $article->title;
            $category = $article->category ?? 'news';
            $language = $article->language ?? 'en';

            $this->line(sprintf(
                '[%d/%d] %s',
                $index + 1,
                $articles->count(),
                Str::limit($title, 60)
            ));

            if ($this->option('dry-run')) {
                $this->line('  Would generate: ' . $this->buildPrompt($title, $category, $language));
                $generated++;

                continue;
            }

            $prompt = $this->buildPrompt($title, $category, $language);

            $imagePath = $this->generateImage($prompt);

            if ($imagePath) {
                // Copy to storage
                $storagePath = 'news-images/ai/' . $article->id . '_' . time() . '.png';

                if (copy($imagePath, Storage::path('app/' . $storagePath))) {
                    $article->update([
                        'ai_generated_image' => true,
                        'ai_generated_image_path' => $storagePath,
                    ]);

                    $this->info('  ✓ Generated: ' . basename($imagePath));
                    $generated++;
                } else {
                    $this->error('  ✗ Failed to copy image to storage');
                    $failed++;
                }
            } else {
                $this->error('  ✗ Generation failed');
                $failed++;
            }

            // Brief pause between generations
            usleep(500000);
        }

        $this->newLine();
        $this->info("Done. Generated: {$generated}, Failed: {$failed}");

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    private function buildPrompt(string $title, string $category, string $language): string
    {
        $cleanTitle = preg_replace('/[^\w\s]/u', '', $title);
        $cleanTitle = mb_trim(preg_replace('/\s+/', ' ', $cleanTitle));

        $contextMap = [
            'politics' => 'political news scene, government building, press conference',
            'finance' => 'financial district, stock market, banking',
            'technology' => 'modern technology, innovation, digital',
            'sports' => 'sports event, stadium, athletic competition',
            'travel' => 'travel destination, tourism, landscape',
            'culture' => 'cultural event, art, tradition',
            'health' => 'healthcare, medical, wellness',
            'education' => 'education, university, learning',
        ];

        $context = $contextMap[mb_strtolower($category)] ?? 'news journalism, Bahrain';

        $langPrefix = $language === 'ar' ? 'Middle Eastern' : '';

        return "Photorealistic {$langPrefix} news photography: {$context}. "
            . "Professional editorial image for article about: {$cleanTitle}. "
            . 'High quality, sharp focus, natural lighting, journalistic style. '
            . 'Bahrain Middle East aesthetic, professional photography, 4k quality.';
    }

    private function generateImage(string $prompt): ?string
    {
        $script = base_path($this->scriptPath);

        if (!file_exists($script)) {
            $this->error('DiffusionBee script not found at: ' . $script);

            return null;
        }

        $process = new Process([
            'php',
            $script,
            '--prompt=' . $prompt,
            '--count=1',
            '--width=1152',
            '--height=768',
            '--steps=40',
            '--model=FLUX.1-dev',
        ]);

        $process->setTimeout(360); // 6 minutes per image
        $process->run();

        if (!$process->isSuccessful()) {
            $this->error('  Process error: ' . $process->getErrorOutput());

            return null;
        }

        $output = $process->getOutput();
        $result = json_decode($output, true);

        if ($result && $result['success'] && !empty($result['images'][0])) {
            return $result['images'][0];
        }

        return null;
    }
}
