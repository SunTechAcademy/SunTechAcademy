<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson4_5Seeder extends Seeder
{
    public function run(): void
    {
        $lesson4 = Lesson::where('title', 'HTMLチュートリアル')->first();

        if (!$lesson4) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson4->id,
                'sort_order' => 5
            ],
            [
                'title' => 'メインビジュアル',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            続けて <strong>メインビジュアル</strong> の部分を作ります。
        </p>
        <p class="text-gray-700">
            Webページのトップページに当たる <code>kitchen.html</code> の上部に大きく表示されている画像を、<code>img</code> 要素を使って挿入します。
        </p>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            メインビジュアルの画像を配置する
        </h4>
        <p>
            記述する場所は、<code>header</code> 要素のすぐ下、メインエリアの上部になります。<br>
            画像ファイルはすでに、先ほどアップロードした <code>images_kitchen</code> フォルダに格納されているので、以下のように記述すればOKです。
        </p>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-green-500 shadow-lg mt-4">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-1 border-b border-gray-600">kitchen.html (抜粋)</div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto"><code>        &lt;!--ヘッダーここまで--&gt;

        &lt;!--ここからメインビジュアル画像--&gt;
        &lt;div id="main_visual"&gt;
            <span class="text-green-400">&lt;img src="images_kitchen/main_visual.jpg" alt="健やかな健康と豊かな食生活をはじめる"&gt;</span>
        &lt;/div&gt;
        &lt;!--メインビジュアル画像ここまで--&gt;

        &lt;!--ここからwrapper--&gt;</code></pre>
        </div>
        <div class="bg-indigo-50 p-4 rounded-lg text-sm text-indigo-900 mt-2">
            <p><strong>💡 ポイント：</strong> <code>alt</code> 属性には、画像が表示されなかった場合や音声読み上げソフトのために、画像に書かれているテキスト「健やかな健康と豊かな食生活をはじめる」をしっかりと記述しておきましょう。</p>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            ブラウザで確認しよう
        </h4>
        <p>ブラウザを更新して、以下のように表示されていれば問題ありません。</p>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center mt-4">
            <img src="/images/Lesson4-15.png" alt="メインビジュアルの表示確認" class="max-w-full h-auto mx-auto rounded shadow-sm border border-gray-300" onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x450.png?text=Lesson4-15.png%0A(メインビジュアルの表示確認)\'">
        </div>
    </section>
</div>'
            ]
        );
    }
}