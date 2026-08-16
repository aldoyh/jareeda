import { chromium } from 'playwright';
import { mkdirSync } from 'fs';

const BASE = 'http://127.0.0.1:8000';
const DIR = 'tests/e2e/screenshots';

async function captureDarkMode() {
    mkdirSync(DIR, { recursive: true });

    const browser = await chromium.launch();
    const context = await browser.newContext({
        viewport: { width: 1440, height: 900 },
    });
    const page = await context.newPage();

    // Set dark mode via localStorage before navigation
    await page.goto(BASE + '/en/', { waitUntil: 'load' });
    await page.evaluate(() => {
        localStorage.setItem('jareeda-theme', 'dark');
        document.documentElement.setAttribute('data-theme', 'dark');
    });

    // Reload to apply dark mode
    await page.goto(BASE + '/en/', { waitUntil: 'load' });
    await page.waitForTimeout(2000);

    // Full page screenshot
    await page.screenshot({
        path: `${DIR}/homepage-en-dark.png`,
        fullPage: true,
    });
    console.log('  \u2713 homepage-en-dark.png');

    // Viewport screenshot
    await page.screenshot({
        path: `${DIR}/homepage-en-dark-viewport.png`,
        fullPage: false,
    });
    console.log('  \u2713 homepage-en-dark-viewport.png');

    // Arabic dark mode
    await page.goto(BASE + '/ar/', { waitUntil: 'load' });
    await page.waitForTimeout(2000);
    await page.screenshot({
        path: `${DIR}/homepage-ar-dark.png`,
        fullPage: true,
    });
    console.log('  \u2713 homepage-ar-dark.png');

    await page.screenshot({
        path: `${DIR}/homepage-ar-dark-viewport.png`,
        fullPage: false,
    });
    console.log('  \u2713 homepage-ar-dark-viewport.png');

    await browser.close();
    console.log('\nDone! Dark mode screenshots captured.');
}

captureDarkMode().catch(console.error);
