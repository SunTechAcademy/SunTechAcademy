<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson9Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 9 の作成
        $lesson9 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'PHPその2'
            ],
            [
                'estimated_time' => 480,
                'sort_order' => 9,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson9->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            ここまでで、変数に値を代入して、変数を指定して演算し、結果を表示することは何となくできるようになりました。<br>
            今までは単純に上から下へ流れていって、すべてのソースコードを実行していましたが、ここからはプログラム内を縦横無尽に動き回ります。
        </p>
        <p class="text-gray-700">
            上から下に向かって命令が実行されるという基本的な順番は守られつつも、場合によっては<strong>特定の場所へジャンプしたり、実行をスキップしたり</strong>するようになります。
        </p>
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h5 class="font-bold text-blue-900 mb-2">制御文（せいぎょぶん）とは？</h5>
            <p class="text-sm text-blue-800 leading-relaxed">
                プログラムが実行される流れを色々なパターンへ対応させ、プログラムの幅を大きく広げてくれるものです。大事な要素は以下の2つです。
            </p>
            <ul class="mt-3 space-y-2 text-sm text-blue-900">
                <li class="flex items-start gap-2">
                    <span class="font-bold">・条件分岐：</span>
                    <span>ある条件に合っていれば実行し、そうでなければ別の処理をする。</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="font-bold">・繰り返し：</span>
                    <span>指定した回数や、条件を満たすまで同じ処理をループさせる。</span>
                </li>
            </ul>
        </div>
        <p class="text-gray-700 mt-4">
            さらに、このレッスンでは一連の処理をひとまとめにする<strong>「関数」</strong>という概念についても見ていきます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            本レッスンの主な内容
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm">
                <h5 class="font-bold text-blue-600 mb-3 flex items-center gap-2">
                    <span class="text-xs bg-blue-100 px-2 py-0.5 rounded-full">1</span> 条件分岐
                </h5>
                <ul class="text-sm space-y-1 text-gray-600 ml-4 list-disc">
                    <li>if文 / if-else文</li>
                    <li>if-elseif-else文</li>
                </ul>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm">
                <h5 class="font-bold text-green-600 mb-3 flex items-center gap-2">
                    <span class="text-xs bg-green-100 px-2 py-0.5 rounded-full">2</span> 繰り返し
                </h5>
                <ul class="text-sm space-y-1 text-gray-600 ml-4 list-disc">
                    <li>for文 / while文</li>
                    <li>foreach文</li>
                </ul>
            </div>
            <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm md:col-span-2">
                <h5 class="font-bold text-purple-600 mb-2 flex items-center gap-2">
                    <span class="text-xs bg-purple-100 px-2 py-0.5 rounded-full">3</span> 関数
                </h5>
                <p class="text-sm text-gray-600 ml-4">自作の命令を作って再利用する仕組みを学びます。</p>
            </div>
        </div>
    </section>

    <section class="bg-[#6A73A6] text-white p-8 rounded-2xl shadow-inner relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-4">本レッスンのゴール</h4>
            <ul class="space-y-2 opacity-90 text-lg font-medium">
                <li class="flex items-center gap-2">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>PHPで命令を制御する方法について理解していること</span>
                </li>
            </ul>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-20 transform rotate-12">
            <svg width="140" height="140" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
    </section>
</div>'
            ]
        );
    }
}