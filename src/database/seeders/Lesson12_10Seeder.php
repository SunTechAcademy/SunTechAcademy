<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_10Seeder extends Seeder
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
                'sort_order' => 10,
            ],
            [
                'title' => '条件で絞り込み - WHERE句',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">条件で絞り込み - WHERE句</h2>
        <p class="text-gray-700 leading-relaxed">
            SQLにおけるCRUD操作を見てきましたが、SELECT文やUPDATE文、DELETE文で全レコードが対象となってしまうのは不便（かつ危険）です。
            そこで用意されているのが、<strong>WHERE句</strong> というキーワードです。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">WHERE句をつけたCRUD操作</h3>
        
        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="text-blue-600 font-mono">INSERT</span>
            </h4>
            <p class="text-sm text-gray-600 leading-relaxed">
                まずは、いくつかテスト用のレコードを追加しましょう。
                なお、INSERT文は新しいデータを作成するものであり、条件をつける意味がないため、<strong>WHERE句はありません。</strong>
            </p>
            <div class="bg-gray-800 p-6 rounded-xl shadow-inner">
                <p class="text-blue-300 text-xs mb-2">// データの追加（テスト用）</p>
                <pre class="text-white font-mono text-sm leading-relaxed"><code>mysql> INSERT INTO books (title, price) VALUES ("はじめてのMySQL", 2980);
mysql> INSERT INTO books (title, price) VALUES ("はじめてのPHP", 1980);
mysql> INSERT INTO books (title, price) VALUES ("はじめてのHTML", 1000);
mysql> INSERT INTO books (title, price) VALUES ("はじめてのCSS", 1000);</code></pre>
            </div>
        </div>

        <hr class="border-gray-100">

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="text-blue-600 font-mono">SELECT</span>
            </h4>
            <p class="text-sm text-gray-700 leading-relaxed">
                条件を指定して、特定のレコードだけ取得したい場合には、WHERE句を用います。<br>
                下記のSQLは、<strong>priceが1500より大きい</strong> レコードのみを取得します。
            </p>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono text-sm">mysql> SELECT * FROM books WHERE price > 1500;</code>
            </div>
            <div class="mt-4">
                <p class="text-xs text-gray-500 font-bold mb-2">実行結果</p>
                <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm overflow-x-auto">
+----+----------------------+-------+---------------------+
| id | title                | price | created_at          |
+----+----------------------+-------+---------------------+
|  2 | はじめてのMySQL      |  2980 | 2016-11-07 06:39:29 |
|  3 | はじめてのPHP        |  1980 | 2016-11-07 06:39:34 |
+----+----------------------+-------+---------------------+</pre>
            </div>
        </div>

        <hr class="border-gray-100">

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="text-blue-600 font-mono">UPDATE</span>
            </h4>
            <p class="text-sm text-gray-700 leading-relaxed">
                下記のSQLは、<strong>priceが1000のレコード（2つある）</strong> について、priceを1200へ更新します。
            </p>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono text-sm">mysql> UPDATE books SET price = 1200 WHERE price = 1000;</code>
            </div>
            <div class="mt-4">
                <p class="text-xs text-gray-500 font-bold mb-2">更新後の確認（SELECT * FROM books;）</p>
                <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm overflow-x-auto">
+----+----------------------+-------+---------------------+
| id | title                | price | created_at          |
+----+----------------------+-------+---------------------+
|  1 | はじめてのMySQL      |  1480 | 2026-05-17 19:02:08 |
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |
|  3 | はじめてのPHP        |  1980 | 2026-05-17 19:09:39 |
|  4 | はじめてのHTML       |  1200 | 2026-05-17 19:09:48 |
|  5 | はじめてのCSS        |  1200 | 2026-05-17 19:09:55 |
+----+----------------------+-------+---------------------+</pre>
                <p class="text-xs text-gray-500 mt-2">2つとも1000から1200へ更新されていることがわかります。</p>
            </div>
        </div>

        <hr class="border-gray-100">

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="text-blue-600 font-mono">DELETE</span>
            </h4>
            <p class="text-sm text-gray-700 leading-relaxed">
                下記のSQLは、<strong>titleが「はじめてのCSS」となっているレコード</strong> だけを削除します。
            </p>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono text-sm">mysql> DELETE FROM books WHERE title = "はじめてのCSS";</code>
            </div>
            <div class="mt-4">
                <p class="text-xs text-gray-500 font-bold mb-2">削除後の確認</p>
                <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm overflow-x-auto">
+----+----------------------+-------+---------------------+
| id | title                | price | created_at          |
+----+----------------------+-------+---------------------+
|  1 | はじめてのMySQL      |  1480 | 2026-05-17 19:02:08 |
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |
|  3 | はじめてのPHP        |  1980 | 2026-05-17 19:09:39 |
|  4 | はじめてのHTML       |  1200 | 2026-05-17 19:09:48 |
+----+----------------------+-------+---------------------+</pre>
                <p class="text-xs text-gray-500 mt-2">対象のレコードのみ、削除されていることがわかります。</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">WHERE句で使える比較演算子</h3>
        <p class="text-gray-700 leading-relaxed">
            <code>=</code> や <code>></code> は先ほど使用しましたが、それ以外にも使える比較演算子がいくつかあります。
        </p>

        <div class="overflow-hidden border border-gray-200 rounded-xl shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">比較演算子</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">意味</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                    <tr><td class="px-6 py-3 font-mono">a = b</td><td class="px-6 py-3">aとbが等しい</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a != b</td><td class="px-6 py-3">aとbが等しくない</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a &lt; b</td><td class="px-6 py-3">aがbより小さい</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a &lt;= b</td><td class="px-6 py-3">aがb以下</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a &gt; b</td><td class="px-6 py-3">aがbより大きい</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a &gt;= b</td><td class="px-6 py-3">aがb以上</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a IS NULL</td><td class="px-6 py-3">aがNULLである</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a IS NOT NULL</td><td class="px-6 py-3">aがNULLでない</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a BETWEEN b1 AND b2</td><td class="px-6 py-3">aがb1とb2の間（b1, b2を含む）</td></tr>
                    <tr><td class="px-6 py-3 font-mono">a IN (b1, b2, ...)</td><td class="px-6 py-3">aがカッコ内のいずれかの値と等しい</td></tr>
                </tbody>
            </table>
        </div>
        
        <p class="text-gray-700 leading-relaxed mt-4">
            これらをWHERE句と一緒に使うことで、対象レコードを柔軟に絞り込めます。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}