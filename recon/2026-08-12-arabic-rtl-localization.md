---
title: "Recon: Arabic/RTL Localization for Jareeda"
date: 2026-08-12
type: recon
mode: explore
tags: [arabic, rtl, localization, typicms, laravel, vue, bootstrap]
session: deep-recon-2026-08-12
status: draft
---

> [!info] Process log
> **Session:** deep-recon (autonomous, explore) — 2026-08-12, ~22:00 → 22:45 · **4 rounds, 12 agents** · ~32k tokens, ~9 min. Full metrics in `recon/_metrics.md`.
> **Steering update (post-R3):** the team confirmed the product focuses on **news for Bahrain and about Bahrain**. Round 4 verified Bahrain-specific conventions (r4-explorer-bahrain*.md) and resolved Tension T3: `ar_BH` (not `ar_SA`), Gregorian + Western digits, MSA, BHD. See the **Bahrain resolution** notes in T3 and Workstream 4.
> **Environment note:** run inside the Jareeda Laravel repo, not an Obsidian vault — the deep-recon skill's `.Codex` role files and `Task` tool don't exist here, so the protocol was adapted to the available agents (web researcher, docs researcher, code searcher, code reviewer) and the orchestrator synthesized the final document. Wikilinks are replaced with repo-relative file links; per-round agent reports are in `recon/rN-*.md`.
> **Corrections applied:** none structural; date/numeral claims were cross-checked across r2 and r3 reports and presented as a tension rather than settled.

---

# The Territory

Jareeda (جريدة — "newspaper") is a fork of TypiCMS, a multilingual Laravel 12 CMS with a Vue 3 + Bootstrap 5 admin and a Blade public theme. The branch in question is `arabic`. The honest summary of the state of the work is: **the *translation* is done; the *localization* has not started.**

## What exists (verified in the repo)

- **A complete-ish translation corpus.** `lang/ar.json` (764 keys) is wired into vue-i18n in `resources/js/admin.js` alongside `en.json`; 7 PHP lang files (`lang/ar/`: actions, auth, passwords, pagination, http-statuses, validation, languages) cover the backend. `ARABIC_TRANSLATION_COMPLETE.md` documents the work and its verification.
- **Real locale plumbing.** `config/typicms.php` declares `locales = ['en' => 'en_US', 'ar' => 'ar_SA']` with `main_locale_in_url = true`. ⚠️ **`ar_SA` is wrong for a Bahrain product** — should be `ar_BH` (see Tension T3). This one mapping is what currently forces the admin's Intl date formatting toward the Hijri calendar and Eastern Arabic numerals. Middleware handles locale from URL and user (`SetLocaleFromUrl`, `SetLocaleFromUser`), plus `SetTranslatableFallbackLocaleToNull`. Helpers in `app/helpers.php` (`mainLocale()`, `enabledLocales()`, `localeAndRegion()`) support URL-prefixed routing (`/en/...`, `/ar/...`). Settings seeding adds `ar`-group settings (website_title **جريدة**, status 1).
- **Content infrastructure.** spatie/laravel-translatable JSON columns, per-locale editing tabs via translatable-bootforms, a Vue language switcher (`switchLocale`), and a content-locale POST endpoint (`/admin/_locale/{locale}`).

## What doesn't exist (verified in the repo)

- **No `dir` attribute anywhere.** The `<html>` element is rendered by the vendor `typicms/core` layouts — the compiled admin master is `<html lang="..." data-bs-theme="auto">`, with no `dir`. Local `resources/views/` contains only `errors/`.
- **~25 SCSS files hardcode LTR.** Physical `left`/`right`, `margin-*`, `padding-*`, `float`, `text-align` appear throughout the admin (`_sidebar.scss` border-right and `text-align:left`; `_navbar.scss`; `_tiptap.scss`; `_alertify.scss`; `_sortable-tree.scss`; `_filemanager.scss`; `_buttons.scss` float:right) and the public theme (`_navigation.scss`, `_anchor-top.scss`, `_share-links.scss`, `_document-list.scss`, `_hamburger.scss`, `public.scss`). The lucide icon font encodes directional chevrons/arrows that must mirror under RTL.
- **Broken Arabic pluralization.** `lang/ar.json` line 31 contains the English string **verbatim** ("No translations|1 translation|{count} translations"); vue-i18n has no `pluralRules` (Arabic needs six CLDR categories: zero/one/two/few/many/other); Laravel lang files don't supply six-form sets either.
- **No date/numeral policy.** `resources/js/composables/useHelpers.ts` formats dates with `toLocaleDateString(TypiCMS.locale_region)` — and `ar_SA` makes Intl default to the **Hijri (Umm al-Qura) calendar and Eastern Arabic numerals**. The app has silently inherited a calendar and a numeral system nobody chose.
- **No Arabic font strategy.** Nothing sets a font stack for `[lang=ar]`; Arabic renders via whatever the OS falls back to.
- **No `fallbackLocale`** in vue-i18n — a missing key renders as raw text.
- **Inconsistent locale inventory.** `lang/en/languages.php` still lists fr/es/nl, but those lang directories were deleted on this branch and config has only en/ar — dead keys, and merge churn against upstream `TypiCMS:master`.
- **Undefined content fallback.** With `SetTranslatableFallbackLocaleToNull`, models lacking `ar` content return `null` — pages render empty unless a fallback policy is chosen. Only ~13 DB translation keys and 2 settings are seeded for `ar`.

