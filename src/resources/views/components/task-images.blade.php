@props(['paths' => []])
<div class="task-image-picker" data-existing-count="{{ count($paths) }}">
    @if(count($paths))<div class="task-image-grid">@foreach($paths as $path)<label><img src="{{ Storage::disk('public')->url($path) }}" alt="登録済みの参考画像 {{ $loop->iteration }}"><span><input type="checkbox" name="remove_images[]" value="{{ $path }}" @checked(in_array($path, old('remove_images', [])))> この画像を削除</span></label>@endforeach</div>@endif
    <label for="images">参考画像を追加（任意）</label>
    <p>合計10枚まで・各2MB以内。JPEG / PNG / GIF / WebP。複数選択できます。選び直すと、選択済みの画像に追加されます。</p>
    <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/gif,image/webp" multiple>
    <div class="task-image-grid" data-image-previews aria-live="polite"></div>
    <p data-image-status role="status"></p>
</div>
<style>.task-image-picker{padding:20px;border:1px dashed #cadcd1;border-radius:16px;background:#fafcfb}.task-image-picker>label{font-size:13px;font-weight:600;color:#536c60}.task-image-picker p{font-size:12px;color:#84968b;margin:8px 0}.task-image-picker>input{max-width:100%;font-size:12px}.task-image-picker>input::file-selector-button{padding:10px 16px;border:0;border-radius:10px;background:#e6f0ea;color:#4b7a60;cursor:pointer;margin-right:12px}.task-image-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:12px;margin-top:14px}.task-image-grid img{width:100%;height:110px;object-fit:contain;background:#fff;border:1px solid #e3eae5;border-radius:10px}.task-image-grid span{font-size:11px;color:#798b80;overflow-wrap:anywhere;display:block;margin:6px 0}.task-image-remove{padding:5px 9px;border:0;border-radius:7px;background:#f5ecee;color:#a87883;font-size:11px;cursor:pointer}.task-image-remove:hover{background:#f0dfe4}.task-image-remove:focus-visible{outline:2px solid #a87883;outline-offset:2px}</style>
<script>
document.querySelectorAll('.task-image-picker').forEach(picker => {
    if (picker.dataset.initialized) return;
    picker.dataset.initialized = 'true';
    const input = picker.querySelector('input[type=file]');
    const previews = picker.querySelector('[data-image-previews]');
    const status = picker.querySelector('[data-image-status]');
    const removals = [...picker.querySelectorAll('[name="remove_images[]"]')];
    const retainedCount = () => Number(picker.dataset.existingCount || 0) - removals.filter(checkbox => checkbox.checked).length;
    let files = [], urls = [];
    const key = file => [file.name, file.size, file.lastModified, file.type].join(':');
    function render(message = '') {
        const transfer = new DataTransfer();
        files.forEach(file => transfer.items.add(file));
        input.files = transfer.files;
        urls.forEach(url => URL.revokeObjectURL(url));
        urls = [];
        previews.replaceChildren();
        files.forEach((file, index) => {
            const item = document.createElement('div');
            const name = document.createElement('span');
            name.textContent = file.name;
            const img = document.createElement('img');
            img.alt = file.name;
            img.src = URL.createObjectURL(file);
            urls.push(img.src);
            const remove = document.createElement('button');
            remove.type = 'button';
            remove.className = 'task-image-remove';
            remove.textContent = '× 取り消す';
            remove.setAttribute('aria-label', file.name + 'の添付を取り消す');
            remove.addEventListener('click', () => { files.splice(index, 1); render(); });
            item.append(img, name, remove);
            previews.append(item);
        });
        const overLimit = retainedCount() + files.length > 10;
        input.setCustomValidity(overLimit ? '画像は登録済みのものと合わせて10枚までです。' : '');
        status.textContent = [message, overLimit ? '画像は合計10枚までです。不要な画像を削除してください。' : '', '追加する画像：' + files.length + '枚 / 登録済み：' + retainedCount() + '枚'].filter(Boolean).join(' ');
    }
    input.addEventListener('change', () => {
        const messages = [];
        for (const file of [...input.files]) {
            if (files.some(existing => key(existing) === key(file))) continue;
            if (!/\.(jpe?g|png|gif|webp)$/i.test(file.name) || (file.type && !['image/jpeg','image/png','image/gif','image/webp'].includes(file.type))) {
                messages.push(file.name + '：JPEG・PNG・GIF・WebPを選択してください。'); continue;
            }
            if (file.size > 2 * 1024 * 1024) { messages.push(file.name + '：2MBを超えています。'); continue; }
            if (retainedCount() + files.length >= 10) { messages.push('画像は合計10枚までです。'); continue; }
            files.push(file);
        }
        render([...new Set(messages)].join(' '));
    });
    removals.forEach(checkbox => checkbox.addEventListener('change', () => render()));
    picker.closest('form')?.addEventListener('reset', () => { files = []; setTimeout(() => render(), 0); });
    render();
});
</script>
