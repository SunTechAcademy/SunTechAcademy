<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson2Seeder extends Seeder
{
    public function run(): void
    {
        // 既存のコースを取得（なければ作成）
        $course = Course::firstOrCreate([
            'title' => 'エンジニア基礎教育'
        ], [
            'description' => '実務で役立つ知識とスキルを身につける初級コース'
        ]);

        // Lesson 2 の作成
        $lesson2 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Web開発のために学ぶこと',
            'estimated_time' => 120,
            'sort_order' => 2,
        ]);

        // 大項目：Webアプリケーションとは何か を1つのChapterとして作成
        Chapter::create([
            'lesson_id' => $lesson2->id,
            'title' => 'Webアプリケーションとは何か',
            'content' => '
            <div class="space-y-10">
                <p class="text-lg">まずは、Webアプリケーションとはどういうものかについて、まとめます。</p>

                <section class="space-y-4">
                    <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
                        <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">1</span>
                        Webアプリケーションを使うにはWebブラウザが必要
                    </h4>
                    <div class="space-y-4 leading-relaxed">
                        <p>X（旧Twitter）やFacebookを思い出してください。これらをPCで利用する場合、<strong>Webブラウザ</strong>が必要です。</p>
                        <p>Webブラウザは、皆さんが普段使用するスマートフォンやPCに、必ず最初からインストールされています。たとえばWindowsならEdge、MacやiPhoneならSafariです。もちろん、ChromeやFirefoxなどの好きなブラウザをインストールして使うこともできます。</p>
                        <p>Webブラウザを使うだけで、誰もが手軽にWeb上のコンテンツへアクセスできます。「Windowsでしか利用できない」といったことは、ほとんどありません。</p>
                        <p class="bg-blue-50 p-4 border-l-4 border-blue-400 font-bold">つまり、Web上でアプリケーションを公開すれば、世界中の誰もが、あなたの作ったアプリケーションを手軽に利用できるようになるのです。</p>
                    </div>
                </section>

                <section class="space-y-4">
                    <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
                        <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">2</span>
                        Webとは何か
                    </h4>
                    <div class="space-y-4 leading-relaxed">
                        <p>そもそも<strong>Web（ウェブ）</strong>とは何でしょうか。</p>
                        <p>Webという単語は、元々「クモの巣」という意味を持ちます。</p>
                        <p>「Webアプリケーション」や「Web上のコンテンツ」と言う場合の「Web」は、通常<strong>ワールドワイドウェブ（World Wide Web：WWW）</strong>の意味合いで用いられます。World Wide Webのイメージは、「情報が世界中（World Wide）にクモの巣（Web）のように張り巡らされている状態」です。</p>
                        <p>また、情報を情報をつなぐものを<strong>ハイパーリンク</strong>といいます。ワールドワイドウェブを実現するために使われているのがインターネットです。</p>
                        <div class="flex justify-center my-8">
                            <img src="/images/Lesson2-1.svg" alt="Lesson2-1" class="max-w-md w-full h-auto shadow-sm rounded border">
                        </div>
                        <p class="bg-gray-50 p-3 rounded text-center text-sm italic text-gray-600">簡単に言うと、Webは「インターネット上にあるモノ」だという認識で構いません。</p>
                    </div>
                </section>

                <section class="space-y-4">
                    <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
                        <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">3</span>
                        インターネットとは何か
                    </h4>
                    <div class="space-y-4 leading-relaxed">
                        <p>では、インターネットは結局のところ、どのようなものなのでしょうか。現在多くの人達にとって、インターネットは生活に不可欠な存在となっています。</p>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 bg-gray-50 p-6 rounded-lg list-none text-gray-700">
                            <li class="flex items-center gap-2">● ブログを読む</li>
                            <li class="flex items-center gap-2">● Webサービスを使ったビジネスをする</li>
                            <li class="flex items-center gap-2">● 検索サイトやニュースサイトで情報を集める</li>
                            <li class="flex items-center gap-2">● 友達とチャットをする</li>
                            <li class="flex items-center gap-2">● SNSに写真を投稿する</li>
                            <li class="flex items-center gap-2 text-gray-400">● etc・・・</li>
                        </ul>
                        <p>国内だけに留まらず、海外のローカル情報でさえも探し出すことができます。</p>
                        <div class="flex justify-center my-8">
                            <img src="/images/Lesson2-2.svg" alt="Lesson2-2" class="max-w-md w-full h-auto shadow-sm rounded border">
                        </div>
                        <p>インターネットは、「ネットワーク間のネットワーク」という意味として名づけられました。ネットワークとネットワークが繋がったことで、今やインターネットは全世界を繋げる巨大なネットワークとなっています。</p>
                        <p>ここでのネットワークは、一種の組織だと思ってください。コンピュータとコンピュータが繋がれば、それはネットワーク（組織）になります。</p>
                        <div class="flex justify-center my-8">
                            <img src="/images/Lesson2-3.svg" alt="Lesson2-3" class="max-w-md w-full h-auto shadow-sm rounded border">
                        </div>
                        <p>家庭内や会社内でコンピュータ同士を繋げることでネットワーク組織を構成し、通信事業者が家庭や会社のネットワーク組織を “さらに” 大きなネットワーク組織としてまとめあげます。最後には、通信事業者同士を繋げることで、現在のインターネットが構成されました。</p>
                        <p>インターネットに繋がっているコンピュータは、すべてのコンピュータ同士が物理的に繋がっています。コンピュータからコンピュータまで、どれだけ長い距離（たとえば海外）であろうと、なんらかの形で繋がっています。</p>
                        <p class="font-bold underline decoration-[#6A73A6] decoration-2">皆さんがWebサイトを閲覧したりWebアプリケーションを利用できたりするのは、インターネットに繋がっているコンピュータが自分のWebサイトやWebアプリケーションを公開しているからです。</p>
                    </div>
                </section>

                <section class="space-y-4">
                    <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
                        <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">4</span>
                        Webアプリケーションを作るとはどういうことか
                    </h4>
                    <div class="leading-relaxed bg-blue-50 p-6 rounded-lg">
                        <p>本コースで学習するWebアプリケーション開発のカリキュラムは、<strong>誰もがWebブラウザで利用できるアプリケーションをPHPおよびLaravelで構築し、完成したものをWebへ公開する</strong>ことを目指してもらうために用意しています。</p>
                    </div>
                </section>
            </div>',
            'is_assignment' => 1,
            'sort_order' => 1,
        ]);
    }
}