---
title: "Recon: Newspaper-Style Layout & AI Image Generation for Jareeda"
date: 2026-08-13
type: recon
mode: explore
tags: [newspaper, layout, columns, justified-text, ai-image-generation, unsloth, flux2, arabic, rtl, typicms, laravel, vue, bootstrap]
session: deep-recon-2026-08-13
status: draft
---

> [!info] Process log
> **Session:** deep-recon (autonomous, explore) — 2026-08-13, ~14:00 → 14:45 · **2 rounds, 10 agents** · ~37k tokens, ~8 min. Full metrics in `recon/_metrics.md`.
> **Focus:** Newspaper-style welcome screen layout with columns and justified text (English + Arabic), plus Unsloth AI image generation (FLUX2) for articles without images.
> **Environment:** Jareeda Laravel 12 repo with TypiCMS Core 17, Bootstrap 5, Vue 3. The recon builds on the earlier Arabic/RTL localization work (2026-08-12).
> **Corrections applied:** none structural; all findings verified across rounds.

---

# The Territory

Jareeda (جريدة — "newspaper") needs a welcome screen that evokes the visual language of classic newspapers: multi-column layouts, justified text, and a density of information that signals "this is a serious publication." The challenge is twofold:

1. **Layout:** Achieving authentic newspaper aesthetics (columns, justified text, typographic hierarchy) that work across both English (LTR) and Arabic (RTL) without breaking the responsive design.
2. **Content:** When articles lack images, automatically generate contextually appropriate images using Unsloth AI's FLUX2 diffusion models running locally.

## What exists (verified in the repo)

- **TypiCMS Core public theme.** The public-facing site uses vendor layouts from `typicms/core` — only error pages exist in `resources/views/`. The welcome/home page structure is defined upstream.
- **Bootstrap 5 + Vue 3 frontend.** SCSS in `resources/scss/public/` with ~10 files, plus `resources/js/public.js`. Current styling uses physical CSS properties (left/right, margin-left/right, float) — not logical properties.
- **No newspaper layout exists.** The current design is a standard CMS layout, not a newspaper-style columnar design.
- **No AI image generation integration.** The project has no existing connection to Unsloth, FLUX, or any diffusion model API.
- **Arabic localization pending.** As documented in `recon/2026-08-12-arabic-rtl-localization.md`, RTL support is not yet implemented — no `dir` attribute, hardcoded LTR in CSS, no Arabic font strategy.

## What doesn't exist (verified in the repo)

- **No CSS multi-column layout.** No use of `column-count`, `column-width`, or `column-gap` anywhere in the SCSS.
- **No justified text styling.** No `text-align: justify` in the public theme SCSS.
- **No responsive newspaper breakpoints.** No media queries targeting newspaper-specific layouts.
- **No image generation pipeline.** No queue jobs, API clients, or storage handling for AI-generated images.
- **No FLUX2 model configuration.** No references to Unsloth, FLUX, or diffusion model endpoints.

---

# The Possibility Space (competing framings)

Three distinct framings emerged. They are not mutually exclusive — they are *layers* that can be sequenced.

## Framing A — CSS Multi-Column Layout (the pure CSS path)

Use the native CSS Multi-Column Layout Module to create newspaper-style columns. This is the simplest approach and works natively with both LTR and RTL content.

**Implementation approach:**
- `column-count: 3` (desktop), `column-count: 2` (tablet), `column-count: 1` (mobile)
- `column-width: 20em` for flexible column sizing
- `column-gap: 2em` for spacing between columns
- `column-rule: 1px solid #ccc` for optional dividing lines
- `text-align: justify` for newspaper-style justified text
- `column-span: all` for headlines that span all columns

**Pros:**
- Native CSS, no JavaScript dependencies
- Works automatically with RTL when `dir="rtl"` is set
- Responsive via media queries
- Well-supported in modern browsers (97%+ global support)

**Cons:**
- Limited control over individual column placement (content flows automatically)
- Cannot easily have asymmetric column layouts (e.g., 2:1 ratio)
- `column-fill: balance` may not work as expected with variable-height content
- Last-column orphan issues with short articles

**RTL considerations:**
- When `dir="rtl"` is set on the container, columns flow right-to-left automatically
- `text-align: justify` works the same in both directions
- Column rules appear on the correct side

