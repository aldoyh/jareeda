<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Throwable;

class ArticleImageGenerationFailedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public \Illuminate\Database\Eloquent\Model $article,
        public ?Throwable $exception = null
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
        $errorMessage = $this->exception?->getMessage() ?? 'Unknown error';

        return (new MailMessage())
            ->subject("AI Image Generation Failed: {$articleTitle}")
            ->line("AI image generation failed for the article: **{$articleTitle}**")
            ->line("**Error:** {$errorMessage}")
            ->action('View Article', $articleUrl)
            ->line('Please upload an image manually or try again later.');
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
            'error' => $this->exception?->getMessage() ?? 'Unknown error',
            'message' => 'AI image generation failed. Please upload an image manually.',
        ];
    }
}
