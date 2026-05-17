<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_12Seeder extends Seeder
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
                'sort_order' => 12,
            ],
            [
                'title' => '集計関数でレコードを分析する',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">集計関数でレコードを分析する</h2>
        <p class="text-gray-700 leading-relaxed text-lg">
            MySQLには、計算や文字列の結合などを行える<strong>関数</strong>が、標準で用意されています。ここでは、実務で非常によく使う<strong>集計関数</strong>を紹介します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">COUNT関数</h3>
        <p class="text-gray-700 leading-relaxed">
            <strong>COUNT関数</strong>は、レコードの件数（行数）を集計します。
        </p>

        <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
            <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">COUNT関数の書式</h4>
            SELECT COUNT(*) FROM テーブル名;
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 italic">① 全件のレコード数を取得</h4>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono text-sm">mysql> SELECT COUNT(*) FROM books;</code>
            </div>
            <div class="mt-2">
                <p class="text-xs text-gray-500 font-bold mb-1">実行結果</p>
                <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm inline-block">
+----------+
| COUNT(*) |
+----------+
|        4 |
+----------+</pre>
            </div>
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-gray-800 italic">② WHEREを使って対象を絞り込んで集計</h4>
            <p class="text-sm text-gray-600 leading-relaxed">
                WHERE句を組み合わせることで、「条件に一致したレコードのみ」をカウントできます。<br>
                例：<strong>priceが1500より大きいデータの数</strong>を集計する
            </p>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono text-sm">mysql> SELECT COUNT(*) FROM books WHERE price > 1500;</code>
            </div>
            <div class="mt-2">
                <p class="text-xs text-gray-500 font-bold mb-1">実行結果</p>
                <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm inline-block">
+----------+
| COUNT(*) |
+----------+
|        2 |
+----------+</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">SUM関数</h3>
        <p class="text-gray-700 leading-relaxed">
            <strong>SUM関数</strong>を使うと、指定したカラムの数値の<strong>合計</strong>を算出できます。
        </p>

        <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
            <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">SUM関数の書式</h4>
            SELECT SUM(カラム名) FROM テーブル名;
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">price（価格）の合計を集計する</h4>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono text-sm">mysql> SELECT SUM(price) FROM books;</code>
            </div>
            <div class="mt-2">
                <p class="text-xs text-gray-500 font-bold mb-1">実行結果</p>
                <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm inline-block">
+------------+
| SUM(price) |
+------------+
|       7640 |
+------------+</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">AVG関数</h3>
        <p class="text-gray-700 leading-relaxed">
            <strong>AVG関数</strong>（Average）を使うと、指定したカラムの<strong>平均値</strong>を算出できます。
        </p>

        <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
            <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">AVG関数の書式</h4>
            SELECT AVG(カラム名) FROM テーブル名;
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">price（価格）の平均を表示する</h4>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono text-sm">mysql> SELECT AVG(price) FROM books;</code>
            </div>
            <div class="mt-2">
                <p class="text-xs text-gray-500 font-bold mb-1">実行結果</p>
                <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm inline-block">
+------------+
| AVG(price) |
+------------+
|  1910.0000 |
+------------+</pre>
            </div>
        </div>
    </section>

    <div class="bg-blue-50 border border-blue-100 p-6 rounded-xl shadow-sm">
        <h4 class="text-blue-800 font-bold mb-2 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Lesson 12 お疲れ様でした！
        </h4>
        <p class="text-blue-900 text-sm leading-relaxed">
            データベースの作成、テーブル設計、そしてデータの操作（CRUD）と集計まで、MySQLの基本を一通り学び終えました。これらのSQLコマンドは、今後PHPやLaravelなどのプログラムからデータベースを操作する際にも、その基礎となる非常に重要な知識です。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}