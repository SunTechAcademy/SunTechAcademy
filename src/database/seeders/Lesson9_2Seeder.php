<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson9_2Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson 9 (PHPその2) を取得
        $lesson9 = Lesson::where('title', 'PHPその2')->first();

        if (!$lesson9) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson9->id,
                'sort_order' => 2
            ],
            [
                'title' => '条件分岐',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            まずはプログラムの「判断力」となる<strong>条件分岐（じょうけんぶんき）</strong>について学びましょう。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            if文
        </h4>
        <p class="text-gray-700">
            代表的なのは <strong>if文</strong> です。英語で「もし〜ならば」という意味の通り、「もしこの変数が0以上ならば」といった条件をつけて処理を分けます。
        </p>
        <p class="text-sm text-gray-600">
            コンピュータに「こういうときはこうしてくれ」とあらかじめ教えておくことで、ユーザーの入力や状況に応じた柔軟なプログラムが可能になります。
        </p>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white">
            <span class="text-gray-500">// 10 > 5 は正しい(true)ので、{ } の中が実行される</span><br>
            if (10 > 5) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;print "表示されます" . PHP_EOL;<br>
            }<br><br>
            <span class="text-gray-500">// 10 <= 5 は間違い(false)なので、無視される</span><br>
            if (10 <= 5) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;print "表示されません" . PHP_EOL;<br>
            }
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            if-else文
        </h4>
        <p class="text-gray-700">
            <strong>else（エルス）</strong>を使うと、「条件に合わなかった場合（その他）」の処理も書けるようになります。
        </p>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white">
            $number = mt_rand() % 10; <span class="text-gray-500">// 0〜9のランダムな数</span><br><br>
            if ($number < 5) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;print $number . "は5より小さい数";<br>
            } else {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;print $number . "は5以上の数";<br>
            }
        </div>
        <p class="text-xs text-gray-500">※ <code>mt_rand()</code> はランダムな数字を生成する関数です。</p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            if-elseif-else文
        </h4>
        <p class="text-gray-700">
            <strong>elseif</strong> を加えれば、条件を3つ以上に増やすことができます。
        </p>
        
        

        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white">
            if ($number < 3) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;print "3より小さい";<br>
            } elseif ($number < 6) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;print "3以上、6より小さい";<br>
            } else {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;print "それ以外";<br>
            }
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            （補足）switch式
        </h4>
        <p class="text-gray-700 italic">
            「変数の値が A か、B か、C か」のように、<strong>特定の値と一致するかどうか</strong>を何度も比べる場合は、<code>switch</code> を使うとスッキリ書けます。
        </p>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white">
            switch($opr) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;case "+":<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print $num1 + $num2;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>break;</strong> <span class="text-gray-500">// ここで終了</span><br>
            &nbsp;&nbsp;&nbsp;&nbsp;case "-":<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print $num1 - $num2;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>break;</strong><br>
            &nbsp;&nbsp;&nbsp;&nbsp;default:<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print "エラーです";<br>
            }
        </div>

        <div class="bg-red-50 border-l-4 border-red-400 p-4 space-y-2">
            <h5 class="font-bold text-red-900 text-sm">⚠️ 注意：breakを忘れずに！</h5>
            <p class="text-xs text-red-800 leading-relaxed">
                <code>break</code> を書き忘れると、条件が一致した後の処理が終わらず、そのまま下の <code>case</code> の処理まで実行されてしまいます。
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}