## Framing B — CSS Grid Layout (the structured path)

Use CSS Grid to create a newspaper-style layout with more control over column placement and sizing.

**Implementation approach:**
```css
.newspaper-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2em;
  grid-auto-rows: auto;
}

.newspaper-grid .headline {
  grid-column: 1 / -1; /* span all columns */
}

.newspaper-grid .sidebar {
  grid-column: span 1;
}
```

**Pros:**
- Full control over column placement and sizing
- Can create asymmetric layouts (e.g., 2:1 ratio for featured vs. secondary articles)
- `grid-column: span 2` for articles that take more space
- Better for complex newspaper layouts with featured stories

**Cons:**
- More complex CSS than multi-column
- Requires explicit placement for each article (not automatic flow)
- RTL requires flipping column order or using logical properties
- Less "newspaper-like" automatic flow

**RTL considerations:**
- Use logical properties (`margin-inline-start` instead of `margin-left`)
- Grid order can be reversed with `direction: rtl` on the container
- Need to handle column placement explicitly for RTL

## Framing C — Hybrid Approach (the pragmatic path)

Combine CSS Grid for the overall layout with CSS Multi-Column for article text flow. This gives structure at the page level while maintaining authentic newspaper text flow within articles.

**Implementation approach:**
- Grid for the overall page structure (header, main content, sidebar)
- Multi-column within the main content area for article text
- Justified text within columns
- Featured article spans full width, secondary articles in columns

**Pros:**
- Best of both worlds: structured layout + natural text flow
- Can have featured articles with images + text-only articles in columns
- More authentic newspaper feel
- Easier to manage responsive breakpoints

**Cons:**
- More CSS to maintain
- Need to coordinate grid and multi-column behavior
- RTL requires careful handling of both systems

**RTL considerations:**
- Grid can be reversed with `direction: rtl`
- Multi-column flows automatically in RTL
- Logical properties throughout for margins/padding

---

# Tensions

## T1 — Authenticity vs. Responsiveness

Classic newspapers have fixed-width columns and dense layouts. Modern web design demands responsive, fluid layouts. The tension is: how newspaper-like should it look on mobile?

**Options:**
1. **Desktop-first:** Full newspaper layout on desktop, simplified single-column on mobile (most authentic)
2. **Mobile-first:** Start with readable single-column, expand to newspaper columns on larger screens (most practical)
3. **Progressive enhancement:** Base layout works everywhere, newspaper columns added via `@supports (column-count: 3)` (most robust)

**Recommendation:** Option 2 (mobile-first) with Option 3's progressive enhancement for older browsers.

## T2 — Text Justification Quality

`text-align: justify` in CSS creates uneven spacing between words, especially in narrow columns. This is the "rivers of white space" problem that newspapers solve with hyphenation.

**Options:**
1. **CSS `hyphens: auto`** — Browser handles hyphenation (requires `lang` attribute for correct language)
2. **JavaScript hyphenation** — Use Hyph.js or similar for better control
3. **No justification** — Use `text-align: left` (LTR) or `text-align: right` (RTL) instead

**For Arabic:** Arabic has different justification rules than English. Arabic typesetters use kashida (ـ) for justification, not word spacing. CSS `text-align: justify` doesn't handle kashida — it uses word spacing like English. This may look unnatural.

**Recommendation:** Use `hyphens: auto` for English, and for Arabic consider `text-align: right` (RTL default) or a JavaScript solution that adds kashida.

## T3 — Image Generation Trigger

When should the AI generate an image for an article without one?

**Options:**
1. **On article save** — Generate image when article is saved without an image (editorial control)
2. **On article view** — Generate image when reader views article (lazy, but adds latency)
3. **Background queue** — Generate images for all imageless articles periodically (no latency, but may waste resources)
4. **Manual trigger** — Editor clicks "Generate Image" button (full control, but manual)

**Recommendation:** Option 1 (on save) with Option 4 as fallback. The editor can preview and regenerate if needed.

## T4 — FLUX2 Model Selection

Unsloth offers multiple FLUX2 variants. Which one for newspaper illustrations?

**Options:**
1. **FLUX.2-dev** — Best quality, slower, requires more VRAM
2. **FLUX.2-klein** — Smaller, faster, good for quick generation
3. **FLUX.2 with LoRA** — Fine-tuned for specific styles (e.g., newspaper illustration style)

