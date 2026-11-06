<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">初級 · エンジニア基礎</h2></x-slot>
    <x-course-page-styles />
    <div class="course-page"><div class="course-container">
        <div class="course-hero"><div><p class="course-eyebrow">STEP 01 / BUILD YOUR FOUNDATION</p><h1>ひとつずつ、「つくれる」自分へ。</h1><p class="course-muted">Chapterごとの小さな達成を、エンジニアとしての確かな土台に。</p></div></div>
        @if(session('error'))<p class="course-notice" role="alert">{{ session('error') }}</p>@endif
        @php
            $allChapters = $lessons->flatMap->chapters;
            $doneChapters = $allChapters->where('is_completed', true)->count();
            $doneLessons = $lessons->filter(fn ($item) => $item->chapters->isNotEmpty() && $item->chapters->every(fn ($chapter) => $chapter->is_completed))->count();
        @endphp
        <div class="beginner-layout">
        <div class="beginner-lessons">
        <h2 class="course-section-title">学習カリキュラム</h2>
        @forelse($lessons as $lesson)
            @php
                $done = $lesson->chapters->where('is_completed', true)->count();
            @endphp
            @php
                $isLessonComplete = $lesson->chapters->isNotEmpty() && $done === $lesson->chapters->count();
            @endphp
            <section class="lesson-card{{ $isLessonComplete ? ' lesson-card-completed' : '' }}">
                @if($isLessonComplete)
                    <div class="lesson-achievement">
                        <span class="lesson-achievement-badge"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m8 12 3 3 5-6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9"/></svg>全Chapter完了</span>
                        <span class="lesson-achievement-message"><span aria-hidden="true">✦</span> またひとつ、自分の力に。</span>
                    </div>
                @endif
                <div class="lesson-card-heading"><div><p class="course-eyebrow">LESSON {{ str_pad($lesson->sort_order, 2, '0', STR_PAD_LEFT) }}</p><h3>{{ $lesson->title }}</h3></div><div class="lesson-meta">目安 {{ $lesson->estimated_time / 60 }} 時間<strong>{{ $done }} / {{ $lesson->chapters->count() }} Chapter完了</strong></div></div>
                <div class="chapter-grid">
                    @forelse($lesson->chapters as $chapter)
                        <a href="{{ route('lessons.show', $lesson->id) }}#chapter-{{ $chapter->id }}" class="chapter-link"><span class="chapter-link-text"><small>CHAPTER {{ $chapter->sort_order }}</small>{{ $chapter->title }}</span><span class="chapter-state {{ $chapter->is_completed ? 'done' : '' }}">{{ $chapter->is_completed ? '✓ 完了' : '→' }}</span></a>
                    @empty<p class="course-muted">Chapterを準備しています。</p>@endforelse
                </div>
            </section>
        @empty<p class="course-muted">カリキュラムを準備しています。</p>@endforelse
        </div>
        <aside class="beginner-sidebar" tabindex="0" aria-label="学習状況とログイン履歴">
        @php
            $allChaptersDone = $allChapters->isNotEmpty() && $doneChapters === $allChapters->count();
            $allLessonsDone = $lessons->isNotEmpty() && $doneLessons === $lessons->count();
        @endphp
        <div class="course-stats">
            <div class="course-stat{{ $allChaptersDone && $progress >= 100 ? ' course-stat-achieved' : '' }}">@if($allChaptersDone && $progress >= 100)<span class="stat-achievement">✦ 100％達成</span>@endif<p>カリキュラム進捗</p><strong>{{ number_format($progress, 1) }}</strong><small>%</small><progress class="course-progress" value="{{ $progress }}" max="100" aria-label="カリキュラム進捗"></progress></div>
            <div class="course-stat{{ $allChaptersDone ? ' course-stat-achieved' : '' }}">@if($allChaptersDone)<span class="stat-achievement">✓ 全Chapter完了</span>@endif<p>完了Chapter</p><strong>{{ $doneChapters }}</strong><small>/ {{ $allChapters->count() }}</small></div>
            <div class="course-stat{{ $allLessonsDone ? ' course-stat-achieved' : '' }}">@if($allLessonsDone)<span class="stat-achievement">✓ 全Lesson完了</span>@endif<p>完了Lesson</p><strong>{{ $doneLessons }}</strong><small>/ {{ $lessons->count() }}</small></div>
        </div>
        <x-learning-activity />
        </aside>
        </div>
    </div></div>
</x-app-layout>
