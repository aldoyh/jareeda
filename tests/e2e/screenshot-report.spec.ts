import { test, expect, type Page } from '@playwright/test';
import * as fs from 'fs';
import * as path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const SCREENSHOT_DIR = path.join(__dirname, 'screenshots');

if (!fs.existsSync(SCREENSHOT_DIR)) {
  fs.mkdirSync(SCREENSHOT_DIR, { recursive: true });
}

const pages = [
  { name: 'homepage-en', url: '/en/', description: 'Homepage (English)', category: 'public' },
  { name: 'homepage-ar', url: '/ar/', description: 'Homepage (Arabic)', category: 'public' },
  { name: 'login-en', url: '/en/otp-login', description: 'Login Page (English)', category: 'auth' },
  { name: 'login-ar', url: '/ar/otp-login', description: 'Login Page (Arabic)', category: 'auth' },
  { name: 'error-404', url: '/en/nonexistent-page', description: '404 Error Page', category: 'errors' },
];

async function captureScreenshot(page: Page, name: string, url: string): Promise<boolean> {
  try {
    await page.goto(url, { waitUntil: 'domcontentloaded', timeout: 30000 });
    await page.waitForTimeout(2000);

    // Remove debugbar
    await page.evaluate(() => {
      document.querySelectorAll('[id*="phpdebugbar"], [class*="phpdebugbar"], link[href*="_debugbar"], script[src*="_debugbar"]').forEach(el => el.remove());
    });

    const screenshotPath = path.join(SCREENSHOT_DIR, `${name}.png`);
    await page.screenshot({ path: screenshotPath, fullPage: true, type: 'png' });

    const stats = fs.statSync(screenshotPath);
    console.log(`✓ Captured: ${name} (${(stats.size / 1024).toFixed(0)}KB)`);
    return true;
  } catch (error: any) {
    console.log(`✗ Failed to capture ${name}: ${error.message?.substring(0, 100)}`);
    return false;
  }
}

function generateReport(screenshots: Array<{name: string, description: string, category: string, size: string}>): void {
  const reportDir = path.join(__dirname, 'report');
  if (!fs.existsSync(reportDir)) {
    fs.mkdirSync(reportDir, { recursive: true });
  }

  const timestamp = new Date().toISOString().replace(/[:.]/g, '-').slice(0, 19);
  const reportPath = path.join(reportDir, `screenshot-report-${timestamp}.html`);

  const html = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jareeda E2E Screenshot Report</title>
    <style>
        @page { size: A4 landscape; margin: 1cm; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #1a1a2e; background: #fff; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { text-align: center; padding: 30px 0; border-bottom: 3px double #1a1a2e; margin-bottom: 30px; }
        header h1 { font-size: 2rem; font-weight: 300; letter-spacing: 0.3em; text-transform: uppercase; }
        header .subtitle { font-size: 1.1rem; color: #666; margin-top: 10px; }
        .meta { display: flex; justify-content: center; gap: 40px; margin-top: 15px; font-size: 0.85rem; color: #888; }
        h2 { font-size: 1.2rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid #e0e0e0; }
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 40px; }
        .card { border: 1px solid #e0e0e0; border-radius: 4px; overflow: hidden; page-break-inside: avoid; }
        .card img { width: 100%; height: 300px; object-fit: cover; object-position: top; border-bottom: 1px solid #e0e0e0; }
        .card .info { padding: 10px 15px; background: #f9f9f9; }
        .card .info h3 { font-size: 0.95rem; font-weight: 600; }
        .card .info p { font-size: 0.8rem; color: #666; margin-top: 5px; }
        .stats { display: flex; justify-content: center; gap: 40px; margin: 30px 0; }
        .stat-item { text-align: center; }
        .stat-value { font-size: 2rem; font-weight: bold; color: #1a1a2e; }
        .stat-label { font-size: 0.9rem; color: #666; }
        footer { text-align: center; padding: 20px; border-top: 1px solid #e0e0e0; font-size: 0.8rem; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Jareeda CMS</h1>
            <div class="subtitle">Visual Test Report - Bahrain News Platform</div>
            <div class="meta">
                <span>Generated: ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
                <span>Screenshots: ${screenshots.length}</span>
                <span>Articles: 230+ Bahrain news articles</span>
            </div>
        </header>

        <div class="stats">
            <div class="stat-item"><div class="stat-value">${screenshots.length}</div><div class="stat-label">Screenshots</div></div>
            <div class="stat-item"><div class="stat-value">230+</div><div class="stat-label">Articles</div></div>
            <div class="stat-item"><div class="stat-value">180</div><div class="stat-label">With Images</div></div>
            <div class="stat-item"><div class="stat-value">2</div><div class="stat-label">Languages</div></div>
        </div>

        <h2>Screenshots</h2>
        <div class="grid">
            ${screenshots.map(s => `
            <div class="card">
                <img src="../screenshots/${s.name}.png" alt="${s.description}" loading="lazy">
                <div class="info">
                    <h3>${s.description}</h3>
                    <p>Size: ${s.size}</p>
                </div>
            </div>`).join('')}
        </div>

        <footer>
            <p>Jareeda CMS - E2E Visual Test Report</p>
            <p>Bahrain News Platform with newspaper-style layout</p>
        </footer>
    </div>
</body>
</html>`;

  fs.writeFileSync(reportPath, html, 'utf-8');
  console.log(`\nReport: ${reportPath}`);
}

test.describe('Jareeda E2E Screenshots', () => {
  const screenshots: Array<{name: string, description: string, category: string, size: string}> = [];

  test('capture all pages', async ({ page }) => {
    // Block debugbar requests
    await page.route('**/_debugbar/**', route => route.abort());

    for (const pageConfig of pages) {
      const success = await captureScreenshot(page, pageConfig.name, pageConfig.url);
      if (success) {
        const stats = fs.statSync(path.join(SCREENSHOT_DIR, `${pageConfig.name}.png`));
        screenshots.push({
          name: pageConfig.name,
          description: pageConfig.description,
          category: pageConfig.category,
          size: `${(stats.size / 1024).toFixed(0)}KB`,
        });
      }
    }

    generateReport(screenshots);
    console.log(`\n${screenshots.length}/${pages.length} screenshots captured`);
  });
});
