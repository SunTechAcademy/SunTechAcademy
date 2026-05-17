<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_9Seeder extends Seeder
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
                'sort_order' => 9,
            ],
            [
                'title' => 'テーブルデータの操作（CRUD）',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">テーブルデータの操作（CRUD）</h2>
        <p class="text-gray-700 leading-relaxed">
            bookstoreデータベースの下にbooksテーブルが作成されました。
            今度はテーブルの下にレコード（データ列）を保存し、操作しましょう。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データの作成・保存（Create）</h3>
        <p class="text-gray-700 leading-relaxed">
            CRUDの <strong>C（Create）</strong> です。
            SQLでは、新しいデータの登録に <strong>INSERT文</strong> を用います。<code>INSERT INTO</code> と <code>VALUES</code> がキーワードになります。
        </p>
        
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 text-sm text-blue-800 italic">
            <strong>Tip:</strong> SQLのキーワードを大文字で入力すると、キーワードとそれ以外（テーブル名や値）を区別しやすくなります。このレッスンではキーワードを大文字で記述します。
        </div>

        <div class="space-y-4 mt-6">
            <h4 class="font-bold text-gray-800">INSERT構文</h4>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
                INSERT INTO テーブル名 (カラム1, カラム2, ...) VALUES (値1, 値2, ...);
            </div>
            <p class="text-sm text-gray-600">※ カラム1と値1、カラム2と値2が対応しています。</p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">テーブルにデータ（1行）を追加</h4>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono">mysql> INSERT INTO books (title, price) VALUES ("はじめてのMySQL", 2980);</code>
            </div>
        </div>

        <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded text-sm text-amber-900">
            <strong>注意：</strong> 以降、テーブル名のところに <code>books</code> とだけ記述しているSQL文を実行する際は、<code>USE bookstore;</code> を事前に実行していることが前提です。実行していない場合は <code>bookstore.books</code> と記述する必要があります。
        </div>

        <p class="text-gray-700 leading-relaxed">
            このSQL文を実行すると、<code>title</code> に「はじめてのMySQL」、<code>price</code> に「2980」を格納したレコードが保存されます。
            <code>id</code> は <strong>AUTO_INCREMENT</strong>、<code>created_at</code> は <strong>DEFAULT CURRENT_TIMESTAMP</strong> 設定のため、それぞれ「1」や「現在日時」が自動的に入ります。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データの取得（Read）</h3>
        <p class="text-gray-700 leading-relaxed">
            CRUDの <strong>R（Read）</strong> です。
            データの取得には <strong>SELECT文</strong> を用います。<code>SELECT</code> と <code>FROM</code> がキーワードになります。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">SELECT構文</h4>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
                SELECT カラム名 FROM テーブル名;
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">データの取得</h4>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono">mysql> SELECT * FROM books;</code>
            </div>
            <p class="text-xs text-gray-500">※ <code>*</code>（アスタリスク）を書くとテーブルのすべてのカラムを取得できます。</p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">実行結果</h4>
            <pre class="bg-black text-green-400 p-6 rounded-xl font-mono text-sm overflow-x-auto">
+----+----------------------+-------+---------------------+
| id | title                | price | created_at          |
+----+----------------------+-------+---------------------+
|  1 | はじめてのMySQL      |  2980 | 2016-11-07 06:20:12 |
+----+----------------------+-------+---------------------+
1 row in set (0.00 sec)</pre>
            <p class="text-gray-700 text-sm italic mt-2">
                ※全角文字が入っていると枠が少しずれることがありますが、データ自体に問題はありません。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データの更新（Update）</h3>
        <p class="text-gray-700 leading-relaxed">
            CRUDの <strong>U（Update）</strong> です。
            データの更新には <strong>UPDATE文</strong> を用います。<code>UPDATE</code> と <code>SET</code> がキーワードになります。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">UPDATE構文</h4>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
                UPDATE テーブル名 SET カラム名1 = 値1, カラム名2 = 値2, ...
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">データの更新</h4>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono">mysql> UPDATE books SET price = 1480;</code>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">更新後の確認（SELECTを実行）</h4>
            <pre class="bg-black text-green-400 p-6 rounded-xl font-mono text-sm overflow-x-auto">
+----+----------------------+-------+---------------------+
| id | title                | price | created_at          |
+----+----------------------+-------+---------------------+
|  1 | はじめてのMySQL      |  1480 | 2016-11-07 06:20:12 |
+----+----------------------+-------+---------------------+</pre>
            <p class="text-gray-700"><code>price</code> が 1480 に更新されていることが確認できます。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データの削除（Delete）</h3>
        <p class="text-gray-700 leading-relaxed">
            CRUDの <strong>D（Delete）</strong> です。
            データの削除には <strong>DELETE文</strong> を用います。<code>DELETE</code> と <code>FROM</code> がキーワードになります。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">DELETE構文</h4>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
                DELETE FROM テーブル名
            </div>
        </div>

        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded text-sm text-red-900 mb-6">
            <strong>重要：</strong> このコマンドは、テーブルに保存されている <strong>すべての</strong> レコードを削除します。
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">データの削除</h4>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono">mysql> DELETE FROM books;</code>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">削除後の確認</h4>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono">mysql> SELECT * FROM books;</code>
            </div>
            <pre class="bg-black text-green-400 p-4 rounded-xl font-mono text-sm inline-block">
Empty set (0.00 sec)</pre>
            <p class="text-gray-700">
                <code>Empty set</code> は、テーブルの中身が空であることを示すメッセージです。これで削除が完了しました。
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}