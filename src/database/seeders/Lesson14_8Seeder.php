<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14_8Seeder extends Seeder
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
                'sort_order' => 8,
            ],
            [
                'title' => 'GitHubへ反映する',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">GitHubへ反映する</h2>
        <p class="text-gray-700 leading-relaxed">
            GitHubへリポジトリを反映させるためには、下記の手順で実行しましょう。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GitHub 個人アクセストークンを作成する</h3>
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 space-y-4">
            <p class="text-gray-700 leading-relaxed">
                GitHubにアクセスするとき必要となる、<strong>個人アクセストークン</strong>を作成していきます。
                個人アクセストークンとは、「コマンドラインでのGit操作」や「Gitを使用するアプリケーション」を利用するときの<strong>パスワードの代わり</strong>になるものです。
            </p>
            <p class="text-sm text-red-600 font-bold">
                ※GitHubは、2021年8月13日以降、パスワード認証を廃止し、トークンベースの認証を必須としています。この操作を行わないとコマンドラインからのアクセスができません。
            </p>
            <p class="text-xs text-gray-600">
                ※セキュリティ上の理由から、1年間使用されていないトークンは自動削除されます。その場合は再作成が必要です。
            </p>
        </div>

        <h4 class="font-bold text-gray-800 mt-6">トークンの作成手順</h4>
        <div class="space-y-8">
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">1</span>
                <div>
                    <p class="text-gray-700">GitHubのWebページにアクセスし、右上にあるプロフィールの画像をクリックします。</p>
                    <img src="/images/Lesson14-27.png" alt="Lesson14-27" class="mt-2 border rounded shadow-sm max-w-md">
                </div>
            </div>
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">2</span>
                <div>
                    <p class="text-gray-700">メニューから<strong>Settings</strong>をクリックします。</p>
                    <img src="/images/Lesson14-28.png" alt="Lesson14-28" class="mt-2 border rounded shadow-sm max-w-md">
                </div>
            </div>
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">3</span>
                <div>
                    <p class="text-gray-700">左サイドバーから<strong>Developer settings</strong>をクリックします。</p>
                    <img src="/images/Lesson14-29.png" alt="Lesson14-29" class="mt-2 border rounded shadow-sm max-w-md">
                </div>
            </div>
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">4</span>
                <div>
                    <p class="text-gray-700">左サイドバーから<strong>Personal access tokens</strong> → <strong>Tokens (classic)</strong> をクリックします。</p>
                    <img src="/images/Lesson14-30.png" alt="Lesson14-30" class="mt-2 border rounded shadow-sm max-w-md">
                </div>
            </div>
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">5</span>
                <div>
                    <p class="text-gray-700"><strong>Generate new token</strong> → <strong>Generate new token (classic)</strong>をクリックします。</p>
                    <img src="/images/Lesson14-31.png" alt="Lesson14-31" class="mt-2 border rounded shadow-sm max-w-md">
                </div>
            </div>
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">6</span>
                <p class="text-gray-700">作成するトークンの名前を入力します。今回は <strong>myToken</strong> とします。</p>
            </div>
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">7</span>
                <p class="text-gray-700">有効期限を選択します。今回は、90日間である <strong>90 days</strong> を選択します。</p>
            </div>
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">8</span>
                <div>
                    <p class="text-gray-700">付与するスコープを選択します。今回は <strong>repo</strong> と <strong>gist</strong> を選択します。repo権限はコマンドラインからのアクセスに必須です。選択後、<strong>Generate token</strong> をクリックします。</p>
                    <img src="/images/Lesson14-32.png" alt="Lesson14-32" class="mt-2 border rounded shadow-sm max-w-md">
                </div>
            </div>
            <div class="flex items-start gap-4">
                <span class="bg-gray-800 text-white w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs">9</span>
                <div>
                    <p class="text-gray-700 font-bold text-red-600">作成されたトークンをクリップボードにコピーして控えておきます。</p>
                    <img src="/images/Lesson14-33.png" alt="Lesson14-33" class="mt-2 border rounded shadow-sm max-w-md">
                    <p class="text-xs text-gray-500 mt-2">※セキュリティ上の理由で、この画面を離れると二度と表示されません。必ずメモ帳などに保存してください。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GitHubへリポジトリを反映するための一連の流れ</h3>
        <p class="text-gray-700">下記の手順で実行しましょう。</p>
        <ol class="list-decimal list-inside space-y-2 text-gray-700 font-medium">
            <li>GitHubにリモートリポジトリを作成する</li>
            <li>ローカルリポジトリにリモートリポジトリを登録する</li>
            <li>ローカルリポジトリのブランチ名を変更する</li>
            <li>登録したリモートリポジトリへプッシュする</li>
            <li>GitHubのリモートリポジトリにプッシュされたか確認する</li>
        </ol>

        <div class="space-y-6 mt-8">
            <h4 class="font-bold text-gray-800 border-l-4 border-blue-400 pl-3">1. GitHubにリモートリポジトリを作成する</h4>
            <p class="text-gray-700">
                <strong>first-git</strong> という名前で作成します。GitHubへログインし、＋ボタンから「New repository」をクリックします。
            </p>
            <img src="/images/Lesson14-34.png" alt="Lesson14-34" class="max-w-md border">
            <p class="text-gray-700">Repository nameに <strong>first-git</strong> と入力し、<strong>Create repository</strong> をクリックします。</p>
            <img src="/images/Lesson14-35.png" alt="Lesson14-35" class="max-w-md border">
            <p class="text-gray-700 text-sm">作成直後の画面（空の状態）：</p>
            <img src="/images/Lesson14-36.png" alt="Lesson14-36" class="max-w-md border">
        </div>

        <div class="space-y-6">
            <h4 class="font-bold text-gray-800 border-l-4 border-blue-400 pl-3">2. ローカルリポジトリにリモートリポジトリを登録する</h4>
            <div class="bg-gray-800 p-4 rounded-lg text-white font-mono text-sm">
                git remote add origin https://github.com/ユーザ名/first-git.git
            </div>
            <p class="text-gray-700 text-sm">
                このコマンドは、origin という名前でリモートURLを登録します。「ユーザ名」は自身のものに置き換えてください。
            </p>
            <img src="/images/Lesson14-37.png" alt="Lesson14-37" class="max-w-md border">

            <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                <p class="text-red-700 font-bold text-sm">【エラー対応】fatal: not a git repository と出た場合</p>
                <p class="text-xs text-red-600 mt-1">
                    現在のフォルダがGit管理下になっていません。以下のコマンドを実行してください。
                </p>
                <div class="bg-white p-2 mt-2 rounded border font-mono text-xs text-gray-800">
                    git init
                </div>
            </div>
            
            <p class="text-gray-700 text-sm italic">
                ※登録状況の確認は <code>git remote -v</code> で行えます。
            </p>
        </div>

        <div class="space-y-6">
            <h4 class="font-bold text-gray-800 border-l-4 border-blue-400 pl-3">3. ローカルリポジトリのブランチ名を変更</h4>
            <div class="bg-gray-800 p-4 rounded-lg text-white font-mono text-sm">
                git branch -M main
            </div>
        </div>

        <div class="space-y-6">
            <h4 class="font-bold text-gray-800 border-l-4 border-blue-400 pl-3">4. 登録したリモートリポジトリへプッシュする</h4>
            <div class="bg-gray-800 p-4 rounded-lg text-white font-mono text-sm">
                git push origin main
            </div>

            <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                <p class="text-red-700 font-bold text-sm">【エラー対応】error: src refspec main does not match any と出た場合</p>
                <p class="text-xs text-red-600 mt-1">
                    コミットが一度も行われていない可能性があります。以下を実行してから再度プッシュしてください。
                </p>
                <div class="bg-white p-2 mt-2 rounded border font-mono text-xs text-gray-800">
                    git add -A<br>
                    git commit -m "first commit"
                </div>
            </div>

            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                <p class="text-yellow-800 font-bold text-sm">認証の入力に注意！</p>
                <p class="text-xs text-yellow-700 mt-1">
                    <code>Username for 'https://github.com':</code> → GitHubのユーザ名を入力<br>
                    <code>Password for 'https://ユーザ名@github.com':</code> → <strong>作成した個人アクセストークン</strong>を貼り付け
                </p>
                <p class="text-xs text-red-600 mt-2">
                    ※貼り付けた際、画面には何も表示されませんが、入力はできています。
                </p>
            </div>
            <img src="/images/Lesson14-38.png" alt="Lesson14-38" class="max-w-md border">
        </div>

        <div class="space-y-6">
            <h4 class="font-bold text-gray-800 border-l-4 border-blue-400 pl-3">5. GitHubのリモートリポジトリにプッシュされたか確認する</h4>
            <p class="text-gray-700 text-sm">ブラウザで <code>https://github.com/ユーザ名/first-git</code> を開きます。</p>
            <img src="/images/Lesson14-39.png" alt="Lesson14-39" class="max-w-md border shadow-sm">
            <p class="text-gray-700 text-sm mt-4">「1 Commits」から履歴を確認できます。</p>
            <img src="/images/Lesson14-40.png" alt="Lesson14-40" class="max-w-md border shadow-sm">
            <p class="text-gray-700 text-sm mt-4">コミット名をクリックすると詳細（差分）が表示されます。</p>
            <img src="/images/Lesson14-41.png" alt="Lesson14-41" class="max-w-md border shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">ここまでのまとめ</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left font-bold">コマンド</th>
                        <th class="px-4 py-2 text-left font-bold">実行結果</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 font-mono text-blue-600">git remote add origin URL</td>
                        <td class="px-4 py-2">ローカルリポジトリにリモートリポジトリを登録する</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-blue-600">git remote -v</td>
                        <td class="px-4 py-2">登録されたリモートリポジトリの一覧を表示する</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-blue-600">git branch -M main</td>
                        <td class="px-4 py-2">ブランチ名を main に変更する</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-blue-600">git push origin main</td>
                        <td class="px-4 py-2">登録したリモートリポジトリへプッシュする</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl space-y-4 text-gray-700 text-sm leading-relaxed">
            <p><strong>originとは</strong><br>
            リモートリポジトリに付ける慣習的な名前です。GitHubのURLの別名（エイリアス）のようなものだと考えてください。</p>
            
            <p><strong>その他のコマンド</strong><br>
            ・<strong>git pull</strong>：リモートの更新分をローカルに取り込むコマンド（チーム開発で多用します）。<br>
            ・<strong>git fetch</strong>：リモートの更新分を「取得」のみ行い、合流（マージ）はしないコマンドです。</p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}