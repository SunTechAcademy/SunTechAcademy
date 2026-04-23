<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson7_2Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson7（ターミナル）を取得
        $lesson7 = Lesson::where('title', 'ターミナル')->first();

        if (!$lesson7) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson7->id,
                'sort_order' => 2
            ],
            [
                'title' => 'ターミナルとは',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            ターミナルとは、<strong>コマンド</strong>と呼ばれる命令文を用いてコンピュータの操作を行なうツールです。
        </p>
        <p class="text-gray-700">
            コマンドは、UNIXコマンドや、Linuxコマンドと呼ばれます。「UNIX」や「Linux」とは、普段使っているパソコンのWindowsやMac OSのようなOSのことで、ターミナルを用いて制御を行ないます。Mac OSやWindowsも、標準でターミナル機能を持っています。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            CUI と GUI の違い
        </h4>
        <p class="text-gray-700">
            ターミナルのように、コマンドでコンピュータを操作する環境のことを <strong>CUI</strong> と呼び、私たちが普段マウスで操作している環境を <strong>GUI</strong> と呼びます。
        </p>

        

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div class="bg-gray-800 text-white p-6 rounded-xl shadow-md border border-gray-700">
                <h5 class="font-bold text-xl mb-3 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M4 17h16a2 2 0 002-2V9a2 2 0 00-2-2H4a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                    CUI
                </h5>
                <p class="text-sm text-gray-300 font-mono mb-2">Character User Interface</p>
                <p class="text-sm leading-relaxed text-gray-200">
                    Character とは「文字」という意味であり、文字列が中心のユーザインタフェース（操作環境）を指します。昔のコンピュータは、CUIの環境が中心でした。
                </p>
            </div>

            <div class="bg-blue-50 text-gray-800 p-6 rounded-xl shadow-md border border-blue-200">
                <h5 class="font-bold text-xl mb-3 text-blue-800 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                    GUI
                </h5>
                <p class="text-sm text-blue-600 font-mono mb-2">Graphical User Interface</p>
                <p class="text-sm leading-relaxed text-gray-700">
                    マウスやタッチパネルを使ったグラフィカルな画面です。ダブルクリックでアプリを起動し、用意されたボタンやメニューを直感的に操作できます。
                </p>
            </div>
        </div>

        <div class="bg-indigo-50 p-5 rounded-lg border border-indigo-100 mt-6">
            <h5 class="font-bold text-indigo-900 mb-2">💡 なぜCUI（ターミナル）を学ぶの？</h5>
            <p class="text-gray-700 text-sm leading-relaxed">
                開発のためのツール（PHP, MySQL, Git, Laravel, Heroku など）の多くはGUIではなく、CUIであるターミナルのコマンドとして提供されます。そのため、エンジニアリングを学ぶ上でターミナルに慣れておく必要があります。
            </p>
            <div class="flex flex-wrap gap-2 mt-3">
                <span class="bg-white text-indigo-600 border border-indigo-200 px-3 py-1 rounded-full text-xs font-bold">PHP</span>
                <span class="bg-white text-indigo-600 border border-indigo-200 px-3 py-1 rounded-full text-xs font-bold">MySQL</span>
                <span class="bg-white text-indigo-600 border border-indigo-200 px-3 py-1 rounded-full text-xs font-bold">Git</span>
                <span class="bg-white text-indigo-600 border border-indigo-200 px-3 py-1 rounded-full text-xs font-bold">Laravel</span>
                <span class="bg-white text-indigo-600 border border-indigo-200 px-3 py-1 rounded-full text-xs font-bold">Heroku</span>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            ターミナルのメリットとデメリット
        </h4>
        <p class="text-gray-700">
            ターミナルは昔からあるものですが、マウス操作をするのと同等以上のことができます。ターミナルでは、コンピュータのすべてを操ることができるのです。
        </p>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="bg-green-50 border-b border-gray-200 p-4">
                <h5 class="font-bold text-green-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    メリット
                </h5>
            </div>
            <div class="p-6 space-y-4">
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 font-bold">✔</span>
                        <div>
                            <strong>常に同じインターフェイスで操作できる</strong><br>
                            <span class="text-sm text-gray-500">GUIの場合、ボタンの配置や配色など、さまざまな点に目を配る必要がありますが、ターミナルであれば常にコマンドを入力すれば良く、ボタンの位置などを探す必要がありません。</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 font-bold">✔</span>
                        <div>
                            <strong>処理の自動化が簡単（スクリプト化）</strong><br>
                            <span class="text-sm text-gray-500">「毎日同じ時刻に、大事なファイルをサーバへバックアップする」といった処理を行いたい場合、特定のアプリをダウンロードして設定しなくても、コマンドの組み合わせで簡単に自動化できます。</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 shadow-sm">
            <h5 class="font-bold text-yellow-800 mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                デメリット
            </h5>
            <p class="text-gray-700 text-sm">
                ターミナルの操作には、<strong>さまざまなコマンドを覚えたり、調べたりしなければいけない</strong>という学習コスト（ハードル）があります。最初からすべてを暗記する必要はありません。よく使うものから少しずつ慣れていきましょう。
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}