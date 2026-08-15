import { chromium } from 'playwright';
import { spawn, execSync } from 'child_process';
import * as fs from 'fs';
import * as path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const SCREENSHOT_DIR = path.join(__dirname, '../tests/e2e/screenshots');
fs.mkdirSync(SCREENSHOT_DIR, { recursive: true });

const SERVER_URL = 'http://127.0.0.1:8000';

function startServer(): Promise<void> {
  return new Promise((resolve) => {
    const server = spawn('php', ['artisan', 'serve', '--host=127.0.0.1', '--port=8000', '--no-reload'], {
      cwd: '/Users/aldoyh/Sites/jareeda',
      stdio: 'ignore',
      detached: true,
    });
    server.unref();
    setTimeout(resolve, 4000);
  });
}

async function waitForServer(url: string, retries = 10): Promise<boolean> {
  for (let i = 0; i < retries; i++) {
    try {
      execSync(`curl -s -o /dev/null ${url}`, { timeout: 5000 });
      return true;
    } catch {
      await new Promise(r => setTimeout(r, 1000));
    }
  }
  return false;
}

const SCREENSHOTS = [
  { name: 'homepage-en', url: '/en/' },
  { name: 'homepage-ar', url: '/ar/' },
  { name: 'login-en', url: '/en/otp-login' },
  { name: 'login-ar', url: '/ar/otp-login' },
  { name: 'error-404', url: '/en/nonexistent-page' },
];

async function main() {
  for (const shot of SCREENSHOTS) {
    // Start fresh server for each page to avoid memory issues
    execSync('kill $(lsof -ti:8000) 2>/dev/null || true', { shell: 'bash' });
    await new Promise(r => setTimeout(r, 500));
    await startServer();

    if (!await waitForServer(SERVER_URL)) {
      console.log(`✗ Server failed for ${shot.name}`);
      continue;
    }

    const browser = await chromium.launch({ headless: true, args: ['--no-sandbox'] });
    const ctx = await browser.newContext({ viewport: { width: 1440, height: 900 } });
    const page = await ctx.newPage();

    try {
      await page.route('**/_debugbar/**', route => route.abort());
      await page.goto(`${SERVER_URL}${shot.url}`, { waitUntil: 'domcontentloaded', timeout: 60000 });
      await page.waitForTimeout(1500);
      await page.evaluate(() => {
        document.querySelectorAll('[id*="phpdebugbar"], [class*="phpdebugbar"], link[href*="_debugbar"], script[src*="_debugbar"]').forEach(el => el.remove());
      });
      const p = path.join(SCREENSHOT_DIR, `${shot.name}.png`);
      await page.screenshot({ path: p, fullPage: true });
      const kb = (fs.statSync(p).size / 1024).toFixed(0);
      console.log(`✓ ${shot.name}: ${kb}KB`);
    } catch (e: any) {
      console.log(`✗ ${shot.name}: ${e.message?.substring(0, 80)}`);
    }

    await browser.close();
  }

  execSync('kill $(lsof -ti:8000) 2>/dev/null || true', { shell: 'bash' });
  console.log('\nDone!');
}

main();
