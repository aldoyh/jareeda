# R2 — Associator (docs): documented implementation recipes

**Date:** 2026-08-12 · **Round 2**

## vue-i18n (v9/v11)
```js
createI18n({
  locale: 'ar',
  fallbackLocale: 'en',
  pluralRules: {
    ar: (choice, len) => {
      const pr = new Intl.PluralRules('ar')
      const rule = pr.select(choice)
      return { zero: 0, one: 1, two: 2, few: 3, many: 4, other: 5 }[rule] ?? 0
    }
  },
  datetimeFormats: {
    ar: { short: { year: 'numeric', month: 'short', day: 'numeric', calendar: 'gregory' } }
  },
  numberFormats: {
    ar: { decimal: { style: 'decimal', numberingSystem: 'latn' } }
  }
})
// runtime switch:
i18n.global.locale.value = 'ar'
document.querySelector('html').setAttribute('lang', 'ar')
document.querySelector('html').setAttribute('dir', 'rtl')
```

## Laravel 12 — Arabic 6-form pluralization
```php
'items' => '{0} No items|{1} One item|{2} Two items|[3,10] Few items|[11,99] Many items|[100,*] Other items',
```

## Bootstrap 5.3 RTL (official)
- Sass: `$enable-rtl: true` before import, or link `bootstrap.rtl.min.css`.
- Root `dir="rtl"` + `lang="ar"` required; custom SCSS should use logical utilities (`ms-*`/`me-*`/`ps-*`/`pe-*`).

## Tiptap 3
```js
editorProps: { attributes: { dir: 'rtl', class: 'prose text-right' } }
// + TextAlign.configure({ types: ['heading', 'paragraph'] })
```

## Uppy 5
Reads document/container `dir` automatically; ensure modal wrapper inherits `dir="rtl"`.

**All recipes are documented and compatible with the project's stack — the gap is configuration, not capability.**
