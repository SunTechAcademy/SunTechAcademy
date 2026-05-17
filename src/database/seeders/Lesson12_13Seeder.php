<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_13Seeder extends Seeder
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
                'sort_order' => 13,
            ],
            [
                'title' => 'テーブルの結合',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">テーブルの結合</h2>
        <p class="text-gray-700 leading-relaxed">
            少し難しい概念ですが、データベース設計の核となる<strong>テーブルの結合</strong>について説明します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブルの正規化</h3>
        <p class="text-gray-700 leading-relaxed">
            たとえば、「はじめてのMySQL」という書籍の<strong>章のタイトル</strong>をデータベースに保存する必要があったとします。
        </p>
        
        <div class="bg-gray-50 p-4 rounded border border-gray-200 text-sm">
            <strong>章の構成例:</strong>
            <ul class="list-disc ml-6 mt-2">
                <li>MySQLとは</li>
                <li>テーブルとは</li>
                <li>CRUDとは</li>
            </ul>
        </div>

        <h4 class="font-bold text-gray-800 mt-6">パターン1: booksテーブルにchapterカラムを追加する</h4>
        <p class="text-sm text-gray-600">
            TEXTデータ型のchapterカラムを設定し、そこに全ての章をテキストとして保存する方法です。
        </p>
        <div class="bg-gray-800 p-4 rounded-lg">
            <pre class="text-white font-mono text-xs leading-relaxed"><code>CREATE TABLE books (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    title VARCHAR(100),
    price INT,
    chapter TEXT, -- ここに「1. MySQLとは 2. テーブルとは...」と保存する
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);</code></pre>
        </div>

        <h4 class="font-bold text-gray-800 mt-6 text-blue-600">パターン2: chaptersテーブルを新規作成する（正規化）</h4>
        <p class="text-sm text-gray-700 leading-relaxed font-bold underline decoration-blue-300">
            効率的にデータを管理しムダを無くすテーブル構造にすることを「正規化」と呼びます。
        </p>
        <p class="text-sm text-gray-600">
            単なるテキストではなく、新しくテーブルを作って1章ごとにレコードとして保存します。
        </p>

        <div class="bg-gray-800 p-6 rounded-xl">
            <pre class="text-white font-mono text-sm leading-relaxed"><code>CREATE TABLE chapters (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    chapter_num INT,     -- 章番号
    title VARCHAR(100),  -- 章タイトル
    book_id INT,         -- どの本に紐づくかのID（重要！）
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);</code></pre>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">データの追加と確認</h4>
            <p class="text-sm text-gray-600">
                「はじめてのMySQL」のid（ここでは 2 と仮定）を <code>book_id</code> に指定して章を追加します。
            </p>
            <div class="bg-gray-800 p-6 rounded-xl shadow-inner">
                <pre class="text-white font-mono text-sm leading-relaxed"><code>mysql> INSERT INTO chapters (chapter_num, title, book_id) VALUES (1, "MySQLとは", 2);
mysql> INSERT INTO chapters (chapter_num, title, book_id) VALUES (2, "テーブルとは", 2);
mysql> INSERT INTO chapters (chapter_num, title, book_id) VALUES (3, "CRUDとは", 2);</code></pre>
            </div>
            
            <p class="text-xs text-gray-500 font-bold mb-1">chaptersテーブルの実行結果</p>
            <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm overflow-x-auto">
+----+-------------+--------------------+---------+---------------------+
| id | chapter_num | title              | book_id | created_at          |
+----+-------------+--------------------+---------+---------------------+
|  1 |           1 | MySQLとは          |       2 | 2016-12-14 04:33:57 |
|  2 |           2 | テーブルとは       |       2 | 2016-12-14 04:34:14 |
|  3 |           3 | CRUDとは           |       2 | 2016-12-14 04:34:25 |
+----+-------------+--------------------+---------+---------------------+</pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブルの結合（INNER JOIN）</h3>
        <p class="text-gray-700 leading-relaxed">
            テーブル同士をくっつけて、1つの結果として表示させるには <strong>INNER JOIN</strong> を使用します。
        </p>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h4 class="font-bold text-blue-800 mb-4">結合の基本コマンド</h4>
            <div class="bg-gray-800 p-4 rounded-lg">
                <code class="text-white font-mono text-sm">SELECT * FROM books INNER JOIN chapters ON books.id = chapters.book_id;</code>
            </div>
        </div>

        <div class="space-y-8 mt-6">
            <h4 class="font-bold text-gray-800 underline">このSQLの仕組み（分解解説）</h4>
            
            <div class="space-y-4">
                <p class="text-sm font-bold text-gray-700">1. SELECT * FROM books</p>
                <p class="text-xs text-gray-600 italic">単体ではbooksテーブルを表示するだけです。</p>
            </div>

            <div class="space-y-4 border-l-4 border-gray-200 pl-4">
                <p class="text-sm font-bold text-gray-700">2. INNER JOIN chapters</p>
                <p class="text-xs text-gray-600">
                    これを足すと、booksの全レコードに対して、chaptersの全レコードを機械的に繋げます。<br>
                    結果、4つの本 × 3つの章 = <strong>9パターン</strong>（不要な組み合わせ含む）が表示されてしまいます。
                </p>
            </div>

            <div class="space-y-4 border-l-4 border-blue-500 pl-4">
                <p class="text-sm font-bold text-blue-700">3. ON books.id = chapters.book_id</p>
                <p class="text-xs text-gray-600">
                    <strong>ここが肝心です。</strong> この条件を加えることで、本のIDと章のbook_idが一致するものだけを抽出します。
                </p>
            </div>
        </div>

        <div class="mt-8">
            <p class="text-xs text-gray-500 font-bold mb-2">最終的な実行結果</p>
            <pre class="bg-black text-green-400 p-4 rounded font-mono text-xs overflow-x-auto">
+----+----------------------+-------+---------------------+----+-------------+--------------------+---------+---------------------+
| id | title                | price | created_at          | id | chapter_num | title              | book_id | created_at          |
+----+----------------------+-------+---------------------+----+-------------+--------------------+---------+---------------------+
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |  1 |           1 | MySQLとは          |       2 | 2026-05-17 19:34:01 |
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |  2 |           2 | テーブルとは       |       2 | 2026-05-17 19:34:08 |
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |  3 |           3 | CRUDとは           |       2 | 2026-05-17 19:34:16 |
+----+----------------------+-------+---------------------+----+-------------+--------------------+---------+---------------------+</pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">chaptersテーブルにレコードを増やす</h3>
        <p class="text-gray-700 text-sm leading-relaxed">
            別の本（はじめてのPHP: id=3）にも章を追加してみましょう。
        </p>
        <div class="bg-gray-800 p-6 rounded-xl shadow-inner">
            <pre class="text-white font-mono text-sm leading-relaxed"><code>mysql> INSERT INTO chapters (chapter_num, title, book_id) VALUES (1, "PHPとは", 3);
mysql> INSERT INTO chapters (chapter_num, title, book_id) VALUES (2, "変数とは", 3);
mysql> INSERT INTO chapters (chapter_num, title, book_id) VALUES (3, "関数とは", 3);</code></pre>
        </div>
        
        <p class="text-sm text-gray-700">再度、結合したSELECT文を実行すると、それぞれの本に正しい章が紐づいて表示されます。</p>
        
        <pre class="bg-black text-green-400 p-4 rounded font-mono text-xs overflow-x-auto">
+----+----------------------+-------+---------------------+----+-------------+--------------------+---------+---------------------+
| id | title                | price | created_at          | id | chapter_num | title              | book_id | created_at          |
+----+----------------------+-------+---------------------+----+-------------+--------------------+---------+---------------------+
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |  1 |           1 | MySQLとは          |       2 | 2026-05-17 19:34:01 |
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |  2 |           2 | テーブルとは       |       2 | 2026-05-17 19:34:08 |
|  2 | はじめてのMySQL      |  2980 | 2026-05-17 19:09:33 |  3 |           3 | CRUDとは           |       2 | 2026-05-17 19:34:16 |
|  3 | はじめてのPHP        |  1980 | 2026-05-17 19:09:39 |  4 |           1 | PHPとは            |       3 | 2026-05-17 19:38:59 |
|  3 | はじめてのPHP        |  1980 | 2026-05-17 19:09:39 |  5 |           2 | 変数とは           |       3 | 2026-05-17 19:39:08 |
|  3 | はじめてのPHP        |  1980 | 2026-05-17 19:09:39 |  6 |           3 | 関数とは           |       3 | 2026-05-17 19:39:14 |
+----+----------------------+-------+---------------------+----+-------------+--------------------+---------+---------------------+</pre>
    </section>

    <section class="bg-amber-50 p-8 rounded-2xl border border-amber-100">
        <h3 class="text-xl font-bold text-amber-800 mb-4">テーブルの結合は「一対多」「多対多」で活躍する</h3>
        <p class="text-amber-900 leading-relaxed text-sm">
            今は少し難しく感じるかもしれませんが、テーブルの結合は実務において極めて重要です。
            後半のレッスンでは、Laravelを使用してX（旧Twitter）クローンを作成しますが、そこで「ユーザーと投稿（一対多）」「投稿といいね（多対多）」といった複雑な関係性を扱う際に、この結合の知識が不可欠になります。
        </p>
        <p class="mt-4 text-amber-900 font-bold text-sm">
            まずは「テーブル同士は条件（ON）を指定して結合できる」ということだけ理解しておけば大丈夫です。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}