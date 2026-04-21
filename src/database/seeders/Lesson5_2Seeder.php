<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson5_2Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson5（CSS基礎）を取得
        $lesson5 = Lesson::where('title', 'CSS基礎')->first();

        if (!$lesson5) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson5->id,
                'sort_order' => 3
            ],
            [
                'title' => 'Webページのレイアウト',
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
                    body { margin: 0; }
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

    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            レイアウトとは、何かを指定の場所に配置することです。家屋の内装のレイアウトと言えば、家具をどこに配置するかで決まります。Webのレイアウトも同様で、<strong>HTML要素をどこに配置するか</strong>を決めていきます。
        </p>
        <p class="text-gray-700">
            HTML要素をレイアウトするには、CSSを使用します。HTMLだけでは上から下に配置されていくだけです。そのためHTMLだけでは好きな位置に要素を配置できません。そこでCSSを使用して、HTMLを任意の場所に表示させるのです。
        </p>
        <div class="bg-[#6A73A6] text-white p-6 rounded-xl shadow-md">
            <h5 class="font-bold text-lg mb-2">HTML要素を自由にレイアウトするための2つの技術</h5>
            <ol class="list-decimal ml-6 space-y-1">
                <li>HTML要素自体の大きさを変更する</li>
                <li>HTML要素の位置を変更する</li>
            </ol>
            <p class="mt-2 text-sm opacity-90">この2つができるようになれば、自由にHTML要素をレイアウトできるでしょう。ここでは、前提となる知識から学んでいきます。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            前提知識
        </h4>
        <p class="text-gray-700">レイアウトについて学ぶ前に覚えておきたい知識を説明します。</p>

        <h5 class="font-bold text-xl text-gray-800 mt-6 border-l-4 border-gray-400 pl-3">ブロックレベル要素とインラインレベル要素</h5>
        <p class="text-gray-700">
            HTMLの各要素は、<code>display</code>と呼ばれるプロパティのデフォルト値が異なります。<code>display</code>は「要素をどのように表示するか」という形式を決めるプロパティです。
        </p>

        

        <div class="space-y-4 live-editor-area">
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">HTML + CSS (divとspanの比較)</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output (表示結果)</div>
                </div>
                <div class="flex h-56 bg-white">
                    <textarea 
                        data-target="output_block_inline"
                        oninput="updatePreview(\'output_block_inline\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                    ><style>
  div { background-color: skyblue; margin-bottom: 5px; }
  span { background-color: pink; }
</style>

<div>div要素は横幅いっぱい（ブロック）</div>
<div>なので自動で改行されます</div>

<span>span要素は</span>
<span>中身の分だけ（インライン）</span>
<span>なので横に並びます</span></textarea>
                    <div id="output_block_inline" class="w-1/2 h-full p-4 border-l overflow-auto"></div>
                </div>
            </div>
        </div>

        <ul class="space-y-4 text-gray-700">
            <li class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                <strong>ブロックレベル要素 (display: block;)</strong><br>
                要素の横幅がブラウザの幅いっぱい（1行分）に渡ります。連続して指定すると自動的に改行されて縦方向に並んでいきます。見出しや段落など、文章を区切りたいときはこれを使います。<br>
                <span class="text-sm text-gray-500">例：h1など見出し要素, div, section, article, p, ul, ol, table</span>
            </li>
            <li class="bg-pink-50 p-4 rounded-lg border border-pink-100">
                <strong>インラインレベル要素 (display: inline;)</strong><br>
                横幅が1行のうちの一部（中身の分だけ）に適用されます。連続して指定しても改行されず横に並びます。文章の一部分の文字のみを装飾したいときなどに使います。<br>
                <span class="text-sm text-gray-500">例：span, a, img</span>
            </li>
        </ul>

        <h5 class="font-bold text-xl text-gray-800 mt-8 border-l-4 border-gray-400 pl-3">Webのレイアウトとブラウザの幅</h5>
        <p class="text-gray-700">
            ブラウザは、<strong>画面の左上を起点として上から下へ、左から右へと、HTML要素を詰めるように並べていきます。</strong> これがブラウザのデフォルト（初期値）のレイアウトになります。<br>
            このあとのチャプターでは、「ボックスモデル」という、ブロックレベル要素を活用したレイアウトを扱います。なぜなら、レイアウトが必要なのは大抵の場合、ブロックレベル要素だからです。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            ボックスモデル
        </h4>
        <p class="text-gray-700">
            ブロックレベル要素には、下記の4つの領域があります。この4つの領域それぞれに、指定された値（もしくはデフォルト値）が与えられ、四角い領域として表示されるのです。
        </p>

        

        <ul class="list-disc ml-6 text-gray-700 font-medium">
            <li><strong>margin</strong>（外側の余白）</li>
            <li><strong>border</strong>（境界線）</li>
            <li><strong>padding</strong>（内側の余白）</li>
            <li><strong>content area</strong>（コンテンツエリア：widthとheightでサイズ指定）</li>
        </ul>

        <div class="space-y-4 live-editor-area mt-4">
            <h5 class="font-bold text-lg text-gray-800">ボックスモデルの各値を変更してみよう（実習）</h5>
            <p class="text-sm text-gray-600">おススメの方法は、最初にすべて <code>0</code> にしてみることです。例題の数値に変更していくことで、変化がわかりやすくなるでしょう。</p>
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">CSS</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output</div>
                </div>
                <div class="flex h-64 bg-white">
                    <textarea 
                        data-target="output_box_model"
                        oninput="updatePreview(\'output_box_model\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                    ><style>
  .box {
    margin: 50px;
    border: 5px solid pink;
    padding: 50px;
    background-color: skyblue;
    width: 100px;
    height: 100px;
  }
</style>

<div class="box">
  コンテンツ<br>
  (100x100)
</div></textarea>
                    <div id="output_box_model" class="w-1/2 h-full p-4 border-l overflow-auto bg-gray-200"></div>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 p-4 border-l-4 border-yellow-400 text-sm mt-4">
            <strong>marginの相殺について：</strong> 上下のmarginが接する場合、お互いのmarginが足し算されるのではなく「大きい方の値」だけが適用されます。これをmarginの相殺と呼びます。レイアウトが思い通りにならない時によくある原因の一つです。
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            Flexboxモデル（カラムレイアウト）
        </h4>
        <p class="text-gray-700">
            Webページ全体のレイアウトとして、縦に並べたり横に並べたりする方法を学びましょう。ここでは、<strong>Flexboxモデル</strong> を使って、HTML要素を横に並べる方法を学びます。<code>display: flex;</code> を使ってボックスを横に並べる手法です。
        </p>

        <h5 class="font-bold text-xl text-gray-800 mt-6 border-l-4 border-gray-400 pl-3">Flexboxモデルでブロックレベル要素を寄せる</h5>
        <p class="text-gray-700">
            メインコンテンツとサイドバーを2カラム（2列）にします。親要素に <code>display: flex;</code> を指定し、<code>justify-content</code> プロパティで配置場所を調整します。
        </p>

        

        <div class="space-y-4 live-editor-area">
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">CSS + HTML</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output</div>
                </div>
                <div class="flex h-72 bg-white">
                    <textarea 
                        data-target="output_flexbox"
                        oninput="updatePreview(\'output_flexbox\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                    ><style>
  #wrapper {
    height: 150px;
    display: flex;
    justify-content: space-between; /* 両端揃え */
    background-color: #eee;
  }
  .main {
    width: 60%;
    background-color: #ddffdd;
  }
  .sidebar {
    width: 30%;
    background-color: #ffddff;
  }
