import { chromium } from 'playwright';
import { spawn, execSync } from 'child_process';
import * as fs from 'fs';
import * as path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const SCREENSHOT_DIR = path.join(__dirname, '../tests/e2e/screenshots');
fs.mkdirSync(SCREENSHOT_DIR, { recursive: true });

const SERVER_URL = 'http://127.0.0.1:8000';

function killServer() {
  try { execSync('kill $(lsof -ti:8000) 2>/dev/null || true', { shell: 'bash' }); } catch {}
}

function startServer(): Promise<void> {
  return new Promise((resolve) => {
    killServer();
    spawn('php', ['artisan', 'serve', '--host=127.0.0.1', '--port=8000', '--no-reload'], {
      cwd: '/Users/aldoyh/Sites/jareeda',
      stdio: 'ignore',
      detached: true,
    }).unref();
    setTimeout(resolve, 3000);
  });
}

async function waitForServer(retries = 15): Promise<boolean> {
  for (let i = 0; i < retries; i++) {
    try {
      execSync(`curl -s -o /dev/null -w "%{http_code}" ${SERVER_URL}/en/`, { timeout: 10000, encoding: 'utf-8' });
      return true;
    } catch { await new Promise(r => setTimeout(r, 1000)); }
  }
  return false;
}

async function capture(browser: any, name: string, url: string, fullPage: boolean, waitMs: number) {
  const ctx = await browser.newContext({ viewport: { width: 1440, height: 900 } });
  const page = await ctx.newPage();
  try {
    await page.route('**/_debugbar/**', (route: any) => route.abort());
    console.log(`  Capturing ${name}...`);
    await page.goto(`${SERVER_URL}${url}`, { waitUntil: 'domcontentloaded', timeout: 30000 });
    await page.waitForTimeout(waitMs);
    await page.evaluate(() => {
      document.querySelectorAll('[id*="phpdebugbar"], [class*="phpdebugbar"], link[href*="_debugbar"], script[src*="_debugbar"]').forEach(el => el.remove());
    });
    const outPath = path.join(SCREENSHOT_DIR, `${name}.png`);
    await page.screenshot({ path: outPath, fullPage });
    const kb = (fs.statSync(outPath).size / 1024).toFixed(0);
    console.log(`  ✓ ${name}: ${kb}KB`);
  } catch (e: any) {
    console.log(`  ✗ ${name}: ${e.message?.substring(0, 80)}`);
  }
  await ctx.close();
}

async function main() {
  console.log('E2E Screenshot Suite\n');

  const browser = await chromium.launch({ headless: true, args: ['--no-sandbox'] });

  // Pages that are lightweight
  const lightPages = [
    { name: 'login-en', url: '/en/otp-login', fullPage: true, wait: 1000 },
    { name: 'login-ar', url: '/ar/otp-login', fullPage: true, wait: 1000 },
    { name: 'error-404', url: '/en/nonexistent-page', fullPage: true, wait: 1000 },
  ];

  // Heavy homepage pages (server restart needed)
  const heavyPages = [
    { name: 'homepage-en', url: '/en/', fullPage: true, wait: 2000 },
    { name: 'homepage-ar', url: '/ar/', fullPage: true, wait: 2000 },
    { name: 'homepage-en-viewport', url: '/en/', fullPage: false, wait: 2000 },
    { name: 'homepage-ar-viewport', url: '/ar/', fullPage: false, wait: 2000 },
  ];

  // Capture light pages first
  console.log('Light pages:');
  await startServer();
  if (!await waitForServer()) { console.log('Server failed!'); return; }
  for (const shot of lightPages) {
    await capture(browser, shot.name, shot.url, shot.fullPage, shot.wait);
  }

  // Capture each heavy page with a fresh server
  for (const shot of heavyPages) {
    console.log(`\nHeavy page: ${shot.name}`);
    await startServer();
    if (!await waitForServer()) { console.log('Server failed!'); continue; }
    await capture(browser, shot.name, shot.url, shot.fullPage, shot.wait);
    killServer();
    await new Promise(r => setTimeout(r, 1000));
  }

  await browser.close();
  killServer();
  console.log('\nDone!');
}

main();
