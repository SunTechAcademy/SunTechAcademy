<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_2Seeder extends Seeder
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
                'sort_order' => 2,
            ],
            [
                'title' => 'デプロイ（deploy）とは',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-8">デプロイ（deploy）とは</h2>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-6">
            <p>
                レッスンの最初で説明したとおり、自分たちの手で作成したWebアプリケーションをインターネット上で公開することを<strong>「デプロイ」</strong>と言います。
            </p>
            <p>
                直訳すると「配置する・展開する」という意味になるとおり、具体的には、一般的なインターネットの利用者が自分たちのWebアプリケーションを自由に利用できるよう、サーバにWebアプリケーションを配置する作業がデプロイです。
            </p>

            

            <p>
                ここまでは、構築中の内容を自分だけが確認できればよかったので、言語やフレームワークが機能として持つ簡易的なサーバを利用して学習を進めました。そのサーバの機能は、あくまでも簡易的であるため、「一般のインターネット利用者に広く公開する」という実際の運用に耐えられません。
            </p>
            
            <p>
                Webアプリケーションとしてインターネット上へデプロイするには、実運用に耐えられる能力をもつ以下の要素と、それらに関する広くて深い知識が必要です。
            </p>

            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 shadow-inner">
                <ul class="list-disc pl-6 space-y-2 text-gray-700 font-medium">
                    <li>サーバコンピュータ本体</li>
                    <li>Webサーバソフトウェア</li>
                    <li>データベース（DB）のサーバおよびDBサーバソフトウェア</li>
                    <li>ネットワーク</li>
                    <li>セキュリティ対策</li>
                    <li>etc…</li>
                </ul>
            </div>

            <p>
                このような知識を学ぶのは容易ではありません。しかし、Webアプリケーションの開発者が、これらの知識を広く深く知らなくてもWebアプリケーションを一般の利用者に公開できるよう、手助けをしてくれるサービスもいくつか存在します。
            </p>
            
            <div class="p-6 bg-blue-50 rounded-lg border border-blue-100">
                <p>
                    本カリキュラムでは、そういったサービスを利用することで、作成したWebアプリケーションをインターネット上へデプロイする方法を学びます。
                </p>
                <p class="mt-4">
                    <strong>最終レッスンのオリジナル制作でも、完成したアプリケーションは、今回紹介するサービスへデプロイし、提出していただきます。</strong>
                </p>
            </div>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}