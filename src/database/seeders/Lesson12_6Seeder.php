<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 12 (MySQL) を取得
        $lesson12 = Lesson::where('title', 'MySQL')->first();

        if (!$lesson12) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson12->id,
                'sort_order' => 6,
            ],
            [
                'title' => 'データベースサーバ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">データベースサーバ</h2>
        <p class="text-gray-700 leading-relaxed">
            データベースもWebサーバと同じくサーバとして起動するものです。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベースサーバとは</h3>
        <p class="text-gray-700 leading-relaxed">
            データベースサーバは起動すると、<strong>接続待ち状態</strong>になります。データベースクライアントからリクエストを送り、「IDとパスワードを送信してログイン」に成功すると、データベースと接続でき、データベースに対してSQLを実行できるようになります。
        </p>

        <div class="my-8 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm flex justify-center p-4">
            <img src="/images/Lesson12-5.png" alt="データベースクライアントとサーバの接続イメージ" class="max-w-full h-auto">
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベースサーバの起動と停止</h3>
        <p class="text-gray-700 leading-relaxed">
            ここから実際にデータベースを構築します。
        </p>

        <div class="space-y-6">
            <h4 class="font-bold text-lg text-blue-700 flex items-center gap-2">
                <span class="flex items-center justify-center w-8 h-8 bg-blue-700 text-white rounded-full text-sm">1</span>
                起動手順
            </h4>
            <div class="ml-10 space-y-4">
                <p class="text-gray-700">
                    <a href="/courses/lessons/11" class="text-blue-600 hover:underline font-bold">Lesson 11：Webサーバ（XAMPP）の導入とブラウザでの確認</a> で導入した<strong>XAMPP</strong>を起動してください。
                </p>
                <p class="text-gray-700">
                    コントロールパネルの <strong>MySQL Database</strong>（または MySQL）の項目を見つけ、<strong>「Start」</strong>ボタンを押下してください。
                </p>
                <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
                    <p class="text-green-800 text-sm">
                        背景が緑色に変わり、PID(s)やPortが表示されれば、MySQLサーバが正常に起動しています。
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <h4 class="font-bold text-lg text-blue-700 flex items-center gap-2">
                <span class="flex items-center justify-center w-8 h-8 bg-blue-700 text-white rounded-full text-sm">2</span>
                起動状態確認
            </h4>
            <div class="ml-10 space-y-6">
                <div class="space-y-3">
                    <p class="text-gray-700 font-bold">① 管理画面へアクセス</p>
                    <p class="text-gray-600">
                        ブラウザで <a href="http://localhost/dashboard/" target="_blank" class="text-blue-600 hover:underline">http://localhost/dashboard/</a> に接続してください。
                    </p>
                </div>

                <div class="space-y-3">
                    <p class="text-gray-700 font-bold">② phpMyAdminを起動</p>
                    <p class="text-gray-600">
                        画面上部のメニュー、またはリンクから <strong>「phpMyAdmin」</strong> を押下してください。
                    </p>
                </div>

                <div class="my-6 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm flex justify-center p-4">
                    <img src="/images/Lesson12-6.png" alt="XAMPP DashboardのphpMyAdminリンク" class="max-w-full h-auto">
                </div>

                <div class="space-y-3">
                    <p class="text-gray-700 font-bold">③ 接続確認</p>
                    <p class="text-gray-600">
                        下記のような phpMyAdmin画面（<a href="http://localhost/phpmyadmin/" target="_blank" class="text-blue-600 hover:underline">http://localhost/phpmyadmin/</a>）が表示されたら、データベースへの接続は成功です。
                    </p>
                </div>

                <div class="my-6 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm flex justify-center p-4">
                    <img src="/images/Lesson12-7.png" alt="phpMyAdminの操作画面" class="max-w-full h-auto">
                </div>
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}