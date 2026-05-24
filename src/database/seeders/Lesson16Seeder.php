<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 16 の作成
        $lesson16 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'Laravelを用いたWebアプリケーション開発：基礎'
            ],
            [
                'estimated_time' => 1200, // 実習を含むため長めに設定
                'sort_order' => 16,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson16->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            ここまでのレッスンで、Webアプリケーションの基礎を学んできました。
        </p>
        <p class="text-gray-700 leading-relaxed">
            しかし、これまでは場当たり的なコーディングルールで開発を行なってきました。たとえば、PHP+MySQLで開発したWebアプリケーションは1ファイルで構成され、その中にさまざまな役割の処理（フォームデータの処理、SQL、表示など）が書かれており、役割分担できていない状態です。
        </p>
        <p class="text-gray-700 leading-relaxed">
            プログラムの規模が大きくなり、管理対象のファイルが多くなった際には、効率的に開発を行なうことが難しいです。
            そこで、ここからは<strong>Laravel</strong>を使用します。Laravelの使い方を学びつつ、今まで部分的に学んだ知識を活用して、Webアプリケーションを作成します。
        </p>
    </section>

    <section class="space-y-4">
        <div class="overflow-x-auto border border-gray-200 rounded-xl p-4 bg-white shadow-inner flex justify-center">
            <img src="/images/Lesson16-1.png" alt="Lesson16-1" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>
        <p class="text-center text-sm text-gray-500 italic">Laravelを使うと効率的にWebアプリケーション開発を行えます。</p>
    </section>

    <section class="space-y-4">
        <h4 class="font-bold text-xl text-gray-800">なぜLaravelを使うのか？</h4>
        <p class="text-gray-700 leading-relaxed">
            Laravelを使うと、ファイルの役割などが一定のルールに則って開発できるからです。そして、役割分担が適切になされるため、規模が大きくても見通しの良いWebアプリケーションを作り上げることができます。
        </p>
        <p class="text-gray-700 leading-relaxed">
            また、PHPだけでは長々と書く必要があった処理も簡潔に書けるため、素早く高度なアプリケーションを開発できます。
        </p>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
            <p class="text-yellow-800 text-sm">
                <strong>注意：</strong>Laravelには独自のルール（学習コスト）があります。ここから先のレッスンでは、効率的かつ高度な開発を行うための「ルール」を学んでいきます。このレッスンの課題を自力でできるようになるまで、繰り返し学習しましょう。
            </p>
        </div>
    </section>

    <section class="space-y-6 text-gray-700">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] pb-2 border-b">
            本レッスンの主な内容
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                <p class="font-bold mb-3">理論・概念</p>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>Webアプリケーションフレームワークとは</li>
                    <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>Laravelとは</li>
                    <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>MVC（Model-View-Controller）</li>
                    <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>Laravelでの開発の流れ</li>
                </ul>
            </div>
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                <p class="font-bold mb-3">実習：メッセージボードの構築</p>
                <ul class="space-y-2 text-sm">
                    <li>プロジェクトの作成 / 初期動作確認</li>
                    <li>データベース接続 / Modelの構築</li>
                    <li>Router / Controller / Viewの設定</li>
                    <li>カラムの追加 / ページネーション実装</li>
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
                    <span>メッセージボードのWebアプリケーションが完成していること</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Laravelを使ってWebアプリケーションを作る方法について、一通りの流れを理解していること</span>
                </li>
            </ul>
        </div>
    </section>
</div>'
            ]
        );
    }
}