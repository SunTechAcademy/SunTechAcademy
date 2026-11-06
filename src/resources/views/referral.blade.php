<x-dynamic-component :component="auth()->check() ? 'app-layout' : 'public-layout'">
    <div class="referral-page">
        <div class="referral-container">
            <a class="referral-back" href="{{ auth()->check() ? route('dashboard') : url('/') }}">← {{ auth()->check() ? 'マイコースへ' : 'トップへ' }}</a>
            <header class="referral-hero">
                <p class="referral-eyebrow">GROW TOGETHER</p>
                <h1>つながりから、<br class="referral-mobile-break">次のチャンスを。</h1>
                <p>大切なお友達と、新しい一歩を。<br>お友達紹介キャンペーンをご案内します。</p>
                <img src="{{ asset('images/referral/referral-site-header.jpg') }}" alt="お友達紹介キャンペーン。お友達1人につき、条件達成で最大5万円の紹介謝礼" width="1920" height="814" fetchpriority="high">
            </header>
            <section class="referral-rewards" aria-labelledby="reward-title">
                <p class="referral-eyebrow">A LITTLE THANK YOU</p>
                <h2 id="reward-title">ご紹介への感謝を、<strong>最大50,000円</strong>の謝礼に。</h2>
                <p class="referral-copy">紹介されたお友達の稼働条件に応じて、紹介者へ2回に分けてお渡しします。</p>
                <div class="referral-reward-grid">
                    <article class="referral-reward"><span class="referral-step">FIRST REWARD</span><h3>2ヶ月の稼働条件を達成</h3><p class="referral-amount">10,000<span>円</span></p><p class="referral-copy">最初の条件達成で、紹介者へ1万円。</p></article>
                    <article class="referral-reward"><span class="referral-step">SECOND REWARD</span><h3>4ヶ月の稼働条件を達成</h3><p class="referral-amount">40,000<span>円</span></p><p class="referral-copy">さらに条件達成で、追加の4万円。</p></article>
                </div>
                <p class="referral-note">紹介されたお友達の稼働条件の達成に応じて、謝礼をお渡しします。</p>
            </section>
            <section class="referral-flow" aria-labelledby="flow-title">
                <p class="referral-eyebrow">HOW IT WORKS</p><h2 id="flow-title">紹介から謝礼までの流れ。</h2>
                <figure class="referral-flow-image"><img src="{{ asset('images/referral/referral-reward-flow.jpg') }}" alt="稼働条件を満たして2ヶ月後に1万円、4ヶ月後に追加4万円。翌月給与と一緒に振込" width="1920" height="865" loading="lazy"></figure>
            </section>
            <footer class="referral-footer"><p class="referral-eyebrow">LET'S GROW TOGETHER</p><h2>あなたの紹介が、<br>誰かの新しい一歩になる。</h2></footer>
        </div>
    </div>
    <style>
        .referral-page { padding: 36px 24px 64px; background: #fbf9f7; color: #45425a; }
        .referral-container { max-width: 1040px; margin: auto; }
        .referral-back { font-size: 12px; color: #9290a2; }
        .referral-back:hover { color: #65628b; }
        .referral-hero { text-align: center; padding-top: 30px; }
        .referral-eyebrow { color: #ba817a; font-size: 10px; letter-spacing: .2em; font-weight: 800; margin-bottom: 14px; }
        .referral-hero h1 { font-size: clamp(28px, 4vw, 42px); font-weight: 800; letter-spacing: -.04em; line-height: 1.6; }
        .referral-hero > p:not(.referral-eyebrow) { font-size: 13px; color: #9290a1; line-height: 2; margin-top: 18px; }
        .referral-hero img { width: 100%; height: auto; border-radius: 24px; margin: 32px 0 0; box-shadow: 0 10px 36px #7655460a; }
        .referral-mobile-break { display: none; }
        .referral-rewards, .referral-flow { padding: 60px 0 0; }
        .referral-page h2 { font-size: clamp(21px, 2.5vw, 28px); font-weight: 700; line-height: 1.7; letter-spacing: -.03em; }
        .referral-rewards h2 strong { color: #b77977; }
        .referral-copy { color: #8e8b9c; font-size: 13px; line-height: 2; margin-top: 12px; }
        .referral-reward-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 26px; }
        .referral-reward { border: 1px solid #eee4e4; border-radius: 22px; background: linear-gradient(135deg, #fff, #fff4ee); padding: 28px; }
        .referral-reward:nth-child(2) { background: linear-gradient(135deg, #fff, #f4effc); border-color: #e8e2f1; }
        .referral-step { font-size: 9px; letter-spacing: .15em; color: #b58e8b; }
        .referral-reward h3 { margin-top: 16px; font-size: 15px; font-weight: 600; }
        .referral-amount { font-size: 48px; font-weight: 800; letter-spacing: -.04em; color: #b97e77; margin: 10px 0; }
        .referral-reward:nth-child(2) .referral-amount { color: #9680b6; }
        .referral-amount span { font-size: 16px; margin-left: 6px; }
        .referral-note { font-size: 11px; color: #a19aa6; line-height: 1.9; margin-top: 16px; }
        .referral-flow-image { margin-top: 22px; border: 1px solid #ebe5e5; border-radius: 14px; overflow: hidden; background: white; }
        .referral-flow-image img { display: block; width: 100%; height: auto; }
        .referral-footer { text-align: center; padding-top: 64px; }
        .referral-footer h2 { margin-bottom: 26px; }
        .referral-page a:focus-visible { outline: 3px solid #aab1d8; outline-offset: 4px; }
        @media (max-width: 600px) { .referral-page { padding: 24px 16px 48px; } .referral-mobile-break { display: block; } .referral-reward-grid { grid-template-columns: 1fr; gap: 12px; } .referral-hero img { border-radius: 14px; } .referral-rewards, .referral-flow { padding-top: 36px; } }
    </style>
</x-dynamic-component>
