<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson15Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコース（エンジニア基礎教育）を取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 15 の作成
        $lesson15 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'インターネット通信の仕組み'
            ],
            [
                'estimated_time' => 180,
                'sort_order' => 15,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson15->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            通信やHTTPに関する簡単な話は以前のレッスンで触れました。しかし、今後のWebアプリケーション開発学習をスムーズに進めるうえで知っておいた方がよい項目はまだまだあります。
        </p>
        <p class="text-gray-700 leading-relaxed">
            普段、私たちがブラウザでウェブサイトを閲覧したり、SNSに投稿したりするとき、その裏側では複雑な情報のやり取りが行われています。このレッスンでは、そういったインターネット通信のしくみや関連技術について詳しく学んでいきます。
        </p>
    </section>

    <section class="space-y-4">
        <h4 class="font-bold text-xl text-gray-800 italic border-l-4 border-[#6A73A6] pl-3">全体の位置づけ</h4>
        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner flex justify-center">
            <img src="/images/Lesson15-1.png" alt="Lesson15-1" class="max-w-md w-full h-auto shadow-sm rounded border">
        </div>
    </section>

    <section class="space-y-6 text-gray-700">
        <h4 class="flex items-center gap-2 font-bold text-xl pb-2 text-gray-800">
            <span class="bg-[#6A73A6] w-2 h-8 rounded-full"></span>
            本レッスンの主な内容
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 space-y-4">
                <p class="font-bold text-[#4A5180] border-b pb-2">主要キーワード</p>
                <ul class="space-y-3">
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        <strong>HTTP</strong>：Webブラウザとサーバが会話するための共通言語
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        <strong>URL</strong>：インターネット上のリソースの場所を示す住所
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        <strong>IP</strong>：ネットワーク上の機器を識別するための番号
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-500 font-bold">・</span>
                        <strong>TCP/IPモデル</strong>：通信を支える階層構造のルール
                    </li>
                </ul>
            </div>
            
            <div class="flex items-center justify-center p-6 italic text-gray-500 text-sm leading-relaxed">
                Webエンジニアとして、プログラムを書くだけでなく「データがどのように運ばれているのか」を知ることは、トラブルシューティングやセキュリティの理解に直結します。
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-[#6A73A6] to-[#4A5180] text-white p-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-6 flex items-center gap-2 underline underline-offset-8 decoration-blue-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                本レッスンのゴール
            </h4>
            <div class="bg-white/10 p-6 rounded-xl backdrop-blur-sm border border-white/20">
                <ul class="space-y-4 opacity-95 text-lg">
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>どのような通信の仕組みで「インターネット上に公開されたWebアプリケーション」が利用できるのかについて、概念を言葉で説明できること。</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>'
            ]
        );
    }
}