**The framing in one line:** the translation corpus is the mechanical 40% — a one-time, automatable effort. The remaining 60% is a set of *policy decisions* (direction, calendar, numerals, fonts, fallback, admin posture) wrapped in a stack-specific engineering effort. `ARABIC_TRANSLATION_COMPLETE.md` should read "translation complete; localization pending."

---

# The Possibility Space (competing framings)

Five distinct framings emerged across the three rounds. They are not mutually exclusive — they are *layers* that can be sequenced differently.

## Framing A — Public RTL first, admin later (the 80/20 path)
Flip the reader-facing site (`dir="rtl"` + Arabic font + explicit date/numeral policy) and keep the admin as a localized-but-LTR tool with `dir="auto"` inputs. Delivers value to the audience immediately; defers the expensive component-flipping work (Popper, TomSelect, alertify, Tiptap toolbar) that the admin would require. **Cost:** the public theme still has ~10 SCSS files of physical-property debt — "public is cheap" is wrong (see Tension 2), but it's *contained* to one surface.

## Framing B — Full flip (admin + public) via a build-time RTL tool
Adopt **postcss-rtlcss in combined mode** (one stylesheet containing LTR and RTL rules, switched by the root `dir`), Bootstrap 5's official RTL build, logical properties for new code, and a `dir="rtl"` root driven by locale. Matches what WordPress/Filament/Nova do and what Arabic-first users expect. **Cost:** the R3 Critic's strongest warning is that a *parallel* RTL stylesheet over composer-vendor CSS is a maintenance trap — combined-mode avoids the parallel artifact, but upstream `typicms/core` and Bootstrap updates can still silently reintroduce physical properties.

## Framing C — Logical-properties refactor, no build tool
Migrate the ~25 SCSS files to `margin-inline-start`/`inset-inline`/`:dir()` by hand and let direction happen natively. Elegant, modern, no pipeline. **Cost:** R3 Critic's top-ranked risk — manual refactors of legacy CSS leave orphaned physical properties (borders, shadows, flex direction) that surface only after shipping. Realistic only if paired with A or B.

## Framing D — Hybrid admin (LTR shell + bilingual editing UX)
Neutral LTR admin shell with localized Arabic labels; document-level locale tabs or side-by-side dual-pane editing for spatie translatable fields; **explicit `dir="rtl"` wrappers on Arabic tab panes** (not bare `dir="auto"`, whose first-strong-character heuristic bleeds on Latin-leading fields); optional persisted user-preference flip (`users.admin_direction`). This is where the Contentful/Strapi/Gutenberg bilingual-editing consensus lands — and it's the most defensible *editor* experience, at the cost of not mirroring the chrome Arabic-first admins expect.

## Framing E — Content strategy before CSS
Decide fallback semantics and SEO posture first: per-page publication gating (untranslated articles 404 with a localized notice), context-aware language switcher (dim/"EN only"/land on `/ar` home), and hreflang/sitemap limited to models that actually have `ar` translations. Google treats English-at-`/ar/` as thin duplicates and ignores mismatched hreflang — so this framing argues the *content* policy is the thing that damages the product fastest if left undefined, CSS debt notwithstanding.

**The synthesis across framings:** E is the cheapest decision and the most dangerous to defer; A/B is the audience-facing core; C/D resolve the admin question. A credible sequence is **E → A → C/D (with B only if the flip scope grows)** — but the sequence itself is the open question.

---

# Tensions

## T1 — Admin flip vs. LTR shell (the central clash)
R2 Explorer: WordPress, Filament, Nova all flip; Arabic editors expect it. R2 Critic: bilingual editors (Gutenberg, Strapi, Contentful) prefer a stable LTR/neutral shell; a mirrored admin hurts mixed-language work (URLs, slugs, JSON fields, IDs). The middle paths — preference toggle, side-by-side panes, explicit RTL wrappers — are all more work than either pole. **This is a product decision that only the newsroom can answer**, and it's the pivot on which the admin estimate swings (3 days vs. weeks).

