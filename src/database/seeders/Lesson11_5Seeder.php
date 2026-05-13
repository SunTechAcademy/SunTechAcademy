<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson11_5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 11 (PHPその4) を取得
        $lesson11 = Lesson::where('title', 'PHPその4')->first();

        if (!$lesson11) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson11->id,
                'sort_order' => 5,
            ],
            [
                'title' => 'まとめ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">まとめ</h2>
        
        <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm space-y-6">
            <p class="text-gray-700 leading-relaxed">
                PHPの文法に関するレッスンは以上です。プログラミングと聞いていたのに拍子抜けした方もいらっしゃるかも知れませんが、Web制作のプログラミングの基本（あくまで基本）は、こんなところです。
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-4">
                <div class="space-y-3">
                    <h4 class="font-bold text-blue-800 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        学習の前半
                    </h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        序盤は、PHPファイルをターミナルの <code>php</code> コマンドによって実行してきました。ここでは、PHPプログラムの結果はターミナルに表示されていました。しかしターミナル上で表示させるだけでは、Webアプリケーションとして成立していません。
                    </p>
                </div>
                <div class="space-y-3">
                    <h4 class="font-bold text-green-800 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        学習の後半
                    </h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        後半では、<strong>Webサーバ（XAMPP）</strong>を起動して、Webサーバ上でPHPを動作させました。これでユーザに、Webサーバを通してPHPプログラムの結果（PHPによりコンテンツが埋め込まれたHTML）を見てもらうことができます。
                    </p>
                </div>
            </div>

            <hr class="border-gray-100">

            <div class="space-y-4">
                <p class="text-gray-700 leading-relaxed">
                    ここまでで、プログラムの制御の主役である <strong>条件分岐（if）</strong> と <strong>繰り返し（while）</strong> について理解できたでしょうか？また、<strong><code>$_POST</code></strong> という変数によるデータ通信のやり取りも理解できたでしょうか？
                </p>
                
                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                    <p class="text-sm text-blue-800">
                        もしわからないことがあれば、メンターに質問して解決しておきましょう。
                    </p>
                </div>
            </div>

            <div class="pt-6">
                <p class="text-gray-700 leading-relaxed mb-6">
                    しかし、もどかしいのは<strong>PHPだけではデータを保存できない</strong>ことです。データを保存するには、通常はデータベースを利用します。
                </p>

                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 rounded-2xl text-white shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="bg-white/20 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-2">NEXT STEP：データベースの学習</h4>
                            <p class="text-blue-100 leading-relaxed">
                                次のレッスンでは、Webでデータを保存するために使う<strong>「データベース」</strong>を学びます。これができるようになると、ユーザー登録や投稿機能など、本格的なWebアプリの仕組みが作れるようになります！
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}