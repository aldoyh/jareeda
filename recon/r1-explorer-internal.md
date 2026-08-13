# R1 — Explorer (internal codebase map): RTL readiness evidence

**Date:** 2026-08-12 · **Round 1**

## Where locale/direction lives
- `config/typicms.php`: `locales = ['en' => 'en_US', 'ar' => 'ar_SA']`, `main_locale_in_url = true`.
- Middleware: `SetLocaleFromUrl`, `SetLocaleFromUser`, `SetTranslatableFallbackLocaleToNull` (bootstrap/app.php).
- Helpers (`app/helpers.php`): `mainLocale()`, `enabledLocales()` (checks per-locale **status setting**), `localeAndRegion()`, `getBrowserLocaleOrMainLocale()`.
- Vue bridge: `window.TypiCMS.locale`, `content_locale`, `locales`, `locale_region` consumed in `admin.js`, `ItemList.vue`, `ItemListTree.vue`, `FilesField.vue`, `History.vue`, `FileManagerContent.vue`, `useHelpers.ts`.
- Content-locale switcher (`set-content-locale.ts`) POSTs `/admin/_locale/{locale}` — switches **content** locale only; **never touches UI locale or `dir`**.

## Hard evidence of missing RTL
- **No `dir` attribute anywhere.** `<html>` is rendered by vendor `typicms/core` layouts; compiled admin master is `<html lang="..." data-bs-theme="auto">` — no `dir`. Public layouts likewise.
- `resources/views/` contains only `errors/` — all layout/blade chrome comes from the composer package.

## Physical LTR properties (~25 files)
- Admin: `_navbar.scss` (padding-left/right, margin-right, margin-left), `_sidebar.scss` (border-right, text-align:left, margin-left:auto), `_tiptap.scss` (border-left blockquote, text-align:left, padding-left), `_alertify.scss` (left/right, float), `_buttons.scss` (float:right), `_sortable-tree.scss` (margin-left ×4), `_filemanager.scss` (right:5px ×2, text-align:left), `_item-list-table.scss`, `_permissions.scss` (margin-right), `_history.scss` (margin-right), `_preview.scss` (right:0.5rem), `_header.scss`, `_content.scss`, `_item-list-pagination.scss`, `_right-column.scss`.
- Public: `_navigation.scss` (right:0), `_anchor-top.scss` (right:15px/30px), `_share-links.scss` (margin-right), `_document-list.scss` (text-align:left, padding-left), `_theme.scss` (padding-left), `_hamburger.scss` (left:calc(50%...)), `public.scss` (border-left, margin-left, float-left/right content handling).
- **Directional lucide icon font**: `.icon-chevron-right/left`, `.icon-arrow-left` in both `admin/_lucide.scss` and `public/_lucide.scss` — needs mirroring for RTL.
- Tiptap: `TextAlign` extension imported in `TiptapEditor.vue:452`.

## Date formatting hazard
- `useHelpers.ts`: `formatDate` = `new Date(date).toLocaleDateString(TypiCMS.locale_region)` → with `locale_region = ar_SA`, Intl defaults to **Hijri (islamic-umalqura) calendar + Eastern Arabic numerals**.

## Locale inventory inconsistency
- `lang/en/languages.php` lists fr/es/nl; those lang directories are **deleted** on this branch; config has en/ar only.

## Enabling mechanism
- Arabic needs `typicms.ar.status = 1` (seeded via SettingsSeeder alongside `website_title = جريدة`) — locale enabling is DB-settings-driven via `enabledLocales()`.
