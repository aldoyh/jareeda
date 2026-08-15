# Bahrain News Pipeline — Production Documentation

## Status: ✅ PRODUCTION READY

## Platform Overview

Jareeda is a multilingual Bahrain news platform with a classic newspaper-style layout.

| Metric | Value |
|--------|-------|
| Total Articles | 230+ |
| With Images | 180 (100%) |
| With Full Content | 230 (100%) |
| Languages | English, Arabic |
| Homepage Display | 30 articles (featured + grid) |

## E2E Verified Screenshots

| Screenshot | Size | Verified |
|------------|------|----------|
| Homepage (English) | 4,403KB | ✅ 30 articles with images |
| Homepage (Arabic) | 5,030KB | ✅ 30 articles with RTL layout |
| Login (English) | 65KB | ✅ OTP authentication |
| Login (Arabic) | 59KB | ✅ RTL login page |
| 404 Error | 445KB | ✅ Error page |

Screenshots location: `tests/e2e/screenshots/`

## Data Sources

### NewsAPI.ai (Primary)
- **API Key**: `NEWSAPI_KEY` in `.env`
- **Languages**: English, Arabic
- **Caching**: 12-hour TTL to preserve API tokens
- **Coverage**: 30,000+ news publishers worldwide

### RSS Feeds (Secondary)
- Biz Bahrain (bizbahrain.com/feed)
- Bahrain This Week (bahrainthisweek.com/feed)
- Google News (Bahrain search, EN + AR)

## Commands

```bash
# Fetch news from NewsAPI.ai (cached 12 hours)
php artisan news:fetch-newsapi --days=7 --limit=100

# Fetch news from RSS feeds
php artisan news:fetch-bahrain --days=7 --limit=50

# Scrape full article content with Playwright
php artisan news:scrape-content --limit=50

# Download/generate images for articles
php artisan news:process-images --limit=100

# Capture E2E screenshots
npx tsx scripts/take-screenshots.ts

# Run Playwright E2E tests
bun run test:e2e
```

## Image Pipeline

1. **RSS Feed Images** — Extracted from `media:content`, `enclosure`, `media:thumbnail`
2. **Article Page Scraping** — `og:image` meta tag from source page
3. **First Image** — First `<img>` tag on article page
4. **AI Generation** — Unsloth FLUX2 fallback (requires GPU server)

## Database Schema

```sql
CREATE TABLE news (
    id INTEGER PRIMARY KEY,
    slug VARCHAR UNIQUE,
    title JSON,           -- {"en": "...", "ar": "..."}
    body JSON,            -- Full article content
    excerpt JSON,         -- 300-char summary
    url VARCHAR,          -- Source URL
    source VARCHAR,       -- News source name
    author VARCHAR,
    image VARCHAR,        -- Featured image URL
    image_alt VARCHAR,
    ai_generated_image BOOLEAN DEFAULT FALSE,
    ai_generated_image_path VARCHAR,
    category VARCHAR,
    language VARCHAR(2) DEFAULT 'en',
    published_at DATETIME,
    is_featured BOOLEAN DEFAULT FALSE,
    created_at DATETIME,
    updated_at DATETIME
);
```

## Homepage Display

The homepage (`resources/views/public/pages/home.blade.php`) displays:
- Masthead with title, subtitle, and current date
- Featured article (full width with large image)
- Article grid (multi-column newspaper layout)
- Each article shows: title, image, excerpt, category, author, source, date

## Files

| File | Purpose |
|------|---------|
| `app/Console/Commands/FetchNewsApiAi.php` | NewsAPI.ai fetcher with caching |
| `app/Console/Commands/FetchBahrainNews.php` | RSS feed fetcher |
| `app/Console/Commands/ScrapeArticleContent.php` | Playwright scraper command |
| `app/Console/Commands/ProcessArticleImages.php` | Image processing command |
| `app/Services/NewsImageService.php` | Image download/scrape/generate |
| `app/Services/UnslothImageService.php` | AI image generation client |
| `app/Models/News.php` | News model with scopes |
| `resources/views/public/pages/home.blade.php` | Homepage view |
| `resources/scss/public/_newspaper.scss` | Newspaper layout CSS |
| `scripts/take-screenshots.ts` | E2E screenshot capture |
| `docs/PROPOSAL.html` | Technical proposal |
| `docs/NEWS_PIPELINE.md` | This documentation |
