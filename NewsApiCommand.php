<?php

/**
 * NewsApiCommand.php - Advanced News Data Gatherer with Full Pagination Support
 *
 * Fetches all available news articles from NewsData.io API with:
 * - Full pagination support (collects all pages)
 * - Configurable search parameters
 * - Caching mechanism to reduce API calls
 * - Rate limiting and retry logic
 * - Comprehensive error handling
 * - Multiple output formats (JSON, HTML, CSV)
 * - Progress tracking
 *
 * @author Enhanced Version
 *
 * @usage php NewsApiCommand.php [--search=term] [--format=json|html|csv] [--no-cache] [--max-pages=N]
 */

// description: Advanced news gatherer with full pagination and multiple output formats
// alias: news
// alias: news-gather

error_reporting(E_ALL);
ini_set('display_errors', 1);

// CONFIGURATION & CLI ARGUMENTS
// ============================================================================

// Parse command-line arguments
$options = getopt('', [
    'search::',
    'format::',
    'no-cache',
    'max-pages::',
    'verbose',
    'help',
]);

if (isset($options['help']) || isset($options['h'])) {
    showHelp();
    exit(0);
}

// Configuration
$config = [
    'api_key' => 'pub_f18d2e1fdf174573b89a8e698fbc873a',
    'base_url' => 'https://newsdata.io/api/1/latest',
    'search_term' => $options['search'] ?? 'bahrain',
    'format' => $options['format'] ?? 'json', // json, html, csv
    'use_cache' => !isset($options['no-cache']),
    'max_pages' => (int) ($options['max-pages'] ?? 10),
    'timeout' => 30,
    'retry_count' => 3,
    'verbose' => isset($options['verbose']),
    'cache_dir' => __DIR__ . '/../data/cache',
    'cache_ttl' => 3600, // 1 hour
    'data_dir' => __DIR__ . '/../data',
];

// Ensure cache directory exists
if ($config['use_cache'] && !is_dir($config['cache_dir'])) {
    mkdir($config['cache_dir'], 0755, true);
}

// HELPER FUNCTIONS
// ============================================================================

function showHelp()
{
    echo <<<'HELP'
Advanced News Data Gatherer - NewsData.io Integration

USAGE:
  php NewsApiCommand.php [OPTIONS]

OPTIONS:
  --search=TERM         Search term (default: bahrain)
  --format=FORMAT       Output format: json|html|csv (default: json)
  --max-pages=N         Maximum pages to fetch (default: 10)
  --no-cache            Skip cache, force fresh API calls
  --verbose             Show detailed progress information
  --help                Show this help message

EXAMPLES:
  php NewsApiCommand.php --search="artificial intelligence" --format=html
  php NewsApiCommand.php --search="crypto" --max-pages=5 --format=csv
  php NewsApiCommand.php --verbose --no-cache

OUTPUT:
  Results are saved to: data/news_[search_term].[format]
  Plus a JSON cache file for future use

HELP;
}

function log_msg($message, $verbose_only = false)
{
    global $config;
    if (!$verbose_only || $config['verbose']) {
        echo '[' . date('Y-m-d H:i:s') . "] $message\n";
    }
}

function makeRequest($url, $retry_count = 3)
{
    global $config;

    $attempt = 0;
    while ($attempt < $retry_count) {
        $attempt++;
        log_msg("Fetching: $url (attempt $attempt/$retry_count)", true);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $config['timeout']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'User-Agent: PHP-NewsGatherer/2.0',
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);

        // Success
        if ($http_code === 200 && $response !== false) {
            return ['status' => 200, 'body' => $response];
        }

        // Rate limited - exponential backoff
        if ($http_code === 429) {
            $wait = pow(2, $attempt) * 2; // 4, 8, 16 seconds
            log_msg("⚠️  Rate limited. Waiting $wait seconds...", true);
            sleep($wait);

            continue;
        }

        // Other HTTP errors
        if ($http_code !== 200) {
            log_msg("HTTP Error: $http_code", true);
        }

        // cURL errors
        if ($curl_error && $attempt < $retry_count) {
            log_msg("cURL Error: $curl_error. Retrying...", true);
            sleep($attempt);

            continue;
        }

        return ['status' => $http_code, 'error' => $curl_error ?: "HTTP $http_code"];
    }

    return ['status' => 0, 'error' => 'Max retries exceeded'];
}

