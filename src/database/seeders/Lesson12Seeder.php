<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 12 の作成
        $lesson12 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'MySQL'
            ],
            [
                'estimated_time' => 300,
                'sort_order' => 12,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson12->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12 pb-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700 text-left">
            ここでは、<strong>データベース</strong>を学んでいきます。データベースはデータを保存するためのソフトウェアです。有名なデータベースソフトウェアはいくつかありますが、ここでは、広く利用されている<strong>「MySQL」</strong>というデータベースソフトウェアを使って学んでいきます。
        </p>
    </section>

    <section class="space-y-4 text-left">
        <h4 class="font-bold text-xl text-gray-800 italic border-l-4 border-blue-500 pl-4">全体の位置づけ</h4>
        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner flex justify-center">
            <img src="/images/Lesson12-1.png" alt="Lesson12-1: データベースの位置づけ" class="max-w-full h-auto shadow-sm rounded">
        </div>
        <p class="text-gray-700 leading-relaxed mt-4">
            データベースとは何か、どんなイメージで保存されるのか、データに対してどんな操作ができるかを学びます。<br>
            そして、データベースを操作する言語である<strong>「SQL」</strong>について学びます。ここで学ぶのは基本操作のみですが、基本操作さえ覚えておけば、データベースに対する理解を深めることができます。
        </p>
    </section>

    <section class="space-y-6 text-left">
        <h4 class="flex items-center gap-2 font-bold text-xl text-gray-800">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            本レッスンの主な内容
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 shadow-sm">
                <ul class="space-y-3">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>データベース</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>リレーショナルデータベース</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>データベースの役割</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>SQLとは</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>データベース作成の流れ</li>
                </ul>
            </div>
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 shadow-sm">
                <ul class="space-y-3">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>データベースサーバ</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>データベースの作成</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>テーブルの作成</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>テーブルのデータの操作</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>SQLの各種命令</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-[#1a2a6c] to-[#2a4858] text-white p-8 rounded-2xl shadow-lg relative overflow-hidden text-left">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-6 flex items-center gap-2 underline underline-offset-8 decoration-blue-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                本レッスンのゴール
            </h4>
            <ul class="space-y-4 opacity-95 text-lg">
                <li class="flex items-start gap-3">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>データベースの概要について理解していること</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>MySQLおよびSQL言語の使い方について理解していること</span>
                </li>
            </ul>
        </div>
    </section>
</div>'
            ]
        );
    }
}