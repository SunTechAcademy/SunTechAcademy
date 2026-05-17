<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_14Seeder extends Seeder
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
                'sort_order' => 14,
            ],
            [
                'title' => 'グループ化',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">グループ化</h2>
        <p class="text-gray-700 leading-relaxed">
            集計関数のチャプターで <code>COUNT(*)</code> を使用した際は、全レコードが1つに集約（グループ化）されました。
            ここでは、特定の条件ごとに複数のグループに分けて集計する方法を学びます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GROUP BY 句</h3>
        <p class="text-gray-700 leading-relaxed">
            1つに集約するのではなく、カラムの値が同じものをまとめてグループ化するには <strong>GROUP BY句</strong> を使用します。
        </p>

        <div class="bg-gray-800 p-6 rounded-xl shadow-inner">
            <p class="text-blue-300 text-xs mb-2">// 現在のchaptersテーブルの中身を確認</p>
            <code class="text-white font-mono text-sm">mysql> SELECT * FROM chapters;</code>
            <pre class="bg-black text-green-400 p-4 mt-4 rounded font-mono text-xs overflow-x-auto">
+----+-------------+--------------------+---------+---------------------+
| id | chapter_num | title              | book_id | created_at          |
+----+-------------+--------------------+---------+---------------------+
|  1 |           1 | MySQLとは          |       2 | 2026-05-17 19:34:01 |
|  2 |           2 | テーブルとは       |       2 | 2026-05-17 19:34:08 |
|  3 |           3 | CRUDとは           |       2 | 2026-05-17 19:34:16 |
|  4 |           1 | PHPとは            |       3 | 2026-05-17 19:38:59 |
|  5 |           2 | 変数とは           |       3 | 2026-05-17 19:39:08 |
|  6 |           3 | 関数とは           |       3 | 2026-05-17 19:39:14 |
+----+-------------+--------------------+---------+---------------------+</pre>
        </div>

        <p class="text-gray-700 leading-relaxed">
            このとき、 <code>GROUP BY book_id</code> とすると、 <strong>book_id が同じものは1つの行</strong> に集約されます。
        </p>

        <div class="bg-gray-800 p-6 rounded-xl">
            <code class="text-white font-mono text-sm">mysql> SELECT * FROM chapters GROUP BY book_id;</code>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500 font-bold mb-2">実行結果</p>
            <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm overflow-x-auto">
+----+-------------+-------------+---------+---------------------+
| id | chapter_num | title       | book_id | created_at          |
+----+-------------+-------------+---------+---------------------+
|  1 |           1 | MySQLとは   |       2 | 2026-05-17 19:34:01 |
|  4 |           1 | PHPとは     |       3 | 2026-05-17 19:38:59 |
+----+-------------+-------------+---------+---------------------+</pre>
            <p class="text-sm text-gray-600 mt-2 italic">
                ※これだけでは「1つの本につき1つの代表的な章」が表示されただけで、他の章が消えたように見えます。GROUP BYが真価を発揮するのは、次の集計関数との組み合わせです。
            </p>
        </div>

        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded text-xs text-red-900 leading-relaxed font-mono">
            <strong>【重要】もし上記SQLが実行できない場合：</strong><br>
            MySQLの「sql_mode」の設定によりエラーが出る場合があります。その際はMySQLから一度ログアウトし、以下のコマンドをターミナルで実行してください：<br>
            <span class="block mt-2 bg-gray-200 p-2 rounded break-all text-black">
                cat /etc/mysql/mysql.conf.d/mysqld.cnf | sed -e '/utf8/d' | sed -e '/sql_mode/d' | sed -e '$acharacter-set-server=utf8\nsql_mode=STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' | sudo tee /etc/mysql/mysql.conf.d/mysqld.cnf
            </span>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">集計関数とグループ化</h3>
        <p class="text-gray-700 leading-relaxed">
            SELECTに <code>COUNT(*)</code> を加え、 <code>GROUP BY book_id</code> を利用することで、 <strong>book_id ごとの件数</strong> を分けて集計できます。
        </p>

        <div class="bg-gray-800 p-6 rounded-xl shadow-inner">
            <code class="text-white font-mono text-sm">mysql> SELECT *, COUNT(*) FROM chapters GROUP BY book_id;</code>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500 font-bold mb-2">実行結果</p>
            <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm overflow-x-auto">
+----+-------------+-------------+---------+---------------------+----------+
| id | chapter_num | title       | book_id | created_at          | COUNT(*) |
+----+-------------+-------------+---------+---------------------+----------+
|  1 |           1 | MySQLとは   |       2 | 2026-05-17 19:34:01 |        3 |
|  4 |           1 | PHPとは     |       3 | 2026-05-17 19:38:59 |        3 |
+----+-------------+-------------+---------+---------------------+----------+</pre>
            <p class="text-sm text-gray-600">
                book_id=2 のグループが3件、book_id=3 のグループが3件あることが正確に集計されました。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">応用：結合とグループ化を同時に行う</h3>
        <p class="text-gray-700 leading-relaxed">
            <code>INNER JOIN</code> で <code>books</code> テーブルを結合すれば、 <strong>「本のタイトル」と「章の数」</strong> を同時に出すことも可能です。
        </p>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 space-y-4">
            <h4 class="font-bold text-blue-800">実践的な分析SQL</h4>
            <div class="bg-gray-800 p-4 rounded-lg">
                <pre class="text-white font-mono text-sm leading-relaxed"><code>mysql> SELECT books.title, COUNT(*) AS number_of_chapters 
       FROM chapters 
       INNER JOIN books ON books.id = chapters.book_id 
       GROUP BY book_id;</code></pre>
            </div>
            
            <div class="space-y-2">
                <p class="text-sm font-bold text-blue-800">💡 キーワード: AS（エイリアス）</p>
                <p class="text-xs text-blue-900 leading-relaxed">
                    <code>COUNT(*) AS number_of_chapters</code> とすることで、計算結果のカラムに分かりやすい名前（別名）を付けています。
                </p>
            </div>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500 font-bold mb-2">実行結果</p>
            <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm inline-block">
+----------------------+--------------------+
| title                | number_of_chapters |
+----------------------+--------------------+
| はじめてのMySQL      |                  3 |
| はじめてのPHP        |                  3 |
+----------------------+--------------------+</pre>
        </div>
    </section>

    <div class="bg-gray-50 p-8 rounded-2xl border border-gray-200">
        <h4 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            活用シーン
        </h4>
        <p class="text-gray-700 text-sm leading-relaxed">
            グループ化と集計関数の組み合わせは、 <strong>「月ごとの売上合計」</strong> <strong>「ユーザーごとの投稿数ランキング」</strong> など、データを意味のある単位で分析する際に必ず使用されます。
            これで MySQL の基礎レッスンは完了です！この知識をベースに、次は PHP や Laravel でプログラムからデータベースを操る技術を学んでいきましょう。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}