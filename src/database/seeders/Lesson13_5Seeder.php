<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13_5Seeder extends Seeder
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
                'sort_order' => 5,
            ],
            [
                'title' => '必要に応じてデータベースのテーブルを作成する',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">必要に応じてデータベースのテーブルを作成する</h2>
        <p class="text-gray-700 leading-relaxed">
            このWebアプリケーションで保存する必要のあるデータは、<strong>書籍タイトル</strong>です。
            フォームから送信された書籍タイトルを受け止めて保存するための、専用のデータベースを作成していきましょう。
        </p>
    </section>

    <section class="space-y-4 bg-green-50 p-6 rounded-xl border border-green-100">
        <h3 class="text-xl font-bold text-green-800 flex items-center gap-2">
            <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
            データベースサーバの起動確認
        </h3>
        <p class="text-sm text-green-900">
            まずはMySQLが動いているか確認しましょう。<br>
            <strong>XAMPP ＞ Manage Servers ＞ MySQL Database</strong> が緑色（Started）になっていればOKです。
        </p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベースサーバへ接続</h3>
        <p class="text-gray-700">管理者権限（root）でログインします。VSCodeのターミナルを開き、OSに合わせて以下のコマンドを実行してください。</p>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-gray-800 p-4 rounded-lg">
                <p class="text-blue-300 text-xs mb-2">■ Macの場合</p>
                <code class="text-white text-xs break-all">/Applications/XAMPP/xamppfiles/bin/mysql -u root -p</code>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg">
                <p class="text-blue-300 text-xs mb-2">■ Windowsの場合</p>
                <code class="text-white text-xs break-all">C:\xampp\mysql\bin\mysql.exe -u root -p</code>
            </div>
        </div>
        <p class="text-xs text-gray-500 italic">※Passwordを求められたら、何も入力せずそのまま Enter を押してください。</p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベースの作成</h3>
        <p class="text-gray-700">新しく <code>booklist</code> データベースを作成し、使用を宣言します。</p>
        <div class="bg-black p-6 rounded-xl font-mono text-sm space-y-4">
            <div>
                <p class="text-gray-500">// 1. データベースを作成</p>
                <code class="text-green-400">mysql> CREATE DATABASE booklist;</code>
            </div>
            <div>
                <p class="text-gray-500">// 2. 一覧にあるか確認</p>
                <code class="text-green-400">mysql> SHOW DATABASES;</code>
            </div>
            <div>
                <p class="text-gray-500">// 3. 作成したデータベースを選択</p>
                <code class="text-green-400">mysql> USE booklist;</code>
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブルの作成</h3>
        <p class="text-gray-700 leading-relaxed">
            次に <code>books</code> テーブルを作成します。
            書籍タイトルのほかに、主キーとなる <code>id</code> と、登録日時を自動記録する <code>created_at</code> を含めます。
        </p>
        <div class="bg-gray-800 p-6 rounded-xl">
            <pre class="text-white font-mono text-sm"><code>CREATE TABLE books (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    book_title VARCHAR(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);</code></pre>
        </div>
        <p class="text-sm text-gray-600 italic">※ターミナルに直接貼り付けて実行しても構いません。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">動作確認（テストデータの挿入）</h3>
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 text-sm text-blue-900 leading-relaxed">
            <strong>なぜ今、確認するのか？</strong><br>
            PHPのコードを書いた後に動かないと、「PHPが悪いのか、DBが悪いのか」がわからなくなります。
            今のうちにDB単体での動作を確認しておくことで、後のトラブルシューティングを楽にします。
        </div>

        <div class="bg-black p-6 rounded-xl font-mono text-xs space-y-4 overflow-x-auto">
            <div>
                <p class="text-gray-500">// テストデータを挿入</p>
                <code class="text-green-400 block">mysql> INSERT INTO books (book_title) VALUES("非エンジニアのためのプログラミング講座");</code>
                <code class="text-green-400 block">mysql> INSERT INTO books (book_title) VALUES("プログラミングPHP");</code>
                <code class="text-green-400 block">mysql> INSERT INTO books (book_title) VALUES("入門HTML5");</code>
            </div>
            <div>
                <p class="text-gray-500">// 挿入されたデータを確認</p>
                <code class="text-green-400">mysql> SELECT * FROM books;</code>
            </div>
            <pre class="text-white mt-4">
+----+-----------------------------------------------------------+---------------------+
| id | book_title                                                | created_at          |
+----+-----------------------------------------------------------+---------------------+
|  1 | 非エンジニアのためのプログラミング講座                    | 2022-08-17 05:58:53 |
|  2 | プログラミングPHP                                         | 2022-08-17 06:19:06 |
|  3 | 入門HTML5                                                 | 2022-08-17 06:19:16 |
+----+-----------------------------------------------------------+---------------------+</pre>
        </div>
        <p class="text-gray-700 leading-relaxed">
            これで、データベース側の準備は完璧です！次はいよいよ、このデータをPHPで読み書き（連携）させていきます。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}