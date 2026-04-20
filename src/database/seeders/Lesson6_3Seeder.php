<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson6_3Seeder extends Seeder
{
    public function run(): void
    {
        $lesson5 = Lesson::where('title', 'CSSチュートリアル')->first();

        if (!$lesson5) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson5->id,
                'sort_order' => 3
            ],
            [
                'title' => '制作実習',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-16">
    <p class="text-lg leading-relaxed mb-8">それでは制作を進めます。</p>

    <section class="space-y-6">
        <h3 class="font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            CSSファイルの初期設定
        </h3>
        <p>まずはCSSファイルを作成し、文字エンコーディングの設定（文字化け対策）を記述します。</p>
        
        <h4 class="font-bold text-lg text-gray-800 mt-6">CSSファイルを作成する</h4>
        <p><code>kitchen.css</code> ファイルを作成しましょう。</p>
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center my-4">
            <img src="/images/Lesson4-28.png" alt="ファイル作成" class="max-w-full h-auto mx-auto rounded shadow-sm" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/300x150.png?text=Lesson4-28.png\'">
        </div>
        <p>文字エンコーディングの記述を1行目に書いておきます。</p>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.css</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>@charset "UTF-8";</code></pre>
        </div>
        <p class="text-sm text-gray-600"><code>@charset "UTF-8";</code> と書いておくことでファイルの文字エンコーディングを指定します。これは文字化け対策なので、決まり文句だと覚えておきましょう。</p>

        <h4 class="font-bold text-lg text-gray-800 mt-6">CSSファイルを読み込む</h4>
        <p>HTMLからCSSのデザインを適用するために、<code>link</code>要素を<code>head</code>要素内に追加しましょう。先ほど作成した <code>kitchen.css</code> を読み込みます。</p>
        
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>&lt;!DOCTYPE html&gt;&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;TechAcademy KITCHEN&lt;/title&gt;
        <span class="text-green-400">&lt;link rel="stylesheet" href="kitchen.css"&gt;</span>
    &lt;/head&gt;
    &lt;body&gt;
      &lt;!-- 中略 --&gt;</code></pre>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 text-sm text-blue-900 mt-4">
            <h5 class="font-bold mb-2">💡 補足：CSSを更新するたびにブラウザ上で表示確認する</h5>
            <p class="mb-2">これからCSSを更新するたびに、指定した内容が適用されているか表示確認していきましょう。<br>ファイルに変更を加えた場合には、</p>
            <ol class="list-decimal list-inside space-y-1 mb-2 pl-2">
                <li>変更を加えたファイルを保存</li>
                <li>プレビューのリロード（再読み込み）</li>
            </ol>
            <p>を必ず行わなければ、変更内容は確認できません。Web制作の基本事項なのでしっかりと覚えておきましょう。</p>
            <p class="mt-2 text-xs text-blue-700">※プレビューのアドレスバーの横に矢印が円を描いたアイコンがあるのでそちらをクリックします。</p>
            <img src="/images/Lesson4-28.gif" alt="リロード" class="mt-2 rounded" onerror="this.src=\'https://placehold.jp/12/3b82f6/ffffff/300x100.png?text=Reload+Gif\'">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            Webページ全体のCSS設定
        </h3>
        <p>次に、Webページ全体のCSS設定を記述します。</p>

        <h4 class="font-bold text-lg text-gray-800 mt-6">bodyの設定</h4>
        <p><code>body</code>をセレクタとして選んだ場合、全体のCSS設定になります。表示されるHTMLはすべてbody要素内に配置されているからです。<br>以下の設定を行います。</p>
        <ul class="list-disc list-inside space-y-1 text-gray-700 pl-2">
            <li>余白を0にする</li>
            <li>全体の文字の色を少しグレーにして、通常の文章の主張を少し抑える</li>
            <li>font-sizeを14pxとする</li>
        </ul>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-4">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.css</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>@charset "UTF-8";

body {
    margin: 0;
    padding: 0;
    color: #333;
    font-size: 14px;
}</code></pre>
        </div>

        <h4 class="font-bold text-lg text-gray-800 mt-6">リンクの文字色の設定</h4>
        <p><code>a</code>要素は部位によって装飾が異なりますが、まずは全体の共通色（グレー）を指定します。</p>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2 mb-4">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>a {
    color: #333;
}</code></pre>
        </div>
        <p>次に訪問済みの色も指定しましょう。<code>:visited</code> 擬似クラスを使います。</p>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2 mb-4">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>a:visited {
    color: #333;
}</code></pre>
        </div>
        <p>続いて、<code>:hover</code> 擬似クラスを使ってマウスポインタを乗せたときの色を決めます。</p>
        <ul class="list-disc list-inside space-y-1 text-gray-700 pl-2 mt-2">
            <li>文字の色をグレーにする</li>
            <li>文字を太字に変更する（font-weightプロパティ）</li>
            <li>リンクのアンダーラインの表示を消す（text-decorationプロパティ）</li>
        </ul>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-4">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>a:hover {
    color: #333;
    font-weight: 700;
    text-decoration: none;
}</code></pre>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mt-6">
            <h5 class="font-bold mb-4">✅ ここまでの確認</h5>
            <p class="mb-4">このセクションで説明した記述を <code>kitchen.css</code> へ追記すると、以下のようになります。なお、わかりやすくするため、「このチャプターの内容です」という意味合いのコメントを追加しています。</p>
            
            <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-sm mb-4">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.css (まとめ)</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>@charset "UTF-8";

