<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_9Seeder extends Seeder
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
                'sort_order' => 9,
            ],
            [
                'title' => 'まとめ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">まとめ</h2>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-6">
            <p>
                Fly.ioとSupabaseを利用すると簡単にWebサービスを公開できます。
            </p>
            
            <p>
                最終レッスンでも、Fly.ioとSupabaseでオリジナルのWebアプリケーションを公開していただきます。
            </p>
        </div>
    </section>

    <section class="mt-12">
        <div class="bg-blue-50 border border-blue-100 p-8 rounded-xl text-center shadow-sm">
            <div class="inline-block p-3 bg-blue-600 rounded-full mb-4">
                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-blue-900 mb-2">Lesson 17 完了</h3>
            <p class="text-blue-700 text-sm">
                お疲れ様でした！これでアプリケーションのデプロイに関する学習は完了です。<br>
                学んだ手順を振り返り、スムーズに公開作業ができるようにしておきましょう。
            </p>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}