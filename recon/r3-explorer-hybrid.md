# R3 — Explorer (hybrid admin & bilingual UX)

**Date:** 2026-08-12 · **Round 3**

## 1. The hybrid admin pattern
- **Shell (LTR/neutral):** nav, sidebar, toolbars, save buttons stay LTR — predictable, no jarring inversion.
- **Fields (`dir="auto"`):** inputs adapt to the typed language.
- **Translation UI:** modern editors prefer **document-level locale tabs** (Strapi-style) or **side-by-side dual-column** (EN left / AR right, `dir=rtl`) over TypiCMS's current per-field locale tabs (vertical scrolling fatigue on long forms). Side-by-side suits newsrooms translating wire copy.

## 2. `dir="auto"` mechanics — a real footgun
- Evaluates the **first strongly directional character**. Arabic-first → RTL; Latin-first → LTR.
- **Complication:** fields beginning with Latin abbreviations, URLs, or numbers render LTR-aligned even when the content is Arabic — the R3 Critic calls this "form-chrome bleed."
- **Placeholder pitfall:** empty inputs with placeholders can misalign until the first character is typed.

## 3. CSS `:dir()` vs attribute selectors
- `[dir=rtl]` misses elements that inherit direction without an explicit attribute.
- **`:dir(rtl)` matches computed direction** (even via `dir="auto"`) — baseline since late 2023. Cleaner for field-level rules: `.form-control:dir(rtl) { text-align: right }`.

## 4. User-preference admin flip
- Persist `users.admin_direction` (DB + cookie/localStorage); bind root: `<html lang="ar" dir="{{ $user->admin_direction ?? 'ltr' }}">`.
- Avoid runtime RTLCSS pipe over vendor assets; rely on Bootstrap RTL build + logical properties so one stylesheet adapts to whichever root `dir` is active.

**Recommendation:** hybrid admin — neutral LTR shell, side-by-side or instant locale-tab editing for spatie translatable fields, explicit `dir="rtl"` on Arabic tab panes, `:dir()` for styling.
