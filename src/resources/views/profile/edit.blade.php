<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">プロフィール</h2>
    </x-slot>
    <div class="profile-page">
        <div class="profile-heading">
            <p>YOUR ACCOUNT</p>
            <h1>あなたの学びを、あなたらしく。</h1>
            <span>プロフィールやログイン情報を、ここで管理できます。</span>
        </div>
        <div class="profile-layout">
            <aside class="profile-overview" aria-label="アカウント概要">
                <div class="profile-avatar" aria-hidden="true">{{ mb_substr($user->name, 0, 1) }}</div>
                <h2>{{ $user->name }}</h2>
                <p class="profile-email">{{ $user->email }}</p>
                <div class="profile-member-label">SunTechAcademy メンバー</div>
                <nav aria-label="プロフィール設定">
                    <a href="#profile-information"><span>プロフィール情報</span><span aria-hidden="true">↗</span></a>
                    <a href="#profile-password"><span>パスワード変更</span><span aria-hidden="true">↗</span></a>
                </nav>
                <a class="profile-back" href="{{ route('dashboard') }}">← マイコースへ戻る</a>
            </aside>
            <div class="profile-panels">
                <div id="profile-information" class="profile-panel">
                    <div class="profile-section-label"><span aria-hidden="true">01</span> PERSONAL INFORMATION</div>
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div id="profile-password" class="profile-panel">
                    <div class="profile-section-label"><span aria-hidden="true">02</span> ACCOUNT SECURITY</div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
    <style>
        .profile-page { padding: 44px 32px 64px; background: radial-gradient(ellipse at top left, #eeeffa, transparent 50%), #f7f8fc; }
        .profile-heading, .profile-layout { max-width: 1080px; margin: auto; }
        .profile-heading { margin-bottom: 32px; }
        .profile-heading > p { font-size: 10px; font-weight: 800; letter-spacing: .18em; color: #828bb6; margin-bottom: 12px; }
        .profile-heading h1 { font-size: 26px; letter-spacing: -.035em; font-weight: 700; color: #343c55; margin-bottom: 12px; }
        .profile-heading > span { font-size: 13px; line-height: 1.9; color: #7d8598; }
        .profile-layout { display: grid; grid-template-columns: 280px minmax(0, 1fr); align-items: start; gap: 28px; }
        .profile-overview { padding: 30px 24px; background: #ffffffd9; border: 1px solid #e6e8f1; border-radius: 22px; text-align: center; }
        .profile-avatar { display: grid; place-items: center; width: 72px; height: 72px; margin: 0 auto 16px; border-radius: 24px; background: linear-gradient(135deg, #e7e9fa, #dce4f4); color: #6c78ad; font-size: 27px; font-weight: 700; box-shadow: 0 6px 20px #747eae12; }
        .profile-overview h2 { color: #414b65; font-weight: 700; font-size: 17px; overflow-wrap: anywhere; }
        .profile-email { color: #9299a9; font-size: 11px; margin-top: 6px; overflow-wrap: anywhere; }
        .profile-member-label { display: inline-block; padding: 5px 9px; border-radius: 7px; margin: 18px 0 24px; background: #f1f2fa; color: #7c86ae; font-size: 10px; }
        .profile-overview nav { border-top: 1px solid #eef0f6; padding-top: 14px; }
        .profile-overview nav a { display: flex; justify-content: space-between; align-items: center; padding: 13px 10px; border-radius: 9px; color: #68748e; font-size: 12px; transition: background .2s; }
        .profile-overview nav a:hover { background: #f0f2fa; color: #58669e; }
        .profile-back { display: block; margin-top: 20px; color: #9198a9; font-size: 11px; }
        .profile-back:hover { color: #58669e; }
        .profile-panels { display: grid; gap: 24px; min-width: 0; }
        .profile-panel { scroll-margin-top: 24px; padding: 32px 36px; background: white; border: 1px solid #e7e9f2; border-radius: 22px; box-shadow: 0 8px 32px #30344d04; }
        .profile-section-label { display: flex; align-items: center; gap: 9px; font-size: 9px; font-weight: 700; letter-spacing: .1em; color: #8c95b6; margin-bottom: 18px; }
        .profile-section-label span { display: grid; place-items: center; width: 28px; height: 28px; border-radius: 9px; color: #7a85b4; background: #f0f2fa; font-size: 10px; }
        .profile-panel header h2 { font-size: 19px; font-weight: 700; color: #3d4760; }
        .profile-panel header p { font-size: 12px; line-height: 1.9; color: #8a92a3; margin-top: 8px; }
        .profile-panel label { color: #626e87; font-size: 12px; font-weight: 600; margin-bottom: 8px; }
        .profile-panel input { border: 1px solid #dfe3ed; background: #fbfcfe; border-radius: 11px; padding: 13px 15px; box-shadow: none; color: #3d4760; font-size: 14px; transition: border-color .2s, box-shadow .2s; }
        .profile-panel input:focus { outline: none; border-color: #909aca; box-shadow: 0 0 0 4px #eff1fa; background: white; }
        .profile-save { display: inline-flex; align-items: center; justify-content: center; gap: 16px; padding: 13px 20px; min-height: 46px; border-radius: 11px; background: linear-gradient(120deg, #7983bb, #636da7); color: white; font-size: 12px; font-weight: 700; box-shadow: 0 4px 12px #626ba824; transition: transform .2s, box-shadow .2s; }
        .profile-save:hover { transform: translateY(-1px); box-shadow: 0 7px 18px #626ba835; }
        .profile-form-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 16px; border-top: 1px solid #f0f1f6; padding-top: 22px; }
        .profile-saved { font-size: 12px; color: #4f8a79; padding: 8px 12px; border-radius: 8px; background: #edf7f3; }
        .profile-page a:focus-visible, .profile-page button:focus-visible { outline: 3px solid #b3bae1; outline-offset: 3px; }
        @media (max-width: 800px) { .profile-page { padding: 28px 16px 40px; } .profile-layout { grid-template-columns: 1fr; gap: 20px; } .profile-heading h1 { font-size: 22px; } .profile-panel { padding: 26px 22px; } .profile-overview { padding: 24px; } .profile-overview nav { display: flex; gap: 8px; } .profile-overview nav a { flex: 1; gap: 8px; } }
        @media (prefers-reduced-motion: reduce) { .profile-page * { transition: none !important; } .profile-save:hover { transform: none; } }
    </style>
</x-app-layout>
