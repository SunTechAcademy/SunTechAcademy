<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson2_2Seeder extends Seeder
{
    public function run(): void
    {
        // 親となるLesson 2を取得
        $lesson2 = Lesson::where('title', 'Web開発のために学ぶこと')->first();

        if (!$lesson2) return;

        // Chapter 3: Webアプリケーション開発に必要な知識
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson2->id,
                'sort_order' => 3 
            ],
            [
                'title' => 'Webアプリケーション開発に必要な知識',
                'is_assignment' => 1,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg">たとえば、以下のようなサイトが存在し、このサイトでは「新規メッセージの投稿」フォームから書き込んで送信した内容をトップページで一覧表示する仕組みになっているとします。</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <img src="/images/Lesson2-6.png" alt="メッセージ一覧" class="rounded border shadow-sm">
            <img src="/images/Lesson2-7.png" alt="投稿フォーム" class="rounded border shadow-sm">
        </div>
        <p>このようなWebアプリケーションを開発してWebに公開するためには、どのような知識が必要になるのでしょうか。</p>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">1</span>
            HTMLとCSS
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>Webブラウザが表示している画面の正体は、一定のルールに基づいて記述されたテキスト文書です。Chromeなどで「ページのソースを表示」を選択すると、その中身を確認できます。</p>
            <div class="flex justify-center gap-4">
                <img src="/images/Lesson2-8.png" alt="ソースを表示" class="max-w-xs w-full h-auto">
                <img src="/images/Lesson2-9.png" alt="HTMLソース" class="max-w-xs w-full h-auto">
            </div>
            <p>この < と > で囲まれた「タグ」を用いた文書を<strong>HTML</strong>と呼びます。また、これに色や配置などのデザインを与えるのが<strong>CSS</strong>です。</p>
            <img src="/images/Lesson2-10.png" alt="CSS例" class="mx-auto rounded border">
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">2</span>
            PHPとLaravel
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>掲示板のように、アクセスするたびに内容が「動的に」変わるサイトを作るには、<strong>アプリケーションサーバソフトウェア</strong>が必要です。本カリキュラムではプログラミング言語<strong>PHP</strong>を使用します。</p>
            <div class="flex justify-center my-6">
                <img src="/images/Lesson2-11.png" alt="PHPの役割" class="max-w-md w-full h-auto">
            </div>
            <p>また、すべての機能をゼロから作るのは大変なため、<strong>Laravel</strong>という「フレームワーク（便利な道具箱）」を使って効率的に開発を行います。</p>
            <img src="/images/Lesson2-12.png" alt="Laravelイメージ" class="mx-auto">
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">3</span>
            MySQL
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>投稿されたメッセージを保存しておく場所が「データベース」です。世界中で広く使われている<strong>MySQL</strong>というソフトウェアを利用します。</p>
            <p>データベースと対話するには<strong>SQL</strong>という専用の言語を使います。PHP（Laravel）からSQLでMySQLに命令を出すことで、データの保存や取得が可能になります。</p>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">4</span>
            GitとGitHub
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p><strong>Git</strong>は、プログラムの変更履歴を記録する「バージョン管理ツール」です。失敗しても以前の状態にすぐ戻せる、いわば「セーブポイント」のような役割を果たします。</p>
            <p><strong>GitHub</strong>は、その履歴をオンライン上に保存し、他者と共有したりバックアップしたりするためのWebサービスです。</p>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">5</span>
            ターミナル
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>プログラミングの世界では、マウスでアイコンをクリックする代わりに、文字を入力してコンピュータに命令を出す「黒い画面」をよく使います。これを<strong>ターミナル</strong>（またはコマンドライン）と呼びます。</p>
            <p>Webアプリケーションの開発では、ライブラリ（便利な部品）のインストール、サーバの起動、Laravel特有のコマンド実行など、多くの作業をこのターミナル経由で行います。</p>
            <div class="bg-gray-800 text-white p-4 rounded-lg font-mono text-sm shadow-inner">
                <span class="text-green-400">$</span> php artisan serve<br>
                <span class="text-gray-400">Starting Laravel development server: http://127.0.0.1:8000</span>
            </div>
            <p>最初は難しく感じるかもしれませんが、エンジニアにとってターミナルは「コンピュータを最も効率よく、正確に操るためのコックピット」のようなものです。本カリキュラムを通じて、少しずつ操作に慣れていきましょう。</p>
        </div>
    </section>
</div>'
            ]
        );
    }
}