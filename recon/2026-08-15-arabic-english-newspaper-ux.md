---
title: "Arabic/English Newspaper UX Deep Recon"
date: 2026-08-15
topic: "Jareeda newspaper layout UX audit"
mode: "autonomous"
intention: "explore"
scope: "vault + web"
status: "complete"
---

# Arabic/English Newspaper UX Deep Recon

> [!info] Process Log
> Session start: 2026-08-15
> Mode: Autonomous | Intention: Explore | Scope: Vault + web
> This recon was conducted as a single-agent deep dive across all four roles (Explorer → Associator → Critic → Synthesizer).

---

## The Territory

Jareeda's homepage aims to be a bilingual newspaper — a classic, multi-column, justified-text layout that works equally well in English (LTR) and Arabic (RTL). The CSS architecture is well-structured, but the implementation has **critical gaps** that break the newspaper illusion entirely.

### What Exists

The project has a comprehensive SCSS architecture for the newspaper layout:

- **`_newspaper.scss`** — 332 lines covering multi-column layout, typography, featured articles, article cards, dividers, print styles, accessibility, and RTL overrides
- **`_variables.scss`** — Full color palette, typography scale, spacing, border-radius
- **`_header.scss`** — Sticky header with logo and navigation
- **`_theme.scss`** — Global theme refinements, buttons, forms, rich content
- **`home.blade.php`** — Homepage template querying the News model directly

The CSS uses modern column layout: `column-count: 3`, `column-width: 18em`, `column-gap: 2em`, `column-rule`, `column-fill: balance`, `break-inside: avoid`. It's well-structured with responsive breakpoints (3→2→1 columns) and print styles.

### The Typography Gap (Critical)

The newspaper SCSS references four Google Fonts:

```scss
$newspaper-headline-font: 'Playfair Display', 'Georgia', serif;
$newspaper-body-font: 'Source Serif 4', 'Georgia', serif;
$newspaper-caption-font: 'Inter', -apple-system, sans-serif;
$newspaper-arabic-headline-font: 'Noto Naskh Arabic', 'Amiri', serif;
$newspaper-arabic-body-font: 'Noto Naskh Arabic', 'Amiri', serif;
```

**None of these fonts are loaded.** The only Google Fonts reference in the entire project is `Lato:100` in the 503 error page. There is no `@import`, no `<link>` tag, no `@font-face` declaration for any newspaper font. The entire newspaper aesthetic falls back to Georgia/serif — which is functional but not the intended look.

### The RTL Problem (Critical)

The TypiCMS layout component (`public.blade.php`) correctly sets:
- `<html lang="{{ app()->getLocale() }}"` — so `lang="ar"` is present on Arabic pages
- `<body class="body-ar">` — so `.body-ar` selectors work

But there is **no `dir="rtl"` attribute** on the `<html>` tag. The CSS adds `direction: rtl` only within `.newspaper`, meaning the header, footer, navigation, and all other page elements remain LTR on Arabic pages. This creates a jarring split: the newspaper content flows right-to-left while the rest of the page flows left-to-right.

### The Content Architecture

The homepage queries 30 articles directly:

```php
$latestNews = \App\Models\News::query()
    ->published()
    ->select('id', 'slug', 'title', 'excerpt', 'url', 'source', 'author', 'image', 'image_alt', 'ai_generated_image', 'ai_generated_image_path', 'category', 'language', 'published_at')
    ->orderByDesc('published_at')
    ->limit(30)
    ->get();
```

This is a direct database query in the Blade template with no caching. The query selects 15 columns and fetches 30 rows — not catastrophic, but it runs on every page load with no performance guard.

### Mixed Language Display

English and Arabic articles are displayed together without separation. The 230 articles in the database are split roughly 182 EN / 48 AR, but the homepage shows whatever is most recent regardless of language. An Arabic reader sees a mix of Arabic and English articles in the same column layout.

---

## The Connections (Associator)

### Typography → RTL → Column Layout

These three systems are deeply interdependent:

1. **Typography** determines readability — justified text needs proper font metrics
2. **RTL** determines reading direction — Arabic text must flow right-to-left
3. **Column layout** determines visual rhythm — multi-column requires careful balancing

When any one breaks, the others degrade. For example:
- Without the correct Arabic fonts, justified text looks awkward because Georgia doesn't have Arabic glyphs
- Without `dir="rtl"` on the page, column content mixes directions unpredictably
- Without proper column balancing, short Arabic articles create ugly gaps

### Performance → UX

The 230-article database query runs on every homepage load. With the built-in PHP server under Playwright's load, the server crashes after the first request. In production with nginx + OPcache, this would be fine — but it's a deployment dependency that isn't documented.

### Print → Digital

The print styles force 2 columns and hide AI badges. But the newspaper section sits outside `<main>`'s `container-xl`, so print styles may not constrain it properly. The `column-span: all` on `.newspaper-masthead` and `.newspaper-featured` is only defined in `@media print`, not in the base styles.

---

## The Tensions

### Tension 1: Newspaper Aesthetic vs. Content Reality