## T2 — Build-time tooling vs. manual logical properties
R2 Critic: a parallel RTL stylesheet piped over vendor CSS is a maintenance trap. R3 Critic: skipping build-time tooling and hand-refactoring 25+ legacy SCSS files leaves orphaned physical CSS. The reconciling position — postcss-rtlcss *combined mode* (no parallel artifact) + logical properties for new code — is technically coherent but unproven against this specific vendor-CSS-heavy, upstream-merging codebase. The honest takeaway: **this tension is resolved by a spike, not by argument.**

## T3 — Gregorian + Western digits vs. Hijri + Eastern numerals → **resolved by the Bahrain steering**
R2: modern pan-Arab media/e-commerce force `gregory` + `latn`; `ar_SA` defaults to `islamic-umalqura` + `arab`, and Hijri is the civic expectation for Saudi official content. R3: forcing Gregorian on a Saudi-region newspaper signals an out-of-touch product. **Round 4 verification settles it for this product:** Bahraini media (Al Ayam, Al-Watan, BNA) use **Western digits (0–9) and Gregorian dates with Arabic month names** (e.g. 12 أغسطس 2026), and `ar-BH` defaults to `gregory` + `latn` in CLDR — unlike `ar_SA`. So:
- **Change `config/typicms.php`: `'ar' => 'ar_SA'` → `'ar' => 'ar_BH'`.** This single change fixes the accidental Hijri/Eastern-numeral rendering in `useHelpers.ts` and the `locale_region` bridge.
- Keep **Hijri secondary-only** (religious occasions/holidays) — not primary article dates.
- Set `calendar: 'gregory'` and `numberingSystem: 'latn'` explicitly anyway (defensive, and so PHP Carbon and JS Intl can't disagree).
- The old tension is not dead — it's scoped: it only resurfaces if/when Saudi or GCC-wide editions are added.

## T4 — Content fallback semantics
Silent English at `/ar/` URLs = soft 404s/thin duplicates and ignored hreflang. The options — gating (404 until translated), fallback banner, context-aware switcher, redirect to EN — each trade editorial friction against SEO integrity. Today's middleware default (return `null`) is the one option nobody would deliberately pick: **empty pages**.

## T5 — Locale inventory & upstream drift
The branch deleted es/fr/nl while `languages.php` still lists them, and it merges `TypiCMS:master`. Every upstream merge is a collision point for the RTL work (vendor layouts, vendor CSS, Bootstrap bumps). Committing to en/ar-only (and purging dead keys) or restoring the deleted locales is a small decision with outsized merge consequences.

---

# What full localization actually entails (stack-mapped)

Not a plan — a map of the workstreams the framings imply, each grounded in evidence from the reports:

1. **Directional root.** `dir` + `lang` on `<html>` for both admin and public layouts — currently owned by vendor `typicms/core` views (needs overriding/publishing). Trivial in itself; it is the trigger for everything else. (r1-explorer-internal.md)
2. **RTL CSS strategy.** Choose between combined-mode postcss-rtlcss, Bootstrap RTL build (`$enable-rtl: true`), and logical-property migration; the ~25 legacy SCSS files and the vendor bundle constrain the choice. Directional lucide glyphs need `[dir=rtl] { transform: scaleX(-1) }` — applied to chevrons/arrows only. (r1-explorer-internal.md, r2-critic.md, r3-critic.md)
3. **Arabic pluralization, both layers.** `pluralRules: { ar }` in vue-i18n; six-form pipe sets in Laravel; fix the verbatim-English `# translations` key. (r1-critic.md, r2-associator-docs.md)
4. **Date/numeral policy — now Bahrain-constrained.** `ar_BH` in `config/typicms.php`; `calendar: 'gregory'` + `numberingSystem: 'latn'` in vue-i18n `datetimeFormats`/`numberFormats` and in `useHelpers.ts`; mirrored policy in Carbon/`Number` on PHP. Date display: Gregorian with Arabic month names (12 أغسطس 2026) + relative time (منذ ساعة); Hijri only as a secondary stamp for religious occasions. Currency if ever needed: **BHD, 3 decimal places, د.ب**. hreflang: `ar-bh` / `en-bh` with self-referencing tags. (r4-explorer-bahrain.md, r2-associator-docs.md)
5. **Arabic font stack.** `[dir=rtl] { --bs-body-font-family: 'Cairo'|'Tajawal'|... }`, variable woff2, `font-display: swap`, line-height 1.6–1.8. (r1-explorer-web.md, r2-explorer-precedents.md)
6. **i18n hardening.** `fallbackLocale: 'en'`; decouple UI locale from content locale (today `set-content-locale.ts` switches only content and never touches `dir`). (r1-critic.md, r2-associator-docs.md)
7. **Bilingual editing UX (admin).** Document-level locale tabs or side-by-side panes; explicit RTL wrappers on Arabic panes; `:dir()` selectors; optional persisted direction preference. (r3-explorer-hybrid.md)
8. **Content fallback + SEO.** Policy choice from Tension T4; context-aware switcher; hreflang/sitemap scoped to actually-translated models. (r3-explorer-fallback.md)
9. **Locale inventory cleanup.** Restore or purge fr/es/nl; align `languages.php` with `config/typicms.php`. (r1-critic.md)
10. **Drift prevention.** A CI key-parity check between `en.json` and `ar.json`; without it, the "764 keys complete" claim rots on the next committed string. (r1-critic.md)

---

# Open Questions

The Explore-mode deliverable ends where decisions begin. These are the questions the newsroom, not the codebase, must answer — and each has a concrete technical consequence:

1. ~~Who is the Arabic audience?~~ **Answered by steering:** Bahrain-focused, MSA, Western digits + Gregorian (T3 resolved → `ar_BH`). *Sub-question that replaces it:* does the English edition target Bahrain-based readers and expats (`en-BH`/`en`) and how does that affect content mix and hreflang?
2. **Who are the editors, and are they bilingual?** A mirrored admin for Arabic-only editors vs. a neutral shell for bilingual newsroom workflows — one of them is the wrong answer for this team. → sets Tension T1.
3. **Is the admin flip a requirement, a preference toggle, or out of scope?** → swings the admin estimate from ~3 days to weeks.
4. **What is the upstream relationship?** Keep merging `TypiCMS:master` (RTL work must be merge-resistant, vendor views overridden, not patched in place) or diverge? → sets Tension T5.
5. **Slug strategy:** Unicode Arabic slugs (`/ar/مقالات/...`, Google-supported, better UX) with transliterated fallbacks, or Latin slugs throughout? → affects routing, seeding, and shareability.
6. **Publication policy:** are articles publishable per-locale (gating) or global (fallback)? → sets Tension T4 and the SEO posture.
7. **Does the team want the admin RTL at all before the audience-facing site is solid?** — the 80/20 sequencing question, Framing A vs B.
8. **New — Bahrain content taxonomy:** should the public site adopt the standard Bahraini news sections (محليات · دوليات · اقتصاد · رياضة · الأكثر قراءة) — and does that map onto the existing Pages/Menus structure and seeded translation keys (كل الأخبار، آخر الأخبار already seeded)?
9. **New — Bahrain sourcing/partners:** any planned integrations with Bahraini services (eKYC/Passport-style logins like eKey, government feeds, BNA wire) that carry regional-specific requirements?
10. **New — Gulf-region expansion:** the T3 resolution holds for Bahrain; if GCC editions are ever added, the calendar/numeral decision needs revisiting per market.

The strongest single conclusion of the session: **nothing in the stack blocks Arabic; everything in the stack is currently unconfigured for it, and three of the decisions (calendar, admin posture, fallback) are product decisions that no amount of code can make for you.** The recon's competing framings are the map; the open questions are where the newsroom picks a route.

---

# References

1. Bootstrap 5.3 RTL documentation — https://getbootstrap.com/docs/5.3/getting-started/rtl/
2. vue-i18n pluralization & formats docs — https://vue-i18n.intlify.dev/guide/essentials/pluralization.html · https://vue-i18n.intlify.dev/guide/essentials/datetime.html
3. Laravel 12 localization docs — https://laravel.com/docs/12.x/localization
4. spatie/laravel-translatable docs — https://spatie.be/docs/laravel-translatable
5. Google Search Central: localized versions of your pages — https://developers.google.com/search/docs/specialty/international/localized-versions
6. postcss-rtlcss — https://github.com/elchininet/postcss-rtlcss
7. Google Fonts Arabic families (Cairo, Tajawal, IBM Plex Sans Arabic, Noto Naskh/Kufi Arabic) — https://fonts.google.com
8. MDN: `dir` attribute / `:dir()` pseudo-class / `Intl.DateTimeFormat` calendar & numberingSystem options
9. Tiptap editorProps / TextAlign docs — https://tiptap.dev/docs/editor/editor-properties
10. Uppy locale & direction docs — https://uppy.io/docs/locales/
11. Al Ayam (Bahraini daily) — https://www.alayam.com/ · Al-Watan — https://alwatannews.net/ · Bahrain News Agency — https://www.bna.bh/ · Gulf Daily News — https://www.gdnonline.com/ · Akhbar Al Khaleej — https://akhbar-alkhaleej.com/

*Primary source consulted in-repo: `ARABIC_TRANSLATION_COMPLETE.md`, `config/typicms.php`, `app/helpers.php`, `resources/js/admin.js`, `resources/js/admin/set-content-locale.ts`, `resources/js/composables/useHelpers.ts`, `resources/scss/**` (25+ files), `lang/ar.json`, `lang/en/languages.php`, `bootstrap/app.php`, `database/seeders/*`.*
