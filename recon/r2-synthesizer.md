---
title: "R2 Synthesizer: Refined Implementation Plan"
date: 2026-08-13
agent: synthesizer
round: 2
---

## Refined Implementation Plan

Based on Round 2 exploration, here's the refined 4-phase implementation plan:

### Phase 1: Layout Foundation (Week 1-2)

**Goal:** Create newspaper-style welcome screen with columns and justified text.

**Tasks:**
1. Create `resources/scss/public/_newspaper.scss`
   - Multi-column layout rules
   - Justified text styling
   - Column rules (dividers)
   - Typography hierarchy
   - Responsive breakpoints

2. Create Blade partials
   - `resources/views/vendor/core/public/_newspaper-grid.blade.php`
   - `resources/views/vendor/core/public/_article-card.blade.php`

3. Add Arabic font stack
   - Cairo or Tajawal for `[lang=ar]`
   - Line-height: 1.6-1.8
   - Font-display: swap

4. Test with real content
   - English articles
   - Arabic articles
   - Mixed content

**Deliverable:** Working newspaper layout with columns and justified text.

### Phase 2: AI Image Generation (Week 3-4)

**Goal:** Set up Unsloth/FLUX2 for local image generation.

**Tasks:**
1. Set up Unsloth
   - Install FLUX.2-klein-4B for development
   - Configure API endpoint (localhost:8888)
   - Test basic generation

2. Create Laravel integration
   - `config/unsloth.php` — Configuration
   - `app/Services/UnslothImageService.php` — API client
   - `app/Jobs/GenerateArticleImage.php` — Queue job
   - `app/Console/Commands/GenerateArticleImages.php` — Artisan command

3. Add database fields
   - Migration for `ai_generated_image`, `image_prompt`
   - Update Article model

4. Implement queue workers
   - Configure Redis/Database queue
   - Add retry logic (3 attempts)
   - Add health checks

**Deliverable:** Working AI image generation pipeline.

### Phase 3: Editorial Integration (Week 5-6)

**Goal:** Connect layout to AI generation with editorial workflow.

**Tasks:**
1. Admin UI additions
   - "Generate Image" button on article edit page
   - Image preview and regeneration
   - Prompt editing

2. Event system
   - `ArticleSavedWithoutImage` event
   - `ImageGenerated` event
   - Notification system

3. Editorial workflow
   - Image review queue
   - Approve/reject functionality
   - Publish with AI images

4. Responsive images
   - Generate multiple sizes (hero, featured, thumbnail)
   - srcset for responsive display
   - Lazy loading

**Deliverable:** Complete editorial workflow for AI images.

### Phase 4: Polish and Optimization (Week 7-8)

**Goal:** Performance, accessibility, and production readiness.

**Tasks:**
1. Performance optimization
   - Image caching
   - Queue monitoring
   - Resource limits

2. Accessibility audit
   - Screen reader testing
   - Keyboard navigation
   - ARIA landmarks

3. Print styles
   - @media print CSS
   - Single-column for print
   - Include AI images

4. Monitoring and logging
   - Generation metrics
   - Error tracking
   - Performance monitoring

**Deliverable:** Production-ready newspaper layout with AI image generation.

## Key Decisions Needed

1. **Unsloth deployment:** Same server vs. separate GPU server?
2. **FLUX2 model:** FLUX.2-klein vs. FLUX.2-dev?
3. **Queue driver:** Redis vs. Database?
4. **Image storage:** Local vs. S3-compatible?
5. **Editorial review:** Required vs. optional?

## Risk Mitigation

1. **Start with FLUX.2-klein** — Faster development, lower VRAM
2. **Queue everything** — Never block on generation
3. **Placeholder images** — Show immediately, replace when ready
4. **Editorial review** — Required before publishing
5. **Health checks** — Monitor Unsloth service
6. **Retry logic** — 3 attempts with backoff
7. **Dead letter queue** — For permanently failed jobs
8. **Circuit breaker** — Stop if Unsloth is down

## Success Metrics

1. **Layout:** Newspaper-style columns visible on welcome screen
2. **Justification:** Text justified in both English and Arabic
3. **AI Generation:** 90%+ of imageless articles get AI images
4. **Performance:** Image generation < 30 seconds
5. **Reliability:** 99%+ queue job success rate
6. **Editorial:** < 5 minutes from save to image available

## Next Steps

1. **Confirm deployment strategy** — Same server vs. separate?
2. **Choose FLUX2 model** — Klein vs. dev?
3. **Start Phase 1** — Layout foundation
4. **Set up development environment** — Unsloth locally
5. **Test Arabic justification** — Get feedback from Arabic readers
