<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_11Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 11],
            [
                'title' => 'メソッドチェーン',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg text-gray-700 leading-relaxed">
            PHPのクラス設計において、メソッドとメソッドを <code>-></code> で数珠つなぎにする書き方を <strong>メソッドチェーン</strong> と呼びます。
            これを使えるようになると、コードが非常に簡潔で読みやすくなります。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">メソッドチェーンの仕組み</h3>
        <p class="text-gray-700">
            まずは、四則演算を行うシンプルなクラスで確認してみましょう。
            新しいPHPファイルを作成して、以下のコードを実行してみてください。
        </p>
        
        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-white shadow-lg overflow-x-auto">
<pre><code><?php
class MethodChain {
    public $result = 1;

    function add($add_num) {
        $this->result += $add_num;
        return $this; // ★ここが最大のポイント！
    }

    function sub($sub_num) {
        $this->result -= $sub_num;
        return $this;
    }

    function mul($mul_num) {
        $this->result *= $mul_num;
        return $this;
    }

    function div($div_num) {
        $this->result /= $div_num;
        return $this;
    }
}

$mc = new MethodChain();

// メソッドを繋げて実行
$mc->add(4)->sub(1)->mul(6)->div(3);

print $mc->result . PHP_EOL;</code></pre>
        </div>

        <div class="bg-white p-5 border rounded-xl shadow-sm inline-block">
            <p class="font-bold text-gray-800 mb-2">実行結果</p>
            <div class="font-mono text-xl text-blue-600">8</div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">なぜメソッドを繋げられるのか？</h3>
        <p class="text-gray-700 leading-relaxed">
            秘密は <code>return $this;</code> にあります。
        </p>
        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 space-y-4">
            <p class="text-indigo-900 text-sm leading-relaxed">
                各メソッドの最後で <strong>「計算が終わった後の自分自身のインスタンス ($this)」</strong> を返しています。
                そのため、1つ目のメソッドが終わった直後の場所には、また「インスタンス」が戻ってきている状態になります。
            </p>
            <div class="bg-white p-4 rounded font-mono text-xs text-gray-600">
                $mc->add(4) <span class="text-gray-400"># ここでインスタンスが返る</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;->sub(1) <span class="text-gray-400"># 返ってきたインスタンスのメソッドを呼ぶ</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;->mul(6)...
            </div>
        </div>

        

        <p class="text-gray-700">
            今回の例では、以下の計算が1行で行われています：<br>
            <span class="font-mono bg-gray-100 px-2 py-1 rounded">(( ( ( 1 + 4 ) - 1 ) * 6 ) / 3) = 8</span>
        </p>
    </section>

    <section class="space-y-6 bg-slate-50 p-8 rounded-2xl border border-slate-200">
        <h4 class="text-xl font-bold text-slate-800">Laravelでの活用</h4>
        <p class="text-slate-700 leading-relaxed">
            このメソッドチェーンは、Laravelに入ると非常に頻繁に目にすることになります。
            例えば、データベースからデータを取得する際などは以下のような書き方をします。
        </p>
        <div class="bg-gray-800 text-white p-4 rounded font-mono text-xs shadow-inner">
            $users = User::where('active', 1)->orderBy('name')->get();
        </div>
        <p class="text-sm text-slate-500 mt-4 italic">
            「アクティブなユーザーを」「名前順に並べて」「取得する」という処理が、まるで文章のように美しく書けるのが特徴です。
        </p>
    </section>

    <div class="bg-[#6A73A6] bg-opacity-10 p-6 rounded-xl text-center">
        <p class="text-gray-700">
            メソッドチェーンを使いこなせると、<strong>「何をしているコードなのか」</strong>が直感的に伝わるようになります。<br>
            自分がクラスを作る際も、必要に応じて <code>return $this;</code> を活用してみましょう！
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}