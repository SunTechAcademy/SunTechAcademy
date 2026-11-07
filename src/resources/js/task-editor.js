import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import { Markdown } from '@tiptap/markdown';
import { ContinuousCodeBlocks } from './task-code-blocks';

const commands = {
    bold: ['bold', chain => chain.toggleBold()],
    italic: ['italic', chain => chain.toggleItalic()],
    list: ['bulletList', chain => chain.toggleBulletList()],
    ordered: ['orderedList', chain => chain.toggleOrderedList()],
    quote: ['blockquote', chain => chain.toggleBlockquote()],
    inline: ['code', chain => chain.toggleCode()],
    code: ['codeBlock', chain => chain.toggleCodeBlock()],
    undo: [null, chain => chain.undo()],
    redo: [null, chain => chain.redo()],
};

// Plain legacy text is imported as text nodes, so literal symbols and HTML stay literal.
function plainDocument(value) {
    return { type: 'doc', content: [{ type: 'paragraph', content: value.split('\n').flatMap((line, index) => [
        ...(index ? [{ type: 'hardBreak' }] : []),
        ...(line ? [{ type: 'text', text: line }] : []),
    ]) }] };
}

export function mountTaskEditor(root) {
    const field = root.querySelector('textarea');
    const format = root.querySelector('[name=description_format]');
    const host = root.querySelector('[data-editor-surface]');
    const status = root.querySelector('[role=status]');
    const buttons = [...root.querySelectorAll('[data-style]')];
    let changed = false;
    const refreshToolbar = editor => {
        for (const button of buttons) {
            const [mark] = commands[button.dataset.style];
            if (mark) button.setAttribute('aria-pressed', String(editor.isActive(mark)));
            if (button.dataset.style === 'undo') button.disabled = !editor.can().undo();
            if (button.dataset.style === 'redo') button.disabled = !editor.can().redo();
        }
    };
    const editor = new Editor({
        element: host,
        extensions: [StarterKit.configure({ underline: false, link: { openOnClick: false }, codeBlock: { exitOnTripleEnter: false } }), Markdown, ContinuousCodeBlocks],
        content: format.value === 'markdown' ? field.value : plainDocument(field.value),
        ...(format.value === 'markdown' ? { contentType: 'markdown' } : {}),
        editorProps: {
            attributes: { class: 'task-rich-text task-writing-surface', role: 'textbox', 'aria-label': '詳細・完了条件', 'aria-multiline': 'true', 'aria-required': 'true', 'data-placeholder': '目的・作業内容・完了条件を入力してください。' },
        },
        onUpdate: ({ editor }) => {
            changed = true;
            field.value = editor.getMarkdown();
            format.value = 'markdown';
            editor.view.dom.removeAttribute('aria-invalid');
            status.textContent = '文字を選んで書式を変更できます。コードブロックの後は ↓ キーで次の段落に移れます。';
        },
        onTransaction: ({ editor }) => refreshToolbar(editor),
    });
    editor.view.dispatch(editor.state.tr.setMeta('normalizeTaskCodeBlocks', true));
    field.hidden = true;
    field.required = false;
    host.hidden = false;
    buttons.forEach(button => {
        button.disabled = false;
        button.addEventListener('mousedown', event => event.preventDefault());
        button.addEventListener('click', () => commands[button.dataset.style][1](editor.chain().focus()).run());
    });
    refreshToolbar(editor);
    root.closest('form').addEventListener('submit', event => {
        if (!editor.getText().trim()) {
            event.preventDefault();
            status.textContent = '取り組む内容を入力してください。';
            editor.view.dom.setAttribute('aria-invalid', 'true');
            editor.commands.focus();
            return;
        }
        // Preserve untouched legacy text and Markdown exactly as stored.
        if (changed) {
            field.value = editor.getMarkdown();
            format.value = 'markdown';
        }
    });
    return editor;
}

document.querySelectorAll('[data-task-editor]').forEach(root => {
    try { mountTaskEditor(root); }
    catch (error) {
        root.querySelector('[role=status]').textContent = 'エディターを読み込めませんでした。再読み込みしてください。本文は下の入力欄に保持されています。';
        console.error('Task editor could not be initialized', error);
    }
});
