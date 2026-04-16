<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson4_8Seeder extends Seeder
{
    public function run(): void
    {
        $lesson4 = Lesson::where('title', 'HTMLチュートリアル')->first();

        if (!$lesson4) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson4->id,
                'sort_order' => 8
            ],
            [
                'title' => 'HTML完成',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-6">
        <p class="text-lg leading-relaxed">
            HTMLのチュートリアルは以上です。<br>
            最後に、Webブラウザでの表示が下記のようになっているか確認しておきましょう。
        </p>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 text-center">
            <a href="/images/Lesson4-24.png" target="_blank" class="block hover:opacity-85 transition-opacity duration-200">
                <img src="/images/Lesson4-24.png" 
                     alt="完成したHTML全体の表示確認" 
                     class="max-w-full h-auto mx-auto rounded shadow-md border border-gray-300"
                     onerror="this.src=\'https://placehold.jp/20/6A73A6/ffffff/800x1200.png?text=Lesson4-24.png%0A(完成したHTMLの全体像)\'">
            </a>
            <p class="text-xs text-gray-500 mt-4 flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                画像をクリックすると新規タブで大きな画像が開きます
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            kitchen.html 全体のコード
        </h4>
        <p class="text-gray-700">
            また、下記にここまでの内容の <code>kitchen.html</code> 全体のコードを掲載しますので、併せて確認してみてください。
        </p>

        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg border border-gray-600">
            <div class="bg-gray-700 text-gray-300 text-xs px-4 py-2 border-b border-gray-600 flex justify-between items-center">
                <span>kitchen.html</span>
                <span class="bg-green-600 text-white px-2 py-0.5 rounded text-[10px] font-bold tracking-wider">完成版</span>
            </div>
            <pre class="p-4 text-sm text-gray-300 font-mono overflow-x-auto max-h-[600px] overflow-y-auto"><code>&lt;!DOCTYPE html&gt;&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;TechAcademy KITCHEN&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;!--ここからヘッダー--&gt;
        &lt;header&gt;
            &lt;h1&gt;&lt;a href="kitchen.html"&gt;&lt;img src="images_kitchen/logo.png" alt="TechAcademy KITCHEN"&gt;&lt;/a&gt;&lt;/h1&gt;
            &lt;nav id="global_navi"&gt;
                &lt;ul&gt;
                    &lt;li class="current"&gt;&lt;a href="kitchen.html"&gt;HOME&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="course.html"&gt;講座案内&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="lesson.html"&gt;レッスン&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="gallery.html"&gt;ギャラリー&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="access.html"&gt;アクセス&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="contact.html"&gt;お問い合わせ&lt;/a&gt;&lt;/li&gt;
                &lt;/ul&gt;
            &lt;/nav&gt;
        &lt;/header&gt;
        &lt;!--ヘッダーここまで--&gt;
        &lt;!--ここからメインビジュアル画像--&gt;
        &lt;div id="main_visual"&gt;
            &lt;img src="images_kitchen/main_visual.jpg" alt="健やかな健康と豊かな食生活をはじめる"&gt;
        &lt;/div&gt;
        &lt;!--メインビジュアル画像ここまで--&gt;
        &lt;!--wrapperー--&gt;
        &lt;div id="wrapper"&gt;
            &lt;!--ここからメイン--&gt;
            &lt;div id="main"&gt;
                &lt;section&gt;
                    &lt;h2&gt;TechAcademy KITCHENについて&lt;/h2&gt;
                    &lt;section&gt;
                        &lt;h3&gt;食卓を豊かにしたい&lt;/h3&gt;
                        &lt;div class="point"&gt;
                            &lt;p&gt;
                                健やかな人生は健やかな食生活から&lt;br&gt;
                                上手に料理が作れるだけでなく、食べる人の人生をも健やかにしていきたい。&lt;br&gt;
                                それが、TechAcademy KITCHENの思いです。
                            &lt;/p&gt;
                            &lt;figure&gt;
                                &lt;img src="images_kitchen/photo01.jpg" alt="TechAcademy KITCHENについて1"&gt;
                                &lt;figcaption&gt;健康バランスを考えた食事&lt;/figcaption&gt;
                            &lt;/figure&gt;
                        &lt;/div&gt;
                    &lt;/section&gt;
                    &lt;section&gt;
                        &lt;h3&gt;豊かな食生活を応援したい&lt;/h3&gt;
                        &lt;div class="point"&gt;
                            &lt;p&gt;
                                食は文化の数だけあります。&lt;br&gt;
                                食生活が豊かだと、人生をも豊かになります。 &lt;br&gt;
                                多彩なカテゴリの料理を提供し、料理をする人、食べる人の生活も豊かにしていきたいと思っております。
                            &lt;/p&gt;
                            &lt;figure&gt;
                                &lt;img src="images_kitchen/photo02.jpg" alt="TechAcademy KITCHENについて2"&gt;
                                &lt;figcaption&gt;完成間近の作品&lt;/figcaption&gt;
                            &lt;/figure&gt;
                        &lt;/div&gt;
                    &lt;/section&gt;
                &lt;/section&gt;
                &lt;section id="news"&gt;
                    &lt;h2&gt;お知らせ&lt;/h2&gt;
                    &lt;ul&gt;
                        &lt;li&gt;
                            &lt;span&gt;2018/09/01&lt;/span&gt;
                            &lt;a href="course.html"&gt;講座案内を更新しました&lt;/a&gt;
                        &lt;/li&gt;
                        &lt;li&gt;
                            &lt;span&gt;2018/08/31&lt;/span&gt;
                            &lt;a href="gallery.html"&gt;写真を追加しました&lt;/a&gt;
                        &lt;/li&gt;
                        &lt;li&gt;
                            &lt;span&gt;2018/08/24&lt;/span&gt;
                            &lt;a href="course.html"&gt;講座案内を更新しました&lt;/a&gt;
                        &lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/section&gt;
            &lt;/div&gt;
            &lt;!--メインここまで--&gt;
            &lt;!--ここからサイド--&gt;
            &lt;aside id="sidebar"&gt;
                &lt;section id="side_banner"&gt;
                    &lt;h2&gt;関連リンク&lt;/h2&gt;
                    &lt;ul&gt;
                        &lt;li&gt;
                            &lt;a href="https://techacademy.jp/magazine/" target="_blank"&gt;&lt;img src="images_kitchen/banner01.jpg" alt="ブログ"&gt;&lt;/a&gt;
                            &lt;p&gt;毎日季節の野菜を取り入れたレシピを公開中。&lt;/p&gt;
                        &lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/section&gt;
            &lt;/aside&gt;
            &lt;!--サイドここまで--&gt;
        &lt;/div&gt;
        &lt;!--wrapperここまで--&gt;
        &lt;!--ここからフッター--&gt;
        &lt;footer&gt;
            &lt;div id="footer_navi"&gt;
                &lt;ul&gt;
                    &lt;li&gt;&lt;a href="kitchen.html"&gt;HOME&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="course.html"&gt;講座案内&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="lesson.html"&gt;レッスン&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="gallery.html"&gt;ギャラリー&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="access.html"&gt;アクセス&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="contact.html"&gt;お問い合わせ&lt;/a&gt;&lt;/li&gt;
                &lt;/ul&gt;
            &lt;/div&gt;
            &lt;small&gt;&amp;copy; 2018 TechAcademy KITCHEN.&lt;/small&gt;
        &lt;/footer&gt;
        &lt;!--フッターここまで--&gt;
    &lt;/body&gt;&lt;/html&gt;</code></pre>
        </div>
    </section>
</div>'
            ]
        );
    }
}