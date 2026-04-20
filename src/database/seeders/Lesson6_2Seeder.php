<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson6_2Seeder extends Seeder
{
    public function run(): void
    {
        $lesson5 = Lesson::where('title', 'CSSチュートリアル')->first();

        if (!$lesson5) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson5->id,
                'sort_order' => 2
            ],
            [
                'title' => '制作するWebページの確認',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            あらためて、作成した <code>kitchen.html</code> を見てください。<br>
            色々とメニュー（講座案内やレッスン、ギャラリーなど）が表示されていますが、今回は <strong>トップページ（HOME）</strong> のみの作成になります。
        </p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <section class="space-y-4">
            <h4 class="font-bold text-lg text-gray-700 border-l-4 border-gray-400 pl-3">
                HTMLのみの現状
            </h4>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                <a href="/images/Lesson4-26.png" target="_blank" class="block hover:opacity-85 transition-opacity duration-200">
                    <img src="/images/Lesson4-26.png" 
                         alt="HTMLのみの現状" 
                         class="max-w-full h-auto mx-auto rounded shadow-sm border border-gray-300"
                         onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/400x500.png?text=Lesson4-26.png%0A(HTMLのみの現状)\'">
                </a>
                <p class="text-xs text-gray-500 mt-2 italic">クリックすると新規タブで大きな画像が開きます</p>
            </div>
        </section>

        <section class="space-y-4">
            <h4 class="font-bold text-lg text-[#6A73A6] border-l-4 border-[#6A73A6] pl-3">
                CSS完成版（ゴール）
            </h4>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                <a href="/images/Lesson4-27.png" target="_blank" class="block hover:opacity-85 transition-opacity duration-200">
                    <img src="/images/Lesson4-27.png" 
                         alt="CSS完成版" 
                         class="max-w-full h-auto mx-auto rounded shadow-sm border border-gray-300"
                         onerror="this.src=\'https://placehold.jp/16/6A73A6/ffffff/400x500.png?text=Lesson4-27.png%0A(CSS完成版)\'">
                </a>
                <p class="text-xs text-gray-500 mt-2 italic">クリックすると新規タブで大きな画像が開きます</p>
            </div>
        </section>
    </div>

    <section class="mt-8 p-6 bg-blue-50 rounded-xl border border-blue-100">
        <p class="text-blue-900 leading-relaxed">
            これまでは「ただ要素を並べただけ」だったページが、CSSを適用することでプロフェッショナルなWebサイトへと生まれ変わります。<br>
            次のチャプターから、実際にCSSファイルを準備してスタイリングを開始しましょう！
        </p>
    </section>
</div>'
            ]
        );
    }
}