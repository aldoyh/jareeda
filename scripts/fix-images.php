<?php

/**
 * Fix image URLs in database and generate proper SVG placeholders
 * Run: php scripts/fix-images.php
 */
$dbPath = __DIR__ . '/../database/database.sqlite';
$placeholderDir = __DIR__ . '/../public/storage/news-images';

$db = new SQLite3($dbPath);

// 1. Convert all http://localhost/storage/... URLs to relative paths
echo "Step 1: Converting localhost URLs to relative paths...\n";
$result = $db->query("SELECT id, image FROM typicms_news WHERE image LIKE 'http://localhost%'");
$count = 0;
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $path = parse_url($row['image'], PHP_URL_PATH);
    if ($path) {
        $relative = mb_ltrim($path, '/');
        // Ensure it starts with 'storage/'
        if (!str_starts_with($relative, 'storage/')) {
            $relative = 'storage/' . $relative;
        }
        $stmt = $db->prepare('UPDATE typicms_news SET image = :image WHERE id = :id');
        $stmt->bindValue(':image', $relative, SQLITE3_TEXT);
        $stmt->bindValue(':id', $row['id'], SQLITE3_INTEGER);
        $stmt->execute();
        $count++;
    }
}
echo "  Converted {$count} localhost URLs to relative paths\n";

// 2. Check which articles still have no images
$result = $db->query("SELECT COUNT(*) FROM typicms_news WHERE image IS NULL OR image = ''");
$noImages = $result->fetchArray()[0];
echo "Step 2: {$noImages} articles without images\n";

// 3. Generate unique SVG placeholders for articles without images
if ($noImages > 0) {
    echo "Step 3: Generating SVG placeholders for {$noImages} articles...\n";

    $result = $db->query("SELECT id, slug, title, category, language FROM typicms_news WHERE image IS NULL OR image = ''");
    $generated = 0;
    $colors = ['#8b2500', '#1a5276', '#27ae60', '#8e44ad', '#e74c3c', '#f39c12', '#2c3e50', '#16a085'];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = $row['id'];
        $title = is_array($row['title']) ? ($row['title']['en'] ?? reset($row['title'])) : $row['title'];
        $title = html_entity_decode(strip_tags($title));
        $category = $row['category'] ?? 'News';
        $language = $row['language'] ?? 'en';
        $color = $colors[$id % count($colors)];
        $bgColor = $color . '22';

        // Truncate title for display
        $displayTitle = mb_strlen($title) > 40 ? mb_substr($title, 0, 40) . '...' : $title;
        $displayTitle = htmlspecialchars($displayTitle, ENT_XML1);

        // Create unique SVG
        $svg = <<<SVG
<svg width="600" height="338" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="bg{$id}" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:{$color};stop-opacity:0.15" />
            <stop offset="100%" style="stop-color:{$color};stop-opacity:0.08" />
        </linearGradient>
    </defs>
    <rect width="600" height="338" fill="url(#bg{$id})" rx="4"/>
    <rect x="0" y="0" width="600" height="6" fill="{$color}" rx="4"/>
    <text x="300" y="140" font-family="Georgia, serif" font-size="18" fill="{$color}" text-anchor="middle" font-weight="bold">{$displayTitle}</text>
    <text x="300" y="175" font-family="Arial, sans-serif" font-size="12" fill="#888" text-anchor="middle">{$category}</text>
    <text x="300" y="200" font-family="Arial, sans-serif" font-size="11" fill="#aaa" text-anchor="middle">{$language}</text>
    <rect x="250" y="240" width="100" height="30" rx="15" fill="{$color}" opacity="0.1"/>
    <text x="300" y="260" font-family="Arial, sans-serif" font-size="10" fill="{$color}" text-anchor="middle" font-weight="bold">JAREEDA</text>
</svg>
SVG;

        $filename = "placeholder_{$id}.svg";
        $filepath = $placeholderDir . '/' . $filename;

        file_put_contents($filepath, $svg);

        $dbPath = "news-images/{$filename}";
        $stmt = $db->prepare('UPDATE typicms_news SET image = :image WHERE id = :id');
        $stmt->bindValue(':image', $dbPath, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
        $generated++;
    }
    echo "  Generated {$generated} unique SVG placeholders\n";
}

// 4. Verify final state
echo "\n=== Final Image Status ===\n";
$stats = $db->query("SELECT
    COUNT(*) as total,
    SUM(CASE WHEN image LIKE 'storage/news/%' THEN 1 ELSE 0 END) as local_files,
    SUM(CASE WHEN image LIKE 'storage/news-images/%' THEN 1 ELSE 0 END) as svg_placeholders,
    SUM(CASE WHEN image LIKE 'http%' AND image NOT LIKE 'http://localhost%' THEN 1 ELSE 0 END) as external_urls,
    SUM(CASE WHEN image IS NULL OR image = '' THEN 1 ELSE 0 END) as no_images
FROM typicms_news");
$row = $stats->fetchArray(SQLITE3_ASSOC);
echo "  Total: {$row['total']}\n";
echo "  Local files: {$row['local_files']}\n";
echo "  SVG placeholders: {$row['svg_placeholders']}\n";
echo "  External URLs: {$row['external_urls']}\n";
echo "  No images: {$row['no_images']}\n";

$db->close();
echo "\nDone!\n";
