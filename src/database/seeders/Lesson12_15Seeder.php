<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_15Seeder extends Seeder
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
                'sort_order' => 15,
            ],
            [
                'title' => 'まとめ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-3xl font-bold text-gray-800 border-l-8 border-green-500 pl-4 mb-6">Lesson 12 まとめ</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-6">
            <p>
                アプリケーションのデータ保存のために、まずは<strong>データベース（MySQL）</strong>の基本を学びました。
                ここではまだ、プログラム（PHP）とデータベースがどうやって会話するかという「連携」の部分には踏み込んでいません。しかし、ターミナルを通じてSQLを直接叩き、<strong>CRUD操作</strong>の本質を理解できたことは、今後の開発において非常に強力な武器になります。
            </p>
        </div>
    </section>

    <section class="grid md:grid-cols-2 gap-8 items-center bg-gray-50 p-8 rounded-3xl border border-gray-100">
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-gray-800">データベースは「進化したExcel」？</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                自分でデータベースを作ってみて、「意外とシンプルだな」と感じたのではないでしょうか。
                私たちが普段Excelを使って行っている「表形式でのデータ管理」を、より厳密に、そしてプログラムから扱いやすくしたものがデータベースです。
            </p>
            <ul class="space-y-2 text-sm text-gray-700">
                <li class="flex items-start gap-2">
                    <span class="text-green-500 font-bold">✔</span>
                    大量のデータを効率的に検索できる
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-green-500 font-bold">✔</span>
                    データの重複や矛盾を防ぐ（正規化）
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-green-500 font-bold">✔</span>
                    複数のユーザーやアプリから同時にアクセスできる
                </li>
            </ul>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
            

[Image of Web Application and Database Architecture]

        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">Next Step</span>
            次章への展望
        </h3>
        <p class="text-gray-700 leading-relaxed">
            次のレッスンでは、いよいよ<strong>PHPとの連携</strong>をスタートします。
            ブラウザのフォームから入力されたデータをSQLに変えて、MySQLに保存する——。
            これができるようになると、ユーザー登録、投稿システム、検索機能など、世の中にある<strong>「本格的なWebアプリケーション」</strong>の裏側がすべて自分の手で作れるようになります。
        </p>

        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 rounded-2xl text-white shadow-lg">
            <h4 class="text-lg font-bold mb-2">Lesson 12 完遂おめでとうございます！</h4>
            <p class="text-blue-100 text-sm">
                データという「資産」を操る第一歩を完璧にマスターしました。SQLの基礎は一度身につければ一生モノの技術です。このままの勢いで、アプリケーション制作の核心部へ進んでいきましょう！
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}