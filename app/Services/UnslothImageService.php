<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UnslothImageService
{
    protected string $apiEndpoint;

    protected string $apiKey;

    protected string $model;

    protected string $storageDisk;

    protected string $storagePath;

    public function __construct()
    {
        $this->apiEndpoint = config('unsloth.api_endpoint', 'http://localhost:8888');
        $this->apiKey = config('unsloth.api_key', '');
        $this->model = config('unsloth.model', 'flux2-dev');
        $this->storageDisk = config('unsloth.storage.disk', 'public');
        $this->storagePath = config('unsloth.storage.path', 'ai-generated');
    }

    /**
     * Generate an image using Unsloth FLUX2.
     *
     * @param string $prompt The prompt describing the image to generate
     * @param array $options Additional generation options
     * @return array{path: string, url: string, seed: int|null}
     *
     * @throws Exception
     */
    public function generate(string $prompt, array $options = []): array
    {
        $width = $options['width'] ?? config('unsloth.image.width', 1024);
        $height = $options['height'] ?? config('unsloth.image.height', 768);
        $seed = $options['seed'] ?? config('unsloth.image.seed');

        // Ensure the image model is loaded
        $this->ensureModelLoaded();

        $payload = [
            'model' => $options['model'] ?? $this->model,
            'prompt' => $prompt,
            'n' => 1,
            'size' => "{$width}x{$height}",
        ];

        if ($seed !== null) {
            $payload['seed'] = (int) $seed;
        }

        $response = $this->makeRequest('/v1/images/generations', $payload);

        if (!isset($response['data'][0])) {
            throw new Exception('No image data returned from Unsloth API');
        }

        $imageData = $response['data'][0];
        $imageContent = $this->decodeImage($imageData);
        $fileName = $this->generateFileName();
        $path = "{$this->storagePath}/{$fileName}";

        Storage::disk($this->storageDisk)->put($path, $imageContent);

        $url = Storage::disk($this->storageDisk)->url($path);

        return [
            'path' => $path,
            'url' => $url,
            'seed' => $imageData['seed'] ?? $seed,
            'revised_prompt' => $imageData['revised_prompt'] ?? $prompt,
        ];
    }

    /**
     * Ensure the image model is loaded before generation.
     */
    protected function ensureModelLoaded(): void
    {
        $status = $this->makeRequest('/api/inference/images/status');

        if (!empty($status['loaded'])) {
            return;
        }

        // Load the model
        $loadEndpoint = config('unsloth.load_endpoint', '/api/inference/images/load');
        $ggufFilename = config('unsloth.gguf_filename', 'flux-2-klein-4b-Q4_K_M.gguf');

        $this->makeRequest($loadEndpoint, [
            'model_path' => $this->model,
            'gguf_filename' => $ggufFilename,
            'model_kind' => 'gguf',
        ]);

        // Wait for model to load (poll status)
        $maxAttempts = 30;
        $attempt = 0;
        while ($attempt < $maxAttempts) {
            sleep(2);
            $status = $this->makeRequest('/api/inference/images/status');
            if (!empty($status['loaded'])) {
                return;
            }
            $attempt++;
        }

        throw new Exception('Failed to load image model within timeout');
    }

    /**
     * Generate a prompt for a newspaper article.
     *
     * @param string $title The article title
     * @param string|null $excerpt The article excerpt
     * @param string|null $category The article category
     */
    public function buildPrompt(string $title, ?string $excerpt = null, ?string $category = null): string
    {
        $template = config('unsloth.prompt_template');

        $prompt = str_replace(
            ['{title}', '{excerpt}', '{category}'],
            [$title, $excerpt ?? '', $category ?? ''],
            $template
        );

        // Add category-specific styling if available
        if ($category) {
            $categoryPrompts = [
                'politics' => 'Political news photography, official setting, professional.',
                'economy' => 'Business and finance photography, charts, professional environment.',
                'sports' => 'Sports action photography, dynamic composition, athletic.',
                'culture' => 'Cultural event photography, artistic, vibrant.',
                'technology' => 'Technology and innovation photography, modern, futuristic.',
            ];

            $categoryLower = mb_strtolower($category);
            foreach ($categoryPrompts as $key => $categoryPrompt) {
                if (str_contains($categoryLower, $key)) {
                    $prompt .= ' ' . $categoryPrompt;
                    break;
                }
            }
        }

        return $prompt;
    }

    /**
     * Check if the Unsloth service is healthy.
     */
    public function isHealthy(): bool
    {
        try {
            $request = Http::timeout(config('unsloth.health_check.timeout', 5));

            if ($this->apiKey) {
                $request = $request->withHeader('Authorization', "Bearer {$this->apiKey}");
            }

            $response = $request->get("{$this->apiEndpoint}/v1/models");

            return $response->successful();
        } catch (Exception) {
            return false;
        }
    }

    /**
     * Get available models from Unsloth.
     */
    public function getAvailableModels(): array
    {
        try {
            $response = $this->makeRequest('/v1/models');

            return $response['data'] ?? [];
        } catch (Exception) {
            return [];
        }
    }

    /**
     * Make an API request to Unsloth.
     *
     *
     * @throws Exception
     */
    protected function makeRequest(string $endpoint, array $payload = []): array
    {
        $request = Http::timeout(120) // 2 minute timeout for image generation
            ->withHeaders([
                'Content-Type' => 'application/json',
            ]);

        if ($this->apiKey) {
            $request = $request->withHeader('Authorization', "Bearer {$this->apiKey}");
        }

        $url = "{$this->apiEndpoint}{$endpoint}";

        $response = $payload
            ? $request->post($url, $payload)
            : $request->get($url);

        if ($response->failed()) {
            throw new Exception(
                "Unsloth API request failed: {$response->status()} - {$response->body()}"
            );
        }

        return $response->json();
    }

    /**
     * Decode image data from API response.
     *
     *
     * @throws Exception
     */
    protected function decodeImage(array $imageData): string
    {
        if (isset($imageData['b64_json'])) {
            return base64_decode($imageData['b64_json']);
        }

        if (isset($imageData['url'])) {
            $response = Http::get($imageData['url']);

            if ($response->failed()) {
                throw new Exception('Failed to download image from URL');
            }

            return $response->body();
        }

        throw new Exception('No image data or URL in response');
    }

    /**
     * Generate a unique filename for the image.
     */
    protected function generateFileName(): string
    {
        return 'ai-' . Str::uuid() . '.png';
    }
}
