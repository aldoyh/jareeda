# ADR-001: Upgrade to Laravel 13 and TypiCMS 17

## Status
Accepted

## Date
2026-08-12

## Context
Jareeda is a TypiCMS project that was still on Laravel 12.66 and TypiCMS Core 15.0.30. Laravel 13.25 and TypiCMS 17.0.39 were current. Staying on Laravel 12 would miss security and framework support after August 2026, and TypiCMS 15 cannot run on Laravel 13 (`typicms/core` 15 requires `laravel/framework ~12.0`).

The frontend was on Vite 7, ESLint 9, and the deprecated `lucide-vue-next` package.

## Decision
Upgrade the application in place to the current TypiCMS 17 stack:

- PHP `^8.4` (runtime 8.5.9)
- Laravel `^13.0` (installed 13.25.0)
- TypiCMS Core `^17.0` (installed 17.0.39)
- Vite `^8.2` with `laravel-vite-plugin` `^3.2`
- Lucide Vue via `@lucide/vue` 1.x

Follow TypiCMS 17 application stubs for helpers and HTTP middleware. Do not add Pest, Excel, or other TypiCMS skeleton extras that this project does not use.

## Alternatives Considered

### Stay on Laravel 12 / TypiCMS 15
- Pros: smaller diff, no TypiCMS 17 helper/middleware migration
- Cons: framework support window is closing; TypiCMS 15 cannot take Laravel 13
- Rejected: the request was to upgrade all frameworks

### Jump Swiper 12 → 14
- Pros: latest slider package
- Cons: two majors of API change; TypiCMS 17 still ships Swiper 12
- Rejected for this pass

### Replace `genealabs/laravel-model-caching` with `mike-bronner/laravel-model-caching`
- Pros: keeps model caching
- Cons: TypiCMS 17 dropped the package; this app had no `Cachable` usage
- Rejected: remove the abandoned package

## Consequences
- `SetNavbarLocale` no longer exists; it must not be registered.
- Public views call `showAdminButtons()` and `imageOrDefault()`; `app/helpers.php` must include the TypiCMS 17 helpers.
- Auth routes alias `DoNotCacheResponse`, so `spatie/laravel-responsecache` is required even if page caching is not a product feature.
- CSRF middleware is `PreventRequestForgery`.
- Session serialization stays `php` so existing sessions survive the upgrade.
- Cache `serializable_classes` is `false` (Laravel 13 default).
- `swiper` remains 12.2.0 until a dedicated migration.

## Sources
- https://laravel.com/docs/13.x/upgrade
- https://github.com/laravel/vite-plugin/blob/3.x/UPGRADE.md
- https://lucide.dev/guide/vue/migration
- https://github.com/TypiCMS/Base/blob/17.0.20/composer.json
- `vendor/typicms/core/stubs/bootstrap/app.php`
