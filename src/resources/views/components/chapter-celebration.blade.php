@props(['lesson'])
@php($celebration = session('chapterCelebration'))
@if($celebration && (int) $celebration['lesson_id'] === (int) $lesson->id)
    @php($isLessonComplete = $celebration['lesson_complete'])
    <dialog class="celebration {{ $isLessonComplete ? 'celebration-lesson' : '' }}" aria-labelledby="celebration-title" aria-describedby="celebration-message" data-celebration>
        <div class="celebration-card">
            <form method="dialog"><button class="celebration-close" aria-label="お祝いを閉じる">×</button></form>
            <div class="celebration-confetti" aria-hidden="true">
                @for($i = 0; $i < ($isLessonComplete ? 30 : 14); $i++)
                    <i style="--x: {{ ($i * 37) % 100 }}%; --delay: {{ ($i % 7) * 0.09 }}s; --turn: {{ $i * 41 }}deg; --color: {{ ['#a5a9e2', '#f8c878', '#f4a8bc', '#7bcbbd'][$i % 4] }}"></i>
                @endfor
            </div>
            <p class="celebration-eyebrow">{{ $isLessonComplete ? 'LESSON COMPLETE' : 'CHAPTER COMPLETE' }}</p>
            <div class="celebration-art" aria-hidden="true">
                <svg viewBox="0 0 280 220" width="280" height="220" fill="none">
                    <ellipse cx="140" cy="198" rx="65" ry="10" fill="#dcdff4"/>
                    <circle cx="140" cy="108" r="86" fill="{{ $isLessonComplete ? '#fff0cc' : '#ececfc' }}"/>
                    <g class="celebration-sparkles" fill="#eeb95f"><path d="m43 61 5 12 12 5-12 5-5 12-5-12-12-5 12-5Z"/><path d="m231 104 4 10 10 4-10 4-4 10-4-10-10-4 10-4Z"/><circle cx="218" cy="46" r="5"/></g>
                    <g class="celebration-mascot">
                        <path d="M94 140q-38-12-38-37M186 140q38-12 38-37" stroke="#7c83ba" stroke-width="16" stroke-linecap="round"/>
                        <rect x="102" y="139" width="76" height="48" rx="22" fill="#8d94ca"/>
                        <path d="M119 183v10m42-10v10" stroke="#626ca8" stroke-width="14" stroke-linecap="round"/>
                        <path d="M140 60V42" stroke="#8d94ca" stroke-width="6"/><circle cx="140" cy="37" r="9" fill="#f3bf69"/>
                        <rect x="76" y="64" width="128" height="92" rx="36" fill="#fff" stroke="#8d94ca" stroke-width="5"/>
                        <path d="M103 104q8-13 16 0m42 0q8-13 16 0" stroke="#505a91" stroke-width="5" stroke-linecap="round"/>
                        <ellipse cx="99" cy="119" rx="10" ry="6" fill="#f6bdca"/><ellipse cx="181" cy="119" rx="10" ry="6" fill="#f6bdca"/>
                        <path d="M129 119q11 14 22 0" stroke="#505a91" stroke-width="4" stroke-linecap="round"/>
                        <path d="m140 162 4 7 8 1-6 6 1 8-7-4-7 4 1-8-6-6 8-1Z" fill="#ffe2a1"/>
                        @if($isLessonComplete)
                            <path d="m112 65-5-24 20 10 13-22 13 22 20-10-5 24Z" fill="#f6c76d" stroke="#e7aa44" stroke-width="3" stroke-linejoin="round"/>
                        @endif
                    </g>
                </svg>
            </div>
            <h2 id="celebration-title">{{ $isLessonComplete ? 'すごい！すべてのChapterを達成！' : 'おめでとうございます！' }}</h2>
            <p class="celebration-subtitle">{{ $isLessonComplete ? 'Lesson '.$celebration['lesson_number'] : 'Chapter '.$celebration['chapter_number'] }} が完了しました</p>
            <p id="celebration-message">{{ $isLessonComplete ? '一歩ずつ積み重ねた努力が、力になっています。最後までやりきったあなたに、大きな拍手！' : 'またひとつ、できることが増えましたね。今日の一歩を、自分でもほめてあげましょう！' }}</p>
            <div class="celebration-progress">
                <div><span>{{ $isLessonComplete ? '全Chapterクリア！' : 'このLessonの進み具合' }}</span><strong>{{ $celebration['completed'] }} / {{ $celebration['total'] }}</strong></div>
                <progress value="{{ $celebration['completed'] }}" max="{{ $celebration['total'] }}" aria-label="このLessonの完了Chapter数"></progress>
            </div>
            <form method="dialog"><button class="celebration-continue" autofocus>{{ $isLessonComplete ? 'やったね！学習に戻る' : 'いい調子！学習を続ける' }} <span aria-hidden="true">→</span></button></form>
        </div>
    </dialog>
    <style>
        .celebration { padding: 0; border: 1px solid #ffffffaa; border-radius: 28px; width: min(480px, calc(100vw - 32px)); max-height: calc(100dvh - 32px); background: #fafaff; color: #343b62; box-shadow: 0 28px 90px #24254a40; }
        .celebration[open] { animation: celebration-enter .45s cubic-bezier(.2,.8,.2,1) both; }
        .celebration::backdrop { background: #20243c66; backdrop-filter: blur(6px); }
        .celebration-card { position: relative; overflow: hidden; padding: 32px; text-align: center; background: radial-gradient(ellipse at top, #eeedff, transparent 65%); }
        .celebration-lesson .celebration-card { background: radial-gradient(ellipse at top, #fff0ce, #fafaff 70%); }
        .celebration-close { position: absolute; top: 10px; right: 14px; width: 36px; height: 36px; border-radius: 50%; color: #68708e; font-size: 26px; z-index: 2; }
        .celebration-close:hover { background: #e9eaf4; }
        .celebration-eyebrow { font-size: 11px; letter-spacing: .2em; font-weight: 800; color: #747cae; }
        .celebration-art svg { display: block; width: 230px; height: auto; max-width: 100%; margin: 0 auto; }
        .celebration-mascot { transform-origin: 140px 190px; animation: celebration-bounce .85s ease-in-out 3; }
        .celebration-lesson .celebration-mascot { animation-iteration-count: 5; }
        .celebration-sparkles { transform-origin: center; animation: celebration-sparkle 1s ease-in-out 3; }
        .celebration h2 { font-size: clamp(20px, 5vw, 25px); line-height: 1.5; font-weight: 800; margin: 4px 0 8px; }
        .celebration-subtitle { font-size: 16px; font-weight: 700; color: #626ca8; }
        #celebration-message { font-size: 14px; line-height: 1.9; color: #71758a; margin-top: 16px; }
        .celebration-progress { margin: 22px 0; text-align: left; }
        .celebration-progress div { display: flex; justify-content: space-between; font-size: 12px; color: #71758a; margin-bottom: 8px; }
        .celebration-progress progress { display: block; width: 100%; height: 8px; border: 0; border-radius: 99px; overflow: hidden; background: #e7e8f2; }
        .celebration-progress progress::-webkit-progress-bar { background: #e7e8f2; }
        .celebration-progress progress::-webkit-progress-value { background: #8c92c8; border-radius: 99px; }
        .celebration-progress progress::-moz-progress-bar { background: #8c92c8; }
        .celebration-continue { width: 100%; padding: 14px 16px; border-radius: 14px; background: #6973ad; color: white; font-size: 14px; font-weight: 700; transition: background .2s; }
        .celebration-continue:hover { background: #505b95; }
        .celebration button:focus-visible { outline: 3px solid #b2b8e2; outline-offset: 3px; }
        .celebration-confetti { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
        .celebration-confetti i { position: absolute; top: -20px; left: var(--x); width: 7px; height: 12px; border-radius: 2px; background: var(--color); animation: celebration-fall 2.5s var(--delay) ease-out both; }
        .celebration-lesson .celebration-confetti i { animation-duration: 3.8s; }
        @keyframes celebration-enter { from { opacity: 0; transform: translateY(20px) scale(.96); } to { opacity: 1; transform: none; } }
        @keyframes celebration-bounce { 0%,100% { transform: translateY(0) rotate(-3deg); } 50% { transform: translateY(-10px) rotate(3deg); } }
        @keyframes celebration-sparkle { 50% { opacity: .4; transform: scale(.9); } }
        @keyframes celebration-fall { from { transform: translateY(0) rotate(0); opacity: 0; } 15% { opacity: 1; } to { transform: translateY(580px) rotate(var(--turn)); opacity: 0; } }
        @media (prefers-reduced-motion: reduce) { .celebration[open], .celebration * { animation: none !important; transition: none !important; } .celebration-confetti { display: none; } }
        @media (max-width: 480px) { .celebration-card { padding: 28px 20px 22px; } .celebration-art svg { width: 190px; } }
    </style>
    <script>
        (() => {
            const dialog = document.querySelector('[data-celebration]');
            const show = () => {
                const scrollY = window.scrollY;
                const previousOverflow = document.documentElement.style.overflow;
                dialog.showModal();
                document.documentElement.style.overflow = 'hidden';
                window.scrollTo(0, scrollY);
                dialog.addEventListener('close', () => {
                    document.documentElement.style.overflow = previousOverflow;
                    const chapter = document.getElementById(location.hash.slice(1));
                    chapter?.querySelector('button[type="submit"]')?.focus({ preventScroll: true });
                }, { once: true });
            };
            if (document.readyState === 'complete') show();
            else window.addEventListener('load', show, { once: true });
        })();
    </script>
@endif
