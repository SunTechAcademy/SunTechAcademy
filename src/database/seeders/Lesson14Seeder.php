<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得
        $course = Course::where('title', 'エンジニア基礎教育')->first();

        if (!$course) {
            return;
        }

        // Lesson 14 の作成
        $lesson14 = Lesson::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => 'Git/GitHub'
            ],
            [
                'estimated_time' => 300,
                'sort_order' => 14,
            ]
        );

        // Chapter 1: 学習の目標
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson14->id,
                'sort_order' => 1,
            ],
            [
                'title' => '学習の目標',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            これから本格的にWebアプリケーションの作り方を学んでいくことになりますが、いったんここで、<strong>GitおよびGitHub</strong>について学習します。
        </p>
        <p class="text-gray-700 leading-relaxed">
            後ほど詳しく説明しますが、Gitは <strong>バージョン管理ツール</strong> の一種です。バージョン管理ツールは、ある程度の規模のアプリケーションを作っていく中で「コードの修正をしたけど、以前の状態に戻したい！」といった要求に応えてくれます。
        </p>
        <p class="text-gray-700 leading-relaxed italic">
            このレッスンでは、最初にGitの概要について学びます。後ほど「はじめてのバージョン管理」チャプターで基本的なGitのコマンドを使用して、実際にファイルのバージョン管理を行ないます。
        </p>
    </section>

    <section class="space-y-4">
        <h4 class="font-bold text-xl text-gray-800 border-l-4 border-blue-600 pl-4">コマンドラインで学ぶ理由</h4>
        <p class="text-gray-700 leading-relaxed">
            Gitは公式のコマンドラインツールのほか、マウスで操作できるGUIクライアントも存在しますが、本トレーニングでは<strong>コマンドライン</strong>で学んでいきます。理由は以下の2点です。
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h5 class="font-bold text-blue-800 mb-2">1. 網羅性</h5>
                <p class="text-sm text-blue-900 leading-relaxed">Gitの基本がコマンドラインであり、Gitが持つすべての機能を使えるため。</p>
            </div>
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h5 class="font-bold text-blue-800 mb-2">2. 普遍性</h5>
                <p class="text-sm text-blue-900 leading-relaxed">GUIの好みは分かれますが、コマンドラインツールは世界中のエンジニアが同じものを使用するため。</p>
            </div>
        </div>
        <p class="text-gray-700 leading-relaxed">
            コマンドラインは一見何が起こっているか分かりにくいですが、本レッスンでは図解を多く使い、Git内部の状態をイメージできるように解説します。
        </p>
    </section>

    <section class="space-y-6 text-gray-700">
        <h4 class="flex items-center gap-2 font-bold text-xl text-gray-800">
            本レッスンの主な内容
        </h4>
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-y-3">
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>バージョン管理とは</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>Gitとは</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>GitHubとは</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>Gitの基本概念</li>
                <li class="flex items-center gap-2"><span class="text-blue-500 font-bold">・</span>はじめてのバージョン管理（実習）</li>
            </ul>
        </div>
    </section>

    <section class="bg-gradient-to-br from-[#4A5568] to-[#2D3748] text-white p-8 rounded-2xl shadow-lg">
        <h4 class="text-xl font-bold mb-6 flex items-center gap-2 underline underline-offset-8 decoration-blue-400">
            <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            本レッスンのゴール
        </h4>
        <ul class="space-y-4 opacity-95">
            <li class="flex items-start gap-3">
                <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>バージョン管理がどういうものかについて理解していること</span>
            </li>
            <li class="flex items-start gap-3">
                <svg class="w-6 h-6 mt-1 flex-shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>GitおよびGitHubの使い方について理解していること</span>
            </li>
        </ul>
    </section>
</div>'
            ]
        );
    }
}