</style>

<div id="wrapper">
  <div class="main">メインコンテンツ(60%)</div>
  <div class="sidebar">サイドバー(30%)</div>
</div></textarea>
                    <div id="output_flexbox" class="w-1/2 h-full p-4 border-l overflow-auto"></div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 p-2">プロパティと値</th>
                        <th class="border border-gray-300 p-2">内容</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="border border-gray-300 p-2 font-mono text-xs">justify-content: flex-start;</td><td class="border border-gray-300 p-2">すべての要素が左寄せになる</td></tr>
                    <tr><td class="border border-gray-300 p-2 font-mono text-xs">justify-content: center;</td><td class="border border-gray-300 p-2">すべての要素が中央寄せになる</td></tr>
                    <tr><td class="border border-gray-300 p-2 font-mono text-xs">justify-content: flex-end;</td><td class="border border-gray-300 p-2">すべての要素が右寄せになる</td></tr>
                    <tr><td class="border border-gray-300 p-2 font-mono text-xs text-blue-600 font-bold">justify-content: space-between;</td><td class="border border-gray-300 p-2 bg-blue-50">最初は左端、最後は右端、要素間の余白は均等に配置</td></tr>
                    <tr><td class="border border-gray-300 p-2 font-mono text-xs">justify-content: space-around;</td><td class="border border-gray-300 p-2">すべての要素の位置と要素間の余白が均等になる</td></tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            補足：その他の重要なプロパティ
        </h4>

        <h5 class="font-bold text-xl text-gray-800 border-l-4 border-gray-400 pl-3">画面固定のレイアウトと position プロパティ</h5>
        <p class="text-gray-700"><code>position</code> プロパティは、要素を配置する位置の指定に使うプロパティです。</p>

        

        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li><strong>static (デフォルト):</strong> 左上から要素を並べていくレイアウト。</li>
            <li><strong>fixed (固定):</strong> ページをスクロールしても、ブラウザの画面上の同じ位置に固定されます。</li>
            <li><strong>relative (相対的):</strong> 本来表示される位置（static）を基準として、<code>top</code> や <code>left</code> などで相対的に移動させます。</li>
            <li><strong>absolute (絶対的):</strong> ページ全体、または親要素（relative指定あり）を基準として絶対的な位置に配置します。</li>
        </ul>

        <h5 class="font-bold text-xl text-gray-800 mt-8 border-l-4 border-gray-400 pl-3">要素の重なり順と z-index プロパティ</h5>
        <p class="text-gray-700">
            紙の書類のようにHTMLの要素も重ねることができます。自分で重なり順を調整したい場合は <code>z-index</code> プロパティを使います。値が大きいものほど前面に表示されます。
        </p>

        

        <div class="space-y-4 live-editor-area">
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">CSS</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output</div>
                </div>
                <div class="flex h-64 bg-white">
                    <textarea 
                        data-target="output_zindex"
                        oninput="updatePreview(\'output_zindex\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                    ><style>
  .box {
    width: 100px; height: 100px;
    position: absolute;
    color: white; font-weight: bold; padding: 5px;
  }
  .pink { background: pink; top: 10px; left: 10px; z-index: 3; }
  .green { background: lightgreen; top: 40px; left: 40px; z-index: 2; }
  .blue { background: skyblue; top: 70px; left: 70px; z-index: 1; }
