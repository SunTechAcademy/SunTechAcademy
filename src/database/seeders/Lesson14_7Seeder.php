<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14_7Seeder extends Seeder
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
                'sort_order' => 7,
            ],
            [
                'title' => 'GitHubのアカウント登録',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">GitHubのアカウント登録</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                <strong>GitHub（ギットハブ）</strong>とは、ソフトウェア開発プロジェクトのためのソースコード管理システムです。
                ソースコードを管理するだけでなく、世界中で公開されているソースコードを閲覧・研究することもできます。
            </p>
            <p>
                このカリキュラムでも、GitHubを利用してバージョン管理を行っていきます。
                <span class="text-sm text-gray-500">※すでにGitHubアカウントを持っている場合は、新しく作成する必要はありません。</span>
            </p>
        </div>

        <div class="mt-8 space-y-10">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                <div class="flex-1 space-y-4">
                    <p class="font-bold text-gray-800">GitHubのトップページにアクセスしてアカウント登録を開始します。</p>
                    <a href="https://github.com/?locale=ja" target="_blank" class="inline-block px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700 transition-colors">
                        GitHub公式サイトへ
                    </a>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <img src="/images/Lesson14-8.png" alt="Lesson14-8" class="border rounded shadow-sm">
                        <img src="/images/Lesson14-9.png" alt="Lesson14-9" class="border rounded shadow-sm">
                    </div>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                <div class="flex-1 space-y-4">
                    <p class="font-bold text-gray-800">「検証する」ボタンをクリックし、パズル（ロボットでないことの確認）を実施します。</p>
                    <img src="/images/Lesson14-10.gif" alt="Lesson14-10" class="max-w-xs border rounded shadow-sm">
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                <div class="flex-1 space-y-4">
                    <p class="font-bold text-gray-800">アンケート画面が表示されます。</p>
                    <p class="text-sm text-gray-600">回答は任意です。未回答のままでも構いません。ページ最下部にある「Complete setup」をクリックしてください。</p>
                    <img src="/images/Lesson14-11.png" alt="Lesson14-11" class="max-w-md border rounded shadow-sm">
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">4</div>
                <div class="flex-1 space-y-4">
                    <p class="font-bold text-gray-800">メールアドレスの認証を行います。</p>
                    <p class="text-sm text-gray-600">登録したアドレスに届く認証メール内のボタンをクリックしてください。これでアカウント登録は完了です。</p>
                    <img src="/images/Lesson14-12.png" alt="Lesson14-12" class="max-w-md border rounded shadow-sm">
                </div>
            </div>
        </div>

        <div class="mt-8 bg-blue-50 p-4 rounded-lg border border-blue-100 text-sm text-blue-800">
            <strong>💡 プランについて：</strong> アカウント登録時は自動的に「Freeプラン」が適用されます。個人の学習用途であれば、無料版で十分な機能を利用できます。
        </div>
    </section>

    <hr class="border-gray-200">

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GitHubアカウントの2要素認証(2FA)を有効化する</h3>
        <div class="bg-red-50 p-6 rounded-xl border border-red-100 space-y-4">
            <h4 class="font-bold text-red-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                2要素認証設定は「義務化」されています
            </h4>
            <p class="text-sm text-red-700 leading-relaxed">
                GitHubでは、全ユーザに対して2要素認証の設定を義務付けています。設定を行わないとGitHubへのアクセスが制限される場合があります。
                セキュリティ（アカウント乗っ取り防止）のため、必ず以下の手順で設定を行いましょう。
            </p>
        </div>

        <div class="space-y-8 mt-6">
            <div class="space-y-4">
                <p class="text-gray-700 font-bold">1. 右上のプロフィールアイコンから「Settings」を選択します。</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <img src="/images/Lesson14-13.png" alt="Lesson14-13" class="border rounded">
                    <img src="/images/Lesson14-14.png" alt="Lesson14-14" class="border rounded">
                </div>
            </div>

            <div class="space-y-4">
                <p class="text-gray-700 font-bold">2. 左サイドバーの「Password and authentication」から設定を開始します。</p>
                <img src="/images/Lesson14-15.png" alt="Lesson14-15" class="max-w-md border rounded">
                <p class="text-sm text-gray-600">「Enable two-factor authentication」ボタンをクリックしてください。</p>
                <img src="/images/Lesson14-16.png" alt="Lesson14-16" class="max-w-md border rounded">
            </div>

            <div class="space-y-4">
                <p class="text-gray-700 font-bold">3. 認証アプリ（Google Authenticator等）でQRコードを読み取ります。</p>
                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <img src="/images/Lesson14-18.png" alt="Lesson14-18" class="w-48 border rounded shadow-sm">
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 italic">※スマートフォンのアプリでブラウザ上のQRコードをスキャンします。</p>
                        <img src="/images/Lesson14-19.png" alt="Lesson14-19" class="max-w-xs border rounded shadow-sm">
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <p class="text-gray-700 font-bold">4. アプリに表示された6桁のコードを入力します。</p>
                <p class="text-sm text-gray-600">
                    Google Authenticatorアプリに表示される数字は時間経過で変わります。赤くなる前にブラウザへ入力してください。
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <img src="/images/Lesson14-20.png" alt="Lesson14-20" class="max-w-xs border rounded">
                    <img src="/images/Lesson14-21.png" alt="Lesson14-21" class="max-w-xs border rounded">
                </div>
            </div>

            <div class="bg-yellow-50 p-6 rounded-xl border-2 border-yellow-200 space-y-4">
                <h4 class="font-bold text-yellow-800 flex items-center gap-2 underline decoration-red-500">
                    ⚠️ 超重要：復旧コード（Recovery codes）の保管
                </h4>
                <p class="text-sm text-yellow-900 leading-relaxed">
                    認証に成功すると、<strong>16個の復旧コード</strong>が表示されます。
                    これはスマートフォンを紛失した際などにアカウントを取り戻す唯一の手段です。
                    <strong>必ず「Download」して、大切に保管してください。</strong>
                </p>
                <img src="/images/Lesson14-22.png" alt="Lesson14-22" class="max-w-md border rounded">
                <p class="text-sm text-yellow-900">
                    ダウンロードしたら「I have saved my recovery codes」をクリックし、最後に「Done」を押して完了です。
                </p>
                <img src="/images/Lesson14-23.png" alt="Lesson14-23" class="max-w-sm border rounded">
            </div>
        </div>

        <div class="mt-10 p-6 bg-gray-50 rounded-xl border border-gray-200">
            <h4 class="font-bold text-gray-800 mb-4">有効化の確認</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <img src="/images/Lesson14-24.png" alt="Lesson14-24" class="border rounded shadow-sm">
                <img src="/images/Lesson14-25.png" alt="Lesson14-25" class="border rounded shadow-sm">
            </div>
            <p class="mt-4 text-sm text-gray-600">
                次回以降のログイン時には、パスワード入力後にスマートフォンアプリのコード入力を求められるようになります。
            </p>
            <img src="/images/Lesson14-26.png" alt="Lesson14-26" class="max-w-xs mt-4 border rounded shadow-sm">
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}