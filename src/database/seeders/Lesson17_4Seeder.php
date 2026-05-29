<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_4Seeder extends Seeder
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
                'sort_order' => 4,
            ],
            [
                'title' => 'Webアプリケーションをデプロイする流れの概要',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-8">Webアプリケーションをデプロイする流れの概要</h2>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-6">
            <p>
                Fly.ioとSupabaseを使ってWebアプリケーションをデプロイする際は、以下の流れでデプロイする作業を進めます。
            </p>

            

            <div class="mt-8 space-y-4">
                <div class="flex items-start gap-4 p-5 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                    <div>
                        <h4 class="font-bold text-gray-800">Supabase上にデータベースを作成する</h4>
                        <p class="text-xs text-gray-600 mt-1">
                            まずはデータの保存先を確保します。Supabaseで新しいプロジェクトを立ち上げ、本番環境用のデータベースを用意します。
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                    <div>
                        <h4 class="font-bold text-gray-800">VScodeからSupabaseに対してマイグレーションを実行する</h4>
                        <p class="text-xs text-gray-600 mt-1">
                            作成した空のデータベースに対して、VScode（開発環境）から接続し、テーブル構造を作成（マイグレーション）します。
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                    <div>
                        <h4 class="font-bold text-gray-800">Fly.ioにWebアプリケーションをデプロイする</h4>
                        <p class="text-xs text-gray-600 mt-1">
                            最後に、Laravelのプログラム本体をFly.ioへアップロードします。これでWebアプリケーションが公開されます。
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-10 p-6 bg-blue-50 rounded-lg border border-blue-100 italic">
                <p class="text-sm text-blue-800">
                    次のチャプターから、メッセージボードのデプロイ作業を進めます。
                </p>
            </div>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}