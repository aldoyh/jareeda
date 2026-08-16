<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Unsloth API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Unsloth AI image generation integration.
    | Unsloth provides an OpenAI-compatible API for local image generation.
    |
    | @see https://unsloth.ai/docs/integrations/connections
    |
    */

    /*
    |--------------------------------------------------------------------------
    | API Endpoint
    |--------------------------------------------------------------------------
    |
    | The URL where Unsloth API is running. Default is localhost:8888.
    | Change this if Unsloth is running on a different server.
    |
    */

    'api_endpoint' => env('UNSLOTH_API_ENDPOINT', 'http://localhost:8888'),

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Optional API key for authentication. Leave empty if not required.
    |
    */

    'api_key' => env('UNSLOTH_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Default Model
    |--------------------------------------------------------------------------
    |
    | The default FLUX2 model to use for image generation.
    |
    | Supported models:
    | - "flux2-klein-4b"  : Fast, low VRAM (4GB), good for development
    | - "flux2-klein-9b"  : Medium speed, medium VRAM (8GB)
    | - "flux2-dev"       : Best quality, requires 12GB+ VRAM
    |
    */

    'model' => env('UNSLOTH_MODEL', 'unsloth/FLUX.2-klein-4B-GGUF'),

    /*
    |--------------------------------------------------------------------------
    | GGUF Filename
    |--------------------------------------------------------------------------
    |
    | The GGUF filename for image models. Required for GGUF model loading.
    |
    */

    'gguf_filename' => env('UNSLOTH_GGUF_FILENAME', 'flux-2-klein-4b-Q4_K_M.gguf'),

    /*
    |--------------------------------------------------------------------------
    | Model Load Endpoint
    |--------------------------------------------------------------------------
    |
    | The endpoint to load image models. Unsloth Studio uses /api/inference/images/load.
    |
    */

    'load_endpoint' => env('UNSLOTH_LOAD_ENDPOINT', '/api/inference/images/load'),

    /*
    |--------------------------------------------------------------------------
    | Image Storage
    |--------------------------------------------------------------------------
    |
    | Where to store generated images.
    |
    */

    'storage' => [
        'disk' => env('UNSLOTH_STORAGE_DISK', 'public'),
        'path' => env('UNSLOTH_STORAGE_PATH', 'ai-generated'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Settings
    |--------------------------------------------------------------------------
    |
    | Default settings for image generation.
    |
    */

    'image' => [
        'width' => env('UNSLOTH_IMAGE_WIDTH', 1024),
        'height' => env('UNSLOTH_IMAGE_HEIGHT', 768),
        'steps' => env('UNSLOTH_IMAGE_STEPS', 30),
        'guidance' => env('UNSLOTH_IMAGE_GUIDANCE', 4.0),
        'seed' => env('UNSLOTH_IMAGE_SEED', null), // null = random
    ],

    /*
    |--------------------------------------------------------------------------
    | Prompt Template
    |--------------------------------------------------------------------------
    |
    | Default prompt template for newspaper illustrations.
    | The {title} and {excerpt} placeholders will be replaced.
    |
    */

    'prompt_template' => env(
        'UNSLOTH_PROMPT_TEMPLATE',
        'Editorial photograph illustration for news article: "{title}". ' .
        'Professional journalistic photography style, clean composition, ' .
        'appropriate for newspaper publication. High quality, detailed, realistic.'
    ),

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    |
    | Settings for the image generation queue.
    |
    */

    'queue' => [
        'connection' => env('UNSLOTH_QUEUE_CONNECTION', 'redis'),
        'queue' => env('UNSLOTH_QUEUE_NAME', 'ai-images'),
        'timeout' => env('UNSLOTH_QUEUE_TIMEOUT', 120), // seconds
        'tries' => env('UNSLOTH_QUEUE_TRIES', 3),
        'retry_after' => env('UNSLOTH_QUEUE_RETRY_AFTER', 60), // seconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Generation Trigger
    |--------------------------------------------------------------------------
    |
    | When to automatically generate images for articles without images.
    |
    | Options:
    | - "on_save"    : Generate when article is saved without image
    | - "manual"     : Only generate when editor clicks button
    | - "background" : Periodically scan for imageless articles
    |
    */

    'trigger' => env('UNSLOTH_TRIGGER', 'on_save'),

    /*
    |--------------------------------------------------------------------------
    | Editorial Review
    |--------------------------------------------------------------------------
    |
    | Whether AI-generated images require editorial review before publishing.
    |
    */

    'require_review' => env('UNSLOTH_REQUIRE_REVIEW', true),

    /*
    |--------------------------------------------------------------------------
    | Health Check
    |--------------------------------------------------------------------------
    |
    | Settings for monitoring Unsloth service health.
    |
    */

    'health_check' => [
        'enabled' => env('UNSLOTH_HEALTH_CHECK_ENABLED', true),
        'interval' => env('UNSLOTH_HEALTH_CHECK_INTERVAL', 60), // seconds
        'timeout' => env('UNSLOTH_HEALTH_CHECK_TIMEOUT', 5), // seconds
    ],

];
