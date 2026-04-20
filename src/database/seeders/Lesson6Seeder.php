<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson6Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 6 の作成
        $lesson6 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'CSSチュートリアル'
            ],
            [
                'estimated_time' => 240,
                'sort_order' => 6,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson6->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            このレッスンでは、HTMLチュートリアルで作成した <strong>kitchen.html</strong> にCSSデザインを適用し、Webページを完成させます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンの主な内容
        </h4>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 list-none">
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> CSSのチュートリアル実習
            </li>
        </ul>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンで作るもの
        </h4>
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
            <p class="font-bold text-gray-800">🍳 架空の料理教室のWebページ（完成版）</p>
            <p class="text-sm text-gray-600 mt-2">※HTMLチュートリアルで作った白紙のようなページに、色やレイアウトをつけていきます。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンの前提条件
        </h4>
        <ul class="space-y-3 list-none">
            <li class="flex items-center gap-3 bg-blue-50 p-3 rounded border border-blue-100">
                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded font-bold">条件1</span>
                <span class="text-blue-900 font-medium">HTMLについて理解していること（HTML基礎、HTMLチュートリアル）</span>
            </li>
            <li class="flex items-center gap-3 bg-blue-50 p-3 rounded border border-blue-100">
                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded font-bold">条件2</span>
                <span class="text-blue-900 font-medium">CSSについて理解していること（CSS基礎）</span>
            </li>
        </ul>
    </section>

    <section class="bg-[#6A73A6] text-white p-8 rounded-2xl shadow-inner relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-4">本レッスンで身につくこと</h4>
            <ul class="space-y-2 opacity-90 text-lg font-medium">
                <li class="flex items-center gap-2">● HTMLとCSSで1つのWebページを完成させる方法</li>
            </ul>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-20 transform rotate-12">
            <svg width="140" height="140" fill="currentColor" viewBox="0 0 24 24"><path d="M14 3h-4.91c-.38-1.72-1.9-3-3.72-3s-3.34 1.28-3.72 3H2v18h20V3h-3.37zM7.37 3c.38 0 .69.31.69.69s-.31.69-.69.69-.69-.31-.69-.69.31-.69.69-.69zM19 19H5V5h14v14z"/></svg>
        </div>
    </section>
</div>'
            ]
        );
    }
}