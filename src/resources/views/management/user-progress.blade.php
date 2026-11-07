<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">受講者の学習状況</h2></x-slot>
    <x-course-page-styles />
    <div class="course-page"><div class="course-container">
        <a href="{{ route('management.users') }}" class="progress-back">← 受講者一覧へ</a>
        <div class="course-hero"><div><p class="course-eyebrow">LEARNER PROGRESS</p><h1>{{ $user->name }}さんの学習状況</h1><p class="course-muted">{{ $user->email }} · {{ ['student'=>'一般受講生','admin'=>'管理者','super_admin'=>'最高管理者'][$user->role] ?? '未設定' }}</p></div><span class="learner-label">閲覧専用</span></div>
        <div class="course-stats">
            <div class="course-stat"><p>初級カリキュラム進捗</p><strong>{{ $progress }}</strong><small>％</small><progress class="course-progress" value="{{ $completedCount }}" max="{{ max(1, $totalChapters) }}" aria-label="初級カリキュラム進捗"></progress><p>{{ $completedCount }} / {{ $totalChapters }} Chapter · {{ $completedLessons }} / {{ $lessons->count() }} Lesson完了</p></div>
            <div class="course-stat"><p>中級の担当中タスク</p><strong>{{ $activeTasks }}</strong><small>件</small><p>完了タスク：{{ $completedTasks }}件</p><a class="progress-back" href="#learner-tasks">担当タスクを確認 →</a></div>
            <div class="course-stat"><p>最終ログイン日</p><strong style="font-size:22px">{{ $lastLogin ? \Carbon\Carbon::parse($lastLogin)->format('Y/m/d') : '記録なし' }}</strong><p>最終Chapter完了：{{ $lastCompletion ? \Carbon\Carbon::parse($lastCompletion)->format('Y/m/d') : '記録なし' }}</p></div>
        </div>
        <section class="learner-focus"><p class="course-eyebrow">NEXT STEP</p><h2>次の学習を一緒に確認</h2>
            @if($nextChapter)
                <p>学習順で次に未完了のChapter：<strong>{{ $nextChapter->title }}</strong></p>
                <a href="{{ route('lessons.show', $nextChapter->lesson_id) }}#chapter-{{ $nextChapter->id }}" class="progress-back">教材を開く →</a>
            @elseif($totalChapters > 0)
                <p>初級の全Chapterが完了しています。中級の担当タスクを確認し、次の実践につなげましょう。</p>
            @else
                <p>初級の教材はまだ登録されていません。</p>
            @endif
            <p class="course-muted">完了状況をもとにした表示です。実際に取り組んでいる内容や困っている点は、ご本人に確認してください。</p>
        </section>
        <h2 class="course-section-title">初級 · Lessonごとの進捗</h2>
        <div class="learner-lessons">
            @forelse($lessons as $lesson)
                @php $done = $lesson->chapters->filter(fn ($chapter) => $completedChapters->has($chapter->id))->count(); $total = $lesson->chapters->count(); @endphp
                <details class="learner-lesson">
                    <summary><span><small>LESSON {{ $lesson->sort_order }}</small><strong>{{ $lesson->title }}</strong></span><span class="learner-label {{ $total && $done === $total ? 'is-complete' : '' }}">{{ $total && $done === $total ? '✓ 完了' : ($done ? '学習中' : '未着手') }} · {{ $done }} / {{ $total }}</span></summary>
                    <ul>@forelse($lesson->chapters as $chapter)
                        @php $completion = $completedChapters->get($chapter->id); @endphp
                        <li><a href="{{ route('lessons.show', $lesson->id) }}#chapter-{{ $chapter->id }}">{{ $chapter->title }} <span aria-hidden="true">↗</span></a><span class="{{ $completion ? 'chapter-done' : '' }}">{{ $completion ? '✓ 完了' : '未完了' }} @if($completion?->pivot->completed_at)<small>{{ \Carbon\Carbon::parse($completion->pivot->completed_at)->format('Y/m/d') }}</small>@endif</span></li>
                    @empty<li>Chapterはまだ登録されていません。</li>@endforelse</ul>
                </details>
            @empty<p class="course-muted">Lessonはまだ登録されていません。</p>@endforelse
        </div>
        <h2 class="course-section-title">中級 · フェーズ別の実績</h2>
        <div class="learner-phases">@foreach($phases as $key => $label)
            @php $phaseCompleted = $taskCounts->where('phase', $key)->where('status','completed')->sum('total'); $phaseActive = $taskCounts->where('phase',$key)->where('status','assigned')->sum('total'); @endphp
            <div class="course-stat"><p>{{ $label }}</p><strong>{{ $phaseCompleted }}</strong><small>件完了</small><p>担当中 {{ $phaseActive }}件</p>@if(in_array($key, ['implementation','operation']))<progress class="course-progress" value="{{ min(15,$phaseCompleted) }}" max="15" aria-label="{{ $label }}の目標達成状況"></progress><p>達成目標 {{ $phaseCompleted }} / 15件</p>@endif</div>
        @endforeach</div>
        <section id="learner-tasks"><h2 class="course-section-title">担当タスク</h2><div class="learner-task-list">
            @forelse($tasks as $task)
                <a class="learner-task" href="{{ route('courses.intermediate.show_task', $task->id) }}"><div><small>{{ $phases[$task->phase] ?? $task->phase }}</small><strong>{{ $task->title }}</strong><p class="course-muted">@if($task->status === 'completed' && $task->pivot->completed_at)完了日：{{ \Carbon\Carbon::parse($task->pivot->completed_at)->format('Y/m/d') }}@else担当登録日：{{ $task->pivot->created_at?->format('Y/m/d') ?? '記録なし' }}@endif</p></div><span class="learner-label {{ $task->status === 'completed' ? 'is-complete' : '' }}">{{ ['assigned'=>'担当中','completed'=>'✓ 完了','incomplete'=>'未対応'][$task->status] ?? $task->status }} →</span></a>
            @empty<p class="course-muted" style="padding:24px">担当タスクはまだありません。</p>@endforelse
        </div><div style="margin-top:20px">{{ $tasks->fragment('learner-tasks')->links() }}</div></section>
        <h2 class="course-section-title">{{ $user->name }}さんのログイン履歴</h2>
        <x-learning-activity :user="$user" />
    </div></div>
    <style>
        .progress-back{display:inline-block;color:#697daa;font-size:13px;font-weight:600;padding:8px 0}.progress-back:hover{text-decoration:underline}.course-hero{margin-top:22px}.course-hero h1,.course-hero .course-muted{overflow-wrap:anywhere}.learner-label{display:inline-block;padding:8px 12px;border-radius:10px;background:#eff2f9;color:#7181a8;font-size:12px;white-space:nowrap}.learner-label.is-complete{background:linear-gradient(110deg,#e8f6f1,#eaeefa,#f4ebfa);color:#5e8b7b}.learner-focus{padding:26px 30px;border-radius:20px;background:linear-gradient(110deg,#eef2fb,#f0f7f4);line-height:1.9}.learner-focus h2{font-size:18px;font-weight:700;color:#526781;margin-bottom:12px}.learner-focus>p:not(.course-eyebrow){font-size:13px}.learner-lessons{display:grid;gap:12px}.learner-lesson{background:white;border:1px solid #e7ebf2;border-radius:16px;overflow:hidden}.learner-lesson summary{padding:20px 24px;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:16px}.learner-lesson summary small,.learner-task small{display:block;color:#91a0b4;font-size:11px;margin-bottom:6px}.learner-lesson summary strong,.learner-task strong{display:block;color:#56657c;font-size:14px}.learner-lesson ul{padding:0 24px 16px}.learner-lesson li{display:flex;justify-content:space-between;align-items:center;gap:16px;border-top:1px solid #f0f2f6;padding:14px 0;font-size:12px;color:#8d99ab}.learner-lesson li>a{color:#657995}.learner-lesson li>span{flex-shrink:0}.learner-lesson li small{display:block;font-size:10px}.chapter-done{color:#6a9b83}.learner-phases{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px}.learner-task-list{background:white;border:1px solid #e7ebf2;border-radius:18px;overflow:hidden}.learner-task{display:flex;justify-content:space-between;align-items:center;gap:20px;padding:20px 24px;border-bottom:1px solid #eef1f5}.learner-task:last-child{border:0}.learner-task:hover{background:#f9fbfd}.learner-task .course-muted{font-size:11px;margin-top:6px}.learner-task strong{overflow-wrap:anywhere}.learner-lesson summary:focus-visible,.learner-task:focus-visible,.progress-back:focus-visible{outline:3px solid #adbede;outline-offset:-3px}@media(max-width:700px){.learner-phases{grid-template-columns:repeat(2,minmax(0,1fr))}.learner-lesson summary{align-items:flex-start;flex-direction:column}.course-stats{grid-template-columns:1fr}.learner-task{align-items:flex-start;flex-direction:column}.learner-focus{padding:22px}.learner-lesson li{align-items:flex-start}.learner-lesson li>a{overflow-wrap:anywhere;min-width:0}}@media(max-width:400px){.learner-phases{grid-template-columns:1fr}}
    </style>
</x-app-layout>
