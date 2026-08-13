# R3 — Explorer (content fallback semantics & SEO)

**Date:** 2026-08-12 · **Round 3**

## 1. Google's stance on partially translated sites
- **"Localized versions of a page are only considered duplicates if the main content remains untranslated"** (Google Search Central).
- Serving English body copy at `/ar/...` URLs → **soft 404 / thin duplicate**.
- `hreflang` promising Arabic while the crawler sees English → tags **ignored**, indexation drops for the secondary locale.

## 2. Fallback policy patterns (production CMS)
1. **Silent fallback to EN** (spatie default) — SEO-hostile, confusing UX.
2. **Publication gating** — untranslated articles are 404 (or localized "not yet available" notice) until an editor publishes the Arabic version.
3. **Progressive fallback + banner** — page resolves with EN text + prominent "Available in English — Arabic translation in progress" alert bar.
- WordPress WPML/Polylang let admins choose: hide from secondary archives / redirect to default / fallback post with banner.

## 3. Locale switcher UX
- **Context-aware switcher:** before routing, check if the model has a target-locale translation; if not → dim the item, badge "EN only", or send the user to the Arabic homepage (`/ar`) instead of a dead 1:1 mapping.
- **Soft landing:** forced `/ar/...` on untranslated content → EN body + translation-status alert + link back to EN edition.

## 4. Laravel/spatie implementation shape
```php
$title = $item->getTranslation('title', 'ar', false); // no auto fallback
if (is_null($title)) {
    // policy: redirect to /en · fallback banner · or abort(404)
}
```
- **Hreflang/sitemap cleanliness:** only include `/ar/` URLs where `ar` translations actually exist; omit untranslated records from the Arabic sitemap.

**Complication surfaced:** with `SetTranslatableFallbackLocaleToNull`, the app currently has the *worst* of both worlds — silent English-at-ar-URL is avoided, but pages render empty unless a policy is chosen deliberately.
