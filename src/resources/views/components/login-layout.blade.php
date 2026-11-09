@props(['admin' => false])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <x-favicon />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $admin ? '管理者ログイン' : 'ログイン' }} | {{ config('app.name', 'SunTechAcademy') }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Hiragino Kaku Gothic ProN', 'Yu Gothic', sans-serif; color: #30364b; background: #f7f8fc; }
        a { color: inherit; text-decoration: none; }
        .login-header { display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 20px max(24px, calc((100vw - 1168px) / 2)); background: #fff; }
        .login-header img { display: block; max-width: 200px; max-height: 42px; width: auto; }
        .login-back { font-size: 12px; color: #727b92; padding: 10px 0; white-space: nowrap; }
        .login-back:hover { color: #545f9c; }
        .login-main { max-width: 1120px; margin: auto; min-height: calc(100vh - 82px); display: grid; grid-template-columns: 1fr 1fr; align-items: center; gap: 80px; padding: 64px 32px; }
        .login-story { padding: 12px; }
        .login-eyebrow { font-size: 10px; font-weight: 800; letter-spacing: .2em; color: #7b84b5; margin: 0 0 20px; }
        .login-story h1 { font-size: clamp(28px, 3vw, 38px); line-height: 1.6; letter-spacing: -.04em; margin: 0 0 20px; }
        .login-story-copy { color: #7b8295; font-size: 14px; line-height: 2; margin: 0; }
        .login-illustration { max-width: 340px; margin: 30px auto 0; }
        .login-illustration svg { width: 100%; height: auto; }
        .login-card { background: white; padding: 40px; border: 1px solid #e8eaf3; border-radius: 24px; box-shadow: 0 20px 60px #30344d08; }
        .login-card h2 { font-size: 25px; margin: 0 0 10px; letter-spacing: -.03em; }
        .login-intro { margin: 0 0 30px; font-size: 13px; color: #7b8295; line-height: 1.9; }
        .login-field { margin-bottom: 22px; }
        .login-field label { display: block; font-size: 12px; font-weight: 700; margin-bottom: 9px; color: #545c74; }
        .login-input { width: 100%; padding: 14px 16px; border: 1px solid #dde1ec; border-radius: 11px; background: #fbfcfe; font: inherit; font-size: 15px; color: #30364b; transition: border-color .2s, box-shadow .2s, background .2s; }
        .login-input:focus { outline: none; border-color: #8b94c7; box-shadow: 0 0 0 4px #eff0fa; background: white; }
        .login-input[aria-invalid="true"] { border-color: #d88a9b; }
        .login-input::placeholder { color: #a2a8b8; }
        .login-remember { display: flex; align-items: center; gap: 8px; color: #727b92; font-size: 12px; cursor: pointer; margin-bottom: 26px; }
        .login-remember input { width: 16px; height: 16px; accent-color: #6973ad; }
        .login-submit { width: 100%; display: flex; align-items: center; justify-content: center; gap: 16px; min-height: 50px; border: 0; border-radius: 12px; background: linear-gradient(120deg, #7781bb, #5d67a3); box-shadow: 0 6px 16px #626ba826; color: white; font: inherit; font-size: 14px; font-weight: 700; cursor: pointer; transition: transform .2s, box-shadow .2s; }
        .login-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 22px #626ba839; }
        .login-submit:active { transform: none; }
        .login-forgot { text-align: center; margin: 22px 0 0; font-size: 12px; color: #7b84ad; }
        .login-forgot a:hover { text-decoration: underline; text-underline-offset: 4px; }
        a:focus-visible, button:focus-visible, input[type="checkbox"]:focus-visible { outline: 3px solid #aeb5de; outline-offset: 4px; }
        .login-errors { padding: 0; margin: 8px 0 0; list-style: none; color: #b04461; font-size: 12px; line-height: 1.8; }
        .login-status { background: #edf7f3; color: #347b6b; border-radius: 10px; padding: 14px; font-size: 13px; margin-bottom: 22px; }
        .login-footnote { text-align: center; font-size: 11px; color: #959bae; margin: 24px 0 0; }
        @media (max-width: 800px) { .login-main { max-width: 520px; grid-template-columns: 1fr; gap: 28px; padding: 36px 20px; min-height: auto; } .login-story { text-align: center; padding: 0; } .login-story h1 { font-size: 25px; margin-bottom: 12px; } .login-eyebrow { margin-bottom: 12px; } .login-illustration { display: none; } .login-card { padding: 28px 24px; } .login-header { padding: 16px; } .login-header img { max-width: 170px; } }
        @media (prefers-reduced-motion: reduce) { .login-submit, .login-input { transition: none; } .login-submit:hover { transform: none; } }
    </style>
</head>
<body>
    <header class="login-header">
        <a href="/" aria-label="SunTechAcademy トップページ"><img src="{{ asset('images/SunTechAcademy.png') }}" alt="SunTechAcademy"></a>
        <a href="/" class="login-back">← トップへ戻る</a>
    </header>
    <main class="login-main">
        <section class="login-story" aria-labelledby="login-welcome">
            <p class="login-eyebrow">{{ $admin ? 'ACADEMY MANAGEMENT' : 'WELCOME BACK' }}</p>
            <h1 id="login-welcome">@if($admin)学びの一歩を、<br>支える場所。@else昨日の続きから、<br>新しい「できた」へ。@endif</h1>
            <p class="login-story-copy">@if($admin)受講生の新しいスタートを、スムーズに。<br>アカウント発行と運営の管理をここから。@elseあなたのペースで、一歩ずつ。<br>今日も、未来につながる学びを始めよう。@endif</p>
            <div class="login-illustration" aria-hidden="true">
                <svg viewBox="0 0 360 240" fill="none">
                    <circle cx="180" cy="120" r="110" fill="#eeeff9"/><circle cx="180" cy="120" r="88" stroke="white" stroke-width="2"/>
                    <rect x="66" y="65" width="228" height="142" rx="18" fill="#d8dbef" transform="rotate(-6 180 130)"/>
                    <rect x="62" y="51" width="228" height="142" rx="16" fill="white" stroke="#d3d8ee" stroke-width="2"/>
                    <path d="M63 81h226" stroke="#eceef7" stroke-width="2"/>
                    <circle cx="80" cy="66" r="3" fill="#efb3c2"/><circle cx="93" cy="66" r="3" fill="#efd395"/><circle cx="106" cy="66" r="3" fill="#a3d1be"/>
                    <path d="m120 111-18 16 18 16m99-32 18 16-18 16m-37-39-18 47" stroke="#848dc1" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                    <rect x="223" y="155" width="72" height="52" rx="15" fill="#7c86ba"/><path d="m245 180 10 10 18-21" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="m310 61 5 13 13 5-13 5-5 13-5-13-13-5 13-5Z" fill="#efcf8b"/><path d="m42 137 4 10 10 4-10 4-4 10-4-10-10-4 10-4Z" fill="#a7cfc3"/>
                </svg>
            </div>
        </section>
        <div><section class="login-card" aria-labelledby="login-title">{{ $slot }}</section><p class="login-footnote">SunTechAcademy · 学ぶ。その先の自分へ。</p></div>
    </main>
</body>
</html>
