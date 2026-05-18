<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14_4Seeder extends Seeder
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
                'sort_order' => 4,
            ],
            [
                'title' => 'GitHubとは',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">GitHubとは</h2>
        <p class="text-gray-700 leading-relaxed">
            <strong>GitHub（ギットハブ）</strong>とは、Gitを使ってバージョン管理しているプロジェクトをオンライン上で共有・管理できるWebサービスです。
        </p>
        <div class="mt-6 flex flex-col items-center">
            <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-sm w-full max-w-3xl flex justify-center">
                <img src="/images/Lesson14-2.png" alt="Lesson14-2" class="h-auto border rounded shadow-sm">
            </div>
            <p class="text-xs text-gray-500 mt-2 italic">GitHubのリモートリポジトリ画面（イメージ）</p>
        </div>
        <p class="text-gray-700 leading-relaxed mt-6">
            Gitは通常、自分のPC内などの「ローカル環境」で履歴を管理します。しかし、バックアップを取りたい場合や、チーム全員の変更履歴を1箇所に集約したい場合にGitHubがその基点（リモートリポジトリ）として活躍します。
        </p>
        <a href="https://github.com/?locale=ja" target="_blank" class="text-blue-500 hover:underline text-sm font-bold">GitHub公式ページ</a>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GitHubではオープンソースプロジェクトの開発が活発</h3>
        <p class="text-gray-700 leading-relaxed">
            GitHubでは、世界中のエンジニアが協力してソフトウェアを作る「オープンソースプロジェクト」が日々開発されています。
        </p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-gray-50 p-3 rounded border text-center text-xs font-mono"><a href="https://github.com/twbs/bootstrap" target="_blank" class="text-blue-600">Bootstrap</a></div>
            <div class="bg-gray-50 p-3 rounded border text-center text-xs font-mono"><a href="https://github.com/angular/angular.js" target="_blank" class="text-blue-600">Angular.js</a></div>
            <div class="bg-gray-50 p-3 rounded border text-center text-xs font-mono"><a href="https://github.com/nodejs/node" target="_blank" class="text-blue-600">Node.js</a></div>
            <div class="bg-gray-50 p-3 rounded border text-center text-xs font-mono"><a href="https://github.com/jquery/jquery" target="_blank" class="text-blue-600">jQuery</a></div>
            <div class="bg-gray-50 p-3 rounded border text-center text-xs font-mono"><a href="https://github.com/rails/rails" target="_blank" class="text-blue-600">Ruby on Rails</a></div>
            <div class="bg-gray-50 p-3 rounded border text-center text-xs font-mono"><a href="https://github.com/torvalds/linux" target="_blank" class="text-blue-600">Linux</a></div>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">有名企業もGitHubを利用している</h3>
        <p class="text-gray-700">世界を代表するIT企業や公的機関も、GitHubを使ってプロダクトを開発しています。</p>
        <div class="flex flex-wrap gap-3">
            <span class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-bold shadow-sm">Google</span>
            <span class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-bold shadow-sm">IBM</span>
            <span class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-bold shadow-sm">NASA</span>
            <span class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-bold shadow-sm">PayPal</span>
            <span class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-bold shadow-sm">SAP</span>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">プラン・料金</h3>
        <div class="bg-blue-50 p-6 rounded-xl text-sm text-blue-900 leading-relaxed border border-blue-100">
            <p>公開プロジェクト（パブリック）と非公開プロジェクト（プライベート）のどちらも無制限に作成可能です。実績として広く見せたい場合は公開を、部外秘にしたい場合は非公開を選択します。本カリキュラムでは<strong>公開プロジェクト</strong>で学習を進めます。</p>
        </div>

        <div class="overflow-x-auto shadow-sm border rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">プラン</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">料金</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">内容</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    <tr>
                        <td class="px-6 py-4 font-bold">Free (個人)</td>
                        <td class="px-6 py-4">無料</td>
                        <td class="px-6 py-4">GitHubのコア機能を無制限に利用可能。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-bold">Team (組織)</td>
                        <td class="px-6 py-4">$4/月</td>
                        <td class="px-6 py-4">必須レビューワー設定など、高度な連携機能が追加。</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-bold">Enterprise</td>
                        <td class="px-6 py-4">$21/月</td>
                        <td class="px-6 py-4">SAMLによるSSOなど企業向けのセキュリティ機能。</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-xs text-gray-500 italic">※最新の詳細は Pricing（https://github.co.jp/pricing）をご確認ください。</p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">その他GitHubのようなWebサービス</h3>
        <p class="text-gray-700 leading-relaxed">
            GitHubの他にも <strong>Bitbucket</strong> などの類似サービスがあります。
            自分の書いたソースコードを公開状態にすることは、他人からアドバイスをもらえたり、スキルを証明するポートフォリオになったりと、エンジニアにとって多くのメリットがあります。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}