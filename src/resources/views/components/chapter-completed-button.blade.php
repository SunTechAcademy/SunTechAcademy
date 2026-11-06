<button type="submit" class="chapter-completed-button" aria-label="このチャプターの完了を取り消す">
    <span class="chapter-completed-label" aria-hidden="true">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
        <span>このチャプターを完了しました</span>
    </span>
    <span class="chapter-undo-label" aria-hidden="true">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        <span>完了を取り消す</span>
    </span>
</button>

@once
<style>
    .chapter-completed-button { display: inline-grid; max-width: 100%; padding: 12px 24px; border: 1px solid #c7cce4; border-radius: 9999px; background: #eef0fa; color: #4a5180; font-weight: 700; line-height: 1.5; cursor: pointer; transition: background-color .2s, border-color .2s, color .2s; }
    .chapter-completed-button > span { grid-area: 1 / 1; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .chapter-completed-button svg { flex-shrink: 0; }
    .chapter-undo-label { visibility: hidden; }
    .chapter-completed-button:hover, .chapter-completed-button:focus-visible { background: #fff1f2; border-color: #fecdd3; color: #9f1239; }
    .chapter-completed-button:focus-visible { outline: 2px solid #6a73a6; outline-offset: 3px; }
    .chapter-completed-button:hover .chapter-completed-label, .chapter-completed-button:focus-visible .chapter-completed-label { visibility: hidden; }
    .chapter-completed-button:hover .chapter-undo-label, .chapter-completed-button:focus-visible .chapter-undo-label { visibility: visible; }
</style>
@endonce
