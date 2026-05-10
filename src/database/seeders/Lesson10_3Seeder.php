<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_3Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson 10 (PHPその3) を取得
        $lesson10 = Lesson::where('title', 'PHPその3')->first();

        if (!$lesson10) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson10->id,
                'sort_order' => 3
            ],
            [
                'title' => 'オブジェクト指向プログラミングとは',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            <strong>オブジェクト指向プログラミング（Object-Oriented Programming, OOP）</strong>とは、前のチャプターで学んだ「オブジェクト」という概念を積極的に導入し、システムを構築していくプログラミング手法のことです。
        </p>
        <p class="text-gray-700 leading-relaxed">
            これは単なるコードの書き方のルールではなく、<strong>「現実世界の物事の捉え方を、そのままプログラムの構造に反映させる」</strong>という、一種の思考フレームワーク（パラダイム）といえます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            世界の主流：オブジェクト指向プログラミング言語
        </h4>
        <p class="text-gray-700">
            オブジェクト指向を実現するために最適化された言語を<strong>「オブジェクト指向プログラミング言語」</strong>と呼びます。現在、世界中で使われている主要な言語の多くが、このオブジェクト指向を採用しています。
        </p>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center">
                <span class="text-xl font-bold text-[#777BB4]">PHP</span>
                <span class="text-xs text-gray-400 mt-1">Web開発の主役</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center">
                <span class="text-xl font-bold text-[#ED8B00]">Java</span>
                <span class="text-xs text-gray-400 mt-1">大規模システム・Android</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center">
                <span class="text-xl font-bold text-[#CC342D]">Ruby</span>
                <span class="text-xs text-gray-400 mt-1">日本発・直感的な記述</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center">
                <span class="text-xl font-bold text-[#00599C]">C++</span>
                <span class="text-xs text-gray-400 mt-1">高速処理・ゲームエンジン</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center">
                <span class="text-xl font-bold text-[#239120]">C#</span>
                <span class="text-xs text-gray-400 mt-1">Windowsアプリ・Unity</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center">
                <span class="text-xl font-bold text-[#F05138]">Swift</span>
                <span class="text-xs text-gray-400 mt-1">iOSアプリ開発</span>
            </div>
        </div>
        
        <p class="text-sm text-gray-600 italic mt-4">
            ※これらの言語を習得することは、単に一つの書き方を覚えるだけでなく、プログラミングの世界で通用する「共通の設計思想」を身につけることにも繋がります。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            クラスベースのオブジェクト指向
        </h4>
        <p class="text-gray-700 leading-relaxed">
            さらに詳しく言うと、PHPを含む上記の言語はすべて<strong>「クラスベース（Class-based）」</strong>のオブジェクト指向プログラミング言語に分類されます。
        </p>
        
        <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100">
            <h5 class="font-bold text-indigo-900 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                クラスベースとは？
            </h5>
            <p class="text-sm text-indigo-800 leading-relaxed">
                オブジェクトを作るために、まず<strong>「クラス（設計図）」</strong>を定義し、その設計図を元に実体（オブジェクト）を生成するスタイルのことです。
            </p>
            <div class="mt-4 flex flex-col md:flex-row gap-4 items-center justify-around">
                <div class="text-center">
                    <div class="bg-white border-2 border-dashed border-indigo-300 p-4 rounded-lg">
                        <span class="text-xs font-bold text-gray-400 uppercase">Class</span><br>
                        <span class="text-lg font-bold text-indigo-600">設計図</span>
                    </div>
                </div>
                <div class="text-indigo-300">
                    <svg class="w-8 h-8 rotate-90 md:rotate-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
                <div class="text-center">
                    <div class="bg-white border-2 border-indigo-500 p-4 rounded-lg shadow-md">
                        <span class="text-xs font-bold text-gray-400 uppercase">Instance</span><br>
                        <span class="text-lg font-bold text-indigo-900">実体（物）</span>
                    </div>
                </div>
            </div>
        </div>

        

        <p class="text-gray-700">
            この「設計図（クラス）」から「実体（インスタンス・オブジェクト）」を作るという流れは、現代のソフトウェア開発における最も標準的な手法です。次のチャプターからは、いよいよPHPでどのように設計図を書いていくのか、具体的な文法を見ていきましょう。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}