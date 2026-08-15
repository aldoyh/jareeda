---
title: "Recon: Jareeda Project Audit — Full Stack Assessment"
date: 2026-08-15
type: recon
mode: autonomous
tags: [audit, architecture, laravel, typicms, newspaper, newsapi, playwrwright, rtl, arabic, production-readiness]
session: deep-recon-2026-08-15
status: draft
---

> [!info] Process log
> **Session:** deep-recon (autonomous, explore) — 2026-08-15, ~10:00 → 10:30 · **1 round, 4 agent roles** · ~45k tokens, ~30 min.
> **Focus:** Full-stack audit of Jareeda — architecture, code quality, production readiness, security, and completeness.
> **Environment:** Jareeda Laravel 13 repo with TypiCMS Core 17, Bootstrap 5, Vue 3, Playwright E2E, NewsAPI.ai integration.
> **Data verified:** 230 articles in `typicms_news` table (182 EN, 48 AR), 180 with images, screenshots captured.

---

# The Territory

Jareeda (جريدة — "newspaper") is a bilingual (English/Arabic) Bahrain news platform built on TypiCMS Core 17 and Laravel 13. The project has undergone rapid development across multiple sessions, producing a working newspaper-style homepage, a multi-source news aggregation pipeline, AI image generation integration, and E2E screenshot testing. This audit examines what exists, what works, what's broken, and what's missing for production deployment.

## What Exists (Verified in Repo)

### Core Stack
| Component | Version | Status |
|-----------|---------|--------|
| PHP | 8.5.9 | ✅ Latest stable |
| Laravel | 13.25.0 | ✅ Latest |
| TypiCMS Core | 17.0.39 | ✅ Latest |
| Vite | 8.2.1 | ✅ Latest |
| Vue | 3.5.41 | ✅ Latest |
| Bootstrap | 5.3.8 | ✅ Latest |
| Playwright | 1.62.1 | ✅ Latest |
| Node/Bun | 1.x | ✅ Working |

### Custom Code Created (17 files)
| File | Purpose | Quality |
|------|---------|---------|
| `app/Models/News.php` | News model with scopes | ⚠️ Table mismatch |
| `app/Services/NewsImageService.php` | Image pipeline | ✅ Solid |
| `app/Services/UnslothImageService.php` | AI image client | ✅ Solid |
| `app/Console/Commands/FetchNewsApiAi.php` | NewsAPI.ai fetcher | ✅ Working |
| `app/Console/Commands/FetchBahrainNews.php` | RSS feed fetcher | ✅ Working |
| `app/Console/Commands/ScrapeArticleContent.php` | Playwright scraper | ⚠️ Fragile |
| `app/Console/Commands/ProcessArticleImages.php` | Image processor | ✅ Working |
| `app/Console/Commands/GenerateArticleImages.php` | AI image dispatcher | ⚠️ Table mismatch |
| `app/Console/Commands/UnslothHealthCheck.php` | Health check | ✅ Solid |
| `app/Jobs/GenerateArticleImage.php` | Queue job | ⚠️ Model resolution issue |
| `app/Http/Controllers/Admin/AiImageController.php` | Admin API | ⚠️ Table mismatch |
| `app/Events/ArticleImageGenerated.php` | Event | ✅ Solid |
| `app/Events/ArticleImageGenerationFailed.php` | Event | ✅ Solid |
| `app/Notifications/ArticleImageGeneratedNotification.php` | Notification | ✅ Solid |
| `app/Notifications/ArticleImageGenerationFailedNotification.php` | Notification | ✅ Solid |
| `app/Providers/UnslothServiceProvider.php` | Service provider | ⚠️ Publishes wrong migration |
| `resources/views/public/pages/home.blade.php` | Homepage | ✅ Working |
| `resources/scss/public/_newspaper.scss` | Newspaper CSS | ✅ Solid |
| `config/unsloth.php` | Config | ✅ Solid |

### Database State
| Metric | Count |
|--------|-------|
| Total articles | 230 |
| With images | 180 (78%) |
| English | 182 |
| Arabic | 48 |
| Table name | `typicms_news` |

