# R1 — Explorer (web): Arabic/RTL localization landscape

**Date:** 2026-08-12 · **Round 1**

## 1. State of the art (2024–2026)
- Mature multilingual CMSs split localization into a **content layer** (field-level translation, e.g. spatie/laravel-translatable JSON) and a **presentation layer** (root `dir="rtl"` + `lang="ar"`), rather than per-component hacks.
- Best practice is moving to **CSS logical properties** (`margin-inline-start`, `inset-inline`) or build-time tools (PostCSS RTLCSS) — no duplicate stylesheet trees.

## 2. Bootstrap 5 RTL in Vue 3
- Bootstrap 5 has no dynamic flip; options: official `bootstrap.rtl.min.css` bundle, `postcss-rtlcss` (combined-mode generates LTR+RTL rules in one stylesheet, switched by `[dir]` on the root), or logical-properties migration.
- Bootstrap 5 already uses logical utilities (`ms-*`, `pe-*`) in core; **custom Vue SFC/SCSS must not hardcode left/right**.

## 3. Arabic typography
- Recommended webfonts: **Cairo**, **Tajawal**, IBM Plex Sans Arabic, Noto Naskh/Kufi Arabic.
- Arabic reads smaller/denser at equal px: body ≥ 15–16px, **line-height 1.6–1.8** vs ~1.4 for Latin.
- **Number policy is a decision**: Western digits (modern apps/admin) vs Arabic-Indic (regional/consumer).

## 4. Pluralization & dates
- Arabic has **6 CLDR plural categories** (zero/one/two/few/many/other); vue-i18n delegates to `Intl.PluralRules` (native support).
- Delegate date/number formatting to `Intl.DateTimeFormat` / `Intl.NumberFormat` so client reactivity matches the locale.

## 5. Admin RTL vs public RTL
- Enterprise CMS (WordPress, Drupal, Strapi) **flip both** when Arabic is selected.
- Mixed-language editors sometimes prefer LTR admin; recommendation: allow a locale/user preference flip, and **isolate code/JSON/LTR metadata with `dir="ltr"` wrappers**.

**Tension noted:** full admin flip (user expectation) vs mixed-language editing friction (editor reality).
