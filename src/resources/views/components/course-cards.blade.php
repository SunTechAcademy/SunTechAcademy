@props(['introduction' => false])
@php
    $courses = [
        ['key' => 'beginner', 'level' => '初級', 'step' => '01', 'english' => 'BUILD YOUR FOUNDATION', 'title' => '「つくれる」を、ここから。', 'name' => 'エンジニア基礎', 'description' => '小さな「できた」を重ねて、Web開発の土台を自分の力に。', 'tags' => ['プログラミング', 'Web開発', '開発ツール'], 'detail' => 'プログラミング・Web開発・フレームワークの基礎と開発ツールを学び、案件参画に向けた土台を固めます。', 'period' => '初期フェーズ・3ヶ月〜', 'route' => 'courses.beginner', 'action' => '基礎から一歩を踏み出す'],
        ['key' => 'intermediate', 'level' => '中級', 'step' => '02', 'english' => 'TURN SKILLS INTO IMPACT', 'title' => '学んだ力を、現場の力に。', 'name' => '実務スキル', 'description' => '実際の開発に挑戦して、知識を経験へ。チームで活きるスキルを磨こう。', 'tags' => ['実践開発', '設計', '保守・運用'], 'detail' => '自社サービスやフリーランス案件サイトの保守・改修・運用・新規開発から、要件定義・基本設計・詳細設計まで担当します。', 'period' => '実務型・9ヶ月〜', 'route' => 'courses.intermediate.index', 'action' => '実践にチャレンジする'],
        ['key' => 'advanced', 'level' => '上級', 'step' => '03', 'english' => 'GROW INTO A LEADER', 'title' => 'チームの未来を、動かそう。', 'name' => 'PM・PMO・PL', 'description' => '技術のその先へ。プロジェクトを導き、チームの可能性を広げる存在に。', 'tags' => ['リーダーシップ', '課題解決', 'プロジェクト管理'], 'detail' => 'PM・PMO・PLレベルの実務スキルを習得し、技術で課題を解決できるエンジニアを目指します。', 'period' => 'プロレベル・1年〜', 'route' => 'courses.advanced', 'action' => 'コースの準備状況を見る'],
    ];
@endphp
<div class="academy-courses">
    @foreach($courses as $course)
        <a href="{{ $introduction ? url('/dashboard') : route($course['route']) }}" class="academy-course academy-course-{{ $course['key'] }}">
            <div class="academy-course-art" aria-hidden="true">
                <span class="academy-course-step">STEP {{ $course['step'] }}</span>
                <span class="academy-course-orbit"></span>
                <svg viewBox="0 0 320 190" fill="none">
                    @if($course['key'] === 'beginner')
                        <rect x="65" y="43" width="196" height="126" rx="16" fill="#464c8a" opacity=".12" transform="rotate(-7 160 100)"/>
                        <rect x="57" y="32" width="196" height="126" rx="14" fill="white" stroke="#c5c8ed" stroke-width="2"/>
                        <path d="M58 60h194" stroke="#e8e9f7" stroke-width="2"/>
                        <circle cx="73" cy="46" r="3" fill="#f2afb9"/><circle cx="85" cy="46" r="3" fill="#f4d288"/><circle cx="97" cy="46" r="3" fill="#91cbbf"/>
                        <path d="m113 86-17 16 17 16m84-32 17 16-17 16m-32-39-20 45" stroke="#777fc0" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="202" y="127" width="58" height="42" rx="12" fill="#737cba"/><path d="m219 148 8 8 16-17" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="m43 94 4 9 9 4-9 4-4 9-4-9-9-4 9-4Z" fill="#edc77b"/>
                    @elseif($course['key'] === 'intermediate')
                        <rect x="60" y="39" width="200" height="124" rx="15" fill="#216b67" opacity=".12" transform="rotate(6 160 100)"/>
                        <rect x="51" y="31" width="210" height="128" rx="14" fill="white" stroke="#b5dbd3" stroke-width="2"/>
                        <path d="M70 53h64" stroke="#badbd3" stroke-width="6" stroke-linecap="round"/>
                        <rect x="68" y="72" width="52" height="68" rx="7" fill="#edf5f2"/><rect x="130" y="72" width="52" height="68" rx="7" fill="#edf5f2"/><rect x="192" y="72" width="52" height="68" rx="7" fill="#edf5f2"/>
                        <rect x="75" y="81" width="38" height="22" rx="5" fill="#c6e1d9"/><rect x="137" y="81" width="38" height="41" rx="5" fill="#7ab7a8"/><rect x="199" y="81" width="38" height="22" rx="5" fill="#c6e1d9"/>
                        <circle cx="244" cy="146" r="25" fill="#397f70"/><path d="m233 146 8 8 15-16" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="m34 91 4 9 9 4-9 4-4 9-4-9-9-4 9-4Z" fill="#e8bc74"/>
                    @else
                        <path d="M73 165h56v-38H73zm57 0h56V94h-56zm57 0h56V62h-56z" fill="#eacdb2"/>
                        <path d="M73 155h56v-38H73zm57 0h56V84h-56zm57 0h56V52h-56z" fill="#fffaf4" stroke="#dfb692" stroke-width="2"/>
                        <path d="m76 97 55-43 41 9 51-37m-25 0h25v25" stroke="#b67a4e" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="244" cy="139" r="26" fill="#b57d55"/><path d="m244 123 5 10 11 2-8 8 2 11-10-5-10 5 2-11-8-8 11-2Z" fill="#ffe6ad"/>
                        <path d="m44 62 4 9 9 4-9 4-4 9-4-9-9-4 9-4Z" fill="#d8a86e"/>
                    @endif
                </svg>
                <span class="academy-course-level">{{ $course['level'] }}コース</span>
            </div>
            <div class="academy-course-body">
                <p class="academy-course-eyebrow">{{ $course['english'] }}</p>
                <h3>{{ $course['title'] }}</h3>
                <p class="academy-course-name">{{ $course['name'] }} @if($course['key'] === 'advanced')<span class="academy-course-soon">準備中</span>@endif</p>
                <p class="academy-course-description">{{ $course['description'] }}</p>
                <ul class="academy-course-tags" aria-label="学習テーマ">@foreach($course['tags'] as $tag)<li>{{ $tag }}</li>@endforeach</ul>
                @if($introduction)
                    <div class="academy-course-detail"><p>{{ $course['period'] }}</p>{{ $course['detail'] }}</div>
                @endif
                <div class="academy-course-action"><span>{{ $introduction ? 'マイコースで確認する' : $course['action'] }}</span><span class="academy-course-arrow" aria-hidden="true">↗</span></div>
            </div>
        </a>
    @endforeach
