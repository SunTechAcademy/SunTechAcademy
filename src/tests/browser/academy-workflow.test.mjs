import { test } from 'node:test';
import assert from 'node:assert/strict';
import { chromium } from '@playwright/test';
import { spawn, spawnSync } from 'node:child_process';
import { mkdtempSync, writeFileSync, existsSync, rmSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join, resolve } from 'node:path';
import { randomBytes } from 'node:crypto';
import { createServer } from 'node:net';

// Real browser → real Laravel HTTP server → disposable SQLite database.
// No existing MySQL/Supabase data or local account credentials are used.
test('student logs in, creates a task, finds it and completes it', { timeout: 90000 }, async () => {
    const root = resolve(import.meta.dirname, '../..');
    assert.ok(existsSync(join(root, 'public/build/manifest.json')), 'Run npm run build first.');
    const temp = mkdtempSync(join(tmpdir(), 'academy-e2e-'));
    const database = join(temp, 'database.sqlite');
    writeFileSync(database, '');
    const portProbe = createServer();
    await new Promise(resolve => portProbe.listen(0, '127.0.0.1', resolve));
    const port = portProbe.address().port;
    await new Promise(resolve => portProbe.close(resolve));
    const baseUrl = `http://127.0.0.1:${port}`;
    const env = { ...process.env, APP_ENV: 'testing', APP_DEBUG: 'false', APP_URL: baseUrl,
        APP_KEY: `base64:${randomBytes(32).toString('base64')}`, APP_CONFIG_CACHE: join(temp, 'config.php'),
        DB_CONNECTION: 'sqlite', DB_DATABASE: database, DB_URL: '', SESSION_DRIVER: 'cookie',
        SESSION_SECURE_COOKIE: 'false', SESSION_DOMAIN: '', CACHE_STORE: 'array', QUEUE_CONNECTION: 'sync', MAIL_MAILER: 'array' };
    let server, browser;
    const php = args => {
        const result = spawnSync('php', args, { cwd: root, env, encoding: 'utf8' });
        assert.equal(result.status, 0, result.stdout + result.stderr);
    };
    try {
        php(['artisan', 'migrate', '--force', '--no-interaction']);
        php(['tests/browser/fixtures/seed-academy-example.php']);
        server = spawn('php', ['-S', `127.0.0.1:${port}`, join(root, 'vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php')], { cwd: join(root, 'public'), env, stdio: 'ignore' });
        let ready = false;
        for (let attempt = 0; attempt < 100; attempt++) {
            try { if ((await fetch(`${baseUrl}/up`)).ok) { ready = true; break; } } catch {}
            await new Promise(resolve => setTimeout(resolve, 100));
        }
        assert.ok(ready, 'Laravel server did not start.');
        const chrome = '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';
        browser = await chromium.launch({ headless: true, ...(process.env.CHROME_PATH ? { executablePath: process.env.CHROME_PATH } : existsSync(chrome) ? { executablePath: chrome } : {}) });
        const page = await browser.newPage();
        await page.goto(`${baseUrl}/login`);
        await page.locator('input[name=email]').fill('example-e2e@example.invalid');
        await page.locator('input[name=password]').fill('ExampleOnly2026!');
        await page.locator('button[type=submit]').click();
        await page.waitForURL(`${baseUrl}/dashboard`);
        await page.goto(`${baseUrl}/courses/intermediate`);
        await page.getByRole('link', { name: '＋ タスクを発行する' }).click();
        await page.locator('#phase').selectOption('implementation');
        await page.locator('#title').fill('総合テスト例：検索機能を実装する');
        await page.locator('[contenteditable=true]').fill('検索結果が表示されることを確認する。');
        await page.getByRole('button', { name: 'タスクを発行する →' }).click();
        await page.waitForURL(`${baseUrl}/courses/intermediate`);
        const active = page.locator('#assigned-tasks');
        await active.getByRole('link', { name: /総合テスト例：検索機能を実装する/ }).click();
        await page.getByRole('button', { name: 'タスクを完了する ✓' }).click();
        await page.waitForURL(`${baseUrl}/courses/intermediate/phase/implementation`);
        await page.goto(`${baseUrl}/courses/intermediate`);
        assert.match(await active.innerText(), /現在、担当中のタスクはありません/);
        assert.equal(await page.locator('.intermediate-sidebar .course-stat').first().locator('strong').innerText(), '1');
    } finally {
        await browser?.close();
        if (server && server.exitCode === null) {
            await new Promise(resolve => { server.once('exit', resolve); server.kill(); });
        }
        rmSync(temp, { recursive: true, force: true });
    }
});
