<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_5Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 5],
            [
                'title' => 'クラスとインスタンスの基本',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-16">
    <p class="text-lg text-gray-700 leading-relaxed">
        シンプルなコード例をとおして、クラスとインスタンスの基本について理解を深めましょう。
    </p>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">1. クラスを宣言する</h3>
        <p class="text-gray-700">
            クラスの宣言部分には最初に <code>class クラス名 {...}</code> と書きます。これが<strong>「設計図の紙」</strong>だと思ってください。
        </p>
        
        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white shadow-lg">
            <p class="text-gray-500 mb-2">// クラスの宣言方法（まだ何のPHPファイルにも書かないでください）</p>
<pre><code>class Slime {
    // オブジェクトの変数（値）＝ プロパティ
    public $type = 'スライム';
    public $hp = 10;
    public $power = 3;

    // オブジェクトの関数（処理）＝ メソッド
    function attack($character_name) {
        print $this->type . 'が' . $character_name . 'を攻撃して' . $this->power . 'ポイントのダメージを与えた！' . PHP_EOL;
    }
}</code></pre>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-5 rounded-xl border border-blue-100">
                <h5 class="font-bold text-blue-900 mb-2 italic">public</h5>
                <p class="text-sm text-blue-800 leading-relaxed">
                    変数の前にある <strong>public</strong> は「アクセス権」を表します。これが付いている変数は、クラスの外からでも自由に値を見たり変えたりできます。詳細は後ほど学びます。
                </p>
            </div>
            <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100">
                <h5 class="font-bold text-indigo-900 mb-2 italic">$this</h5>
                <p class="text-sm text-indigo-800 leading-relaxed">
                    <strong>$this</strong> は「自分自身」を指す特殊な変数です。設計図の中で「自分のHP」や「自分の攻撃力」を参照したい時に使います。
                </p>
            </div>
        </div>
        <p class="text-sm text-red-500 font-bold">
            ※注意：クラスを宣言しただけでは何も起きません。設計図を書いただけの状態だからです。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">2. クラスからインスタンスを生成する</h3>
        <p class="text-gray-700 leading-relaxed">
            設計図（クラス）から実体を作るには <strong>new クラス名()</strong> という命令を使います。これを「インスタンス化」と呼びます。
        </p>

        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white">
<pre><code>// インスタンスの生成と、変数への代入
$slime_A = new Slime();
$slime_B = new Slime();
$slime_C = new Slime();

// インスタンスの使用（メソッドの呼び出し）
$slime_A->attack('主人公');
$slime_B->attack('主人公');</code></pre>
        </div>

        <div class="bg-gray-50 p-6 rounded-2xl flex flex-col items-center border border-gray-200">
            <p class="text-gray-600 mb-4 text-center">
                設計士が作った「1枚の設計図」から、工場で「大量の製品」が生産されるイメージです。
            </p>
            <img src="/images/Lesson9-4.png" alt="クラスとインスタンスの関係イメージ" class="max-w-full h-auto rounded-lg shadow-md">
            <p class="text-xs text-gray-400 mt-2">設計図(Class) → 工場(new) → 実体(Instance)</p>
        </div>

        <div class="bg-white border-l-4 border-[#6A73A6] p-4 shadow-sm">
            <p class="text-gray-700 italic">
                コードが非常に読みやすくなっていることに注目してください。<br>
                <code>$slime_A->attack('主人公');</code> は、まるで英語や日本語の文章のように「誰が、何を、どうした」が直感的に伝わります。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="text-xl font-bold text-gray-800">一度、コードを書いて実行してみましょう</h4>
        <div class="bg-gray-800 rounded-t-lg px-4 py-2 text-white text-xs font-mono">test_class.php</div>
        <div class="bg-gray-900 rounded-b-xl p-6 font-mono text-sm text-white">
<pre><code><?php
class Slime {
    public $type = 'スライム';
    public $hp = 10;
    public $power = 3;

    function attack($character_name) {
        print $this->type . 'が' . $character_name . 'を攻撃して' . $this->power . 'ポイントのダメージを与えた！' . PHP_EOL;
    }
}

$slime_A = new Slime();
$slime_A->attack('主人公');

// オブジェクトの中身を詳しく見る
print_r($slime_A);</code></pre>
        </div>

        <div class="space-y-2">
            <p class="font-bold text-gray-600">実行コマンド</p>
            <kbd class="bg-black text-green-400 p-3 rounded block font-mono">php test_class.php</kbd>
        </div>

        <div class="space-y-2">
            <p class="font-bold text-gray-600">実行結果</p>
            <div class="bg-gray-100 p-4 rounded font-mono text-sm text-gray-800 border border-gray-300">
                スライムが主人公を攻撃して3ポイントのダメージを与えた！<br>
                Slime Object (<br>
                &nbsp;&nbsp;&nbsp;&nbsp;[type] => スライム<br>
                &nbsp;&nbsp;&nbsp;&nbsp;[hp] => 10<br>
                &nbsp;&nbsp;&nbsp;&nbsp;[power] => 3<br>
                )
            </div>
        </div>
    </section>

    <section class="space-y-6 bg-slate-50 p-8 rounded-2xl border border-slate-200">
        <h3 class="text-2xl font-bold text-slate-800">アロー演算子 (->)</h3>
        <p class="text-slate-700">
            <code>-></code> はアロー（矢印）演算子と呼ばれます。日本語の助詞<strong>「の」</strong>だと解釈すると非常に分かりやすくなります。
        </p>
        <div class="flex flex-col md:flex-row gap-6 justify-center">
            <div class="bg-white p-4 rounded shadow-sm text-center">
                <code class="text-indigo-600 font-bold">$slime_A->attack()</code>
                <p class="text-xs text-gray-500 mt-2">スライムA「の」攻撃メソッドを呼ぶ</p>
            </div>
            <div class="bg-white p-4 rounded shadow-sm text-center">
                <code class="text-indigo-600 font-bold">$slime_A->type</code>
                <p class="text-xs text-gray-500 mt-2">スライムA「の」名前プロパティを見る</p>
            </div>
        </div>
        <p class="text-sm text-red-600 italic">
            ※注意：プロパティを参照するとき、矢印の後ろに「$」は不要です。（誤：$slime-><strong>$</strong>type）
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">$this の正体</h3>
        <p class="text-gray-700 leading-relaxed">
            <code>$this</code> は、<strong>「今まさにその関数を呼び出している自分自身のインスタンス」</strong>に置き換わります。
        </p>
        
        <div class="bg-indigo-900 text-indigo-100 p-6 rounded-xl space-y-4">
            <p class="text-sm">
                <code>$slime_A->attack()</code> と呼んだ時、クラス内の <code>$this</code> は内部的に <code>$slime_A</code> に変身します。
            </p>
            <div class="bg-black bg-opacity-30 p-4 rounded font-mono text-xs">
                print <span class="text-yellow-400">$slime_A</span>->type . 'が' ...
            </div>
            <p class="text-sm">
                そのため、100匹のスライムを作っても、お互いのHPや攻撃力が混ざることはありません。これを<strong>インスタンス変数</strong>や<strong>インスタンスメソッド</strong>と呼びます。
            </p>
        </div>
        
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2 flex items-center gap-2">
            Nullsafe演算子 (?->)
            <span class="text-xs bg-green-500 text-white px-2 py-1 rounded-full font-normal">PHP 8.0+</span>
        </h3>
        <p class="text-gray-700">
            もし変数が <code>null</code>（空っぽ）だった場合、そのままアロー演算子を使うとエラーでプログラムが止まってしまいます。それを防ぐのが <strong>?-></strong> です。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-100 p-4 rounded-lg">
                <p class="text-xs font-bold text-gray-500 mb-2 uppercase">Traditional Way (if check)</p>
                <div class="bg-gray-900 text-white p-3 rounded font-mono text-xs">
<pre><code>if ($slime !== null) {
    $slime->attack('主人公');
}</code></pre>
                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg">
                <p class="text-xs font-bold text-blue-500 mb-2 uppercase">Nullsafe Way</p>
                <div class="bg-gray-900 text-white p-3 rounded font-mono text-xs">
<pre><code>// 1行で安全に実行
$slime?->attack('主人公');</code></pre>
                </div>
            </div>
        </div>
        <p class="text-sm text-gray-600 italic">
            「もし <code>$slime</code> が存在すれば実行して、いなければ何もしない」というスマートな書き方です。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}