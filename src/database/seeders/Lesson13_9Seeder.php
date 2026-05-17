<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13_9Seeder extends Seeder
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
                'sort_order' => 9, // チャプター番号を9として作成
            ],
            [
                'title' => '動作確認',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-10 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">動作確認</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
            作成したWebアプリケーションが正しく動作するか、実際に触って確認してみましょう。
        </p>

        <div class="grid grid-cols-1 gap-6">
            <div class="flex items-start gap-4 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                <div class="space-y-2">
                    <h4 class="font-bold text-gray-800">ブラウザでアクセスする</h4>
                    <p class="text-gray-600 text-sm">
                        以下のURLにアクセスして、作成した画面が表示されるか確認してください。
                    </p>
                    <a href="http://localhost/lesson13/booklist.php" target="_blank" class="inline-block text-blue-600 underline font-mono">
                        http://localhost/lesson13/booklist.php
                    </a>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                <div class="space-y-2">
                    <h4 class="font-bold text-gray-800">書籍を登録する</h4>
                    <p class="text-gray-600 text-sm">
                        フォームに<strong>「新しい書籍タイトル」</strong>を入力して、<strong>「登録」</strong>ボタンをクリックしてください。
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-green-500">
                <div class="flex-shrink-0 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">3</div>
                <div class="space-y-2">
                    <h4 class="font-bold text-gray-800">結果を確認する</h4>
                    <ul class="list-disc ml-5 text-sm text-gray-600 space-y-2">
                        <li>
                            <span class="font-bold text-gray-800 underline decoration-green-500 underline-offset-4">画面上の確認：</span><br>
                            「登録された書籍一覧」に入力した値が追加（表示）されていること。
                        </li>
                        <li>
                            <span class="font-bold text-gray-800 underline decoration-green-500 underline-offset-4">データベースの確認：</span><br>
                            <strong>phpMyAdmin</strong>を開き、<code>booklist</code> データベースの <code>books</code> テーブルにレコードが追加されていること。
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2 italic">Check Point</h4>
        <p class="text-gray-700 text-sm leading-relaxed">
            もし一覧に表示されない場合は、SQL文の綴りや、<code>bindParam</code> が正しく行われているか、またはDB接続情報のユーザー名・パスワードが間違っていないかを見直してみましょう。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}