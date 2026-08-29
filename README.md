# Jareeda

Jareeda is a bilingual (`en` / `ar`) news CMS built on [TypiCMS](https://typicms.org) and [Laravel 13](https://laravel.com/docs/13.x).

| Runtime | Version |
| --- | --- |
| PHP | 8.5.9 (`^8.4`) |
| Laravel | 13.25.0 |
| TypiCMS Core | 17.0.39 |
| Vite | 8.2.1 |
| Vue | 3.5 |

Latest upgrade notes and screenshots: [docs/upgrade-2026.md](docs/upgrade-2026.md).  
Architecture decision: [docs/decisions/ADR-001-laravel-13-typicms-17.md](docs/decisions/ADR-001-laravel-13-typicms-17.md).  
News pipeline (fetch, images, caching): [docs/NEWS_PIPELINE.md](docs/NEWS_PIPELINE.md) · [docs/NEWSAPI.md](docs/NEWSAPI.md).

| Light | Dark |
| --- | --- |
| ![English home, light theme](docs/screenshots/home-en-light.webp) | ![English home, dark theme](docs/screenshots/home-en-dark.webp) |
| ![Arabic home, light theme, RTL](docs/screenshots/home-ar-rtl-light.webp) | ![Arabic home, dark theme, RTL](docs/screenshots/home-ar-rtl-dark.webp) |

## Table of contents

-   [Quick start](#quick-start)
-   [Features — Core (Jareeda)](#features--core-jareeda)
-   [Requirements](#requirements)
-   [Installation (Jareeda)](#installation-jareeda)
-   [Modules — What Is Actually Enabled](#modules--what-is-actually-enabled)
-   [Testing](#testing)
-   [Artisan — Core Commands](#artisan--core-commands)
-   [Change log](#changelog)
-   [Contributing](#contributing)
-   [Credits](#credits)
-   [License](#license)

## Quick start

```bash
composer install
pnpm install
cp .env.example .env   # if needed
php artisan key:generate --no-interaction
php artisan migrate --no-interaction
pnpm build
php artisan serve --host=127.0.0.1 --port=8010 --no-interaction
```

Public site: http://127.0.0.1:8010/en and http://127.0.0.1:8010/ar  
Admin: http://127.0.0.1:8010/admin (redirects to localized login)

| Command | Description |
| --- | --- |
| `pnpm dev` | Vite dev server |
| `pnpm build` | Production assets |
| `composer run dev` | App, queue, logs, and Vite together |
| `vendor/bin/pint --dirty` | Format changed PHP |

## Features — Core (Jareeda)

Jareeda keeps only what it actively uses. Everything below is exercised in production (`app/Models/News.php:32`, `resources/views/public/pages/home.blade.php:8`, `bootstrap/app.php:30`).

### 1) Bilingual News Aggregation Pipeline

Orchestrated by `news:pipeline` (`app/Console/Commands/NewsPipeline.php:14`) — fetches from **3 source families**, deduplicates by `url` then `title`, and writes to `news` table (`database/migrations/2026_08_14_000001_create_news_table.php:14`):

| Source family | Command | Cache | Notes |
|---|---|---|---|
| RSS (8 feeds: Google EN/AR, BBC, Gulf News, Khaleej, Mirror, Al-Ayam, Al-Jazeera) | `news:fetch-bahrain` | none | 15s HTTP, SimpleXML |
| NewsAPI.ai (Event Registry) | `news:fetch-newsapi` | 12h `newsapi_bahrain_*` | `config/services.php:newsapi` |
| NewsData.io | `news:fetch-newsdata` | 1h `newsdata_*` | paginated, `--pages` |

Deduplication: `articleExists()` checks `url` then `title` before `News::create()`.

### 2) 4-Tier Image Pipeline

`NewsImageService.php:14` → `UnslothImageService.php:41` → SVG fallback (`GeneratePlaceholderImages.php:81`). Ordered by cost/quality:

1. **RSS media:content / enclosure** — extracted during fetch
2. **og:image scrape** — `news:fetch-missing-images` (`FetchMissingImages.php:104`) follows redirects, parses `og:image` / `twitter:image` / first `<img>`
3. **Unsloth FLUX2** — `news:generate-unsloth-images` (`GenerateUnslothImages.php:34`, endpoint `http://localhost:8888`, model `unsloth/FLUX.2-klein-4B-GGUF` via `config/unsloth.php`)
4. **SVG placeholder** — `news:generate-placeholders` (`GeneratePlaceholderImages.php:81`) — deterministic `hsl` from `crc32(title)`, RTL-aware `text-anchor`, category-colored

`news:ensure-images` (`GenerateArticleImages.php:14`) is the legacy fallback wrapper (DiffusionBee → SVG); prefer the three explicit commands above. `news:generate-images` / `news:process-images` / `DiffusionBee` backend (`/Applications/DiffusionBee.app/...`) are **deprecated** — macOS-only, kept for local dev.

> Gotcha: placeholders write to `image` (`GenerateArticleImages.php:194`, `GeneratePlaceholderImages.php:66`), so `fetch-missing-images` (which queries `whereNull('image')`) will skip placeholder rows. Null the column first to re-scrape — see `docs/NEWS_PIPELINE.md`.

### 3) Newspaper Homepage

`resources/views/public/pages/home.blade.php:8` — single-page newspaperlayout with:

* **Featured article** (page 1 only, `getFeaturedImageUrl()` eager, 1200×630) + paginated grid (`$perPage=20`, `paginate(20)`) with lazy images 400×225
* **Category cloud** — `TRIM(category) GROUP BY` → 12 largest, slugified, with `aria` labels
* **SEO** — 3× JSON-LD: `WebSite` (SearchAction), `NewsArticle` (featured), `ItemList` (paginated). Sitemap via `ultrono/laravel-sitemap`, feed via `spatie/laravel-feed`
* **Styling** — `resources/scss/public/_newspaper.scss` + `_fonts.scss` (Playfair Display, Source Serif 4, Inter, Noto Naskh Arabic, Amiri), Bootstrap 5 grid, container-xl

### 4) Localization, RTL & Dark Mode

* Locales `en`/`ar` (`config/typicms.php:42`, `main_locale_in_url: true`) — `SetLocaleFromUrl` / `VerifyLocalizedUrl` middleware (`bootstrap/app.php:58`)
* `dir="rtl"` injected on `<html>` for `ar` (`home.blade.php:174`), `lang-switcher` component, `translatedFormat('l، j F Y')`
* Dark mode: toggle next to offcanvas nav (`resources/js/public/dark-mode.ts`), persisted `localStorage jareeda-theme`, `prefers-color-scheme` default, vars in `data-theme` + `resources/scss/public/_dark-mode.scss`

### 5) Admin AI Image Queue

Queueable `GenerateArticleImage.php:14` (`ShouldQueue`, `tries/backoff` from `config/unsloth.php`, queue `ai-images` on `redis`) + events `ArticleImageGenerated.php:12` / `ArticleImageGenerationFailed.php` + controller `AiImageController.php:18` (`POST /admin/news/{id}/generate-image`, `POST /queue-generate-image`, `GET /image-status`, `DELETE /clear-ai-image` — `routes/ai-image.php:14`). Works sync via `NewsImageService` when queue is `sync` locally.

### 6) TypiCMS 17 Core (Only What Is Wired)

Enabled modules via `ModuleServiceProvider` (`bootstrap/providers.php:19`) — verified by `php artisan route:list --path=admin` (pages, menus, blocks, files, users/roles, translations, history, settings, dashboard). **Not enabled in this deployment:** Projects, Categories, Tags, Events, Contacts, Partners — generic TypiCMS docs left those in README but they have no routes/migrations here.

* **Pages** — nestable drag-drop, `uri` generation, linked to modules
* **Menus** — nestable entries, `Menus::render()` / `@menu`
* **Files** — Uppy + Dropzone, Croppa on-the-fly thumbs (`bkwld/croppa`)
* **Users & Roles** — `spatie/laravel-permission`, passkeys (`spatie/laravel-passkeys`), OTP (`spatie/laravel-one-time-passwords`)
* **Blocks / Translations / History / Settings** — DB-backed, `spatie/laravel-responsecache` + `spatie/laravel-markdown-response` required for auth flow

### 7) Build & Quality

* **Build** — `vite: ^8.2.2`, `laravel-vite-plugin: ^3.2`, `vue: ^3.5`, SCSS, `concurrently` (`composer.json:93` `composer run dev`)
* **Quality** — `laravel/pint` (1.27), `rector/rector` with `RectorLaravel\Set` (`rector.php:12`), `laravel/pail`, `laravel/boost` MCP, `eslint` 10 + `prettier` + `prettier-plugin-organize-imports`
* **Testing** — Playwright e2e only (see [Testing](#testing)). No `tests/Unit` / `tests/Feature` — `phpunit.xml` exists but suites are empty by design; `php artisan test` requires `pestphp/pest` if you want PHP tests.

### URLs

**News (custom):**

* `/en` + `/ar` — newspaper homepage (paginated `?page=`)
* `/en/news/slug` style routes are not used — articles link out to source `url` (`target=_blank`)

**CMS Pages (nestable):**

* `/en/parent-slug/subpage-slug/page-slug`
* `/ar/...` — each translation has its own slug/route (`PagesRoutesServiceProvider`)

## Requirements

-   PHP 8.4+ (8.5.9 is the current local runtime)
-   SQLite (default local) or MySQL 8 / MariaDB
-   Composer 2.10+
-   Node 22+ and pnpm 11+ (or Bun) for Vite 8
-   BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML PHP extensions

## Installation (Jareeda)

> Upstream TypiCMS `composer create-project typicms/base` is **reference only** — Jareeda is already scaffolded. Use the quick start below.

```bash
composer install
cp .env.example .env   # set DB, NEWSAPI_KEY, UNSLOTH_API_ENDPOINT, etc
php artisan key:generate --no-interaction
touch database/database.sqlite   # if using sqlite
php artisan migrate --no-interaction
php artisan storage:link
pnpm install        # or bun install
pnpm build          # or pnpm dev for HMR
php artisan serve --host=127.0.0.1 --port=8000
# or composer run dev  (serve + queue:listen + pail + vite concurrently)
```

* MariaDB: set `'mariadb' => true` in `config/typicms.php:98`
* Assets: `Vite 8` + `laravel-vite-plugin 3` (`vite.config.js:18`). After any `resources/js` or `resources/scss` change, rebuild or the Vite manifest stays stale (`php artisan optimize:clear` may be needed — see `docs/NEWS_PIPELINE.md` gotcha).
* Locales: `config/typicms.php:42` (`en`/`ar`, `main_locale_in_url: true`), `lang_chooser: false`. First locale must match `config/app.php: locale`.

### Publishing / scaffolding modules (reference)

Jareeda keeps modules in `vendor/typicms` + custom `app/Models/News.php` (no `typicms/news` module installed — `bootstrap/providers.php:22` is commented). If you need a new CMS module:

```bash
php artisan typicms:create cats          # creates Modules/Cats
# add TypiCMS\Modules\Cats\Providers\ModuleServiceProvider::class
# to bootstrap/providers.php before ModuleServiceProvider::class
php artisan migrate
# or publish an existing vendor module:
php artisan typicms:publish <modulename>  # copies views/migrations to Modules/
```

See `docs/decisions/ADR-001-laravel-13-typicms-17.md` for upgrade notes.

## Modules — What Is Actually Enabled

Verified via `php artisan route:list --path=admin` and `bootstrap/providers.php:19`. Only these are wired; the rest (Projects, Categories, Tags, Events, Contacts, Partners) are **not installed** — they remain in TypiCMS docs but have no routes/migrations here.

| Module | Status | Notes |
|---|---|---|
| **Pages** | ✅ enabled | Nestable drag-drop, `uri` per translation, sections, linked to modules |
| **Menus** | ✅ enabled | Nestable entries, `Menus::render('menuname')` / `@menu('menuname')` |
| **Blocks** | ✅ enabled | `Blocks::render('blockname')` / `@block('blockname')` |
| **Files** | ✅ enabled | Uppy + Dropzone, Croppa thumbs (`bkwld/croppa: ^9.0`). S3: set `FILESYSTEM_DISK=s3` + `config/croppa.php: src_dir / crops_dir` |
| **Users & Roles** | ✅ enabled | `spatie/laravel-permission: ^8.0` + passkeys + OTP (see core feature 6) |
| **Translations** | ✅ enabled | DB via `/admin/translations`, `__('Key')` / `@lang` |
| **Settings** | ✅ enabled | Title/logo/etc via `/admin/settings` |
| **History** | ✅ enabled | `created/updated/deleted/online/offline` in `history` table, dashboard widget |
| **Sitemap** | ✅ enabled | `ultrono/laravel-sitemap: ^10.0` → `/sitemap.xml` (reads pages) |
| **Feed** | ✅ enabled | `spatie/laravel-feed: ^4.4` |
| **News** | ✅ custom | Not `typicms/news` — local `news` table (`app/Models/News.php:35`, migration `2026_08_14_*`). See pipeline above. No facade `News::latest()` — use `App\Models\News::published()->forLanguage()->recent()` |
| Projects / Tags / Events / Contacts / Partners / Categories | ❌ not installed | Keep docs for reference; publish only if needed via `php artisan typicms:publish <name>` |

**Facades:** upstream TypiCMS adds facades per module (e.g. `News::latest(3)`), but Jareeda's `News` is an app model — call `App\Models\News::published()->latest('published_at')->limit(3)->get()` instead. See `app/Models/News.php:148` scopes.

## Testing

| Suite | Command | Status | What It Covers |
|---|---|---|---|
| **Playwright e2e** | `npm run test:e2e` (`playwright test tests/e2e/screenshot-report.spec.ts:15`) | ✅ **core** | 5 pages × 3 viewports (`playwright.config.ts:12` desktop-chrome/desktop-rtl/mobile-chrome): `homepage-en/ar`, `login-en/ar` (`/otp-login`), `error-404`. Captures `tests/e2e/screenshots/*.png` + HTML report `tests/e2e/report/index.html`. Requires `php artisan serve --host=127.0.0.1 --port=8000`. |
| `npm run test:e2e:report` | `npx tsx tests/e2e/generate-report.ts:12` | ⚠️ helper | Rebuilds report from existing `screenshots/*.png` without re-running browser — useful offline. Duplicates report logic from spec; keep both but spec is source of truth. |
| PHPUnit / Pest | `php artisan test` (`phpunit.xml:7`) | ❌ **empty / irrelevant** | `tests/Unit` + `tests/Feature` dirs do not exist; `composer.json:47` has no `phpunit/phpunit` or `pestphp/pest`. `php artisan test` currently fails (`Class SebastianBergmann\Environment\Console not found` at `vendor/nunomaduro/collision:190`) — install `pestphp/pest` if you want PHP tests, otherwise use Playwright only. |
| `vendor/bin/pint --dirty` | `pint.json` | ✅ lint | Style gate, not tests |
| `vendor/bin/rector --dry-run` | `rector.php:10` | ✅ analysis | `LaravelSetList` rules, not tests |

**Eliminated / deprecated tests:** Empty `tests/Unit`/`tests/Feature` suites removed from core flow. `scripts/capture-screenshots.ts` / `scripts/take-screenshots.ts` / `scripts/check-images.ts` are legacy wrappers around the Playwright spec — use `npm run test:e2e` directly.

Run core verification:

```bash
composer run dev          # app + queue + pail + vite (Vite 8)
npm run test:e2e          # 3-project Playwright run, 60s timeout per page
open tests/e2e/report/index.html
vendor/bin/pint --dirty   # style
```

## Artisan — Core Commands

| Command | File | Core? | Purpose |
|---|---|---|---|
| `typicms:install` / `typicms:database` | `vendor/typicms/core` | ✅ | Install/seed base |
| `news:pipeline` | `NewsPipeline.php:14` | ✅ | **Orchestrator** — fetch all 3 sources + dedup + optional images (`--images --unsloth`) |
| `news:fetch-bahrain` | `FetchBahrainNews.php` | ✅ | RSS 8 feeds |
| `news:fetch-newsapi` | `FetchNewsApiAi.php:14` | ✅ | NewsAPI.ai (12h cache) |
| `news:fetch-newsdata` | `FetchNewsDataIo.php` | ✅ | NewsData.io paginated |
| `news:fetch-missing-images` | `FetchMissingImages.php:14` | ✅ | og:image scrape |
| `news:generate-placeholders` | `GeneratePlaceholderImages.php:14` | ✅ | SVG fallback |
| `news:generate-unsloth-images` | `GenerateUnslothImages.php:14` | ✅ | FLUX2 AI |
| `news:scrape-content` | `ScrapeArticleContent.php` | ⚠️ optional | Playwright full-body scrape |
| `news:ensure-images` | `GenerateArticleImages.php:14` | ⚠️ legacy | DiffusionBee→SVG wrapper, prefer explicit 3 above |
| `news:generate-images` | `GenerateDiffusionBeeImages.php:14` | ❌ deprecated | DiffusionBee macOS-only (`/Applications/DiffusionBee.app`); use Unsloth |
| `news:process-images` | `ProcessArticleImages.php:14` | ❌ deprecated | Thin `NewsImageService` wrapper, duplicates `fetch-missing-images` |
| `news:generate-cover` | `GenerateCoverImage.php` | ⚠️ optional | Header cover image |
| `typicms:publish <name>` / `typicms:create cats` | `vendor/typicms/core` | reference | Publish/scaffold modules to `Modules/` (`bootstrap/providers.php:22`) |

`php artisan list | grep news` is source of truth; duplicate commands above are kept for BC but will be removed.

## Changelog

See [CHANGELOG.md](CHANGELOG.md) and [docs/upgrade-2026.md](docs/upgrade-2026.md).

## Contributing

Please see [CONTRIBUTING](https://github.com/TypiCMS/Base/blob/master/CONTRIBUTING.md) for details.

## Credits

-   [Samuel De Backer](https://github.com/sdebacker)
-   [All contributors](https://github.com/TypiCMS/Base/graphs/contributors)

## License

TypiCMS is an open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
