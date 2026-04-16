<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson4_7Seeder extends Seeder
{
    public function run(): void
    {
        $lesson4 = Lesson::where('title', 'HTMLチュートリアル')->first();

        if (!$lesson4) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson4->id,
                'sort_order' => 7
            ],
            [
                'title' => 'フッターの作成',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            <strong>フッター</strong> とはWebページの下端に設けられたエリアです。
        </p>
        <p class="text-gray-700">
            表示する情報に決まりはありませんが、ナビゲーションリンク、著作権（コピーライト）、お問い合わせ、サイトマップなどを表示するケースが多いです。
        </p>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
            <img src="/images/Lesson4-22.png" alt="フッターのイメージ" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x150.png?text=Lesson4-22.png%0A(フッターの完成イメージ)\'">
            <p class="text-xs text-gray-500 mt-2">※画像はCSSが適用された状態です。</p>
        </div>
        <p>今回のフッターには、<strong>ナビゲーション</strong> と <strong>コピーライト</strong> の2つを掲載します。</p>
    </section>

    <section class="space-y-4">
        <h4 class="font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">ナビゲーション</h4>
        <p>フッター内のナビゲーションも、リスト形式（<code>ul</code>, <code>li</code>）で作成します。ID名には <code>footer_navi</code> を指定しましょう。</p>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;!--wrapperここまで--&gt;
        &lt;!--ここからフッター--&gt;
        &lt;footer&gt;
            <span class="text-green-400">&lt;div id="footer_navi"&gt;
                &lt;ul&gt;
                    &lt;li&gt;&lt;a href="kitchen.html"&gt;HOME&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="course.html"&gt;講座案内&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="lesson.html"&gt;レッスン&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="gallery.html"&gt;ギャラリー&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="access.html"&gt;アクセス&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="contact.html"&gt;お問い合わせ&lt;/a&gt;&lt;/li&gt;
                &lt;/ul&gt;
            &lt;/div&gt;</span>
        &lt;/footer&gt;
        &lt;!--フッターここまで--&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">コピーライト</h4>
        <p>
            次にコピーライト（著作権表示）を記述します。<code>&amp;copy;</code> と書くことで、Webブラウザ上では「©」という記号が表示されます。
        </p>
        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 text-sm text-indigo-900">
            <p><strong>💡 small要素の役割：</strong></p>
            <p class="mt-1">
                <code>small</code> 要素は、かつては「文字を小さくする」ためのタグでしたが、現在は <strong>著作権・ライセンス表記などの注釈や細目</strong> を表すために使用されます。
            </p>
        </div>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-md">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (完成形)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;footer&gt;
            &lt;div id="footer_navi"&gt;
                &lt;ul&gt;
                    &lt;li&gt;&lt;a href="kitchen.html"&gt;HOME&lt;/a&gt;&lt;/li&gt;
                    &lt;!-- ...中略... --&gt;
                    &lt;li&gt;&lt;a href="contact.html"&gt;お問い合わせ&lt;/a&gt;&lt;/li&gt;
                &lt;/ul&gt;
            &lt;/div&gt;
            <span class="text-green-400">&lt;small&gt;&amp;copy; 2018 TechAcademy KITCHEN.&lt;/small&gt;</span>
        &lt;/footer&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            全体の表示を確認しよう
        </h4>
        <p>追記・保存したら、ブラウザで最終的な表示を確認してみましょう。</p>
        
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center mt-4">
            <img src="/images/Lesson4-23.png" alt="最終的な表示確認" class="max-w-full h-auto mx-auto rounded shadow-sm border border-gray-300" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x600.png?text=Lesson4-23.png%0A(HTMLチュートリアル完了！)\'">
        </div>
        
        <div class="mt-8 p-6 bg-green-50 rounded-2xl border-2 border-green-200 text-center">
            <h5 class="text-2xl font-bold text-green-800 mb-2">🎉 お疲れ様でした！</h5>
            <p class="text-green-700">
                これで1枚のWebページの「骨組み（HTML）」がすべて完成しました。<br>
                今はまだ縦一列に並んでいてデザインもありませんが、次のレッスンから <strong>CSS</strong> を学んで、これを見栄えの良いWebサイトに整えていきます。
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}