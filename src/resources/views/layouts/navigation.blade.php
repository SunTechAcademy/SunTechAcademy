@php
    $navigationItems = [
        ['route' => 'dashboard', 'label' => 'マイコース', 'active' => request()->routeIs('dashboard')],
        ['route' => 'courses.beginner', 'label' => '初級 · エンジニア基礎', 'active' => request()->routeIs('courses.beginner', 'lessons.*')],
        ['route' => 'courses.intermediate.index', 'label' => '中級 · 実務スキル', 'active' => request()->routeIs('courses.intermediate.*')],
    ];
@endphp
<nav class="member-header" aria-label="メインナビゲーション">
    <div class="member-header-inner">
        <a href="{{ route('dashboard') }}" class="member-brand" aria-label="SunTechAcademy マイコース">
            <img src="{{ asset('images/SunTechAcademy.png') }}" alt="SunTechAcademy">
        </a>
        <div class="member-nav-links">
            @foreach($navigationItems as $item)
                <a href="{{ route($item['route']) }}" class="member-nav-link" @if($item['active']) aria-current="page" @endif>{{ $item['label'] }}</a>
            @endforeach
        </div>
        <div class="member-header-actions">
            <details class="member-account" data-header-menu>
                <summary class="member-account-trigger">
                    <span class="member-avatar" aria-hidden="true">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                    <span class="member-account-name">{{ Auth::user()->name }}</span>
                    <span class="member-sr-only">アカウントメニュー</span>
                    <svg class="member-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </summary>
                <div class="member-account-panel">
                    <div class="member-account-info"><strong>{{ Auth::user()->name }}</strong><span>{{ Auth::user()->email }}</span></div>
                    @if(!Auth::guard('admin')->check())
                        <a href="{{ route('profile.edit') }}" class="member-account-link">プロフィール <span aria-hidden="true">↗</span></a>
                    @endif
                    <a href="{{ route('referral') }}" class="member-account-link">お友達紹介 <span aria-hidden="true">↗</span></a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="member-account-link member-logout">ログアウト <span aria-hidden="true">→</span></button>
                    </form>
                </div>
            </details>
            <details class="member-mobile-menu" data-header-menu>
                <summary class="member-mobile-trigger" aria-label="コースメニュー">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round"/></svg>
                </summary>
                <div class="member-mobile-panel">
                    <p>学びのステップ</p>
                    @foreach($navigationItems as $item)
                        <a href="{{ route($item['route']) }}" class="member-nav-link" @if($item['active']) aria-current="page" @endif>{{ $item['label'] }} <span aria-hidden="true">→</span></a>
                    @endforeach
                </div>
            </details>
        </div>
    </div>
</nav>
<style>
    .member-header { position: relative; z-index: 30; width: 100%; background: #fff; border-bottom: 1px solid #eef0f6; }
    .member-header-inner { max-width: 1280px; margin: auto; min-height: 84px; padding: 16px 32px; display: flex; align-items: center; gap: 32px; }
    .member-brand { flex-shrink: 0; border-radius: 8px; }
    .member-brand img { display: block; width: auto; height: auto; max-width: 190px; max-height: 42px; }
    .member-nav-links { display: flex; align-items: center; gap: 6px; }
    .member-nav-link { display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 11px; color: #798096; font-size: 12px; font-weight: 600; text-decoration: none; white-space: nowrap; transition: background-color .2s, color .2s; }
    .member-nav-link:hover { background: #f6f7fb; color: #525e94; }
    .member-nav-link[aria-current="page"] { background: #eef0fa; color: #59649e; }
    .member-header-actions { margin-left: auto; display: flex; align-items: center; gap: 10px; }
    .member-account { position: relative; }
    .member-header summary { list-style: none; cursor: pointer; }
    .member-header summary::-webkit-details-marker { display: none; }
    .member-account-trigger { display: flex; align-items: center; gap: 10px; padding: 5px 9px 5px 5px; border-radius: 28px; color: #626b85; transition: background-color .2s; }
    .member-account-trigger:hover, .member-account[open] .member-account-trigger { background: #f3f4fa; }
    .member-avatar { width: 36px; height: 36px; flex-shrink: 0; display: grid; place-items: center; border-radius: 50%; background: linear-gradient(135deg, #e9eafa, #dce3f5); color: #6873a8; font-size: 14px; font-weight: 700; }
    .member-account-name { max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 12px; font-weight: 600; }
    .member-chevron { transition: transform .2s; }
    .member-account[open] .member-chevron { transform: rotate(180deg); }
    .member-account-panel, .member-mobile-panel { position: absolute; top: calc(100% + 12px); right: 0; width: 260px; max-width: calc(100vw - 32px); border: 1px solid #e8eaf3; border-radius: 18px; padding: 8px; background: white; box-shadow: 0 16px 48px #30344d1a; animation: member-menu-in .18s ease-out; }
    .member-account-info { padding: 12px; margin-bottom: 6px; border-bottom: 1px solid #eef0f6; overflow-wrap: anywhere; }
    .member-account-info strong { display: block; font-size: 13px; color: #404962; }
    .member-account-info > span { display: block; margin-top: 4px; font-size: 11px; color: #9097a8; }
    .member-account-link { display: flex; align-items: center; justify-content: space-between; width: 100%; text-align: left; padding: 12px; border-radius: 10px; font-size: 12px; color: #68728b; transition: background-color .2s; }
    .member-account-link:hover { background: #f3f4fa; }
    .member-logout { color: #aa6476; }
    .member-logout:hover { background: #fff2f5; }
    .member-mobile-menu { display: none; }
    .member-mobile-trigger { display: grid; place-items: center; width: 44px; height: 44px; background: #f3f4fa; border-radius: 12px; color: #6974a7; }
    .member-mobile-panel { top: calc(100% - 2px); right: 16px; }
    .member-mobile-panel p { padding: 10px 12px; font-size: 10px; letter-spacing: .1em; color: #9ba2b4; }
    .member-mobile-panel .member-nav-link { justify-content: space-between; margin-bottom: 4px; }
    .member-header a:focus-visible, .member-header summary:focus-visible, .member-header button:focus-visible { outline: 3px solid #b3bae1; outline-offset: 3px; }
    .member-sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip-path: inset(50%); white-space: nowrap; }
    @keyframes member-menu-in { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: none; } }
    @media (max-width: 1023px) { .member-header-inner { padding: 14px 20px; min-height: 76px; gap: 16px; } .member-nav-links { display: none; } .member-mobile-menu { display: block; } }
    @media (max-width: 480px) { .member-header-inner { padding: 12px 16px; gap: 8px; } .member-brand img { max-width: 150px; max-height: 36px; } .member-account-name, .member-chevron { display: none; } .member-header-actions { gap: 4px; } .member-account-trigger { padding: 4px; } .member-account-panel { right: -48px; } }
    @media (prefers-reduced-motion: reduce) { .member-header * { animation: none !important; transition: none !important; } }
</style>
<script>
(() => {
    const menus = [...document.querySelectorAll('[data-header-menu]')];
    menus.forEach(menu => {
        menu.addEventListener('toggle', () => {
            if (menu.open) menus.forEach(other => { if (other !== menu) other.open = false; });
        });
        menu.addEventListener('focusout', event => {
            if (event.relatedTarget && !menu.contains(event.relatedTarget)) menu.open = false;
        });
    });
    document.addEventListener('click', event => {
        menus.forEach(menu => { if (!menu.contains(event.target)) menu.open = false; });
    });
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') menus.forEach(menu => {
            if (menu.open) { menu.open = false; menu.querySelector('summary').focus(); }
        });
    });
})();
</script>