**Recommendation:** FLUX.2-dev for quality, with FLUX.2-klein as fallback for quick previews. Consider training a LoRA on newspaper illustration styles for consistent aesthetics.

## T5 — Integration Architecture

How should Laravel connect to Unsloth's local API?

**Options:**
1. **HTTP client** — Direct HTTP calls to Unsloth's OpenAI-compatible API (simplest)
2. **Queue job** — Background job that calls the API and stores the result (most resilient)
3. **Artisan command** — CLI command to batch-generate images (for bulk operations)

**Recommendation:** Option 2 (queue job) for production, with Option 3 for bulk operations. The queue job should:
- Accept article ID and prompt
- Call Unsloth API (localhost:8888 or configured endpoint)
- Store generated image in `storage/app/public/ai-generated/`
- Update article's image field
- Log generation metadata (prompt, model, seed, timing)

---

# What full implementation actually entails (stack-mapped)

## Workstream 1: Newspaper Layout CSS

1. **Create newspaper SCSS file** — `resources/scss/public/_newspaper.scss` with:
   - Multi-column layout rules
   - Justified text styling
   - Column rules (dividers)
   - Typography hierarchy (headlines, subheads, body text)
   - Responsive breakpoints

2. **Update public.scss** — Import the new newspaper SCSS

3. **Create Blade partials** — Override vendor layouts with:
   - `resources/views/vendor/core/public/_newspaper-grid.blade.php`
   - `resources/views/vendor/core/public/_article-card.blade.php`

4. **Add Arabic font stack** — Cairo or Tajawal for `[lang=ar]` with proper line-height (1.6-1.8)

5. **Implement logical properties** — Convert physical properties to logical for RTL support

## Workstream 2: AI Image Generation

1. **Create Artisan command** — `app/Console/Commands/GenerateArticleImages.php` for:
   - Scanning articles without images
   - Generating images via Unsloth API
   - Storing results

2. **Create queue job** — `app/Jobs/GenerateArticleImage.php` for:
   - Single article image generation
   - Retry logic
   - Progress tracking

3. **Create API client** — `app/Services/UnslothImageService.php` for:
   - HTTP client configuration
   - Prompt engineering for newspaper illustrations
   - Response handling
   - Error handling

4. **Add storage configuration** — `config/unsloth.php` for:
   - API endpoint (default: localhost:8888)
   - Model selection (default: FLUX.2-dev)
   - Image storage path
   - Queue connection

5. **Update Article model** — Add:
   - `ai_generated_image` boolean field
   - `image_prompt` text field
   - Relationship to generated images

6. **Create migration** — Add fields to articles table

## Workstream 3: Editorial Integration

1. **Admin UI additions** — Vue components for:
   - "Generate Image" button on article edit page
   - Image preview and regeneration
   - Prompt editing

2. **Event listeners** — Laravel events for:
   - `ArticleSavedWithoutImage` → trigger generation
   - `ImageGenerated` → update article

3. **Notification system** — Notify editors when:
   - Image generation completes
   - Generation fails
   - Manual review needed

---

# Implementation Plan

Based on the recon, here's the recommended 4-phase implementation:

## Phase 1: Layout Foundation (Week 1-2)

1. Create `resources/scss/public/_newspaper.scss` with:
   - Multi-column layout (`column-count: 3` desktop, `2` tablet, `1` mobile)
   - Justified text (`text-align: justify`)
   - Column rules (`column-rule: 1px solid #ccc`)
   - Typography hierarchy (H1-H3, body, captions)
   - Responsive breakpoints

2. Create Blade partials:
   - `resources/views/vendor/core/public/_newspaper-grid.blade.php`
   - `resources/views/vendor/core/public/_article-card.blade.php`

3. Add Arabic font stack:
   - Cairo or Tajawal for `[lang=ar]`
   - Line-height: 1.6-1.8
   - `font-display: swap`

4. Test with real content (English + Arabic)

## Phase 2: AI Image Generation (Week 3-4)

1. Set up Unsloth:
   - Install FLUX.2-klein-4B for development
   - Configure API endpoint (localhost:8888)
   - Test basic generation

