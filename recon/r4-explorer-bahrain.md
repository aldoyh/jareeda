# R4 — Explorer (Bahrain conventions verification)

**Date:** 2026-08-12 · **Round 4** · *steering update: product focuses on news for/about Bahrain*

## 1. `ar_BH` vs `ar_SA` (CLDR/Intl)
- **Calendar:** `ar-BH` defaults to **Gregorian (`gregory`)** in modern CLDR/Intl. `ar-SA` is the outlier that pushes `islamic-umalqura` for government/religious contexts.
- **Numerals:** `ar-BH` defaults to **Western digits (`latn` 0–9)**; explicit `numberingSystem: 'latn'` guarantees consistency.

## 2. Real Bahraini news conventions (verified sites: Al Ayam, Al-Watan, BNA)
- **Digits:** Western 0–9 across Arabic interfaces (timestamps, counts, pagination).
- **Dates:** Gregorian with Arabic month names (e.g. *12 أغسطس 2026*) or DD/MM/YYYY; relative time *منذ ساعة / منذ 4 ساعات*. Hijri only for religious occasions/holidays, never primary on articles.

## 3. Currency — Bahraini Dinar (BHD)
- **3 decimal places** (not 2): `0.100 د.ب` / `99.900 BHD`; symbol د.ب or ISO code.

## 4. hreflang / geo-targeting
- `ar-BH` for the Arabic edition; `en-BH` or `en` for English (expat/regional audience).
- Regional subtags matter when there's no `.bh` ccTLD; self-referencing hreflang required on both versions.

## 5. Dialect
- Editorial + UI chrome in **Modern Standard Arabic (MSA)**. Bahraini dialect (Baharna) reserved for culture columns/quotes. Existing `ar.json` (MSA) is correct.

## Implication
`config/typicms.php` mapping `'ar' => 'ar_SA'` is **wrong for a Bahrain product** → change to `'ar' => 'ar_BH'`. This single change fixes the accidental Hijri + Eastern-numeral rendering in `useHelpers.ts` (`toLocaleDateString('ar_BH')` → Gregorian + latn by default).
