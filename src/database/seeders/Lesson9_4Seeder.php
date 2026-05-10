<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson9_4Seeder extends Seeder
{
    public function run(): void
    {
        $lesson9 = Lesson::where('title', 'PHPその2')->first();
        if (!$lesson9) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson9->id, 'sort_order' => 4],
            [
                'title' => '関数',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-16">
    <section class="space-y-6">
        <p class="text-lg text-gray-700 leading-relaxed">
            プログラミングにおける<strong>関数（Function）</strong>とは、特定の目的を持った一連の処理をひとまとめにして、名前をつけた「部品」のことです。<br>
            料理で例えるなら、「野菜を切る」「炒める」といった個別の動作をまとめて<strong>「野菜炒めを作る」という一つの命令</strong>にするようなイメージです。
        </p>
        <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100">
            <h5 class="font-bold text-indigo-900 mb-2">なぜ関数を使うのか？（メリット）</h5>
            <ul class="list-disc ml-6 space-y-2 text-indigo-800">
                <li><strong>再利用性：</strong> 一度作れば、何度でも呼び出せる。</li>
                <li><strong>保守性：</strong> 処理を修正したいとき、一箇所直せばすべてに反映される。</li>
                <li><strong>可読性：</strong> メインの処理がスッキリし、コードの意味が分かりやすくなる。</li>
            </ul>
        </div>
        
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">1. 関数の定義と呼び出し</h4>
        <p class="text-gray-700">
            関数は勝手には動きません。まず作り方を定義し（<strong>定義</strong>）、その後に名前を呼んで実行（<strong>呼び出し</strong>）する必要があります。
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <p class="font-bold text-gray-600">【定義の基本形】</p>
                <div class="bg-gray-900 rounded-xl p-5 font-mono text-sm text-white shadow-lg">
<pre><code>function 関数名() {
    // 実行したい処理
}</code></pre>
                </div>
            </div>
            <div class="space-y-2">
                <p class="font-bold text-gray-600">【呼び出し】</p>
                <div class="bg-gray-900 rounded-xl p-5 font-mono text-sm text-white shadow-lg">
<pre><code>関数名();</code></pre>
                </div>
            </div>
        </div>

        <div class="bg-white border-2 border-dashed border-gray-200 p-6 rounded-xl">
            <p class="text-gray-700 font-medium mb-4">実例：1から9までを合計して表示する</p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-xs text-white">
<pre><code>&lt;?php
    function sum() {
        $result = 0;
        for ($i = 1; $i <= 9; $i++) {
            $result += $i;
        }
        print "合計結果: " . $result . PHP_EOL;
    }

    sum(); // ここで初めて中のfor文が動き、45が表示される
    sum(); // もう一度呼べば、また同じ計算をしてくれる（再利用）</code></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">2. 引数（ひきすう）：関数に情報を渡す</h4>
        <p class="text-gray-700 leading-relaxed">
            先ほどの <code>sum()</code> は常に1〜9しか計算できませんでした。しかし、<strong>引数</strong>を使うことで、「1から10まで」「1から100まで」など、外から渡された値に応じて動的に処理を変えることができます。
        </p>
        
        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white shadow-lg">
<pre><code>&lt;?php
    // $a, $b を「仮引数（かりひきすう）」と呼ぶ
    function sum($a, $b) {
        $result = 0;
        for ($i = $a; $i <= $b; $i++) {
            $result += $i;
        }
        print $a . "から" . $b . "までの合計: " . $result . PHP_EOL;
    }

    // 渡す値を「実引数（じつひきすう）」と呼ぶ
    sum(1, 10);   // 1から10までの合計を表示
    sum(50, 100); // 50から100までの合計を表示</code></pre>
        </div>

        <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-100">
            <h5 class="font-bold text-yellow-900 mb-2">✨ 名前付き引数（名前で指定する）</h5>
            <p class="text-sm text-yellow-800 leading-relaxed">
                通常、引数は順番通りに渡す必要があります。しかし、引数が非常に多い場合、順番を間違えると大惨事になります。そこで<strong>引数の名前を直接指定</strong>する方法が便利です。
            </p>
            <div class="bg-gray-800 rounded-lg p-3 mt-3 font-mono text-xs text-white">
                <code>sum(b: 100, a: 1); // 順番が逆でも、名前が合っていれば正しく伝わる</code>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">3. 戻り値（返り値）：結果を持ち帰る</h4>
        <p class="text-gray-700 leading-relaxed">
            これまでの例では関数内で <code>print</code> して終わりでしたが、実務では<strong>「計算結果を別の場所で使いたい」</strong>ことがほとんどです。<br>
            <code>return</code> を使うと、関数の実行結果を呼び出し元にプレゼントとして持ち帰ることができます。
        </p>

        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white shadow-lg">
<pre><code>&lt;?php
    function get_sum($a, $b) {
        $result = 0;
        for ($i = $a; $i <= $b; $i++) {
            $result += $i;
        }
        return $result; // ここで値を外に放り出す
    }

    // 戻り値を受け取って、変数 $total に代入
    $total = get_sum(1, 10);
    
    // 受け取った値を使って、さらに別の計算ができる
    print "合計の2倍は: " . ($total * 2);</code></pre>
        </div>
        <p class="bg-red-50 text-red-700 p-3 rounded text-sm">
            <strong>重要：</strong> <code>return</code> が実行された瞬間、その関数の処理は強制終了します。それより下に書いたコードは実行されません。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">4. 列挙型（Enum）：安全な選択肢</h4>
        <p class="text-gray-700">
            引数に「何でも入れられる」のは便利ですが、間違いの元です。例えば「コース名」に、存在しないコースを入れられないようにしたい場合に<strong>Enum</strong>を使います。
        </p>
        <div class="bg-green-50 p-6 rounded-xl border border-green-100">
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-xs text-white">
<pre><code>&lt;?php
enum CourseName: string {
    case PHP = 'PHPプログラマー';
    case Laravel = 'Laravelマスター';
}

function show_course(CourseName $course) {
    // $course->value で文字列のほうを取り出せる
    print "受講コースは: " . $course->value;
}

// 呼び出し方
show_course(CourseName::PHP); // 安全に「PHP」を渡せる</code></pre>
            </div>
            <p class="text-xs text-green-800 mt-3">
                ※これを使うと、タイピングミスで <code>"PPH"</code> などと渡してしまうミスを、プログラムが実行前に防いでくれます。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">5. 第一級callable：関数を変数に入れる</h4>
        <p class="text-gray-700 italic">
            「関数そのもの」を一つの道具（変数）として持ち歩くことができる記法です（PHP 8.1〜）。
        </p>
        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white">
<pre><code>&lt;?php
    // strlen（文字の長さを測る関数）を変数にセット
    $count_tool = strlen(...); 

    // 変数を使って実行できる
    print $count_tool('Techacademy'); // 11</code></pre>
        </div>
        <p class="text-sm text-gray-500">
            将来的に「関数の中に別の関数を渡す」といった高度なプログラミング（高階関数）を行う際に非常に役立ちます。今は「こんな書き方ができるんだな」程度でOKです。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}