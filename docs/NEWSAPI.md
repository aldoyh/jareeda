# NewsAPI.ai (Event Registry) Integration

NewsAPI.ai (Event Registry) is the primary news source for the pipeline, queried for Bahrain-related coverage in English and Arabic.

> **Security note:** an earlier version of this doc hardcoded a live `apiKey` value in the example below. That key was committed to this **public** repository and should be treated as compromised — rotate it at [eventregistry.org](https://eventregistry.org) and update `NEWSAPI_KEY` in `.env`. Never commit a real key to source control or docs; always use a placeholder as shown here.

## Raw API shape

The underlying Event Registry endpoint looks like this (see [`FetchNewsApiAi`](../app/Console/Commands/FetchNewsApiAi.php) for the actual implementation used by `php artisan news:fetch-newsapi`):

```php
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL,
    "https://eventregistry.org/api/v1/article/getArticles?query=%7B%22%24query%22%3A%7B%22conceptUri%22%3A%22http%3A%2F%2Fen.wikipedia.org%2Fwiki%2FBahrain%22%7D%2C%22%24filter%22%3A%7B%22forceMaxDataTimeWindow%22%3A%2231%22%7D%7D&resultType=articles&articlesSortBy=date&apiKey=" . config('services.newsapi.key')
);
$result = json_decode(curl_exec($curl));
echo json_encode($result);
```

## Configuration

- Set `NEWSAPI_KEY` in `.env` (never `env()` outside config files — see [Laravel config caching pitfall](NEWS_PIPELINE.md#gotcha-config-caching-hides-env-changes)).
- The key is exposed to the app via `config('services.newsapi.key')`, defined in `config/services.php`.
- Requests are cached for 12 hours (`FetchNewsApiAi::$cachePrefix`) to preserve API quota — pass `--force` to bypass the cache.