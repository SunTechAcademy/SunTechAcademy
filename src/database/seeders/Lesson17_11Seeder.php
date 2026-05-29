<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_11Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得
        $lesson = Lesson::where('title', 'アプリケーションのデプロイ')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 11,
            ],
            [
                'title' => '（参考資料）その他のPaaSサービス',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">（参考資料）その他のPaaSサービス</h2>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-6">
            <p>
                本カリキュラムでは、無料でスタートできる「Fly.io」ならびに「Supabase」へ、作成したWebアプリケーションをデプロイしました。
            </p>
            
            <p>
                クレジットカードの登録が必須、あるいは、スタート段階から有料でもかまわない場合、他のPaaSサービスへのデプロイも選択肢になりえます。たとえば、クレジットカードを使えるのであれば、データベースもFly.ioのサービスを利用できるため、必要な作業はすべてFly.ioのみで完結します。
            </p>
            
            <p>
                ここでは、代表的なPaaSサービスの一覧を紹介します。詳細は各サービスのサイトをご覧ください。
            </p>
        </div>
    </section>

    <section class="mt-8">
        <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">サービス名</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">特徴・説明</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    <tr>
                        <td class="px-6 py-4 font-bold text-blue-600">Heroku</td>
                        <td class="px-6 py-4">2022年11月より無料プランが廃止</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-bold text-blue-600">render</td>
                        <td class="px-6 py-4">データベースは90日間のみ無料</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-bold text-blue-600">Railway</td>
                        <td class="px-6 py-4">多くの言語のひな形が用意されている ものの、ひな形の内容は古めのものが多い</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-bold text-blue-600">Amazon Web Services</td>
                        <td rowspan="3" class="px-6 py-4 align-top">この3つは自由にサーバを構築できるものの、ネットワークやセキュリティなどの知識も必要になる</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-bold text-blue-600">Google Cloud</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-bold text-blue-600">Microsoft Azure</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-bold text-blue-600">PlanetScale</td>
                        <td class="px-6 py-4">データベースのみのサービス</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}