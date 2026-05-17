<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13_3Seeder extends Seeder
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
                'sort_order' => 3,
            ],
            [
                'title' => 'HTMLで書いてみる',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">HTMLで書いてみる</h2>
        <p class="text-gray-700 leading-relaxed">
            プログラムを書くときは、<strong>「小さく作っては確認する」</strong>という作業が、もっとも重要です。いきなり全部作ろうとしないことです。
            特に、慣れていない技術を扱う場合は、まずは小さな動作確認から始めていきましょう。
        </p>
        <p class="text-gray-700 leading-relaxed mt-4">
            まずはHTMLで静的なWebページを作成します。
            <strong>Lesson13</strong>フォルダを作成し、その中に <strong>booklist.php</strong> という名前でファイルを作成してください。
        </p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800">booklist.php</h3>
        <div class="relative">
            <div class="absolute top-0 right-0 bg-gray-700 text-white text-xs px-3 py-1 rounded-bl-lg">HTML / PHP</div>
            <pre class="bg-gray-800 text-white p-6 rounded-xl font-mono text-sm overflow-x-auto leading-relaxed"><code>&lt;!DOCTYPE html&gt;
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
                &lt;li&gt;はじめてのWebアプリケーション&lt;/li&gt;
                &lt;li&gt;かんたん！PHPプログラミング&lt;/li&gt;
                &lt;li&gt;PHP+MySQLで作るWebアプリケーション&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-6">
        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner flex justify-center">
            <img src="/images/Lesson13-3.png" alt="Lesson13-3" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4 text-gray-700">
            <p>
                入力フォームと、そのリストだけのもっとも単純なWebアプリケーションの骨組みです。
            </p>
            <ul class="list-none space-y-3">
                <li class="flex gap-2">
                    <span class="font-bold text-blue-600">・action="booklist.php"</span>
                    <span>フォームの送信先を自分自身に設定しています。</span>
                </li>
                <li class="flex gap-2">
                    <span class="font-bold text-blue-600">・placeholder="..."</span>
                    <span>未入力時に薄いグレーの文字を表示し、入力をガイドします。</span>
                </li>
                <li class="flex gap-2">
                    <span class="font-bold text-blue-600">・required</span>
                    <span>この属性を付けると、ブラウザ側で「空のまま送信」できないよう制限してくれます。</span>
                </li>
            </ul>
        </div>
    </section>

    <div class="bg-amber-50 border-l-4 border-amber-400 p-6 rounded shadow-sm">
        <h4 class="text-amber-800 font-bold mb-2 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            まずは表示を確認しましょう
        </h4>
        <p class="text-amber-900 text-sm leading-relaxed">
            ファイルを作成したら、Webサーバを起動してブラウザで表示を確認してください。
            （サーバの起動方法は <a href="/courses/lessons/11" class="text-blue-600 underline">Lesson 11</a> を参照）
        </p>
        <p class="text-amber-900 text-sm mt-2">
            ※現時点では、登録ボタンを押してもデータはどこにも保存されず、消えてしまいます。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}