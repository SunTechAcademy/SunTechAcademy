import { test, before, after } from 'node:test';
import assert from 'node:assert/strict';
import { chromium } from '@playwright/test';
import { readFileSync, existsSync } from 'node:fs';
const source = readFileSync(new URL('../../resources/views/components/task-images.blade.php',import.meta.url),'utf8').split('<script>')[1].split('</script>')[0];
let browser;
before(async()=>{const chrome='/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';browser=await chromium.launch({headless:true,...(existsSync(chrome)?{executablePath:chrome}:{})});});
after(async()=>{await browser?.close();});
const file = name => ({name,mimeType:'image/png',buffer:Buffer.from('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII=','base64')});
async function open(existing=0){
 const page=await browser.newPage();
 await page.setContent(`<form><div class="task-image-picker" data-existing-count="${existing}">${Array.from({length:existing},(_,i)=>`<input type="checkbox" name="remove_images[]" value="${i}">`).join('')}<input type="file" name="images[]" multiple><div data-image-previews></div><p data-image-status></p></div></form>`);
 await page.addScriptTag({content:source});
 return page;
}
async function submitted(page){return page.locator('form').evaluate(form=>new FormData(form).getAll('images[]').filter(file=>file.size).map(file=>file.name));}
test('separate selections accumulate in multipart submission and can be individually removed',async()=>{
 const page=await open();
 try{
  const input=page.locator('input[type=file]');
  await input.setInputFiles(file('one.png'));
  await input.setInputFiles([file('two.png'),file('three.png')]);
  assert.deepEqual(await submitted(page),['one.png','two.png','three.png']);
  assert.equal(await page.locator('[data-image-previews] img').count(),3);
  await page.getByRole('button',{name:'two.pngの添付を取り消す'}).click();
  assert.deepEqual(await submitted(page),['one.png','three.png']);
  await input.setInputFiles([]);
  assert.deepEqual(await submitted(page),['one.png','three.png']);
  await input.setInputFiles(file('four.png'));
  assert.deepEqual(await submitted(page),['one.png','three.png','four.png']);
 }finally{await page.close();}
});
test('limits account for existing images and reject unsupported and oversized files',async()=>{
 const page=await open(9);
 try{
  const input=page.locator('input[type=file]');
  await input.setInputFiles([file('one.png'),file('two.png')]);
  assert.deepEqual(await submitted(page),['one.png']);
  assert.match(await page.locator('[data-image-status]').textContent(),/10枚まで/);
  await page.locator('[name="remove_images[]"]').first().check();
  await input.setInputFiles(file('two.png'));
  assert.deepEqual(await submitted(page),['one.png','two.png']);
  await page.locator('[name="remove_images[]"]').first().uncheck();
  assert.equal(await input.evaluate(el=>el.checkValidity()),false);
  await page.getByRole('button',{name:'two.pngの添付を取り消す'}).click();
  assert.equal(await input.evaluate(el=>el.checkValidity()),true);
  await input.setInputFiles({name:'huge.png',mimeType:'image/png',buffer:Buffer.alloc(2*1024*1024+1)});
  assert.match(await page.locator('[data-image-status]').textContent(),/2MBを超え/);
  await input.setInputFiles({name:'unsafe.svg',mimeType:'image/svg+xml',buffer:Buffer.from('<svg/>')});
  assert.deepEqual(await submitted(page),['one.png']);
 }finally{await page.close();}
});
