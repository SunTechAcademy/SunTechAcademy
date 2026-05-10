<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_8Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 8],
            [
                'title' => '継承 (extends)',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg text-gray-700 leading-relaxed">
            オブジェクト指向プログラミングには、<strong>「継承」「多態性（ポリモーフィズム）」「カプセル化」</strong>という3つの大きな特徴があります。ここではまず <strong>「継承」</strong> について学びます。
        </p>
        <p class="text-gray-700 leading-relaxed">
            継承とは、文字通り「受け継ぐ」ことです。老舗の和食屋の二代目が、親の基礎的な料理の腕（ベース）を受け継ぎつつ、独自の新しいメニュー（追加機能）を作るイメージです。
        </p>
    </section>

    <section class="space-y-6 bg-slate-50 p-8 rounded-2xl border border-slate-200">
        <h3 class="text-xl font-bold text-slate-800 border-b-2 border-slate-300 pb-2">継承の基本的な考え方</h3>
        <p class="text-slate-700">例えば、AとBという2つのクラスに重複する変数や処理があったとします。</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded font-mono text-xs border border-gray-300 text-gray-600">
<pre><code>class A {
    public $x;      // 重複
    public $x_a;
    function y() {} // 重複
    function y_a() {}
}</code></pre>
            </div>
            <div class="bg-white p-4 rounded font-mono text-xs border border-gray-300 text-gray-600">
<pre><code>class B {
    public $x;      // 重複
    public $x_b;
    function y() {} // 重複
    function y_b() {}
}</code></pre>
            </div>
        </div>

        <p class="text-slate-700 mt-4">この重複部分を「C」という新しいクラスにまとめ、それを <strong>extends (拡張・継承)</strong> することで、スッキリさせることができます。</p>

        <div class="bg-indigo-900 p-4 rounded-xl font-mono text-sm text-white shadow-md">
<pre><code>// 共通部分（親クラス）
class C {
    public $x;
    function y() {}
}

// 継承して作る（子クラス）
class A extends C {
    public $x_a;
    function y_a() {}
}

class B extends C {
    public $x_b;
    function y_b() {}
}</code></pre>
        </div>
        <p class="text-sm text-slate-600">
            共通部分を <strong>親クラス（スーパークラス）</strong>、それを継承したものを <strong>子クラス（サブクラス）</strong> と呼びます。<br>
            ※ただし、便利だからといってむやみに継承を繰り返すと、関係性が複雑になりコードが読みづらくなるため、実務では使い所を見極める必要があります。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">RPGのキャラクターで実践しよう</h3>
        <p class="text-gray-700 leading-relaxed">
            ゲームで「スライム」と「主人公」を戦わせる場合、どちらもRPGの <strong>キャラクター</strong> として「HP」を持ち、「攻撃する」という動作を持っています。
        </p>
        <p class="text-gray-700">
            そこで、共通部分をまとめた <code>Character</code> クラスを作り、それを <code>Slime</code> と <code>Hero</code> に継承させてみましょう。
        </p>

        

        <div class="bg-gray-800 rounded-t-lg px-4 py-2 text-white text-xs font-mono mt-6">test_class.php</div>
        <div class="bg-gray-900 rounded-b-xl p-6 font-mono text-sm text-white max-h-96 overflow-y-auto">
<pre><code><?php
// ---- 親クラス（共通部分） ----
class Character {
    public static $type = '';
    public $suffix = '';
    public $hp = 1;
    public $power = 1;

    function __construct($hp, $power, $suffix = '') {
        $this->hp = $hp;
        $this->power = $power;
        $this->suffix = $suffix;
    }

    function name() {
        return $this::$type . $this->suffix;
    }

    // 引数に「攻撃する相手のオブジェクト」を受け取るように変更
    function attack($character) {
        print $this->name() . 'が' . $character->name() . 'を攻撃して' . $this->power . 'ポイントのダメージを与えた！' . PHP_EOL;
        
        // 相手のHPを減らす処理
        $character->hp = $character->hp - $this->power;

        if ($character->hp <= 0) {
            $this->defeat($character);
        }
    }

    function defeat($character) {
        print $this->name() . 'は' . $character->name() . 'を倒した！' . PHP_EOL;
    }

    static function description() {
        print 'このゲームのキャラクターです' . PHP_EOL;
    }
}

// ---- 子クラス（スライム） ----
class Slime extends Character {
    public static $type = 'スライム';

    static function description() {
        print self::$type . 'は、最弱のモンスターだ！' . PHP_EOL;
    }
}

// ---- 子クラス（主人公） ----
class Hero extends Character {
    public static $type = '主人公';

    static function description() {
        print self::$type . 'は、この世界を守る勇者だ！' . PHP_EOL;
    }
}

// ---- 実行部分 ----
Slime::description();
Hero::description();

// 引数：HP, 攻撃力, 接尾辞
$slime_A = new Slime(10, 3, 'A');
$hero = new Hero(1000, 30);

$slime_A->attack($hero);
$hero->attack($slime_A);</code></pre>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2">実行コマンド</p>
                <kbd class="bg-black text-green-400 p-2 rounded block font-mono text-xs">php test_class.php</kbd>
            </div>
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2">実行結果</p>
                <div class="font-mono text-xs text-blue-600 leading-relaxed">
                    スライムは、最弱のモンスターだ！<br>
                    主人公は、この世界を守る勇者だ！<br>
                    スライムAが主人公を攻撃して3ポイントのダメージを与えた！<br>
                    主人公がスライムAを攻撃して30ポイントのダメージを与えた！<br>
                    主人公はスライムAを倒した！
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">ここでの変更点とポイント</h3>
        <p class="text-gray-700 leading-relaxed">
            以前のコードから、いくつかの重要な変更を加えました。
        </p>

        <ul class="list-disc ml-6 space-y-4 text-gray-700">
            <li>
                <strong>相手をオブジェクトとして受け取る：</strong><br>
                <code>attack($character)</code> の引数が、単なる「主人公」という文字列ではなく、<code>$hero</code> というインスタンスそのものを受け取るようになりました。これにより <code>$character->hp</code> のように、相手のHPを直接減らす処理が可能になりました。
            </li>
            <li>
                <strong>共通機能の抽出：</strong><br>
                <code>Slime</code> と <code>Hero</code> は <code>extends Character</code> と書くだけで、HPや攻撃力、<code>attack()</code>、新しく追加された <code>defeat()</code> などの機能を最初からすべて持っている状態になります。
            </li>
        </ul>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 shadow-sm mt-6">
            <p class="text-yellow-800 font-bold mb-1">🤔 次のチャプターへの疑問</p>
            <p class="text-sm text-yellow-900 leading-relaxed">
                しかし、コードをよく見ると、親クラスである <code>Character</code> で <code>$type</code> や <code>description()</code> を定義しているのに、子クラスの <code>Slime</code> や <code>Hero</code> でも同じ名前で定義し直しています。<br>
                また、コンストラクタの引数に <code>$suffix = ''</code> という見慣れない書き方があります。<br>
                これは一体どういうことでしょうか？詳細は次のチャプターで解説します。
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}