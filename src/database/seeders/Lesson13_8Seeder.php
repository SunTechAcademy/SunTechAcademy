<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13_8Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 13 (PHPとMySQLの連携) を取得
        $lesson13 = Lesson::where('title', 'PHPとMySQLの連携')->first();

        if (!$lesson13) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson13->id,
                'sort_order' => 8,
            ],
            [
                'title' => 'まとめ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">まとめ</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                このレッスンでは、データの保存とそれを表示する方法として、<strong>PHPとMySQLの連携方法</strong>を学びました。
                ここまでの内容を理解し、実装できるようになれば、一般的なWebアプリケーションとしての基本機能は十分に実現可能です。
            </p>
            <p class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                ただし、現代の開発現場では、より便利で効率的に、そして安全にWebアプリケーションを作成できる<strong>「Laravel」</strong>というフレームワークが広く使われています。
                次は、このPDOによる生のPHP操作を、より洗練された形で扱えるLaravelの世界を学んでいきましょう。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-red-700 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            トラブルシューティング：ページが動作しない場合
        </h3>
        <p class="text-gray-700">
            もし、ブラウザに<strong>「このページは動作していません」</strong>（500エラー等）と表示されている場合は、PHPプログラムからデータベースにアクセスする「権限」が不足している可能性があります。
        </p>
        <p class="text-gray-700">
            その場合は、<strong>phpMyAdmin</strong>を開き、<code>booklist</code>データベースに対して、接続用ユーザー（例: dbuser）に適切な権限が割り当てられているか確認してください。
        </p>

        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner flex justify-center mt-4">
            <img src="/images/Lesson13-6.png" alt="Lesson13-6" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>
    </section>

    <section class="text-center py-12 border-t border-gray-100">
        <div class="inline-block p-4 rounded-full bg-blue-100 text-blue-600 mb-4 font-bold text-2xl">
            🏆 CONGRATULATIONS!
        </div>
        <p class="text-gray-600">
            Lesson 13：PHPとMySQLの連携 をすべて完了しました。<br>
            いよいよ次は、より高度な開発体験を提供するフレームワーク「Laravel」の学習へ進みます。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}