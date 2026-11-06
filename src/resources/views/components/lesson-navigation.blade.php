@props(['lesson', 'completedChapterIds' => []])

@php
    $chapterTotal = $lesson->chapters->count();
    $chapterDone = $lesson->chapters->whereIn('id', $completedChapterIds)->count();
@endphp
<div class="lesson-intro">
    <div><p class="lesson-kicker">LESSON {{ str_pad($lesson->sort_order, 2, '0', STR_PAD_LEFT) }} / YOUR NEXT STEP</p><h1>{{ $lesson->title }}</h1><p class="lesson-intro-copy">ひとつずつ理解して、確かな力に。あなたのペースで進めましょう。</p></div>
    <div class="lesson-progress-card"><p>このLessonの進捗 <strong>{{ $chapterDone }} / {{ $chapterTotal }}</strong></p><progress max="{{ max(1, $chapterTotal) }}" value="{{ $chapterDone }}" aria-label="完了Chapter数"></progress><span>{{ $chapterTotal > 0 && $chapterDone === $chapterTotal ? '✓ 全Chapterを達成しました' : 'Chapterを完了すると進捗が更新されます' }}</span></div>
</div>
<div class="lesson-layout" data-lesson-navigation>
    @if($lesson->chapters->isNotEmpty())
        <aside class="lesson-toc" aria-label="レッスンの目次">
            <details class="lesson-toc-panel" open>
                <summary class="lesson-toc-heading">
                    <span>このレッスンの目次</span>
                    <span class="lesson-toc-current" data-current-chapter>Chapter {{ $lesson->chapters->first()->sort_order }}</span>
                </summary>
                <nav class="lesson-toc-links" aria-label="Chapter一覧">
                    @foreach($lesson->chapters as $chapter)
                        <a class="lesson-toc-link" href="#chapter-{{ $chapter->id }}" data-chapter-label="Chapter {{ $chapter->sort_order }}">
                            <span class="lesson-toc-number">
                                <span>Chapter {{ $chapter->sort_order }}</span>
                                @if(in_array($chapter->id, $completedChapterIds))
                                    <span class="lesson-toc-completed"><span aria-hidden="true">✓</span> 完了</span>
                                @endif
                            </span>
                            <span>{{ $chapter->title }}</span>
                        </a>
                    @endforeach
                </nav>
            </details>
        </aside>
    @endif
    <div class="lesson-content">{{ $slot }}</div>
</div>

<x-chapter-celebration :lesson="$lesson" />

