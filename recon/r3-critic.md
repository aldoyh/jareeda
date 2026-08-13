# R3 — Critic: adversarial stress-test of the hybrid recommendation

**Date:** 2026-08-12 · **Round 3**

## 1. The Gregorian + Western-digits fallacy (challenges r2-explorer-conventions.md)
- For `ar_SA`, official Saudi publications/ledgers/announcements **prioritize Um Al-Qura Hijri + Eastern Arabic numerals**. Forcing Gregorian+latn on a Saudi-region newspaper signals an out-of-touch foreign product.
- **Fix:** dual-calendar stamps (Gregorian primary + Hijri secondary, e.g. `ar-SA-u-ca-islamic-umalqura` as a toggle/secondary) — the documented Gulf media pattern — rather than a forced default.

## 2. Public-site RTL is NOT cheap here
- The Bootstrap 5 public theme has legacy physical properties in hamburger drawer, anchor-top sticky, share-links, document lists. Bootstrap's logical utilities don't fix component-level hardcoding (carets, absolute placement, transforms).
- **Effort estimate:** retrofitting 25+ SCSS files to fully logical without a build tool ≈ **3–4 weeks of edge-case bugs** vs ~3 days for admin label localization. Public RTL is the expensive part, not the admin.

## 3. The hybrid admin "illusion"
- `dir="auto"` fails when an Arabic field starts with a Latin abbreviation/URL/numeral → flips mid-sentence inside LTR chrome.
- TypiCMS's translatable-bootforms renders en+ar fields in the same form lifecycle (per-locale tabs) — an LTR shell alone is not enough; **Arabic tab panes need explicit `dir="rtl"` wrappers**.
- **Real minimum admin work:** locale-aware wrapper containers, not just `dir="auto"`.

## 4. The single most dangerous flaw in the framing
**"Manual logical-properties refactor of 25+ legacy SCSS files, no build tool."** Manual refactors leave un-flipped borders/shadows/flex direction. RTLCSS-free logical-props-only is unrealistic for this codebase's legacy debt.

## Top 3 risks (ranked)
1. **Orphaned legacy CSS** — manual refactor without a build-time tool (postcss-rtlcss combined mode) leaves hidden physical CSS across the public site.
2. **Cultural alienation via calendar/digits** — forcing Gregorian/Western on a Saudi (`ar_SA`) readership without a dual-calendar option.
3. **Admin form-chrome bleed** — underestimating translatable-bootforms; `dir="auto"` alone breaks mixed-script editorial inputs.

**Net tension:** R2 Critic warned against a parallel RTL stylesheet pipe; R3 Critic warns that skipping build-time tooling entirely is worse. The emerging resolution: **postcss-rtlcss in combined mode (single stylesheet, no parallel artifact) + logical properties for new code + Bootstrap logical utilities** — the two are complementary.
