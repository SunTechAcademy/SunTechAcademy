<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得
        $lesson = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：応用')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 4,
            ],
            [
                'title' => 'データベースと接続',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">データベースと接続</h2>
        <div class="prose max-w-none text-sm leading-relaxed">
            <p>データベースとの接続設定を行います。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">.envの修正</h3>
        <p class="text-sm leading-relaxed">
            <code>.env</code> を修正して、データベース設定に関する環境変数を変更します。
        </p>

        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic">.env</p>
            <div class="bg-gray-800 text-white p-6 rounded-lg font-mono text-sm leading-relaxed shadow-lg">
                <span class="text-gray-400"># 既存の項目を以下のように書き換えます</span><br>
                DB_DATABASE=microposts<br>
                DB_USERNAME=dbuser<br>
                DB_PASSWORD=dbpass
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベースの作成</h3>
        <p class="text-sm leading-relaxed">
            <code>DB_DATABASE=microposts</code> と環境変数を設定したため、microposts データベースを作成します。
        </p>

        <div class="space-y-4">
            <p class="text-sm font-bold text-gray-600">MySQLにログイン</p>
            <div class="bg-gray-900 text-white p-4 rounded font-mono text-sm">
                /Applications/XAMPP/xamppfiles/bin/mysql -u root -p
            </div>
        </div>

        <div class="space-y-4">
            <p class="text-sm font-bold text-gray-600">データベースの作成</p>
            <div class="bg-gray-900 text-green-400 p-4 rounded font-mono text-sm">
                DB > CREATE DATABASE microposts;
            </div>
        </div>

        <div class="space-y-4">
            <p class="text-sm font-bold text-gray-600">exitでMySQLからログアウト</p>
            <p class="text-xs font-bold text-gray-500 italic">MySQLからログアウト</p>
            <div class="bg-gray-900 text-white p-4 rounded font-mono text-sm">
                DB > exit
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">tinkerで接続確認</h3>
        <p class="text-sm leading-relaxed">
            tinkerを起動します。
        </p>

        <div class="space-y-4">
            <p class="text-xs font-bold text-gray-500 italic">tinkerの起動</p>
            <div class="bg-gray-800 text-white p-4 rounded font-mono text-sm">
                $ php artisan tinker
            </div>
            <p class="text-sm">
                <code>></code> が表示されましたら、データベースの接続を確認します。 <code>DB::reconnect()</code> でエラーが出なければ問題なく接続できています。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">データベースの接続確認</p>
            <div class="bg-gray-800 text-green-400 p-4 rounded font-mono text-sm">
                > DB::reconnect();
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">タイムゾーンと言語設定</h3>
        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">タイムゾーンの設定</h4>
            <p class="text-sm leading-relaxed">
                タイムゾーンの設定をしておけば、 Modelからレコードを保存したときなどにおいて、設定したタイムゾーンの時間情報が日時型のカラム（created_at 等）に保存されます。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">config/app.php timezone抜粋</p>
            <div class="bg-gray-100 p-6 rounded-lg font-mono text-sm border">
                'timezone' => 'Asia/Tokyo',
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GitHub</h3>
        <div class="space-y-4">
            <p class="text-xs font-bold text-gray-500 italic">gitコマンド</p>
            <div class="bg-gray-800 text-white p-6 rounded-lg font-mono text-sm shadow-lg leading-relaxed">
                git add -A<br>
                git commit -m "set timezone"<br>
                git push origin main
            </div>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}