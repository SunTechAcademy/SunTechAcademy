        <header class="welcome-header">
            <a href="/" class="welcome-brand" aria-label="SunTechAcademy トップページ">
                <img src="{{ asset('images/SunTechAcademy.png') }}" alt="SunTechAcademy">
                <span class="welcome-brand-caption">学ぶ。その先の自分へ。</span>
            </a>
            @if (Route::has('login'))
                <nav class="welcome-header-nav" aria-label="メインナビゲーション">
                    <a href="{{ auth()->check() ? url('/dashboard') : route('login') }}" class="welcome-login">
                        <span>{{ auth()->check() ? 'マイコースへ' : 'ログイン' }}</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round" /></svg>
                    </a>
                </nav>
            @endif
        </header>
        <style>
            .welcome-header { width: 100%; margin: 0 0 64px; padding: 20px max(24px, calc((100vw - 1168px) / 2)); display: flex; align-items: center; justify-content: space-between; gap: 20px; background: #fff; }
            .welcome-brand { display: flex; align-items: center; gap: 24px; min-width: 0; border-radius: 8px; }
            .welcome-brand img { display: block; width: auto; height: 42px; max-width: 210px; object-fit: contain; }
            .welcome-brand-caption { padding-left: 24px; border-left: 1px solid #e7e8f0; font-size: 11px; letter-spacing: .06em; color: #82889c; white-space: nowrap; }
            .welcome-header-nav { display: flex; align-items: center; gap: 26px; flex-shrink: 0; }
            .welcome-login { display: inline-flex; align-items: center; justify-content: center; gap: 14px; min-height: 44px; padding: 12px 20px; border-radius: 13px; background: linear-gradient(120deg, #757fba, #5e68a4); color: #fff; font-size: 13px; font-weight: 700; white-space: nowrap; box-shadow: 0 4px 12px #626ba826; transition: transform .2s, box-shadow .2s, filter .2s; }
            .welcome-login:hover { transform: translateY(-2px); filter: brightness(1.08); box-shadow: 0 8px 20px #626ba83d; }
            .welcome-login svg { transition: transform .2s; }
            .welcome-login:hover svg { transform: translateX(3px); }
            .welcome-login:active { transform: translateY(0); box-shadow: 0 2px 6px #626ba826; }
            .welcome-header a:focus-visible { outline: 3px solid #adb4e0; outline-offset: 4px; }
            @media (max-width: 900px) { .welcome-brand-caption { display: none; } }
            @media (max-width: 600px) { .welcome-header { padding: 16px; margin-bottom: 40px; gap: 12px; } .welcome-brand img { height: auto; max-height: 38px; max-width: 100%; } .welcome-login { padding: 11px 14px; gap: 8px; font-size: 12px; } }
            @media (prefers-reduced-motion: reduce) { .welcome-header a, .welcome-login svg { transition: none; } .welcome-login:hover, .welcome-login:hover svg { transform: none; } }
        </style>
