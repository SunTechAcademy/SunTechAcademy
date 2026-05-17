<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13_2Seeder extends Seeder
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
                'sort_order' => 2,
            ],
            [
                'title' => '今回作成するWebアプリケーション',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">今回作成するWebアプリケーション</h2>
        <p class="text-lg leading-relaxed text-gray-700">
            本レッスンでは、<strong>「Booklist」</strong>というWebアプリケーションを作成します。
        </p>
        <p class="text-gray-700 leading-relaxed">
            このアプリケーションの機能は非常にシンプルです。
            <strong>「本のタイトルをデータベースに登録（保存）して、一覧を表示する」</strong>という、ごく単純な構成になっています。
        </p>
        <p class="text-gray-700 leading-relaxed">
            シンプルではありますが、ここには「データの入力・送信・保存・取得・表示」という、あらゆるモダンなWebアプリケーションの基礎が凝縮されています。
        </p>
    </section>

    <section class="space-y-4">
        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner flex justify-center">
            <img src="/images/Lesson13-2.png" alt="Lesson13-2" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>
    </section>

    <section class="bg-blue-50 p-6 rounded-xl border border-blue-100 mt-8">
        <h4 class="font-bold text-blue-800 mb-2">💡 このアプリで学べること</h4>
        <ul class="list-disc ml-6 space-y-2 text-sm text-blue-900">
            <li>HTMLフォームからのデータ送信（POSTリクエスト）</li>
            <li>PHPからMySQLへの接続と命令の実行</li>
            <li>データベースから取得したデータをHTMLに動的に表示する方法</li>
        </ul>
    </section>
</div>'
            ]
        );
    }
}