<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\UnslothImageService;
use Illuminate\Console\Command;

class GenerateCoverImage extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:generate-cover
                            {--width=1920 : Image width in pixels}
                            {--height=1080 : Image height in pixels}
                            {--prompt= : Custom prompt for image generation}
                            {--style=newspaper : Style: newspaper, modern, classic, minimalist}
                            {--theme=bahrain : Theme: bahrain, tech, business, culture, sports}
                            {--output=public/storage/cover : Output directory}
                            {--rotate : Remove old cover and set new one as current}';

    /**
     * The console command description.
     */
    protected $description = 'Generate a new header/cover image for the newspaper homepage';

    /**
     * Style prompts for different visual styles.
     *
     * @var array<string, string>
     */
    protected array $styles = [
        'newspaper' => 'Classic newspaper front page masthead, elegant serif typography, black and white with subtle sepia tones, vintage press aesthetic',
        'modern' => 'Modern digital newspaper header, clean minimalist design, bold typography, gradient accents',
        'classic' => 'Traditional broadsheet newspaper masthead, ornate border design, timeless editorial style',
        'minimalist' => 'Minimalist newspaper header, lots of white space, thin elegant lines, sophisticated simplicity',
    ];

    /**
     * Theme keywords for different content types.
     *
     * @var array<string, string>
     */
    protected array $themes = [
        'bahrain' => 'Bahrain skyline, pearl monument, financial district, Arabian Gulf, dhow boats, modern architecture',
        'tech' => 'Technology circuit board, digital networks, futuristic interface, data visualization',
        'business' => 'Stock market charts, corporate skyline, financial district, trading floor',
        'culture' => 'Cultural heritage, traditional patterns, Islamic几何 art, calligraphy',
        'sports' => 'Sports stadium, athletic competition, dynamic motion, victory celebration',
    ];

    /**
     * Execute the console command.
     */
    public function handle(UnslothImageService $imageService): int
    {
        $width = (int) $this->option('width');
        $height = (int) $this->option('height');
        $style = $this->option('style');
        $theme = $this->option('theme');
        $outputDir = $this->option('output');
        $rotate = $this->option('rotate');
        $customPrompt = $this->option('prompt');

        $this->info('🎨 Generating new cover image');
        $this->info("   Style: {$style}");
        $this->info("   Theme: {$theme}");
        // Ensure dimensions are multiples of 16 for FLUX
        $width = (int) ceil($width / 16) * 16;
        $height = (int) ceil($height / 16) * 16;
        $this->info("   Size: {$width}x{$height}");
        $this->newLine();

        // Build the prompt
        $prompt = $this->buildPrompt($style, $theme, $customPrompt);
        $this->line("Prompt: {$prompt}");
        $this->newLine();

        // Check if Unsloth is available
        if (!$imageService->isHealthy()) {
            $this->error('Unsloth service is not running on port 8888');
            $this->info('Starting with placeholder generation instead...');

            return $this->generatePlaceholder($width, $height, $outputDir, $rotate);
        }

        // Generate with Unsloth FLUX2
        $this->info('Generating with Unsloth FLUX2...');

        try {
            $result = $imageService->generate($prompt, [
                'width' => $width,
                'height' => $height,
            ]);

            if ($result && isset($result['path'])) {
                $this->newLine();
                $this->info('✅ Cover image generated successfully!');

                if ($rotate) {
                    $this->rotateCover($result['path']);
                }

                $this->info("   Path: {$result['path']}");
                $this->info('   URL: ' . asset($result['path']));

                return self::SUCCESS;
            }

            $this->warn('Image generation returned no result, falling back to placeholder...');

            return $this->generatePlaceholder($width, $height, $outputDir, $rotate);
        } catch (\Exception $e) {
            $this->error("Generation failed: {$e->getMessage()}");
            $this->info('Falling back to placeholder generation...');

            return $this->generatePlaceholder($width, $height, $outputDir, $rotate);
        }
    }

    /**
     * Build the image generation prompt.
     */
    protected function buildPrompt(string $style, string $theme, ?string $custom): string
    {
        if ($custom) {
            return $custom;
        }

        $stylePrompt = $this->styles[$style] ?? $this->styles['newspaper'];
        $themePrompt = $this->themes[$theme] ?? $this->themes['bahrain'];

        return 'Newspaper header cover image for Jareeda Bahrain news website. '
            . "{$stylePrompt}. "
            . "Featuring {$themePrompt}. "
            . 'Professional editorial design, high quality, 4K resolution, '
            . 'suitable for a major news publication website header.';
    }

    /**
     * Generate a placeholder cover image using SVG.
     */
    protected function generatePlaceholder(int $width, int $height, string $outputDir, bool $rotate): int
    {
        $timestamp = time();
        $filename = "cover_{$timestamp}.svg";
        $path = public_path($outputDir);

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $filepath = "{$path}/{$filename}";

        // Generate a sophisticated newspaper-style SVG cover
        $svg = $this->createNewspaperCoverSvg($width, $height);

        file_put_contents($filepath, $svg);

        $this->newLine();
        $this->info('✅ Placeholder cover image generated!');

        if ($rotate) {
            $this->rotateCover("storage/cover/{$filename}");
        }

        $this->info("   Path: storage/cover/{$filename}");
        $this->info('   URL: ' . asset("storage/cover/{$filename}"));

        return self::SUCCESS;
    }

    /**
     * Create a newspaper-style SVG cover image.
     */
    protected function createNewspaperCoverSvg(int $width, int $height): string
    {
        $date = now()->format('l, F j, Y');
        $arabicDate = now()->locale('ar')->format('l، j F Y');

        // Generate dynamic colors based on current time
        $hour = (int) now()->format('H');
        if ($hour >= 6 && $hour < 12) {
            // Morning - warm golden
            $bgGradient = ['#1a1a2e', '#16213e', '#0f3460'];
            $accentColor = '#e94560';
            $textColor = '#eaeaea';
        } elseif ($hour >= 12 && $hour < 18) {
            // Afternoon - deep blue
            $bgGradient = ['#0c0c1d', '#1a1a3e', '#2d2d5e'];
            $accentColor = '#f39c12';
            $textColor = '#ecf0f1';
        } else {
            // Evening - dark elegant
            $bgGradient = ['#0d0d0d', '#1a1a1a', '#2d2d2d'];
            $accentColor = '#c0392b';
            $textColor = '#bdc3c7';
        }

        // Pre-compute values for heredoc
        $halfW = intdiv($width, 2);
        $halfH = intdiv($height, 2);
        $borderW60 = $width - 60;
        $borderH60 = $height - 60;
        $borderW80 = $width - 80;
        $borderH80 = $height - 80;
        $cornerX50 = $width - 50;
        $cornerX70 = $width - 70;
        $cornerX55 = $width - 55;
        $cornerY50 = $height - 50;
        $cornerY70 = $height - 70;
        $cornerY55 = $height - 55;
        $titleSize = (int) ($height * 0.12);
        $subtitleSize = (int) ($height * 0.04);
        $dateSize = (int) ($height * 0.018);
        $editionSize = (int) ($height * 0.012);
        $titleY = $halfH - 60;
        $subtitleY = $halfH + 10;
        $dateLineY = $halfH + 50;
        $bottomLineY1 = $height - 80;
        $bottomLineY2 = $height - 75;
        $editionY = $height - 45;

        return <<<SVG
        <svg xmlns="http://www.w3.org/2000/svg" width="{$width}" height="{$height}" viewBox="0 0 {$width} {$height}">
          <defs>
            <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:{$bgGradient[0]}"/>
              <stop offset="50%" style="stop-color:{$bgGradient[1]}"/>
              <stop offset="100%" style="stop-color:{$bgGradient[2]}"/>
            </linearGradient>
            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
              <path d="M 40 0 L 0 0 0 40" fill="none" stroke="{$textColor}" stroke-width="0.3" opacity="0.1"/>
            </pattern>
            <pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse">
              <circle cx="10" cy="10" r="1" fill="{$textColor}" opacity="0.08"/>
            </pattern>
          </defs>

          <!-- Background -->
          <rect width="{$width}" height="{$height}" fill="url(#bg)"/>
          <rect width="{$width}" height="{$height}" fill="url(#grid)"/>
          <rect width="{$width}" height="{$height}" fill="url(#dots)"/>

          <!-- Decorative border -->
          <rect x="30" y="30" width="{$borderW60}" height="{$borderH60}" fill="none" stroke="{$textColor}" stroke-width="1" opacity="0.2"/>
          <rect x="40" y="40" width="{$borderW80}" height="{$borderH80}" fill="none" stroke="{$textColor}" stroke-width="0.5" opacity="0.15"/>

          <!-- Top decorative line -->
          <line x1="60" y1="80" x2="{$borderW60}" y2="80" stroke="{$accentColor}" stroke-width="2" opacity="0.8"/>
          <line x1="60" y1="85" x2="{$borderW60}" y2="85" stroke="{$textColor}" stroke-width="0.5" opacity="0.3"/>

          <!-- Main title -->
          <text x="{$halfW}" y="{$titleY}" text-anchor="middle" font-family="Georgia, 'Playfair Display', serif" font-size="{$titleSize}" font-weight="900" fill="{$textColor}" letter-spacing="0.15em">JAREEDA</text>

          <!-- Arabic subtitle -->
          <text x="{$halfW}" y="{$subtitleY}" text-anchor="middle" font-family="'Noto Naskh Arabic', 'Amiri', serif" font-size="{$subtitleSize}" fill="{$textColor}" opacity="0.7">جريدة - أخبار البحرين</text>

          <!-- Date line -->
          <text x="{$halfW}" y="{$dateLineY}" text-anchor="middle" font-family="'Inter', sans-serif" font-size="{$dateSize}" fill="{$textColor}" opacity="0.5" letter-spacing="0.2em">{$date}</text>

          <!-- Bottom decorative line -->
          <line x1="60" y1="{$bottomLineY1}" x2="{$borderW60}" y2="{$bottomLineY1}" stroke="{$textColor}" stroke-width="0.5" opacity="0.3"/>
          <line x1="60" y1="{$bottomLineY2}" x2="{$borderW60}" y2="{$bottomLineY2}" stroke="{$accentColor}" stroke-width="2" opacity="0.8"/>

          <!-- Corner decorations -->
          <path d="M 50 50 L 70 50 L 70 55 L 55 55 L 55 70 L 50 70 Z" fill="{$accentColor}" opacity="0.6"/>
          <path d="M {$cornerX50} 50 L {$cornerX70} 50 L {$cornerX70} 55 L {$cornerX55} 55 L {$cornerX55} 70 L {$cornerX50} 70 Z" fill="{$accentColor}" opacity="0.6"/>
          <path d="M 50 {$cornerY50} L 70 {$cornerY50} L 70 {$cornerY55} L 55 {$cornerY55} L 55 {$cornerY70} L 50 {$cornerY70} Z" fill="{$accentColor}" opacity="0.6"/>
          <path d="M {$cornerX50} {$cornerY50} L {$cornerX70} {$cornerY50} L {$cornerX70} {$cornerY55} L {$cornerX55} {$cornerY55} L {$cornerX55} {$cornerY70} L {$cornerX50} {$cornerY70} Z" fill="{$accentColor}" opacity="0.6"/>

          <!-- Edition text -->
          <text x="{$halfW}" y="{$editionY}" text-anchor="middle" font-family="'Inter', sans-serif" font-size="{$editionSize}" fill="{$textColor}" opacity="0.35" letter-spacing="0.3em">DIGITAL EDITION</text>
        </svg>
        SVG;
    }

    /**
     * Rotate (replace) the current cover image.
     */
    protected function rotateCover(string $newPath): void
    {
        $coverDir = public_path('storage/cover');

        if (!is_dir($coverDir)) {
            mkdir($coverDir, 0755, true);
        }

        // Find and rename old covers
        $oldCovers = glob($coverDir . '/cover_current.*');
        foreach ($oldCovers as $old) {
            $archiveName = str_replace('cover_current', 'cover_' . date('Y-m-d_His'), $old);
            rename($old, $archiveName);
        }

        // Copy new cover as current
        $source = public_path($newPath);
        $dest = $coverDir . '/cover_current' . '.' . pathinfo($newPath, PATHINFO_EXTENSION);

        if (file_exists($source)) {
            copy($source, $dest);
            $this->info('   Rotated: New cover set as current');
        }
    }
}
