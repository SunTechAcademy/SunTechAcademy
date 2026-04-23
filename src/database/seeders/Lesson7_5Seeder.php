<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson7_5Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson7（ターミナル）を取得
        $lesson7 = Lesson::where('title', 'ターミナル')->first();

        if (!$lesson7) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson7->id,
                'sort_order' => 5
            ],
            [
                'title' => '便利な機能',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            ターミナルをより便利に使いこなすための機能についてまとめます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            オプション
        </h4>
        <p class="text-gray-700">
            コマンドには<strong>オプション</strong>をつけることで、動作をカスタマイズできます。
        </p>

        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <div class="bg-gray-50 p-4 border-b border-gray-200">
                <h5 class="font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#6A73A6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    よく使用するコマンドオプション： ls -a
                </h5>
            </div>
            <div class="p-6">
                <div class="bg-gray-900 rounded-md p-4 font-mono text-sm text-white mb-4">
                    <span class="text-green-400">%</span> <span class="text-yellow-300">ls -a</span>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed">
                    <code>ls</code> コマンドに対して <code>-a</code> オプションをつけています。このオプションを使うと、通常のファイルやディレクトリの他に<strong>隠しファイルやディレクトリ</strong>も一覧表示されます。
                </p>
                <div class="mt-4 bg-yellow-50 p-3 rounded border border-yellow-100 text-xs text-yellow-800">
                    <strong>💡 隠しファイルとは？</strong><br>
                    ファイル名の先頭に <code>.</code> （ドット）がついているファイルです（例：<code>.gitignore</code> や <code>.env</code>）。設定ファイルなどに多く、通常の設定では表示されません。
                </div>
            </div>
        </div>
        <p class="text-sm text-gray-600">
            ※オプションには省略形が用意されているものもあります。例えば <code>-a</code> は <code>--all</code> の省略形です。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            manコマンド
        </h4>
        <p class="text-gray-700">
            コマンドの使い方やオプションの一覧を確認したいときは、<strong>manコマンド</strong>（Manualの略）を利用します。
        </p>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
            <div class="bg-gray-900 rounded-md p-4 font-mono text-sm text-white">
                <span class="text-green-400">%</span> <span class="text-yellow-300">man ls</span>
            </div>
            <p class="text-sm text-gray-600 mt-3">
                ※ <code>man</code> コマンドによる表示は英語表記です。日本語で詳しく知りたい場合は、Googleで「コマンド名 使い方」などのキーワードで検索するのが一般的です。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            echoコマンド と catコマンド
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <h5 class="font-bold text-gray-800 mb-2">echo</h5>
                <p class="text-sm text-gray-600">指定された文字列をターミナル画面に表示（出力）します。</p>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <h5 class="font-bold text-gray-800 mb-2">cat</h5>
                <p class="text-sm text-gray-600">ファイルの内容をターミナル画面に表示します。</p>
            </div>
        </div>

        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
            <h5 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                応用例：文字列をファイルに追記する
            </h5>
            <div class="bg-gray-900 rounded-md p-4 font-mono text-sm text-white space-y-2">
                <div>
                    <span class="text-green-400">%</span> <span class="text-yellow-300">echo \'ADD\' >> ~/environment/result.txt</span>
                </div>
                <div class="text-gray-500 text-xs"># >> を使うと、ファイルの末尾に内容を追加できます</div>
                <div class="pt-2">
                    <span class="text-green-400">%</span> <span class="text-yellow-300">cat ~/environment/result.txt</span>
                </div>
                <div class="text-gray-300">ADD</div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            過去に実行したコマンドの呼び出し
        </h4>
        <p class="text-gray-700">
            ターミナルには、以前に実行したコマンドを簡単に再入力する方法があります。
        </p>

        <div class="space-y-4">
            <div class="flex items-start gap-4 bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <div class="bg-gray-100 p-3 rounded-lg text-2xl">⬆️</div>
                <div>
                    <h5 class="font-bold text-gray-800">1. 矢印キー（上）</h5>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        キーボードの <kbd class="px-2 py-1 bg-gray-200 border border-gray-400 rounded shadow-sm font-mono text-xs">↑</kbd> キーを押すと、直前に実行したコマンドが自動で入力されます。何度も押すと、さらに前の履歴を遡ることができます。
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <div class="bg-gray-100 p-3 rounded-lg text-2xl">🔍</div>
                <div>
                    <h5 class="font-bold text-gray-800">2. 履歴の検索</h5>
                    <p class="text-sm text-gray-600 mb-3">
                        コマンド未入力の状態で以下のショートカットキーを押すと、過去の膨大な履歴から検索ができます。
                    </p>
                    <div class="flex items-center gap-4 mb-3">
                        <div class="text-center">
                            <span class="text-[10px] text-gray-400 block mb-1">Windows</span>
                            <kbd class="px-2 py-1 bg-gray-800 text-white border border-gray-600 rounded shadow-sm font-mono text-xs">Ctrl</kbd> + <kbd class="px-2 py-1 bg-gray-800 text-white border border-gray-600 rounded shadow-sm font-mono text-xs">R</kbd>
                        </div>
                        <div class="text-center">
                            <span class="text-[10px] text-gray-400 block mb-1">Mac</span>
                            <kbd class="px-2 py-1 bg-gray-800 text-white border border-gray-600 rounded shadow-sm font-mono text-xs">control</kbd> + <kbd class="px-2 py-1 bg-gray-800 text-white border border-gray-600 rounded shadow-sm font-mono text-xs">R</kbd>
                        </div>
                    </div>
                    <p class="text-xs text-blue-600 bg-blue-50 p-2 rounded">
                        💡 キーを押した後に文字を入力すると、その文字を含む過去のコマンドが表示されます。
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-red-50 border-l-4 border-red-400 p-4 mt-6">
            <p class="text-sm text-red-800">
                <strong>検索を終了・キャンセルしたい場合：</strong><br>
                <kbd class="px-1.5 py-0.5 bg-white border border-gray-300 rounded text-xs font-mono">Ctrl</kbd> + <kbd class="px-1.5 py-0.5 bg-white border border-gray-300 rounded text-xs font-mono">C</kbd> を押すことで、いつでも入力をキャンセルして元の状態に戻ることができます。
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}