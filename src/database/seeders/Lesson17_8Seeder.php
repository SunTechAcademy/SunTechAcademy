<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_8Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得（「アプリケーションのデプロイ」というタイトルのLessonを想定）
        $lesson = Lesson::where('title', 'アプリケーションのデプロイ')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 8,
            ],
            [
                'title' => 'Webアプリケーションを修正して再度デプロイする場合',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">Webアプリケーションを修正して再度デプロイする場合</h2>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-6">
            <p>
                ローカルでバグ修正や機能追加などを行い、正常動作を確認したら、Fly.ioとSupabaseで公開済みのWebアプリケーションにも反映する必要があります。
            </p>
            
            <p>
                再度デプロイする場合は、先ほどのデプロイのコマンドを再び実行するだけでOKです。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <p class="text-xs font-bold text-gray-500 italic">コマンド実行</p>
        <div class="bg-gray-900 text-white p-4 rounded-md font-mono text-sm shadow-lg border border-gray-700">
            fly deploy
        </div>
    </section>

    <section class="mt-8">
        <div class="bg-amber-50 border-l-4 border-amber-500 p-6 rounded-r shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-amber-800 leading-relaxed">
                        ローカルでマイグレーションを行なった場合は、Supabaseにも行なう必要があります。
                        <strong>VScode（XAMPPなど）とSupabaseは別の環境であり、データベースも別だからです。</strong>
                    </p>
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