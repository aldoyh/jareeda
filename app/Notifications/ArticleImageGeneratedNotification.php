<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArticleImageGeneratedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public \Illuminate\Database\Eloquent\Model $article,
        public array $imageResult
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $articleTitle = $this->article->title ?? $this->article->title_en ?? 'Untitled';
        $articleUrl = url("/admin/news/{$this->article->id}/edit");

        $prompt = $this->imageResult['revised_prompt'] ?? 'Auto-generated';

        return (new MailMessage())
            ->subject("AI Image Generated for: {$articleTitle}")
            ->line("An AI-generated image has been created for the article: **{$articleTitle}**")
            ->line("**Prompt used:** {$prompt}")
            ->action('View Article', $articleUrl)
            ->line('Please review the generated image and publish when ready.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'article_id' => $this->article->id,
            'article_title' => $this->article->title ?? $this->article->title_en,
            'image_path' => $this->imageResult['path'],
            'image_seed' => $this->imageResult['seed'] ?? null,
            'prompt' => $this->imageResult['revised_prompt'] ?? null,
            'message' => 'AI image generated successfully. Please review and publish.',
        ];
    }
}
