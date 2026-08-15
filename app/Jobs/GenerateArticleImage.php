<?php

namespace App\Jobs;

use App\Services\UnslothImageService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateArticleImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public int $backoff;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     */
    public int $maxExceptions = 3;

    /**
     * Create a new job instance.
     *
     * @param int $articleId The article ID to generate an image for
     * @param string|null $customPrompt Optional custom prompt override
     * @param array $options Additional generation options
     */
    public function __construct(
        public int $articleId,
        public ?string $customPrompt = null,
        public array $options = []
    ) {
        $this->tries = config('unsloth.queue.tries', 3);
        $this->backoff = config('unsloth.queue.retry_after', 60);
        $this->queue = config('unsloth.queue.queue', 'ai-images');
        $this->connection = config('unsloth.queue.connection', 'redis');
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle(UnslothImageService $unsloth): void
    {
        $article = $this->getArticle();

        if (!$article) {
            Log::warning("GenerateArticleImage: Article {$this->articleId} not found");

            return;
        }

        // Check if article already has an image
        if ($article->image || $article->ai_generated_image) {
            Log::info("GenerateArticleImage: Article {$this->articleId} already has an image");

            return;
        }

        // Check if Unsloth is healthy
        if (!$unsloth->isHealthy()) {
            Log::error('GenerateArticleImage: Unsloth service is not healthy');

            throw new Exception('Unsloth service is not healthy');
        }

        // Build the prompt
        $prompt = $this->customPrompt ?? $unsloth->buildPrompt(
            $article->title,
            $article->excerpt,
            $article->categories->first()?->title
        );

        Log::info("GenerateArticleImage: Generating image for article {$this->articleId}", [
            'prompt' => $prompt,
        ]);

        // Generate the image
        $result = $unsloth->generate($prompt, $this->options);

        // Update the article
        $article->update([
            'ai_generated_image' => true,
            'ai_generated_image_path' => $result['path'],
            'ai_image_prompt' => $prompt,
            'ai_image_seed' => $result['seed'],
            'ai_generated_at' => now(),
        ]);

        // Dispatch event
        event(new \App\Events\ArticleImageGenerated($article, $result));

        Log::info("GenerateArticleImage: Image generated for article {$this->articleId}", [
            'path' => $result['path'],
            'seed' => $result['seed'],
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        Log::error("GenerateArticleImage: Failed for article {$this->articleId}", [
            'error' => $exception?->getMessage(),
            'attempt' => $this->attempts(),
        ]);

        // Dispatch failure event
        $article = $this->getArticle();
        if ($article) {
            event(new \App\Events\ArticleImageGenerationFailed($article, $exception));
        }
    }

    /**
     * Get the article model.
     */
    protected function getArticle(): ?\Illuminate\Database\Eloquent\Model
    {
        // Try to find the article model - adjust based on your model location
        $modelClass = config('unsloth.article_model', \TypiCMS\Modules\News\Models\News::class);

        if (!class_exists($modelClass)) {
            // Fallback to generic query
            return \DB::table('news')->find($this->articleId);
        }

        return $modelClass::find($this->articleId);
    }
}
