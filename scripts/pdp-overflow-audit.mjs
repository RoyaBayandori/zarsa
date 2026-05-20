/**
 * DevTools-style horizontal overflow audit.
 * Usage: node scripts/pdp-overflow-audit.mjs [url]
 */
import { chromium } from 'playwright';

const url = process.argv[2] || 'http://localhost:8001/';
const viewports = [
  { name: 'mobile', width: 390, height: 844 },
  { name: 'desktop', width: 1280, height: 900 },
];

function findOverflowingElements(page) {
  return page.evaluate(() => {
    const docW = document.documentElement.clientWidth;
    const offenders = [];

    document.querySelectorAll('*').forEach((el) => {
      if (!(el instanceof HTMLElement)) return;
      const rect = el.getBoundingClientRect();
      const overRight = rect.right - docW;
      const overLeft = -rect.left;
      const overflow = Math.max(overRight, overLeft);
      if (overflow <= 1) return;

      const style = getComputedStyle(el);
      offenders.push({
        tag: el.tagName.toLowerCase(),
        id: el.id || null,
        classes: el.className && typeof el.className === 'string' ? el.className : null,
        overflowPx: Math.round(overflow * 10) / 10,
        rect: {
          left: Math.round(rect.left),
          right: Math.round(rect.right),
          width: Math.round(rect.width),
        },
        position: style.position,
        transform: style.transform !== 'none' ? style.transform : null,
        visibility: style.visibility,
      });
    });

    offenders.sort((a, b) => b.overflowPx - a.overflowPx);
    return {
      clientWidth: docW,
      scrollWidth: document.documentElement.scrollWidth,
      hasDocumentOverflow: document.documentElement.scrollWidth > docW + 1,
      top: offenders.slice(0, 12),
    };
  });
}

const browser = await chromium.launch({ headless: true });

for (const vp of viewports) {
  const page = await browser.newPage({ viewport: { width: vp.width, height: vp.height } });
  await page.goto(url, { waitUntil: 'networkidle', timeout: 60000 });
  const report = await findOverflowingElements(page);
  console.log(`\n=== ${vp.name} (${vp.width}px) ===`);
  console.log(`scrollWidth ${report.scrollWidth} / clientWidth ${report.clientWidth} → overflow: ${report.hasDocumentOverflow}`);
  report.top.forEach((o, i) => {
    const sel = [o.tag, o.id ? `#${o.id}` : '', o.classes ? `.${o.classes.split(/\s+/).slice(0, 3).join('.')}` : ''].join('');
    console.log(
      `${i + 1}. ${sel} +${o.overflowPx}px | right ${o.rect.right} | pos ${o.position}${o.transform ? ` | ${o.transform}` : ''}${o.visibility !== 'visible' ? ` | vis ${o.visibility}` : ''}`
    );
  });
  await page.close();
}

await browser.close();
