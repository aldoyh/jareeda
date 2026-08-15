import { chromium } from 'playwright';
import * as fs from 'fs';
import * as path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

interface ArticleUrl {
  id: number;
  url: string;
  slug: string;
}

interface ScrapeResult {
  id: number;
  url: string;
  title: string;
  body: string;
  image: string | null;
  success: boolean;
  error?: string;
}

async function scrapeArticle(page: any, article: ArticleUrl): Promise<ScrapeResult> {
  try {
    await page.goto(article.url, { 
      waitUntil: 'domcontentloaded', 
      timeout: 20000 
    });
    
    // Wait for content to load
    await page.waitForTimeout(2000);
    
    // Extract title
    const title = await page.evaluate(() => {
      const ogTitle = document.querySelector('meta[property="og:title"]');
      if (ogTitle) return ogTitle.getAttribute('content') || '';
      
      const h1 = document.querySelector('h1');
      if (h1) return h1.textContent?.trim() || '';
      
      return document.title || '';
    });
    
    // Extract body - try multiple selectors
    const body = await page.evaluate(() => {
      // Try common article body selectors
      const selectors = [
        'article',
        '.article-body',
        '.post-content',
        '.entry-content',
        '.content-area',
        '.story-body',
        '.article-content',
        '[itemprop="articleBody"]',
        '.rich-content',
        '.page-content',
        'main',
      ];
      
      for (const selector of selectors) {
        const element = document.querySelector(selector);
        if (element && element.textContent && element.textContent.length > 100) {
          // Clean up the text
          let text = element.textContent || '';
          text = text.replace(/\s+/g, ' ').trim();
          
          // Also try to get HTML for better structure
          const html = element.innerHTML || '';
          
          // Extract paragraphs
          const paragraphs = element.querySelectorAll('p');
          if (paragraphs.length > 0) {
            return Array.from(paragraphs)
              .map((p: any) => p.textContent?.trim())
              .filter((t: string) => t && t.length > 20)
              .join('\n\n');
          }
          
          return text;
        }
      }
      
      return '';
    });
    
    // Extract featured image
    const image = await page.evaluate(() => {
      // Try og:image first
      const ogImage = document.querySelector('meta[property="og:image"]');
      if (ogImage) return ogImage.getAttribute('content') || null;
      
      // Try twitter:image
      const twitterImage = document.querySelector('meta[name="twitter:image"]');
      if (twitterImage) return twitterImage.getAttribute('content') || null;
      
      // Try first article image
      const articleImg = document.querySelector('article img, .article-body img, .post-content img');
      if (articleImg) return articleImg.getAttribute('src') || null;
      
      // Try first content image
      const contentImg = document.querySelector('.content img, .entry-content img');
      if (contentImg) return contentImg.getAttribute('src') || null;
      
      return null;
    });
    
    return {
      id: article.id,
      url: article.url,
      title,
      body,
      image,
      success: true,
    };
  } catch (error: any) {
    return {
      id: article.id,
      url: article.url,
      title: '',
      body: '',
      image: null,
      success: false,
      error: error.message,
    };
  }
}

async function main() {
  const urlsFile = process.argv[2] || path.join(__dirname, '../storage/app/scraper-urls.json');
  const resultsFile = path.join(path.dirname(urlsFile), 'scraper-results.json');
  
  if (!fs.existsSync(urlsFile)) {
    console.error(`URLs file not found: ${urlsFile}`);
    process.exit(1);
  }
  
  const articles: ArticleUrl[] = JSON.parse(fs.readFileSync(urlsFile, 'utf-8'));
  console.log(`Scraping ${articles.length} articles...`);
  
  const browser = await chromium.launch({ 
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });
  
  const context = await browser.newContext({
    userAgent: 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    viewport: { width: 1920, height: 1080 },
  });
  
  const page = await context.newPage();
  
  const results: ScrapeResult[] = [];
  let successCount = 0;
  
  for (const article of articles) {
    console.log(`Scraping: ${article.slug.substring(0, 50)}...`);
    
    const result = await scrapeArticle(page, article);
    results.push(result);
    
    if (result.success && result.body.length > 100) {
      successCount++;
    }
    
    // Small delay to be polite
    await page.waitForTimeout(500);
  }
  
  await browser.close();
  
  // Save results
  fs.writeFileSync(resultsFile, JSON.stringify(results, null, 2));
  
  console.log(`\nScraping complete!`);
  console.log(`  Success: ${successCount}/${articles.length}`);
  console.log(`  Results saved to: ${resultsFile}`);
}

main().catch(console.error);
