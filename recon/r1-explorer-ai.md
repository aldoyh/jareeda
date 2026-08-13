---
title: "R1 Explorer: AI Image Generation Research"
date: 2026-08-13
agent: explorer
round: 1
---

## Unsloth AI Overview

Unsloth is an open-source desktop application for running and training AI models locally. Key features:

- **No-code interface** — Generate images without programming
- **Local execution** — All processing happens on your hardware
- **Multiple models** — FLUX, SDXL, Z-Image, Qwen-Image, and more
- **OpenAI-compatible API** — Existing apps can connect via familiar interface

## FLUX2 Models

Unsloth offers several FLUX2 variants:

1. **FLUX.2-dev** — Best quality, requires more VRAM (12GB+ recommended)
2. **FLUX.2-klein** — Smaller, faster, good for quick generation (4GB VRAM)
3. **FLUX.2 with LoRA** — Fine-tuned for specific styles

**For newspaper illustrations:** FLUX.2-dev is recommended for quality. FLUX.2-klein can be used for previews.

## Integration Options

### Option 1: Direct HTTP API

Unsloth exposes an OpenAI-compatible API at `localhost:8888`. Laravel can call it via HTTP:

```php
// Using Laravel's HTTP client
$response = Http::post('http://localhost:8888/v1/images/generations', [
    'model' => 'flux2-dev',
    'prompt' => 'Editorial illustration of...',
    'n' => 1,
    'size' => '1024x1024',
]);
```

**Pros:** Simple, no additional dependencies.
**Cons:** Synchronous, blocks the request.

### Option 2: Queue Job

Process image generation in background:

```php
class GenerateArticleImage implements ShouldQueue
{
    public function handle(UnslothImageService $unsloth)
    {
        $image = $unsloth->generate($this->article->imagePrompt);
        $this->article->update(['image' => $image]);
    }
}
```

**Pros:** Non-blocking, retry logic, progress tracking.
**Cons:** Adds complexity, requires queue setup.

### Option 3: Artisan Command

CLI command for bulk generation:

```php
class GenerateArticleImages extends Command
{
    public function handle()
    {
        Article::withoutImage()->each(function ($article) {
            GenerateArticleImage::dispatch($article);
        });
    }
}
```

**Pros:** Bulk operations, scheduling possible.
**Cons:** Manual trigger needed.

## Prompt Engineering for Newspaper Illustrations

Effective prompts for newspaper-style images:

- **Style keywords:** "editorial illustration", "newspaper style", "journalistic photography"
- **Composition:** "close-up", "wide shot", "portrait", "landscape"
- **Mood:** "serious", "professional", "documentary", "dramatic lighting"
- **Arabic content:** Consider cultural context, modesty, local architecture

**Example prompt:** "Editorial photograph of a modern office building in Manama, Bahrain, professional architectural photography, clear blue sky, documentary style"

## Storage and Processing

Generated images should be stored in:
- `storage/app/public/ai-generated/` — Publicly accessible
- `storage/app/private/ai-generated/` — Before editorial review

**Processing pipeline:**
1. Generate image → Store temporarily
2. Notify editor → Review and approve
3. Move to public storage → Update article
4. Generate thumbnails → For listing pages

## Performance Considerations

- **FLUX.2-dev:** 10-30 seconds per image (depends on VRAM)
- **FLUX.2-klein:** 3-10 seconds per image
- **Queue workers:** Process one image at a time to avoid VRAM exhaustion
- **Caching:** Consider caching generated images for similar prompts

## Recommendations

1. Use queue jobs for production (non-blocking, retry logic)
2. Start with FLUX.2-dev for quality, fallback to FLUX.2-klein for speed
3. Implement editorial review before publishing
4. Store metadata (prompt, model, seed) for reproducibility
5. Consider training a LoRA on newspaper illustration styles
