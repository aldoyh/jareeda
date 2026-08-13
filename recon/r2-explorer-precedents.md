# R2 — Explorer (operational reality check): precedents & workflows

**Date:** 2026-08-12 · **Round 2**

## 1. Real-world admin precedent
- **Filament & Laravel Nova: full admin flip** on RTL (drawers mirror, tables mirror, directional icons flip).
- **WordPress: dedicated `rtl.css`** alongside admin styles; **Shopify/Statamic** mirror the dashboard.
- Arabic editors **expect a fully mirrored RTL admin**; forcing LTR creates cognitive friction on forms, tables, trees.
- Exception: code editors, raw JSON viewers, financial charts stay LTR — but chrome/nav/forms/tables must flip.

## 2. Concrete rtlcss workflow (Bootstrap 5 + Vite)
- `npm i -D postcss postcss-rtlcss`; root `postcss.config.js` with `mode: 'combined'` + `safeBothPrefix` → **single stylesheet with both LTR/RTL rules**, switched via root `dir`.
- Pitfalls: CSS custom properties don't need flipping but computed spacing should use logical props; avoid Sass `/* rtl:remove */` (breaks in PostCSS); use `/* rtl:freeze */`.

## 3. Arabic fonts in production
- **Cairo** and **Tajawal** recommended for UI; IBM Plex Sans Arabic / Noto as alternates.
- **Variable fonts** (woff2 ~30–50KB), **`font-display: swap`** mandatory for MENA mobile networks.
- Pattern: `[dir=rtl] { --bs-body-font-family: 'Cairo', ... }` scoped font switch.

## 4. SEO for Arabic
- `hreflang` with `ar`, `ar-SA`, and `x-default` alternates.
- Google **supports Unicode Arabic slugs** (`/ar/مقالات/...`) — good UX; trade-off: percent-encoded copies on social.
- Pragmatic pattern: localized Arabic slugs for display + optional Latin transliteration slug for shareability.

## 5. Tension surfaced
Full admin flip is the industry default for Arabic-first users, **but** the R2 Critic found the bilingual-editing consensus runs the other way (see r2-critic.md).