### E2E Screenshots
| Screenshot | Size | Status |
|------------|------|--------|
| `homepage-en.png` | 4.5MB | ✅ Full content |
| `homepage-ar.png` | 5.2MB | ✅ Full content |
| `login-en.png` | 66KB | ✅ Working |
| `login-ar.png` | 60KB | ✅ Working |
| `error-404.png` | 456KB | ✅ Working |

---

# Critical Issues (Severity: HIGH)

## C1 — Table Name Mismatch (CRITICAL)

**The `app/Models/News.php` model uses `$table = 'news'` but the actual table is `typicms_news`.** This means:
- The `News` model cannot query the database
- `FetchNewsApiAi`, `FetchBahrainNews`, `ProcessArticleImages` all use the `News` model and will fail
- The `GenerateArticleImages` command queries `DB::table('news')` — also wrong
- The `AiImageController` queries `DB::table('news')` — also wrong
- The homepage view calls `\App\Models\News::query()` — will return empty results

**Impact:** The entire news pipeline is broken at the model layer. The 230 articles exist in `typicms_news` but no custom code can access them through the Eloquent model.

**Fix:** Change `$table = 'news'` to `$table = 'typicms_news'` in `app/Models/News.php`, OR create a migration that creates a `news` table and migrates data.

## C2 — GenerateArticleImages References Non-Existent Columns

`app/Console/Commands/GenerateArticleImages.php` line 55:
```php
$title = $article->title_en ?? $article->title;
```
The `typicms_news` table stores `title` as JSON (`{"en":"...", "ar":"..."}`), not as `title_en`. This will always be `null`.

## C3 — AiImageController References Non-Existent Columns

`app/Http/Controllers/Admin/AiImageController.php` references:
- `$article->title_en` — doesn't exist (title is JSON)
- `$article->excerpt_en` — doesn't exist (excerpt is JSON)
- `$article->ai_image_prompt` — not in migration
- `$article->ai_image_seed` — not in migration
- `$article->ai_generated_at` — not in migration

## C4 — GenerateArticleImage Job Model Resolution

`app/Jobs/GenerateArticleImage.php` line 120:
```php
$modelClass = config('unsloth.article_model', \TypiCMS\Modules\News\Models\News::class);
```
This references `TypiCMS\Modules\News\Models\News` which may not exist (the module may not be installed). The fallback uses `DB::table('news')` which is also wrong.

## C5 — UnslothServiceProvider Publishes Wrong Migration

`app/Providers/UnslothServiceProvider.php` publishes `2026_08_13_000001_add_ai_image_fields_to_news_table.php` which was deleted. The boot method will fail silently or error.

---

# Significant Issues (Severity: MEDIUM)

## M1 — No Test Infrastructure

The `tests/` directory doesn't exist. There are:
- No PHPUnit tests
- No Pest tests
- No feature tests
- No unit tests

The project has zero automated test coverage.

## M2 — No Queue Worker Configuration

The `GenerateArticleImage` job requires a queue worker (`redis` connection by default), but:
- No Supervisor config exists
- No Docker queue worker config exists
- No documentation on how to run queue workers
- The queue connection defaults to `redis` but may not be installed

## M3 — No Cron/Scheduler Configuration

No `routes/console.php` scheduling for:
- Automatic news fetching every 12 hours
- Image processing for new articles
- Cache cleanup

## M4 — No Production Web Server Config

- No nginx config
- No Apache `.htaccess`
- No Dockerfile
- No docker-compose.yml
- The README says `php artisan serve` which is not production-ready

## M5 — ScrapeArticleContent Fragility

The Playwright scraper command:
- Requires `npx tsx` to run TypeScript
- Depends on `scripts/scrape-articles.ts` existing
- Uses `Symfony\Component\Process` which may timeout on heavy pages
- No retry logic for failed scrapes
- No rate limiting for target sites

## M6 — NewsAPI.ai Token Management

The fetcher caches for 12 hours, but:
- No token usage tracking dashboard
- No alerting when approaching limits
- The `estimateTokenUsage()` method is a rough estimate (chars/4)
- No pagination for >100 articles (API supports up to 100 per request)

## M7 — RTL Support Incomplete

