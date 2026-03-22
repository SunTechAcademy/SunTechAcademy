<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3_6Seeder extends Seeder
{
    public function run(): void
    {
        $lesson3 = Lesson::where('title', 'HTML基礎')->first();

        if (!$lesson3) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson3->id,
                'sort_order' => 7
            ],
            [
                'title' => 'id属性とclass属性の設定',
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
            // プレビューエリア自体の基本スタイル
            const baseStyle = `<style>:host { font-family: sans-serif; display: block; padding: 20px; background: white; }</style>`;
            target.shadowRoot.innerHTML = baseStyle + val;
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
            本チャプターでは、HTML要素に「名前」をつけるための <strong>id属性</strong> と <strong>class属性</strong> を学びます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            id属性とclass属性の概要
        </h4>
        <p>これらはHTMLのタグの中に名前をつけ、特定の要素を識別するために使用します。</p>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-5 rounded-xl border border-blue-100">
                <h5 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                    <span class="bg-blue-600 text-white text-xs px-2 py-0.5 rounded">id</span>
                    id属性（固有の名前）
                </h5>
                <p class="text-sm text-blue-800 mb-3">IDentification（識別）の略。ページ内で <strong>ただ1つだけ</strong> 使用できる名前です。</p>
            </div>
            <div class="bg-green-50 p-5 rounded-xl border border-green-100">
                <h5 class="font-bold text-green-900 mb-2 flex items-center gap-2">
                    <span class="bg-green-600 text-white text-xs px-2 py-0.5 rounded">class</span>
                    class属性（グループの名前）
                </h5>
                <p class="text-sm text-green-800 mb-3">「集合体」を意味します。 <strong>同じ名前を何度でも</strong> 使うことができます。</p>
            </div>
        </div>
    </section>

    <section class="space-y-4 live-editor-area">
        <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">実習：CSSとのつながりを確認しよう</h5>
        <p class="text-sm">HTMLの中に <code>&lt;style&gt;</code> タグを記述して、名前（id/class）に対して色を指定する例です。</p>
        
        <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col shadow-lg">
            <div class="flex bg-gray-800 text-white text-xs font-bold p-2">
                <div class="w-1/2 pl-2">HTMLエディタ</div>
                <div class="w-1/2 pl-2 border-l border-gray-600">Output (CSS反映)</div>
            </div>
            <div class="flex h-80 bg-white">
                <textarea 
                    data-target="output-id-class-v2"
                    oninput="updatePreview(\'output-id-class-v2\', this.value)"
                    class="w-1/2 h-full p-4 font-mono text-sm border-none resize-none bg-gray-50 focus:outline-none"
                ><style>
  #introduction {
    color: green;
  }
  .main {
    color: blue;
  }
</style>

<div id="introduction">
    <p>これから自己紹介をします。</p>
</div>

<div class="main">
    <p>ここは強調グループです。</p>
    <p>ここは通常の段落です。</p>
</div></textarea>
                <div id="output-id-class-v2" class="w-1/2 h-full border-l overflow-auto relative"></div>
            </div>
        </div>

        <div class="bg-indigo-50 p-4 rounded-lg text-sm">
            <p><strong>ここがポイント：</strong></p>
            <ul class="list-disc ml-6 mt-2 space-y-1 text-indigo-900">
                <li>CSSで <strong>#</strong> をつけると「id名」を探しに行きます。</li>
                <li>CSSで <strong>.</strong> をつけると「class名」を探しに行きます。</li>
                <li>HTML側の名前を変えると、デザインが当たらなくなることを確認してみましょう。</li>
            </ul>
        </div>
    </section>

    <section class="bg-red-50 p-6 rounded-xl border border-red-100">
        <h4 class="font-bold text-lg text-red-900 mb-2">⚠️ id属性の重複に注意</h4>
        <p class="text-sm text-red-800 leading-relaxed">
            同じ <code>id</code> を1つのページ内で2回以上使うことはお勧めできません。
            <strong>「idは背番号（唯一）、classはチーム名（複数可）」</strong>と覚えましょう。
        </p>
    </section>

    <div class="text-center pt-8">
        <p class="text-gray-500 text-sm mb-4">お疲れ様でした！idとclassを使い分けられるようになれば、CSSの学習準備は万端です。</p>
    </div>
</div>'
            ]
        );
    }
}