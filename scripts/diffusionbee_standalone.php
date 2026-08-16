<?php

declare(strict_types=1);

/**
 * DiffusionBee Standalone Image Generator
 *
 * Communicates with DiffusionBee backend via stdin/stdout JSON protocol.
 * Uses proc_open for persistent process communication.
 *
 * Usage:
 *   php scripts/diffusionbee_standalone.php --prompt="A photo of..." --count=1
 *   php scripts/diffusionbee_standalone.php --health
 */
$args = parseOptions($argv);

if (isset($args['health'])) {
    checkHealth();
    exit(0);
}

if (empty($args['prompt'])) {
    fwrite(STDERR, "Error: --prompt is required\n");
    fwrite(STDERR, "Usage: php diffusionbee_standalone.php --prompt=\"...\" --count=1\n");
    exit(1);
}

$prompt = $args['prompt'];
$count = (int) ($args['count'] ?? 1);
$model = $args['model'] ?? 'FLUX.1-dev';
$width = (int) ($args['width'] ?? 1152);
$height = (int) ($args['height'] ?? 768);
$steps = (int) ($args['steps'] ?? 40);
$guidance = (float) ($args['guidance'] ?? 4.0);

$backend = '/Applications/DiffusionBee.app/Contents/Resources/core/diffusionbee_backend';

if (!file_exists($backend)) {
    fwrite(STDERR, "Error: DiffusionBee backend not found at {$backend}\n");
    fwrite(STDERR, "Install DiffusionBee from https://diffusionbee.com\n");
    exit(1);
}

$generatedImages = [];

for ($i = 0; $i < $count; $i++) {
    fwrite(STDERR, 'Generating image ' . ($i + 1) . "/{$count}...\n");
    $imagePath = generateImage($backend, $prompt, $model, $width, $height, $steps, $guidance);
    if ($imagePath) {
        $generatedImages[] = $imagePath;
        fwrite(STDERR, "  ✓ Generated: {$imagePath}\n");
    } else {
        fwrite(STDERR, "  ✗ Failed to generate image\n");
    }
}

$result = [
    'success' => count($generatedImages) > 0,
    'images' => $generatedImages,
    'count' => count($generatedImages),
    'prompt' => $prompt,
];

echo json_encode($result) . "\n";

exit(count($generatedImages) > 0 ? 0 : 1);

/**
 * Generate a single image using DiffusionBee backend with proc_open.
 */
function generateImage(string $backend, string $prompt, string $model, int $width, int $height, int $steps, float $guidance): ?string
{
    $descriptors = [
        0 => ['pipe', 'r'],  // stdin
        1 => ['pipe', 'w'],  // stdout
        2 => ['pipe', 'w'],  // stderr
    ];

    $process = proc_open($backend, $descriptors, $pipes);

    if (!is_resource($process)) {
        fwrite(STDERR, "Failed to start DiffusionBee backend\n");

        return null;
    }

    // Make stdout non-blocking for polling
    stream_set_blocking($pipes[1], false);

    // Step 1: Initialize backend
    fwrite($pipes[0], "b2py strt\n");
    fflush($pipes[0]);

    // Wait for backend to initialize — look for "got b2py strt"
    $initOutput = '';
    $maxInitWait = 30;
    $initWaited = 0;

    while ($initWaited < $maxInitWait) {
        $chunk = @fread($pipes[1], 8192);
        if ($chunk !== false && $chunk !== '') {
            $initOutput .= $chunk;
            if (str_contains($initOutput, 'got b2py strt')) {
                break;
            }
        }
        usleep(500000); // 500ms
        $initWaited++;
    }

    if (!str_contains($initOutput, 'got b2py strt')) {
        fwrite(STDERR, "Backend initialization timeout\n");
        cleanup($process, $pipes);

        return null;
    }

    // Step 2: Send generation command
    $settings = [
        'prompt' => $prompt,
        'negative_prompt' => 'blurry, low quality, watermark, text, deformed, ugly',
        'selected_sd_model' => $model,
        'img_width' => $width,
        'img_height' => $height,
        'num_imgs' => 1,
        'num_steps' => $steps,
        'guidance_scale' => $guidance,
        'scheduler' => 'k_euler',
    ];

    $jsonSettings = json_encode($settings, JSON_THROW_ON_ERROR);
    fwrite($pipes[0], "b2py t2im {$jsonSettings}\n");
    fflush($pipes[0]);

    // Step 3: Monitor stdout for the generated image
    $output = '';
    $imagePath = null;
    $maxWait = 300; // 5 minutes max
    $waited = 0;

    while ($waited < $maxWait) {
        $chunk = @fread($pipes[1], 8192);
        if ($chunk !== false && $chunk !== '') {
            $output .= $chunk;

            // Look for "sdbk nwim" which indicates image was generated
            if (preg_match('/sdbk nwim\s*(\{.*\})/', $output, $matches)) {
                $resultJson = json_decode($matches[1], true);
                if ($resultJson && isset($resultJson['generated_img_path'])) {
                    $imagePath = $resultJson['generated_img_path'];
                    break;
                }
            }

            // Also check for file path pattern
            if (preg_match('/generated_img_path["\s:]+([^\s"]+\.png)/', $output, $matches)) {
                $imagePath = $matches[1];
                break;
            }
        }

        // Check if process died
        $status = proc_get_status($process);
        if (!$status['running']) {
            // Read remaining output
            $remaining = @stream_get_contents($pipes[1]);
            $output .= $remaining;
            fwrite(STDERR, "Backend process exited unexpectedly\n");
            break;
        }

        usleep(1000000); // 1 second
        $waited++;
    }

    cleanup($process, $pipes);

    return $imagePath;
}

/**
 * Clean up process and pipes.
 */
function cleanup($process, array $pipes): void
{
    foreach ($pipes as $pipe) {
        if (is_resource($pipe)) {
            fclose($pipe);
        }
    }
    proc_close($process);
}

/**
 * Check DiffusionBee health.
 */
function checkHealth(): void
{
    $backend = '/Applications/DiffusionBee.app/Contents/Resources/core/diffusionbee_backend';

    $checks = [
        'Backend exists' => file_exists($backend),
        'Backend executable' => file_exists($backend) && is_executable($backend),
        'Output directory' => is_dir(getenv('HOME') . '/.diffusionbee/images'),
    ];

    echo "DiffusionBee Health Check\n";
    echo str_repeat('-', 40) . "\n";

    $allPassed = true;
    foreach ($checks as $name => $passed) {
        $status = $passed ? '✓' : '✗';
        echo "{$status} {$name}\n";
        if (!$passed) {
            $allPassed = false;
        }
    }

    echo str_repeat('-', 40) . "\n";
    echo ($allPassed ? 'All checks passed' : 'Some checks failed') . "\n";
}

/**
 * Parse command-line options.
 */
function parseOptions(array $argv): array
{
    $options = [];
    for ($i = 1; $i < count($argv); $i++) {
        $arg = $argv[$i];
        if (str_starts_with($arg, '--')) {
            $parts = explode('=', mb_substr($arg, 2), 2);
            $key = $parts[0];
            $value = $parts[1] ?? true;
            $options[$key] = $value;
        }
    }

    return $options;
}