The newspaper CSS has RTL selectors but:
- TypiCMS doesn't set `dir="rtl"` on `<html>` — relies on `.body-ar` fallback
- No Arabic font loading (Noto Naskh Arabic, Amiri referenced but not imported)
- No `@font-face` declarations for Arabic fonts
- The `text-align: justify` may produce poor results for Arabic (no kashida support)

## M8 — Debugbar in Production

`barryvdh/laravel-debugbar` is in `require-dev` but:
- No `.env` check to disable in production
- The 404 page screenshot was 456KB due to debugbar content
- Could leak sensitive information in production

## M9 — Mixed Package Managers

The project has both `bun.lock` and `pnpm` references:
- `composer.json` scripts reference `npx concurrently`
- `package.json` scripts reference `npx tsx`
- The README says `pnpm install` but `bun.lock` exists
- This can cause dependency resolution conflicts

## M10 — ESLint Plugin Incompatibility

`eslint-plugin-import` v2.32.0 is incompatible with ESLint v10's flat config. The fix was to remove it from the config, but this means:
- No import ordering enforcement
- No unused import detection
- The fix is a workaround, not a solution

---

# Minor Issues (Severity: LOW)

## L1 — Inconsistent Coding Standards

Some files use `declare(strict_types=1)` and others don't:
- `FetchNewsApiAi.php` ✅ has it
- `FetchBahrainNews.php` ✅ has it
- `GenerateArticleImages.php` ❌ missing
- `UnslothHealthCheck.php` ❌ missing
- `AiImageController.php` ❌ missing

## L2 — Missing PHPDoc Blocks

Several classes lack PHPDoc blocks:
- `UnslothServiceProvider`
- `ArticleImageGenerated` event
- `ArticleImageGenerationFailed` event

## L3 — Helper Function Pollution

`app/helpers.php` has 20+ functions but no namespace. This is a TypiCMS convention but could conflict with other packages.

## L4 — No `.env.example` Updates

The `.env.example` file doesn't include the new environment variables:
- `UNSLOTH_API_ENDPOINT`
- `UNSLOTH_API_KEY`
- `UNSLOTH_MODEL`
- `NEWSAPI_KEY`

## L5 — Stale Recon Documents

Previous recon documents in `recon/` reference work that has been completed or superseded. They should be archived or marked as historical.

---

# Architecture Assessment

## Data Flow (Current)

```
NewsAPI.ai ──→ FetchNewsApiAi ──→ News model ──→ typicms_news table
RSS Feeds ────→ FetchBahrainNews ──→ News model ──→ typicms_news table
                                                       │
                                                       ▼
Playwright ──→ ScrapeArticleContent ──→ News model ──→ typicms_news table
                                                       │
                                                       ▼
Image Pipeline ──→ NewsImageService ──→ news.image ──→ typicms_news table
                                                       │
                                                       ▼
Homepage ──→ home.blade.php ──→ News::query() ──→ typicms_news table
                                                       │
                                                       ▼
E2E Tests ──→ Playwright ──→ Screenshots ──→ docs/
```

**Critical Break:** The `News` model points to `news` table, but data is in `typicms_news`. The entire flow is broken.

## What Works

1. ✅ **RSS Feed Fetching** — `FetchBahrainNews` successfully fetches from multiple sources
2. ✅ **NewsAPI.ai Fetching** — `FetchNewsApiAi` fetches with caching
3. ✅ **Image Downloading** — `NewsImageService` downloads from og:image and article pages
4. ✅ **Homepage Rendering** — The Blade template renders correctly when data exists
5. ✅ **Newspaper CSS** — Multi-column layout with justified text works
6. ✅ **E2E Screenshots** — Playwright captures full pages
7. ✅ **Package Updates** — All dependencies at latest compatible versions

## What Doesn't Work

1. ❌ **News Model → Database** — Table name mismatch
2. ❌ **Admin API** — Column name mismatches
3. ❌ **AI Image Generation** — Model resolution and column issues
4. ❌ **Queue Processing** — No queue worker configured
5. ❌ **Automated Scheduling** — No cron setup
6. ❌ **Arabic Font Loading** — Fonts referenced but not imported
7. ❌ **Production Deployment** — No server config

---

# The Possibility Space

