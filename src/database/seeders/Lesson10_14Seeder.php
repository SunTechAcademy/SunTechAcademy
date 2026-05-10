<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_14Seeder extends Seeder
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
                'sort_order' => 14,
            ],
            [
                'title' => '名前空間',
                'content' => <<<'EOF'
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4 border-b-2 border-blue-500 pb-2">名前空間</h2>
    <p class="mb-4">
        他者が作成し、誰でも再利用が可能な状態で配布されているソースコード一式を「ライブラリ」と言います。<br>
        ここでは一例として、ゲームプログラムを作成するため、他者が作成したPHPのゲーム用のライブラリを読み込んだとします。<br>
        そして、自分で作成した class Character を使用し、オリジナルのゲームを作成するとします。
    </p>

    <h3 class="text-xl font-bold mt-8 mb-4">名前空間とは</h3>
    <p class="mb-4">
        ここで問題となるのは、 class Character という クラス名 は、自分のプログラムと他者のライブラリとで重複する可能性があるということです。<br>
        自分で作った class Character と、他者が作成したPHPのゲームライブラリの中にあった class Character が重複していたらどうなるでしょうか。当然、どちらが読み込まれるかわからないので、意図しない実行になってしまう可能性があります。<br>
        そもそも、開発の過程で、誰かのライブラリとクラス名が重複するかといったことはあまり考慮したくないものです。
    </p>
    <p class="mb-4">
        それでは、絶対に他と重複しないよう、クラス名を TechAcademy_Character と所属などを前置きすればどうでしょうか。これで TechAcademy の受講生同士でしか重複しないクラス名を作り出すことができます。<br>
        しかし、 TechAcademy_Character の TechAcademy_ は、クラスにとっては何の意味もない文字列です。できれば、無意味な命名は避けたいところです。
    </p>
    <p class="mb-4">
        そこで、class Character はそのままにして、重複させない方法として「名前空間」という概念が生まれました。<br>
        名前空間は、簡単に言えば「フォルダの階層」です。具体的には、class Character の名前はそのままにして、クラスの定義の置かれた場所を（まるでファイルを保存するフォルダ階層のように）TechAcademy 内の RPG 内の Characters の中にあるクラスだと宣言します。
    </p>
    <p class="mb-4">
        他者が作成・公開しているライブラリでは、名前空間を採用しているものが多いです。つまり、自分の作った class Character と他者の作ったライブラリ内にある class Character は、それぞれ別の名前空間（フォルダ階層）に置かれているため、重複せずに読み込めます。これが名前空間を使うことのメリットです。
    </p>

    <h4 class="font-bold mt-6 mb-2">名前空間のサンプルコード</h4>
    <p class="mb-4">以下のコードにおける namespace TechAcademy\RPG\Characters; が名前空間にあたります。</p>

    <div class="bg-gray-100 p-4 rounded mb-4">
        <p class="font-bold mb-2">名前空間(namespace) ※本セクションの例はすべて一例ですので、コーディングと動作確認は必要ありません</p>
        <pre class="bg-gray-800 text-white p-4 rounded"><code>namespace TechAcademy\RPG\Characters;

class Character {
    // 中略
}</code></pre>
    </div>

    <p class="mb-4">
        最初に namespace TechAcademy\RPG\Characters; と記述することで、この file は TechAcademy\RPG\Characters という名前空間に置かれます。こうすれば、同じ名前空間同士でしか重複しないようになります。<br>
        先ほど、例で出したように、フォルダ階層にファイルを置くのと似ていますが、名前空間とソースファイルのフォルダ構成が一致している必要はありません。<br>
        class Character を書いたソースファイルを、「TechAcademyフォルダ」→「RPGフォルダ」→「Charactersフォルダ」を作成して、その中に入れる必要がない、という意味です。<br>
        名前空間は名前空間、フォルダ構成はフォルダ構成で別ものです。とはいえ、名前空間とフォルダ構成はできるだけ近い階層になっている方が、プログラムの規模が大きくなった場合に管理しやすいでしょう。
    </p>

    <p class="mb-4">
        ただし、1つ面倒になってしまうことがあります。それは、名前空間を設定したクラス名を指定するとき、名前空間も指定する必要があるということです。
    </p>

    <div class="bg-gray-100 p-4 rounded mb-4">
        <p class="font-bold mb-2">サンプルコード</p>
        <pre class="bg-gray-800 text-white p-4 rounded"><code>$character = new Character(...);    // これはダメ
$character = new \TechAcademy\RPG\Characters\Character(...);    // これが正解</code></pre>
    </div>

    <p class="mb-4">
        この面倒を回避するために、 use というものも生まれました。最初に use しておけば、 use した名前空間のクラス名を使用するという宣言になります。そのため、今まで同様に名前空間を記述しなくても済みます。
    </p>

    <div class="bg-gray-100 p-4 rounded mb-4">
        <p class="font-bold mb-2">サンプルコード</p>
        <pre class="bg-gray-800 text-white p-4 rounded"><code>use TechAcademy\RPG\Characters\Character;
$character = new Character(...);    // use のおかげで正解 (\TechAcademy\RPG\Characters\Character だと決まる)</code></pre>
    </div>

    <p class="mb-4">
        また、use を使用しなくても、呼び出し側もまったく同一の名前空間だった場合には、 use は不要です。以下は、同じ名前空間にある別のファイルから Character を呼び出す場合の例です。
    </p>

    <div class="bg-gray-100 p-4 rounded mb-4">
        <p class="font-bold mb-2">サンプルコード</p>
        <pre class="bg-gray-800 text-white p-4 rounded"><code>namespace TechAcademy\RPG\Characters;
$character = new Character(...);    // namespace が同じなので正解 (\TechAcademy\RPG\Characters\Character だと決まる)</code></pre>
    </div>

    <p class="mb-4">管理の手間を省きたい場合は同じ名前空間に置く方法でも良いですが、基本は use を使用してください。</p>

    <h3 class="text-xl font-bold mt-12 mb-4 border-b pb-2">名前空間の実例</h3>
    <p class="mb-4">
        ここまでのサンプルコードに、名前空間を適用します。まず、 class Character は TechAcademy\RPG\Characters の名前空間に置きたいと思います。
    </p>

    <div class="bg-gray-100 p-4 rounded mb-6">
        <p class="font-bold mb-2 text-blue-600">character.php</p>
        <pre class="bg-gray-800 text-white p-4 rounded shadow-inner"><code>&lt;?php

namespace TechAcademy\RPG\Characters;

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

    <p class="mb-4 font-bold">
        同様に class Slime と class Hero を作ります。2つとも TechAcademy\RPG\Characters の名前空間に置きましょう。こうすることで、class Slime と class Character が同じ名前空間になるので extends Character する際に extends \TechAcademy\RPG\Characters\Character としたり use を使ったりしなくても大丈夫です。
    </p>
    <p class="mb-4">
        前にも触れましたが、補足として、以下のサンプルにある require_once 'PHPファイル名' は、別のPHPファイルに記述されている変数や関数、クラスなどを利用したい場合に必要な記述です。書くのを忘れると「Character が何かわからない」という内容のエラーが発生します。
    </p>

    <div class="bg-gray-100 p-4 rounded mb-6">
        <p class="font-bold mb-2 text-blue-600">slime.php</p>
        <pre class="bg-gray-800 text-white p-4 rounded"><code>&lt;?php

namespace TechAcademy\RPG\Characters;

require_once 'character.php';

class Slime extends Character {
    public static $type = 'スライム';

    static function description() {
        print self::$type . 'は、最弱のモンスターだ！' . PHP_EOL;
    }
}</code></pre>
    </div>

    <div class="bg-gray-100 p-4 rounded mb-6">
        <p class="font-bold mb-2 text-blue-600">hero.php</p>
        <pre class="bg-gray-800 text-white p-4 rounded"><code>&lt;?php

namespace TechAcademy\RPG\Characters;

require_once 'character.php';

class Hero extends Character {
    public static $type = '主人公';

    static function description() {
        print self::$type . 'は、この世界を守る勇者だ！' . PHP_EOL;
    }
}</code></pre>
    </div>

    <p class="mb-4">
        さらに、今作った Character, Slime, Hero を使うクラス class Game を用意します。こちらは、ゲームを動かす役割を担うクラスであり、キャラクターではありません。そのため、 TechAcademy\RPG の名前空間に置きましょう。この場合、TechAcademy\RPG\Characters に置かれている class Hero や class Slime を指定するには、 use を使うか、名前空間を指定する必要があります。
    </p>

    <div class="bg-gray-100 p-4 rounded mb-6">
        <p class="font-bold mb-2 text-blue-600">game.php</p>
        <pre class="bg-gray-800 text-white p-4 rounded shadow-lg border-2 border-indigo-200"><code>&lt;?php

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
        $slime_A = new Characters\Slime(10, 3, 'A');

        $hero = new Hero(1000, 30);

        $slime_A->attack($hero);
        $hero->attack($slime_A);
    }
}

Game::start();</code></pre>
    </div>

    <h4 class="font-bold mt-8 mb-2">実行コマンド</h4>
    <kbd class="bg-black text-white p-2 rounded block w-max mb-4">php game.php</kbd>

    <h4 class="font-bold mt-4 mb-2">実行結果</h4>
    <pre class="bg-gray-100 p-4 rounded border border-gray-300"><code>スライムは、最弱のモンスターだ！
主人公は、この世界を守る勇者だ！
スライムAが主人公を攻撃して3ポイントのダメージを与えた！
主人公がスライムAを攻撃して30ポイントのダメージを与えた！
主人公はスライムAを倒した！</code></pre>
</div>
EOF
            ]
        );
    }
}