<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson5_1Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson5（CSS基礎）を取得
        $lesson5 = Lesson::where('title', 'CSS基礎')->first();

        if (!$lesson5) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson5->id,
                'sort_order' => 2
            ],
            [
                'title' => 'CSSの基本',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <script>
        function updatePreview(id, val) {
            const target = document.getElementById(id);
            if (!target) return;
            if (!target.shadowRoot) {
                target.attachShadow({mode: "open"});
            }
            const defaultStyle = `
                <style>
                    :host { font-family: sans-serif; display: block; line-height: 1.6; color: #374151; background: white; padding: 10px; }
                </style>
            `;
            target.shadowRoot.innerHTML = defaultStyle + val;
        }

        window.addEventListener("load", () => {
            document.querySelectorAll(".live-editor-area").forEach(area => {
                const textarea = area.querySelector("textarea");
                if(textarea) {
                    updatePreview(textarea.getAttribute("data-target"), textarea.value);
                }
            });
        });
    </script>

    <section>
        <p class="text-lg leading-relaxed text-gray-700">
            CSSを使えば、HTMLにデザインを適用できます。<br>
            CSSを記述するには、以下の3つの方法があります。
        </p>
        <ul class="list-decimal ml-6 mt-4 space-y-2 text-gray-700">
            <li>HTMLの各タグの中に <code>style</code> 属性を追加し、属性値としてCSSを記述する</li>
            <li>head要素の中に <code>&lt;style&gt;</code> というタグ（要素）を追加し、その内容としてCSSを記述する</li>
            <li><strong>CSSファイルを用意し、ファイルの中にCSSを記述する（※通常はこの方法が一般的です）</strong></li>
        </ul>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            CSSはCSSファイルに記述する
        </h4>
        <p class="text-gray-700">
            CSSファイルはHTMLと同じく、テキストファイルです。テキストエディタを使用して作成・編集します。保存したファイルの拡張子を「<strong>.css</strong>」にすることで、WebブラウザにCSSファイルとして認識されます。<br>
            通常はこのCSSファイルを適用するHTMLファイルと同じサーバー上に保存して、HTMLファイルから参照します。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            CSSの記法
        </h4>
        <p class="text-gray-700">
            CSSの記法はとても単純で、<strong>「HTML内の○○要素の△△を□□にする」</strong>のように記述します。<br>
            具体的な例を挙げると、「p要素の文字色を赤にする」や、「h1要素のマージンを40pxにする」ような形式です。
        </p>

        <div class="bg-gray-800 text-gray-100 p-4 rounded-lg font-mono text-sm shadow-inner">
            <span class="text-gray-400">/* p要素の文字色(color)を赤(red)にする */</span><br>
            <span class="text-pink-400">p</span> {<br>
            &nbsp;&nbsp;<span class="text-blue-300">color</span>: <span class="text-yellow-300">red</span>;<br>
            }<br><br>
            <span class="text-gray-400">/* h1要素のマージン(margin=余白)を40pxにする */</span><br>
            <span class="text-pink-400">h1</span> {<br>
            &nbsp;&nbsp;<span class="text-blue-300">margin</span>: <span class="text-yellow-300">40px</span>;<br>
            }
        </div>

        <p class="text-gray-700">
            上記のコード内で要素を指定している箇所（p、h1）を <strong>セレクタ</strong>、スタイルの種類（color、margin）を <strong>プロパティ</strong>、プロパティに対するもの（red、40px）を <strong>値</strong> と呼びます。<br>
            プロパティの後には <code>:</code>（コロン）を、値の後には <code>;</code>（セミコロン）を書くのを忘れないようにしましょう。表示が崩れる原因となります。
        </p>
        
        

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <h5 class="font-bold text-blue-900 mb-2">CSSの構成要素は3つ！</h5>
            <ul class="list-disc ml-5 text-blue-800">
                <li><strong>セレクタ：</strong> どこの（例：h1要素）</li>
                <li><strong>プロパティ：</strong> 何を（例：文字色を）</li>
                <li><strong>値：</strong> どうする（例：赤にする）</li>
            </ul>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            セレクタ
        </h4>
        <p class="text-gray-700">セレクタとは、デザインを適用する要素を指定するものです。特定の箇所だけデザインを適用したい場合に細かく指定する記法があります。</p>

        <div class="grid md:grid-cols-2 gap-6 text-sm">
            <div class="bg-white p-5 border border-gray-200 rounded-xl shadow-sm">
                <h5 class="font-bold text-lg text-gray-800 mb-3 border-b pb-1">class属性で指定 ( . )</h5>
                <p class="text-gray-600 mb-3">特定のclass属性を持った要素のみを指定する場合は、頭に <code>.</code> をつけます。</p>
                <div class="bg-gray-800 text-gray-100 p-3 rounded font-mono text-xs">
                    <span class="text-gray-400">/* class="important" を持った全要素 */</span><br>
                    <span class="text-green-400">.important</span> {<br>
                    &nbsp;&nbsp;<span class="text-blue-300">color</span>: <span class="text-yellow-300">red</span>;<br>
                    }
                </div>
            </div>
            
            <div class="bg-white p-5 border border-gray-200 rounded-xl shadow-sm">
                <h5 class="font-bold text-lg text-gray-800 mb-3 border-b pb-1">id属性で指定 ( # )</h5>
                <p class="text-gray-600 mb-3">ページ内で一意のid属性を指定する場合は、頭に <code>#</code> をつけます。</p>
                <div class="bg-gray-800 text-gray-100 p-3 rounded font-mono text-xs">
                    <span class="text-gray-400">/* id="important" を持った要素 */</span><br>
                    <span class="text-orange-400">#important</span> {<br>
                    &nbsp;&nbsp;<span class="text-blue-300">color</span>: <span class="text-yellow-300">red</span>;<br>
                    }
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 p-4 border-l-4 border-yellow-400 text-sm mt-4">
            <strong>注意：</strong> id属性は、1つのWebページの中でただ1つの要素を識別したいときに指定します。同じidを複数回使うと、思い通りのスタイルが適用されず、文法エラー（The W3C Markup Validation Service等で指摘）の原因になります。
        </div>

        <h5 class="font-bold text-lg text-gray-800 mt-6 border-l-4 border-[#6A73A6] pl-3">子孫セレクタと疑似クラス</h5>
        <p class="text-gray-700">HTML構造に沿って絞り込む <strong>子孫セレクタ</strong>（半角スペース区切り）や、リンクの状態などに合わせて適用する <strong>疑似クラス</strong> があります。</p>
        
        <div class="bg-gray-50 p-4 rounded-lg font-mono text-sm text-gray-800 border border-gray-200">
            <span class="text-gray-500">/* 子孫セレクタ：divの中のarticleの中のp要素 */</span><br>
            <span class="text-pink-600">div article p</span> { color: red; }<br><br>
            <span class="text-gray-500">/* 疑似クラス：リンクにカーソルが乗った状態（hover） */</span><br>
            <span class="text-pink-600">a:hover</span> { color: #ff0000; }
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            値と単位
        </h4>
        <p class="text-gray-700">プロパティによって指定できる値は変わります。ここでは、長さと色の代表的な記法を学びましょう。</p>

        <h5 class="font-bold text-gray-800 mt-4 border-b border-gray-300 pb-1">長さの記法</h5>
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li><strong>px（ピクセル）：</strong> 絶対指定。画面のドット（点）を基準とします。</li>
            <li><strong>%（パーセント）：</strong> 親要素を100%とした時の相対指定。</li>
            <li><strong>vw（Viewport Width）：</strong> ブラウザの画面幅に対する相対指定（100vw = 画面幅いっぱい）。</li>
            <li><strong>em / rem：</strong> フォントサイズに対する相対指定。remは一番大元のhtml（root）を基準とします。</li>
        </ul>

        <h5 class="font-bold text-gray-800 mt-6 border-b border-gray-300 pb-1">色の記法</h5>
        <p class="text-gray-700 mb-2">色は英語（redなど）の他、RGB（16進数）やRGBA関数で表現できます。</p>
        
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li><strong>英語：</strong> <code>red</code>, <code>green</code>, <code>blue</code>, <code>black</code> 等</li>
            <li><strong>RGB（16進数）：</strong> <code>#ff0000</code>（赤）のように、赤・緑・青の強さを00〜ffの16進数で表現。</li>
            <li><strong>RGBA：</strong> <code>rgba(0, 0, 0, 0.5)</code> のように記述し、最後の値で透明度（0.0〜1.0）を指定。</li>
        </ul>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            CSSの優先順位
        </h4>
        <p class="text-gray-700">CSSのデザインの適用には、優先度があります。</p>
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-gray-50 p-4 rounded border">
                <strong>① 下に書かれたものほど優先</strong><br>
                <span class="text-sm text-gray-600">同じセレクタが複数ある場合、後から読み込まれた（下に書かれた）CSSが上書きして適用されます。</span>
            </div>
            <div class="bg-gray-50 p-4 rounded border">
                <strong>② 詳細なセレクタほど優先</strong><br>
                <span class="text-sm text-gray-600"><code>p</code> よりも <code>p.important</code> のように、詳細度がより高く指定されたセレクタが優先されます。</span>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            CSSの適用方法（実習）
        </h4>
        <p class="text-gray-700">最後に、最も推奨される <strong>「外部ファイルとして読み込む」</strong> 方法を試してみましょう。<code>&lt;head&gt;</code> 要素内に <code>&lt;link&gt;</code> タグを記述します。</p>
        
        

        <div class="space-y-4 live-editor-area">
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg mt-4">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">HTML (style.css を読み込んでいる想定)</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output (表示結果)</div>
                </div>
                <div class="flex h-48 bg-white">
                    <textarea 
                        data-target="output_css_link"
                        oninput="updatePreview(\'output_css_link\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none focus:ring-0"
                    ><style>
  p {
    color: red;
  }
</style>

<p>本文です。</p></textarea>
                    <div id="output_css_link" class="w-1/2 h-full p-4 border-l overflow-auto"></div>
                </div>
            </div>
        </div>
        <div class="bg-blue-50 p-4 rounded-lg mt-4 text-sm text-blue-900 border border-blue-100">
            <strong>まとめ：</strong> 文書であるHTMLと、デザイン指定であるCSSは別ファイルで管理すべきです。役割に沿ってファイルを分けることで、サイト全体としてのメンテナンス性が高く保たれます。
        </div>
    </section>
</div>'
            ]
        );
    }
}