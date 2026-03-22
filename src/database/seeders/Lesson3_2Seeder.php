<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3_2Seeder extends Seeder
{
    public function run(): void
    {
        $lesson3 = Lesson::where('title', 'HTML基礎')->first();

        if (!$lesson3) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson3->id,
                'sort_order' => 3
            ],
            [
                'title' => 'HTMLとCSSの概要',
                'is_assignment' => 1,
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
                    :host { font-family: sans-serif; display: block; line-height: 1.6; color: #374151; background: white; }
                    h1 { font-size: 2em; font-weight: bold; margin: 0.67em 0; display: block; border-bottom: 1px solid #eee; }
                    h2 { font-size: 1.5em; font-weight: bold; margin: 0.83em 0; display: block; }
                    ul { list-style-type: disc; padding-left: 40px; margin: 1em 0; display: block; }
                    li { display: list-item; }
                    font[color="red"] { color: red; }
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
        <p class="text-lg leading-relaxed">ここからは、HTMLとCSSについて詳しく解説します。</p>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            HTMLとは
        </h4>
        <p>HTMLは、<strong>Hyper Text Markup Language（ハイパーテキストマークアップ言語）</strong>の略で、Web上の文書を記述するためのマークアップ言語です。<br>と言っても最初はよくわからないので、まずはイメージを掴むために例を見てみましょう。</p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            通常の文書とHTMLの文書
        </h4>
        
        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">通常の文書（Word）</h5>
            <p>みなさんは普段から文書を書いていますよね。Wordのような文書作成ソフトで、以下の文書を書いたとしましょう。</p>
            <img src="/images/Lesson2-18.png" alt="自己紹介の文書" class="mx-auto rounded border shadow-sm my-4">
            <p class="text-sm font-bold text-center">自己紹介の文書（一例）</p>
            
            <div class="bg-gray-50 p-4 rounded-lg text-sm space-y-2">
                <p>本文の記述例：</p>
                <pre class="bg-white p-2 border">自己紹介\n氏名\n煌木 太郎\n職業\nWebデザイナー\nスキル\nWeb\nイラスト\n英語</pre>
                <p>Wordではボタンを使って「見出し」「赤色」「箇条書き」などの装飾をすぐに適用できます。</p>
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">HTMLでの文書の書き方</h5>
            <p>HTMLの場合は、指定の<strong>「タグ」で挟んで書く</strong>ことで装飾を適用します。</p>
            <ul class="list-disc ml-6 space-y-2">
                <li><code>&lt;h1&gt;</code>：レベル1の見出し</li>
                <li><code>&lt;font color="red"&gt;</code>：文字の色を赤に指定</li>
                <li><code>&lt;ul&gt;</code> と <code>&lt;li&gt;</code>：箇条書きリスト</li>
            </ul>
        </div>

        <div class="space-y-4 live-editor-area">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">HTMLを書いてみよう（実習）</h5>
            <img src="/images/Lesson2-19.webp" alt="実習イメージ" class="max-w-xs mx-auto mb-4">
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">HTMLエディタ</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output (表示結果)</div>
                </div>
                <div class="flex h-80 bg-white">
                    <textarea 
                        data-target="output1"
                        oninput="updatePreview(\'output1\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none focus:ring-0"
                    >自己紹介
氏名
煌木 太郎
職業
Webデザイナー
スキル
Web
イラスト
英語</textarea>
                    <div id="output1" class="w-1/2 h-full p-4 border-l overflow-auto"></div>
                </div>
            </div>
            <p class="text-sm bg-blue-50 p-3 rounded">
                <strong>実習内容：</strong> 「自己紹介」を h1 で、「氏名」「職業」「スキル」を h2 で挟んでみましょう。名前は font タグ、スキルは ul/li で箇条書きにします。
            </p>
        </div>
    </section>

    <section class="grid md:grid-cols-2 gap-6 text-sm bg-gray-50 p-6 rounded-xl">
        <div class="space-y-2">
            <h6 class="font-bold border-b border-gray-300 pb-1">改行について</h6>
            <p>ブラウザはEnterキーによる改行を認識できません。<code>&lt;h1&gt;</code> のような特定のタグを使うことで、自動的に改行されて表示されます。</p>
        </div>
        <div class="space-y-2">
            <h6 class="font-bold border-b border-gray-300 pb-1">インデントについて</h6>
            <p>プログラムの構造を見やすくするために行頭に空白を入れることを指します。HTMLでは空白は無視されるため、積極的にインデントを活用しましょう。</p>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">3</span>
            なぜ文書をHTMLで書くのか
        </h4>
        <p>HTMLは<strong>ブラウザに文書の意味を教えるため</strong>に記述されます。以下の買い物リストの例で、ブラウザがどのように解釈するか確認してください。</p>
        
        <div class="space-y-4 live-editor-area">
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-sm">
                <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">HTML</div>
                    <div class="w-1/2 pl-2 border-l border-gray-600">Output</div>
                </div>
                <div class="flex h-48 bg-white">
                    <textarea 
                        data-target="output2"
                        oninput="updatePreview(\'output2\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none focus:ring-0"
                    ><ul>
  <li>飲料水</li>
  <li>パン</li>
  <li>牛乳</li>
  <li>鶏肉</li>
</ul></textarea>
                    <div id="output2" class="w-1/2 h-full p-4 border-l overflow-auto"></div>
                </div>
            </div>
            <p>ブラウザが <code>&lt;ul&gt;</code> や <code>&lt;li&gt;</code> を読み込み、「ここはリストだ」と判断することで、自動的に <strong>・</strong> が表示されます。</p>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            CSSとは
        </h4>
        <p>CSSは、<strong>Cascading Style Sheets（カスケーディングスタイルシート）</strong>の略で、Webページをデザインするための言語です。</p>
        <div class="bg-yellow-50 p-4 border-l-4 border-yellow-400 text-sm">
            <strong>コラム：</strong> 実は <code>&lt;font&gt;</code> は現在のHTMLでは廃止されています。現在はデザインに関する指定はすべてCSSで行うのがルールです。
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            CSSでHTML文書をデザインする
        </h4>
        
        <div class="space-y-4 live-editor-area">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">CSSを書いてみよう（横並び）</h5>
            <p>CSSを使えば、色を変えるだけでなく「横並び」などのレイアウトも自由自在です。</p>
            <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg">
                <div class="flex bg-blue-900 text-white text-xs font-bold p-2">
                    <div class="w-1/2 pl-2">HTML + CSS</div>
                    <div class="w-1/2 pl-2 border-l border-blue-700">Output</div>
                </div>
                <div class="flex h-64 bg-white">
                    <textarea 
                        data-target="output3"
                        oninput="updatePreview(\'output3\', this.value)"
                        class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none focus:ring-0"
                    ><style>
  ul { color: blue; }
  li { display: inline-block; margin: 20px; border-bottom: 2px solid blue; }
</style>
<ul>
  <li>Web</li>
  <li>イラスト</li>
  <li>英語</li>
</ul></textarea>
                    <div id="output3" class="w-1/2 h-full p-4 border-l overflow-auto"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-indigo-900 text-white p-8 rounded-2xl shadow-xl">
        <h4 class="text-2xl font-bold mb-4">ここまでのまとめ</h4>
        <ul class="space-y-4">
            <li class="flex gap-3">
                <span class="bg-white text-indigo-900 rounded-full w-6 h-6 flex items-center justify-center font-bold">1</span>
                <span><strong>HTML</strong>は、Webページの<strong>文書（意味）</strong>を担当する。</span>
            </li>
            <li class="flex gap-3">
                <span class="bg-white text-indigo-900 rounded-full w-6 h-6 flex items-center justify-center font-bold">2</span>
                <span><strong>CSS</strong>は、Webページの<strong>デザイン（見た目）</strong>を担当する。</span>
            </li>
        </ul>
        <p class="mt-6 text-indigo-100">次は、より本格的にHTMLの基礎を学んでいきましょう！</p>
    </section>
</div>'
            ]
        );
    }
}