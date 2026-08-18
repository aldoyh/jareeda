<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchBahrainNews extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'news:fetch-bahrain
                            {--days=7 : Number of days to fetch}
                            {--limit=50 : Maximum number of articles to fetch}
                            {--sources=* : Specific sources to fetch from (empty = all)}';

    /**
     * The console command description.
     */
    protected $description = 'Fetch Bahrain news articles from RSS feeds for the last 7 days';

    /**
     * Bahrain news RSS feeds.
     *
     * @var array<string, string>
     */
    protected array $feeds = [
        'biz-bahrain' => 'https://bizbahrain.com/feed',
        'bahrain-this-week' => 'https://bahrainthisweek.com/feed',
        'google-news-bahrain' => 'https://news.google.com/rss/search?q=Bahrain+when:7d&hl=en',
        'google-news-bahrain-ar' => 'https://news.google.com/rss/search?q=%D8%A8%D8%AD%D8%B1%D9%8A%D9%86+when:7d&hl=ar',
        'bbc-mideast' => 'https://feeds.bbci.co.uk/news/world/middle_east/rss.xml',
        'wam-bahrain' => 'https://www.wam.ae/en/rss-feed/all-news',
        'gulf-news-bahrain' => 'https://gulfnews.com/rss/bahrain',
        'khaleej-times-bahrain' => 'https://www.khaleejtimes.com/rss/bahrain',
        'bahrain-mirror' => 'https://bahrainmirror.com/rss.xml',
        'alayam' => 'https://feeds.feedburner.com/alayam',
        'aljazeera-bahrain' => 'https://www.aljazeera.com/xml/rss/all.xml',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $days = (int) $this->option('days');
        $limit = (int) $this->option('limit');
        $sources = $this->option('sources');

        $this->info("Fetching Bahrain news for the last {$days} days...");
        $this->newLine();

        $feeds = $sources ? array_intersect_key($this->feeds, array_flip($sources)) : $this->feeds;

        $totalFetched = 0;
        $totalSkipped = 0;

        foreach ($feeds as $source => $url) {
            if ($totalFetched >= $limit) {
                break;
            }

            $this->info("Fetching from: {$source}");

            try {
                $articles = $this->fetchFeed($url, $days, $limit - $totalFetched);

                foreach ($articles as $article) {
                    if ($this->articleExists($article['url'] ?? null, $article['title'] ?? null)) {
                        $totalSkipped++;
                        $this->line("  <comment>Skipped (duplicate): {$article['title']}</comment>");

                        continue;
                    }

                    // For general feeds, only store Bahrain-related articles
                    if ($this->isGeneralFeed($source) && !$this->isBahrainRelated($article)) {
                        continue;
                    }

                    $this->storeArticle($article, $source);
                    $totalFetched++;

                    $this->line("  <info>Stored: {$article['title']}</info>");

                    if ($totalFetched >= $limit) {
                        break;
                    }
                }
            } catch (\Exception $e) {
                $this->error("  Error: {$e->getMessage()}");
            }

            // Rate limiting
            usleep(500_000);
        }

        $this->newLine();
        $this->info("Done! Fetched: {$totalFetched} articles, Skipped: {$totalSkipped} duplicates");

        return self::SUCCESS;
    }

    /**
     * Fetch and parse an RSS feed using SimpleXML.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function fetchFeed(string $url, int $days, int $limit): array
    {
        $response = Http::timeout(30)
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (compatible; JareedaBot/1.0)',
                'Accept' => 'application/rss+xml, application/xml, text/xml, */*',
            ])
            ->get($url);

        if (!$response->successful()) {
            throw new \RuntimeException("HTTP {$response->status()}");
        }

        $xmlContent = $response->body();

        // Suppress warnings from malformed XML
        libxml_use_internal_errors(true);
        libxml_disable_entity_loader(true);
        $xml = simplexml_load_string($xmlContent, options: \LIBXML_NOERROR | \LIBXML_NOWARNING);
        if ($xml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            $errorMsg = $errors[0]->message ?? 'Unknown XML error';
            throw new \RuntimeException("XML parse error: {$errorMsg}");
        }

        $articles = [];
        $cutoffDate = now()->subDays($days);

        // Detect feed type
        $namespaces = $xml->getNamespaces(true);

        // RSS 2.0: //rss/channel/item
        if (isset($xml->channel)) {
            foreach ($xml->channel->item as $item) {
                if (count($articles) >= $limit) {
                    break;
                }

                $article = $this->parseRssItem($item, $namespaces);
                if ($article === null) {
                    continue;
                }

                if (isset($article['published_at']) && $article['published_at'] instanceof \DateTime) {
                    if ($article['published_at'] < $cutoffDate) {
                        continue;
                    }
                }

                $articles[] = $article;
            }
        }
        // Atom: //feed/entry
        elseif (isset($xml->entry)) {
            foreach ($xml->entry as $entry) {
                if (count($articles) >= $limit) {
                    break;
                }

                $article = $this->parseAtomEntry($entry, $namespaces);
                if ($article === null) {
                    continue;
                }

                if (isset($article['published_at']) && $article['published_at'] instanceof \DateTime) {
                    if ($article['published_at'] < $cutoffDate) {
                        continue;
                    }
                }

                $articles[] = $article;
            }
        }

        return $articles;
    }

    /**
     * Parse an RSS 2.0 item.
     *
     * @param array<string, string> $namespaces
     * @return array<string, mixed>|null
     */
    protected function parseRssItem(\SimpleXMLElement $item, array $namespaces): ?array
    {
        $title = mb_trim((string) ($item->title ?? ''));
        $description = mb_trim((string) ($item->description ?? ''));
        $link = mb_trim((string) ($item->link ?? ''));
        $pubDate = mb_trim((string) ($item->pubDate ?? ''));
        $author = mb_trim((string) ($item->author ?? $item->children('dc', true)->creator ?? ''));
        $category = mb_trim((string) ($item->category ?? ''));

        if (empty($title)) {
            return null;
        }

        $image = $this->extractImageFromItem($item, $namespaces);

        $publishedAt = null;
        if (!empty($pubDate)) {
            try {
                $publishedAt = new \DateTime($pubDate);
            } catch (\Exception) {
                $publishedAt = null;
            }
        }

        $cleanDescription = strip_tags(html_entity_decode($description, ENT_QUOTES | ENT_HTML5));
        $cleanDescription = preg_replace('/\s+/', ' ', $cleanDescription);

        return [
            'title' => $title,
            'body' => $description,
            'excerpt' => Str::limit(mb_trim($cleanDescription), 300),
            'url' => $link,
            'author' => $author ?: null,
            'category' => $category ?: null,
            'image' => $image,
            'published_at' => $publishedAt,
        ];
    }

    /**
     * Parse an Atom entry.
     *
     * @param array<string, string> $namespaces
     * @return array<string, mixed>|null
     */
    protected function parseAtomEntry(\SimpleXMLElement $entry, array $namespaces): ?array
    {
        $title = mb_trim((string) ($entry->title ?? ''));
        $summary = mb_trim((string) ($entry->summary ?? $entry->content ?? ''));
        $link = '';

        // Atom links
        foreach ($entry->link as $linkEl) {
            $rel = (string) ($linkEl['rel'] ?? 'alternate');
            if ($rel === 'alternate') {
                $link = (string) ($linkEl['href'] ?? '');
                break;
            }
        }

        $published = mb_trim((string) ($entry->published ?? $entry->updated ?? ''));
        $author = '';
        if (isset($entry->author->name)) {
            $author = mb_trim((string) $entry->author->name);
        }

        $category = '';
        if (isset($entry->category)) {
            $category = (string) ($entry->category['term'] ?? '');
        }

        if (empty($title)) {
            return null;
        }

        $image = $this->extractImageFromItem($entry, $namespaces);

        $publishedAt = null;
        if (!empty($published)) {
            try {
                $publishedAt = new \DateTime($published);
            } catch (\Exception) {
                $publishedAt = null;
            }
        }

        $cleanSummary = strip_tags(html_entity_decode($summary, ENT_QUOTES | ENT_HTML5));
        $cleanSummary = preg_replace('/\s+/', ' ', $cleanSummary);

        return [
            'title' => $title,
            'body' => $summary,
            'excerpt' => Str::limit(mb_trim($cleanSummary), 300),
            'url' => $link,
            'author' => $author ?: null,
            'category' => $category ?: null,
            'image' => $image,
            'published_at' => $publishedAt,
        ];
    }

    /**
     * Extract image URL from an RSS/Atom item.
     *
     * @param array<string, string> $namespaces
     */
    protected function extractImageFromItem(\SimpleXMLElement $item, array $namespaces): ?string
    {
        // Method 1: media:content
        if (isset($namespaces['media'])) {
            $mediaContent = $item->children('media', true)->content;
            if ($mediaContent && isset($mediaContent['url'])) {
                return (string) $mediaContent['url'];
            }

            // media:thumbnail
            $thumbnail = $item->children('media', true)->thumbnail;
            if ($thumbnail && isset($thumbnail['url'])) {
                return (string) $thumbnail['url'];
            }
        }

        // Method 2: enclosure
        if (isset($item->enclosure)) {
            $type = (string) ($item->enclosure['type'] ?? '');
            $url = (string) ($item->enclosure['url'] ?? '');
            if (str_starts_with($type, 'image/') && !empty($url)) {
                return $url;
            }
        }

        // Method 3: content:encoded
        if (isset($namespaces['content'])) {
            $content = (string) $item->children('content', true)->encoded;
            if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $content, $matches)) {
                return $matches[1];
            }
        }

        // Method 4: Extract from description HTML
        $description = (string) ($item->description ?? '');
        if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $description, $matches)) {
            return $matches[1];
        }

        // Method 5: wp:featured_media (WordPress RSS)
        if (isset($namespaces['wp'])) {
            $mediaId = (string) $item->children('wp', true)->post_thumbnail;
            // Can't resolve ID to URL without another query, skip
        }

        return null;
    }

    /**
     * Check if article already exists by URL or title.
     */
    protected function articleExists(?string $url, ?string $title = null): bool
    {
        if (!empty($url)) {
            return News::where('url', $url)->exists();
        }

        if (!empty($title)) {
            return News::where('title', $title)->exists();
        }

        return false;
    }

    /**
     * Store an article in the database.
     */
    protected function storeArticle(array $article, string $source): void
    {
        $slug = Str::slug($article['title']);

        // Ensure unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $language = $this->detectLanguage($article['title'] . ' ' . ($article['excerpt'] ?? ''));

        News::create([
            'slug' => $slug,
            'title' => ['en' => $article['title']],
            'body' => ['en' => $article['body'] ?? $article['excerpt'] ?? ''],
            'excerpt' => ['en' => $article['excerpt'] ?? ''],
            'url' => $article['url'],
            'source' => $source,
            'author' => $article['author'],
            'image' => $article['image'],
            'image_alt' => $article['title'],
            'category' => $article['category'],
            'language' => $language,
            'published_at' => $article['published_at'] ?? now(),
        ]);
    }

    /**
     * Detect if text is primarily Arabic.
     */
    protected function detectLanguage(string $text): string
    {
        preg_match_all('/[\x{0600}-\x{06FF}]/u', $text, $arabic);
        $arabicCount = count($arabic[0]);

        preg_match_all('/[a-zA-Z]/', $text, $latin);
        $latinCount = count($latin[0]);

        $total = $arabicCount + $latinCount;
        if ($total > 0 && ($arabicCount / $total) > 0.3) {
            return 'ar';
        }

        return 'en';
    }

    /**
     * Check if a feed source is general (not Bahrain-specific).
     */
    protected function isGeneralFeed(string $source): bool
    {
        return in_array($source, ['bbc-mideast', 'wam-bahrain', 'aljazeera-bahrain']);
    }

    /**
     * Check if an article is Bahrain-related.
     */
    protected function isBahrainRelated(array $article): bool
    {
        $text = mb_strtolower($article['title'] . ' ' . ($article['excerpt'] ?? '') . ' ' . ($article['category'] ?? ''));

        $bahrainKeywords = [
            'bahrain', 'manama', 'ahrain', 'bahraini',
            'gulf daily news', 'daily tribune', 'al ayyam', 'alayam',
            'nbb', 'bahrain polytechnic', 'bahrain bay',
            'kingdom of bahrain', 'bahrain financial harbour',
        ];

        foreach ($bahrainKeywords as $keyword) {
            if (str_contains($text, $keyword)) {
                return true;
            }
        }

        return false;
    }
}
