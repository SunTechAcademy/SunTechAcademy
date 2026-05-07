<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson8_2Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson8（PHPその1）を取得
        $lesson8 = Lesson::where('title', 'PHPその1')->first();

        if (!$lesson8) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson8->id,
                'sort_order' => 2
            ],
            [
                'title' => 'PHPとは',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            繰り返し説明しますが、<strong>PHPはプログラミング言語です。</strong><br>
            HTMLは文書を書くためのマークアップ言語、CSSはデザインを整えるスタイルシート言語ですので、PHPとは役割がまったく違います。
        </p>
        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
            <p class="text-gray-700">
                PHPはコンピュータに命令するための言語で、コンピュータへの<strong>命令書（プログラム）</strong>を作成します。これこそがプログラミングです。
            </p>
        </div>

        <h4 class="font-bold text-xl text-gray-800 mt-8">PHPの成り立ち</h4>
        <p class="text-gray-700">
            PHPは1994年にRasmus Lerdorfによって生み出されました。もともと「Personal Home Page Tools」という名称だったのを「PHP Tools」と略して呼んでいたことから、正式に「PHP」という名前になったと言われています。
        </p>
        <p class="text-gray-700">
            当初は簡易的なツールでしたが、現在は大規模なWebサービスにも耐えうる強力な言語へと成長しました。Web制作に特化して作られているため、非常に学習しやすいのが特徴です。
        </p>
        <a href="https://www.php.net/" target="_blank" class="text-blue-600 hover:underline text-sm flex items-center gap-1">
            参考：PHP公式サイト
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
        </a>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            PHPのWeb上での役割
        </h4>
        <p class="text-gray-700">
            HTML/CSSだけでWebページは作れますが、<strong>「ユーザの入力に反応する」</strong>ことはできません。
        </p>

        

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h5 class="font-bold text-gray-800 mb-3">例：コメント投稿機能</h5>
            <p class="text-sm text-gray-600 mb-4">
                入力フォームにコメントを書いて「送信」しても、HTMLだけではデータを保存したり画面に反映したりできません。
                ここでPHPの出番です。プログラムが人間の代わりにデータを受け取り、HTMLを自動的に更新します。
            </p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-gray-300">
                <span class="text-gray-500">&lt;div class="user_comment"&gt;</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;<span class="text-yellow-400">（ここにコメントを受け取ったら表示するプログラムを書く）</span>&lt;/p&gt;<br>
                <span class="text-gray-500">&lt;/div&gt;</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <strong class="text-gray-800 block mb-1 text-lg">静的なWebページ</strong>
                <p class="text-sm text-gray-600">いつ見ても、誰が見ても内容が同じページ。</p>
            </div>
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <strong class="text-blue-800 block mb-1 text-lg">動的なWebページ</strong>
                <p class="text-sm text-blue-700">ユーザのアクションや時間によって内容が書き換わるページ。PHPが得意とする分野です。</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            PHPで表示内容を変える
        </h4>
        <p class="text-gray-700">
            HTMLだけだと「こんにちは、太郎さん」と固定されますが、PHPを使えばアクセスした人の名前に合わせて挨拶を出し分けることができます。
        </p>

        

        <div class="bg-gray-800 rounded-xl p-6 text-white font-mono text-sm overflow-x-auto">
            <div class="text-gray-500 mb-2">// 条件によって出し分けるイメージ</div>
            <p>&lt;p&gt;</p>
            <p class="pl-4 text-yellow-300">（時間帯によって「おはよう」「こんにちは」を判定）</p>
            <p class="pl-4 text-green-400">（受け取ったユーザ名を表示）</p>
            <p class="pl-4">さん。</p>
            <p>&lt;/p&gt;</p>
        </div>

        <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4">
            <p class="text-sm text-indigo-900">
                Webプログラミングを行うことで、HTMLは「データを表示するための単なる<strong>入れ物（雛形）</strong>」になります。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            なぜPHPを選ぶか
        </h4>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1 space-y-3">
                <h5 class="font-bold text-lg text-gray-800">1. Webのために生まれた言語</h5>
                <p class="text-sm text-gray-700 leading-relaxed">
                    誕生当初から「動的なWebページ」を作るために設計されています。他の汎用言語よりもWeb制作の機能が使いやすく、学習コストが低いのがメリットです。
                </p>
            </div>
            <div class="flex-1 space-y-3">
                <h5 class="font-bold text-lg text-gray-800">2. 圧倒的な実績と普及率</h5>
                <p class="text-sm text-gray-700 leading-relaxed">
                    FacebookやYahoo! JAPANなど、世界的なサービスでも採用されています。また、世界中のWebサイトの多くを支える<strong>WordPress</strong>もPHPで作られています。
                </p>
            </div>
        </div>

        <div class="mt-8 bg-gray-50 rounded-2xl p-8 border border-gray-200 relative overflow-hidden">
            <div class="relative z-10">
                <h5 class="text-indigo-900 font-bold text-xl mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    コラム：CMSとは何か
                </h5>
                <p class="text-gray-700 text-sm leading-relaxed mb-4">
                    CMSは<strong>「Content Management System（コンテンツ管理システム）」</strong>の略称です。HTML/CSSの専門知識がなくても、管理画面から記事を投稿するだけでWebサイトを構築・運営できるシステムです。
                </p>
                <p class="text-gray-700 text-sm leading-relaxed">
                    中でも<strong>WordPress</strong>は、ソースコードが公開されている「オープンソースソフトウェア」として有名で、PHPを学ぶことでこのWordPressの機能を自分好みにカスタマイズできるようになります。
                </p>
            </div>
            <div class="absolute right-[-20px] top-[-20px] opacity-5">
                <svg width="200" height="200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10zm-1-15h2v6h-2V7zm0 8h2v2h-2v-2z"/></svg>
            </div>
        </div>
    </section>
</div>'
            ]
        );
    }
}