function getCacheFile($search_term)
{
    global $config;

    return $config['cache_dir'] . '/' . md5($search_term) . '.json';
}

function isCacheValid($cache_file)
{
    global $config;
    if (!file_exists($cache_file)) {
        return false;
    }

    return (time() - filemtime($cache_file)) < $config['cache_ttl'];
}

function loadFromCache($search_term)
{
    $cache_file = getCacheFile($search_term);
    if (isCacheValid($cache_file)) {
        log_msg('✓ Loading from cache');

        return json_decode(file_get_contents($cache_file), true);
    }

    return null;
}

function saveToCache($search_term, $data)
{
    global $config;
    if ($config['use_cache']) {
        $cache_file = getCacheFile($search_term);
        file_put_contents($cache_file, json_encode($data, JSON_PRETTY_PRINT));
        log_msg("✓ Cache saved: $cache_file", true);
    }
}

function parseDate($date_string)
{
    try {
        $dt = new DateTime($date_string);

        return $dt->format('Y-m-d H:i:s');
    } catch (Exception $e) {
        return date('Y-m-d H:i:s');
    }
}

function sanitizeHtml($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// MAIN NEWS FETCHING LOGIC WITH PAGINATION
// ============================================================================

function fetchAllNews($search_term, $max_pages = 10)
{
    global $config;

    $all_items = [];
    $next_page = null;
    $page_count = 0;

    log_msg("🔍 Starting news fetch for: '$search_term'");

    while ($page_count < $max_pages) {
        $page_count++;

        // Build URL with pagination token
        $url = $config['base_url'] . '?apikey=' . $config['api_key'];
        $url .= '&q=' . urlencode($search_term);
        $url .= '&country=us';

        if ($next_page) {
            $url .= '&page=' . urlencode($next_page);
        }

        log_msg("📄 Fetching page $page_count...");

        // Make request with retry logic
        $result = makeRequest($url, $config['retry_count']);

        if ($result['status'] !== 200) {
            log_msg("❌ Error on page $page_count: " . $result['error']);
            break;
        }

        // Parse response
        $data = json_decode($result['body'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_msg('❌ JSON decode error: ' . json_last_error_msg());
            break;
        }

        // Check for API errors
        if (isset($data['status']) && $data['status'] !== 'success') {
            log_msg('❌ API Error: ' . ($data['message'] ?? json_encode($data)));
            log_msg('Full response: ' . mb_substr(json_encode($data), 0, 200), true);
            break;
        }        // Extract news items
        if (isset($data['results']) && is_array($data['results'])) {
            $added_count = 0;
            $blocked_keywords = [
                '[removed]',
                '404 not found',
                '403 forbidden',
                'access denied',
                'page not found',
            ];

            foreach ($data['results'] as $item) {
                $title = mb_trim($item['title'] ?? '');
                if (empty($title) || mb_strtolower($title) === 'no title') {
                    continue;
                }

                $is_problematic = false;
                $text_to_check = mb_strtolower($title);
                foreach ($blocked_keywords as $keyword) {
                    if (str_contains($text_to_check, $keyword)) {
                        $is_problematic = true;
                        break;
                    }
                }

                if ($is_problematic) {
                    continue;
                }

                $content = $item['content'] ?? '';
                if (str_contains($content, 'ONLY AVAILABLE IN PAID PLANS')) {
                    $content = ''; // Clean up blocked content message
                }

                $description = $item['description'] ?? '';
                if (str_contains($description, 'ONLY AVAILABLE IN PAID PLANS')) {
                    $description = ''; // Clean up blocked description message
                }

                $all_items[] = [
                    'title' => $title,
                    'description' => $description,
                    'content' => $content,
                    'link' => $item['link'] ?? '',
                    'image' => $item['image_url'] ?? null,
                    'source' => $item['source_id'] ?? 'Unknown',
                    'pubdate' => parseDate($item['pubDate'] ?? 'now'),
                    'category' => $item['category'][0] ?? 'general',
                ];
                $added_count++;
            }
            log_msg("   ✓ Added $added_count valid items (total: " . count($all_items) . ')');
        } else {
            log_msg('   ℹ️  No results in this page');
        }

        // Check for next page
        if (isset($data['nextPage'])) {
            $next_page = $data['nextPage'];
            log_msg('   → Next page token available, continuing...', true);
        } else {
            log_msg('   → No more pages available');
            break;
        }

        // Small delay between requests to avoid rate limiting
        if ($page_count < $max_pages && isset($data['nextPage'])) {
            sleep(1);
        }
    }

    log_msg("✅ Fetch complete: $page_count pages, " . count($all_items) . ' total items');

    return [
        'status' => 'success',
        'search_term' => $search_term,
        'timestamp' => date('Y-m-d H:i:s'),
        'pages_fetched' => $page_count,
        'total_items' => count($all_items),
        'items' => $all_items,
    ];
}

// OUTPUT FORMATTERS
// ============================================================================

function formatAsJson($data)
{
    return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}

function formatAsHtml($data)
{
    $html = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Daily Gazette - %SEARCH%</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', serif;
            background: #f4f1e8;
            color: #2c1810;
            line-height: 1.4;
        }

        /* Newspaper Layout */
        .newspaper {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            border: 2px solid #8b4513;
        }

        /* Masthead */
        .masthead {
            background: linear-gradient(135deg, #2c1810 0%, #8b4513 100%);
            color: #f4f1e8;
            padding: 30px;
            text-align: center;
            border-bottom: 3px double #8b4513;
            position: relative;
        }

        .masthead::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 20px;
            right: 20px;
            height: 2px;
            background: repeating-linear-gradient(
                90deg,
                #f4f1e8,
                #f4f1e8 10px,
                transparent 10px,
                transparent 20px
            );
        }

        .masthead h1 {
            font-family: 'Times New Roman', serif;
            font-size: 3.5em;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            letter-spacing: 2px;
        }

        .masthead .subtitle {
            font-size: 1.2em;
            opacity: 0.9;
            font-style: italic;
        }

        .masthead .dateline {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 0.9em;
            text-align: right;
        }

        /* Navigation/Sections */
        .sections {
            background: #2c1810;
            color: #f4f1e8;
            padding: 10px;
            text-align: center;
            font-size: 0.9em;
            border-bottom: 1px solid #8b4513;
        }

        .sections span {
            margin: 0 15px;
            font-weight: bold;
        }

        /* Weather/Quote of the day */
        .header-extras {
            display: flex;
            justify-content: space-between;
            padding: 15px 30px;
            background: #f9f6f0;
            border-bottom: 1px solid #d4c5a9;
            font-size: 0.85em;
        }

        .weather, .quote {
            flex: 1;
        }

        .quote {
            text-align: center;
            font-style: italic;
        }

        .quote::before { content: '"'; }
        .quote::after { content: '"'; }

        /* Main Content */
        .content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            padding: 30px;
        }

        /* Lead Story */
        .lead-story {
            grid-column: 1;
            border-bottom: 2px solid #8b4513;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .lead-story .headline {
            font-size: 2.2em;
            font-weight: bold;
            margin-bottom: 15px;
            line-height: 1.2;
            color: #2c1810;
        }

        .lead-story .byline {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 15px;
            font-style: italic;
        }

        .lead-story .summary {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .lead-story .lead-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border: 1px solid #d4c5a9;
            margin: 15px 0;
        }

        /* Regular Stories */
        .stories {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .story {
            border-bottom: 1px solid #d4c5a9;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .story:last-child {
            border-bottom: none;
        }

        .story .headline {
            font-size: 1.4em;
            font-weight: bold;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .story .byline {
            font-size: 0.8em;
            color: #666;
            margin-bottom: 8px;
            font-style: italic;
        }

        .story .summary {
            font-size: 0.95em;
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .story .story-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border: 1px solid #d4c5a9;
            margin-top: 10px;
        }

        /* Sidebar */
        .sidebar {
            border-left: 2px solid #8b4513;
            padding-left: 20px;
        }

        .sidebar-section {
            margin-bottom: 25px;
        }

        .sidebar-section h3 {
            font-size: 1.2em;
            color: #8b4513;
            border-bottom: 1px solid #d4c5a9;
            padding-bottom: 5px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .sidebar-item {
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px dotted #d4c5a9;
        }

        .sidebar-item:last-child {
            border-bottom: none;
        }

        .sidebar-item .headline {
            font-size: 1em;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .sidebar-item .source {
            font-size: 0.75em;
            color: #666;
            font-style: italic;
        }

        /* Stats Box */
        .stats-box {
            background: #f9f6f0;
            border: 1px solid #d4c5a9;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .stats-box .stat {
            display: inline-block;
            margin: 0 15px;
        }

        .stats-box .stat-number {
            font-size: 1.5em;
            font-weight: bold;
            color: #8b4513;
        }

        .stats-box .stat-label {
            font-size: 0.8em;
            color: #666;
        }

        /* Footer */
        .footer {
            background: #2c1810;
            color: #f4f1e8;
            padding: 20px;
            text-align: center;
            font-size: 0.8em;
            border-top: 3px double #8b4513;
        }

        .footer a {
            color: #f4f1e8;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .stories {
                grid-template-columns: 1fr;
            }

            .masthead h1 {
                font-size: 2.5em;
            }

            .header-extras {
                flex-direction: column;
                gap: 10px;
            }
        }

        /* Print styles */
        @media print {
            body {
                background: white;
            }

            .newspaper {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>
<body>
    <div class="newspaper">
        <!-- Masthead -->
        <div class="masthead">
            <div class="dateline">Vol. 1, No. 1 • %DATE%</div>
            <h1>THE DAILY GAZETTE</h1>
            <div class="subtitle">All the News That's Fit to Print • Search: %SEARCH%</div>
        </div>

        <!-- Sections -->
        <div class="sections">
            <span>WORLD NEWS</span>
            <span>BUSINESS</span>
            <span>TECHNOLOGY</span>
            <span>SPORTS</span>
            <span>ARTS & CULTURE</span>
        </div>

        <!-- Header Extras -->
        <div class="header-extras">
            <div class="weather">
                <strong>Weather:</strong> Partly cloudy, 72°F
            </div>
            <div class="quote">
                "The newspaper is a greater treasure to the people than uncounted millions of gold." - Henry Ward Beecher
            </div>
            <div class="weather">
                <strong>Page:</strong> A1
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="main-content">
                <!-- Lead Story -->
                %LEAD_STORY%

                <!-- Regular Stories -->
                <div class="stories">
                    %STORIES%
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Stats -->
                <div class="stats-box">
                    <div class="stat">
                        <div class="stat-number">%TOTAL%</div>
                        <div class="stat-label">Articles</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">%PAGES%</div>
                        <div class="stat-label">Pages</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">%SOURCES%</div>
                        <div class="stat-label">Sources</div>
                    </div>
                </div>

                <!-- Latest Headlines -->
                <div class="sidebar-section">
                    <h3>Latest Headlines</h3>
                    %SIDEBAR_ITEMS%
                </div>

                <!-- Sources -->
                <div class="sidebar-section">
                    <h3>Sources</h3>
                    <div style="font-size: 0.8em; line-height: 1.6;">
                        %SOURCES_LIST%
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            The Daily Gazette • Generated %TIMESTAMP% • Powered by NewsData.io API<br>
            <a href="#top">Back to Top</a> • All rights reserved • Est. 2024
        </div>
    </div>
</body>
</html>
HTML;

    // Process articles
    $articles = $data['items'];
    $lead_story = '';
    $stories = '';
    $sidebar_items = '';
    $sources = [];

    // Collect sources
    foreach ($articles as $item) {
        if (!in_array($item['source'], $sources)) {
            $sources[] = $item['source'];
        }
    }

    // Generate lead story (first article)
    if (!empty($articles)) {
        $lead = array_shift($articles);
        $lead_story = sprintf(
            '<div class="lead-story">
                <div class="headline">%s</div>
                <div class="byline">By %s • %s</div>
                <div class="summary">%s</div>
                %s
                <div style="text-align: right; margin-top: 10px;">
                    <a href="%s" style="color: #8b4513; text-decoration: none; font-weight: bold;">Read Full Story →</a>
                </div>
            </div>',
            sanitizeHtml($lead['title']),
            sanitizeHtml($lead['source']),
            sanitizeHtml($lead['pubdate']),
            sanitizeHtml($lead['description'] ?: $lead['content']),
            $lead['image'] ? sprintf('<img src="%s" alt="%s" class="lead-image">', sanitizeHtml($lead['image']), sanitizeHtml($lead['title'])) : '',
            sanitizeHtml($lead['link'])
        );
    }

    // Generate regular stories (next 4 articles)
    $story_count = 0;
    foreach ($articles as $item) {
        if ($story_count >= 4) {
            break;
        }

        $stories .= sprintf(
            '<div class="story">
                <div class="headline">%s</div>
                <div class="byline">%s • %s</div>
                <div class="summary">%s</div>
                %s
            </div>',
            sanitizeHtml($item['title']),
            sanitizeHtml($item['source']),
            sanitizeHtml($item['pubdate']),
            sanitizeHtml(mb_substr($item['description'] ?: $item['content'], 0, 150) . '...'),
            $item['image'] ? sprintf('<img src="%s" alt="%s" class="story-image">', sanitizeHtml($item['image']), sanitizeHtml($item['title'])) : ''
        );

        $story_count++;
    }

    // Generate sidebar items (remaining articles)
    $sidebar_count = 0;
    foreach (array_slice($articles, 4) as $item) {
        if ($sidebar_count >= 8) {
            break;
        }

        $sidebar_items .= sprintf(
            '<div class="sidebar-item">
                <div class="headline"><a href="%s" style="color: #2c1810; text-decoration: none;">%s</a></div>
                <div class="source">%s</div>
            </div>',
            sanitizeHtml($item['link']),
            sanitizeHtml($item['title']),
            sanitizeHtml($item['source'])
        );

        $sidebar_count++;
    }

    // Generate sources list
    $sources_list = '';
    foreach ($sources as $source) {
        $sources_list .= sanitizeHtml($source) . '<br>';
    }

    $timestamp_display = date('F j, Y', strtotime($data['timestamp']));
    $date_display = date('l, F j, Y', strtotime($data['timestamp']));

    return str_replace(
        ['%SEARCH%', '%TOTAL%', '%PAGES%', '%TIMESTAMP%', '%DATE%', '%SOURCES%', '%LEAD_STORY%', '%STORIES%', '%SIDEBAR_ITEMS%', '%SOURCES_LIST%'],
        [$data['search_term'], $data['total_items'], $data['pages_fetched'], $timestamp_display, $date_display, count($sources), $lead_story, $stories, $sidebar_items, $sources_list],
        $html
    );
}

function formatAsCsv($data)
{
    $csv = "Title,Source,Date,Category,Description,Link,Image URL\n";

    foreach ($data['items'] as $item) {
        $csv .= sprintf(
            "\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"\n",
            str_replace('"', '""', $item['title']),
            str_replace('"', '""', $item['source']),
            $item['pubdate'],
            $item['category'],
            str_replace('"', '""', mb_substr($item['description'], 0, 100)),
            $item['link'],
            $item['image'] ?? ''
        );
    }

    return $csv;
}

// MAIN EXECUTION
// ============================================================================

try {
    // Ensure data directory exists
    if (!is_dir($config['data_dir'])) {
        mkdir($config['data_dir'], 0755, true);
    }

    // Try loading from cache first
    $news_data = null;
    if ($config['use_cache']) {
        $news_data = loadFromCache($config['search_term']);
    }

    // If not in cache, fetch from API
    if (!$news_data) {
        $news_data = fetchAllNews($config['search_term'], $config['max_pages']);
        saveToCache($config['search_term'], $news_data);
    }

    // Format output
    switch ($config['format']) {
        case 'html':
            $output = formatAsHtml($news_data);
            $filename = $config['data_dir'] . '/news_' . str_replace(' ', '_', mb_strtolower($config['search_term'])) . '.html';
            break;
        case 'csv':
            $output = formatAsCsv($news_data);
            $filename = $config['data_dir'] . '/news_' . str_replace(' ', '_', mb_strtolower($config['search_term'])) . '.csv';
            break;
        case 'json':
        default:
            $output = formatAsJson($news_data);
            $filename = $config['data_dir'] . '/news_' . str_replace(' ', '_', mb_strtolower($config['search_term'])) . '.json';
    }

    // Save to file
    file_put_contents($filename, $output);
    log_msg("📁 Output saved to: $filename");

    // Display output
    echo "\n" . str_repeat('=', 70) . "\n";
    // format output in colors for terminal (only for json and csv)

    // echo "\n" . str_repeat('=', 70) . "\n";
} catch (Exception $e) {
    log_msg('❌ Fatal error: ' . $e->getMessage());
    exit(1);
}
