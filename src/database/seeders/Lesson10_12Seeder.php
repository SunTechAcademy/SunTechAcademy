<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_12Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 12],
            [
                'title' => 'オブジェクトのクラス名を確認する',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg text-gray-700 leading-relaxed">
            継承やオーバーライドを駆使してプログラムが複雑になってくると、ある変数に入っているオブジェクトが、<strong>「結局どのクラスから作られたものか」</strong>がパッと見でわからなくなることがあります。
        </p>
        <p class="text-gray-700">
            PHPには、オブジェクトの正体（クラス名）を特定するための便利な関数が用意されています。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">get_class() 関数</h3>
        <p class="text-gray-700">
            <code>get_class(オブジェクト)</code> を使うことで、そのインスタンスの元になったクラス名を文字列で取得できます。
        </p>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
            <p class="font-bold text-gray-800 mb-4">test_class.php の一番下に、次の2行を追記して実行してみましょう。</p>
            <div class="bg-gray-900 rounded-lg p-6 font-mono text-sm text-white shadow-lg">
<pre><code>// ...（これまでのコードの続き）

print get_class($slime_A) . PHP_EOL;
print get_class($hero) . PHP_EOL;</code></pre>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2 font-sans">実行コマンド</p>
                <kbd class="bg-black text-green-400 p-2 rounded block font-mono text-xs">php test_class.php</kbd>
            </div>
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2 font-sans">実行結果（追記した箇所）</p>
                <div class="font-mono text-blue-600">
                    Slime<br>
                    Hero
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6 bg-indigo-50 p-8 rounded-2xl border border-indigo-100">
        <h3 class="text-xl font-bold text-indigo-900">いつ使うの？</h3>
        <p class="text-indigo-800 text-sm leading-relaxed">
            主に<strong>デバッグ（プログラムのミス探し）</strong>で重宝します。
        </p>
        <ul class="list-disc ml-6 space-y-2 text-sm text-indigo-800">
            <li>「親クラスのメソッドを呼んでいるはずなのに、なぜか期待通りに動かない。今この変数は本当に子クラスに上書きされているのか？」を確認する。</li>
            <li>条件分岐（if文）などで、「もしこのオブジェクトがSlimeクラスだったら、特別なボーナス経験値を出す」といった処理を書きたい場合。</li>
        </ul>
        <p class="text-xs text-indigo-600 mt-4 italic">
            ※ちなみに、特定のクラス（またはその継承クラス）かどうかを判定する <code>instanceof</code> という演算子も存在します。興味があれば調べてみましょう。
        </p>
    </section>

    <div class="bg-slate-100 p-6 rounded-xl text-center">
        <p class="text-gray-600 text-sm">
            中身が見えないブラックボックスになりがちなオブジェクト指向において、<code>get_class()</code> は中を覗き込むための大切なスコープ（望遠鏡）のような存在です。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}