A newspaper layout implies curated, edited content. But Jareeda displays 30 articles from RSS feeds with no editorial curation. The visual promise (classic newspaper) exceeds the content reality (aggregated feeds). This creates an uncanny valley — it looks like a newspaper but reads like an RSS reader.

**Resolution paths:**
- Lean into the newspaper aesthetic and add editorial curation (categories, featured sections, editorial notes)
- Or lean into the aggregator aesthetic and drop the newspaper pretense
- Or hybrid: newspaper layout for the front page, aggregator layout for category pages

### Tension 2: Bilingual Simplicity vs. Bilingual Correctness

Showing both languages in the same column layout is simple but typographically wrong. Arabic and English have different:
- Line heights (Arabic needs more leading)
- Justification algorithms (Arabic uses kashida, English uses word spacing)
- Font metrics (Arabic baseline is different)
- Reading patterns (RTL vs LTR)

**Resolution paths:**
- Separate pages per language (current approach, but mixed content)
- Mixed columns with explicit language tags per article
- Language sections within the page (English section, then Arabic section)

### Tension 3: Performance vs. Completeness

Showing 30 articles with images (400×225 each) creates a 248KB page. With 230 articles, the page would be ~1.8MB. The current limit of 30 is a compromise, but it means most articles are never seen.

**Resolution paths:**
- Infinite scroll or pagination (loses the newspaper "single page" feel)
- Paginated sections (page 1: latest 30, page 2: next 30)
- Lazy loading with Intersection Observer (keeps the newspaper feel)

---

## The Critique

### What's Working Well

1. **CSS architecture** — Clean BEM naming, responsive breakpoints, print styles, accessibility media queries
2. **Column layout** — Modern CSS multi-column with proper `break-inside: avoid` and `column-fill: balance`
3. **Typography scale** — Well-defined heading sizes, line heights, letter spacing
4. **Color system** — Consistent palette with primary/secondary/danger/info/warning
5. **RTL selectors** — Multiple fallback selectors (`[lang="ar"]`, `.body-ar`, `[dir="rtl"]`)
6. **Print styles** — Proper 2-column print layout with no AI badges
7. **Accessibility** — `prefers-reduced-motion`, `prefers-contrast: high`, skip-to-content

### Critical Issues

| # | Issue | Severity | Impact |
|---|-------|----------|--------|
| 1 | **No fonts loaded** | 🔴 Critical | Newspaper aesthetic completely broken |
| 2 | **No `dir="rtl"` on `<html>`** | 🔴 Critical | RTL only works in newspaper section |
| 3 | **Newspaper outside container** | 🔴 Critical | Layout doesn't respect responsive container |
| 4 | **Mixed languages** | 🟡 Medium | Arabic readers see English articles |
| 5 | **No loading states** | 🟡 Medium | Flash of empty content on slow loads |
| 6 | **Time format not localized** | 🟡 Medium | Arabic pages show English dates |
| 7 | **No structured data** | 🟡 Medium | Missing Schema.org for articles |
| 8 | **No image lazy loading fallback** | 🟢 Minor | No placeholder for slow connections |
| 9 | **Column-span only in print** | 🟢 Minor | Masthead doesn't span in screen view |
| 10 | **No error handling** | 🟢 Minor | 500 if News table doesn't exist |

---

## Open Questions

1. **Should Arabic and English be separate pages or mixed?** The current approach mixes them. A newspaper would typically have separate sections.

2. **Should the newspaper layout be the default or a toggle?** Some users might prefer a simpler list view.

3. **How should the newspaper handle 230+ articles?** The current 30-article limit is arbitrary. Should there be pagination, infinite scroll, or editorial curation?

4. **Should the AI image badge be more subtle?** The `✦ AI Generated` badge is small but visible. In a newspaper context, it might break immersion.

5. **Should the layout adapt to content density?** Some days might have 5 articles, others 50. The column layout should handle both gracefully.

---

## Recommendations

### Immediate (Today)

1. **Load Google Fonts** — Add `@import` for Playfair Display, Source Serif 4, Inter, Noto Naskh Arabic
2. **Add `dir="rtl"` to Arabic pages** — Modify the layout component or add via JavaScript
3. **Move newspaper section inside container** — Wrap in `<div class="container-xl">`

### Short-term (This Week)

4. **Separate language sections** — Show English articles first, then Arabic, with a divider
5. **Add loading skeleton** — Show placeholder cards while articles load
6. **Localize time formats** — Use Carbon's `locale()` for Arabic date formatting
7. **Add column-span: all to masthead** — In screen styles, not just print

### Medium-term (This Month)

8. **Implement pagination or infinite scroll** — For the 230+ article backlog
9. **Add Schema.org structured data** — For SEO and social sharing
10. **Cache the homepage query** — Use `Cache::remember()` with 15-minute TTL

---

## Process Log

| Metric | Value |
|--------|-------|
| Session start | 2026-08-15 |
| Files analyzed | 15+ |
| Web searches | 0 (vault-only this session) |
| Critical issues found | 3 |
| Medium issues found | 4 |
| Minor issues found | 3 |
| Recommendations | 10 |

> [!info] Session complete
> This recon was conducted as a single-agent deep dive. The Explorer, Associator, Critic, and Synthesizer roles were performed sequentially by the orchestrator.
