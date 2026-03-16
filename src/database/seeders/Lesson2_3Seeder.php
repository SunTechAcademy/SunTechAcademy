<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson2_3Seeder extends Seeder
{
    public function run(): void
    {
        // 親となるLesson 2を取得
        $lesson2 = Lesson::where('title', 'Web開発のために学ぶこと')->first();

        if (!$lesson2) return;

        // Chapter 4: 本コースについて
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson2->id,
                'sort_order' => 4 
            ],
            [
                'title' => '本コースについて',
                'is_assignment' => 1,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed">
            本コースのゴールは、<strong>PHPとLaravelを使ってオリジナルのWebアプリケーション（Webサービス）を制作するスキルを身につけること</strong>です。ここで、本コースのゴールやレッスン構成について、まとめます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">1</span>
            学習のコツ
        </h4>
        
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 border rounded-lg bg-gray-50">
                    <p class="font-bold text-[#6A73A6] mb-2">● 順番に進める</p>
                    <p class="text-sm text-gray-600">すべてのレッスンは、ゴールに向けて順を追って配置されています。飛ばさずに順番どおりに進めてください。</p>
                </div>
                <div class="p-4 border rounded-lg bg-gray-50">
                    <p class="font-bold text-[#6A73A6] mb-2">● わからないときは</p>
                    <ul class="text-sm text-gray-600 list-disc ml-4">
                        <li>レッスンを何度か読み返す</li>
                        <li>前のレッスンに戻って調べる</li>
                        <li><strong>メンターに質問をする</strong></li>
                    </ul>
                </div>
            </div>

            <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-400">
                <p class="font-bold text-blue-800 mb-2">課題へ取り組むうえでの考え方やコツ</p>
                <div class="grid grid-cols-1 gap-4 text-sm leading-relaxed">
                    <div>
                        <p class="font-bold">1. 課題の目的を知る</p>
                        <p>「理解度を確かめる（レッスン内知識）」か「応用力を身につける（検索が必要）」のどちらかを見極めましょう。</p>
                    </div>
                    <div>
                        <p class="font-bold">2. 成果物（ゴール）をイメージする</p>
                        <p>「最終的にどのような完成品を作ればよいか」をイメージすることが第一歩です。</p>
                    </div>
                    <div>
                        <p class="font-bold">3. 成果物に対する現状のギャップを考える</p>
                        <p>スタート地点とゴールを比較して「何が不足しているか」を考え、その差を埋めていきます。</p>
                    </div>
                    <div class="bg-white p-4 rounded border">
                        <p class="font-bold text-orange-600">4. 少しずつ作成する（重要！）</p>
                        <p class="mb-2">一気に作らず、最小単位で動作を確認しながら進めましょう。</p>
                        <ul class="list-disc ml-4 text-xs space-y-1 text-gray-500 italic">
                            <li>例1：関数の定義だけ書く → 「OK」と表示させてみる → 引数を追加する</li>
                            <li>例2：HTMLのベースだけ作る → ヘッダーだけ作る → メインエリアを作る</li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-bold">5. 提出する前に全体を見直す</p>
                        <p>誤字脱字やデザイン崩れがないか、想定した仕様を満たしているかを最終チェックしましょう。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">2</span>
            プログラミングは簡単か
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>
                「プログラミングは簡単だ」という意見もありますが、決して一朝一夕で身につくものではありません。
                はじめて学ぶ人にとって必ずしも易しいとは言えませんが、<strong>あまり難しく考え過ぎないことも重要</strong>です。
            </p>
            <p>
                本コースでは<strong>実践</strong>を重要視しています。キーボードで実際にコードを打ち、動かしてみる中でのみ、エンジニアの思考方法は身につきます。
            </p>
            <div class="bg-indigo-900 text-white p-6 rounded-lg shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-lg font-bold mb-2">優秀なメンターがあなたをサポートします</p>
                    <p class="text-sm opacity-90 leading-relaxed">
                        現場のプロがいつでも質問に答えてくれる環境は、初心者にとって最強の武器です。
                        挫折しそうになったときは、いつでも頼ってください。
                    </p>
                </div>
                <div class="absolute right-[-20px] bottom-[-20px] opacity-10">
                    <svg width="150" height="150" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
            </div>
            <p class="text-center font-bold text-[#6A73A6] pt-4">
                PHPとLaravelでオリジナルのWebアプリケーションを構築できるよう、着実に進めていきましょう！
            </p>
        </div>
    </section>
</div>'
            ]
        );
    }
}