<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">中級 · 開発ドキュメント</h2></x-slot>
    <x-course-page-styles />
    @php
        $groups = [
            ['id' => 'design', 'label' => '設計・仕様', 'eyebrow' => '01 / DESIGN', 'description' => '何を作るか、どう作るかを確認する。', 'items' => [
                ['requirement', '要件定義書', '実現したいことや、必要な機能を確認するときに。'],
                ['basic_design', '基本設計書', 'システム全体の構成や、仕組みを確認するときに。'],
                ['detail_design', '詳細設計書', '実装に向けて、処理の詳細を確認するときに。'],
            ]],
            ['id' => 'testing', 'label' => 'テスト・品質確認', 'eyebrow' => '02 / TESTING', 'description' => '期待どおりに動くか、確認の観点を整理する。', 'items' => [
                ['unit_test', '単体テスト仕様書', '一つひとつの機能の動作を確認するときに。'],
                ['integration_test', '結合テスト仕様書', '機能同士をつなげた動作を確認するときに。'],
                ['system_test', '総合テスト仕様書', 'システム全体の動作を確認するときに。'],
            ]],
            ['id' => 'database', 'label' => 'データベース', 'eyebrow' => '03 / DATABASE', 'description' => 'データのつながりと、保存する情報を確認する。', 'items' => [
                ['er_diagram', 'データベースER図', 'テーブル同士の関係を確認するときに。'],
                ['db_definition', 'DB（テーブル）定義書', 'テーブルやカラムの定義を確認するときに。'],
            ]],
        ];
    @endphp
    <style>
        .docs-back { display: inline-flex; gap: 10px; align-items: center; margin-bottom: 24px; font-size: 13px; font-weight: 600; color: #507366; }
        .docs-back:hover { color: #245442; }
        .docs-hero { display: flex; justify-content: space-between; align-items: center; gap: 32px; padding: 36px; border: 1px solid #dcebe4; border-radius: 26px; background: linear-gradient(120deg, #eef8f2, #fff 80%); }
        .docs-hero h1 { font-size: clamp(25px, 3vw, 34px); font-weight: 750; letter-spacing: -.04em; margin-bottom: 12px; }
        .docs-intro { font-size: 14px; line-height: 1.95; color: #61756b; }
        .docs-count { flex-shrink: 0; text-align: center; padding: 22px 30px; border: 1px solid #e0ece5; border-radius: 20px; background: #ffffffb3; color: #3e8574; }
        .docs-count strong { font-size: 42px; line-height: 1.2; font-weight: 750; }
        .docs-count span { display: block; font-size: 11px; margin-top: 6px; }
        .docs-guide { display: flex; gap: 16px; align-items: flex-start; padding: 20px 24px; margin-top: 18px; border-radius: 16px; background: #edf1fa; }
        .docs-guide-icon { display: grid; place-items: center; width: 28px; height: 28px; border-radius: 50%; background: #fff; color: #6974ad; flex-shrink: 0; font-weight: 700; }
        .docs-guide h2 { font-size: 14px; font-weight: 700; margin-bottom: 5px; }
        .docs-guide p { color: #66728a; font-size: 13px; line-height: 1.9; }
        .docs-nav { display: flex; flex-wrap: wrap; gap: 10px; margin: 28px 0 36px; }
        .docs-nav a { font-size: 13px; font-weight: 600; background: #fff; border: 1px solid #e1e8e4; border-radius: 999px; padding: 10px 18px; transition: background .2s, border-color .2s; }
        .docs-nav a:hover { background: #edf6f1; border-color: #9cbeaf; }
        .docs-section { margin-top: 32px; scroll-margin-top: 24px; }
        .docs-section-heading { margin-bottom: 18px; }
        .docs-section-heading .course-eyebrow { margin-bottom: 6px; }
        .docs-section-heading h2 { font-size: 21px; font-weight: 700; margin-bottom: 5px; }
        .docs-section-heading > p:last-child { font-size: 13px; color: #728073; line-height: 1.8; }
        .docs-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; }
        .docs-card { display: flex; flex-direction: column; padding: 24px; border: 1px solid #e2e9e5; border-radius: 20px; background: #fff; transition: border-color .2s, box-shadow .2s, transform .2s; }
        .docs-card:hover { border-color: #91b8a7; box-shadow: 0 10px 28px #2856400c; transform: translateY(-3px); }
        .docs-card-top { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 20px; }
        .docs-icon { display: grid; place-items: center; width: 42px; height: 46px; border-radius: 12px; background: #edf6f1; color: #3e8574; }
        .docs-icon svg { width: 22px; height: 22px; }
        .docs-source { font-size: 10px; font-weight: 600; padding: 5px 9px; border-radius: 6px; background: #f5f7f9; color: #6c7887; }
        .docs-card h3 { font-size: 16px; font-weight: 700; margin-bottom: 10px; }
        .docs-card p { font-size: 13px; line-height: 1.9; color: #748093; margin-bottom: 22px; }
        .docs-card-action { display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 16px; border-top: 1px solid #edf1ee; font-size: 12px; font-weight: 700; color: #32715d; }
        #testing .docs-icon { background: #eff1fc; color: #6974ad; }
        #database .docs-icon { background: #fff5e4; color: #9a7129; }
        .docs-footer { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 16px; align-items: center; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e3e8e5; }
        .docs-footer p { font-size: 12px; color: #748093; }
        .docs-footer a { font-size: 13px; font-weight: 600; color: #32715d; }
        @media(max-width:900px) { .docs-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media(max-width:600px) { .docs-hero { padding: 26px 22px; } .docs-count { display: none; } .docs-grid { grid-template-columns: minmax(0, 1fr); } .docs-guide { padding: 18px; gap: 12px; } .docs-nav { gap: 8px; } .docs-nav a { font-size: 12px; padding: 10px 14px; } }
        @media(prefers-reduced-motion:reduce) { .docs-card { transition: none; } .docs-card:hover { transform: none; } }
    </style>
    <div class="course-page is-intermediate"><div class="course-container">
        <a class="docs-back" href="{{ route('courses.intermediate.index') }}"><span aria-hidden="true">←</span> 中級コースに戻る</a>
        <header class="docs-hero">
            <div><p class="course-eyebrow">DEVELOPMENT LIBRARY / FIND YOUR REFERENCE</p><h1>必要な資料を、必要なときに。</h1><p class="docs-intro">設計からテスト、データベースまで。<br>実践を進めるための開発ドキュメントを、ここから確認できます。</p></div>
            <div class="docs-count"><strong>{{ collect($groups)->sum(fn ($group) => count($group['items'])) }}</strong><span>DOCUMENTS</span></div>
        </header>
        <section class="docs-guide" aria-labelledby="docs-guide-title"><span class="docs-guide-icon" aria-hidden="true">i</span><div><h2 id="docs-guide-title">まずは、資料の置き場所を知るだけで大丈夫。</h2><p>すべての内容を覚える必要はありません。どこにどの資料があるか確認して、タスクで必要になったときに読み返しましょう。</p></div></section>
        <nav class="docs-nav" aria-label="ドキュメントのカテゴリ">@foreach($groups as $group)<a href="#{{ $group['id'] }}">{{ $group['label'] }} <span aria-hidden="true">↓</span></a>@endforeach</nav>
        @foreach($groups as $group)
            <section class="docs-section" id="{{ $group['id'] }}" aria-labelledby="{{ $group['id'] }}-title">
                <div class="docs-section-heading"><p class="course-eyebrow">{{ $group['eyebrow'] }}</p><h2 id="{{ $group['id'] }}-title">{{ $group['label'] }}</h2><p>{{ $group['description'] }}</p></div>
                <div class="docs-grid">
                    @foreach($group['items'] as [$key, $title, $description])
                        <a class="docs-card" href="{{ $urls[$key] }}" target="_blank" rel="noopener noreferrer">
                            <div class="docs-card-top"><span class="docs-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6M8 13h8M8 17h5"/></svg></span><span class="docs-source">{{ $key === 'er_diagram' ? 'Notion' : 'Google Sheets' }}</span></div>
                            <h3>{{ $title }}</h3><p>{{ $description }}</p><span class="docs-card-action">資料を開く<span aria-hidden="true">↗</span></span><span class="sr-only">（新しいタブで開きます）</span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
        <footer class="docs-footer"><p>各資料は新しいタブで開きます。</p><a href="{{ route('courses.intermediate.rules') }}">運用ルールを確認する →</a></footer>
    </div></div>
</x-app-layout>
