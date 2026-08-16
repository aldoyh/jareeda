<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $slug
 * @property array<string, mixed> $title
 * @property array<string, mixed>|null $body
 * @property array<string, mixed>|null $excerpt
 * @property string|null $url
 * @property string|null $source
 * @property string|null $author
 * @property string|null $image
 * @property string|null $image_alt
 * @property bool $ai_generated_image
 * @property string|null $ai_generated_image_path
 * @property string|null $category
 * @property string $language
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property bool $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'slug',
        'title',
        'body',
        'excerpt',
        'url',
        'source',
        'author',
        'image',
        'image_alt',
        'ai_generated_image',
        'ai_generated_image_path',
        'category',
        'language',
        'published_at',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'body' => 'array',
            'excerpt' => 'array',
            'ai_generated_image' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Get the title for the current locale.
     */
    public function getTitle(?string $locale = null): string
    {
        $locale ??= app()->getLocale();

        return $this->title[$locale] ?? $this->title['en'] ?? '';
    }

    /**
     * Get the body for the current locale.
     */
    public function getBody(?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();

        return $this->body[$locale] ?? $this->body['en'] ?? null;
    }

    /**
     * Get the excerpt for the current locale.
     */
    public function getExcerpt(?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();

        return $this->excerpt[$locale] ?? $this->excerpt['en'] ?? null;
    }

    /**
     * Get the featured image URL.
     *
     * Handles three cases:
     * 1. AI-generated images stored via ai_generated_image_path
     * 2. Relative paths like 'news/filename.jpg'
     * 3. Full URLs from RSS feeds (returns as-is)
     * 4. Legacy localhost URLs converted to asset() paths
     */
    public function getFeaturedImageUrl(): ?string
    {
        if ($this->ai_generated_image && $this->ai_generated_image_path) {
            return asset('storage/' . $this->ai_generated_image_path);
        }

        if (empty($this->image)) {
            return null;
        }

        // If it's already a full external URL (not localhost), use it directly
        if (str_starts_with($this->image, 'http') && !str_contains($this->image, 'localhost')) {
            return $this->image;
        }

        // Convert localhost URLs to asset() paths
        if (str_contains($this->image, 'localhost')) {
            $path = parse_url($this->image, PHP_URL_PATH);
            if ($path) {
                // Remove leading /storage/ and prepend 'storage/'
                $relative = mb_ltrim($path, '/');
                if (str_starts_with($relative, 'storage/')) {
                    return asset($relative);
                }

                return asset('storage/' . $relative);
            }
        }

        // If it's a relative path, wrap with asset()
        if (!str_starts_with($this->image, 'http')) {
            // If already includes 'storage/', don't double it
            if (str_starts_with($this->image, 'storage/')) {
                return asset($this->image);
            }

            return asset('storage/' . mb_ltrim($this->image, '/'));
        }

        return $this->image;
    }

    /**
     * Scope: published articles only.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now())
            ->whereNotNull('published_at');
    }

    /**
     * Scope: articles from the last N days.
     */
    public function scopeRecent(Builder $query, int $days = 7): Builder
    {
        return $query->where('published_at', '>=', now()->subDays($days));
    }

    /**
     * Scope: articles by language.
     */
    public function scopeForLanguage(Builder $query, string $language): Builder
    {
        return $query->where('language', $language);
    }

    /**
     * Scope: featured articles.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Check if this article has a featured image.
     */
    public function hasImage(): bool
    {
        return filled($this->image) || filled($this->ai_generated_image_path);
    }

    /**
     * Get the route key name.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
