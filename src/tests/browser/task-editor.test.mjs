import { test, before, after } from 'node:test';
import assert from 'node:assert/strict';
import { chromium } from '@playwright/test';
import { readFileSync, existsSync } from 'node:fs';
import { createServer } from 'node:http';

let browser, server, baseUrl;
const manifest = JSON.parse(readFileSync(new URL('../../public/build/manifest.json', import.meta.url)));
const bundle = readFileSync(new URL('../../public/build/' + manifest['resources/js/task-editor.js'].file, import.meta.url));
const fixture = `<form><div data-task-editor><input name="description_format" value="markdown" type="hidden"><div>${['bold','italic','list','ordered','quote','inline','code','undo','redo'].map(key => `<button type="button" data-style="${key}">${key}</button>`).join('')}</div><textarea name="description" required></textarea><div data-editor-surface hidden></div><p role="status"></p></div><button type="submit">submit</button></form>`;
before(async () => {
    server = createServer((req,res) => {
        if(req.url === '/editor.js') {res.setHeader('Content-Type','application/javascript'); res.end(bundle);}
        else {res.setHeader('Content-Type','text/html');res.end(fixture);}
    });
    await new Promise(resolve => server.listen(0, '127.0.0.1', resolve));
    baseUrl = `http://127.0.0.1:${server.address().port}`;
    const chrome = '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';
    browser = await chromium.launch({ headless:true, ...(existsSync(chrome) ? { executablePath:chrome } : {}) });
});
after(async () => { await browser?.close(); await new Promise(resolve=>server?.close(resolve)); });
async function open(value = '', format = 'markdown') {
    const page = await browser.newPage();
    await page.goto(baseUrl);
    await page.locator('textarea').fill(value);
    await page.locator('[name=description_format]').evaluate((el, val)=>el.value=val,format);
    await page.addScriptTag({url:baseUrl+'/editor.js',type:'module'});
    await page.locator('[contenteditable=true]').waitFor();
    return page;
}
test('bold is visible while typing, selected text can be formatted and undone',async()=>{
    const page=await open();
    try {
        await page.locator('[data-style=bold]').click();
        await page.keyboard.insertText('太字の文章');
        assert.equal(await page.locator('[contenteditable] strong').textContent(),'太字の文章');
        assert.equal(await page.locator('[contenteditable]').textContent(),'太字の文章');
        assert.equal(await page.locator('textarea').inputValue(),'**太字の文章**');
        assert.equal(await page.locator('[data-style=bold]').getAttribute('aria-pressed'),'true');
        await page.keyboard.press('ControlOrMeta+a');
        await page.locator('[data-style=italic]').click();
        assert.equal(await page.locator('[contenteditable] em').textContent(),'太字の文章');
        await page.locator('[data-style=undo]').click();
        assert.equal(await page.locator('[contenteditable] em').count(),0);
    }finally{await page.close();}
});
test('code and lists render immediately and round-trip after reload',async()=>{
    const page=await open();
    try {
        await page.locator('[data-style=code]').click();
        const code='const value = "<script> & **literal**";\nconsole.log(value);';
        await page.keyboard.insertText(code);
        assert.equal(await page.locator('[contenteditable] pre code').textContent(),code);
        const markdown=await page.locator('textarea').inputValue();
        const reloaded=await open(markdown);
        try{assert.equal(await reloaded.locator('[contenteditable] pre code').textContent(),code);}finally{await reloaded.close();}
        const listPage=await open('- First\n- Second');
        try{assert.equal(await listPage.locator('[contenteditable] li').count(),2);}finally{await listPage.close();}
    }finally{await page.close();}
});
test('legacy plain text remains literal and empty submissions are blocked',async()=>{
    const page=await open('**literal** <script>text</script>','plain');
    try {
        assert.equal(await page.locator('[contenteditable]').textContent(),'**literal** <script>text</script>');
        assert.equal(await page.locator('[contenteditable] strong').count(),0);
        await page.locator('[contenteditable]').fill('');
        await page.locator('[type=submit]').click();
        assert.equal(await page.locator('[contenteditable]').getAttribute('aria-invalid'),'true');
        assert.match(await page.locator('[role=status]').textContent(),/入力してください/);
    }finally{await page.close();}
});

test('multiple selected paragraphs become one continuous code block',async()=>{
    const page=await open('first line\n\nsecond line\n\nthird line');
    try {
        await page.locator('[contenteditable]').click();
        await page.keyboard.press('ControlOrMeta+a');
        await page.locator('[data-style=code]').click();
        assert.equal(await page.locator('[contenteditable] pre').count(),1);
        assert.equal(await page.locator('[contenteditable] pre code').textContent(),'first line\nsecond line\nthird line');
        const reloaded=await open(await page.locator('textarea').inputValue());
        try { assert.equal(await reloaded.locator('[contenteditable] pre').count(),1); }finally{await reloaded.close();}
        await page.locator('[data-style=undo]').click();
        assert.equal(await page.locator('[contenteditable] pre').count(),0);
    }finally{await page.close();}
});

test('blank lines stay inside code and adjacent saved blocks are combined',async()=>{
    const page=await open('```\none\n```\n\n```\ntwo\n```');
    try {
        assert.equal(await page.locator('[contenteditable] pre').count(),1);
        assert.equal(await page.locator('[contenteditable] pre code').textContent(),'one\ntwo');
        await page.locator('[contenteditable] pre code').click();
        await page.locator('[contenteditable] pre code').evaluate(node => { const selection=window.getSelection(); selection.selectAllChildren(node); selection.collapseToEnd(); });
        await page.keyboard.press('Enter');
        await page.keyboard.press('Enter');
        await page.keyboard.press('Enter');
        await page.keyboard.insertText('three');
        assert.equal(await page.locator('[contenteditable] pre').count(),1);
        assert.equal(await page.locator('[contenteditable] pre code').textContent(),'one\ntwo\n\n\nthree');
        const separate=await open('```\none\n```\n\n説明文\n\n```\ntwo\n```');
        try { assert.equal(await separate.locator('[contenteditable] pre').count(),2); }finally{await separate.close();}
    }finally{await page.close();}
});
