import { chromium } from 'playwright';
import * as fs from 'fs';
import * as path from 'path';
import { fileURLToPath } from 'url';
import { execSync } from 'child_process';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const SCREENSHOT_DIR = path.join(__dirname, '../tests/e2e/screenshots');
const BASE_URL = 'http://127.0.0.1:8000';

if (!fs.existsSync(SCREENSHOT_DIR)) {
  fs.mkdirSync(SCREENSHOT_DIR, { recursive: true });
}

const pages = [
  { name: 'homepage-en', url: '/en/', description: 'Homepage (English)' },
  { name: 'homepage-ar', url: '/ar/', description: 'Homepage (Arabic)' },
  { name: 'login-en', url: '/en/otp-login', description: 'Login Page (English)' },
  { name: 'login-ar', url: '/ar/otp-login', description: 'Login Page (Arabic)' },
  { name: 'error-404', url: '/en/nonexistent-page', description: '404 Error Page' },
];

async function capture() {
  // Start server
  console.log('Starting server...');
  execSync('cd /Users/aldoyh/Sites/jareeda && nohup php artisan serve --host=127.0.0.1 --port=8000 --no-reload > /tmp/pw-server.log 2>&1 &', { shell: 'bash' });
  await new Promise(r => setTimeout(r, 4000));

  // Verify server
  try {
    execSync('curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:8000/en/');
    console.log('Server is running');
  } catch {
    console.error('Server failed to start');
    process.exit(1);
  }

  const browser = await chromium.launch({ headless: true, args: ['--no-sandbox'] });
  const results: Array<{name: string, description: string, size: string}> = [];

  for (const pageConfig of pages) {
    // Restart server before each heavy page
    try { execSync('curl -s -o /dev/null http://127.0.0.1:8000/en/ 2>/dev/null'); } catch {
      console.log(`  Restarting server for ${pageConfig.name}...`);
      execSync('kill $(lsof -ti:8000) 2>/dev/null || true', { shell: 'bash' });
      await new Promise(r => setTimeout(r, 1000));
      execSync('cd /Users/aldoyh/Sites/jareeda && nohup php artisan serve --host=127.0.0.1 --port=8000 --no-reload > /tmp/pw-server.log 2>&1 &', { shell: 'bash' });
      await new Promise(r => setTimeout(r, 4000));
    }

    const context = await browser.newContext({ viewport: { width: 1440, height: 900 } });
    const page = await context.newPage();

    try {
      // Block debugbar
      await page.route('**/_debugbar/**', route => route.abort());

      console.log(`Capturing ${pageConfig.description}...`);
      await page.goto(`${BASE_URL}${pageConfig.url}`, { waitUntil: 'domcontentloaded', timeout: 30000 });
      await page.waitForTimeout(2000);

      // Remove debugbar elements
      await page.evaluate(() => {
        document.querySelectorAll('[id*="phpdebugbar"], [class*="phpdebugbar"], link[href*="_debugbar"], script[src*="_debugbar"]').forEach(el => el.remove());
      });

      const screenshotPath = path.join(SCREENSHOT_DIR, `${pageConfig.name}.png`);
      await page.screenshot({ path: screenshotPath, fullPage: true, type: 'png' });

      const stats = fs.statSync(screenshotPath);
      const sizeKB = (stats.size / 1024).toFixed(0);
      console.log(`  ✓ ${pageConfig.description}: ${sizeKB}KB`);
      results.push({ name: pageConfig.name, description: pageConfig.description, size: `${sizeKB}KB` });
    } catch (error: any) {
      console.log(`  ✗ ${pageConfig.description}: ${error.message?.substring(0, 80)}`);
    }

    await context.close();
  }

  await browser.close();

  // Kill server
  execSync('kill $(lsof -ti:8000) 2>/dev/null || true', { shell: 'bash' });

  // Generate report
  generateReport(results);
  console.log(`\nDone! ${results.length}/${pages.length} screenshots captured`);
}

function generateReport(results: Array<{name: string, description: string, size: string}>) {
  const reportDir = path.join(__dirname, '../tests/e2e/report');
  if (!fs.existsSync(reportDir)) fs.mkdirSync(reportDir, { recursive: true });

  const timestamp = new Date().toISOString().replace(/[:.]/g, '-').slice(0, 19);
  const reportPath = path.join(reportDir, `screenshot-report-${timestamp}.html`);

  const html = `<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jareeda E2E Screenshot Report</title>
<style>
@page{size:A4 landscape;margin:1cm}*{margin:0;padding:0;box-sizing:border-box}body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;line-height:1.6;color:#1a1a2e;background:#fff}.container{max-width:1200px;margin:0 auto;padding:20px}header{text-align:center;padding:30px 0;border-bottom:3px double #1a1a2e;margin-bottom:30px}header h1{font-size:2rem;font-weight:300;letter-spacing:.3em;text-transform:uppercase}header .sub{font-size:1.1rem;color:#666;margin-top:10px}.meta{display:flex;justify-content:center;gap:40px;margin-top:15px;font-size:.85rem;color:#888}h2{font-size:1.2rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin:30px 0 20px;padding-bottom:10px;border-bottom:2px solid #e0e0e0}.grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-bottom:40px}.card{border:1px solid #e0e0e0;border-radius:4px;overflow:hidden;page-break-inside:avoid}.card img{width:100%;height:300px;object-fit:cover;object-position:top;border-bottom:1px solid #e0e0e0}.card .info{padding:10px 15px;background:#f9f9f9}.card .info h3{font-size:.95rem;font-weight:600}.card .info p{font-size:.8rem;color:#666;margin-top:5px}.stats{display:flex;justify-content:center;gap:40px;margin:30px 0}.stat-item{text-align:center}.stat-value{font-size:2rem;font-weight:700;color:#1a1a2e}.stat-label{font-size:.9rem;color:#666}footer{text-align:center;padding:20px;border-top:1px solid #e0e0e0;font-size:.8rem;color:#888}
</style>
</head>
<body>
<div class="container">
<header>
<h1>JAREEDA</h1>
<div class="sub">Bahrain News Platform - E2E Visual Report</div>
<div class="meta">
<span>Generated: ${new Date().toLocaleDateString('en-US', {year:'numeric',month:'long',day:'numeric'})}</span>
<span>Screenshots: ${results.length}</span>
<span>Articles: 230+ Bahrain news</span>
</div>
</header>
<div class="stats">
<div class="stat-item"><div class="stat-value">${results.length}</div><div class="stat-label">Screenshots</div></div>
<div class="stat-item"><div class="stat-value">230+</div><div class="stat-label">Articles</div></div>
<div class="stat-item"><div class="stat-value">180</div><div class="stat-label">With Images</div></div>
<div class="stat-item"><div class="stat-value">2</div><div class="stat-label">Languages</div></div>
</div>
<h2>Screenshots</h2>
<div class="grid">
${results.map(r => `<div class="card"><img src="../screenshots/${r.name}.png" alt="${r.description}" loading="lazy"><div class="info"><h3>${r.description}</h3><p>Size: ${r.size}</p></div></div>`).join('\n')}
</div>
<footer><p>Jareeda CMS - Bahrain News Platform with newspaper-style layout</p></footer>
</div>
</body>
</html>`;

  fs.writeFileSync(reportPath, html);
  console.log(`Report: ${reportPath}`);
}

capture().catch(console.error);
