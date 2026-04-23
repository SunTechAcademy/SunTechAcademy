<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson7Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 7 の作成
        $lesson7 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'ターミナル'
            ],
            [
                'estimated_time' => 180, // 目安時間（必要に応じて変更してください）
                'sort_order' => 7,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson7->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            このレッスンでは、基本的な<strong>ターミナル</strong>の使い方を学びます。
        </p>
        <p class="text-lg leading-relaxed">
            VS CodeはWebアプリケーション開発を学ぶツールとして非常に優れています。色々なことがVS Code上で行えます。<br>
            VS Codeの機能の1つであるターミナルは、作成したプログラムを実行したり、Webアプリケーションを起動したりするために使います。しかし、使い方に慣れなければ、プログラミングをはじめとする今後の学習がスムーズに進まなくなる原因となります。
        </p>
        
        
        
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンの主な内容
        </h4>
        <ul class="grid grid-cols-1 md:grid-cols-3 gap-3 list-none">
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> ターミナルとは
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> ターミナルの基本的なコマンド
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> ターミナルの便利な機能
            </li>
        </ul>
    </section>

    <section class="bg-[#6A73A6] text-white p-8 rounded-2xl shadow-inner relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-4">本レッスンのゴール</h4>
            <ul class="space-y-2 opacity-90 text-lg font-medium">
                <li class="flex items-center gap-2">● ターミナルについて理解すること</li>
                <li class="flex items-center gap-2">● 基本的なターミナルのコマンドを使えるようになること</li>
            </ul>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-20 transform rotate-12">
            <svg width="140" height="140" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 14H5c-.55 0-1-.45-1-1V7c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v10c0 .55-.45 1-1 1zM5.5 9.5l2.5 2.5-2.5 2.5 1.06 1.06L10.12 12 6.56 8.44 5.5 9.5zm5.5 5h5v1.5h-5V14.5z"/>
            </svg>
        </div>
    </section>
</div>'
            ]
        );
    }
}