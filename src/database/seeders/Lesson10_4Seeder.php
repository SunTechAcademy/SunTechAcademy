<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson10_4Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson 10 (PHPその3) を取得
        $lesson10 = Lesson::where('title', 'PHPその3')->first();

        if (!$lesson10) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson10->id,
                'sort_order' => 4
            ],
            [
                'title' => 'クラスとインスタンスとは',
                'is_assignment' => 0,
                'content' => <<< 'EOF'
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            「クラスベース」という言葉を聞くと難しく感じるかもしれませんが、概念は非常にシンプルです。
            PHPのようなオブジェクト指向言語では、オブジェクトを<strong>「クラス」</strong>と<strong>「インスタンス」</strong>という2つの側面で捉えます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2 flex items-center gap-2">
            1. クラス (Class) ：金型・設計図
        </h4>
        <p class="text-gray-700 leading-relaxed">
            クラスとは、オブジェクトの<strong>「金型（かながた）」</strong>や<strong>「設計図」</strong>にあたるものです。
            オブジェクトを作るには、まずこのクラスを宣言（作成）する必要があります。どんな変数（データ）を持ち、どんな関数（動作）を行うのかをあらかじめ決めておきます。
        </p>
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h5 class="font-bold text-blue-900 mb-2">例：Slimeクラス</h5>
            <p class="text-sm text-blue-800">
                設計図の中で「このスライムはHPを持っている」「攻撃というアクションができる」といった定義を書き込みます。
            </p>
            <ul class="list-disc ml-6 mt-3 text-sm text-blue-700 font-mono">
                <li>$hp; // プロパティ（変数）</li>
                <li>function attack() { ... } // メソッド（関数）</li>
            </ul>
        </div>
        
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2 flex items-center gap-2">
            2. インスタンス (Instance) ：実物・実体
        </h4>
        <p class="text-gray-700 leading-relaxed">
            インスタンスは、クラス（設計図）から作られた<strong>「実物」</strong>です。
            設計図が1枚あれば、そこから何個でも実物を作ることができます。重要なのは、<strong>「設計図だけではゲームに敵は現れない」</strong>ということです。設計図を基に「スライムA」「スライムB」という実体を作って初めて、攻撃させたりダメージを与えたりできるようになります。
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm">
                <p class="font-bold text-gray-800 mb-2">設計図（クラス）</p>
                <p class="text-sm text-gray-600 font-mono">class Slime { ... }</p>
                <p class="text-xs text-gray-400 mt-2">※これ自体は動かない</p>
            </div>
            <div class="bg-white border-2 border-indigo-200 p-5 rounded-lg shadow-sm">
                <p class="font-bold text-indigo-800 mb-2">実体（インスタンス）</p>
                <div class="flex gap-2">
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs">スライムA</span>
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs">スライムB</span>
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs">スライムC</span>
                </div>
                <p class="text-xs text-gray-400 mt-2">※それぞれが個別にHPを持っている</p>
            </div>
        </div>
        
    </section>

    <section class="space-y-6">
        <h4 class="text-2xl font-bold text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            「オブジェクト」と「インスタンス」の違い
        </h4>
        <p class="text-gray-700 leading-relaxed">
            学習を進めると「オブジェクト」と「インスタンス」という言葉が混ざって使われることがあります。基本的には、<strong>インスタンスはオブジェクトの中に含まれる概念</strong>です。
        </p>
        <div class="bg-gray-50 p-6 rounded-xl text-gray-700 text-sm">
            <p><strong>オブジェクト：</strong> もっとも包括的な「モノ」という概念</p>
            <p class="mt-2"><strong>インスタンス：</strong> 「あるクラスから生成された実体」という、より具体的な呼び方</p>
        </div>
        <p class="text-gray-700 italic">
            以前学んだ「関数の定義と呼び出し」の関係に似ています。「クラスを作る ＝ 定義」、「インスタンスを作る ＝ 実行」と考えるとイメージしやすいでしょう。
        </p>
    </section>

    <section class="bg-yellow-50 p-8 rounded-2xl border border-yellow-100 space-y-4">
        <h4 class="text-xl font-bold text-yellow-900 flex items-center gap-2">
             💡 知識の引き出し：プロトタイプベース
        </h4>
        <p class="text-sm text-yellow-800 leading-relaxed">
            オブジェクト指向には、PHPのような「クラスベース」の他に<strong>「プロトタイプベース」</strong>が存在します（例：JavaScript）。
        </p>
        <p class="text-sm text-yellow-800 leading-relaxed">
            プロトタイプとは「原型（見本）」という意味です。こちらには設計図が存在せず、<strong>「見本となるオブジェクトをコピー（複製）して新しい実体を作る」</strong>という流れでプログラミングを行います。
        </p>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-3 rounded border border-yellow-200">
                <span class="font-bold text-xs text-gray-500 uppercase">Class-based (PHP)</span><br>
                <span class="text-sm">設計図 → 実体</span>
            </div>
            <div class="bg-white p-3 rounded border border-yellow-200">
                <span class="font-bold text-xs text-gray-500 uppercase">Prototype-based (JS)</span><br>
                <span class="text-sm">見本 → 複製</span>
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}