</style>
<div style="position: relative;">
  <div class="box pink">div1 (z-index: 3)</div>
  <div class="box green">div2 (z-index: 2)</div>
  <div class="box blue">div3 (z-index: 1)</div>
</div></textarea>
                    <div id="output_zindex" class="w-1/2 h-full p-4 border-l overflow-auto"></div>
                </div>
            </div>
            <p class="text-sm bg-blue-50 p-3 rounded text-blue-900">
                <strong>実習：</strong> 上記のエディタで、div3 (blue) の <code>z-index</code> を <code>99</code> に変更して、最前面に出てくることを確認してみましょう。
            </p>
        </div>
    </section>

    <section class="bg-[#6A73A6] text-white p-8 rounded-2xl shadow-xl mt-8">
        <h4 class="text-2xl font-bold mb-4">ここまでのまとめ</h4>
        <ul class="space-y-4">
            <li class="flex gap-3">
                <span class="bg-white text-[#6A73A6] rounded-full w-6 h-6 flex items-center justify-center font-bold shrink-0">1</span>
                <span><strong>ボックスモデル:</strong> HTML要素はすべて「箱」。margin・border・padding・width・height でサイズや余白を制御します。</span>
            </li>
            <li class="flex gap-3">
                <span class="bg-white text-[#6A73A6] rounded-full w-6 h-6 flex items-center justify-center font-bold shrink-0">2</span>
                <span><strong>横並びレイアウト:</strong> <code>display: flex;</code> を使い、<code>width</code> と組み合わせて複数カラムレイアウトを実現します。</span>
            </li>
        </ul>
        <p class="mt-6 text-indigo-100">
            実際のWebページのレイアウトがどういうものになるかは、CSSチュートリアルを進めながら実践で確認していきましょう！
        </p>
    </section>
</div>'
            ]
        );
    }
}