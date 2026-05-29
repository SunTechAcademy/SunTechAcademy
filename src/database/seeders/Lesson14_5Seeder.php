<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14_5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lesson14 = Lesson::where('title', 'Git/GitHub')->first();

        if (!$lesson14) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson14->id,
                'sort_order' => 5,
            ],
            [
                'title' => 'Gitの基本概念',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">Gitの基本概念</h2>
        <p class="text-gray-700 leading-relaxed">
            それでは、Gitの基礎的な概念について学んでいきましょう。一度に完全に理解する必要はありません。まずは「Gitってこんな仕組みなんだ」という全体像を掴んでください。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">リポジトリ</h3>
        <p class="text-gray-700 leading-relaxed">
            バージョン管理をするための「情報の保存先」を<strong>リポジトリ</strong>と呼びます。リポジトリは、変更履歴（いつ・誰が・何を）が保管される「魔法の箱」のようなものだとイメージしてください。
        </p>
        
        <div class="grid md:grid-cols-2 gap-6 mt-4">
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h4 class="font-bold text-blue-600 mb-2">ローカルリポジトリ</h4>
                <p class="text-sm text-gray-600">自分のPC上で実際に作業を行うリポジトリです。</p>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h4 class="font-bold text-purple-600 mb-2">リモートリポジトリ</h4>
                <p class="text-sm text-gray-600">ネットワーク（GitHub）上にあり、チームでの共有やバックアップを目的としたリポジトリです。</p>
            </div>
        </div>

        <div class="flex justify-center py-4">
            <img src="/images/Lesson14-3.png" alt="Lesson14-3" class="max-w-md w-full h-auto border rounded-lg shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">コミット</h3>
        <p class="text-gray-700">
            Gitでは、記録された1つ1つのバージョンのことを<strong>コミット</strong>と呼びます。
        </p>
        <div class="bg-gray-50 p-6 rounded-xl space-y-4">
            <p class="font-bold text-gray-800">コミットに含まれる重要な情報：</p>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">●</span> リビジョン番号（固有のID）</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">●</span> コミットした人（誰が）</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">●</span> コミットした日時（いつ）</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">●</span> ファイル内容の差分（何を）</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">●</span> コミットメッセージ（理由）</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">●</span> 親コミットのID（1つ前の状態）</li>
            </ul>
        </div>
        <p class="text-gray-700 leading-relaxed">
            各コミットが「親（1つ前）」の情報を繋いでいくことで、まるで川の流れのような一本道の履歴が作られます。
        </p>
        
        <div class="flex justify-center py-4">
            <img src="/images/Lesson14-5" alt="Lesson14-5" class="max-w-md w-full h-auto">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">ワークツリーとインデックス</h3>
        <p class="text-gray-700">
            ファイルを変更してからリポジトリに保存されるまでには、<strong>3つのエリア</strong>を通過します。
        </p>
        
        <div class="space-y-4">
            <div class="flex items-center gap-4 bg-white p-4 rounded-lg border">
                <span class="bg-gray-200 px-3 py-1 rounded font-bold text-sm">1. ワークツリー</span>
                <p class="text-sm text-gray-600">あなたが実際にコードを書いている作業フォルダです。</p>
            </div>
            <div class="flex items-center justify-center text-gray-400">▼ ステージ（add）する</div>
            <div class="flex items-center gap-4 bg-blue-50 p-4 rounded-lg border border-blue-200">
                <span class="bg-blue-500 text-white px-3 py-1 rounded font-bold text-sm">2. インデックス</span>
                <p class="text-sm text-blue-800">コミットする準備をするための「予約エリア」です。</p>
            </div>
            <div class="flex items-center justify-center text-gray-400">▼ コミット（commit）する</div>
            <div class="flex items-center gap-4 bg-green-50 p-4 rounded-lg border border-green-200">
                <span class="bg-green-600 text-white px-3 py-1 rounded font-bold text-sm">3. リポジトリ</span>
                <p class="text-sm text-green-800">変更履歴として正式に記録される場所です。</p>
            </div>
        </div>

        <div class="flex justify-center py-4">
            <img src="/images/Lesson14-5.png" alt="Lesson14-5" class="max-w-2xl w-full h-auto">
        </div>

        <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-200">
            <h4 class="font-bold text-yellow-800 mb-2">💡 なぜ「インデックス」が必要なの？</h4>
            <p class="text-sm text-yellow-900 leading-relaxed">
                例えば「バグ修正」と「新機能追加」の2つを同時に行った場合、一気に保存するのではなく、まずバグ修正だけを<strong>インデックスに選んで（ステージして）</strong>コミットし、次に新機能をコミットする、といった「意味のある単位」での管理を可能にするためです。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">ブランチ</h3>
        <p class="text-gray-700 leading-relaxed">
            <strong>ブランチ（branch）</strong>は「枝」という意味で、履歴を枝分かれさせる機能です。
            本流の歴史を壊さずに、自分だけの「支流」を作って開発を進め、完成したら本流に合流させる、といったチーム開発に必須の機能です。
        </p>
        
        <div class="flex justify-center py-4">
            <img src="/images/Lesson14-6.png" alt="Lesson14-6" class="max-w-md w-full h-auto">
        </div>

        <div class="overflow-x-auto shadow-sm border rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">種類</th>
                        <th class="px-4 py-2">デフォルト名</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr>
                        <td class="px-4 py-2 font-bold text-blue-600">ローカル (Git)</td>
                        <td class="px-4 py-2">master</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-bold text-purple-600">リモート (GitHub)</td>
                        <td class="px-4 py-2">main (2020年10月以降)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="bg-blue-600 text-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            ここまでのまとめ
        </h3>
        <ul class="space-y-3 opacity-90 text-sm leading-relaxed">
            <li>・<strong>リポジトリ</strong>：変更履歴を保存する「箱」。PC上のローカルと、GitHub上のリモートがある。</li>
            <li>・<strong>コミット</strong>：1つのバージョンのこと。履歴はこの積み重ねで作られる。</li>
            <li>・<strong>2段階の保存</strong>：変更は「ステージ（インデックスへ）」してから「コミット（リポジトリへ）」する。</li>
            <li>・<strong>ブランチ</strong>：履歴の枝分かれ。安全な並行開発を可能にする。</li>
        </ul>
    </section>
</div>
EOF
            ]
        );
    }
}