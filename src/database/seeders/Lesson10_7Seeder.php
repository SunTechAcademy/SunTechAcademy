<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_7Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 7],
            [
                'title' => 'static',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg text-gray-700 leading-relaxed">
            ここまでに学習したクラス内の変数は、すべて「インスタンスごとに固有の値を設定できる変数」でした。これらは個々の実体を説明するもので、<strong>「インスタンス変数」</strong>と呼ばれます。
        </p>
        <p class="text-gray-700">
            しかし、よく考えてみると <code>Slime</code> クラスの <code>$type</code>（種類）という変数は、個別のスライムによって変わるものではありません。クラス名そのものが <code>Slime</code> なのですから、すべてのスライムで共通の値（'スライム'）であるべきです。
        </p>
        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
            <p class="text-indigo-900 font-bold">
                このように、「そのクラスのインスタンスすべてで共通する値」や「クラスそのものを説明する変数」を <strong>クラス変数</strong> と呼び、<code>static</code> キーワードを使って定義します。
            </p>
        </div>
        
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">static とは</h3>
        <p class="text-gray-700 leading-relaxed">
            <code>static</code> は直訳すると「静的（変化のない）」という意味です。これを使うことで、インスタンスを作らなくても、クラスから直接呼び出せるようになります。
        </p>
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li><strong>クラス変数：</strong> すべてのインスタンスで共有される変数。</li>
            <li><strong>クラスメソッド：</strong> インスタンスを生成（new）しなくても呼び出せる関数。</li>
        </ul>

        <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-200">
            <h5 class="font-bold text-yellow-800 mb-2">⚠️ static の注意点</h5>
            <ol class="list-decimal ml-5 text-sm text-yellow-900 space-y-2">
                <li><strong>インスタンス化が不要：</strong> クラス名から直接呼び出せます。</li>
                <li><strong>アロー演算子 <code>-></code> は使えない：</strong> staticな変数にはアクセスできません。</li>
                <li><strong><code>$this</code> は使えない：</strong> インスタンスが存在しない前提なので、自分自身を指す <code>$this</code> の代わりに <strong><code>self</code></strong> を使います。</li>
            </ol>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">スコープ定義演算子 (::)</h3>
        <p class="text-gray-700">
            クラス変数やクラスメソッドを呼び出すときは、アロー演算子 <code>-></code> ではなく、<strong>スコープ定義演算子 <code>::</code></strong>（コロンが2個）を使います。
        </p>
        
        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white shadow-lg">
            <p class="text-gray-400 mb-2">// test_class.php を書き換えて実行しましょう</p>
<pre><code><?php
class Slime {
    public static $type = 'スライム'; // クラス変数
    public $suffix = '';

    public $hp = 10;
    public $power = 3;

    function __construct($suffix) {
        $this->suffix = $suffix;
    }

    function name() {
        // クラス変数を参照するときは self::$変数名
        return self::$type . $this->suffix;
    }

    function attack($character_name) {
        print $this->name() . 'が' . $character_name . 'を攻撃して' . $this->power . 'ポイントのダメージを与えた！' . PHP_EOL;
    }

    // クラスメソッド
    static function description() {
        // メソッド内でも self:: を使う
        print self::$type . 'は、最弱のモンスターだ！' . PHP_EOL;
    }
}

// インスタンス化せずに呼び出し
Slime::description();

$slime_A = new Slime('A');
$slime_A->attack('主人公');</code></pre>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2">実行コマンド</p>
                <kbd class="bg-black text-green-400 p-2 rounded block font-mono text-xs">php test_class.php</kbd>
            </div>
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <p class="font-bold text-gray-800 mb-2">実行結果</p>
                <div class="font-mono text-sm text-blue-600">
                    スライムは、最弱のモンスターだ！<br>
                    スライムAが主人公を攻撃して3ポイントのダメージを与えた！
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">:: についての補足</h3>
        <p class="text-gray-700 leading-relaxed">
            スコープ定義演算子 <code>::</code> は、「右側にあるものが、左側のスコープ（範囲）に属する」ことを決定する演算子です。
        </p>

        <div class="overflow-hidden rounded-xl border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">書き方</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">意味</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    <tr>
                        <td class="px-6 py-4 font-mono font-bold text-indigo-600">クラス名::○○</td>
                        <td class="px-6 py-4 text-gray-600">static 宣言されたメソッドやプロパティへアクセス</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono font-bold text-indigo-600">self::○○</td>
                        <td class="px-6 py-4 text-gray-600">自分自身のクラス内にある static メンバへアクセス</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono font-bold text-indigo-600">parent::○○</td>
                        <td class="px-6 py-4 text-gray-600">親クラスのメソッドやプロパティへアクセス（後述）</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono font-bold text-indigo-600">$this::○○</td>
                        <td class="px-6 py-4 text-gray-600">インスタンス経由でそのクラスの static メンバへアクセス</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </section>

    <div class="bg-[#6A73A6] bg-opacity-10 p-6 rounded-xl">
        <p class="text-gray-700 text-sm">
            <strong>まとめ：</strong> 個別のインスタンスで値が違うものは <code>$this-></code>（インスタンス変数）、クラス全体で共通のルールや値は <code>self::</code>（クラス変数）と使い分けるのがオブジェクト指向の美しい設計です。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}