/* チャプター：全体の設定 */
body {
    margin: 0;
    padding: 0;
    color: #333;
    font-size: 14px;
}
a {
    color: #333;
}
a:visited {
    color: #333;
}
a:hover {
    color: #333;
    font-weight: 700;
    text-decoration: none;
}</code></pre>
            </div>
            
            <div class="text-center">
                <a href="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-04.png" target="_blank" class="inline-block border border-gray-300 rounded overflow-hidden hover:opacity-80 transition-opacity">
                    <img src="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-04.png" alt="全体設定の表示確認" class="max-w-full h-auto" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/400x200.png?text=表示確認(全体設定)\'">
                </a>
                <p class="text-xs text-gray-500 mt-2">この状態での表示内容（クリックすると新規タブで画像が開きます）</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            マージン
        </h3>
        <p>続いて、マージンを指定します。</p>

        <h4 class="font-bold text-lg text-gray-800 mt-4">見出しのマージン</h4>
        <p>HTMLで指定したh1〜h6要素には最初から上下にマージンが存在します。上のマージンをカットすることにより全体のバランスがよくなりますので、今回は上部のマージンを0に指定します。</p>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
}</code></pre>
        </div>

        <h4 class="font-bold text-lg text-gray-800 mt-6">段落のマージン</h4>
        <p><code>p</code>要素の上マージンも同様に、0にします。そして文章を読みやすくするために、行間の指定（<code>line-height</code>）を追加します。この値を1.6とし、ゆとりをもたせましょう。</p>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>p {
    margin-top: 0;
    line-height: 1.6;
}</code></pre>
        </div>

        <h4 class="font-bold text-lg text-gray-800 mt-6">画像のマージン</h4>
        <p>画像の下にマージンができてしまうことがあります。<code>img</code>要素に対して、<code>vertical-align</code>プロパティの値を<code>bottom</code>にすると、下の余白がなくなります。</p>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>img {
    vertical-align: bottom;
}</code></pre>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mt-6">
            <h5 class="font-bold mb-4">✅ ここまでの確認</h5>
            <p class="mb-4">以下の内容を <code>kitchen.css</code> の末尾に追記・保存しましょう。</p>
            <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-sm mb-4">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.css (末尾に追記)</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>/* チャプター：マージン */
