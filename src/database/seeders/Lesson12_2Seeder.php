<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 12 (MySQL) を取得
        $lesson12 = Lesson::where('title', 'MySQL')->first();

        if (!$lesson12) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson12->id,
                'sort_order' => 2,
            ],
            [
                'title' => 'データベースとは',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">データベースとは</h2>
        <p class="text-gray-700 leading-relaxed mb-4">
            データベースは、<strong>たくさんのデータを一元管理し、データの保存、取得することに特化したソフトウェア（ミドルウェア）</strong>です。
        </p>
        <p class="text-gray-700 leading-relaxed mb-4">
            データと言っても、基本的にはテキストデータが対象で、画像や動画の扱いにはあまり向きません。また、データベースは、<strong>DB</strong>とも呼びます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データを永続的に保存する</h3>
        <p class="text-gray-700 leading-relaxed">
            データベースは<strong>データを永続的に保存</strong>するのに適しています。データを永続的に保存する方法として、テキストファイルにデータを書き込む方法もありますが、効率的とは言えません。ここでは、ファイル保存よりもデータベースが優れている理由を3つ挙げてみましょう。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8">
            <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm">
                <div class="text-blue-600 font-bold text-lg mb-2">01. 実行速度</div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    「ファイルを開いてデータを取得し、ファイルを閉じる」という方法は、実行速度がとても遅いです。
                </p>
            </div>
            <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm">
                <div class="text-blue-600 font-bold text-lg mb-2">02. フォーマット</div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    ファイルには何のデータをどのように保存するかが決まっていないため、フォーマットを定めたうえで、それを遵守することが必要です。
                </p>
            </div>
            <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm">
                <div class="text-blue-600 font-bold text-lg mb-2">03. 操作の容易性</div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    データ取得の方法として簡単に使えるSQLがあるのに、ファイルの場合、ファイルを操作する処理を、わざわざプログラミングする必要があります。
                </p>
            </div>
        </div>

        <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded text-sm text-amber-900">
            <strong>補足：</strong> ファイル保存でも良い場合は、あらかじめ定義された以上にはデータが増減せず、かつデータ量が少ないようなケースに限られます。
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-left">アプリケーションとデータベース</h3>
        <p class="text-gray-700 leading-relaxed text-left">
            アプリケーションにとって、データベースは欠かせない存在です。<strong>アプリケーションはデータを処理できますが、保存ができないからです。</strong>
        </p>
        
        <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100">
            <h4 class="font-bold text-gray-800 mb-4 text-left">データベースが管理しているデータの例：</h4>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <li class="flex items-center gap-3 bg-white p-4 rounded-lg shadow-sm">
                    <span class="text-green-500 font-bold">✔</span>
                    <span class="text-gray-700">ユーザ登録情報</span>
                </li>
                <li class="flex items-center gap-3 bg-white p-4 rounded-lg shadow-sm">
                    <span class="text-green-500 font-bold">✔</span>
                    <span class="text-gray-700">メッセージや記事の投稿内容</span>
                </li>
                <li class="flex items-center gap-3 bg-white p-4 rounded-lg shadow-sm">
                    <span class="text-green-500 font-bold">✔</span>
                    <span class="text-gray-700">SNSのフォロー・フォロワー関係</span>
                </li>
                <li class="flex items-center gap-3 bg-white p-4 rounded-lg shadow-sm">
                    <span class="text-green-500 font-bold">✔</span>
                    <span class="text-gray-700">友達リストやグループ情報</span>
                </li>
            </ul>
        </div>

        <p class="text-gray-700 leading-relaxed mt-4 text-left">
            私たちが日常的に利用しているX（旧Twitter）やFacebookなどのSNSでも、これらすべての膨大なデータは、すべてデータベースが管理しています。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}