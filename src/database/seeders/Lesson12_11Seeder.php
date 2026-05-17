<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_11Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 12 (MySQL) を取得
        $lesson12 = Lesson::where('title', 'MySQL')->first();

        if (!$lesson12) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson12->id,
                'sort_order' => 11,
            ],
            [
                'title' => 'ORDER BY句で順番を決める',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">ORDER BY句で順番を決める</h2>
        <p class="text-gray-700 leading-relaxed">
            表示順を並べ替えることも可能です。そのために使うキーワードは、<strong>ORDER BY</strong> です。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">ORDER BYを使ったSELECT文の書式</h3>
        
        <div class="bg-gray-100 p-6 rounded-lg font-mono text-gray-800 leading-relaxed">
            SELECT カラム名 <br>
            FROM テーブル名 <br>
            ORDER BY カラム名 [ [ASC] | DESC ];
        </div>

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 text-sm text-blue-800">
            <p>※ 上記の <strong>[ ]</strong> は省略可能を、<strong>|</strong> は、いずれか（or）を意味します。</p>
        </div>

        <p class="text-gray-700 leading-relaxed">
            ORDER BYを指定すると、データを小さい順（昇順）に並べ替えて表示させることができます。これは <strong>テーブル内の順番が変わるのではなく、あくまで表示上そう見えるようにできるだけ</strong> です。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">実際に並べ替える（昇順）</h3>
        <p class="text-gray-700">以下のSQL文を入力・実行してみましょう。</p>
        
        <div class="bg-gray-800 p-6 rounded-xl shadow-inner">
            <p class="text-blue-300 text-xs mb-2">// priceの小さい順（デフォルト）に並べ替え</p>
            <code class="text-white font-mono text-sm">mysql> SELECT * FROM books ORDER BY price;</code>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500 font-bold mb-2">実行結果</p>
            <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm overflow-x-auto">
+----+----------------------+-------+---------------------+
| id | title                | price | created_at          |
+----+----------------------+-------+---------------------+
|  4 | はじめてのHTML       |  1200 | 2026-05-17 19:09:48 |
|  1 | はじめてのMySQL      |  1480 | 2026-05-17 19:02:08 |
|  3 | はじめてのPHP        |  1980 | 2026-05-17 19:09:39 |
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |
+----+----------------------+-------+---------------------+</pre>
            <p class="text-sm text-gray-600 mt-2">priceの小さい順に並べ替えられました。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">大きい順（降順）に並べ替える</h3>
        <p class="text-gray-700 leading-relaxed">
            大きい順（降順）に並べ替えたい場合には、<code>ORDER BY カラム名</code> のあとに <strong>DESC</strong> をつけます。
        </p>

        <div class="bg-gray-800 p-6 rounded-xl shadow-inner">
            <p class="text-blue-300 text-xs mb-2">// priceの大きい順（降順）に並べ替え</p>
            <code class="text-white font-mono text-sm">mysql> SELECT * FROM books ORDER BY price DESC;</code>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500 font-bold mb-2">実行結果</p>
            <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm overflow-x-auto">
+----+----------------------+-------+---------------------+
| id | title                | price | created_at          |
+----+----------------------+-------+---------------------+
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |
|  3 | はじめてのPHP        |  1980 | 2026-05-17 19:09:39 |
|  1 | はじめてのMySQL      |  1480 | 2026-05-17 19:02:08 |
|  4 | はじめてのHTML       |  1200 | 2026-05-17 19:09:48 |
+----+----------------------+-------+---------------------+</pre>
        </div>
    </section>

    <div class="bg-amber-50 border-l-4 border-amber-400 p-6 rounded-r-xl">
        <h4 class="text-amber-800 font-bold flex items-center gap-2 mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            パフォーマンスに関する注意
        </h4>
        <p class="text-amber-900 text-sm leading-relaxed">
            今はあまり意識する必要ありませんが、テーブルに大量のレコードが登録されている場合、<strong>並び替えはサーバに負荷がかかる</strong> ため注意しましょう。実務ではインデックスの活用などが重要になります。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}