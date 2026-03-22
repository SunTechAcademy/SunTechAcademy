<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3_5Seeder extends Seeder
{
    public function run(): void
    {
        $lesson3 = Lesson::where('title', 'HTML基礎')->first();

        if (!$lesson3) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson3->id,
                'sort_order' => 6
            ],
            [
                'title' => 'body要素内の記述',
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
            // リスト、テーブル、フォーム用のデフォルトスタイルを追加
            const defaultStyle = `
                <style>
                    :host { font-family: sans-serif; display: block; line-height: 1.6; color: #374151; background: white; padding: 10px; }
                    h1 { font-size: 2em; font-weight: bold; margin: 0.67em 0; }
                    h2 { font-size: 1.5em; font-weight: bold; margin: 0.83em 0; }
                    h3 { font-size: 1.17em; font-weight: bold; margin: 1em 0; }
                    p { margin: 1em 0; }
                    ul { list-style-type: disc; padding-left: 40px; margin: 1em 0; }
                    ol { list-style-type: decimal; padding-left: 40px; margin: 1em 0; }
                    dl { margin: 1em 0; }
                    dt { font-weight: bold; margin-top: 10px; }
                    dd { margin-left: 40px; margin-bottom: 10px; }
                    table { border-collapse: collapse; margin: 1em 0; width: 100%; font-size: 0.9em; }
                    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                    th { background-color: #f3f4f6; }
                    form { margin: 1em 0; background: #f9fafb; padding: 15px; border-radius: 8px; border: 1px solid #eee; }
                    label { display: inline-block; width: 130px; font-weight: bold; font-size: 0.9em; }
                    input[type="text"], input[type="email"], input[type="password"] { border: 1px solid #ccc; padding: 6px; border-radius: 4px; margin-bottom: 10px; width: 200px; }
                    input[type="submit"] { background: #6A73A6; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; margin-top: 10px; }
                    input[type="submit"]:hover { background: #5a6291; }
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
        <p class="text-lg leading-relaxed">
            body要素内には、コンテンツを記述します。Webページとして表示させたいものは、すべてbody要素内に記述します。head要素に文書のメタ情報を記述した後は、メインであるbody要素のコーディングに入ります。
        </p>
    </section>

    <section class="space-y-8">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            Webページのコンテンツを記述するための要素
        </h4>
        <p>コンテンツを記述する際に使われる、主なパーツを下記に紹介します。</p>
        <ul class="flex flex-wrap gap-2 mb-6">
            <li class="bg-gray-100 px-3 py-1 rounded text-sm font-bold text-gray-700">段落（文章）</li>
            <li class="bg-gray-100 px-3 py-1 rounded text-sm font-bold text-gray-700">文章中の改行</li>
            <li class="bg-gray-100 px-3 py-1 rounded text-sm font-bold text-gray-700">画像</li>
            <li class="bg-gray-100 px-3 py-1 rounded text-sm font-bold text-gray-700">ページリンク</li>
            <li class="bg-gray-100 px-3 py-1 rounded text-sm font-bold text-gray-700">リスト</li>
            <li class="bg-gray-100 px-3 py-1 rounded text-sm font-bold text-gray-700">表</li>
            <li class="bg-gray-100 px-3 py-1 rounded text-sm font-bold text-gray-700">フォーム</li>
        </ul>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">段落（文章）と 改行</h5>
            <p><strong>p要素</strong>のpは Paragraph（パラグラフ：段落） の略です。記述する文章を段落ごとで区切りたい場合に使います。<br>
            任意の場所で改行をしたいだけの場合には、<strong>br要素</strong> を使います。brは BReak（断つ） の略で、終了タグのない要素です。</p>
            
            <div class="bg-yellow-50 p-4 border-l-4 border-yellow-400 text-sm text-yellow-800">
                <strong>注意：</strong> HTMLではテキスト上でいくら改行や空白を入れても、すべて半角スペース1つに置き換えられてしまいます。また、レイアウト（余白）調整のために <code>&lt;br&gt;</code> を連続で入れるような使い方は避け、CSSを利用しましょう。
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-2 border p-4 rounded-lg bg-white shadow-sm">
                <h5 class="font-bold text-gray-800 border-b pb-1">画像 (img要素)</h5>
                <p class="text-sm text-gray-600"><code>src</code> 属性に画像のURLを指定します。<code>alt</code> 属性には、画像が表示されない場合や音声読み上げ用の代替テキストを記述します。</p>
                <code class="block bg-gray-800 text-green-400 p-2 text-xs rounded mt-2">&lt;img src="logo.png" alt="ロゴ"&gt;</code>
            </div>
            <div class="space-y-2 border p-4 rounded-lg bg-white shadow-sm">
                <h5 class="font-bold text-gray-800 border-b pb-1">ページリンク (a要素)</h5>
                <p class="text-sm text-gray-600">aは Anchor（錨） の略です。<code>href</code> 属性にリンク先のURLを指定します。画像を <code>&lt;a&gt;</code> で囲むと画像リンクになります。</p>
                <code class="block bg-gray-800 text-green-400 p-2 text-xs rounded mt-2">&lt;a href="https://..."&gt;リンク&lt;/a&gt;</code>
            </div>
        </div>

        <div class="space-y-4 live-editor-area pt-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">リスト (ul / ol / dl)</h5>
            <p>リストには <strong>順序なしリスト(ul)</strong>、<strong>順序ありリスト(ol)</strong>、<strong>説明リスト(dl)</strong> があります。</p>
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-sm">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">HTML (リストの記述例)</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output</div>
                </div>
                <div class="flex h-56 bg-white">
                    <textarea 
                        data-target="output-list"
                        oninput="updatePreview(\'output-list\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                    >&lt;ul&gt;
  &lt;li&gt;順序なしリスト1&lt;/li&gt;
  &lt;li&gt;順序なしリスト2&lt;/li&gt;
&lt;/ul&gt;

&lt;ol&gt;
  &lt;li&gt;順序ありリスト1&lt;/li&gt;
  &lt;li&gt;順序ありリスト2&lt;/li&gt;
&lt;/ol&gt;

&lt;dl&gt;
  &lt;dt&gt;HTML&lt;/dt&gt;
  &lt;dd&gt;Webページの文書を担当します。&lt;/dd&gt;
&lt;/dl&gt;</textarea>
                    <div id="output-list" class="w-1/2 h-full border-l overflow-auto relative"></div>
                </div>
            </div>
        </div>

        <div class="space-y-4 live-editor-area pt-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">表 (table要素)</h5>
            <p>表を作成するには <code>table</code> 要素を使用し、行を <code>tr</code>、見出しを <code>th</code>、データを <code>td</code> で定義します。</p>
            <div class="bg-gray-50 p-4 rounded text-sm font-mono text-gray-700">
                table<br>
                ├ thead (なくてもよい)<br>
                │  └ tr (横1列)<br>
                │     └ th (見出し)<br>
                └ tbody<br>
                   └ tr (横1列)<br>
                      ├ th または td (データ)<br>
            </div>
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-sm mt-4">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">HTML (表の記述例)</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output</div>
                </div>
                <div class="flex h-64 bg-white">
                    <textarea 
                        data-target="output-table"
                        oninput="updatePreview(\'output-table\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                    >&lt;table border="1"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th&gt;#&lt;/th&gt;&lt;th&gt;名前&lt;/th&gt;&lt;th&gt;電話番号&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th&gt;1&lt;/th&gt;&lt;td&gt;煌木 太郎&lt;/td&gt;&lt;td&gt;090-1111-2222&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
      &lt;th&gt;2&lt;/th&gt;&lt;td&gt;煌木 次郎&lt;/td&gt;&lt;td&gt;090-3333-4444&lt;/td&gt;
    &lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</textarea>
                    <div id="output-table" class="w-1/2 h-full border-l overflow-auto relative"></div>
                </div>
            </div>
        </div>

        <div class="space-y-4 live-editor-area pt-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">フォーム (form要素)</h5>
            <p>入力フォームを表示するには、<code>form</code> 要素を使用します。項目名には <code>label</code>、実際の入力エリアには <code>input</code> 要素を使います。</p>
            <ul class="list-disc ml-6 text-sm space-y-1 text-gray-700">
                <li><code>type="text"</code>：通常のテキストボックス</li>
                <li><code>type="password"</code>：伏せ字になるパスワード欄</li>
                <li><code>placeholder="例: 田中"</code>：未入力時に薄く表示されるヒント</li>
                <li><code>type="hidden"</code>：画面に表示せず裏でデータを送る隠し項目</li>
            </ul>
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-sm mt-4">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">HTML (フォームの記述例)</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output</div>
                </div>
                <div class="flex h-64 bg-white">
                    <textarea 
                        data-target="output-form"
                        oninput="updatePreview(\'output-form\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                    >&lt;form&gt;
  &lt;label for="name"&gt;お名前&lt;/label&gt;
  &lt;input type="text" id="name" name="name" placeholder="例：煌木 太郎"&gt;
  &lt;br&gt;
  &lt;label for="password"&gt;パスワード&lt;/label&gt;
  &lt;input type="password" id="password" name="password"&gt;
  &lt;br&gt;
  &lt;input type="submit" value="登録する"&gt;
&lt;/form&gt;</textarea>
                    <div id="output-form" class="w-1/2 h-full border-l overflow-auto relative"></div>
                </div>
            </div>
            <p class="text-sm text-gray-600">※ form要素を実際に動作させるには、PHPなどのサーバ側プログラミング言語と <code>action</code> 属性の指定が必要です。</p>
        </div>
    </section>

    <section class="space-y-6 pt-8">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            Webページのアウトラインを整えるための要素
        </h4>
        <p>アウトラインとは、文書の目次や見出し、構造のことです。</p>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-2 border p-4 rounded-lg bg-white shadow-sm">
                <h5 class="font-bold text-gray-800 border-b pb-1">見出し (h1 〜 h6)</h5>
                <p class="text-sm text-gray-600">Headingの略で、数字が小さいほど大きな見出しになります。<code>h1</code> はページのタイトルなどに使われ、基本的に1ページにつき1つだけ使います。</p>
            </div>
            <div class="space-y-2 border p-4 rounded-lg bg-white shadow-sm">
                <h5 class="font-bold text-gray-800 border-b pb-1">まとまりを分ける (section / div)</h5>
                <p class="text-sm text-gray-600"><code>section</code> は意味のある一部分のまとまりに、<code>div</code> は特に深い意味を持たせない「単なる範囲の分割」に使われます。</p>
            </div>
        </div>

        <div class="space-y-4 mt-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">Webページの構造を分ける</h5>
            <p>Webページは概ね、「ヘッダー・メインコンテンツ（記事）・サイドバー・フッター」という構成になっています。これらを表現する専用のタグもあります。</p>
            
            <div class="bg-gray-800 rounded-lg p-4 font-mono text-sm text-green-400">
&lt;body&gt;<br>
&nbsp;&nbsp;&lt;header&gt;&lt;!-- ヘッダー(ロゴやナビ) --&gt;&lt;/header&gt;<br>
&nbsp;&nbsp;&lt;div&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;article&gt;&lt;!-- 本文・記事 --&gt;&lt;/article&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;aside&gt;&lt;!-- サイドバー等の補足 --&gt;&lt;/aside&gt;<br>
&nbsp;&nbsp;&lt;/div&gt;<br>
&nbsp;&nbsp;&lt;footer&gt;&lt;!-- フッター(コピーライト等) --&gt;&lt;/footer&gt;<br>
&lt;/body&gt;
            </div>
            <p class="text-sm text-gray-600">
                SEOの観点からは、<code>article</code> や <code>header</code> など使い所がわかりやすいタグを積極的に使うと有利になります。ただ、迷った時は <code>div</code> を使っても表示上の大きな問題はありません。
            </p>
        </div>
    </section>

    <section class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 mt-8">
        <h4 class="font-bold text-lg text-indigo-900 mb-3">ここまでのまとめ</h4>
        <ul class="list-disc ml-6 text-sm text-indigo-800 space-y-2">
            <li><strong>body要素</strong> は、実際のコンテンツ（文章、画像、リンクなど）を扱う。</li>
            <li>HTMLは文書なので、構造としてアウトラインが存在する。</li>
            <li>アウトラインに沿って <strong>見出し (h1〜h6)</strong> を割り当て、<strong>分割要素 (div や section)</strong> でまとめる。</li>
        </ul>
    </section>

</div>'
            ]
        );
    }
}