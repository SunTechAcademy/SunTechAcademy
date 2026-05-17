<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13_4Seeder extends Seeder
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
                'sort_order' => 4,
            ],
            [
                'title' => 'HTML内で動的な部分をPHPで置き換える',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">HTML内で動的な部分をPHPで置き換える</h2>
        <p class="text-gray-700 leading-relaxed">
            表示を確認したところで、次にHTML内で<strong>「動的な部分（データによって中身が変わる場所）」</strong>をPHPで置き換えてみます。
            今回の場合、書籍一覧の <code>li</code> 要素がその動的な部分にあたります。
        </p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 italic text-blue-600">booklist.php (body部分のみ抜粋)</h3>
        <div class="bg-gray-800 p-6 rounded-xl font-mono text-sm leading-relaxed text-white overflow-x-auto">
            <pre><code>&lt;body class="mt-4"&gt;
    &lt;div class="mx-auto w-3/4"&gt;
        ... (ヘッダーやフォーム部分は省略) ...

        &lt;hr /&gt;

        &lt;h2 class="text-4xl my-2"&gt;登録された書籍一覧&lt;/h2&gt;
        &lt;ul class="list-disc text-lg ml-16"&gt;
            &lt;li&gt;はじめてのWebアプリケーション&lt;/li&gt;
            &lt;li&gt;かんたん！PHPプログラミング&lt;/li&gt;
            &lt;li&gt;PHP+MySQLで作るWebアプリケーション&lt;/li&gt;

            <span class="text-yellow-400">&lt;?php // 登録された書籍タイトルの数だけループ 開始 ?&gt;</span>
                &lt;li&gt;<span class="text-yellow-400">&lt;?php // print 書籍タイトル; ?&gt;</span>&lt;/li&gt;
            <span class="text-yellow-400">&lt;?php // ループ 終了 ?&gt;</span>

        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/body&gt;</code></pre>
        </div>
        <p class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg border-l-4 border-gray-300">
            MySQLと連携してデータをもらったうえでループを回すことになるため、現時点では正確なプログラムは書けません。
            まずは <code>&lt;?php // コメント ?&gt;</code> という形式で、<strong>「ここに何をプログラミングするか」</strong>をメモしておくだけでOKです。
        </p>
    </section>

    <section class="space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">開発用の確認コード</h2>
        <p class="text-gray-700 leading-relaxed">
            開発中、「フォームはちゃんと送信されているか？」などを頻繁に確認することになります。
            その場合、<strong>確認用のデバッグコード</strong>を入れておくと、目に見えないデータの動きを可視化できて非常に便利です。
        </p>

        <div class="space-y-4">
            <h3 class="text-xl font-bold text-gray-800">booklist.php (全コード)</h3>
            <div class="bg-gray-800 p-6 rounded-xl font-mono text-sm leading-relaxed text-white overflow-x-auto">
                <pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8"&gt;
        &lt;title&gt;Booklist&lt;/title&gt;
        ... (CSS読み込み等は省略) ...
    &lt;/head&gt;
    &lt;body class="mt-4"&gt;

<span class="bg-blue-900 text-blue-100 px-2 py-1 rounded">/* フォームデータ送受信確認用コード（本番では削除） */</span>
<span class="text-blue-300 font-bold">&lt;?php
    print '&lt;div style="background-color: skyblue;"&gt;';
    print '&lt;p&gt;動作確認用:&lt;/p&gt;';
    print_r($_POST);
    print '&lt;/div&gt;';
?&gt;</span>
        &lt;div class="mx-auto w-3/4"&gt;
            &lt;h1 class="font-bold text-5xl text-blue-600 my-2"&gt;&lt;a href="booklist.php"&gt;Booklist&lt;/a&gt;&lt;/h1&gt;

            &lt;h2 class="text-4xl my-2"&gt;書籍の登録フォーム&lt;/h2&gt;
            &lt;form action="booklist.php" method="POST" class="flex"&gt;
                &lt;div class="form-control w-3/4 my-4 flex-1"&gt;
                    &lt;input type="text" name="book_title" required placeholder="書籍タイトルを入力" class="input input-bordered w-3/4 text-xl "&gt;
                &lt;/div&gt;
                &lt;div class="w-1/4 my-4 flex-1"&gt;
                    &lt;button type="submit" name="submit_add_book" class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2"&gt;登録&lt;/button&gt;
                &lt;/div&gt;
            &lt;/form&gt;

            &lt;hr /&gt;

            &lt;h2 class="text-4xl my-2"&gt;登録された書籍一覧&lt;/h2&gt;
            &lt;ul class="list-disc text-lg ml-16"&gt;
                &lt;li&gt;はじめてのWebアプリケーション&lt;/li&gt;
                ...
                &lt;?php // ループで回す予定の場所 ?&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <p class="text-gray-700">
            フォームを送信すると、画面上部に <code>print_r($_POST);</code> の内容が表示されます。
            これにより、PHPがブラウザからデータを受け取れているかどうかが一目でわかります。
        </p>
        
        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner flex justify-center">
            <img src="/images/Lesson13-4.png" alt="Lesson13-4" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>
    </section>

    <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
        <h4 class="font-bold text-blue-800 mb-2">💡 ここで確認できたこと</h4>
        <ul class="list-disc ml-6 space-y-2 text-sm text-blue-900">
            <li><strong>動的な部分：</strong> 書籍タイトル一覧の <code>li</code> 要素をループで回す必要がある。</li>
            <li><strong>必要なデータ：</strong> 書籍タイトルの文字列データを保存・取得する必要がある。</li>
            <li><strong>データの導線：</strong> <code>$_POST['book_title']</code> を通じて、フォーム入力がPHPに届いている。</li>
        </ul>
    </div>
</div>
EOF
            ]
        );
    }
}