<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_9Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 9],
            [
                'title' => '多態性（ポリモーフィズム）',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg text-gray-700 leading-relaxed">
            オブジェクト指向プログラミングの特徴2つ目、<strong>多態性（ポリモーフィズム）</strong> について説明します。
        </p>
        <p class="text-gray-700 leading-relaxed">
            多態性は継承と併せて用いられるもので、<strong>「メソッドの名前を変更せずに、新しい処理の定義ができる」</strong> ことを言います。
            和食屋さんの二代目が、親から継承したメニューのうち、いくつかだけを「フレンチ風」にアレンジして提供するようなイメージです。
        </p>
        <p class="text-gray-700">多態性には大きく分けて <strong>オーバーライド</strong> と <strong>オーバーロード</strong> の2つがあります。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">オーバーライド (Override)</h3>
        <p class="text-gray-700 leading-relaxed">
            オーバーライドは、<strong>親クラスから継承したメソッドを子クラスで「上書き」する</strong> 性質です。
            先ほどの <code>test_class.php</code> では、親クラスの <code>Character</code> で定義した内容を、<code>Slime</code> や <code>Hero</code> がそれぞれの内容で上書きしていました。
        </p>

        

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
            <p class="text-sm font-bold text-gray-500 uppercase">おさらい：親クラスでの定義</p>
            <div class="bg-gray-900 text-white p-4 rounded font-mono text-xs overflow-x-auto">
<pre><code>// Characterクラス
public static $type = '';
static function description() {
    print 'このゲームのキャラクターです' . PHP_EOL;
}</code></pre>
            </div>
            
            <p class="text-sm font-bold text-gray-500 uppercase">おさらい：子クラスでの上書き（オーバーライド）</p>
            <div class="bg-gray-900 text-white p-4 rounded font-mono text-xs overflow-x-auto">
<pre><code>// Slimeクラス
public static $type = 'スライム';
static function description() {
    print self::$type . 'は、最弱のモンスターだ！' . PHP_EOL;
}</code></pre>
            </div>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h5 class="font-bold text-blue-900 mb-2">💡 親のメソッドを使いたいときは？</h5>
            <p class="text-sm text-blue-800">
                子クラスで上書きしたけれど、あえて親クラスの処理を呼び出したい場合は <code>parent::メソッド名()</code> と記述します。
            </p>
        </div>

        <div class="mt-8 space-y-4">
            <h4 class="text-lg font-bold text-gray-800">クラス定数の final 宣言</h4>
            <p class="text-gray-700 text-sm">
                もし「この値だけは絶対に上書きさせたくない！」という場合は、<strong>final</strong> キーワードを使います。
            </p>
            <div class="bg-red-50 p-4 rounded border border-red-100 font-mono text-xs text-red-800">
<pre><code>// 親でfinalをつけると...
final public const TYPE = 'キャラクター';

// 子で上書きしようとするとエラーになります
public const TYPE = 'スライム'; // Fatal error!</code></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">オーバーロード (Overload)</h3>
        <p class="text-gray-700 leading-relaxed">
            オーバーロードとは、<strong>「引数の数や型が異なれば、同じ名前の関数を複数定義できる」</strong> 特徴です。
            しかし、厳密に言うと<strong>PHPでは他言語のようなオーバーロードはできません。</strong> その代わり、PHPでは <strong>「引数のデフォルト値」</strong> を設定することで、同様の利便性を実現します。
        </p>

        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
            <h5 class="font-bold text-indigo-900 mb-2">引数のデフォルト値による柔軟性</h5>
            <p class="text-sm text-indigo-800 leading-relaxed">
                <code>Character</code> のコンストラクタを見てみましょう。3つ目の引数 <code>$suffix</code> に <code>''</code> が代入されています。
            </p>
            <div class="bg-white p-4 rounded font-mono text-xs mt-3 border border-indigo-200">
                function __construct($hp, $power, <span class="text-red-600 font-bold">$suffix = ''</span>) { ... }
            </div>
        </div>

        <p class="text-gray-700">これにより、インスタンス生成時に引数の数を変えることができます。</p>
        <div class="bg-gray-900 text-white p-6 rounded-xl font-mono text-sm overflow-x-auto">
<pre><code>// 敵スライムは個体名が必要なので3つ渡す
$slime_A = new Slime(10, 3, 'A');

// 主人公は一人なので、名前の接尾辞を省略（2つだけ渡す）
$hero = new Hero(1000, 30);</code></pre>
        </div>

        <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-200">
            <h5 class="font-bold text-yellow-800 mb-2 italic">⚠️ 注意点：デフォルト値の順番</h5>
            <p class="text-sm text-yellow-900">
                デフォルト値を設定する引数は、必ず<strong>一番右側（最後）</strong>に書く必要があります。<br>
                <code>function __construct($hp, $suffix = '', $power)</code> のような書き方は、どこを省略したか判断できないためエラーになります。
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}