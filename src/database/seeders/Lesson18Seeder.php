<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 18 の作成
        $lesson18 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'Laravelを用いたWebアプリケーション開発：応用'
            ],
            [
                'estimated_time' => 1500, // 応用編のため長めに設定
                'sort_order' => 18,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson18->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            メッセージボードでは、リソースのCRUD操作を <code>Route::resource()</code> によって生成される7つのRESTfulな基本アクションで行い、その構造に沿ってModel, Router, Controller, Viewの基礎を学びました。
        </p>
        <p class="text-gray-700 leading-relaxed">
            ここからはそれを前提に、さらに高度な機能を開発します。具体的には、<strong>認証、ユーザのフォロー／フォロワー、お気に入り機能</strong>です。認証はLaravel Breezeを利用してユーザー登録、ログイン機能を実装することです。
        </p>
        <p class="text-gray-700 leading-relaxed">
            このレッスンを完了すれば、自分でイメージしているアプリケーションを作れるようになるでしょう。しかし、このレッスンはメッセージボードよりも難しい内容になります。1つ1つ納得しながら進むようにしましょう。以前の内容を忘れてしまっていると感じた場合には、何度も戻って復習するようにしてください。
        </p>
        <p class="text-gray-700 leading-relaxed bg-yellow-50 p-4 border-l-4 border-yellow-400">
            また、ここからは、既出の内容については詳しく言及しないことがあります。たとえば <code>php artisan tinker</code> でtinkerを起動しようとか、サーバを起動しよう、といった書き方はしていません。すでに学んだものは皆さん自身でコードをしっかり読むようにしてください。
        </p>
    </section>

    <section class="space-y-6 text-gray-700">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] pb-2 border-b-2 border-gray-100">
            本レッスンの主な内容
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                <ul class="space-y-3">
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        今回作成するWebアプリケーションの概要
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        Laravel Breezeを利用したユーザ登録・ログイン機能の構築
                    </li>
                </ul>
            </div>
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                <ul class="space-y-3">
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        投稿機能の構築
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        ユーザとユーザがフォローする／フォローされる機能の構築
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
                    <span>Laravel Breeze認証を使った開発について理解していること</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>X（旧Twitter）クローンのWebアプリケーションが完成していること</span>
                </li>
            </ul>
        </div>
    </section>
</div>'
            ]
        );
    }
}