@props(['value' => '', 'format' => 'markdown'])
<div class="task-editor" data-task-editor>
    <input type="hidden" name="description_format" value="{{ old('description_format', $format) }}">
    <div class="task-editor-toolbar" role="group" aria-label="本文の書式設定">
        <button type="button" data-style="bold" aria-pressed="false" title="太字（⌘/Ctrl+B）" disabled><strong>B</strong><span>太字</span></button>
        <button type="button" data-style="italic" aria-pressed="false" title="斜体（⌘/Ctrl+I）" disabled><em>斜体</em></button>
        <button type="button" data-style="list" aria-pressed="false" disabled>• 箇条書き</button>
        <button type="button" data-style="ordered" aria-pressed="false" disabled>1. 番号付き</button>
        <button type="button" data-style="quote" aria-pressed="false" disabled>引用</button>
        <button type="button" data-style="inline" aria-pressed="false" disabled>&lt;/&gt; コード</button>
        <button type="button" data-style="code" aria-pressed="false" disabled>コードブロック</button>
        <button type="button" data-style="undo" aria-label="元に戻す" title="元に戻す" disabled>↶</button>
        <button type="button" data-style="redo" aria-label="やり直す" title="やり直す" disabled>↷</button>
    </div>
    <textarea id="description" name="description" rows="10" required aria-label="詳細・完了条件">{{ old('description', $value) }}</textarea>
    <div data-editor-surface hidden></div>
    <p class="task-editor-help" role="status">文字を選んで書式を変更できます。コードブロックの後は ↓ キーで次の段落に移れます。</p>
</div>
@once
<x-task-content-styles />
<style>
.task-editor-toolbar button:disabled{opacity:.4;cursor:not-allowed}.task-writing-surface{min-height:280px;max-height:65vh;overflow-y:auto;padding:20px;outline:none;white-space:pre-wrap}.task-writing-surface:has(>p:only-child>br:only-child)::before{content:attr(data-placeholder);color:#9aa99f;pointer-events:none;position:absolute;font-size:13px}.task-writing-surface p,.task-field .task-writing-surface p{margin:0 0 10px;font-size:14px;color:inherit;line-height:1.9}.task-writing-surface strong{font-weight:700}.task-writing-surface em{font-style:italic}.task-writing-surface pre{tab-size:4}.task-writing-surface .ProseMirror-selectednode{outline:2px solid #91b5a4}.task-writing-surface[aria-invalid=true]{box-shadow:inset 0 0 0 2px #c67a85}.task-editor-toolbar{position:relative;z-index:1}
</style>
@vite('resources/js/task-editor.js')
@endonce
