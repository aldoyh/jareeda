<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateArticleImage;
use App\Services\UnslothImageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AiImageController extends Controller
{
    /**
     * Generate an AI image for an article.
     */
    public function generate(Request $request, int $articleId, UnslothImageService $unsloth): JsonResponse
    {
        try {
            // Get the article
            $article = DB::table('news')->find($articleId);

            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found',
                ], 404);
            }

            // Check if article already has an image
            if ($article->image && !$request->input('force')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article already has an image. Use force=true to regenerate.',
                ], 422);
            }

            // Check if Unsloth is healthy
            if (!$unsloth->isHealthy()) {
                return response()->json([
                    'success' => false,
                    'message' => 'AI image generation service is not available. Please try again later.',
                ], 503);
            }

            // Build prompt
            $customPrompt = $request->input('prompt');
            $prompt = $customPrompt ?? $unsloth->buildPrompt(
                $article->title_en ?? $article->title ?? '',
                $article->excerpt_en ?? $article->excerpt ?? null
            );

            // Generate the image
            $result = $unsloth->generate($prompt, [
                'width' => $request->input('width', config('unsloth.image.width')),
                'height' => $request->input('height', config('unsloth.image.height')),
            ]);

            // Update the article
            DB::table('news')->where('id', $articleId)->update([
                'ai_generated_image' => true,
                'ai_generated_image_path' => $result['path'],
                'ai_image_prompt' => $prompt,
                'ai_image_seed' => $result['seed'],
                'ai_generated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Image generated successfully',
                'image_path' => $result['path'],
                'image_url' => $result['url'],
                'seed' => $result['seed'],
            ]);

        } catch (Exception $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate image: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Queue image generation for background processing.
     */
    public function queueGenerate(Request $request, int $articleId): JsonResponse
    {
        try {
            // Get the article
            $article = DB::table('news')->find($articleId);

            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found',
                ], 404);
            }

            // Dispatch the job
            GenerateArticleImage::dispatch(
                $articleId,
                $request->input('prompt'),
                $request->only(['width', 'height', 'steps', 'guidance'])
            );

            return response()->json([
                'success' => true,
                'message' => 'Image generation queued successfully',
                'job_status_url' => url("/admin/news/{$articleId}/image-status"),
            ]);

        } catch (Exception $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Failed to queue image generation: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get the status of image generation for an article.
     */
    public function status(int $articleId): JsonResponse
    {
        $article = DB::table('news')->find($articleId);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'has_image' => (bool) $article->image,
            'has_ai_image' => (bool) $article->ai_generated_image,
            'ai_image_path' => $article->ai_generated_image_path,
            'ai_generated_at' => $article->ai_generated_at,
        ]);
    }

    /**
     * Clear the AI-generated image for an article.
     */
    public function clear(int $articleId): JsonResponse
    {
        try {
            $article = DB::table('news')->find($articleId);

            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found',
                ], 404);
            }

            // Clear AI image fields
            DB::table('news')->where('id', $articleId)->update([
                'ai_generated_image' => false,
                'ai_generated_image_path' => null,
                'ai_image_prompt' => null,
                'ai_image_seed' => null,
                'ai_generated_at' => null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'AI image cleared successfully',
            ]);

        } catch (Exception $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Failed to clear AI image: ' . $e->getMessage(),
            ], 500);
        }
    }
}
