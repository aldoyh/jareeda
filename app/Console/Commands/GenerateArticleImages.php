<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateArticleImages extends Command
{
    protected $signature = 'news:ensure-images
        {--limit= : Maximum number of articles to process}
        {--diffusionbee : Try DiffusionBee first (requires GUI open)}
        {--force : Regenerate even for articles that already have images}';

    protected $description = 'Ensure all articles have images - tries DiffusionBee, falls back to SVG placeholders';

    private string $backendPath = '/Applications/DiffusionBee.app/Contents/Resources/core/diffusionbee_backend';

    private array $categoryColors = [
        'politics' => '#dc2626',
        'finance' => '#059669',
        'technology' => '#2563eb',
        'sports' => '#d97706',
        'travel' => '#7c3aed',
        'culture' => '#db2777',
        'health' => '#0891b2',
        'education' => '#4f46e5',
        'news' => '#64748b',
    ];

    public function handle(): int
    {
        $query = News::query();

        if (!$this->option('force')) {
            $query->where(function ($q) {
                $q->whereNull('image')->orWhere('image', '');
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

        $this->info("Processing {$articles->count()} articles...");
        $this->newLine();

        $generated = 0;
        $failed = 0;

        foreach ($articles as $index => $article) {
            $title = is_array($article->title) ? ($article->title['en'] ?? reset($article->title)) : $article->title;

            $this->line(sprintf(
                '[%d/%d] %s',
                $index + 1,
                $articles->count(),
                Str::limit($title, 60)
            ));

            $success = false;

            // Try DiffusionBee if requested and available
            if ($this->option('diffusionbee') && file_exists($this->backendPath)) {
                $success = $this->tryDiffusionBee($article, $title);
            }

            // Fall back to SVG placeholder
            if (!$success) {
                $success = $this->generateSvgPlaceholder($article, $title);
            }

            if ($success) {
                $generated++;
            } else {
                $failed++;
            }

            usleep(200000);
        }

        $this->newLine();
        $this->info("Done. Generated: {$generated}, Failed: {$failed}");

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    /**
     * Try to generate an image using DiffusionBee.
     */
    private function tryDiffusionBee(News $article, string $title): bool
    {
        try {
            $prompt = $this->buildPrompt($title, $article->category, $article->language);

            $script = base_path('scripts/diffusionbee_standalone.php');
            if (!file_exists($script)) {
                return false;
            }

            $process = new \Symfony\Component\Process\Process([
                'php',
                $script,
                '--prompt=' . $prompt,
                '--count=1',
                '--width=1152',
                '--height=768',
                '--steps=40',
                '--model=FLUX.1-dev',
            ]);

            $process->setTimeout(360);
            $process->run();

            if ($process->isSuccessful()) {
                $result = json_decode($process->getOutput(), true);
                if ($result && $result['success'] && !empty($result['images'][0])) {
                    $imagePath = $result['images'][0];
                    $storagePath = 'news-images/ai/' . $article->id . '_' . time() . '.png';

                    if (copy($imagePath, Storage::path('app/' . $storagePath))) {
                        $article->update([
                            'ai_generated_image' => true,
                            'ai_generated_image_path' => $storagePath,
                        ]);

                        $this->info('  ✓ DiffusionBee: ' . basename($imagePath));

                        return true;
                    }
                }
            }
        } catch (\Exception $e) {
            $this->warn('  DiffusionBee error: ' . $e->getMessage());
        }

        return false;
    }

    /**
     * Generate a unique SVG placeholder image.
     */
    private function generateSvgPlaceholder(News $article, string $title): bool
    {
        try {
            $category = $article->category ?? 'news';
            $language = $article->language ?? 'en';

            $color = $this->categoryColors[mb_strtolower($category)] ?? '#64748b';
            $shortTitle = Str::limit($title, 45);
            $escapedTitle = htmlspecialchars($shortTitle, ENT_XML1);
            $escapedCategory = htmlspecialchars(ucfirst($category), ENT_XML1);

            $isArabic = $language === 'ar';
            $textAnchor = $isArabic ? 'end' : 'start';
            $direction = $isArabic ? 'rtl' : 'ltr';
            $x = $isArabic ? '560' : '40';
            $fontFamily = $isArabic ? "'Noto Naskh Arabic', 'Amiri', serif" : "'Inter', -apple-system, sans-serif";

            $svg = <<<SVG
<svg width="600" height="338" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="bg-{$article->id}" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:{$color};stop-opacity:1" />
            <stop offset="100%" style="stop-color:{$color};stop-opacity:0.7" />
        </linearGradient>
    </defs>
    <rect width="600" height="338" fill="url(#bg-{$article->id})" rx="8" />
    <rect x="20" y="20" width="560" height="298" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1" rx="4" />
    <text x="40" y="50" font-family="{$fontFamily}" font-size="12" fill="rgba(255,255,255,0.7)" letter-spacing="2">{$escapedCategory}</text>
    <line x1="40" y1="65" x2="120" y2="65" stroke="rgba(255,255,255,0.3)" stroke-width="1" />
    <text x="{$x}" y="180" font-family="{$fontFamily}" font-size="22" font-weight="700" fill="white" text-anchor="{$textAnchor}" direction="{$direction}">
        {$escapedTitle}
    </text>
    <text x="40" y="300" font-family="{$fontFamily}" font-size="10" fill="rgba(255,255,255,0.4)">JAREEDA</text>
</svg>
SVG;

            $filename = 'news-images/placeholder_' . $article->id . '.svg';
            Storage::disk('public')->put($filename, $svg);

            $article->update([
                'image' => Storage::url($filename),
            ]);

            $this->info("  ✓ SVG placeholder: {$filename}");

            return true;
        } catch (\Exception $e) {
            $this->error('  ✗ Failed: ' . $e->getMessage());

            return false;
        }
    }

    private function buildPrompt(string $title, ?string $category, string $language): string
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

        $context = $contextMap[mb_strtolower($category ?? 'news')] ?? 'news journalism, Bahrain';
        $langPrefix = $language === 'ar' ? 'Middle Eastern' : '';

        return "Photorealistic {$langPrefix} news photography: {$context}. "
            . "Professional editorial image for article about: {$cleanTitle}. "
            . 'High quality, sharp focus, natural lighting, journalistic style. '
            . 'Bahrain Middle East aesthetic, professional photography.';
    }
}