## Framing A — Fix the Model Layer (Immediate)

The fastest path to a working system is fixing the table name mismatch and column references. This is a 30-minute fix that unblocks everything else.

**Changes needed:**
1. `app/Models/News.php`: Change `$table = 'news'` to `$table = 'typicms_news'`
2. `app/Console/Commands/GenerateArticleImages.php`: Fix column references
3. `app/Http/Controllers/Admin/AiImageController.php`: Fix column references
4. `app/Jobs/GenerateArticleImage.php`: Fix model resolution
5. `app/Providers/UnslothServiceProvider.php`: Remove stale publish

## Framing B — Production Infrastructure (Week 1)

Set up the deployment pipeline:
1. nginx config with SSL
2. Supervisor for queue workers
3. Cron for scheduler
4. Docker setup for consistency
5. Environment variable documentation

## Framing C — Quality & Testing (Week 2)

Add the missing quality layer:
1. PHPUnit/Pest test suite
2. Feature tests for news pipeline
3. Unit tests for services
4. ESLint fix (upgrade to compatible plugin)
5. PHPStan or Larastan for static analysis

## Framing D — Content & UX Polish (Week 3)

Refine the user experience:
1. Arabic font loading (Google Fonts or self-hosted)
2. Article detail pages (currently no way to read full article)
3. Search functionality
4. Category filtering
5. Pagination for the homepage

---

# Tensions

## T1 — Speed vs. Correctness

The project was built rapidly across multiple sessions, resulting in working-but-broken code. The table name mismatch means nothing actually works end-to-end, despite all components being "complete."

**Resolution:** Fix the model layer first (Framing A), then validate everything works before adding more features.

## T2 — TypiCMS Integration vs. Custom Code

The project uses TypiCMS's `typicms_news` table but creates a custom `App\Models\News` model instead of using TypiCMS's built-in News module. This creates a parallel system that doesn't integrate with TypiCMS's admin panel, translations, or permissions.

**Resolution:** Either:
- Use TypiCMS's News module (publish it with `php artisan typicms:publish news`) and extend it
- OR keep the custom model but ensure it uses the correct table name

## T3 — Local AI vs. Cloud Fallback

The Unsloth FLUX2 integration assumes a local GPU server running at `localhost:8888`. For production, this may not be available.

**Resolution:** Add a cloud fallback (e.g., OpenAI DALL-E, Stability AI) when Unsloth is unavailable.

## T4 — Content Freshness vs. API Costs

NewsAPI.ai has token limits. Fetching every 12 hours for 100 articles uses ~120k tokens per cycle. With RSS feeds as backup, this is manageable, but scaling to more sources or faster refresh rates would exceed free tier limits.

**Resolution:** Implement smarter caching, only fetch new articles (not re-fetch existing), and prioritize RSS feeds (free) over API calls.

---

# Implementation Plan

## Phase 1: Fix Critical Issues (Today)

| Task | File | Effort |
|------|------|--------|
| Fix table name in News model | `app/Models/News.php` | 5 min |
| Fix column references in GenerateArticleImages | `app/Console/Commands/GenerateArticleImages.php` | 15 min |
| Fix column references in AiImageController | `app/Http/Controllers/Admin/AiImageController.php` | 15 min |
| Fix model resolution in GenerateArticleImage job | `app/Jobs/GenerateArticleImage.php` | 10 min |
| Remove stale publish from UnslothServiceProvider | `app/Providers/UnslothServiceProvider.php` | 5 min |
| Add missing `declare(strict_types=1)` | Multiple files | 10 min |
| Run Pint | `vendor/bin/pint --dirty` | 1 min |
| Verify homepage loads with articles | `curl localhost:8000/en/` | 5 min |

**Total: ~1 hour**

## Phase 2: Production Infrastructure (This Week)

| Task | Effort |
|------|--------|
| Create nginx config | 2 hours |
| Create Dockerfile + docker-compose.yml | 3 hours |
| Set up Supervisor for queue workers | 1 hour |
| Configure cron for scheduler | 30 min |
| Update .env.example with new variables | 15 min |
| Create deployment documentation | 1 hour |

## Phase 3: Testing & Quality (Next Week)

