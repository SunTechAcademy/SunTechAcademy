<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson4_2Seeder extends Seeder
{
    public function run(): void
    {
        $lesson4 = Lesson::where('title', 'HTMLチュートリアル')->first();

        if (!$lesson4) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson4->id,
                'sort_order' => 2
            ],
            [
                'title' => '制作するWebページの確認',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section>
        <p class="text-lg leading-relaxed">
            本レッスンを通して下記のWebページを作成してみます。
        </p>
        <p class="mt-4 text-gray-700">
            Webページの上部に、色々なメニュー（講座案内やレッスン、ギャラリーなど）が表示されていますが、今回は <strong>トップページ（HOME）</strong> のみの作成になります。
        </p>
    </section>

    <section class="space-y-4">
        <h4 class="font-bold text-lg text-gray-800 border-l-4 border-[#6A73A6] pl-3">
            最終的な完成イメージ（CSS適用後）
        </h4>
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
            <a href="/images/Lesson4-1.png" target="_blank" class="block hover:opacity-85 transition-opacity duration-200">
                <img src="/images/Lesson4-1.png" 
                     alt="完成予定のWebページ" 
                     class="max-w-full h-auto mx-auto rounded shadow-md border border-gray-300"
                     onerror="this.src=\'https://placehold.jp/24/6A73A6/ffffff/800x450.png?text=Lesson4-1.png%0A(最終的な完成イメージ：デザイン適用後)\'">
            </a>
            <p class="text-xs text-gray-500 mt-3 flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                画像をクリックすると新規タブで大きな画像が開きます
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 mb-2">
            <p class="text-yellow-800 text-sm font-bold">
                ⚠️ ただし、上記WebページはCSS（デザイン）が適用された状態です。
            </p>
            <p class="text-yellow-700 text-sm mt-1">
                まずは下記のような <strong>HTML文書（骨組みのみ）</strong> を作成します。
            </p>
        </div>
        
        <h4 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">
            今回作成する状態（HTMLのみ）
        </h4>
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
            <a href="/images/Lesson4-2.png" target="_blank" class="block hover:opacity-85 transition-opacity duration-200">
                <img src="/images/Lesson4-2.png" 
                     alt="作成するHTML文書" 
                     class="max-w-full h-auto mx-auto rounded shadow-md border border-gray-300"
                     onerror="this.src=\'https://placehold.jp/24/6A73A6/ffffff/800x600.png?text=Lesson4-2.png%0A(今回作成するHTML：デザイン適用前)\'">
            </a>
            <p class="text-xs text-gray-500 mt-3 flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                画像をクリックすると新規タブで大きな画像が開きます
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}