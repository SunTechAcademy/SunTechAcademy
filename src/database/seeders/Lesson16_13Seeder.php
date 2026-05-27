<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_13Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得
        $lesson = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：基礎')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 13,
            ],
            [
                'title' => 'まとめ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-8">まとめ</h2>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-6">
            <p>
                LaravelにおけるWebアプリケーションの流れ（以下の図参照）を忘れないようにしましょう。
                <strong>ControllerによってModelは必要なデータを取得し、Viewで結果が表示されます。</strong>
                ユーザのHTTPリクエストをRouterが解析し、リクエストに沿った適切なModelをユーザに表示するのがWebアプリケーションだと心得てください。
            </p>

            <div class="my-10 text-center">
                <img src="/images/Lesson16-70.png" alt="Laravel MVC Flow Diagram" class="max-w-2xl mx-auto border rounded-xl shadow-md">
                <p class="text-xs text-gray-500 mt-3 italic">Webアプリケーションの基本構成図</p>
            </div>

            <p>
                また、 <strong>Modelとデータベースの関係</strong>も忘れないようにしましょう。Modelはデータベースがないと保存ができません。データベースによって、Modelのインスタンスをレコードとして保存できます。
            </p>

            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100 italic shadow-sm">
                このレッスンで、Webアプリケーション開発の基礎を紹介しました。<br>
                わからないことがあれば、このレッスン（もしくはさらに前のレッスン）を読み返して何度も復習をしてみてください。
                一度ですべてを把握できないのは当然です。何度も読み返して構いません。また、解決できそうにない疑問はメンターに質問してください。
            </div>

            <p class="font-bold text-red-600 bg-red-50 p-4 rounded border border-red-100">
                次からのレッスンは、ここでの知識を前提に話を進めるため、このレッスンを理解せずに先へ進むと、自分が何をしているのかわからなくなります。
            </p>

            <h3 class="text-lg font-bold text-gray-800 mt-10">RESTfulなルーティングの重要性</h3>
            <p>
                なお、本来であれば、メッセージボードは7つもページが必要ありません。新規メッセージを書くにしても <code>/messages/index</code> にフォームを設置した方が便利です。
            </p>
            <p>
                しかし、今回はあえて<strong>RESTfulなルーティング</strong>に沿って開発しました。なぜなら、RESTfulなルーティングこそWeb上におけるModel操作の基本構成だからです。
            </p>
            
            <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                <p>
                    今後学習を進めていくと一部のルーティングが不要となる場合があることに気付くでしょう。その際は、ユーザの利便性を考えて、RESTfulなルーティングから変更することを検討してみてください。
                </p>
                <p class="mt-4 font-bold">
                    ただし、今回のRESTfulなルーティングがWebアプリケーションの基本だと言うことは覚えておきましょう。
                </p>
            </div>
        </div>
    </section>

    <div class="text-center py-10">
        <div class="inline-block px-10 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full font-bold shadow-xl">
            Lesson 16 完了です！お疲れ様でした。
        </div>
    </div>

</div>
EOF
            ]
        );
    }
}