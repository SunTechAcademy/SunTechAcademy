<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson8Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 8 の作成
        $lesson8 = Lesson::updateOrCreate(
            ['course_id' => $course->id, 'title' => 'PHPその1'],
            ['estimated_time' => 300, 'sort_order' => 8]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            ['lesson_id' => $lesson8->id, 'sort_order' => 1],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            ここまで、HTML/CSSについて学びました。ただし残念ながら、HTML/CSSはプログラミングの言語ではありません。
        </p>
        <p class="text-lg leading-relaxed">
            おさらいすると、HTMLはマークアップ言語と呼ばれるデータ記述言語の一種であり、文書用の言語ということになります。CSSはHTMLをデザインするためのデザイン言語です。
        </p>
        <p class="text-lg leading-relaxed font-bold text-[#6A73A6]">
            そして、ここからのレッスンで学ぶPHPが、本コースで学ぶ唯一のプログラミング言語です。
        </p>
        <p class="text-lg leading-relaxed">
            PHPはWeb制作のために作られたプログラミング言語で、HTML/CSSとの親和性が高く、かつ学びやすい形になっています。ここからようやくプログラミングのスタートです。
        </p>
    </section>

    <section class="space-y-4">
        <h4 class="font-bold text-gray-800">全体の位置づけ（横へスクロールできます）</h4>
        <div class="overflow-x-auto pb-4">
            <div class="min-w-[600px] bg-gray-50 p-4 rounded-xl border border-gray-100">
                <img src="/images/lessons/Lesson8-1.png" alt="全体の位置づけ" class="w-full h-auto">
            </div>
        </div>
    </section>

    <section class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
        <p class="text-gray-700 leading-relaxed">
            4つのレッスンに分けてPHPを学びます。その最初として、このレッスンでは、まずはPHPが生まれた理由やPHPの特徴などを学び、PHPの基本文法を学びます。さらに、これ以降のレッスンで、PHPでのプログラミングの作法や、PHPをHTMLに埋め込むプログラミングを行います。Webアプリケーション開発の基礎を学んでいきましょう。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンの主な内容
        </h4>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 list-none">
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> PHPとは
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> PHPプログラミングの基本的なルール
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> 変数
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> データの型
            </li>
            <li class="flex items-center gap-2 bg-white p-3 rounded border border-gray-100 shadow-sm">
                <span class="text-[#6A73A6]">✔</span> 演算子
            </li>
        </ul>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンの前提条件
        </h4>
        <ul class="space-y-3 list-none">
            <li class="flex items-center gap-3 bg-blue-50 p-3 rounded border border-blue-100">
                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded font-bold uppercase">Condition 1</span>
                <span class="text-blue-900 font-medium">Webアプリケーションの画面の作り方を習得していること（HTML/CSS）</span>
            </li>
            <li class="flex items-center gap-3 bg-blue-50 p-3 rounded border border-blue-100">
                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded font-bold uppercase">Condition 2</span>
                <span class="text-blue-900 font-medium">ターミナルの操作方法を習得していること（ターミナル）</span>
            </li>
        </ul>
    </section>

    <section class="bg-[#6A73A6] text-white p-8 rounded-2xl shadow-inner relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-4">本レッスンのゴール</h4>
            <ul class="space-y-2 opacity-90 text-lg font-medium">
                <li class="flex items-center gap-2">● PHPの命令の書き方、および実行して確認する方法について理解していること</li>
            </ul>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-20 transform rotate-12">
            <svg width="140" height="140" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>
            </svg>
        </div>
    </section>
</div>'
            ]
        );
    }
}