<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14_3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 14 (Git/GitHub) を取得
        $lesson14 = Lesson::where('title', 'Git/GitHub')->first();

        if (!$lesson14) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson14->id,
                'sort_order' => 3,
            ],
            [
                'title' => 'Gitとは',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">Gitとは</h2>
        <p class="text-gray-700 leading-relaxed">
            <strong>Git（ギット）</strong>とは、ファイルの変更履歴を記録・追跡するための<strong>バージョン管理システム（ツール）</strong>です。
            プログラミングの世界では、一文字の打ち間違いがシステム全体の停止を招くこともあるため、この「履歴を管理する」仕組みが非常に重要になります。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Gitが保存する履歴情報</h3>
        <p class="text-gray-700">
            Gitは、単にファイルを保存するだけでなく、変更に対して以下の情報をセットにして<strong>「1つのバージョン」</strong>として保持します。
        </p>
        
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <ul class="space-y-3">
                <li class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    <span class="text-gray-700"><strong>いつ</strong>（変更された日時）</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    <span class="text-gray-700"><strong>誰が</strong>（変更した人の名前・メールアドレス）</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    <span class="text-gray-700"><strong>どのファイルの、どの箇所を</strong>（具体的な変更内容・差分）</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    <span class="text-gray-700"><strong>どんなメッセージを残して変更したか</strong>（コミットメッセージ）</span>
                </li>
            </ul>
        </div>
        <p class="text-gray-700 leading-relaxed">
            Gitは、上記の項目を持った1つ1つの小さなバージョンを連鎖させ、ファイルの変更履歴（バージョン履歴）を形成します。
            プロジェクトの進捗は、まさにこの<strong>「変更履歴の積み重ね」</strong>そのものとなります。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-green-700">Gitを使うことで解決すること</h3>
        <p class="text-gray-700">
            Gitが情報を管理してくれるおかげで、編集したファイルを過去の特定の状態にピンポイントで戻したり、今日一日どのファイルのどこを編集したかを一覧表示したりできます。
        </p>
        
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="text-green-500 mb-2 font-bold">安心感</div>
                <p class="text-sm text-gray-600">いつでも以前の内容に戻れるため、失敗を恐れずにファイルを変更できる。</p>
            </div>
            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="text-green-500 mb-2 font-bold">効率化</div>
                <p class="text-sm text-gray-600">ファイル名を変えてバックアップを取る必要がなくなり、作業フォルダがスッキリする。</p>
            </div>
            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="text-green-500 mb-2 font-bold">共同開発</div>
                <p class="text-sm text-gray-600">複数人で同じファイルを編集しても、それぞれの変更を統合して管理できる。</p>
            </div>
        </div>

        <p class="text-gray-700 leading-relaxed mt-4">
            これらのメリットを享受することで、滞りなく、かつ安心してチーム開発が進められるようになります。
            そして、このGitの仕組みをクラウド上で活用し、チーム開発をより円滑にするためのサービスが<strong>「GitHub」</strong>です。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}