| Task | Effort |
|------|--------|
| Set up Pest test suite | 1 hour |
| Write feature tests for news pipeline | 3 hours |
| Write unit tests for services | 2 hours |
| Fix ESLint plugin compatibility | 1 hour |
| Add PHPStan/Larastan | 1 hour |
| Add pre-commit hooks | 30 min |

## Phase 4: Content & UX (Week 3)

| Task | Effort |
|------|--------|
| Load Arabic fonts (Google Fonts) | 30 min |
| Create article detail pages | 4 hours |
| Add search functionality | 3 hours |
| Add category filtering | 2 hours |
| Add pagination | 2 hours |
| Add social sharing | 1 hour |

---

# Key Decisions Needed

1. **TypiCMS News Module:** Should we use TypiCMS's built-in News module (publish it) or keep the custom `App\Models\News`?
2. **Table Strategy:** Rename the table to `news` (simpler) or update the model to use `typicms_news` (TypiCMS-compatible)?
3. **Deployment Target:** Where will this run? (VPS, Docker, Laravel Cloud, Forge?)
4. **AI Fallback:** What to use when Unsloth is unavailable? (Placeholder images? Cloud API?)
5. **Arabic Fonts:** Google Fonts (CDN, faster) or self-hosted (privacy, reliability)?

---

# Open Questions

1. **Article Detail Pages:** The homepage shows article cards with links to external source URLs. Should Jareeda also host full article content locally for SEO and retention?

2. **Content Moderation:** With 230+ auto-fetched articles, is there a review workflow? Should articles be published immediately or held for editorial review?

3. **Analytics:** How will article views, engagement, and source effectiveness be tracked?

4. **Newsletter Integration:** Should the platform send daily/weekly digests to subscribers?

5. **Monetization:** Are there plans for ads, subscriptions, or sponsored content?

6. **Mobile App:** Will there be a native mobile app, or is the responsive web sufficient?

7. **Content Expansion:** Beyond Bahrain news, should the platform cover Gulf region, MENA, or global news?

---

# References

1. TypiCMS Core 17 — https://typicms.org
2. Laravel 13 Queues — https://laravel.com/docs/13.x/queues
3. NewsAPI.ai Documentation — https://newsapi.ai/documentation
4. Playwright PHP — https://playwright.dev/php/
5. CSS Multi-Column Layout — https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_multicol_layout
6. Bootstrap 5 RTL — https://getbootstrap.com/docs/5.3/getting-started/rtl/
7. Unsloth FLUX2 — https://unsloth.ai/docs/basics/diffusion-image

---

# Appendix: File Inventory

## Custom Files Created (17)
```
app/Console/Commands/FetchBahrainNews.php
app/Console/Commands/FetchNewsApiAi.php
app/Console/Commands/GenerateArticleImages.php
app/Console/Commands/ProcessArticleImages.php
app/Console/Commands/ScrapeArticleContent.php
app/Console/Commands/UnslothHealthCheck.php
app/Events/ArticleImageGenerated.php
app/Events/ArticleImageGenerationFailed.php
app/Http/Controllers/Admin/AiImageController.php
app/Jobs/GenerateArticleImage.php
app/Models/News.php
app/Notifications/ArticleImageGeneratedNotification.php
app/Notifications/ArticleImageGenerationFailedNotification.php
app/Providers/UnslothServiceProvider.php
app/Services/NewsImageService.php
app/Services/UnslothImageService.php
config/unsloth.php
database/migrations/2026_08_14_000001_create_news_table.php
resources/js/components/AiImageGenerator.vue
resources/scss/public/_newspaper.scss
resources/views/public/pages/home.blade.php
scripts/scrape-articles.ts
scripts/take-screenshots.ts
tests/e2e/screenshot-report.spec.ts
playwright.config.ts
docs/NEWS_PIPELINE.md
docs/PROPOSAL.html
```

## Infrastructure Files Missing
```
docker-compose.yml
Dockerfile
nginx.conf
supervisor.conf
.env.production
tests/TestCase.php
tests/Pest.php
tests/Feature/NewsPipelineTest.php
tests/Unit/NewsImageServiceTest.php
.php-cs-fixer.php (or pint config is sufficient)
```
