<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson8_6Seeder extends Seeder
{
    public function run(): void
    {
        $lesson8 = Lesson::where('title', 'PHPその1')->first();

        if (!$lesson8) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson8->id,
                'sort_order' => 6
            ],
            [
                'title' => '演算子',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            データを計算したり、値同士を比べたりするには<strong>演算子（えんざんし）</strong>が必要です。<br>
            「足し算をする」「大きさを比べる」といった命令を記号で表現します。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            代入演算子
        </h4>
        <p class="text-gray-700">
            すでにおなじみの <code>=</code> です。「右側の値を、左側の変数に入れる」という働きをします。
        </p>
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white">
            $hensuu = "何らかのデータ"; <span class="text-gray-500">// 右から左へ代入！</span>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            代数演算子（四則計算と剰余）
        </h4>
        <p class="text-gray-700">算数や数学でおなじみの計算記号です。プログラミング特有の <code>%</code> に注目しましょう。</p>
        
        <div class="overflow-hidden border border-gray-200 rounded-lg">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 font-bold">
                    <tr>
                        <th class="px-4 py-2 border-b">演算子</th>
                        <th class="px-4 py-2 border-b">意味</th>
                        <th class="px-4 py-2 border-b">例</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="border-b">
                        <td class="px-4 py-2 font-mono font-bold">+</td>
                        <td class="px-4 py-2">足し算</td>
                        <td class="px-4 py-2">1 + 2 (3)</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-mono font-bold">-</td>
                        <td class="px-4 py-2">引き算</td>
                        <td class="px-4 py-2">1 - 2 (-1)</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-mono font-bold">*</td>
                        <td class="px-4 py-2">掛け算</td>
                        <td class="px-4 py-2">2 * 5 (10)</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-mono font-bold">/</td>
                        <td class="px-4 py-2">割り算</td>
                        <td class="px-4 py-2">6 / 3 (2)</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono font-bold">%</td>
                        <td class="px-4 py-2 text-indigo-600 font-bold">余り算（剰余）</td>
                        <td class="px-4 py-2">5 % 2 (1)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-gray-900 rounded-lg p-4 font-mono text-xs text-white">
            <span class="text-gray-500">// test.phpで実行してみましょう</span><br>
            $num5 = 5 % 2;<br>
            var_dump($num5); <span class="text-gray-500">// int(1)</span>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            文字列を連結する演算子
        </h4>
        <p class="text-gray-700">
            文字列同士をくっつけるには <code>.</code>（ドット）を使います。
        </p>
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-green-400">
            $str = "こんにちは" . "太郎さん";<br>
            print $str; <span class="text-gray-500">// こんにちは太郎さん</span>
        </div>

        <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4">
            <h5 class="font-bold text-indigo-900 mb-1">改行定数：PHP_EOL</h5>
            <p class="text-xs text-indigo-800 leading-relaxed">
                OS（Windows/Macなど）に依存せず正しく改行コードを入れるには、<code>PHP_EOL</code> という定数をドットで連結します。<br>
                <code class="text-[10px] bg-white p-1 rounded">print "1行目" . PHP_EOL . "2行目";</code>
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            比較演算子
        </h4>
        <p class="text-gray-700">
            2つの値を比べ、結果を <strong>bool型（true / false）</strong>で返します。
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white border rounded-lg p-3 text-xs space-y-1">
                <p><span class="font-mono font-bold text-blue-600">==</span> : 等しい</p>
                <p><span class="font-mono font-bold text-blue-600">!=</span> : 等しくない</p>
                <p><span class="font-mono font-bold text-blue-600">&lt; / &gt;</span> : 小さい / 大きい</p>
                <p><span class="font-mono font-bold text-blue-600">&lt;= / &gt;=</span> : 以下 / 以上</p>
            </div>
            <div class="bg-red-50 p-4 rounded-lg border border-red-100 self-center">
                <p class="text-xs text-red-800 font-bold">⚠️ 注意！</p>
                <p class="text-[10px] text-red-700">
                    代入は <code>=</code>、比較は <code>==</code> です。プログラミング初心者が最も間違えやすいポイントの一つです。
                </p>
            </div>
        </div>

        <div class="bg-gray-900 rounded-lg p-4 font-mono text-xs text-white">
            var_dump(1 < 2);  <span class="text-gray-500">// bool(true)</span><br>
            var_dump(1 == 2); <span class="text-gray-500">// bool(false)</span>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            論理演算子
        </h4>
        <p class="text-gray-700">「かつ」「または」など、複数の条件を組み合わせます。</p>
        
        <div class="bg-gray-50 rounded-xl p-5 space-y-4">
            <div class="flex items-center gap-4">
                <code class="text-blue-700 font-bold bg-white px-2 py-1 rounded shadow-sm text-sm">&&</code>
                <p class="text-sm text-gray-700"><strong>かつ (AND)</strong> : 両方の条件がtrueならtrue</p>
            </div>
            <div class="flex items-center gap-4">
                <code class="text-blue-700 font-bold bg-white px-2 py-1 rounded shadow-sm text-sm">||</code>
                <p class="text-sm text-gray-700"><strong>または (OR)</strong> : どちらかがtrueならtrue</p>
            </div>
            <div class="flex items-center gap-4">
                <code class="text-blue-700 font-bold bg-white px-2 py-1 rounded shadow-sm text-sm">!</code>
                <p class="text-sm text-gray-700"><strong>〜ではない (NOT)</strong> : 反転（trueならfalseに）</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            （補足）暗黙の型変換
        </h4>
        <div class="bg-white border-2 border-dashed border-gray-200 rounded-xl p-6">
            <p class="text-sm text-gray-700 leading-relaxed mb-4">
                本来、型が違うと計算できませんが、PHPは空気を読んで<strong>「勝手に型を変換」</strong>してくれます。
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-100 p-3 rounded">
                    <p class="text-[10px] font-bold text-gray-400 mb-1 uppercase">Numeric string Math</p>
                    <code class="text-xs">10 + "20" → <span class="text-indigo-600 font-bold">30</span></code>
                    <p class="text-[10px] text-gray-500 mt-1">"20"を数値の20として処理</p>
                </div>
                <div class="bg-gray-100 p-3 rounded">
                    <p class="text-[10px] font-bold text-gray-400 mb-1 uppercase">String Concatenation</p>
                    <code class="text-xs">10 . "です" → <span class="text-indigo-600 font-bold">"10です"</span></code>
                    <p class="text-[10px] text-gray-500 mt-1">数値の10を文字列に変換</p>
                </div>
            </div>
            <p class="mt-4 text-xs text-red-600 font-bold italic">
                ※ 便利ですが、意図しないバグの原因にもなるため、基本的には同じ型同士で演算するのがベストです。
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}