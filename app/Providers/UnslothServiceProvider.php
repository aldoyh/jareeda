<?php

namespace App\Providers;

use App\Services\UnslothImageService;
use Illuminate\Support\ServiceProvider;

class UnslothServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UnslothImageService::class, function ($app) {
            return new UnslothImageService();
        });

        $this->app->alias(UnslothImageService::class, 'unsloth');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/../../config/unsloth.php' => config_path('unsloth.php'),
        ], 'unsloth-config');

        // Publish migration
        $this->publishes([
            __DIR__ . '/../../database/migrations/2026_08_13_000001_add_ai_image_fields_to_news_table.php' => database_path('migrations'),
        ], 'unsloth-migrations');
    }
}
