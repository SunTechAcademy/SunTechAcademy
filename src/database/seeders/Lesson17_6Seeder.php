<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得
        $lesson = Lesson::where('title', 'アプリケーションのデプロイ')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 6,
            ],
            [
                'title' => 'VScodeからSupabaseに対するマイグレーションの実行',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">VScodeからSupabaseに対するマイグレーションの実行</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                作成したSupabase上のデータベースに対して、以下の手順でマイグレーションを実行します。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <p class="text-sm">
            （1）VScodeを開き、デプロイしたいLaravelアプリケーションの <strong>.env</strong> の以下項目を書き換えます。
        </p>

        <div class="p-6 bg-gray-50 border border-gray-200 rounded-lg">
            <p class="text-sm mb-4">
                Supabaseのダッシュボードの上にある <strong>Connect</strong> を押下し、ここで設定内容を確認できます。<br>
                <strong>Direct</strong> → Connection Methodの <strong>Transaction pooler</strong> を押下してください。
            </p>
            <img src="/images/Lesson17-16.png" alt="Supabase Connect settings" class="max-w-full h-auto border rounded shadow-sm">
        </div>

        <div class="space-y-2 mt-4">
            <p class="text-xs font-bold text-gray-500 italic">.env の設定項目</p>
            <div class="bg-gray-800 text-green-400 p-5 rounded font-mono text-xs shadow-inner leading-relaxed">
                DB_CONNECTION=pgsql<br>
                DB_HOST=aws-xxxxxx.supabase.com <span class="text-gray-400">（Directの下部に記載されています「Host」）</span><br>
                DB_PORT=6543 <span class="text-gray-400">（Directの下部に記載されています「Port」）</span><br>
                DB_DATABASE=postgres <span class="text-gray-400">（Directの下部に記載されています「Database name」）</span><br>
                DB_USERNAME=postgres.xxxxxxxxxx <span class="text-gray-400">（Directの下部に記載されています「User」）</span><br>
                DB_PASSWORD="xxxxxxxxxx" <span class="text-gray-400">（Chapter 5の（4）で設定したパスワード）</span>
            </div>
            <p class="text-xs text-red-600 font-bold mt-2">※ここではパスワードをダブルクウォート（"）で囲みましょう。</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <img src="/images/Lesson17-17.jpeg" alt="Environment variables screenshot 1" class="border rounded shadow-sm">
            <img src="/images/Lesson17-18.jpeg" alt="Environment variables screenshot 2" class="border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <p class="text-sm">
            （2）VScodeのターミナルで、デプロイしたいLaravelアプリケーションの直下へ移動し、マイグレーションを実行します。
        </p>

        <p class="text-xs font-bold text-gray-500 italic">マイグレーションの実行</p>
        <div class="bg-black text-white p-4 rounded font-mono text-sm shadow-lg">
            php artisan migrate
        </div>

        <div class="bg-blue-50 p-5 rounded border border-blue-100 text-sm">
            <p>
                .env の設定を書き換えているので、Supabase上のデータベースにマイグレーションが反映されます。<br>
                以上で、Supabaseのデータベースに対するマイグレーションの作業は完了です。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">確認してみましょう</h3>
        <p class="text-sm">
            Supabaseの左メニュー → <strong>Database</strong> → <strong>Tables</strong> → ローカルで作成したテーブルが作成されていれば成功しています。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <img src="/images/Lesson17-19.png" alt="Supabase table check 1" class="border rounded shadow-sm">
            <img src="/images/Lesson17-20.png" alt="Supabase table check 2" class="border rounded shadow-sm">
            <img src="/images/Lesson17-21.png" alt="Supabase table check 3" class="border rounded shadow-sm">
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}