@once
<style>
    .lesson-page { background: #f7f8fc; padding: 36px 0 64px; color: #3e4860; }
    .lesson-breadcrumb { display: flex; align-items: center; gap: 12px; font-size: 12px; color: #959caf; flex-wrap: wrap; }
    .lesson-breadcrumb a { color: #727eab; }
    .lesson-breadcrumb a:hover { color: #4f5e96; }
    .lesson-intro { max-width: 1280px; margin: 0 auto 32px; padding: 0 32px; display: flex; align-items: center; justify-content: space-between; gap: 32px; }
    .lesson-intro > div:first-child { min-width: 0; }
    .lesson-kicker { color: #8590b8; font-size: 10px; font-weight: 800; letter-spacing: .15em; margin-bottom: 12px; }
    .lesson-intro h1 { font-size: clamp(23px, 2.5vw, 32px); line-height: 1.6; letter-spacing: -.035em; font-weight: 700; overflow-wrap: anywhere; }
    .lesson-intro-copy { font-size: 12px; color: #8a93a6; line-height: 1.9; margin-top: 10px; }
    .lesson-progress-card { width: 260px; flex-shrink: 0; padding: 20px; border: 1px solid #e5e8f2; border-radius: 16px; background: white; }
    .lesson-progress-card p { display: flex; justify-content: space-between; gap: 12px; color: #8992a6; font-size: 11px; }
    .lesson-progress-card strong { color: #6573aa; }
    .lesson-progress-card > span { display: block; font-size: 10px; color: #929caf; margin-top: 10px; }
    .lesson-progress-card progress { display: block; width: 100%; height: 6px; border: 0; border-radius: 99px; overflow: hidden; background: #eceff7; margin-top: 12px; }
    .lesson-progress-card progress::-webkit-progress-bar { background: #eceff7; }
    .lesson-progress-card progress::-webkit-progress-value { background: #8692c1; border-radius: 99px; }
    .lesson-progress-card progress::-moz-progress-bar { background: #8692c1; }
    .lesson-chapter { background: white; border: 1px solid #e4e8f1; border-radius: 22px; overflow: hidden; margin-bottom: 28px; box-shadow: 0 8px 28px #343b6504; }
    .lesson-chapter-body { padding: 36px; }
    .lesson-chapter-heading { display: flex; align-items: start; flex-direction: column; gap: 14px; padding-bottom: 24px; margin-bottom: 28px; border-bottom: 1px solid #eef0f6; }
    .lesson-chapter-badge { padding: 6px 10px; border-radius: 8px; color: #7581b1; background: #eff2fa; font-size: 10px; font-weight: 700; letter-spacing: .04em; }
    .lesson-chapter-title { font-size: 23px; line-height: 1.6; letter-spacing: -.025em; font-weight: 700; color: #404b65; overflow-wrap: anywhere; }
    .lesson-prose { color: #56627a; font-size: 15px; line-height: 2; overflow-wrap: anywhere; }
    .lesson-prose :where(p, ul, ol, pre, blockquote, table, figure) { margin-bottom: 1.4em; }
    .lesson-prose :where(h1, h2, h3, h4) { color: #3f4d68; font-weight: 700; line-height: 1.6; margin-top: 1.8em; margin-bottom: .8em; }
    .lesson-prose :where(h1, h2) { font-size: 1.3em; }
    .lesson-prose :where(h3, h4) { font-size: 1.1em; }
    .lesson-prose :where(ul, ol) { padding-left: 1.5em; }
    .lesson-prose ul { list-style: disc; }
    .lesson-prose ol { list-style: decimal; }
    .lesson-prose li { margin: .35em 0; }
    .lesson-prose a { color: #6478b3; text-decoration: underline; text-underline-offset: 3px; }
    .lesson-prose pre { max-width: 100%; overflow-x: auto; padding: 20px; border-radius: 12px; background: #252e43; color: #e2e8f5; font-size: 13px; line-height: 1.8; }
    .lesson-prose :not(pre) > code { padding: 2px 5px; border-radius: 4px; background: #f0f2f9; color: #6879ad; font-size: .9em; }
    .lesson-prose img { max-width: 100%; height: auto; border-radius: 10px; margin: 20px auto; }
    .lesson-prose table { display: block; max-width: 100%; overflow-x: auto; border-collapse: collapse; font-size: 13px; }
    .lesson-prose th, .lesson-prose td { padding: 12px; border: 1px solid #e5e9f2; }
    .lesson-prose th { background: #f2f4fa; text-align: left; }
    .lesson-prose blockquote { border-left: 3px solid #acb6d7; padding: 12px 18px; background: #f6f7fb; border-radius: 0 10px 10px 0; }
    .lesson-chapter-actions { display: flex; justify-content: center; padding: 24px; background: #fafbfe; border-top: 1px solid #edf0f6; }
    .lesson-complete-action, .lesson-next-action { display: inline-flex; justify-content: center; align-items: center; gap: 12px; border-radius: 12px; padding: 14px 24px; background: linear-gradient(120deg, #7b87ba, #6472a8); color: white; font-size: 13px; font-weight: 700; box-shadow: 0 4px 12px #626ba81a; transition: box-shadow .2s, transform .2s; }
    .lesson-complete-action:hover, .lesson-next-action:hover { transform: translateY(-1px); box-shadow: 0 7px 18px #626ba830; }
    .lesson-finish { text-align: center; padding: 36px 24px; border: 1px solid #e5e9f2; border-radius: 22px; background: linear-gradient(135deg, #eef1fa, #fafbff); }
    .lesson-finish > div > :first-child { background: #e3e9f8; color: #7585b3; }
    .lesson-finish p { color: #65738e; font-size: 13px; line-height: 1.9; }
    .lesson-finish p:first-of-type { font-size: 18px; font-weight: 700; color: #465674; }
    .lesson-content button:focus-visible, .lesson-content a:focus-visible, .lesson-breadcrumb a:focus-visible { outline: 3px solid #aeb9df; outline-offset: 4px; }
    @media (max-width: 700px) { .lesson-intro { padding: 0 16px; flex-direction: column; align-items: stretch; gap: 20px; } .lesson-progress-card { width: 100%; } .lesson-chapter-body { padding: 24px 20px; } .lesson-chapter-title { font-size: 20px; } .lesson-prose { font-size: 14px; } .lesson-chapter-actions { padding: 20px 16px; } .lesson-finish { padding: 28px 20px; } }
    @media (prefers-reduced-motion: reduce) { .lesson-complete-action, .lesson-next-action { transition: none; } .lesson-complete-action:hover, .lesson-next-action:hover { transform: none; } }

    .lesson-layout { max-width: 1280px; margin: 0 auto; padding: 0 16px; display: grid; gap: 24px; align-items: start; }
    .lesson-content { min-width: 0; }
    .lesson-content [id^="chapter-"] { scroll-margin-top: 104px; }
    .lesson-toc { position: sticky; top: 12px; z-index: 20; min-width: 0; }
    .lesson-toc-panel { background: white; border: 1px solid #e5e7eb; border-radius: 20px; box-shadow: 0 6px 24px #343b6505; overflow: hidden; }
    .lesson-toc-heading { padding: 20px; cursor: pointer; color: #374151; font-weight: 700; font-size: 14px; }
    .lesson-toc-current { display: block; margin-top: 4px; color: #6a73a6; font-size: 12px; }
    .lesson-toc-links { max-height: min(50vh, 420px); overflow-y: auto; overscroll-behavior: contain; padding: 4px 8px 12px; }
    .lesson-toc-link { display: block; padding: 10px 12px; border-left: 3px solid transparent; border-radius: 6px; color: #4b5563; font-size: 13px; overflow-wrap: anywhere; }
    .lesson-toc-link:hover { background: #f3f4f6; }
    .lesson-toc-link:focus-visible { outline: 2px solid #6a73a6; outline-offset: -2px; }
    .lesson-toc-link[aria-current="location"] { background: #eef0fa; border-left-color: #6a73a6; color: #434d84; font-weight: 700; }
    .lesson-toc-number { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 3px; font-size: 11px; }
    .lesson-toc-completed { flex-shrink: 0; padding: 2px 7px; border-radius: 9999px; background: #eef0fa; color: #4a5180; border: 1px solid #c7cce4; font-weight: 700; }
    @media (min-width: 1024px) {
        .lesson-layout { grid-template-columns: minmax(0, 1fr) 260px; gap: 32px; padding: 0 32px; }
        .lesson-content { grid-column: 1; grid-row: 1; }
        .lesson-toc { grid-column: 2; grid-row: 1; top: 24px; }
        .lesson-toc-links { max-height: calc(100vh - 160px); max-height: calc(100dvh - 160px); }
        .lesson-content [id^="chapter-"] { scroll-margin-top: 24px; }
    }
</style>
<script>
(() => {
    const root = document.querySelector('[data-lesson-navigation]');
    const panel = root.querySelector('.lesson-toc-panel');
    if (!panel) return;
    const desktop = window.matchMedia('(min-width: 1024px)');
    const links = [...root.querySelectorAll('.lesson-toc-link')];
    const chapters = links.map(link => document.getElementById(link.hash.slice(1)));
    const list = root.querySelector('.lesson-toc-links');
    const label = root.querySelector('[data-current-chapter]');
    let active = -1;
    let scheduled = false;

    function update() {
        scheduled = false;
        const offset = desktop.matches ? 32 : 112;
        let current = 0;
        chapters.forEach((chapter, index) => {
            if (chapter && chapter.getBoundingClientRect().top <= offset) current = index;
        });
        if (current === active) return;
        active = current;
        links.forEach((link, index) => {
            if (index === current) link.setAttribute('aria-current', 'location');
            else link.removeAttribute('aria-current');
        });
        label.textContent = '現在：' + links[current].dataset.chapterLabel;
        if (panel.open) {
            const itemRect = links[current].getBoundingClientRect();
            const listRect = list.getBoundingClientRect();
            if (itemRect.top < listRect.top || itemRect.bottom > listRect.bottom) {
                list.scrollTop += itemRect.top - listRect.top - list.clientHeight / 2 + itemRect.height / 2;
            }
        }
    }
    function scheduleUpdate() {
        if (!scheduled) { scheduled = true; requestAnimationFrame(update); }
    }
    function setLayout() { panel.open = desktop.matches; scheduleUpdate(); }
    links.forEach(link => link.addEventListener('click', () => {
        if (!desktop.matches) panel.open = false;
    }));
    window.addEventListener('scroll', scheduleUpdate, { passive: true });
    window.addEventListener('resize', scheduleUpdate);
    window.addEventListener('hashchange', scheduleUpdate);
    window.addEventListener('load', scheduleUpdate);
    desktop.addEventListener('change', setLayout);
    new ResizeObserver(scheduleUpdate).observe(root.querySelector('.lesson-content'));
    setLayout();
})();
</script>
@endonce
