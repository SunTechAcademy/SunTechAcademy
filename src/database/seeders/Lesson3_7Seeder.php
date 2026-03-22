<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3_7Seeder extends Seeder
{
    public function run(): void
    {
        $lesson3 = Lesson::where('title', 'HTML基礎')->first();

        if (!$lesson3) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson3->id,
                'sort_order' => 8
            ],
            [
                'title' => 'ファイルパスについて',
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
                    :host { font-family: sans-serif; display: block; line-height: 1.6; padding: 20px; background: white; }
                    img { max-width: 100%; height: auto; border: 1px solid #ddd; }
                    .error-msg { color: #ef4444; font-size: 0.875rem; margin-top: 4px; font-weight: bold; }
                    a { color: #2563eb; text-decoration: underline; }
                </style>
            `;
            // 404エラーをシミュレートするための簡易チェック（実環境ではブラウザがエラーを出すが、教材用に可視化）
            let displayVal = val;
            if (val.includes("src") && !val.includes("https://")) {
                // ローカルパス指定のシミュレーション。実際の画像はないため、パスが正しければプレースホルダを出す
                if (val.includes("./images/logo.png") || val.includes("../images/logo.png")) {
                    displayVal = val.replace(/src="[^"]*"/, \'src="https://placehold.jp/24/6A73A6/ffffff/200x50.png?text=Correct%20Path!"\');
                } else {
                    displayVal = val + \'<div class="error-msg">⚠️ 404 Not Found (パスが正しくありません)</div>\';
                }
            }
            target.shadowRoot.innerHTML = defaultStyle + displayVal;
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
            画像やCSSファイルをHTMLで読み込む際に、<strong>ファイルパス</strong> というものを理解している必要があります。
            ファイルパスは、呼び出したいファイルが「どこにあるのか」を指定するための住所のようなものです。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            相対パス
        </h4>
        <p>「今作業しているファイル」を起点に、目的のファイルまでの道のりを指定する方法です。</p>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
            <h5 class="font-bold text-gray-800 mb-4 text-center">📁 ディレクトリ構造の例</h5>
            
            
            <div class="mt-6 grid md:grid-cols-2 gap-4 text-sm font-mono">
                <div class="bg-white p-3 border rounded shadow-sm">
                    <p class="font-bold text-blue-600 mb-2">./ (同じ階層)</p>
                    <code class="text-xs">&lt;link rel="stylesheet" href="./css/style.css"&gt;</code>
                    <p class="text-gray-500 mt-2 text-[10px]">「今の場所」にあるcssフォルダの中のstyle.css</p>
                </div>
                <div class="bg-white p-3 border rounded shadow-sm">
                    <p class="font-bold text-red-600 mb-2">../ (1つ上の階層へ)</p>
                    <code class="text-xs">&lt;link rel="stylesheet" href="../css/style.css"&gt;</code>
                    <p class="text-gray-500 mt-2 text-[10px]">「今の場所」から1つ外に出て、cssフォルダに入る</p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <p>フォルダの区切りには <code>/</code> を使います。階層を2つ上がる場合は <code>../../</code> と、1セットずつ増やします。</p>
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 flex items-start gap-3">
                <span class="text-2xl">💡</span>
                <p class="text-sm text-blue-800">
                    <strong>デフォルトドキュメント：</strong> <code>index.html</code> という名前のファイルは、ブラウザが自動的に「そのフォルダの代表」として読み込むため、リンク時にファイル名を省略できます。<br>
                    例： <code>href="./works/"</code> （./works/index.htmlと同じ意味）
                </p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            絶対パス と ルートパス
        </h4>
        
        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">絶対パス</h5>
            <p>外部サイトのファイルや、URLを <code>https://...</code> からすべて記述する方法です。世界中の誰が見ても同じ場所を指します。</p>
            <div class="bg-gray-800 p-3 rounded font-mono text-xs text-green-400">
                &lt;link rel="stylesheet" href="https://cdnjs.cloudflare.com/.../normalize.css"&gt;
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">ルートパス</h5>
            <p>パスの最初を <code>/</code> 1個で開始する方法です。サイトの「一番上の階層（ルート）」を起点にします。</p>
            <div class="bg-gray-800 p-3 rounded font-mono text-xs text-green-400">
                &lt;a href="/works"&gt;Worksへのリンク&lt;/a&gt;
            </div>
            <p class="text-sm text-gray-600 italic">どのフォルダにいるHTMLからでも同じ書き方で指定できるのがメリットです。</p>
        </div>
    </section>

    <section class="space-y-4 live-editor-area">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            パスの書き間違いに注意する
        </h4>
        <p>パスが間違っていると、ファイルが見つからない <strong>404 (Not Found) エラー</strong> が発生し、画像が表示されなくなります。</p>

        <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg">
            <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                <div class="w-1/2 pl-2">HTMLエディタ (パスをわざと間違えてみよう)</div>
                <div class="w-1/2 pl-2 border-l border-gray-600">Output</div>
            </div>
            <div class="flex h-56 bg-white">
                <textarea 
                    data-target="output-path"
                    oninput="updatePreview(\'output-path\', this.value)"
                    class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                ><img src="./images/logo.png" alt="TechAcademyロゴ">

<p>
  <a href="./works/index.html">Worksページへ</a>
</p></textarea>
                <div id="output-path" class="w-1/2 h-full border-l overflow-auto relative"></div>
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">リンクチェックを活用しよう</h5>
        <p>ファイル数が増えてくると、手動ですべてのリンクを確認するのは大変です。URLを入力するだけでリンク切れを自動チェックしてくれるWebサービスを活用しましょう。</p>
    </section>

    <div class="text-center pt-8">
        <p class="text-gray-500 text-sm mb-4">お疲れ様でした！パスの概念を理解できたら、HTMLの基礎はほぼ網羅しました。</p>
    </div>
</div>'
            ]
        );
    }
}