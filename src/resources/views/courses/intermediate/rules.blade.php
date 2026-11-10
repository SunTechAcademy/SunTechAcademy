<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">中級 · 運用ルール</h2></x-slot>
    <x-course-page-styles />
    <style>
        .rules-back { display: inline-flex; gap: 10px; align-items: center; margin-bottom: 24px; font-size: 13px; font-weight: 600; color: #507366; }
        .rules-back:hover { color: #245442; }
        .rules-hero { position: relative; overflow: hidden; padding: 36px; border: 1px solid #dcebe4; border-radius: 26px; background: linear-gradient(120deg, #eef8f2, #fff 75%); margin-bottom: 28px; }
        .rules-hero h1 { font-size: clamp(25px, 3vw, 34px); font-weight: 750; letter-spacing: -.04em; line-height: 1.5; margin-bottom: 12px; }
        .rules-hero > p:last-child { max-width: 640px; font-size: 14px; color: #61756b; line-height: 1.9; }
        .rules-layout { display: grid; grid-template-columns: minmax(0, 1fr) 290px; gap: 24px; align-items: start; }
        .rules-list { display: grid; gap: 18px; list-style: none; padding: 0; margin: 0; }
        .rules-card { display: flex; gap: 22px; padding: 28px; border: 1px solid #e4eae7; border-radius: 22px; background: #fff; box-shadow: 0 6px 24px #254a3604; }
        .rules-number { display: grid; place-items: center; width: 48px; height: 48px; flex-shrink: 0; border-radius: 16px; background: #edf6f1; color: #3e8574; font-size: 16px; font-weight: 750; }
        .rules-card:nth-child(2) .rules-number { background: #eff1fc; color: #6974ad; }
        .rules-card:nth-child(3) .rules-number { background: #fff5e4; color: #9a7129; }
        .rules-card h2 { font-size: 19px; font-weight: 700; margin: 0 0 10px; }
        .rules-card p { color: #687486; font-size: 14px; line-height: 1.95; margin: 0; }
        .rules-card .rules-note { margin-top: 16px; padding: 13px 16px; background: #f7f9fb; border-radius: 12px; font-size: 12px; }
        .rules-card > div { min-width: 0; flex: 1; }
        .rules-card code { font-size: .9em; overflow-wrap: anywhere; }
        .rules-subtitle { margin: 24px 0 10px; font-size: 15px; font-weight: 700; }
        .rules-command { margin-top: 16px; border-radius: 14px; overflow: hidden; background: #263c36; }
        .rules-command > p { padding: 12px 18px; color: #c7ddd2; font-size: 12px; border-bottom: 1px solid #ffffff18; }
        .rules-command pre { padding: 18px; margin: 0; color: #eef8f2; font-size: 13px; line-height: 1.9; white-space: pre-wrap; overflow-wrap: anywhere; }
        .rules-branches { margin-top: 16px; border: 1px solid #e4eae7; border-radius: 14px; overflow: hidden; }
        .rules-branches > div { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.4fr); gap: 12px; padding: 14px 16px; font-size: 13px; line-height: 1.8; }
        .rules-branches > div + div { border-top: 1px solid #edf1ee; }
        .rules-branches dt { color: #32715d; font-weight: 600; }
        .rules-branches dd { color: #687486; margin: 0; }
        @media(max-width:600px) { .rules-branches > div { grid-template-columns: minmax(0, 1fr); gap: 4px; } }
        .rules-link { display: inline-flex; align-items: center; gap: 10px; margin-top: 18px; font-size: 13px; font-weight: 700; color: #32715d; }
        .rules-link:hover { text-decoration: underline; text-underline-offset: 4px; }
        .rules-sidebar { padding: 26px; background: #fff; border: 1px solid #e4eae7; border-radius: 22px; }
        .rules-sidebar h2 { font-size: 17px; font-weight: 700; margin-bottom: 12px; }
        .rules-flow { display: grid; gap: 0; margin: 20px 0 24px; padding: 0; list-style: none; }
        .rules-flow li { position: relative; padding: 0 0 24px 26px; font-size: 13px; color: #61756b; }
        .rules-flow li::before { content: ''; position: absolute; left: 0; top: 5px; width: 9px; height: 9px; border-radius: 50%; background: #83ae9c; box-shadow: 0 0 0 4px #eff6f2; }
        .rules-flow li:not(:last-child)::after { content: ''; position: absolute; left: 4px; top: 19px; bottom: 5px; width: 1px; background: #e0eae4; }
        .rules-flow li:last-child { padding-bottom: 0; }
        .rules-sidebar .course-button { width: 100%; }
        .rules-sidebar .rules-link { display: flex; justify-content: center; }
        @media(max-width:900px) { .rules-layout { grid-template-columns: minmax(0, 1fr); } }
        @media(max-width:600px) { .rules-hero { padding: 26px 22px; } .rules-card { padding: 22px; gap: 16px; flex-direction: column; } .rules-card h2 { font-size: 18px; } .rules-number { width: 40px; height: 40px; border-radius: 12px; } }
    </style>
    <div class="course-page is-intermediate"><div class="course-container">
        <a class="rules-back" href="{{ route('courses.intermediate.index') }}"><span aria-hidden="true">←</span> 中級コースに戻る</a>
        <header class="rules-hero">
            <p class="course-eyebrow">GUIDELINES / WORK BETTER TOGETHER</p>
            <h1>安心して実践するための、<br>５つの運用ルール。</h1>
            <p>開発の準備から、タスクの管理、完了まで。<br>進め方を確認して、一つひとつの実践を確かな経験にしていきましょう。</p>
        </header>
        <div class="rules-layout">
            <ol class="rules-list" aria-label="中級コースの運用ルール">
                <li class="rules-card">
                    <span class="rules-number" aria-hidden="true">01</span>
                    <div><h2>まずは、開発環境を整える</h2><p>タスクに取り組む前に、GitHubのREADMEに従ってローカル環境を構築してください。</p>
                    <p class="rules-note">開発に必要な手順は、リポジトリのREADMEから確認できます。</p>
                    <a class="rules-link" href="https://github.com/SunTechAcademy/SunTechAcademy" target="_blank" rel="noopener noreferrer">GitHubでREADMEを確認 <span aria-hidden="true">↗</span><span class="sr-only">（新しいタブで開きます）</span></a></div>
                </li>
                <li class="rules-card">
                    <span class="rules-number" aria-hidden="true">02</span>
                    <div><h2>設計を理解する</h2><p>要件定義・基本設計・ER図など、どこにどの資料が置いてあるかを確認しましょう。</p>
                    <p class="rules-note">資料の内容をすべて覚える必要はありません。まずは資料の置き場所を確認するだけで大丈夫です。内容は、タスクで必要になったときに読み返しましょう。</p>
                    <a class="rules-link" href="{{ route('courses.intermediate.documents') }}">設計ドキュメントを確認 <span aria-hidden="true">→</span></a></div>
                </li>
                <li class="rules-card">
                    <span class="rules-number" aria-hidden="true">03</span>
                    <div><h2>最新のコードを取得して、ブランチを作る</h2>
                    <p>作業を始める前に、変更中のファイルがないか <code>git status</code> で確認しましょう。未コミットの変更はコミットするか、一時退避してから進めてください。</p>
                    <h3 class="rules-subtitle">作業開始時の手順</h3>
                    <p>チームで指定された基準ブランチへ切り替え、<code>git fetch</code> でリモートの更新情報を取得します。その後、<code>git pull --ff-only</code> で手元のコードを更新してから、作業用ブランチを作成します。</p>
                    <div class="rules-command"><p>例：基準ブランチが main の場合</p><pre><code>git switch main
git fetch origin
git pull --ff-only origin main
git switch -c feature/123-add-login</code></pre></div>
                    <p class="rules-note">基準ブランチ名はチームの指定に合わせてください。更新時にエラーが出た場合は、無理に上書きせず講師に相談しましょう。</p>
                    <h3 class="rules-subtitle">ブランチ名：</h3>
                    <p>作業の種類に合わせた接頭辞に、タスク番号と内容がわかる短い英語を続けます。例：<code>fix/123-login-error</code></p>
                    <dl class="rules-branches">
                        <div><dt><code>feature/</code></dt><dd>新機能の追加</dd></div>
                        <div><dt><code>fix/</code> または <code>bugfix/</code></dt><dd>バグ修正</dd></div>
                        <div><dt><code>hotfix/</code></dt><dd>本番環境での緊急修正</dd></div>
                        <div><dt><code>refactor/</code></dt><dd>機能を変えないコード改善</dd></div>
                        <div><dt><code>docs/</code></dt><dd>ドキュメントの更新</dd></div>
                        <div><dt><code>chore/</code></dt><dd>ビルド設定やツールなどの雑務・保守</dd></div>
                    </dl></div>
                </li>
                <li class="rules-card">
                    <span class="rules-number" aria-hidden="true">04</span>
                    <div><h2>担当タスクを確認して、進める</h2><p>タスク詳細で、取り組む内容と担当者を確認しましょう。担当中のタスクは、中級コースの「あなたの担当中タスク」からまとめて確認できます。</p>
                    <p class="rules-note">タスクの編集・削除は、管理者・最高管理者が行えます。内容の変更が必要な場合は、講師に相談してください。</p>
                    <a class="rules-link" href="{{ route('courses.intermediate.index') }}#assigned-tasks">担当中タスクを確認 <span aria-hidden="true">→</span></a></div>
                </li>
                <li class="rules-card">
                    <span class="rules-number" aria-hidden="true">05</span>
                    <div><h2>要求を満たしたら、完了を記録する</h2><p>自分が担当しているタスクの要求を満たしたら、タスク詳細の「タスクを完了する」ボタンを押してください。</p>
                    <p class="rules-note">完了前に、作業内容と完了条件をもう一度確認しましょう。完了したタスクは、あなたの実践の積み重ねとして記録されます。</p></div>
                </li>
            </ol>
            <aside class="rules-sidebar" aria-label="実践の進め方">
                <p class="course-eyebrow">YOUR NEXT STEP</p><h2>準備ができたら、実践へ。</h2>
                <p class="course-muted">迷ったときは、この流れに戻って確認しましょう。</p>
                <ol class="rules-flow"><li>ローカル環境を構築する</li><li>設計資料の置き場所を確認する</li><li>最新コードを取得し、ブランチを作る</li><li>担当タスクの内容を確認する</li><li>実装・動作確認を進める</li><li>条件を満たしたら完了する</li></ol>
                <a class="course-button" href="{{ route('courses.intermediate.index') }}">中級コースへ進む <span aria-hidden="true">→</span></a>
                <a class="rules-link" href="{{ route('courses.intermediate.documents') }}">設計ドキュメントを確認 <span aria-hidden="true">↗</span></a>
            </aside>
        </div>
    </div></div>
</x-app-layout>
