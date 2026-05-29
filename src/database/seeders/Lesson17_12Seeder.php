<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_12Seeder extends Seeder
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
                'sort_order' => 12,
            ],
            [
                'title' => '（参考資料）不要なアプリケーションやデータベースは削除する',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">（参考資料）不要なアプリケーションやデータベースは削除する</h2>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-6">
            <p>
                Fly.ioとSupabaseは、ともに無料の利用には制限があります。別のアプリケーションをデプロイしたい、もうこのアプリケーションは公開させたくない、などの場合は、Fly.io上のアプリケーションならびにSupabase上のデータベースを削除してください。
            </p>
            <p>
                削除は以下のようにページをたどることで行なえます。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Fly.io上のアプリケーションの削除</h3>
        <div class="p-6 bg-gray-50 border border-gray-200 rounded-lg">
            <p class="text-sm leading-relaxed">
                ダッシュボード（<a href="https://fly.io/dashboard" target="_blank" class="text-blue-600 underline font-mono italic">https://fly.io/dashboard</a>）のページへアクセス<br>
                ↓<br>
                <strong>「Apps」</strong><br>
                ↓<br>
                <strong>「登録済みのアプリケーション名」</strong><br>
                ↓<br>
                <strong>「Settings」</strong><br>
                ↓<br>
                <strong>「Delete your app」</strong>欄にある <span class="px-3 py-1 bg-red-600 text-white rounded text-xs font-bold">Delete app</span> ボタンをクリックします。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Supabase上のデータベースを削除</h3>
        <div class="p-6 bg-gray-50 border border-gray-200 rounded-lg">
            <p class="text-sm leading-relaxed">
                プロジェクト一覧（<a href="https://supabase.com/dashboard/organizations" target="_blank" class="text-blue-600 underline font-mono italic">https://supabase.com/dashboard/organizations</a>）のページへアクセス<br>
                ↓<br>
                <strong>「登録済みのプロジェクト名」</strong><br>
                ↓<br>
                <strong>「歯車のアイコン（Project Settings）」</strong><br>
                ↓<br>
                <strong>「General」</strong><br>
                ↓<br>
                <strong>「Delete Project」</strong>欄にある <span class="px-3 py-1 bg-red-600 text-white rounded text-xs font-bold">Delete project</span> ボタンをクリックします。
            </p>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}