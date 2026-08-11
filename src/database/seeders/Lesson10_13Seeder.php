<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_13Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 13],
            [
                'title' => '複数ファイルの連携',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg text-gray-700 leading-relaxed">
            これまではすべてのクラスを <code>test_class.php</code> にまとめて書いてきましたが、実際の開発現場では<strong>「1ファイルにつき1クラス」</strong>を記述するのが基本です。
        </p>
        <p class="text-gray-700">
            ファイルが分かれていると、どこに何が書いてあるか探しやすくなり、複数人での開発もしやすくなります。さっそく、これまでのクラスを分割してみましょう。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">1. 親クラスの作成</h3>
        <p class="text-gray-700">まずは共通部分を担う <code>Character</code> クラス専用のファイルを作ります。</p>
        
        <div class="bg-gray-800 rounded-t-lg px-4 py-2 text-white text-xs font-mono">character.php</div>
        <div class="bg-gray-900 rounded-b-xl p-6 font-mono text-sm text-white overflow-x-auto shadow-lg overflow-x-auto">
<pre><code>&lt;?php
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

    function attack($character) {
        print $this->name() . 'が' . $character->name() . 'を攻撃して' . $this->power . 'ポイントのダメージを与えた！' . PHP_EOL;
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
}</code></pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">2. 子クラスとファイルの読み込み</h3>
        <p class="text-gray-700 leading-relaxed">
            次に <code>Slime</code> と <code>Hero</code> を分割します。ここで重要なのが <strong>require_once</strong> です。
            別ファイルに定義されたクラスを使うには、そのファイルを読み込む必要があります。
        </p>

        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 mb-6">
            <h5 class="font-bold text-indigo-900 mb-2">require_once とは？</h5>
            <p class="text-sm text-indigo-800">
                指定したファイルを一度だけ読み込む命令です。もし既に読み込まれていれば無視されるため、クラスの定義が重複してエラーになるのを防いでくれます。
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <div class="bg-gray-800 rounded-t-lg px-4 py-2 text-white text-xs font-mono">slime.php</div>
                <div class="bg-gray-900 rounded-b-xl p-4 font-mono text-xs text-white shadow-md overflow-x-auto">
<pre><code>&lt;?php
require_once 'character.php';

class Slime extends Character {
    public static $type = 'スライム';
    static function description() {
        print self::$type . 'は、最弱のモンスターだ！' . PHP_EOL;
    }
}</code></pre>
                </div>
            </div>
            <div>
                <div class="bg-gray-800 rounded-t-lg px-4 py-2 text-white text-xs font-mono">hero.php</div>
                <div class="bg-gray-900 rounded-b-xl p-4 font-mono text-xs text-white shadow-md overflow-x-auto">
<pre><code>&lt;?php
require_once 'character.php';

class Hero extends Character {
    public static $type = '主人公';
    static function description() {
        print self::$type . 'は、この世界を守る勇者だ！' . PHP_EOL;
    }
}</code></pre>
                </div>
            </div>
        </div>
        
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">3. 全てをまとめあげる「Gameクラス」</h3>
        <p class="text-gray-700 leading-relaxed">
            最後に、これらを読み込んで実際にゲームを動かす「メイン処理」用のファイルを作成します。
            ここでは、実行自体も <code>Game</code> クラスという役割（オブジェクト）の中に閉じ込めてしまいます。
        </p>

        <div class="bg-gray-800 rounded-t-lg px-4 py-2 text-white text-xs font-mono">game.php</div>
        <div class="bg-gray-900 rounded-b-xl p-6 font-mono text-sm text-white shadow-lg overflow-x-auto">
<pre><code>&lt;?php
require_once 'hero.php';
require_once 'slime.php';

class Game {
    static function start() {
        Slime::description();
        Hero::description();

        $slime_A = new Slime(10, 3, 'A');
        $hero = new Hero(1000, 30);

        $slime_A->attack($hero);
        $hero->attack($slime_A);
    }
}

// 最後にこの1行を呼ぶことでゲームが開始される
Game::start();</code></pre>
        </div>
    </section>

    <section class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2">実行コマンド</p>
                <kbd class="bg-black text-green-400 p-2 rounded block font-mono text-xs">php game.php</kbd>
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

    <div class="bg-slate-100 p-6 rounded-xl border-l-4 border-slate-400">
        <p class="text-sm text-slate-600 leading-relaxed">
            ファイルが分割されたことで、一つのファイルの役割が明確になりましたね。<br>
            これからは「一つの役割（クラス）を、一つのファイルに閉じ込める」という意識を持って、コードを整理していきましょう。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}