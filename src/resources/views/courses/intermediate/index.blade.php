<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">中級 · 実務スキル</h2></x-slot>
    <x-course-page-styles />
    <div class="course-page is-intermediate"><div class="course-container">
        <div class="course-hero"><div><p class="course-eyebrow">STEP 02 / TURN SKILLS INTO IMPACT</p><h1>学んだ力を、現場の力に。</h1><p class="course-muted">設計から開発、運用まで。ひとつの実践が、次の自信につながります。</p></div><a href="{{ route('courses.intermediate.create') }}" class="course-button">＋ タスクを発行する</a></div>
        @if(session('success'))<p class="course-notice" role="status">{{ session('success') }}</p>@endif
        <div class="intermediate-layout">
        <div class="intermediate-main">
        <section class="assigned-tasks" id="assigned-tasks" aria-labelledby="assigned-tasks-title">
            <div class="assigned-tasks-heading">
                <div><p class="course-eyebrow">MY TASKS / CONTINUE YOUR WORK</p><h2 id="assigned-tasks-title">あなたの担当中タスク</h2></div>
                <span class="assigned-tasks-count">{{ $assignedTasks->total() }}<small> 件</small></span>
            </div>
            <p class="course-muted">今取り組んでいるタスクを、すべてのフェーズからまとめて確認できます。</p>
            <div class="assigned-tasks-list">
                @forelse($assignedTasks as $task)
                    <a class="assigned-task" href="{{ route('courses.intermediate.show_task', $task->id) }}">
                        <div class="assigned-task-content"><div class="assigned-task-meta"><span>{{ $phases[$task->phase] ?? $task->phase }}</span><span class="assigned-task-status">● 担当中</span><span>#{{ $task->id }}</span></div><h3>{{ $task->title }}</h3></div>
                        <span class="assigned-task-action">詳細へ <span aria-hidden="true">→</span></span>
                    </a>
                @empty
                    <div class="assigned-tasks-empty"><strong>現在、担当中のタスクはありません</strong><p class="course-muted">取り組むフェーズからタスクを選ぶと、ここに表示されます。</p><a href="#course-phases" class="course-card-action">フェーズからタスクを探す →</a></div>
                @endforelse
            </div>
            @if($assignedTasks->hasPages())<div class="assigned-tasks-pagination">{{ $assignedTasks->links() }}</div>@endif
        </section>
        <h2 class="course-section-title">実践を始める準備</h2>
        <div class="intermediate-preparation">
            <a class="course-resource" href="{{ route('courses.intermediate.rules') }}"><p class="course-eyebrow">01 / GUIDELINES</p><h3>チームの進め方を知る</h3><p class="course-muted">実務に取り組む前に、運用ルールと開発の流れを確認しましょう。</p><span class="course-card-action">運用ルールを見る →</span></a>
            <a class="course-resource" href="https://github.com/SunTechAcademy/SunTechAcademy" target="_blank" rel="noopener noreferrer"><p class="course-eyebrow">02 / SETUP</p><h3>開発環境を整える</h3><p class="course-muted">READMEを確認しながら環境構築。実務への最初の一歩を踏み出そう。</p><span class="course-card-action">GitHubリポジトリを開く ↗</span></a>
            <a class="course-resource" href="{{ route('courses.intermediate.documents') }}"><p class="course-eyebrow">03 / DOCUMENTS</p><h3>設計を理解する</h3><p class="course-muted">要件定義・基本設計・ER図など、開発に必要なドキュメントをここから。</p><span class="course-card-action">ドキュメント一覧へ →</span></a>
        </div>
        <h2 class="course-section-title" id="course-phases">取り組むフェーズを選ぼう</h2>
        <div class="course-phase-grid">
            @foreach($phases as $key => $label)
                <a class="course-phase" href="{{ route('courses.intermediate.phase', ['phase' => $key]) }}"><p class="course-eyebrow">PHASE {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</p><h3>{{ $label }}</h3><p class="course-muted" style="margin-bottom: 12px;">あなたの完了 {{ $completedCounts[$key] ?? 0 }} / 登録 {{ $taskCounts[$key] ?? 0 }} 件</p><p class="course-muted">{{ $definitions[$key] }}</p><span class="course-card-action">タスク一覧を見る →</span></a>
            @endforeach
        </div>
        </div>
        <aside class="intermediate-sidebar" tabindex="0" aria-label="学習状況とログイン履歴">
        <div class="course-stats">
            <div class="course-stat"><p>あなたの完了タスク</p><strong>{{ array_sum($completedCounts) }}</strong><small>件</small></div>
            @can('manage-tasks')
            <div class="course-stat"><p>登録タスク</p><strong>{{ array_sum($taskCounts) }}</strong><small>件</small></div>
            <div class="course-stat"><p>実践フェーズ</p><strong>{{ count($phases) }}</strong><small>分野</small></div>
            @endcan
        </div>
        <section class="course-quota">
            <h2 class="course-section-title" style="margin-top: 0;">実務経験の達成目標</h2>
            <div class="course-quota-grid">
                @foreach(['implementation', 'operation'] as $nPhase)
                    @php
                        $current = $completedCounts[$nPhase] ?? 0;
                        $quota = $norms[$nPhase];
                    @endphp
                    <div class="course-stat"><p>{{ $phases[$nPhase] }}</p><strong>{{ $current }}</strong><small>/ {{ $quota }} 件完了</small><progress class="course-progress" value="{{ min($current, $quota) }}" max="{{ $quota }}" aria-label="{{ $phases[$nPhase] }}の達成状況"></progress><p class="course-muted" style="margin: 12px 0 0;">{{ $current >= $quota ? '✓ 目標達成！経験が、確かな力になっています。' : '目標まであと '.($quota - $current).' 件。一歩ずつ積み重ねよう。' }}</p></div>
                @endforeach
            </div>
            <p class="course-muted" style="margin-top: 16px;">要件定義・基本設計・詳細設計・単体テスト・結合テスト・総合テストは、実装構築および保守運用の開発フローで経験するため、個別のノルマはありません。</p>
        </section>
        <x-learning-activity />
        </aside>
        </div>
    </div></div>
</x-app-layout>
