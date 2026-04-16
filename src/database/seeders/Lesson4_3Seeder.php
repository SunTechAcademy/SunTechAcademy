<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson4_3Seeder extends Seeder
{
    public function run(): void
    {
        $lesson4 = Lesson::where('title', 'HTMLチュートリアル')->first();

        if (!$lesson4) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson4->id,
                'sort_order' => 3
            ],
            [
                'title' => '制作実習：全体構造を作る',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <h3 class="text-2xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2">制作実習</h3>
        <p class="text-lg leading-relaxed">
            実際にVS Code上で書いていきましょう。
        </p>
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h4 class="font-bold text-blue-900 mb-2">⚠️ 学習のポイント</h4>
            <p class="text-sm text-blue-800 mb-3">
                コピー＆ペーストをすることは、HTMLに慣れたあとであれば悪いことではないですが、<strong>まずは手を使って実際にタイピングで書く</strong>ようにしてください。その理由は以下の2点です。
            </p>
            <ul class="list-disc ml-6 space-y-1 text-sm text-blue-800 font-bold">
                <li>きちんとHTMLを認識する</li>
                <li>タイピングミスがあり得ることを学ぶ</li>
            </ul>
        </div>
    </section>

    <section class="space-y-8">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            Webページの全体構造（大枠）を作る
        </h4>
        
        <div class="space-y-4">
            <p>今回作成するページは、以下のような構造とします。</p>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                <img src="/images/Lesson4-3.png" alt="Webページの全体構造" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x400.png?text=Lesson4-3.png%0A(Webページの全体構造)\'">
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">1. DOCTYPEとhtml要素</h5>
            <p>まずはWebページの大枠を作ります。その第一歩として、 <code>DOCTYPE</code> と <code>&lt;html&gt;</code> を用意します。</p>
            <p>VS Code上で <strong>kitchen.html</strong> を作成し、下記の通り記述してください。</p>
            
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html</div>
                <pre class="p-4 text-sm text-green-400 font-mono overflow-x-auto"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;/html&gt;</code></pre>
            </div>
            <p class="text-sm text-gray-600">
                html要素の <code>lang="ja"</code> 属性を指定すると、「このHTML文書は日本語で書きます」ということを示すことができます。
            </p>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">2. head要素とbody要素</h5>
            <p>次に <code>head</code> 要素と <code>body</code> 要素を追記します。</p>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                <img src="/images/Lesson4-4.png" alt="head要素とbody要素" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/600x300.png?text=Lesson4-4.png%0A(head要素とbody要素の構造)\'">
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">3. header要素（ヘッダー）</h5>
            <p>ここまででWebページの最低限のHTMLが用意できました。続いて、先ほど確認した構造をもとに、headerなどの各部分を追記します。</p>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center mb-4">
                <p class="text-sm text-gray-500 mb-2">（再掲）</p>
                <img src="/images/Lesson4-5.png" alt="全体構造の再掲" class="max-w-full h-auto mx-auto rounded shadow-sm mb-4" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x200.png?text=Lesson4-5.png%0A(全体構造の再掲)\'">
                <img src="/images/Lesson4-6.png" alt="header要素" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x150.png?text=Lesson4-6.png%0A(header要素部分)\'">
            </div>
            <p>まずは <code>header</code> 要素を追記します。</p>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    <span class="text-green-400">&lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;TechAcademy KITCHEN&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;!--ここからヘッダー--&gt;
        &lt;header&gt;
        &lt;/header&gt;
        &lt;!--ヘッダーここまで--&gt;
    &lt;/body&gt;</span>
&lt;/html&gt;</code></pre>
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">4. div要素（main_visual）</h5>
            <p>メインビジュアルには、アイキャッチ（閲覧者の目を引くためのコンテンツ）として、大きめの画像が入ります。今回つくるページでは、「健やかな健康と豊かな食生活をはじめる」と書かれた画像がメインビジュアルです。</p>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center mb-4">
                <img src="/images/Lesson4-7.png" alt="メインビジュアル画像" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x250.png?text=Lesson4-7.png%0A(メインビジュアル画像部分)\'">
            </div>
            <p>メインビジュアル用の <code>div</code> 要素を追記します。</p>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;!--ここからヘッダー--&gt;
        &lt;header&gt;
        &lt;/header&gt;
        &lt;!--ヘッダーここまで--&gt;

        <span class="text-green-400">&lt;!--ここからメインビジュアル画像--&gt;
        &lt;div id="main_visual"&gt;
        &lt;/div&gt;
        &lt;!--メインビジュアル画像ここまで--&gt;</span>
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">5. div要素（wrapper）</h5>
            <p>
                続いて、<strong>メインエリア</strong> と <strong>サイドバー</strong> です。これらはdiv要素を使って書きます。また、ここでは <strong>wrapper（ラッパー）</strong> と呼ばれる親領域を用意し、その中にメインエリアとサイドバーを入れる形式にします。<br>
                wrap（ラップ）に由来しているwrapperは、全体にかかる大きな要素という意味でよく使われます。div要素には <code>id="wrapper"</code> というid属性を使用する形式で、wrapperを用意します。
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div class="bg-gray-50 p-2 rounded border border-gray-200 text-center">
                    <img src="/images/Lesson4-8.png" alt="メインエリア1" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/300x200.png?text=Lesson4-8.png%0A(メインエリア1)\'">
                </div>
                <div class="bg-gray-50 p-2 rounded border border-gray-200 text-center">
                    <img src="/images/Lesson4-9.png" alt="メインエリア2" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/300x200.png?text=Lesson4-9.png%0A(メインエリア2)\'">
                </div>
                <div class="bg-gray-50 p-2 rounded border border-gray-200 text-center">
                    <img src="/images/Lesson4-10.png" alt="サイドバー" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/300x200.png?text=Lesson4-10.png%0A(サイドバー)\'">
                </div>
            </div>
            <p>では、id属性がwrapperのdiv要素を追記します。</p>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;!--ここからメインビジュアル画像--&gt;
        &lt;div id="main_visual"&gt;
        &lt;/div&gt;
        &lt;!--メインビジュアル画像ここまで--&gt;

        <span class="text-green-400">&lt;!--ここからwrapper--&gt;
        &lt;div id="wrapper"&gt;
        &lt;/div&gt;
        &lt;!--wrapperここまで--&gt;</span>
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">6. footer要素（フッター）</h5>
            <p>以下の部分が <code>footer</code> 要素になります。</p>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center mb-4">
                <img src="/images/Lesson4-11.png" alt="フッター部分" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x150.png?text=Lesson4-11.png%0A(フッター部分)\'">
            </div>
            <p>footer要素を追記します。これがここまでの完成形です。</p>
            <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-lg relative">
                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">最終形</div>
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;TechAcademy KITCHEN&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;!--ここからヘッダー--&gt;
        &lt;header&gt;
        &lt;/header&gt;
        &lt;!--ヘッダーここまで--&gt;

        &lt;!--ここからメインビジュアル画像--&gt;
        &lt;div id="main_visual"&gt;
        &lt;/div&gt;
        &lt;!--メインビジュアル画像ここまで--&gt;

        &lt;!--ここからwrapper--&gt;
        &lt;div id="wrapper"&gt;
        &lt;/div&gt;
        &lt;!--wrapperここまで--&gt;

        <span class="text-green-400">&lt;!--ここからフッター--&gt;
        &lt;footer&gt;
        &lt;/footer&gt;
        &lt;!--フッターここまで--&gt;</span>
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
            </div>
        </div>

        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 mt-8">
            <h4 class="font-bold text-lg text-indigo-900 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                ブラウザで確認してみよう
            </h4>
            <p class="text-sm text-indigo-800 leading-relaxed">
                作成した <strong>kitchen.html</strong> をChromeなどのブラウザにドラッグ＆ドロップして、HTML文書を表示させてみましょう。<br>
                といっても、この状態では骨組みのタグ（箱）を用意しただけなので、画面は白紙のままであり何も表示されません。<br>
                <code>&lt;body&gt;</code> 要素内のどこかに適当な文字を入力して保存し、ブラウザを更新（リロード）すれば、その文字が表示されることが確認できます。
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}