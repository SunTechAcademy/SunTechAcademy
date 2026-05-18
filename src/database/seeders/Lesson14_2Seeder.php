<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson14_2Seeder extends Seeder
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
                'sort_order' => 2,
            ],
            [
                'title' => 'バージョン管理とは',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">バージョン管理とは</h2>
        <p class="text-gray-700 leading-relaxed">
            ファイルを何度も更新していくなかで必ず管理したいのが、<strong>ファイルの変更履歴</strong>です。
            変更履歴が正しく管理されていないと、一度保存したものを以前の状態に戻すことが非常に難しくなります。
        </p>
        <p class="text-gray-700 leading-relaxed mt-4">
            また、チームで開発をする際に、誰がどのファイルをいつ変更したのかを管理できていなければ、意図せぬ修正が入り込み、バグの原因を特定するのも困難になるでしょう。
            このように、ファイルの変更履歴を適切に管理することを<strong>「バージョン管理」</strong>と言います。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-red-600">効率の悪いバージョン管理方法</h3>
        
        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">1. ファイル名での管理</h4>
            <p class="text-gray-700 text-sm">
                ファイル名に日付や「backup」「final」などを付けて管理していませんか？
            </p>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-sm text-gray-600">
                index.html<br>
                index.html.backup<br>
                index.html.backup20220101<br>
                index.html.backup20220101_01<br>
                index.html.backup20220101_02<br>
                index.html.backup20220101_02final<br>
                index.html.backup20220101_02final2
            </div>
            <p class="text-gray-700 leading-relaxed">
                管理対象が一つならまだしも、数百ものファイルがあるプロジェクトでこれを行うと、どれが最新か判断するだけで時間がかかり、ミスを誘発します。
            </p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">2. コメントでの管理</h4>
            <div class="bg-gray-800 p-4 rounded-lg font-mono text-sm text-green-400 overflow-x-auto">
                &lt;!-- 2022/03/19 文言修正 &lt;p&gt;お願いします。&lt;/p&gt; --&gt;<br>
                &lt;!-- 2022/03/20 文言修正 &lt;p&gt;よろしくお願いします。&lt;/p&gt; --&gt;<br>
                &lt;p&gt;どうぞよろしくお願いします！&lt;/p&gt;
            </div>
            <p class="text-gray-700 leading-relaxed">
                ファイル内に履歴を残すと、コードの可読性が著しく低下します。本質的なプログラムよりもコメントの方が多くなり、メンテナンスが困難になります。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">専用ツールでのバージョン管理の必要性</h3>
        <p class="text-gray-700 leading-relaxed">
            古い方法での管理は、「元の状態に戻せるか」という不安を常に抱えながら作業することになります。
            そこで、<strong>「変更を自動的に監視し、いつでも過去の任意の時点に戻せる」</strong>という安心感を与えてくれる専用ツールの必要性が高まりました。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-blue-600">Gitの登場</h3>
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <div class="flex-1 space-y-4">
                <p class="text-gray-700 leading-relaxed">
                    そこで登場したのが<strong>Git</strong>です。
                    Gitは、Linuxという巨大なOSの開発チームにおいて、世界中の開発者が効率よく協力するために生まれました。
                </p>
                <p class="text-gray-700 leading-relaxed text-sm bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                    Linuxの開発者が「既存のツールに理想のものがないなら自分で作ろう」と開発したのがGitです。
                    今では世界中のあらゆる開発現場でデファクトスタンダード（業界標準）として使われています。
                </p>
                <a href="https://git-scm.com/" target="_blank" class="inline-block text-blue-500 hover:underline text-sm font-bold">
                    Git公式ページ（英語）
                </a>
            </div>
            <div class="w-full md:w-1/3 overflow-hidden border border-gray-200 rounded-xl p-2 bg-white shadow-sm flex justify-center">
                <img src="/images/Lesson14-1.png" alt="Lesson14-1" class="max-w-xs w-full h-auto">
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}