2. Create Laravel integration:
   - `config/unsloth.php` — Configuration
   - `app/Services/UnslothImageService.php` — API client
   - `app/Jobs/GenerateArticleImage.php` — Queue job
   - `app/Console/Commands/GenerateArticleImages.php` — Artisan command

3. Add database fields:
   - Migration for `ai_generated_image`, `image_prompt`
   - Update Article model

4. Implement queue workers:
   - Configure Redis/Database queue
   - Add retry logic (3 attempts)
   - Add health checks

## Phase 3: Editorial Integration (Week 5-6)

1. Admin UI additions:
   - "Generate Image" button on article edit page
   - Image preview and regeneration
   - Prompt editing

2. Event system:
   - `ArticleSavedWithoutImage` event
   - `ImageGenerated` event
   - Notification system

3. Editorial workflow:
   - Image review queue
   - Approve/reject functionality
   - Publish with AI images

4. Responsive images:
   - Generate multiple sizes (hero, featured, thumbnail)
   - `srcset` for responsive display
   - Lazy loading

## Phase 4: Polish and Optimization (Week 7-8)

1. Performance optimization:
   - Image caching
   - Queue monitoring
   - Resource limits

2. Accessibility audit:
   - Screen reader testing
   - Keyboard navigation
   - ARIA landmarks

3. Print styles:
   - `@media print` CSS
   - Single-column for print
   - Include AI images

4. Monitoring and logging:
   - Generation metrics
   - Error tracking
   - Performance monitoring

---

# Key Decisions Needed

1. **Unsloth deployment:** Same server vs. separate GPU server?
2. **FLUX2 model:** FLUX.2-klein vs. FLUX.2-dev?
3. **Queue driver:** Redis vs. Database?
4. **Image storage:** Local vs. S3-compatible?
5. **Editorial review:** Required vs. optional?

---

# Open Questions

1. **Newspaper column count:** Should the welcome screen use 2, 3, or variable columns based on viewport? Classic newspapers use 5-7 columns, but web screens are narrower.

2. **Featured article treatment:** How should the lead story be displayed? Full-width with image? Large headline spanning all columns? Different from secondary articles?

3. **Arabic justification quality:** Is CSS `text-align: justify` acceptable for Arabic, or do we need kashida support? What do Bahraini news sites use?

4. **Unsloth deployment:** Where will Unsloth run? Same server as Laravel? Separate GPU server? Docker container?

5. **Image style consistency:** Should all AI-generated images have a consistent style (e.g., editorial illustration, photograph, sketch)? How to achieve this with FLUX2?

6. **Cost/performance:** FLUX2-dev requires significant VRAM. What's the acceptable generation time? Should we use FLUX2-klein for speed?

7. **Content moderation:** Should AI-generated images be reviewed before publishing? What about potential biases or inappropriate content?

8. **SEO implications:** Do AI-generated images need alt text? How to handle image attribution/copyright for AI-generated content?

9. **Fallback strategy:** What if Unsloth is unavailable? Should articles display without images? Use placeholder images?

10. **Arabic prompt engineering:** How to generate effective prompts for Arabic content? Should prompts be in English (FLUX2's primary language) or Arabic?

---

# References

1. CSS Multi-Column Layout — MDN Web Docs — https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_multicol_layout
2. CSS Text Justify — MDN Web Docs — https://developer.mozilla.org/en-US/docs/Web/CSS/text-justify
3. Unsloth Documentation — Image Diffusion — https://unsloth.ai/docs/basics/diffusion-image
4. Unsloth API — OpenAI-Compatible — https://unsloth.ai/docs/integrations/connections
5. FLUX.2-dev — Hugging Face — https://huggingface.co/unsloth/FLUX.2-dev
6. Bootstrap 5 RTL — https://getbootstrap.com/docs/5.3/getting-started/rtl/
7. CSS Logical Properties — MDN Web Docs — https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_logical_properties_and_values
8. Arabic Typography — W3C — https://www.w3.org/International/questions/qa-html-dir.en.html
9. CSS Grid Layout — MDN Web Docs — https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_grid_layout
10. Laravel Queue Jobs — https://laravel.com/docs/12.x/queues

*Primary source consulted in-repo: `recon/2026-08-12-arabic-rtl-localization.md`, `resources/scss/public/`, `config/typicms.php`, `composer.json`, `package.json`.*
