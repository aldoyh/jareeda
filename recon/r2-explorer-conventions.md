# R2 — Explorer (Arabic conventions): dates, numbers, time

**Date:** 2026-08-12 · **Round 2**

## 1. Calendar
- `ar-SA` **defaults to Hijri `islamic-umalqura`** in ECMAScript/CLDR.
- Hijri: Saudi/Gulf government portals, religious/Islamic apps, official ledgers. **Gregorian: pan-Arab media, e-commerce, aviation, banking dashboards** — even for Saudi users.
- Force Gregorian: `new Intl.DateTimeFormat('ar-SA', { calendar: 'gregory' })` or `'ar-SA-u-ca-gregory'`.

## 2. Numerals
- `ar-SA` defaults to **Eastern Arabic-Indic (arab: ٠١٢٣)**, `ar-EG`/Maghreb often Western (`latn`).
- **Modern consumer apps (Noon, Anghami, Souq/Amazon SA) force Western digits**; Eastern reserved for gov/heritage.
- Force: `{ numberingSystem: 'latn' }` or `'ar-SA-u-nu-latn'`.

## 3. Time
- Arabic locales split: enterprise/technical → 24h (`hour12: false`); consumer → 12h with **ص / م** day periods.

## 4. Laravel/Carbon consistency
- `Carbon::setLocale('ar')` yields Arabic month/day names and **stays Gregorian by default** (Hijri requires extra packages).
- **Backend Gregorian + frontend Hijri = inconsistency bug**: JS Intl formatters must explicitly set `{ calendar: 'gregory', numberingSystem: 'latn' }` when rendering API ISO dates, or the two layers disagree.

## Tension surfaced
Modern media convention (Gregorian + latn) vs Saudi civic/regulatory expectation (Hijri + arab) — challenged in r3-critic.md.
