<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 10 の作成
        $lesson10 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'PHPその3'
            ],
            [
                'estimated_time' => 600,
                'sort_order' => 10,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson10->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            PHPは<strong>クラスベースのオブジェクト指向プログラミング言語</strong>です。ここでは、その中核となる「オブジェクト」について学んでいきます。
        </p>
        <p class="text-gray-700 leading-relaxed">
            本コースでこれから学ぶ <strong>Laravel</strong> も、このオブジェクト指向を最大限に活用したフレームワークです。ここでオブジェクトについての理解を深めておくと、Laravelの学習が非常にスムーズになるでしょう。
        </p>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <p class="text-sm text-yellow-700">
                <strong>💡 アドバイス：</strong><br>
                オブジェクト指向はこれまでの概念よりも抽象度が高く、難しいと感じるかもしれません。もし一度で理解できなくても、まずは先に進むことをオススメします。実際にLaravelを使い始めてから戻ってくると、パズルが解けるように理解できることも多いです。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンの主な内容
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                <h5 class="font-bold text-blue-600 mb-2 font-mono">Core Concepts</h5>
                <ul class="text-sm space-y-1 text-gray-600">
                    <li>・オブジェクト指向プログラミングとは</li>
                    <li>・クラスとインスタンス</li>
                    <li>・コンストラクタ</li>
                    <li>・アクセス権（カプセル化）</li>
                </ul>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                <h5 class="font-bold text-green-600 mb-2 font-mono">Advanced Features</h5>
                <ul class="text-sm space-y-1 text-gray-600">
                    <li>・継承</li>
                    <li>・多態性（ポリモーフィズム）</li>
                    <li>・メソッドチェーン</li>
                </ul>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm md:col-span-2">
                <h5 class="font-bold text-purple-600 mb-2 font-mono">Organization & Reuse</h5>
                <ul class="text-sm grid grid-cols-2 gap-x-4 text-gray-600">
                    <li>・複数ファイルの連携</li>
                    <li>・名前空間（Namespace）</li>
                    <li>・トレイト（Trait）</li>
                </ul>
            </div>
        </div>
    </section>

    

    <section class="bg-gradient-to-br from-[#6A73A6] to-[#4A5180] text-white p-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-4 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                本レッスンのゴール
            </h4>
            <ul class="space-y-3 opacity-90 text-lg font-medium">
                <li class="flex items-start gap-2">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>PHPのオブジェクト指向プログラミングの基礎知識を習得し、各用語の意味と役割を説明できること</span>
                </li>
            </ul>
        </div>
    </section>
</div>'
            ]
        );
    }
}