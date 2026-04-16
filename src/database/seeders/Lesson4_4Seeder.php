<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson4_4Seeder extends Seeder
{
    public function run(): void
    {
        $lesson4 = Lesson::where('title', 'HTMLチュートリアル')->first();

        if (!$lesson4) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson4->id,
                'sort_order' => 4
            ],
            [
                'title' => 'ヘッダーの作成',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            先ほどのチャプターで、Webページの大枠の骨組みができました。続いては骨組みの中身を作っていきます。<br>
            まずは <strong>ヘッダー</strong> です。ヘッダーの要素は、<strong>ロゴ</strong> と <strong>グローバルナビゲーション</strong> の2つです。
        </p>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
            <img src="/images/Lesson4-12.png" alt="ヘッダーの構成" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x200.png?text=Lesson4-12.png%0A(ヘッダー：ロゴとナビゲーション)\'">
            <p class="text-xs text-gray-500 mt-2">※画像はCSSが適用された状態です。HTMLでのゴールは後ほど紹介します。</p>
        </div>
    </section>

    <section class="space-y-6 bg-blue-50 p-6 rounded-xl border border-blue-100">
        <h4 class="font-bold text-xl text-blue-900 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            画像素材の準備
        </h4>
        <p class="text-sm text-blue-800">
            ここから画像を表示するため、画像素材（ロゴだけでなく、本レッスンで使用するものすべて）を配布します。
        </p>
        
        <div class="text-center my-4">
            <a href="https://techacademy.s3.amazonaws.com/bootcamp/first-programming/html-css/images_kitchen.zip" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                画像素材 (.zip) をダウンロード
            </a>
        </div>

        <div class="space-y-3 text-sm text-blue-900">
            <p><strong>手順：</strong></p>
            <ol class="list-decimal ml-6 space-y-2">
                <li>上記のダウンロードしたファイルは、Zipファイルとなっています。まずはZipファイルをダブルクリックして解凍します。<br>
                <span class="text-xs text-gray-500">（Windowsユーザでダブルクリックしても解凍できない場合は、エクスプローラ上の「すべて展開」ボタンをクリックしてください）</span></li>
                <li>Zipファイルから「<strong>images_kitchen</strong>」フォルダが現れるので、これをVS Codeなどの <strong>作業中のフォルダ（エクスプローラー領域）</strong> 上にドラッグ＆ドロップしましょう。</li>
            </ol>
            <div class="mt-4 text-center">
                <img src="/images/Lesson4-13.png" alt="フォルダの配置" class="max-w-full h-auto mx-auto border border-gray-300 rounded" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/300x200.png?text=Lesson4-13.png%0A(VSCodeへの配置イメージ)\'">
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            ロゴを配置する
        </h4>
        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 text-sm text-yellow-800">
            <p><strong>💡 注意事項：</strong> ここからは <code>&lt;header&gt;</code> 要素以外を省略して掲載しています。<code>&lt;!-- ここからヘッダー --&gt;</code> や <code>&lt;header&gt;</code> など、<code>kitchen.html</code> 内で一度しか使用されないコメントやタグを目印に、HTMLを書き加えていってください。</p>
        </div>

        <div class="space-y-4">
            <p>まずは、下記のように <code>header</code> 要素内に <code>img</code> 要素を追記すると、ロゴ画像が表示されます。</p>
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;!--ここからヘッダー--&gt;
        &lt;header&gt;
            <span class="text-green-400">&lt;img src="images_kitchen/logo.png" alt="TechAcademy KITCHEN"&gt;</span>
        &lt;/header&gt;
        &lt;!--ヘッダーここまで--&gt;</code></pre>
            </div>
        </div>

        <div class="space-y-4">
            <p>次は、ロゴを <code>&lt;h1&gt;</code> と <code>&lt;a&gt;</code> で囲みます。</p>
            <ul class="list-disc ml-6 space-y-1 text-sm text-gray-700">
                <li><code>h1</code> は、指定した部分が見出しとして使用されることを明示します。</li>
                <li><code>a</code> は、指定した部分がクリックできるリンクとなります。</li>
            </ul>
            <p class="text-sm">つまり、ロゴをクリックするとHOME（TOPページ）へ戻れるようになります。サイト上部のロゴ画像をクリックすると、TOPページに戻るWebサイトは多いですよね。それは、このようにHTMLを記述しているからです。</p>
            
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;!--ここからヘッダー--&gt;
        &lt;header&gt;
            <span class="text-green-400">&lt;h1&gt;&lt;a href="kitchen.html"&gt;</span>&lt;img src="images_kitchen/logo.png" alt="TechAcademy KITCHEN"&gt;<span class="text-green-400">&lt;/a&gt;&lt;/h1&gt;</span>
        &lt;/header&gt;
        &lt;!--ヘッダーここまで--&gt;</code></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            グローバルナビゲーション
        </h4>
        <p>グローバルナビゲーション、つまり全体のメニューは、ロゴの真下に書き加えます。</p>
        <p>メニューとして作られるのは <code>&lt;ul&gt;</code> と <code>&lt;li&gt;</code> による順序無しリストです。この <code>ul</code> 要素を、<code>&lt;nav&gt;</code> 要素で囲みます。<code>nav</code> 要素はNAVigation（ナビゲーション：進み方の指示）の略で、内部がメニューであることを明示するために使います。</p>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-lg">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;!--ここからヘッダー--&gt;
        &lt;header&gt;
            &lt;h1&gt;&lt;a href="kitchen.html"&gt;&lt;img src="images_kitchen/logo.png" alt="TechAcademy KITCHEN"&gt;&lt;/a&gt;&lt;/h1&gt;
            <span class="text-green-400">&lt;nav id="global_navi"&gt;
                &lt;ul&gt;
                    &lt;li class="current"&gt;&lt;a href="kitchen.html"&gt;HOME&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="course.html"&gt;講座案内&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="lesson.html"&gt;レッスン&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="gallery.html"&gt;ギャラリー&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="access.html"&gt;アクセス&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="contact.html"&gt;お問い合わせ&lt;/a&gt;&lt;/li&gt;
                &lt;/ul&gt;
            &lt;/nav&gt;</span>
        &lt;/header&gt;
        &lt;!--ヘッダーここまで--&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-4 mt-8">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            ブラウザで確認しよう
        </h4>
        <p>上記の内容を <code>kitchen.html</code> に追記し、保存したらブラウザでプレビューを見てみましょう。下図の通りになっていれば大丈夫です。</p>
        
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center mb-4">
            <img src="/images/Lesson4-14.png" alt="ヘッダー完成（HTMLのみ）" class="max-w-full h-auto mx-auto rounded shadow-sm border border-gray-300" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x300.png?text=Lesson4-14.png%0A(ヘッダーのHTML表示確認)\'">
        </div>

        <div class="bg-red-50 p-4 rounded-lg border border-red-100 text-sm text-red-800">
            <p><strong>💡 うまく表示されない場合は？</strong></p>
            <ul class="list-disc ml-6 mt-2 space-y-1">
                <li>画像が表示されない場合：<code>images_kitchen</code> フォルダと <code>kitchen.html</code> が同じ階層にあるか確認しましょう。</li>
                <li>表示内容が違っていたら、自分のHTMLの記述（タグの閉じ忘れなど）に間違いがないか見直してみましょう。</li>
                <li>HTMLファイルを保存（Ctrl+S / Cmd+S）し忘れていないか確認しましょう。</li>
            </ul>
        </div>
    </section>
</div>'
            ]
        );
    }
}