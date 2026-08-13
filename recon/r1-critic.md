# R1 — Critic: stress-test of the current Arabic implementation

**Date:** 2026-08-12 · **Round 1**

## 1. "Complete ✅" covers translation only — RTL is the whole game
`ARABIC_TRANSLATION_COMPLETE.md` defers RTL to "CSS based on dir=rtl" — which doesn't exist. Admin `<html>` has **no `dir` attribute**, no RTL build, no RTL-aware SCSS. Arabic users get LTR-aligned Arabic text.

## 2. Pluralization broken in both layers
- `lang/ar.json:31` — `"# translations": "No translations|1 translation|{count} translations"` is **English verbatim in the Arabic file**.
- vue-i18n has **no `pluralRules`** (Arabic needs 6 CLDR categories).
- Laravel `trans_choice` needs full 6-form sets; none provided.

## 3. vue-i18n has no `fallbackLocale`; switching is half-wired
Missing keys render raw. `switchLocale`/`set-content-locale` switches **content** locale, not the UI locale; nothing updates `dir`.

## 4. `ar_SA` is a calendar/numeral time bomb
`Intl.DateTimeFormat('ar-SA')` / Carbon `ar_SA` default to **Hijri (Umm al-Qura) + Eastern Arabic numerals (٠١٢٣)**. `useHelpers.ts` formats via browser Intl defaults with no policy. Either deliberate or it's accidental.

## 5. No Arabic font strategy
No `font-family` for `[lang=ar]` anywhere; OS fallback for Arabic script will be inconsistent.

## 6. Locale inventory inconsistent
`languages.php` lists fr/es/nl; dirs deleted; config has en/ar. Dead keys; upstream merge churn (branch merges `TypiCMS:master`).

## 7. Coverage is a snapshot
No CI parity check between `en.json` and `ar.json`; the "764 keys" claim rots on the next added string.

## 8. Runtime data partially Arabic
- `SettingsSeeder`: only 2 `ar` settings.
- `TranslationSeeder`: ~13 DB keys for ar.
- `SetTranslatableFallbackLocaleToNull` → models without `ar` content return **null** → empty pages. Fallback policy silently undefined.

**Priority order:** RTL + `dir` → plural rules (PHP + Vue) → date/numeral policy → fonts → fallback semantics → locale inventory → CI parity.
