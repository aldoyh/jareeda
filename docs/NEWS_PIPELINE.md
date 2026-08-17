# News Pipeline Documentation

## Overview

Jareeda's news pipeline fetches, stores, and displays Bahrain news articles in a classic newspaper layout for both English and Arabic audiences.

## Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                        DATA SOURCES                              │
├──────────────────┬──────────────────┬───────────────────────────┤
│  NewsAPI.ai      │  NewsData.io     │  RSS Feeds                │
│  (Event Registry)│  (pub_f18d...)   │  (11 sources)             │
│  100 articles    │  95 articles     │  82 articles              │
└────────┬─────────┴────────┬─────────┴──────────┬────────────────┘
         │                  │                     │
         └──────────────────┼─────────────────────┘
                            │
                   ┌────────▼────────┐
                   │   DATABASE      │
                   │  typicms_news   │
                   │  690 articles   │
                   │  (2026-08-17)   │
                   └────────┬────────┘
                            │
              ┌─────────────┼─────────────┐
              │             │             │
     ┌────────▼───┐  ┌─────▼──────┐  ┌──▼───────────┐
     │  Scraping  │  │  Image     │  │  Homepage    │
     │  (Playwright│  │  Pipeline  │  │  Rendering   │
     │  + cURL)   │  │            │  │              │
     └────────────┘  └────────────┘  └──────────────┘
                            │
                   ┌────────▼────────┐
                   │  IMAGE SOURCES  │
                   ├─────────────────┤
                   │ RSS images      │
                   │ og:image scrape │
                   │ NewsAPI.ai      │
                   │ Unsloth FLUX2   │
                   │ SVG placeholders│
                   └─────────────────┘
