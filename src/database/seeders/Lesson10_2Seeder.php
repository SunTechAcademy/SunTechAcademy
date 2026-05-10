<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_2Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson 10 (PHPその3) を取得
        $lesson10 = Lesson::where('title', 'PHPその3')->first();

        if (!$lesson10) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson10->id,
                'sort_order' => 2
            ],
            [
                'title' => 'オブジェクトとは',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            <strong>オブジェクト</strong>とは、簡単に言うと、<strong>「関連する変数（値）」と「関数（動作）」をひとまとめにして、そのまとまりに名前を付けたもの</strong>です。
        </p>
        <p class="text-gray-700 leading-relaxed">
            これまで学んできた変数と関数は、別々に宣言され、バラバラに管理されてきました。しかし、プログラムが大規模になり複数のファイルにまたがってくると、どの変数とどの関数がセットなのかが分かりにくくなります。
            関連するものを1つのオブジェクト内にまとめて管理しやすくする考え方を、<strong>オブジェクト指向</strong>と呼びます。
        </p>
    </section>

    <section class="bg-gray-50 p-8 rounded-2xl border border-gray-200 space-y-6">
        <h4 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <span class="text-3xl">🎮</span> ゲームのRPGでイメージしてみよう
        </h4>
        <p class="text-gray-700">
            例えば、RPGに登場する敵キャラクターの<strong>「スライム」</strong>で考えてみましょう。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <div class="space-y-4">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-blue-100">
                    <h5 class="font-bold text-blue-600 mb-2">属性情報（変数）</h5>
                    <ul class="list-disc ml-5 text-sm text-gray-600 space-y-1">
                        <li>ヒットポイント（hp）</li>
                        <li>マジックポイント（mp）</li>
                        <li>攻撃力 / 防御力</li>
                    </ul>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-green-100">
                    <h5 class="font-bold text-green-600 mb-2">振る舞い（関数）</h5>
                    <ul class="list-disc ml-5 text-sm text-gray-600 space-y-1">
                        <li>攻撃する（attack()）</li>
                        <li>防御する（defend()）</li>
                        <li>魔法を使う（magic()）</li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col justify-center h-full">
                <p class="text-gray-700 text-sm leading-relaxed italic border-l-4 border-[#6A73A6] pl-4">
                    これらをバラバラに実装すると、「どのHPがどのスライムのものか？」が分かりにくくなります。
                    そこで、これらすべてを<strong>「Slime（スライム）」という1つの物体（オブジェクト）</strong>の中に閉じ込めてしまうのがオブジェクト指向のスタイルです。
                </p>
            </div>
        </div>

        
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            オブジェクトを構成する2つの要素
        </h4>
        <p class="text-gray-700">
            オブジェクト（object）は日本語で<strong>「物体」</strong>を意味します。オブジェクト指向では、この「物体」の中にデータと処理を詰め込みます。
            これに伴い、呼び方も以下のように変わります。
        </p>

        <div class="overflow-hidden rounded-xl border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">従来の呼び方</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">オブジェクト内での呼び方</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">意味</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    <tr>
                        <td class="px-6 py-4 font-mono text-gray-500 font-bold">変数</td>
                        <td class="px-6 py-4 font-bold text-blue-600">プロパティ (Property)</td>
                        <td class="px-6 py-4 text-gray-600">オブジェクトが持っている「状態」や「データ」</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono text-gray-500 font-bold">関数</td>
                        <td class="px-6 py-4 font-bold text-green-600">メソッド (Method)</td>
                        <td class="px-6 py-4 text-gray-600">オブジェクトができる「動作」や「振る舞い」</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-[#6A73A6] bg-opacity-10 p-6 rounded-xl">
            <p class="text-gray-700 text-sm leading-relaxed">
                このように、<strong>「プロパティ」</strong>と<strong>「メソッド」</strong>をパッケージ化して管理することで、ソースコードの見やすさや、開発のしやすさが飛躍的に向上します。
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}