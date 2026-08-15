# NEWSAPI.AI Feature

## as the primary news source




```php
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL,
    "https://eventregistry.org/api/v1/article/getArticles?query=%7B%22%24query%22%3A%7B%22conceptUri%22%3A%22http%3A%2F%2Fen.wikipedia.org%2Fwiki%2FBahrain%22%7D%2C%22%24filter%22%3A%7B%22forceMaxDataTimeWindow%22%3A%2231%22%7D%7D&resultType=articles&articlesSortBy=date&apiKey=ac199612-4ac9-441d-b1c2-64479b54a502"
);
$result = json_decode(curl_exec($curl));
echo json_encode($result);
```