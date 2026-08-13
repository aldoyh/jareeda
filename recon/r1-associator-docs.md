# R1 — Associator (docs): documented stack capabilities

**Date:** 2026-08-12 · **Round 1**

## Laravel 12
- Pluralization: Symfony translator; Arabic's 6 forms supported via pipe-delimited strings / JSON plural strings formatted for the locale.
- Numbers/dates: `Number::currency()`, Carbon `->translatedFormat()`, `Carbon::setLocale('ar')`.

## spatie/laravel-translatable ^6.11
- JSON column storage (`{"en": "...", "ar": "..."}`), `whereTranslation()` / JSON path scopes, configurable `fallback_locale`. **No inherent RTL logic** — direction is frontend-driven. Confirms: content layer vs presentation layer split.

## vue-i18n (legacy:false)
- ICU MessageFormat supports Arabic's 6 categories; `pluralRules` option needed.
- Directionality is a manual concern: watch locale, set `document.documentElement.dir`.

## Bootstrap 5.3
- **Native, first-class RTL support built with RTLCSS**: `dir="rtl"` + `lang="ar"` on `<html>`, RTL CSS build, logical utilities (`ps-*`/`pe-*`).

## Tiptap 3 / Uppy 5
- Tiptap: content direction via `editorProps.attributes.dir`, TextAlign extension interplay.
- Uppy: i18n via `locales` option; dashboard respects document direction.

**Net:** every layer of the stack has a documented Arabic/RTL path; nothing blocks full localization — but all of it is unconfigured in the project today.