```

## Gotcha: config caching hides `.env` changes

If `bootstrap/cache/config.php` exists (created by `php artisan config:cache`), Laravel stops reading `.env` for anything **outside** `config/*.php` files — a raw `env('NEWSAPI_KEY')` call in a command class silently returns `null` even though the key is set, while `php artisan config:clear` and a `config()` call against a defined `config/services.php` key keep working correctly. This bit `news:fetch-newsapi` in production once already ([`FetchNewsApiAi.php`](../app/Console/Commands/FetchNewsApiAi.php) now reads `config('services.newsapi.key')` instead of `env()`, matching this project's convention of never calling `env()` outside config files).

If a fetch command reports a key as "not set" despite it being present in `.env`, run `php artisan config:clear` first before assuming the key itself is wrong.

## Commands

### Fetching Articles

```bash
# Fetch from NewsAPI.ai (Event Registry) - cached 12 hours
php artisan news:fetch-newsapi --days=7 --limit=100

# Fetch from NewsData.io - cached 1 hour
php artisan news:fetch-newsdata --search=bahrain --limit=100 --pages=10

# Fetch from RSS feeds (11 sources)
php artisan news:fetch-bahrain --days=7 --limit=100

# Scrape full article content with Playwright
php artisan news:scrape-content --limit=50
```

### Image Generation

```bash
# Fetch missing images from article URLs
php artisan news:fetch-missing-images --limit=50

# Generate SVG placeholders for articles without images
php artisan news:generate-placeholders --limit=50

# Generate AI images using Unsloth FLUX2
php artisan news:generate-unsloth-images --limit=10

# Ensure all articles have images (auto-fallback)
php artisan news:ensure-images
```

### E2E Testing

```bash
# Take screenshots of all pages
npx tsx scripts/take-screenshots.ts

# View E2E report
open tests/e2e/report/index.html
```

## Data Sources

| Source | Type | Articles | Notes |
|--------|------|----------|-------|
| **NewsAPI.ai** | REST API | ~100 | Event Registry, requires API key |
| **NewsData.io** | REST API | ~95 | Free tier, pub API key |
| **Biz Bahrain** | RSS | ~10 | Bahrain-specific business news |
| **Bahrain This Week** | RSS | ~10 | Weekly Bahrain news |
| **Google News** | RSS | ~30 | EN + AR Bahrain search |
| **BBC Middle East** | RSS | ~10 | General Middle East news |
| **Al Jazeera** | RSS | ~10 | General Middle East news |

## Image Pipeline

1. **RSS Feed Images** — Extracted from `media:content`, `enclosure`, or HTML in description
2. **Article URL Scraping** — Follow redirects, extract `og:image` meta tag
3. **Unsloth FLUX2** — AI-generated editorial images using FLUX.2-klein-4B-GGUF model
4. **SVG Placeholders** — Unique, category-colored placeholders with article title and RTL support, used as a last-resort fallback when DiffusionBee/Unsloth are unreachable or no `og:image` exists

### Gotcha: placeholders block re-scraping

`news:ensure-images` writes its SVG placeholder path directly into the `image` column ([`GenerateArticleImages.php`](../app/Console/Commands/GenerateArticleImages.php)). `news:fetch-missing-images` only targets rows where `image` is null/empty, so once an article has a placeholder it's permanently skipped by the scraper — running `fetch-missing-images` again reports "All articles already have images" even for rows that only ever got a placeholder.

To retry real-image scraping for placeholder rows, null out `image` first, then re-run the scraper:

```bash
php artisan tinker --execute="\App\Models\News::where('image', 'like', '%news-images/placeholder_%')->update(['image' => null]);"
php artisan news:fetch-missing-images
```

`news:fetch-missing-images` also throws an unhandled `ConnectionException` and stops the whole run on a single slow/unreachable host (each article is saved as it's processed, so progress isn't lost — just re-run the command to pick up where it left off).

### Unsloth Configuration

- **Endpoint**: `http://localhost:8888`
- **Model**: `unsloth/FLUX.2-klein-4B-GGUF` (Q4_K_M quantized)
- **Image Size**: 1024×768 (newspaper aspect ratio)
- **Load Endpoint**: `/api/inference/images/load`
- **Auto-load**: Models are loaded on-demand before generation

## Caching Strategy

| Source | Cache TTL | Cache Key |
|--------|-----------|-----------|
| NewsAPI.ai | 12 hours | `newsapi_bahrain_*` |
| NewsData.io | 1 hour | `newsdata_*` |
| RSS Feeds | No cache | Direct fetch |
| Image URLs | Permanent | Database `image` column |

## Database Schema

```sql
-- typicms_news table (managed by TypiCMS)
CREATE TABLE typicms_news (
    id INTEGER PRIMARY KEY,
    slug TEXT UNIQUE NOT NULL,
    title TEXT NOT NULL,          -- JSON: {en: "...", ar: "..."}
    body TEXT,                    -- JSON: {en: "...", ar: "..."}
    excerpt TEXT,                 -- JSON: {en: "...", ar: "..."}
    url TEXT,                     -- Source article URL
    source TEXT,                  -- Source name (RSS feed, API)
    author TEXT,
    image TEXT,                   -- Image URL or path
    image_alt TEXT,
    ai_generated_image BOOLEAN,
    ai_generated_image_path TEXT,
    category TEXT,
    language TEXT,                -- "en" or "ar"
    published_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## SEO Structured Data

The homepage includes three JSON-LD schemas:

1. **WebSite** — Site name, description, search action, publisher
2. **NewsArticle** — Featured article with full metadata
3. **ItemList** — Top 10 articles as a structured list

## Frontend

- **Layout**: Classic newspaper with multi-column justified text
- **Fonts**: Playfair Display, Source Serif 4, Inter, Noto Naskh Arabic, Amiri
- **RTL**: Full Arabic RTL support with `dir="rtl"` on `<html>` element
- **Responsive**: Container-based layout with Bootstrap 5 grid
- **Images**: Lazy loading for non-featured images, eager for featured
- **Dark mode**: Toggle button injected next to the offcanvas nav (`resources/js/public/dark-mode.ts`), persisted to `localStorage` under `jareeda-theme`, defaults to `prefers-color-scheme`. Theme state lives in `data-theme` on `<html>`; overrides are in `resources/scss/public/_dark-mode.scss`.

### Screenshots

| Light · English | Dark · English |
|---|---|
| ![Homepage, light theme, English](screenshots/home-en-light.webp) | ![Homepage, dark theme, English](screenshots/home-en-dark.webp) |

| Light · Arabic (RTL) | Dark · Arabic (RTL) |
|---|---|
| ![Homepage, light theme, Arabic RTL](screenshots/home-ar-rtl-light.webp) | ![Homepage, dark theme, Arabic RTL](screenshots/home-ar-rtl-dark.webp) |

Captured via Playwright against `php artisan serve`; regenerate with the same tool after frontend changes.

### Gotcha: rebuilding frontend assets

After any change under `resources/js` or `resources/scss`, run `bun run build` (or `bun run dev` for hot reload) — see [CLAUDE.md](../CLAUDE.md#frontend-bundling). Two additional traps observed while working on dark mode:

- **Undefined Sass variables silently break the whole build** (not just one file): `_newspaper.scss` referenced `$font-family-serif`/`$font-family-arabic`, which were never defined (the file's actual variables are `$newspaper-headline-font` / `$newspaper-arabic-headline-font`), and this failed the *admin* bundle too, since `admin.scss` transitively imports `public.scss`.
- **`php artisan serve` can keep serving a stale Vite manifest hash after a rebuild.** If the built JS/CSS filename in the rendered HTML doesn't match `public/build/manifest.json`, run `php artisan optimize:clear` (not just `view:clear`) and, if that doesn't help, restart the `serve` process — it can hold worker state across requests.
- **Duplicate module initialization can silently cancel itself out.** `dark-mode.ts` used to both self-initialize on import *and* get called explicitly from `resources/js/public.js`, registering its click listener twice — every click toggled the theme forward then immediately back, so the button appeared to do nothing with no console error. Modules that export an explicit init function (matching the other `resources/js/public/*.ts` helpers) should not also auto-run on import.

## Files

| File | Purpose |
|------|---------|
| `app/Console/Commands/FetchNewsApiAi.php` | NewsAPI.ai fetcher with caching |
| `app/Console/Commands/FetchNewsDataIo.php` | NewsData.io fetcher with pagination |
| `app/Console/Commands/FetchBahrainNews.php` | RSS feed aggregator |
| `app/Console/Commands/ScrapeArticleContent.php` | Playwright scraper |
| `app/Console/Commands/FetchMissingImages.php` | Image URL scraper |
| `app/Console/Commands/GeneratePlaceholderImages.php` | SVG placeholder generator |
| `app/Console/Commands/GenerateUnslothImages.php` | Unsloth FLUX2 image generator |
| `app/Console/Commands/GenerateArticleImages.php` | Image pipeline orchestrator |
| `app/Services/UnslothImageService.php` | Unsloth API client |
| `app/Services/NewsImageService.php` | Image download/scrape service |
| `app/Models/News.php` | News model with localized fields |
| `resources/views/public/pages/home.blade.php` | Homepage template |
| `resources/scss/public/_newspaper.scss` | Newspaper CSS layout |
| `resources/scss/public/_fonts.scss` | Google Fonts imports |
| `scripts/take-screenshots.ts` | E2E screenshot script |
| `tests/e2e/report/index.html` | HTML report with screenshots |
