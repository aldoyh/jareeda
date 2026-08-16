<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GeneratePlaceholderImages extends Command
{
    protected $signature = 'news:generate-placeholders
        {--limit= : Maximum number of articles to process}';

    protected $description = 'Generate SVG placeholder images for articles without images';

    private array $colors = [
        '#4f46e5' => 'Indigo',
        '#0891b2' => 'Cyan',
        '#059669' => 'Emerald',
        '#d97706' => 'Amber',
        '#dc2626' => 'Red',
        '#7c3aed' => 'Violet',
        '#db2777' => 'Pink',
        '#2563eb' => 'Blue',
    ];

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

        $this->info("Generating placeholders for {$articles->count()} articles.");

        $generated = 0;

        foreach ($articles as $article) {
            $title = is_array($article->title) ? ($article->title['en'] ?? reset($article->title)) : $article->title;
            $category = $article->category ?? 'News';
            $language = $article->language ?? 'en';

            $svg = $this->generateSvg($title, $category, $language);

            $filename = 'news-images/placeholder_' . $article->id . '.svg';
            Storage::disk('public')->put($filename, $svg);

            $article->update([
                'image' => Storage::url($filename),
            ]);

            $this->info("  ✓ {$filename}");
            $generated++;
        }

        $this->newLine();
        $this->info("Generated {$generated} placeholder images.");

        return self::SUCCESS;
    }

    private function generateSvg(string $title, string $category, string $language): string
    {
        $colorIndex = crc32($title) % count($this->colors);
        $color = array_keys($this->colors)[$colorIndex];

        $shortTitle = Str::limit($title, 40);
        $escapedTitle = htmlspecialchars($shortTitle, ENT_XML1);
        $escapedCategory = htmlspecialchars($category, ENT_XML1);

        $isArabic = $language === 'ar';
        $textAnchor = $isArabic ? 'end' : 'start';
        $direction = $isArabic ? 'rtl' : 'ltr';
        $x = $isArabic ? '580' : '40';

        return <<<SVG
<svg width="600" height="338" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:{$color};stop-opacity:1" />
            <stop offset="100%" style="stop-color:{$color};stop-opacity:0.7" />
        </linearGradient>
    </defs>
    <rect width="600" height="338" fill="url(#bg)" />
    <text x="40" y="50" font-family="Inter, -apple-system, sans-serif" font-size="14" fill="rgba(255,255,255,0.7)" text-transform="uppercase" letter-spacing="2">{$escapedCategory}</text>
    <text x="{$x}" y="169" font-family="Inter, -apple-system, sans-serif" font-size="24" font-weight="700" fill="white" text-anchor="{$textAnchor}" direction="{$direction}">
        <tspan x="{$x}" dy="0">{$escapedTitle}</tspan>
    </text>
    <text x="40" y="300" font-family="Inter, -apple-system, sans-serif" font-size="12" fill="rgba(255,255,255,0.5)">Jareeda</text>
</svg>
SVG;
    }
}
