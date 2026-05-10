<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_6Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 6],
            [
                'title' => 'コンストラクタ',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
        <p class="text-indigo-900 font-medium text-lg">
            インスタンスを生成するとき（new した瞬間）、自動的に実行される特別な関数を <strong>コンストラクタ</strong> と呼びます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">コンストラクタとは</h3>
        <p class="text-gray-700 leading-relaxed">
            コンストラクタは、インスタンスを「初期化」するための関数です。
            これまでのSlimeクラスでは、すべてのスライムが同じHP、同じ攻撃力でしたが、コンストラクタを使うことで<strong>「スライムA」「スライムB」のように、個体ごとに異なる初期値</strong>を持たせることができます。
        </p>
        
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h5 class="font-bold text-gray-800 mb-2">書き方のルール</h5>
            <p class="text-sm text-gray-600">
                <code>function __construct() { ... }</code> という名前で作成します。<br>
                <span class="text-red-500 font-bold">※アンダーバーは「_」が2個続きます。</span>
            </p>
        </div>

        <div class="space-y-4">
            <p class="font-bold text-gray-700">test_class.php を以下のように上書きして実行してみましょう。</p>
            <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white">
<pre><code><?php
class Slime {
    public $type = 'スライム';
    public $suffix = ''; // AやBなどの接尾辞を入れる箱
    public $hp = 10;
    public $power = 3;

    // newされた瞬間に動く
    function __construct($suffix) {
        $this->suffix = $suffix;
    }

    function name() {
        return $this->type . $this->suffix;
    }

    function attack($character_name) {
        print $this->name() . 'が' . $character_name . 'を攻撃して' . $this->power . 'ポイントのダメージを与えた！' . PHP_EOL;
    }
}

// インスタンス化の際に引数を渡す
$slime_A = new Slime('A');
$slime_A->attack('主人公');</code></pre>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2">実行コマンド</p>
                <kbd class="bg-black text-green-400 p-2 rounded block font-mono text-xs">php test_class.php</kbd>
            </div>
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2">実行結果</p>
                <p class="font-mono text-sm text-blue-600">スライムAが主人公を攻撃して3ポイントのダメージを与えた！</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">$this の挙動を詳しく追う</h3>
        <p class="text-gray-700 leading-relaxed">
            <code>$slime_A->attack('主人公');</code> が呼ばれたとき、プログラムの内部では以下のように値が置き換わっています。
        </p>

        <div class="space-y-4">
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded mt-1">STEP 1</span>
                <p class="text-sm text-gray-600"><code>$this->name()</code> が実行される。内部では <code>$this->type . $this->suffix</code>（スライム + A）となり、<strong>「スライムA」</strong>が返る。</p>
            </div>
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded mt-1">STEP 2</span>
                <p class="text-sm text-gray-600"><code>$character_name</code> に引数の <strong>「主人公」</strong> が入る。</p>
            </div>
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded mt-1">STEP 3</span>
                <p class="text-sm text-gray-600"><code>$this->power</code> が <code>$slime_A->power</code>（つまり <strong>3</strong>）に置き換わる。</p>
            </div>
        </div>

        
    </section>

    <section class="space-y-6 border-t pt-10">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">readonly プロパティ</h3>
        <p class="text-gray-700">
            <strong>readonly</strong> プロパティとは、その名の通り「読み取り専用」の変数です。
            一度コンストラクタで値を決めたら、後から書き換えることができないように制限をかけ、プログラムの安全性を高めることができます。
        </p>

        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white">
<pre><code>class Slime {
    public $hp = 10;
    public readonly int $power; // 読み取り専用
    
    function __construct($suffix) {
        $this->suffix = $suffix;
        $this->power = 3; // ここでは代入可能
    }
}

$slime_A = new Slime('A');
$slime_A->hp = 2345;    // OK: 普通のプロパティは書き換え可能
$slime_A->power = 999; // ERROR: readonlyなので書き換え不可！</code></pre>
        </div>
        <p class="text-sm text-gray-500 italic">
            ※このように、意図しないデータの改ざんを防ぐために利用されます。
        </p>
    </section>

    <section class="space-y-6 bg-slate-50 p-8 rounded-2xl border border-slate-200">
        <h3 class="text-xl font-bold text-slate-800 italic">Tips: コンストラクタの省略記法 (PHP 8.0+)</h3>
        <p class="text-sm text-slate-600">
            プロパティの宣言と代入を、コンストラクタの引数部分でまとめて行う便利な書き方があります。
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-400 uppercase">従来の書き方</p>
                <div class="bg-white p-3 rounded border font-mono text-xs">
<pre><code>class Slime {
    public $type;
    function __construct($type) {
        $this->type = $type;
    }
}</code></pre>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-xs font-bold text-blue-500 uppercase">省略記法</p>
                <div class="bg-white p-3 rounded border border-blue-200 font-mono text-xs">
<pre><code>class Slime {
    // 引数にpublicをつけるだけ
    function __construct(
        public string $type
    ) {}
}</code></pre>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">クラス、インスタンス、メソッドの復習</h3>
        <div class="prose max-w-none text-gray-700 leading-relaxed">
            <ol class="list-decimal ml-6 space-y-2">
                <li><strong>class クラス名 { ... }</strong> で設計図を定義する。</li>
                <li><strong>__construct()</strong> で初期化処理を書く。</li>
                <li><strong>$変数 = new クラス名()</strong> でインスタンス（実体）を作る。</li>
                <li><strong>$変数->メソッド名()</strong> で処理を実行する。</li>
            </ol>
        </div>

        <div class="bg-white border-2 border-[#6A73A6] rounded-2xl overflow-hidden shadow-lg">
            <div class="bg-[#6A73A6] text-white px-6 py-3 font-bold">
                クラス定義のひな形
            </div>
            <div class="p-6 bg-gray-900 font-mono text-sm text-white">
<pre><code><?php
class Sample {
    public $value1 = '';
    
    function __construct($value1) {
        $this->value1 = $value1;
    }
    
    function test($name) {
        print $this->value1 . '、' . $name . 'さん！' . PHP_EOL;
    }
}

$sample1 = new Sample('こんにちは');
$sample1->test('太郎');</code></pre>
            </div>
        </div>
    </section>

    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-8 rounded-2xl border border-orange-100 text-center">
        <p class="text-orange-900 font-bold text-lg mb-2">お疲れ様でした！</p>
        <p class="text-orange-800">
            ここまでで、オブジェクト指向の「基本」はマスターしました。<br>
            この後は、さらに強力な機能である <strong>継承</strong> や <strong>多態性</strong> を学びます。<br>
            少し休憩してから、次のステップへ進みましょう。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}