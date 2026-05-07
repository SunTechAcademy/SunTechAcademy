<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson8_5Seeder extends Seeder
{
    public function run(): void
    {
        $lesson8 = Lesson::where('title', 'PHPその1')->first();

        if (!$lesson8) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson8->id,
                'sort_order' => 5
            ],
            [
                'title' => 'データの型',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            ここまで何の説明もなしに数値や文字列を扱ってきましたが、PHPには<strong>「データの型」</strong>という概念があります。
        </p>
        <p class="text-gray-700">
            なぜ型が必要なのでしょうか？ それは、<strong>型が違うとデータの扱い方も変わるから</strong>です。
        </p>
        <div class="bg-red-50 p-6 rounded-xl border border-red-100 flex items-start gap-4">
            <span class="text-2xl">🤔</span>
            <div>
                <p class="font-bold text-red-800">意味のない演算の例</p>
                <p class="text-sm text-red-700">「10 ÷ あいうえお」 ...これ、計算できませんよね？</p>
            </div>
        </div>
        
        <p class="text-sm text-gray-600">
            コンピュータが「これは計算できる数値だ」「これは表示するだけの文字だ」と判断するために、データ型という仕組みが存在します。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            数値型（整数と実数）
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <h5 class="font-bold text-gray-800">整数値 (int)</h5>
                <p class="text-sm text-gray-600">小数を含まない数値です。</p>
                <div class="bg-gray-900 rounded-lg p-4 font-mono text-xs text-white">
                    $num = 2;<br>
                    var_dump($num); <span class="text-gray-500">// int(2) と表示される</span>
                </div>
            </div>
            <div class="space-y-3">
                <h5 class="font-bold text-gray-800">実数値 (float)</h5>
                <p class="text-sm text-gray-600">浮動小数点数とも呼ばれます。</p>
                <div class="bg-gray-900 rounded-lg p-4 font-mono text-xs text-white">
                    $num = 1.2;<br>
                    var_dump($num); <span class="text-gray-500">// float(1.2) と表示される</span>
                </div>
            </div>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
            <p class="text-xs text-yellow-800">
                <strong>💡 var_dump() とは：</strong><br>
                <code>print</code> よりも詳細に、データの「型」や「中身」を詳しく表示するデバッグ用の命令です。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            文字列型 (string)
        </h4>
        <p class="text-gray-700">
            Web制作において最も多く扱う型です。<code>\'</code> または <code>"</code> で囲みます。
        </p>
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-green-400">
            $str = "テキスト";<br>
            var_dump($str); <span class="text-gray-500">// string(12) "テキスト"</span>
        </div>
        <div class="bg-white border p-4 rounded-lg text-sm text-gray-600">
            <strong>バイト数のナゾ：</strong><br>
            PHPの文字列はバイト単位で計算されます。UTF-8という設定では、日本語1文字は3バイトになるため、4文字の「テキスト」は <strong>string(12)</strong> と表示されます。
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            配列型 (array)
        </h4>
        <p class="text-gray-700">
            複数の値をまとめて管理する「ロッカー」のような箱です。
        </p>

        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
            <h5 class="font-bold text-indigo-900 mb-2">添字（そえじ）配列</h5>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white mb-4">
                $fruits = [\'リンゴ\', \'バナナ\', \'オレンジ\'];<br>
                print $fruits[0]; <span class="text-gray-500">// リンゴ が表示される</span>
            </div>
            <p class="text-xs text-indigo-800">
                ※ 配列の番号は <strong>0番目から始まる</strong> ことに注意しましょう！
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h6 class="font-bold text-xs uppercase text-gray-400 mb-2">var_dump() の結果</h6>
                <pre class="text-[10px] text-gray-700">array(3) { [0]=> string(9) "リンゴ" ... }</pre>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h6 class="font-bold text-xs uppercase text-gray-400 mb-2">print_r() の結果</h6>
                <pre class="text-[10px] text-gray-700">Array ( [0] => リンゴ [1] => バナナ ... )</pre>
                <p class="text-[10px] text-gray-500 mt-1">※値のみを表示するので見やすいのが特徴です。</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            連想配列
        </h4>
        <p class="text-gray-700">
            番号（0, 1, 2...）の代わりに、好きな<strong>「名前（キー）」</strong>で管理できる配列です。
        </p>
        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white">
            <span class="text-blue-400">$fruits</span> = [<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-green-400">\'apple\'</span> => <span class="text-yellow-400">\'リンゴ\'</span>,<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-green-400">\'banana\'</span> => <span class="text-yellow-400">\'バナナ\'</span>,<br>
            ];<br>
            print <span class="text-blue-400">$fruits</span>[<span class="text-green-400">\'apple\'</span>]; <span class="text-gray-500">// リンゴ</span>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <h5 class="font-bold text-blue-900 text-sm mb-2">アンパック記法 (...)</h5>
            <p class="text-xs text-blue-800 mb-2">既存の配列を別の配列の中に展開することができます。</p>
            <div class="bg-white p-3 rounded font-mono text-xs border border-blue-200">
                $ary1 = [\'apple\' => \'リンゴ\'];<br>
                $ary2 = [\'orange\' => \'オレンジ\', <span class="text-red-600">...$ary1</span>];
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            論理値型・NULL型
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <h5 class="font-bold text-gray-800">論理値 (bool)</h5>
                <p class="text-xs text-gray-600"><code>true</code> (真) か <code>false</code> (偽) の2種類だけ。条件分岐で大活躍します。</p>
            </div>
            <div class="space-y-3">
                <h5 class="font-bold text-gray-800">NULL (null)</h5>
                <p class="text-xs text-gray-600">「何もない」「空っぽ」を意味する特別な値です。</p>
            </div>
        </div>

        <div class="mt-8 border-t pt-8">
            <h4 class="font-bold text-lg text-gray-800 mb-4">発展的な型</h4>
            <ul class="space-y-4">
                <li class="flex items-start gap-3">
                    <span class="bg-gray-100 p-2 rounded text-xs font-bold">Object</span>
                    <p class="text-sm text-gray-600">オブジェクト指向で使います。のちのレッスンで詳しく学びます。</p>
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-gray-100 p-2 rounded text-xs font-bold">Enum</span>
                    <p class="text-sm text-gray-600">列挙型。独自に定義した特別な値を扱いたいときに使用します。</p>
                </li>
            </ul>
        </div>
    </section>
</div>'
            ]
        );
    }
}