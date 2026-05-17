<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13_6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lesson13 = Lesson::where('title', 'PHPとMySQLの連携')->first();

        if (!$lesson13) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson13->id,
                'sort_order' => 6,
            ],
            [
                'title' => 'PHPとMySQLを連携する',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">PHPとMySQLを連携する</h2>
        <p class="text-gray-700 leading-relaxed">
            それでは、PHPプログラムの中からMySQLにアクセスし、データを取得・保存する処理を実装していきましょう。
        </p>
        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner flex justify-center mt-6">
            <img src="/images/Lesson13-5.png" alt="Lesson13-5" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">PHPプログラムからMySQLとの通信手段を確保する</h3>
        <p class="text-gray-700 leading-relaxed">
            PHPからMySQLに接続するために、今回は <strong>PDO（PHP Data Objects）</strong> を利用します。
        </p>
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h4 class="font-bold text-blue-800 mb-2">💡 なぜPDOを使うのか？</h4>
            <p class="text-sm text-blue-900 leading-relaxed">
                通常、MySQLやPostgreSQLなど、データベースの種類が変わると専用の命令（関数）を書き換える必要があります。しかし、PDOを使えば接続設定を変えるだけで、同じ命令を使って異なるデータベースを操作できるため、保守性が非常に高まります。
            </p>
        </div>

        <div class="space-y-4">
            <p class="text-gray-700 font-bold">booklist.php の先頭に以下のコードを追加しましょう。</p>
            <div class="bg-gray-800 p-6 rounded-xl font-mono text-sm text-white overflow-x-auto">
                <pre><code>&lt;?php
    // 1. MySQLサーバ接続に必要な値を変数に代入
    $username = 'root'; // 自身の環境に合わせて変更（通常はroot）
    $password = '';     // パスワードが設定されていなければ空

    // 2. PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=booklist;charset=UTF8;', $username, $password);

    // 3. MySQLを使った処理が終わると、切断する
    $database = null;
?&gt;
&lt;!DOCTYPE html&gt;...</code></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MySQLサーバに接続した変数からSQLを実行する</h3>
        <p class="text-gray-700">接続した <code>$database</code> 変数を通して、データを取得するSQLを発行します。</p>
        <div class="bg-gray-800 p-6 rounded-xl font-mono text-sm text-white overflow-x-auto">
            <pre><code>&lt;?php
    $database = new PDO('mysql:host=localhost;dbname=booklist;charset=UTF8;', 'root', '');

    // 実行するSQLを作成
    $sql = 'SELECT * FROM books ORDER BY created_at DESC';
    
    // SQLを実行し、ステートメント（実行状態）を取得
    $statement = $database->query($sql);
    
    // 結果レコードをすべて配列として取り出す
    $records = $statement->fetchAll();

    $statement = null;
    $database = null;
?&gt;</code></pre>
        </div>
        <p class="text-sm text-gray-600 italic">※ $statement に null を代入するのは、使い終わった命令を無効化し、セキュリティやメモリ効率を高めるためです。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">SQLの実行結果を受け取って表示する</h3>
        <p class="text-gray-700">取得した <code>$records</code> を <code>foreach</code> でループさせ、HTMLのリストに出力します。</p>
        <div class="bg-gray-800 p-6 rounded-xl font-mono text-sm text-white overflow-x-auto">
            <pre><code>&lt;ul class="list-disc text-lg ml-16"&gt;
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
&lt;/ul&gt;</code></pre>
        </div>
        <p class="text-sm text-blue-600 font-bold">これで、データベースに入っている本の一覧が表示されるようになりました！</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データの保存とセキュリティ対策</h3>
        <p class="text-gray-700">次に、フォームから送られてきたデータを保存する処理を追加します。ここで重要なのが <strong>「プリペアドステートメント」</strong> です。</p>
        
        <div class="bg-gray-800 p-6 rounded-xl font-mono text-sm text-white overflow-x-auto">
            <pre><code>// フォームから書籍タイトルが送信されていれば
if (array_key_exists('book_title', $_POST)) {
    // 実行するSQLを作成（値の部分を「:book_title」というプレースホルダにする）
    $sql = 'INSERT INTO books (book_title) VALUES(:book_title)';
    
    // SQLの「準備」をする（まだ実行しない）
    $statement = $database->prepare($sql);
    
    // 安全に値を流し込む
    $statement->bindParam(':book_title', $_POST['book_title']);
    
    // ここで初めて実行！
    $statement->execute();
    $statement = null;
}</code></pre>
        </div>

        <div class="bg-red-50 border-l-4 border-red-500 p-6 space-y-4">
            <h4 class="font-bold text-red-800">⚠️ なぜ直接SQLに含めないのか？（SQLインジェクション対策）</h4>
            <p class="text-sm text-red-900 leading-relaxed">
                ユーザーが入力したデータをそのまま <code>INSERT INTO ... VALUES('$_POST[book_title]')</code> のようにSQLに結合してしまうと、悪意あるユーザーが「データを削除する命令」などを混ぜて送信した場合、データベースが破壊される恐れがあります。
                <code>prepare()</code> と <code>bindParam()</code> を使うことで、入力データを単なる「文字列」として安全に処理することができます。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">一覧表示のセキュリティ対策（XSS対策）</h3>
        <p class="text-gray-700">
            表示の際にも対策が必要です。ユーザーが <code>&lt;script&gt;...&lt;/script&gt;</code> のような悪意あるJavaScriptを登録した場合、そのまま表示すると他のユーザーのブラウザで勝手に実行されてしまいます（これを <strong>XSS: クロスサイトスクリプティング</strong> と呼びます）。
        </p>
        <div class="bg-gray-100 p-4 rounded-lg border-l-4 border-gray-800">
            <code class="text-sm font-bold">htmlspecialchars($book_title, ENT_QUOTES, 'UTF-8');</code>
        </div>
        <p class="text-gray-700 leading-relaxed">
            この関数を通すことで、 <code>&lt;</code> や <code>&gt;</code> といった記号を無害な文字列（HTMLエンティティ）に変換し、ブラウザに「プログラム」ではなく「ただの文字」として認識させることができます。
        </p>
    </section>

    <div class="bg-green-50 p-8 rounded-2xl border border-green-200 shadow-sm">
        <h4 class="text-lg font-bold text-green-800 mb-2">Lesson 13 完了！</h4>
        <p class="text-green-900 leading-relaxed text-sm">
            お疲れ様でした！これで「画面から入力したデータを保存し、一覧に表示する」というWebアプリケーションの基本サイクルが完成しました。
            <strong>「SQLを実行する前の prepare」「表示する前の htmlspecialchars」</strong>。この2つはエンジニアの義務として、必ず忘れないようにしましょう！
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}