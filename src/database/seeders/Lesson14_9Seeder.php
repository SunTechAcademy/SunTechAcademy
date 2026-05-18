<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14_9Seeder extends Seeder
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
                'sort_order' => 9,
            ],
            [
                'title' => 'まとめ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">まとめ</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                このレッスンでは、バージョン管理の必要性、Gitの概念、GitHubとは何か、Gitコマンドのチュートリアルを学んできました。ここで学んだものはもっとも基礎的な部分です。これからは開発するときには、機能ごとにコミットしてバージョン管理をするようにしましょう。後のレッスンでHerokuを使う際にもGitが必要です。
            </p>
            <p>
                ここでは、Gitの概念の基本である、リポジトリ（ローカル／リモート）、コミット、ワークツリー、インデックスを理解し、ワークツリー => インデックス => ローカルリポジトリ のGitコマンド（add, commit）を覚えておけば良いでしょう。
            </p>
            <p>
                その流れの確認のためのコマンドである（status, diff, log）も覚えておくと完璧です。
            </p>
        </div>
    </section>

    <section class="bg-blue-50 p-6 rounded-xl border border-blue-100">
        <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            覚えるべき基本フローとコマンド
        </h3>
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-center">
            <div class="flex-1 p-3 bg-white rounded border border-blue-200">
                <span class="block text-xs text-gray-500 mb-1">作業場</span>
                <span class="font-bold">ワークツリー</span>
            </div>
            <div class="text-blue-500 font-bold">git add ➔</div>
            <div class="flex-1 p-3 bg-white rounded border border-blue-200">
                <span class="block text-xs text-gray-500 mb-1">準備・予約</span>
                <span class="font-bold">インデックス</span>
            </div>
            <div class="text-blue-500 font-bold">git commit ➔</div>
            <div class="flex-1 p-3 bg-white rounded border border-blue-200">
                <span class="block text-xs text-gray-500 mb-1">保存先</span>
                <span class="font-bold">ローカルリポジトリ</span>
            </div>
        </div>
        
        <div class="mt-6 grid grid-cols-3 gap-4">
            <div class="text-center p-2 bg-blue-100 rounded text-xs font-bold text-blue-800 underline decoration-blue-300">git status<br><span class="font-normal">状況確認</span></div>
            <div class="text-center p-2 bg-blue-100 rounded text-xs font-bold text-blue-800 underline decoration-blue-300">git diff<br><span class="font-normal">差分確認</span></div>
            <div class="text-center p-2 bg-blue-100 rounded text-xs font-bold text-blue-800 underline decoration-blue-300">git log<br><span class="font-normal">履歴確認</span></div>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Gitコマンド一覧と基本的な使い方まとめ</h3>
        <p class="text-gray-700 leading-relaxed">
            という記事は弊社で書いているブログです。詳しく知りたい方は確認してみましょう。
        </p>
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 hover:bg-white transition-colors">
            <div class="flex items-center gap-4">
                <div class="bg-green-500 text-white p-2 rounded font-bold text-sm italic">Qiita</div>
                <div class="flex-1">
                    <a href="https://qiita.com/SunSunTech/items/d4a7cb524ea55ae50986" target="_blank" class="text-blue-600 font-bold hover:underline block mb-1">
                        Gitコマンド一覧と基本的な使い方まとめ - Qiita
                    </a>
                    <p class="text-xs text-gray-500 italic">https://qiita.com/SunSunTech/items/d4a7cb524ea55ae50986</p>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}