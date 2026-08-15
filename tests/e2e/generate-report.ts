import * as fs from 'fs';
import * as path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const SCREENSHOT_DIR = path.join(__dirname, 'screenshots');
const REPORT_DIR = path.join(__dirname, 'report');

// Get all PNG files
const screenshots = fs.readdirSync(SCREENSHOT_DIR)
  .filter(file => file.endsWith('.png'))
  .map(file => {
    const name = file.replace('.png', '');
    const parts = name.split('-');
    const category = parts[0] || 'unknown';
    return { name, file, category };
  });

// Group by category
const grouped = screenshots.reduce((acc, s) => {
  if (!acc[s.category]) acc[s.category] = [];
  acc[s.category].push(s);
  return acc;
}, {} as Record<string, Array<{name: string, file: string, category: string}>>);

const timestamp = new Date().toISOString().replace(/[:.]/g, '-').slice(0, 19);
const reportPath = path.join(REPORT_DIR, `jareeda-report-${timestamp}.html`);

const html = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jareeda CMS - Visual Test Report</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1cm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1a1a2e;
            background: #fff;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 3px double #1a1a2e;
            margin-bottom: 30px;
        }
        
        header h1 {
            font-size: 2rem;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        header .subtitle {
            font-size: 0.9rem;
            color: #666;
            margin-top: 10px;
        }
        
        .meta {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 15px;
            font-size: 0.85rem;
            color: #888;
        }
        
        h2 {
            font-size: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 30px 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            page-break-inside: avoid;
        }
        
        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            object-position: top;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .card .info {
            padding: 10px 15px;
            background: #f9f9f9;
        }
        
        .card .info h3 {
            font-size: 0.95rem;
            font-weight: 600;
        }
        
        .card .info p {
            font-size: 0.8rem;
            color: #666;
            margin-top: 5px;
        }
        
        footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 0.8rem;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Jareeda CMS</h1>
            <div class="subtitle">Visual Test Report</div>
            <div class="meta">
                <span>Generated: ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
                <span>Screenshots: ${screenshots.length}</span>
            </div>
        </header>
        
        ${Object.entries(grouped).map(([category, items]) => `
            <h2>${category}</h2>
            <div class="grid">
                ${items.map(s => `
                    <div class="card">
                        <img src="../screenshots/${s.file}" alt="${s.name}">
                        <div class="info">
                            <h3>${s.name}</h3>
                            <p>Category: ${category}</p>
                        </div>
                    </div>
                `).join('')}
            </div>
        `).join('')}
        
        <footer>
            <p>Jareeda CMS - E2E Visual Test Report</p>
            <p>Generated with Playwright</p>
        </footer>
    </div>
</body>
</html>`;

fs.writeFileSync(reportPath, html, 'utf-8');
console.log(`Report generated: ${reportPath}`);
