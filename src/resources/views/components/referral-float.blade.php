@if(request()->routeIs('welcome', 'dashboard', 'courses.*', 'lessons.*') || request()->is('/'))
<aside class="referral-float" data-referral-float aria-label="お友達紹介キャンペーン" hidden>
    <button type="button" class="referral-float-close" aria-label="紹介バナーを閉じる" data-referral-close>×</button>
    <a href="{{ route('referral') }}" class="referral-float-link">
        <img src="{{ asset('images/referral/referral-site-header.jpg') }}" alt="お友達紹介キャンペーン。紹介謝礼は条件達成で最大5万円" width="1920" height="814">
        <span class="referral-float-footer"><span>お友達紹介で最大5万円<small>謝礼の内容・タイミングを見る</small></span><span aria-hidden="true">↗</span></span>
    </a>
</aside>
<style>
    .referral-float[hidden] { display: none; }
    .referral-float { position: fixed; bottom: max(20px, env(safe-area-inset-bottom)); left: 20px; width: 280px; max-width: calc(100vw - 40px); z-index: 40; border: 1px solid #e8dfdb; border-radius: 18px; background: #fff; box-shadow: 0 12px 36px #343b6524; animation: referral-float-in .4s ease-out; }
    .referral-float-link { display: block; overflow: hidden; border-radius: 18px; text-decoration: none; }
    .referral-float img { display: block; width: 100%; height: auto; }
    .referral-float-footer { display: flex; justify-content: space-between; align-items: center; gap: 12px; padding: 12px 16px; color: #735766; font-size: 12px; font-weight: 700; background: #fffaf7; transition: background .2s; }
    .referral-float-footer small { display: block; font-size: 10px; font-weight: 400; color: #95868d; margin-top: 3px; }
    .referral-float-footer > span:last-child { font-size: 22px; }
    .referral-float-link:hover .referral-float-footer { background: #fff0e8; }
    .referral-float-close { position: absolute; top: -12px; right: -12px; display: grid; place-items: center; width: 32px; height: 32px; border: 1px solid #e2dce3; border-radius: 50%; background: white; color: #7c7182; box-shadow: 0 3px 10px #343b6515; cursor: pointer; font-size: 22px; line-height: 1; }
    .referral-float-close:hover { background: #f2eef4; }
    .referral-float a:focus-visible, .referral-float button:focus-visible { outline: 3px solid #929dcb; outline-offset: 3px; }
    @keyframes referral-float-in { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: none; } }
    @media (max-width: 700px) { .referral-float { width: 260px; bottom: max(12px, env(safe-area-inset-bottom)); left: 12px; } .referral-float-link { display: flex; align-items: stretch; } .referral-float img { width: 100px; height: auto; object-fit: contain; background: #f5efeb; } .referral-float-footer { padding: 10px; font-size: 11px; gap: 8px; flex: 1; } .referral-float-footer small { font-size: 9px; } }
    @media (prefers-reduced-motion: reduce) { .referral-float { animation: none; } .referral-float-footer { transition: none; } }
</style>
<script>
(() => {
    const banner = document.querySelector('[data-referral-float]');
    const key = 'suntech-referral-dismissed-v1';
    let dismissed = false;
    try { dismissed = sessionStorage.getItem(key) === '1'; } catch (_) {}
    if (!dismissed) banner.hidden = false;
    banner.querySelector('[data-referral-close]').addEventListener('click', () => {
        banner.hidden = true;
        try { sessionStorage.setItem(key, '1'); } catch (_) {}
    });
})();
</script>
@endif
