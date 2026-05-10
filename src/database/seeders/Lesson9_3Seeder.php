<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson9_3Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson 9 (PHPその2) を取得
        $lesson9 = Lesson::where('title', 'PHPその2')->first();

        if (!$lesson9) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson9->id,
                'sort_order' => 3
            ],
            [
                'title' => '繰り返し（ループ）',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            条件分岐に続いて、同じく制御文である<strong>「繰り返し」</strong>を学びます。
        </p>
        <p class="text-gray-700">
            繰り返しは、回数を指定してその回数だけ同じ処理を実行したり、条件分岐と組み合わせて特定の状態になるまで永遠に処理を繰り返す、といったことが可能です。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            for文
        </h4>
        <p class="text-gray-700">
            まずは、もっともわかりやすい <strong>for文</strong> から紹介します。「何回繰り返すか」が最初から決まっている処理を作りたいときに使います。
        </p>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white overflow-x-auto">
<pre><code>&lt;?php
    for ($i = 1; $i <= 10; $i++) {
        print $i . '回目' . PHP_EOL;
    }</code></pre>
        </div>

        <div class="bg-gray-100 border-l-4 border-gray-400 p-4 font-mono text-sm">
            <strong>【実行結果】</strong><br>
            1回目<br>2回目<br>...<br>10回目
        </div>

        <p class="text-gray-700 leading-relaxed">
            <code>($i = 1; $i <= 10; $i++)</code> の書式は <strong>(変数の初期化; 繰り返す条件; 変数の増加)</strong> となっています。<br>
            ・<code>$i = 1;</code> : 最初に $i を 1 で準備します。<br>
            ・<code>$i <= 10;</code> : $i が 10 を超えるまで繰り返します。<br>
            ・<code>$i++</code> : 1回終わるごとに $i を 1 増やします（インクリメント）。
        </p>

        <p class="text-gray-700 mt-4">配列と組み合わせると、中身を順番に取り出すこともできます。</p>
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white overflow-x-auto">
<pre><code>&lt;?php
    $fruits = ['リンゴ', 'バナナ', 'オレンジ', 'ぶどう', '桃'];
    $count = count($fruits); // 配列の数を数える
    
    for ($i = 0; $i < $count; $i++) {
        print $i . '番目: ' . $fruits[$i] . PHP_EOL;
    }</code></pre>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            while文
        </h4>
        <p class="text-gray-700">
            次に、<strong>何回繰り返せばよいかわからない場合</strong>について説明します。例えば「ランダムな数値で9が出るまで繰り返す」といった場合は <strong>while文</strong> を使います。
        </p>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white overflow-x-auto">
<pre><code>&lt;?php
    $number = 0; // 変数の初期化

    while ($number != 9) { // 9じゃない間はずっと繰り返す
        $number = mt_rand() % 10;
        print $number . PHP_EOL;
    }</code></pre>
        </div>

        <p class="text-gray-700">
            <code>($number != 9)</code> が <code>true</code> を返す限り（つまり9以外が出続ける限り）、何度も繰り返されます。
        </p>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 mt-6">
            <h5 class="font-bold text-blue-900 mb-2">（補足）do-while文</h5>
            <p class="text-sm text-blue-800 mb-4">
                while文は最初に条件を確認しますが、<strong>「最低でも1回は必ず実行してから、条件を確認したい」</strong>場合は <code>do-while文</code> を使います。
            </p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-xs text-white overflow-x-auto">
<pre><code>&lt;?php
    $number = 0;
    do {
        $number = mt_rand() % 10;
        print $number . PHP_EOL;
    } while ($number != 9); // 最後に必ず ; をつけること</code></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            foreach文
        </h4>
        <p class="text-gray-700">
            配列の中身をすべて列挙したいときは、for文よりも <strong>foreach文</strong> が圧倒的に便利です。配列の要素数などを意識せずに済みます。
        </p>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white overflow-x-auto">
<pre><code>&lt;?php
    $fruits = ['リンゴ', 'バナナ', 'オレンジ', 'ぶどう', '桃'];
    
    foreach ($fruits as $key => $fruit) {
        print $key . '番目: ' . $fruit . PHP_EOL;
    }</code></pre>
        </div>

        <p class="text-gray-700">
            <code>$fruits as $key => $fruit</code> は「配列から1件取り出して、場所の数値を $key に、中身を $fruit に代入する」という意味です。<br>
            何番目か（$key）が不要な場合は、単に <code>foreach ($fruits as $fruit)</code> と書くこともできます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            （補足）break文とcontinue文
        </h4>
        <p class="text-gray-700">
            ループの途中で処理をコントロールするための命令が2つあります。
        </p>
        <ul class="list-disc ml-6 text-gray-700 space-y-2">
            <li><strong>break文：</strong> 繰り返し処理を強制的に<strong>終了（ループを抜ける）</strong>します。</li>
            <li><strong>continue文：</strong> その回の処理をスキップして、<strong>次の回にジャンプ</strong>します。</li>
        </ul>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white overflow-x-auto mt-4">
<pre><code>&lt;?php
    $i = 0;
    while(true) { // 無限ループ
        $i++;
        if ($i > 20) {
            break; // $iが20を超えたらループを抜ける
        }

        if ($i % 2 == 1) {
            continue; // $iが奇数なら以降の処理をスキップ
        }

        print $i . PHP_EOL; // 結果的に偶数だけが表示される
    }</code></pre>
        </div>

        <div class="bg-red-50 border-l-4 border-red-400 p-4 mt-4">
            <h5 class="font-bold text-red-900 text-sm">⚠️ 無限ループに注意！</h5>
            <p class="text-xs text-red-800 leading-relaxed mt-1">
                <code>while(true)</code> のような無限ループを書く際、<code>break</code> を書き忘れるとプログラムが永遠に終了せず、システムに多大な負荷をかけます。終わらなくなった場合はキーボードの <code>Ctrl + C</code> で強制停止させてください。
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}