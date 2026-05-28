<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 17 の作成
        $lesson17 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'アプリケーションのデプロイ'
            ],
            [
                'estimated_time' => 300,
                'sort_order' => 17,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson17->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            レッスンのタイトルにある <span class="font-bold text-blue-600">デプロイ（deploy）</span> は、簡単に言うと「作成したWebアプリケーションをインターネット上で公開すること」です。
        </p>
        <p class="text-gray-700 leading-relaxed">
            これまでは自分のPCの中（ローカル環境）だけで動作を確認してきましたが、世界中の人があなたのアプリケーションを使えるようにするためには、Webサーバにプログラムを配置する必要があります。本レッスンでは、自分たちの手で作成したWebアプリケーションをデプロイする方法について学びます。
        </p>
    </section>

    <section class="space-y-6 text-gray-700">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] pb-2 text-gray-800">
            本レッスンの主な内容
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 shadow-sm">
                <ul class="space-y-3">
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        デプロイとは
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        デプロイするために利用するサービスFly.ioの概要
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        Supabaseの概要
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        Fly.ioとSupabaseのアカウント登録
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        メッセージボードをデプロイする
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-[#6A73A6] to-[#4A5180] text-white p-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-6 flex items-center gap-2 underline underline-offset-8 decoration-blue-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                本レッスンのゴール
            </h4>
            <ul class="space-y-4 opacity-95 text-lg">
                <li class="flex items-start gap-3">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Fly.ioとSupabaseについて理解していること</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>メッセージボードのレッスンで作成したWebアプリケーションを、Fly.ioとSupabaseを使って公開できていること</span>
                </li>
            </ul>
        </div>
    </section>
</div>'
            ]
        );
    }
}