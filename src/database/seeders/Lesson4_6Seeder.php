<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson4_6Seeder extends Seeder
{
    public function run(): void
    {
        $lesson4 = Lesson::where('title', 'HTMLチュートリアル')->first();

        if (!$lesson4) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson4->id,
                'sort_order' => 6
            ],
            [
                'title' => 'メインエリアとサイドバー',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            次は <strong>メインエリア</strong> と <strong>サイドバー</strong> の部分です。
        </p>

        <h4 class="font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">枠組みを作る</h4>
        <p>ここからは <code>wrapper</code> 内に記述します。まずは、骨子として <code>main</code> と <code>sidebar</code> を配置します。それぞれ <code>div</code> と <code>aside</code> 要素を使います。</p>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;!--ここからwrapper--&gt;
        &lt;div id="wrapper"&gt;
            <span class="text-green-400">&lt;!--ここからメイン--&gt;
            &lt;div id="main"&gt;
            &lt;/div&gt;
            &lt;!--メインここまで--&gt;
            &lt;!--ここからサイド--&gt;
            &lt;aside id="sidebar"&gt;
            &lt;/aside&gt;
            &lt;!--サイドここまで--&gt;</span>
        &lt;/div&gt;
        &lt;!--wrapperここまで--&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">メインエリアの内容作成</h4>
        <p>メインの中では、中見出し（<code>h2</code>）を配置し、その下に小見出し（<code>h3</code>）を持った <code>section</code> を配置します。さらに、その全体を <code>section</code> 要素で囲みます。</p>
        
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>            &lt;!--ここからメイン--&gt;
            &lt;div id="main"&gt;
                <span class="text-green-400">&lt;section&gt;
                    &lt;h2&gt;TechAcademy KITCHENについて&lt;/h2&gt;
                    &lt;section&gt;
                        &lt;h3&gt;食卓を豊かにしたい&lt;/h3&gt;
                    &lt;/section&gt;
                &lt;/section&gt;</span>
            &lt;/div&gt;</code></pre>
        </div>

        <h5 class="font-bold text-gray-800 mt-6">本文と画像の配置（figure要素）</h5>
        <p><code>h3</code> 要素の下に本文を配置します。読みやすいように <code>br</code> 要素で適宜改行を入れます。また、写真は <code>figure</code> 要素で囲み、キャプション（説明文）を <code>figcaption</code> 要素で記述します。</p>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center my-4">
            <img src="/images/Lesson4-16.png" alt="figure要素のイメージ" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/18/6A73A6/ffffff/500x300.png?text=Lesson4-16.png%0A(figure要素の活用)\'">
        </div>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-md">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (完成イメージ：2段目まで追加)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>            &lt;div id="main"&gt;
                &lt;section&gt;
                    &lt;h2&gt;TechAcademy KITCHENについて&lt;/h2&gt;
                    &lt;!-- 1段目 --&gt;
                    &lt;section&gt;
                        &lt;h3&gt;食卓を豊かにしたい&lt;/h3&gt;
                        &lt;div class="point"&gt;
                            &lt;p&gt;健やかな人生は健やかな食生活から&lt;br&gt;上手に料理が作れるだけでなく...&lt;/p&gt;
                            &lt;figure&gt;
                                &lt;img src="images_kitchen/photo01.jpg" alt="食事"&gt;
                                &lt;figcaption&gt;健康バランスを考えた食事&lt;/figcaption&gt;
                            &lt;/figure&gt;
                        &lt;/div&gt;
                    &lt;/section&gt;
                    <span class="text-green-400">&lt;!-- 2段目 --&gt;
                    &lt;section&gt;
                        &lt;h3&gt;豊かな食生活を応援したい&lt;/h3&gt;
                        &lt;div class="point"&gt;
                            &lt;p&gt;食は文化の数だけあります。食生活が豊かだと...&lt;/p&gt;
                            &lt;figure&gt;
                                &lt;img src="images_kitchen/photo02.jpg" alt="作品"&gt;
                                &lt;figcaption&gt;完成間近の作品&lt;/figcaption&gt;
                            &lt;/figure&gt;
                        &lt;/div&gt;
                    &lt;/section&gt;</span>
                &lt;/section&gt;
            &lt;/div&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">お知らせの追加</h4>
        <p>「TechAcademy KITCHENについて」の <code>section</code> 要素のすぐ下に、<code>news</code> というID名を指定した新しい <code>section</code> 要素を作成します。</p>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>                <span class="text-green-400">&lt;section id="news"&gt;
                    &lt;h2&gt;お知らせ&lt;/h2&gt;
                    &lt;ul&gt;
                        &lt;li&gt;&lt;span&gt;2018/09/01&lt;/span&gt;&lt;a href="course.html"&gt;講座案内を更新しました&lt;/a&gt;&lt;/li&gt;
                        &lt;li&gt;&lt;span&gt;2018/08/31&lt;/span&gt;&lt;a href="gallery.html"&gt;写真を追加しました&lt;/a&gt;&lt;/li&gt;
                        &lt;li&gt;&lt;span&gt;2018/08/24&lt;/span&gt;&lt;a href="course.html"&gt;講座案内を更新しました&lt;/a&gt;&lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/section&gt;</span></code></pre>
        </div>
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
            <p class="text-xs text-gray-500 mb-2">表示イメージ（HTMLのみ）</p>
            <img src="/images/Lesson4-19.png" alt="お知らせの表示確認" class="max-w-full h-auto mx-auto rounded border" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/600x200.png?text=Lesson4-19.png%0A(お知らせのHTML表示)\'">
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">サイドバー</h4>
        <p>サイドバーは <code>aside</code> 要素で書き、ID名を「sidebar」として配置します。関連リンクをリスト形式（<code>ul</code>, <code>li</code>）で作成しましょう。</p>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>            &lt;!--ここからサイド--&gt;
            &lt;aside id="sidebar"&gt;
                <span class="text-green-400">&lt;section id="side_banner"&gt;
                    &lt;h2&gt;関連リンク&lt;/h2&gt;
                    &lt;ul&gt;
                        &lt;li&gt;
                            &lt;a href="https://techacademy.jp/magazine/" target="_blank"&gt;&lt;img src="images_kitchen/banner01.jpg" alt="ブログ"&gt;&lt;/a&gt;
                            &lt;p&gt;毎日季節の野菜を取り入れたレシピを公開中。&lt;/p&gt;
                        &lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/section&gt;</span>
            &lt;/aside&gt;</code></pre>
        </div>
        
        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 text-sm text-indigo-900 mt-4">
            <h5 class="font-bold mb-1">🔍 確認ポイント</h5>
            <p>ブラウザで確認した際、画像の前に黒丸（リストマーク）がつきますが、これはHTMLの仕様です。後ほどCSSで外しますので、今はそのままでOKです！</p>
        </div>
    </section>

    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 text-center">
        <img src="/images/Lesson4-21.png" alt="メインとサイドの完成" class="max-w-full h-auto mx-auto rounded shadow-sm border border-gray-300" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x400.png?text=Lesson4-21.png%0A(メイン・サイド完成確認)\'">
    </div>
</div>'
            ]
        );
    }
}