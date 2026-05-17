<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13_7Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 13 (PHPとMySQLの連携) を取得
        $lesson13 = Lesson::where('title', 'PHPとMySQLの連携')->first();

        if (!$lesson13) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson13->id,
                'sort_order' => 7,
            ],
            [
                'title' => 'booklistの完成',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">booklistの完成</h2>
        <p class="text-gray-700 leading-relaxed">
            最後に <strong>booklist.php</strong> のコード全文を掲載します。
            ここまで作った内容に問題がないか、自分の書いたコードと見比べて確認してください。
        </p>
        <p class="text-gray-700 leading-relaxed mt-4 italic text-sm">
            ※開発中の確認用として設けていた <code>print_r</code> の命令は、本番用として削除しています。
        </p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            booklist.php（完成）
        </h3>
        <div class="relative">
            <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs px-3 py-1 rounded-bl-lg font-bold shadow-sm">FINAL VERSION</div>
            <pre class="bg-gray-800 text-white p-6 rounded-xl font-mono text-sm overflow-x-auto leading-relaxed shadow-lg"><code>&lt;?php
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'dbuser';
    $password = 'dbpass';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=booklist;charset=UTF8;', $username, $password);

    // フォームから書籍タイトルが送信されていればデータベースに保存する
    if (array_key_exists('book_title', $_POST)) {
        // 実行するSQLを作成
        $sql = 'INSERT INTO books (book_title) VALUES(:book_title)';
        // ユーザ入力に依存するSQLを実行するので、セキュリティ対策をする
        $statement = $database-&gt;prepare($sql);
        // ユーザ入力データ($_POST['book_title'])をVALUES(?)の?の部分に代入する
        $statement-&gt;bindParam(':book_title', $_POST['book_title']);
        // SQL文を実行する
        $statement-&gt;execute();
        // ステートメントを破棄する
        $statement = null;
    }

    // 実行するSQLを作成
    $sql = 'SELECT * FROM books ORDER BY created_at DESC';
    // SQLを実行する
    $statement = $database-&gt;query($sql);
    // 結果レコード（ステートメントオブジェクト）を配列に変換する
    $records = $statement-&gt;fetchAll();

    // ステートメントを破棄する
    $statement = null;
    // MySQLを使った処理が終わると、接続は不要なので切断する
    $database = null;
?&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8"&gt;
        &lt;meta name="viewport" content="width=device-width, initial-scale=1"&gt;
        &lt;title&gt;Booklist&lt;/title&gt;
        &lt;link href="https://cdn.jsdelivr.net/npm/daisyui@2.24.0/dist/full.css" rel="stylesheet" type="text/css"&gt;
        &lt;script src="https://cdn.tailwindcss.com/3.1.8"&gt;&lt;/script&gt;
    &lt;/head&gt;
    &lt;body class="mt-4"&gt;
        &lt;div class="mx-auto w-3/4"&gt;
            &lt;h1 class="font-bold text-5xl text-blue-600 my-2"&gt;&lt;a href="booklist.php"&gt;Booklist&lt;/a&gt;&lt;/h1&gt;
            
            &lt;h2 class="text-4xl my-2"&gt;書籍の登録フォーム&lt;/h2&gt;
            &lt;form action="booklist.php" method="POST" class="flex"&gt;
                &lt;div class="form-control w-3/4 my-4 flex-1"&gt;
                    &lt;!-- フォームの基本 --&gt;
                    &lt;input type="text" name="book_title" required placeholder="書籍タイトルを入力" class="input input-bordered w-3/4 text-xl"&gt;
                &lt;/div&gt;
                &lt;div class="w-1/4 my-4 flex-1"&gt;
                    &lt;button type="submit" name="submit_add_book" class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2"&gt;登録&lt;/button&gt;
                &lt;/div&gt;
            &lt;/form&gt;
            
            &lt;hr /&gt;
            
            &lt;h2 class="text-4xl my-2"&gt;登録された書籍一覧&lt;/h2&gt;
            &lt;ul class="list-disc text-lg ml-16"&gt;

            &lt;?php
                if ($records) {
                    foreach ($records as $record) {
                        $book_title = $record['book_title'];
            ?&gt;
                        &lt;li&gt;&lt;?php print htmlspecialchars($book_title, ENT_QUOTES, "UTF-8"); ?&gt;&lt;/li&gt;
            &lt;?php
                    }
                }
            ?&gt;

            &lt;/ul&gt;
        &lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
    </section>

    <div class="bg-indigo-50 border-t-4 border-indigo-500 p-8 rounded-xl shadow-sm space-y-4">
        <h4 class="text-xl font-bold text-indigo-900">🎉 Lesson 13 完遂！</h4>
        <p class="text-indigo-800 leading-relaxed">
            これで、データベースを活用したWebアプリケーションの「最小構成」が完成しました。<br>
            <strong>「HTMLで枠組みを作る」→「DBを設計する」→「PHPで繋ぐ」</strong>。<br>
            この一連の流れを経験したことで、あなたは単なる「Web制作者」から「Web開発者」への第一歩を踏み出しました。
        </p>
        <div class="flex items-center gap-4 text-sm text-indigo-700 font-medium bg-white/50 p-4 rounded-lg">
            <span class="flex items-center gap-1">✅ PDO接続</span>
            <span class="flex items-center gap-1">✅ SQLインジェクション対策(prepare)</span>
            <span class="flex items-center gap-1">✅ XSS対策(htmlspecialchars)</span>
        </div>
    </div>
</div>
EOF
            ]
        );
    }
}