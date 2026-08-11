<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_10Seeder extends Seeder
{
    public function run(): void
    {
        $lesson10 = Lesson::where('title', 'PHPその3')->first();
        if (!$lesson10) return;

        Chapter::updateOrCreate(
            ['lesson_id' => $lesson10->id, 'sort_order' => 10],
            [
                'title' => 'カプセル化とアクセス権',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg text-gray-700 leading-relaxed">
            オブジェクト指向プログラミングの3つ目の特徴、<strong>「カプセル化」</strong>について解説します。
        </p>
        <p class="text-gray-700 leading-relaxed">
            これまでのコードでは、当たり前のように <code>public</code> というキーワードを使ってきました。これは「誰でもどこからでもアクセスできる」という意味です。
        </p>
        <div class="bg-red-50 p-6 rounded-xl border border-red-100">
            <h5 class="font-bold text-red-900 mb-2">なぜ public だけではダメなのか？</h5>
            <p class="text-sm text-red-800 leading-relaxed">
                プログラムが大規模になると、「いつの間にか変数の値が変わっているが、犯人が誰かわからない」という事態が起こります。
                そこで、重要なデータは <strong>private</strong>（自分専用）にして隠し、専用の窓口（メソッド）を通してのみ操作できるようにします。
            </p>
        </div>
    </section>

    <section class="flex flex-col md:flex-row items-center gap-8 bg-blue-50 p-8 rounded-2xl border border-blue-100">
        <div class="flex-1 space-y-4">
            <h4 class="text-xl font-bold text-blue-900 flex items-center gap-2">
                🏛️ カプセル化のイメージ：市役所の窓口
            </h4>
            <p class="text-sm text-blue-800 leading-relaxed">
                あなたの住民票（privateな情報）をイメージしてください。誰でも勝手に閲覧・書き換えができたら困りますよね？
            </p>
            <p class="text-sm text-blue-800 leading-relaxed">
                住民票は奥の保管庫に隠されており、あなたは<strong>「市役所の窓口（publicな関数）」</strong>で申請を行う必要があります。窓口を通すことで、「誰がいつ情報を取得したか」という記録を残し、安全に管理できるのです。
            </p>
        </div>
        
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">3つのアクセス権</h3>
        <p class="text-gray-700">PHPには、情報の「隠し具合」を決める3つのキーワードがあります。</p>

        <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">種類</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">アクセスできる範囲</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm font-medium">
                    <tr>
                        <td class="px-6 py-4 text-green-600 font-mono">public</td>
                        <td class="px-6 py-4 text-gray-600">制限なし。どこからでもアクセス可能。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-orange-600 font-mono">protected</td>
                        <td class="px-6 py-4 text-gray-600">自分のクラス ＋ 継承した子クラス内からアクセス可能。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-red-600 font-mono">private</td>
                        <td class="px-6 py-4 text-gray-600">自分のクラス内のみ。継承先からもアクセス不可。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="text-xl font-bold text-gray-800 italic">アクセス権の具体例</h4>
        <div class="bg-gray-900 rounded-xl p-6 font-mono text-xs text-white overflow-x-auto shadow-lg overflow-x-auto">
<pre><code>class A {
    public $public = 'public';
    protected $protected = 'protected';
    private $private = 'private';

    function test() {
        print $this->public;    // OK
        print $this->protected; // OK
        print $this->private;   // OK
    }
}

// B は A とは無関係のクラス
class B {
    function test() {
        $a = new A();
        print $a->public;    // OK
        print $a->protected; // エラー！
        print $a->private;   // エラー！
    }
}

// C は A を継承したクラス
class C extends A {
    function test() {
        print $this->public;    // OK
        print $this->protected; // OK
        print $this->private;   // エラー！（親の秘密は見えない）
    }
}</code></pre>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs text-slate-600 leading-relaxed italic">
                ※メソッド（関数）についても同様です。アクセス権を省略した場合は <code>public</code> とみなされますが、実務では明示的に書く習慣をつけましょう。
            </p>
        </div>
    </section>

    <section class="space-y-6 border-t pt-10">
        <h3 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-gray-200 pb-2">ここまでのまとめ</h3>
        <p class="text-gray-700 leading-relaxed font-medium">
            オブジェクト指向プログラミングの3大特徴である「継承」「多態性」「カプセル化」を学びました。
        </p>
        <div class="prose max-w-none text-gray-600 text-sm space-y-4">
            <p>
                オブジェクト指向のポイントは<strong>「役割」</strong>です。
                <code>Character</code> というベースを作り、それを継承して <code>Slime</code>（敵）や <code>Hero</code>（味方）という役割を持たせました。
            </p>
            <p>
                このように設計することで、共通の振る舞い（攻撃など）を保証しつつ、それぞれの個性を安全に追加していくことができます。
            </p>
        </div>

        <div class="bg-gradient-to-r from-[#6A73A6] to-[#4F5B93] p-8 rounded-2xl text-center text-white shadow-md">
            <p class="font-bold text-xl mb-3">🎉 第1段階、クリアです！</p>
            <p class="text-indigo-100 text-sm leading-relaxed">
                少し休憩しましょう。この後は、PHPが独自に持つさらに高度な技術項目（インターフェースやトレイトなど）に進みます。<br>
                これらは大規模なシステムを構築する際に非常に役立つ知識となります。
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}