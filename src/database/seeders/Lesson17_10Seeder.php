<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_10Seeder extends Seeder
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
                'sort_order' => 10,
            ],
            [
                'title' => '（参考資料）デプロイしたWebアプリケーションのエラーの確認方法',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">（参考資料）デプロイしたWebアプリケーションのエラーの確認方法</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>デプロイしたWebアプリケーションのエラーの確認方法について紹介します。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">エラーログの参照</h3>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                ローカルでは、エラー画面や <code>storage/logs/laravel.log</code> ファイルに出力されるログを手がかりにデバッグできます。
            </p>
            <p>
                Fly.io上のアプリケーションのログは <strong>fly logs</strong> コマンドにより参照できるのですが、初期状態ではLaravelアプリケーションのログは出力されません。Laravelの環境変数 <strong>LOG_CHANNEL</strong> を <strong>errorlog</strong> に設定すると出力されるようになります。
            </p>
        </div>

        <div class="bg-gray-800 text-green-300 p-5 rounded font-mono text-xs leading-relaxed shadow-inner">
            <span class="text-gray-500"># storage/logs/laravel.log ではなく標準エラー出力へ</span><br>
            LOG_CHANNEL=errorlog
        </div>

        <p class="text-xs">
            参考：<a href="https://readouble.com/laravel/9.x/ja/logging.html" target="_blank" class="text-blue-600 underline italic">ログ（Laravel 9.x）（https://readouble.com/laravel/9.x/ja/logging.html）</a>
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">エラー内容を画面に表示する</h3>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                エラーの詳細をブラウザへ表示したい場合は下記のLaravelの環境変数を変更してみてください。
            </p>
        </div>

        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic">Laravelの環境変数</p>
            <div class="bg-gray-100 p-4 border rounded font-mono text-sm">
                APP_DEBUG=true
            </div>
        </div>

        <div class="p-4 bg-red-50 border border-red-200 rounded text-xs text-red-800 leading-relaxed">
            <strong>ただし、本番環境として公開するうえでは、エラーが出た場合に、その詳細をいつもブラウザに表示するのはおススメできません。</strong><br>
            エラー内容を確認した後は速やかに設定値を <strong>false</strong> へ変更しましょう。
        </div>

        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic">Laravelの環境変数</p>
            <div class="bg-gray-100 p-4 border rounded font-mono text-sm">
                APP_DEBUG=false
            </div>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}