</div>
@once
<style>
    .academy-courses { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px; text-align: left; }
    .academy-course { --accent: #626ba8; --wash: #efeffb; --border: #dcdff1; display: flex; flex-direction: column; min-width: 0; background: #fff; border: 1px solid #e6e7ef; border-radius: 24px; overflow: hidden; box-shadow: 0 8px 28px #30344d06; text-decoration: none; transition: transform .25s, box-shadow .25s, border-color .25s; }
    .academy-course-intermediate { --accent: #347b6b; --wash: #eaf5ef; --border: #cde6dc; }
    .academy-course-advanced { --accent: #996339; --wash: #fbf1e5; --border: #efdbc6; }
    .academy-course:hover { transform: translateY(-6px); border-color: var(--border); box-shadow: 0 20px 40px #30344d12; }
    .academy-course:focus-visible { outline: 3px solid var(--accent); outline-offset: 4px; }
    .academy-course-art { position: relative; height: 220px; overflow: hidden; background: var(--wash); }
    .academy-course-step { position: absolute; left: 22px; top: 20px; font-size: 10px; letter-spacing: .16em; color: var(--accent); font-weight: 800; }
    .academy-course-orbit { position: absolute; width: 230px; height: 230px; border-radius: 50%; border: 1px solid #ffffffb0; top: 15px; right: -50px; box-shadow: 0 0 0 28px #ffffff35, 0 0 0 56px #ffffff20; }
    .academy-course-art svg { position: absolute; width: 100%; height: 180px; top: 30px; left: 0; transition: transform .35s; }
    .academy-course:hover svg { transform: translateY(-4px) rotate(-2deg); }
    .academy-course-level { position: absolute; bottom: 14px; left: 22px; color: var(--accent); background: #ffffffd9; border: 1px solid #ffffff; border-radius: 8px; padding: 5px 10px; font-size: 11px; font-weight: 700; }
    .academy-course-body { padding: 26px 24px 20px; display: flex; flex-direction: column; flex: 1; }
    .academy-course-eyebrow { color: var(--accent); font-size: 9px; letter-spacing: .12em; font-weight: 800; margin: 0 0 10px; }
    .academy-course h3 { font-size: clamp(17px, 1.6vw, 21px); line-height: 1.6; letter-spacing: -.04em; color: #30364b; font-weight: 800; margin: 0 0 8px; }
    .academy-course-name { color: #545c72; font-size: 13px; font-weight: 700; margin: 0 0 14px; }
    .academy-course-soon { display: inline-block; margin-left: 5px; font-size: 10px; font-weight: 500; padding: 2px 6px; border-radius: 5px; background: var(--wash); color: var(--accent); }
    .academy-course-description { color: #737b8c; font-size: 13px; line-height: 1.9; margin: 0 0 18px; }
    .academy-course-tags { display: flex; flex-wrap: wrap; gap: 6px; padding: 0; margin: 0 0 24px; list-style: none; }
    .academy-course-tags li { font-size: 10px; padding: 5px 8px; border-radius: 6px; background: #f5f6fa; color: #626a7d; }
    .academy-course-detail { color: #737b8c; font-size: 12px; line-height: 1.9; padding-bottom: 24px; }
    .academy-course-detail p { color: var(--accent); font-weight: 700; margin-bottom: 8px; }
    .academy-course-action { margin-top: auto; padding-top: 18px; border-top: 1px solid #eff0f5; display: flex; align-items: center; justify-content: space-between; gap: 8px; font-size: 12px; font-weight: 700; color: var(--accent); }
    .academy-course-arrow { display: grid; place-items: center; width: 34px; height: 34px; flex-shrink: 0; border-radius: 50%; background: var(--wash); font-size: 20px; transition: background .2s, color .2s; }
    .academy-course:hover .academy-course-arrow { background: var(--accent); color: white; }
    @media (max-width: 900px) { .academy-courses { grid-template-columns: 1fr; max-width: 560px; margin: auto; } .academy-course h3 { font-size: 21px; } }
    @media (prefers-reduced-motion: reduce) { .academy-course, .academy-course-art svg, .academy-course-arrow { transition: none; } .academy-course:hover, .academy-course:hover svg { transform: none; } }
</style>
@endonce
