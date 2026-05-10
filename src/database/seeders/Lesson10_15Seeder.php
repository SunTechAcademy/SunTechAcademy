<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_15Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のレッスンを取得（「PHPその3」として想定）
        $lesson = Lesson::where('title', 'PHPその3')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 15,
            ],
            [
                'title' => 'トレイト',
                'content' => <<<'EOF'
<div class="p-4 space-y-8">
    <h2 class="text-2xl font-bold border-b-2 border-blue-500 pb-2">トレイト</h2>
    
    <section>
        <p class="mb-4">
            攻撃する（function attack()）は、すべてのキャラクターが行える行動として Character クラス内に定義しました。<br>
            ここで、魔法で攻撃する ( function magic_attack() ) を追加したいとします。
        </p>
        <p class="mb-4">
            Character に追加しても良いかもしれませんが、魔法はすべてのキャラクターができることではないと考えると、「Character に magic_attack() を持たせておく。ただし魔法が使えないキャラクターは magic_attack() を無視する」というのは、おかしな話にも思えます。
        </p>
        <p class="mb-4">
            かといって、使うキャラクターのクラス内に magic_attack() を持たせてしまうと、魔法の使えるキャラクターが増えた際、あちらこちらに magic_attack() の定義ができてしまい、ソースコードの修正が面倒になります。
        </p>
        <p class="mb-4">
            そこで<strong>「function magic_attack() の定義だけを書いたものを作り、必要なキャラに適用する」</strong>という方法で運用したいと思います。それを実現するしくみが <strong>トレイト（trait）</strong> です。
        </p>
    </section>

    <section>
        <h3 class="text-xl font-bold mb-4">magic.php の作成</h3>
        <p class="mb-4">早速、function magic_attack() を持つトレイトを作ってみましょう。</p>
        <div class="bg-gray-100 p-4 rounded mb-4">
            <p class="font-bold mb-2 text-blue-600">magic.php</p>
            <pre class="bg-gray-800 text-white p-4 rounded shadow-inner"><code>&lt;?php

namespace TechAcademy\RPG\Characters;

trait Magic {
    public function magic_attack($character) {
        print $this->name() . "が" . $character->name() . "を魔法で攻撃して" . $this->magic_power . 'ポイントのダメージを与えた！' . PHP_EOL;

        $character->hp = $character->hp - $this->magic_power;

        if ($character->hp <= 0) {
            $this->defeat($character);
        }
    }
}</code></pre>
        </div>
        <p class="mb-4">
            トレイトはクラスとは違うものなので class ではなく <strong>trait</strong> というキーワードを使いましょう。magic_attack() 自体は、Character 内に定義した attack() とほぼ同じです。
        </p>
    </section>

    <section>
        <h3 class="text-xl font-bold mb-4 text-slate-800">Heroクラスへの適用</h3>
        <p class="mb-4">
            magic_attack() を、「Slime は使えない」、「Hero は使える」というルールにします。Slime の定義に変更はありませんが、Hero の方には「trait Magic を読み込んで magic_attack() を使えるようにする」設定を追加します。
        </p>
        <div class="bg-gray-100 p-4 rounded mb-4">
            <p class="font-bold mb-2 text-blue-600">hero.php</p>
            <pre class="bg-gray-800 text-white p-4 rounded shadow-inner"><code>&lt;?php

namespace TechAcademy\RPG\Characters;

require_once 'character.php';
require_once 'magic.php';

class Hero extends Character {
    use Magic;

    public static $type = '主人公';

    static function description() {
        print self::$type . 'は、この世界を守る勇者だ！' . PHP_EOL;
    }
}</code></pre>
        </div>
        <p class="mb-4">
            <code>require_once 'magic.php'</code> で trait Magic を読み込み、<code>use Magic;</code> としました。こうすることで、trait Magic に定義した function magic_attack() を Hero が使えるようになります。
        </p>
    </section>

    <section>
        <h3 class="text-xl font-bold mb-4 text-slate-800">Characterクラスの修正</h3>
        <p class="mb-4">
            後は Game の中で magic_attack() を呼び出せば良いだけですが、今回、攻撃力と魔法攻撃力を分けているので、Character に魔法攻撃力の変数 $magic_power を追加します。さらにコンストラクタで $magic_power を初期化するようにしてください。
        </p>
        <div class="bg-gray-100 p-4 rounded mb-4">
            <p class="font-bold mb-2 text-blue-600">character.php</p>
            <pre class="bg-gray-800 text-white p-4 rounded shadow-inner"><code>&lt;?php

namespace TechAcademy\RPG\Characters;

class Character {
    public static $type = '';
    public $suffix = '';
    public $hp = 1;
    public $power = 1;
    public $magic_power = 1;

    function __construct($hp, $power, $magic_power, $suffix = '') {
        $this->hp = $hp;
        $this->power = $power;
        $this->magic_power = $magic_power;
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

    <section>
        <h3 class="text-xl font-bold mb-4 text-slate-800">Gameクラスからの呼び出し</h3>
        <p class="mb-4">では、Game の中で magic_attack() を呼び出しましょう。</p>
        <div class="bg-gray-100 p-4 rounded mb-4">
            <p class="font-bold mb-2 text-blue-600">game.php</p>
            <pre class="bg-gray-800 text-white p-4 rounded shadow-inner"><code>&lt;?php

namespace TechAcademy\RPG;

require_once 'hero.php';
require_once 'slime.php';

use TechAcademy\RPG\Characters\Hero;

class Game {
    static function start() {
        // use していないので名前空間が必要
        \TechAcademy\RPG\Characters\Slime::description();

        // use した Hero だけは名前空間が必要無し
        Hero::description();

        // 相対的な名前空間でも良い
        // このファイルの名前空間は TechAcademy\RPG なので以降を補足すれば良い
        // 相対的な名前空間の場合には最初の \ は入れない
        $slime_A = new Characters\Slime(10, 3, 0, 'A');

        $hero = new Hero(1000, 30, 20);

        $slime_A->attack($hero);
        $hero->magic_attack($slime_A);
    }
}

Game::start();</code></pre>
        </div>
    </section>

    <section class="bg-white border p-6 rounded-lg shadow-sm">
        <h4 class="font-bold mb-2">実行コマンド</h4>
        <kbd class="bg-black text-white p-2 rounded block w-max mb-4 font-mono text-sm">php game.php</kbd>

        <h4 class="font-bold mb-2">実行結果</h4>
        <pre class="bg-gray-50 p-4 rounded border border-gray-300 font-mono text-sm text-blue-700"><code>スライムは、最弱のモンスターだ！
主人公は、この世界を守る勇者だ！
スライムAが主人公を攻撃して3ポイントのダメージを与えた！
主人公がスライムAを魔法で攻撃して20ポイントのダメージを与えた！
主人公はスライムAを倒した！</code></pre>
    </section>

    <p class="mt-4 italic">
        トレイトは奥深くて難しいしくみではありますが、Laravel本体のソースコードを読むと、いたるところで trait を目にします。簡単な使い方のレベルまでで良いので、覚えておきましょう。
    </p>

    <div class="mt-12 bg-blue-50 p-8 rounded-2xl border border-blue-100">
        <h3 class="text-xl font-bold text-blue-900 mb-4">（コラム） トレイトと継承の違い</h3>
        <div class="space-y-4 text-blue-900 leading-relaxed text-sm">
            <p>
                少し難しいですが「is-a」と「has-a」という言葉があります。isは「〜です」、hasは「〜を持っています」という意味の動詞です。「is-a」と「has-a」は、どちらも関係性を表す言葉で、「is-a」は ○○は□□（の一種）である、「has-a」は ○○は□□を持っている という関係性になります。
            </p>
            <p>
                継承はis-aの関係性です。「主人公はキャラクターの一種である」、「スライムはキャラクターの一種である」と言えます。継承は、親クラスの public, protected なプロパティとメソッドをすべて受け継ぎます。
            </p>
            <p>
                本レッスンのサンプルコードで、攻撃する（function attack()）は、すべてのキャラクターが行える行動として Characterクラスで定義した上で、この Characterクラスを継承する形で Hero クラスや Slimeクラスに「攻撃する」を持たせました。
            </p>
            <p>
                継承はとても便利な機能ですが、すべてを継承したいわけではない場合もあります。そこでトレイトを使います。トレイトは、部分的な機能として保管して、さまざまなクラスに読み込ませることができます。
            </p>
            <p>
                つまり<strong>「has-a」の関係性を設定したいときに使えます。</strong>今回の例のように「魔法はすべてのキャラクターで使われるわけではない」とするなら、「主人公は魔法を使える（持っている）」という関係性だと考えて、トレイトを使ったほうが良いでしょう。
            </p>
            <p class="font-bold">
                継承とトレイトを組み合わせれば、うまくクラス設計できるようになるので、使い分け方を理解できるようになりましょう。
            </p>
        </div>
    </div>
</div>
EOF
            ]
        );
    }
}