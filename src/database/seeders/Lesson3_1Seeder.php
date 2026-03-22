<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3_1Seeder extends Seeder
{
    public function run(): void
    {
        // 親となるLesson 3を取得
        $lesson3 = Lesson::where('title', 'HTML基礎')->first();

        if (!$lesson3) return;

        // Chapter 2: Webページが表示される仕組み
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson3->id,
                'sort_order' => 2 
            ],
            [
                'title' => 'Webページが表示される仕組み',
                'is_assignment' => 1,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            Webサイトは、Webページをひとまとまりにして公開したWebページの集まりのことです。Webページが表示される仕組みについて確認します。
        </p>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">1</span>
            Webブラウザについて
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>Webブラウザとは、Webサイトを閲覧するためのアプリケーションです。単に<strong>ブラウザ</strong>と呼ばれています。</p>
            <div class="flex flex-wrap gap-3">
                <span class="px-4 py-2 bg-white border border-gray-200 rounded-full shadow-sm text-sm">Google Chrome</span>
                <span class="px-4 py-2 bg-white border border-gray-200 rounded-full shadow-sm text-sm">Mozilla Firefox</span>
                <span class="px-4 py-2 bg-white border border-gray-200 rounded-full shadow-sm text-sm">Microsoft Edge</span>
                <span class="px-4 py-2 bg-white border border-gray-200 rounded-full shadow-sm text-sm">Apple Safari</span>
            </div>
            <p>
                どのWebブラウザも、Webサイトを閲覧することがもっとも重要な機能です。各ブラウザは、より高速な表示や独自機能を開発することで優位性を保とうとしています。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">2</span>
            Webページの構成
        </h4>
        <div class="space-y-6 leading-relaxed">
            <p>Webページは、以下の4つのリソース（構成要素）でできています。</p>
            
            <div class="space-y-4">
                <div class="border-l-4 border-orange-400 pl-4">
                    <p class="font-bold">HTML</p>
                    <p class="text-sm">Webページにおける文書（情報のまとめ役）です。表示の起点となり、CSSやJavaScriptを統合します。</p>
                </div>
                <div class="border-l-4 border-blue-400 pl-4">
                    <p class="font-bold">CSS</p>
                    <p class="text-sm">Webページにおけるデザイン（見た目を整える役）です。レイアウト、色、背景、フォントなどを指定します。</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl">
                <div class="text-center">
                    <img src="/images/Lesson2-14.png" alt="HTMLのみ" class="rounded border mb-2 mx-auto">
                    <p class="text-xs text-gray-500">↑HTML文書だけのWebページ</p>
                </div>
                <div class="text-center">
                    <img src="/images/Lesson2-15.png" alt="CSS適用後" class="rounded border mb-2 mx-auto shadow-md">
                    <p class="text-xs text-gray-500">↑HTML文書にCSSを適用したWebページ</p>
                </div>
            </div>
            <p class="text-sm italic">
                HTMLだけのページは単なる箇条書きですが、CSSを適用することで色がつき、ボタンのような使いやすいデザインに変化します。
            </p>

            <div class="space-y-4">
                <div class="border-l-4 border-yellow-400 pl-4">
                    <p class="font-bold">JavaScript</p>
                    <p class="text-sm">ブラウザ上で動くプログラミング言語です。クリックに反応してメニューを開閉するなど、動的な操作を可能にします。</p>
                </div>
                <div class="border-l-4 border-gray-400 pl-4">
                    <p class="font-bold">そのほかのリソースファイル</p>
                    <p class="text-sm">画像、動画、フォント、音声などです。HTML内に埋め込んで表示します。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">3</span>
            Webページの表示
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>Webブラウザは、以下のステップでページを表示します。</p>
            <ol class="list-decimal ml-6 space-y-2 text-sm">
                <li>URLへアクセスし、リソース（HTML等）を取得する</li>
                <li>取得したHTMLやCSSを解析（スキャン）する</li>
                <li>解析結果に基づき、色をつけたり配置を調整して表示する</li>
            </ol>
            
            <div class="mt-8 space-y-4 bg-gray-900 p-6 rounded-lg shadow-inner">
                <p class="text-white text-sm font-bold">【実例】Webページの「本来の姿」</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-center">
                    <div>
                        <img src="/images/Lesson2-16.png" alt="ブラウザ表示" class="rounded border border-gray-700 mx-auto mb-2">
                        <span class="text-[10px] text-gray-400">ブラウザから見たYahoo! JAPAN</span>
                    </div>
                    <div>
                        <img src="/images/Lesson2-17.png" alt="HTMLソース" class="rounded border border-gray-700 mx-auto mb-2">
                        <span class="text-[10px] text-gray-400">Yahoo! JAPANの本来の姿（HTML）</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>'
            ]
        );
    }
}