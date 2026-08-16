import { chromium } from 'playwright';

(async () => {
    const browser = await chromium.launch({ headless: true });
    const context = await browser.newContext({ viewport: { width: 1440, height: 900 } });
    const page = await context.newPage();

    // Block external resources to avoid crashing the dev server
    await page.route('**/*.{woff,woff2,ttf,otf}', route => route.abort());

    console.log('Loading English homepage...');
    try {
        await page.goto('http://127.0.0.1:8000/en/', { waitUntil: 'domcontentloaded', timeout: 30000 });
        await page.waitForTimeout(5000);
    } catch (e) {
        console.log('EN page error:', (e as Error).message.substring(0, 100));
    }

    const imgCount = await page.locator('img').count();
    console.log('Total images on EN page:', imgCount);

    const imgSrcs = await page.evaluate(() => {
        const imgs = document.querySelectorAll('img');
        return Array.from(imgs).slice(0, 15).map(i => ({
            src: i.src,
            naturalWidth: i.naturalWidth,
            naturalHeight: i.naturalHeight,
        }));
    });

    imgSrcs.forEach((img, i) => {
        const status = img.naturalWidth > 0 ? 'LOADED' : 'BROKEN';
        console.log(`  [${i + 1}] ${status} (${img.naturalWidth}x${img.naturalHeight}): ${img.src.substring(0, 90)}`);
    });

    await page.screenshot({ path: 'tests/e2e/screenshots/homepage-en-with-images.png' });
    console.log('EN screenshot saved');

    // Arabic page
    console.log('Loading Arabic homepage...');
    try {
        await page.goto('http://127.0.0.1:8000/ar/', { waitUntil: 'domcontentloaded', timeout: 30000 });
        await page.waitForTimeout(5000);
    } catch (e) {
        console.log('AR page error:', (e as Error).message.substring(0, 100));
    }

    await page.screenshot({ path: 'tests/e2e/screenshots/homepage-ar-with-images.png' });
    console.log('AR screenshot saved');

    await browser.close();
    console.log('Done!');
})();
