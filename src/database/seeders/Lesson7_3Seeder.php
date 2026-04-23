<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson7_3Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson7（ターミナル）を取得
        $lesson7 = Lesson::where('title', 'ターミナル')->first();

        if (!$lesson7) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson7->id,
                'sort_order' => 3
            ],
            [
                'title' => 'VS Codeのターミナル',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            VS Codeでもターミナルが自動的に立ち上がっているので、確認してみましょう。
            以下の画面がターミナルです。
        </p>

        

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 shadow-inner">
            <p class="text-sm text-gray-500 mb-2">※VS Code下部に表示されているエリアです</p>
            <div class="rounded-lg overflow-hidden border border-gray-300">
                <img src="/images/Lesson7-1.png" alt="VS Codeのターミナル画面" class="w-full h-auto">
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            コマンドプロンプトの見方
        </h4>
        <p class="text-gray-700">
            ターミナルの以下のような表示は<strong>コマンドプロンプト</strong>と呼ばれ、コマンド入力待ちの状態であることを示しています。
        </p>

        <div class="bg-gray-900 rounded-xl p-6 shadow-lg border border-gray-700">
            <div class="flex items-center gap-2 mb-4 border-b border-gray-700 pb-2">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                <span class="text-gray-400 text-xs ml-2 font-mono">terminal — SunSunTech</span>
            </div>
            <div class="font-mono text-lg flex flex-wrap gap-x-2">
                <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                <span class="text-blue-400">SunSunTech</span>
                <span class="text-white">%</span>
                <span class="w-2 h-6 bg-gray-400 animate-pulse"></span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-500 font-bold mb-1 uppercase">User info</p>
                <p class="text-sm font-bold text-green-600">tomoyasuzuki@MacBookPro</p>
                <p class="text-xs text-gray-600 mt-1">パソコンの「ユーザ名」を表示しています。</p>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-500 font-bold mb-1 uppercase">Current Directory</p>
                <p class="text-sm font-bold text-blue-600">SunSunTech</p>
                <p class="text-xs text-gray-600 mt-1">「現在のディレクトリ（フォルダ）」を指しています。</p>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <p class="text-xs text-gray-500 font-bold mb-1 uppercase">Symbol</p>
                <p class="text-sm font-bold text-gray-800">% (または $)</p>
                <p class="text-xs text-gray-600 mt-1">ここからコマンドを入力できるという合図です。</p>
            </div>
        </div>
    </section>

    <div class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded-r-xl">
        <h5 class="font-bold text-blue-800 flex items-center gap-2 mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            もしターミナルが表示されていない時は
        </h5>
        <p class="text-gray-700 text-sm leading-relaxed">
            VS Codeの上部メニューにある <strong>「表示」→「ターミナル」</strong> をクリックするか、ショートカットキー <code>Ctrl + J</code> (Macは <code>Command + J</code>) を押すことで表示・非表示を切り替えることができます。
        </p>
    </div>
</div>'
            ]
        );
    }
}