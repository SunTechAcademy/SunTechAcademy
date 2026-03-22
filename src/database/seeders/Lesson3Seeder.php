<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        // Lesson 3 の作成
        $lesson3 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'HTML基礎',
            'estimated_time' => 120,
            'sort_order' => 3,
        ]);

        // Chapter 1: 学習の目標
        Chapter::create([
            'lesson_id' => $lesson3->id,
            'title' => '学習の目標',
            'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            このレッスンでは、Webアプリケーションを作成するうえで必要な知識のうち、ブラウザに表示される内容を作成するための言語である<strong>HTMLとCSS</strong>を学びます。
        </p>
        <div class="flex flex-col md:flex-row gap-6 items-center bg-gray-50 p-6 rounded-xl border border-gray-100">
            <div class="flex-1 space-y-2">
                <p><span class="inline-block bg-[#6A73A6] text-white text-xs px-2 py-0.5 rounded mr-2">HTML</span> <strong>文書（情報をまとめる役）</strong>を担当</p>
                <p><span class="inline-block bg-pink-500 text-white text-xs px-2 py-0.5 rounded mr-2">CSS</span> <strong>デザイン（見た目を整える役）</strong>を担当</p>
            </div>
        </div>
        
        <div class="space-y-4 pt-6">
            <p class="font-bold text-gray-800">全体の位置づけ（横へスクロールできます）</p>
            <div class="overflow-x-auto pb-4">
                <img src="/images/Lesson2-13.png" alt="HTML/CSSの位置づけ" class="max-w-none h-auto rounded border shadow-sm">
            </div>
            <p class="text-gray-700">ここからは、簡単なWebサイトを制作していく中でHTMLとCSSを学びます。Web開発の基礎を身につけてください。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンの主な内容
        </h4>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 list-none">
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> Webページが表示される仕組み
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> HTMLならびにCSSとは
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> HTMLの書き方
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> ファイルパスについて
            </li>
        </ul>
    </section>

    <section class="bg-[#6A73A6] text-white p-8 rounded-2xl shadow-inner relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-4">本レッスンで身につくこと</h4>
            <ul class="space-y-2 opacity-90">
                <li class="flex items-center gap-2">● HTMLとCSSがどういうものか</li>
                <li class="flex items-center gap-2">● HTMLの知識</li>
            </ul>
        </div>
        <div class="absolute right-[-10px] bottom-[-10px] opacity-20 transform rotate-12">
            <svg width="120" height="120" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.45l8.27 14.3H3.73L12 5.45z"/></svg>
        </div>
    </section>
</div>',
            'is_assignment' => 1,
            'sort_order' => 1,
        ]);
    }
}