h1,h2,h3,h4,h5,h6 {
    margin-top: 0;
}
p {
    margin-top: 0;
    line-height: 1.6;
}
img {
    vertical-align: bottom;
}</code></pre>
            </div>
            <div class="text-center">
                <a href="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-05.png" target="_blank" class="inline-block border border-gray-300 rounded overflow-hidden hover:opacity-80 transition-opacity">
                    <img src="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-05.png" alt="マージンの表示確認" class="max-w-full h-auto" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/400x200.png?text=表示確認(マージン)\'">
                </a>
                <p class="text-xs text-gray-500 mt-2">この状態での表示内容（クリックすると新規タブで画像が開きます）</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            見出しの装飾
        </h3>
        <p>今回はボーダーと背景を利用して、見栄えのいい見出しにします。<code>h1</code>要素は画像のみなので装飾しません。</p>

        <h4 class="font-bold text-lg text-gray-800 mt-4">h2要素を装飾する</h4>
        <ul class="list-disc list-inside space-y-1 text-gray-700 pl-2">
            <li>フォントの大きさを20pxにする</li>
            <li>内側の余白をつける（左右の余白は広めに設定）</li>
            <li>枠線の角を半径2pxで丸める（border-radius）</li>
            <li>赤っぽい色で1pxの境界線をひく</li>
        </ul>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>#main h2 {
    font-size: 20px;
    padding: 8px 22px;
    border-radius: 2px;
    border: 1px solid #956840;
}</code></pre>
        </div>

        <h4 class="font-bold text-lg text-gray-800 mt-6">h3要素を装飾する</h4>
        <ul class="list-disc list-inside space-y-1 text-gray-700 pl-2">
            <li>フォントサイズを16pxにする</li>
            <li>左側の境界にのみ線を引いてアクセントをつける</li>
            <li>内側の余白をつける（左のみ広めに設定する）</li>
        </ul>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>#main h3 {
    font-size: 16px;
    border-left: 3px solid #fa9786;
    padding: 4px 9px 4px 14px;
}</code></pre>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mt-6">
            <h5 class="font-bold mb-4">✅ ここまでの確認</h5>
            <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-sm mb-4">
                <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.css (末尾に追記)</div>
                <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>/* チャプター：見出しの装飾 */
#main h2 {
    font-size: 20px;
    padding: 8px 22px;
    border-radius: 2px;
    border: 1px solid #956840;
}
#main h3 {
    font-size: 16px;
    border-left: solid 3px #fa9786;
    padding: 4px 9px 4px 14px;
}</code></pre>
            </div>
            <div class="text-center">
                <a href="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-06.png" target="_blank" class="inline-block border border-gray-300 rounded overflow-hidden hover:opacity-80 transition-opacity">
                    <img src="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-06.png" alt="見出し装飾の表示確認" class="max-w-full h-auto" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/400x200.png?text=表示確認(見出しの装飾)\'">
                </a>
                <p class="text-xs text-gray-500 mt-2">この状態での表示内容（クリックすると新規タブで画像が開きます）</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            ヘッダー
        </h3>
        <p>一番上のヘッダーエリアを整えます。</p>

        <h4 class="font-bold text-lg text-gray-800 mt-4">ヘッダーの幅を決める・ロゴのマージン</h4>
        <p>ヘッダーの幅を <code>984px</code> にし、<code>margin: 0 auto;</code> で中央揃えにします。ロゴにもマージンを設定します。</p>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>header {
    width: 984px;
    margin: 0 auto;
}
header h1 {
    margin: 5px 0 10px;
}</code></pre>
        </div>

        <h4 class="font-bold text-lg text-gray-800 mt-6">グローバルナビゲーション</h4>
        <p>重要な主要ページへのリンク（ul, li要素）を横並びにし、ボタンのようなデザインにします。</p>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>#global_navi {
    margin-bottom: 16px;
}
/* フレックスボックスで横並び・点の非表示 */
#global_navi ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    column-gap: 1px;
}
#global_navi ul li {
    width: 163px;
    text-align: center;
}
/* リンクをボタン化・アニメーション設定 */
#global_navi ul li a {
    display: block;
    padding: 10px 16px;
    background-color: #f0573e;
    color: #fff;
    text-decoration: none;
    transition: background-color .2s linear;
}
/* カレント（現在位置）とホバー時の色 */
#global_navi ul li.current a,
#global_navi ul li a:hover {
    background-color: #fa9786;
}</code></pre>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mt-6 text-center">
            <h5 class="font-bold mb-4 text-left">✅ ここまでの確認</h5>
            <a href="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-07.png" target="_blank" class="inline-block border border-gray-300 rounded overflow-hidden hover:opacity-80 transition-opacity">
                <img src="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-07.png" alt="ヘッダーの表示確認" class="max-w-full h-auto" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/400x200.png?text=表示確認(ヘッダー)\'">
            </a>
            <p class="text-xs text-gray-500 mt-2">この状態での表示内容（クリックすると新規タブで画像が開きます）</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            メインビジュアル
        </h3>
        <p>メインビジュアル画像は、グローバルナビゲーションと同じ横幅984pxで、高さ420pxの1枚の画像です。中央に配置します。</p>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-sm mt-2">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.css (末尾に追記)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>/* チャプター：メインビジュアル */
