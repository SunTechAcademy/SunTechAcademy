<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson8_3Seeder extends Seeder
{
    public function run(): void
    {
        $lesson8 = Lesson::where('title', 'PHPその1')->first();

        if (!$lesson8) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson8->id,
                'sort_order' => 3
            ],
            [
                'title' => 'PHPプログラミングの基本的なルール',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            ここからは実際にPHPファイルを作成し、実行します。<br>
            <strong>VS Code</strong>を開きましょう。
        </p>

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h4 class="font-bold text-gray-800 mb-2">PHPファイル</h4>
            <p class="text-sm text-gray-600 leading-relaxed">
                PHPファイルも、HTMLファイルやCSSファイルと同じくテキストファイルです。拡張子は <strong>.php</strong> です。<br>
                VS Code上で編集・保存していきましょう。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            プログラムが動く順番（逐次処理）
        </h4>
        <p class="text-gray-700">
            PHPに限らずプログラムは、上から下、同じ行なら左から右へ向かって実行されていきます。
        </p>

        <div class="bg-gray-800 rounded-xl p-6 font-mono text-sm text-white">
            <div class="flex items-center gap-2 text-gray-400 mb-2 border-b border-gray-700 pb-1">
                <span>イメージ</span>
            </div>
            <div class="space-y-1">
                <p class="text-indigo-300">PHPの命令1 <span class="text-gray-500 text-xs">// 最初に実行</span></p>
                <p class="text-indigo-300">PHPの命令2 <span class="text-gray-500 text-xs">// 次に実行</span></p>
                <p class="text-indigo-300">PHPの命令3 <span class="text-gray-500 text-xs">// 最後に実行</span></p>
            </div>
        </div>
        <p class="text-sm text-gray-600">
            このように、命令を順番に実行していく性質を <strong>逐次（ちくじ）処理</strong> と呼びます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            "こんにちは"と表示してみる
        </h4>
        
        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800">1. PHPタグ： &lt;?php</h5>
            <p class="text-gray-700">
                PHPはHTMLに埋め込める言語です。開始タグには <code>&lt;?php</code> を使い、終了タグには <code>?&gt;</code> を使います。
            </p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-yellow-200">
                &lt;?php<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-gray-400">// ここにPHPプログラムを書く</span><br>
                ?&gt;
            </div>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-900">
                <strong>終了タグの省略：</strong><br>
                ファイルがPHPプログラムのみで終わる場合、最後の終了タグ <code>?&gt;</code> は記載しないのが一般的です。余分な空白による不具合を防ぐためです。
            </div>
        </div>

        <div class="space-y-4 mt-8">
            <h5 class="font-bold text-lg text-gray-800">2. 画面に表示する命令： print</h5>
            <p class="text-gray-700">データを表示したい場合は <code>print</code> という命令を使います。</p>
            
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                <p class="font-bold text-gray-800 mb-4">【実習】 test.php を作ってみよう</p>
                <ol class="list-decimal list-inside space-y-2 text-sm text-gray-700">
                    <li>VS Codeで新しく <strong>test.php</strong> を作成します。</li>
                    <li>以下の内容を入力して保存してください。</li>
                </ol>
                <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white mt-4">
                    <span class="text-gray-500">test.php</span><br>
                    &lt;?php<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;print <span class="text-green-400">\'こんにちは\'</span>;
                </div>
            </div>
        </div>

        

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                <h6 class="font-bold text-sm mb-2 uppercase text-gray-400 tracking-wider">Quotes</h6>
                <p class="text-xs text-gray-600">
                    文字列は <code>\'</code> または <code>"</code> で囲います。どちらでも動作します。
                </p>
            </div>
            <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                <h6 class="font-bold text-sm mb-2 uppercase text-gray-400 tracking-wider">Semicolon ( ; )</h6>
                <p class="text-xs text-gray-600 font-bold text-red-600">
                    命令の最後には必ず <code>;</code> （セミコロン）をつけてください。日本語の「。」と同じ役割です。
                </p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            PHPファイルを実行する
        </h4>
        <p class="text-gray-700">
            ターミナルで <code>php ファイル名</code> と入力することでプログラムを実行できます。
        </p>

        <div class="bg-gray-900 rounded-xl p-5 font-mono text-sm overflow-x-auto shadow-lg">
            <div class="text-gray-400 mb-1"># ターミナルで実行</div>
            <div class="flex gap-2">
                <span class="text-green-400">%</span>
                <span class="text-white">php test.php</span>
            </div>
            <div class="mt-4 border-t border-gray-700 pt-2">
                <div class="text-gray-400 mb-1"># 実行結果</div>
                <div class="text-white">こんにちは</div>
            </div>
        </div>

        <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4 mt-6">
            <h5 class="font-bold text-indigo-900 mb-2">複数の命令を書いた場合</h5>
            <div class="bg-gray-800 rounded p-4 font-mono text-xs text-white">
                &lt;?php<br>
                &nbsp;&nbsp;&nbsp;&nbsp;print \'おはよう\';<br>
                &nbsp;&nbsp;&nbsp;&nbsp;print \'こんにちは\';<br>
                &nbsp;&nbsp;&nbsp;&nbsp;print \'おやすみ\';
            </div>
            <p class="text-xs text-indigo-700 mt-2">
                実行結果は <code>おはようこんにちはおやすみ</code> となり、上から順に実行されていることがわかります。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            エラー（Syntax Error）
        </h4>
        <p class="text-gray-700">
            綴りを間違えたりセミコロンを忘れたりすると、<strong>syntax error（構文エラー）</strong>が発生します。
        </p>

        <div class="bg-red-50 border border-red-200 rounded-xl p-5 font-mono text-xs text-red-700 overflow-x-auto shadow-sm">
            PHP Parse error:  syntax error, unexpected ... in test.php on <span class="font-bold underline text-red-900">line 2</span>
        </div>
        
        <div class="flex gap-4 items-start bg-white p-4 rounded-lg border border-gray-200">
            <div class="text-2xl">💡</div>
            <p class="text-sm text-gray-700">
                エラー文の <strong>on line ○○</strong> という表示は、「何行目のあたりでエラーになったか」を教えてくれています。
                VS Codeの行番号を確認して、間違いを修正しましょう。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            コメントとコメントアウト
        </h4>
        <p class="text-gray-700">
            ソースコードには実行時に無視される「メモ（コメント）」を残すことができます。
        </p>

        <div class="bg-gray-900 rounded-xl p-6 font-mono text-sm text-green-500">
            &lt;?php<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-gray-500">// 1行だけのコメントです</span><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-gray-500">/*<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;複数行にわたる<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;コメントも書けます<br>
            &nbsp;&nbsp;&nbsp;&nbsp;*/</span><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-gray-500">// print \'こんにちは\'; </span> <span class="text-yellow-400">←コメントアウト（一時的に無効化）</span><br>
            &nbsp;&nbsp;&nbsp;&nbsp;print \'ここだけ動く\';
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <p class="text-sm text-yellow-900">
                <strong>コメントアウト：</strong><br>
                コードを一時的に無効にすることを「コメントアウト」と呼びます。エラーの原因を探したり、後で使うかもしれないコードを消さずに残したりするときに多用するテクニックです。
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}