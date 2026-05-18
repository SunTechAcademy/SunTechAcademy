<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14_6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 14 (Git/GitHub) を取得
        $lesson14 = Lesson::where('title', 'Git/GitHub')->first();

        if (!$lesson14) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson14->id,
                'sort_order' => 6,
            ],
            [
                'title' => 'はじめてのバージョン管理',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">はじめてのバージョン管理</h2>
        <p class="text-gray-700 leading-relaxed">
            Gitの基本概念がわかったところで、チュートリアルを通して理解を深めていきましょう。
            ここからGitによるバージョン管理のチュートリアルが始まります。
        </p>
        <p class="text-gray-700 leading-relaxed mt-4">
            皆さん実際に手を動かして、一連の流れを掴んでください。
            ここでは、ローカルリポジトリにいくつかのファイルを追加・変更し、コミット（履歴の保存）をする手順を学びます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Gitの図の矢印について</h3>
        <p class="text-gray-700 leading-relaxed">
            これからGitを使ってバージョン管理しながら、コミット履歴を図示していきます。
            そこで注意して欲しいのは、<strong>コミット履歴の矢印の向き</strong>についてです。
        </p>
        <p class="text-gray-700 leading-relaxed">
            個々のコミットは自分のリビジョン番号（ID）を持ち、さらに<strong>親コミット（1つ前のコミット）</strong>のリビジョン番号も持っています。
            古い履歴を辿っていけるのは、この「親を指し示す」情報があるおかげです。
        </p>

        <div class="flex justify-center py-6">
            <div class="max-w-md w-full bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <img src="/images/Lesson14-7.png" alt="Lesson14-7" class="w-full h-auto">
                <p class="text-center text-xs text-gray-500 mt-2 italic">コミット履歴の図解サンプル</p>
            </div>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h4 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                図の見方のポイント
            </h4>
            <ul class="space-y-2 text-sm text-blue-800">
                <li>・丸印が1つの<strong>コミット（バージョン）</strong>を表します。</li>
                <li>・矢印は常に<strong>「親（過去）のコミット」</strong>を指しています。</li>
                <li>・時系列は<strong>上側に行くほど新しい</strong>ものです。矢印の向き（過去向き）と時系列が逆になることを覚えておきましょう。</li>
            </ul>
        </div>
        <p class="text-gray-700 text-sm italic">
            ※新規コミットが実行されると、新しく「コミットD」が追加され、Dから親であるCを指す矢印が自動的に追加されます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">この実習で使う主要コマンド</h3>
        <div class="overflow-x-auto shadow-sm border rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">コマンド</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">実行結果・役割</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    <tr>
                        <td class="px-6 py-4 font-mono text-blue-600 font-bold whitespace-nowrap">git init</td>
                        <td class="px-6 py-4 text-gray-700 font-medium">現在のフォルダ内にリポジトリを作成し、ワークツリーとインデックスを用意する。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono text-blue-600 font-bold whitespace-nowrap">git add ファイル名</td>
                        <td class="px-6 py-4 text-gray-700 font-medium">新規追加や変更されたファイルを選択し、ステージ（予約）させる。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono text-blue-600 font-bold whitespace-nowrap">git commit -m "◯◯"</td>
                        <td class="px-6 py-4 text-gray-700 font-medium">ステージされた変更をリポジトリへ正式に記録する。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono text-blue-600 font-bold whitespace-nowrap">git status</td>
                        <td class="px-6 py-4 text-gray-700 font-medium">ワークツリーとインデックスの状況（変更漏れがないか等）を確認する。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono text-blue-600 font-bold whitespace-nowrap">git diff</td>
                        <td class="px-6 py-4 text-gray-700 font-medium">ワークツリーとインデックスを比較して、具体的な変更箇所の差分を表示する。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-mono text-blue-600 font-bold whitespace-nowrap">git log</td>
                        <td class="px-6 py-4 text-gray-700 font-medium">過去のコミット履歴（誰がいつ何をしたかの一覧）を確認する。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}