#main_visual {
    width: 984px;
    height: 420px;
    margin: 0 auto 25px;
}</code></pre>
        </div>
        <div class="text-center mt-4">
            <a href="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-08.png" target="_blank" class="inline-block border border-gray-300 rounded overflow-hidden hover:opacity-80 transition-opacity">
                <img src="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-08.png" alt="メインビジュアルの表示確認" class="max-w-full h-auto" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/400x200.png?text=表示確認(メインビジュアル)\'">
            </a>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            メインとサイドバー（2カラムレイアウト）
        </h3>
        <p>メイン部分とサイドバーをFlexboxを使って横に並べます。</p>
        
        <h4 class="font-bold text-lg text-gray-800 mt-4">wrapper・幅の設定</h4>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>/* チャプター：メインとサイドバー（2カラムレイアウト） */
#wrapper {
    width: 984px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
}
#main {
    width: 730px;
}
#sidebar {
    width: 220px;
}</code></pre>
        </div>

        <h4 class="font-bold text-lg text-gray-800 mt-6">メインエリア（写真配置・お知らせ）</h4>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>/* チャプター：メインエリア */
.point {
    display: flex;
    justify-content: space-between;
}
.point figure {
    margin-right: 0;
}
.point figcaption {
    font-size: 12px;
    color: #9C9689;
    text-align: center;
}
#news ul {
    list-style: none;
    padding: 0;
}
#news li {
    margin-bottom: 10px;
}
#news li a {
    margin-left: 15px;
}</code></pre>
        </div>

        <h4 class="font-bold text-lg text-gray-800 mt-6">サイドバー</h4>
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-600 shadow-sm mt-2">
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>/* チャプター：サイドバー */
#side_banner ul {
    list-style: none;
    padding: 0;
}
#side_banner {
    margin-bottom: 30px;
    border: 1px solid #956840;
    text-align: center;
}
#side_banner h2 {
    background-color: #956840;
    color: #fff;
    padding: 7px;
    font-size: 14px;
}</code></pre>
        </div>

        <div class="text-center mt-6">
            <a href="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-11.png" target="_blank" class="inline-block border border-gray-300 rounded overflow-hidden hover:opacity-80 transition-opacity">
                <img src="https://techacademy.s3.amazonaws.com/training/htmlcss/css/13-11.png" alt="2カラムの表示確認" class="max-w-full h-auto" onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/400x200.png?text=表示確認(2カラムレイアウト)\'">
            </a>
            <p class="text-xs text-gray-500 mt-2">この状態での表示内容（クリックすると新規タブで画像が開きます）</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            フッター
        </h3>
        <p>フッターは横幅を指定せず、ブラウザの幅いっぱいに広がるデザインを採用します。</p>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-sm mt-4">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.css (末尾に追記)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>/* チャプター：フッター */
footer #footer_navi ul {
    list-style: none;
    margin: 0;
    padding: 0;
    text-align: center;
}
footer {
    background-color: #956840;
    text-align: center;
}
footer #footer_navi {
    background-color: #f0f0f0;
    padding: 10px 0;
}
/* フッターリンクを横並び(inline)にして境界線を引く */
footer #footer_navi li {
    display: inline;
    border-left: solid 1px #333;
    margin-left: 8px;
    padding-left: 8px;
    font-size: smaller;
}
footer #footer_navi li:last-child {
    border-right: solid 1px #333;
    padding: 0 8px;
}
/* コピーライト */
footer small {
    display: block;
    padding: 8px 0;
    color: #fff;
}</code></pre>
        </div>

        <div class="bg-green-50 p-6 rounded-xl border border-green-200 mt-8 text-center">
            <h4 class="text-xl font-bold text-green-800 mb-2">🎉 コーディング完了！</h4>
            <p class="text-green-700">
                これでCSSのコーディングはすべて完了です！ブラウザをリロードして、美しいWebページが完成していることを確認してください。
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}