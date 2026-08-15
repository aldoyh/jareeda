<?php

use App\Http\Controllers\Admin\AiImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AI Image Generation Routes
|--------------------------------------------------------------------------
|
| These routes handle AI image generation for articles.
| Add these routes to your admin routes file or include this file.
|
| Usage in bootstrap/app.php or routes/admin.php:
|   require __DIR__ . '/../routes/ai-image.php';
|
*/

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // AI Image Generation endpoints
    Route::post('/news/{articleId}/generate-image', [AiImageController::class, 'generate'])
        ->name('admin.news.generate-image');

    Route::post('/news/{articleId}/queue-generate-image', [AiImageController::class, 'queueGenerate'])
        ->name('admin.news.queue-generate-image');

    Route::get('/news/{articleId}/image-status', [AiImageController::class, 'status'])
        ->name('admin.news.image-status');

    Route::delete('/news/{articleId}/clear-ai-image', [AiImageController::class, 'clear'])
        ->name('admin.news.clear-ai-image');
});
