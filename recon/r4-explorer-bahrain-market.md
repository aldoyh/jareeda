# R4 — Explorer (Bahrain media market grounding)

**Date:** 2026-08-12 · **Round 4**

## 1. Main Bahraini outlets (visual audit)
Al Ayam (`alayam.com`), Akhbar Al Khaleej (`akhbar-alkhaleej.com`), Al-Watan (`alwatannews.net`), Gulf Daily News (`gdnonline.com`, English), Bahrain News Agency (`bna.bh`).
- All Arabic sites render **native, robust RTL** with multi-column grids and standard category taxonomy: محليات (Local), دوليات (International), اقتصاد (Economy), رياضة (Sports), plus breaking/latest tickers.
- **Standard date format:** Gregorian with Arabic month names (e.g. 12 أغسطس 2026); relative timestamps (منذ ساعة).

## 2. Typography
- Regional publishers favor **modern sans-serif Arabic webfonts**: Cairo, Tajawal, IBM Plex Sans Arabic — matching the R1 recommendation.
- Weight hierarchy: 700+ headlines/tickers, 500 subheads/section tabs, 400 body.

## 3. Bahrain-specific conventions
- Financial news references the **Bahraini Dinar** (دينار بحريني, e.g. مليون دينار بحريني).
- Government announcements/royal decrees and holiday notices run as top breaking-news banners; prayer/Hijri calendars not typically cluttering daily news chrome.

## 4. Standard Arabic UI terminology for the taxonomy
- Local news: **محليات** · Latest news: **آخر الأخبار** / أهم الأخبار · International: **دوليات** / عربية ودولية · Business/Economy: **المال والأقتصاد** / اقتصاد · Most read: **الأكثر قراءة**.

**Cross-check with repo:** `TranslationSeeder` already seeds *كل الأخبار* (All news) and *آخر الأخبار* (Latest news) — terminology aligns with Bahraini usage.
