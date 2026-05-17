<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson13Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 13 の作成
        $lesson13 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'PHPとMySQLの連携'
            ],
            [
                'estimated_time' => 300,
                'sort_order' => 13,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson13->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            このレッスンでは、これまでに学んだPHPとMySQLを連携して、データを保存できるWebアプリケーションを作ります。
        </p>
        <p class="text-gray-700 leading-relaxed">
            連携すれば、今までできなかった<strong>「Web上で送信したフォームデータを保存」</strong>できます。これで、ようやくWebアプリケーションらしくなります。
        </p>
    </section>

    <section class="space-y-4">
        <h4 class="font-bold text-xl text-gray-800 italic">全体の位置づけ</h4>
        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
            <img src="/images/Lesson13-1.png" alt="Lesson13-1" class="max-w-md w-full h-auto shadow-sm rounded border">
        </div>
        <p class="text-gray-700 leading-relaxed mt-4">
            プログラムとデータベースの連携は、Webアプリケーションだけではなく、スマートフォンやWindows、Macのアプリケーションなど、その他の色々なアプリケーションで大切な機能です。
            多くのアプリケーションはユーザデータを扱うことになります。そのときに、必ずプログラムとデータベースの連携が行われます。
        </p>
        <p class="text-gray-700 leading-relaxed">
            それでは、プログラムとデータベースの連携というテーマを意識して、レッスンを進めていきましょう。
        </p>
    </section>

    <section class="space-y-6 text-gray-700">
        <h4 class="flex items-center gap-2 font-bold text-xl pb-2 text-gray-800">
            本レッスンの主な内容
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                <ul class="space-y-3 font-medium">
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        HTMLを作成する
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        HTML内で動的な部分をPHPで置き換える
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        データベースのテーブルを作成する
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        PHPとMySQLを連携する
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-[#4A5180] to-[#2D3359] text-white p-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-6 flex items-center gap-2 underline underline-offset-8 decoration-blue-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                本レッスンのゴール
            </h4>
            <ul class="space-y-4 opacity-95 text-lg">
                <li class="flex items-start gap-3">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>HTMLとPHP、MySQLを連携させたWebアプリケーションの作り方について理解していること</span>
                </li>
            </ul>
        </div>
    </section>
</div>'
            ]
        );
    }
}