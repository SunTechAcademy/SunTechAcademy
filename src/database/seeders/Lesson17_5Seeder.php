<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_5Seeder extends Seeder
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
                'sort_order' => 5,
            ],
            [
                'title' => 'Supabase上にデータベースを作成する',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">Supabase上にデータベースを作成する</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                まずはSupabase上にデータベースを作成します。Supabaseのアカウント登録から説明しますので、すでにアカウントをお持ちの方は「Supabaseのデータベース作成」のセクションまでスキップしてください。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Supabaseのアカウント登録</h3>
        
        <div class="space-y-8 text-sm">
            <p>（1）Supabaseのサイトにアクセスします。<br>
            <a href="https://supabase.com/" target="_blank" class="text-blue-600 underline font-mono">https://supabase.com/</a></p>

            <p>（2）画面右上の<strong>「Start your project」</strong>をクリックします。</p>
            <img src="/images/Lesson17-1.png" alt="Supabase Start your project" class="max-w-full h-auto border rounded shadow-sm">

            <p>（3）Supabaseでアカウントを登録するには、GitHubアカウントが必須です。<strong>「Sign In with GitHub」</strong>をクリックし、GitHubのサイトへ遷移します。先のレッスンで取得したGitHubのアカウントでGitHubにログインします。</p>
            <img src="/images/Lesson17-2.png" alt="Sign In with GitHub" class="max-w-full h-auto border rounded shadow-sm">

            <p>（4）途中、情報の連携を許可するか求められるので<strong>「Authorize supabase」</strong>をクリックします。GitHubのパスワードを求められた場合は、画面の指示にしたがって操作を進めましょう。</p>
            <img src="/images/Lesson17-3.png" alt="Authorize supabase" class="max-w-full h-auto border rounded shadow-sm">

            <p>（5）Name、Typeは<strong>Educational（教育）</strong>か<strong>Personal（個人）</strong>を選択しましょう。Planは必ず<strong>0円のもの</strong>を選び、<strong>Create organization</strong>を押下してください。</p>
            <img src="/images/Lesson17-4.png" alt="Create organization" class="max-w-full h-auto border rounded shadow-sm">

            <div class="bg-green-50 p-4 rounded border border-green-200 font-bold">
                以上で、Supabaseのアカウント登録は完了です。
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Supabaseのデータベース作成</h3>
        <p class="text-sm">
            SupabaseのPostgreSQLで、データベースを作成します。Supabase（<a href="https://supabase.com/dashboard/org/iftwybsffbsnkkyiwdbk" target="_blank" class="text-blue-600 underline">ダッシュボード</a>） にログインした状態で、以下の作業を進めてください。
        </p>

        <div class="space-y-8 text-sm">
            <p>（1）ダッシュボードのページの画面で、右のほうにある<strong>「New Project」</strong>をクリックします。</p>
            <img src="/images/Lesson17-5.png" alt="New Project" class="max-w-full h-auto border rounded shadow-sm">

            <p>（2）GitHub (optional)の<strong>Connect GitHub</strong> → レッスンで使用しているGitHubを選びます → <strong>Authorize</strong>を押下します。登録してあるリポジトリが選択できるようになります。</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <img src="/images/Lesson17-6.jpeg" alt="Connect GitHub step 1" class="border rounded shadow-sm">
                <img src="/images/Lesson17-7.jpeg" alt="Connect GitHub step 2" class="border rounded shadow-sm">
                <img src="/images/Lesson17-8.jpeg" alt="Connect GitHub step 3" class="border rounded shadow-sm">
            </div>

            <p>（3）リポジトリを登録しましょう。GitHub (optional)の<strong>Choose GitHub repository</strong> → <strong>Add GitHub Repositories</strong> → <strong>Continue</strong> → <strong>All repositories</strong> → <strong>install & Authorize</strong> → <strong>message-boardリポジトリを選択</strong></p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <img src="/images/Lesson17-9.jpeg" alt="Add Repositories step 1" class="border rounded shadow-sm">
                <img src="/images/Lesson17-10.jpeg" alt="Add Repositories step 2" class="border rounded shadow-sm">
                <img src="/images/Lesson17-11.jpeg" alt="Add Repositories step 3" class="border rounded shadow-sm">
                <img src="/images/Lesson17-12.png" alt="Add Repositories step 4" class="border rounded shadow-sm">
            </div>

            <div>
                <p>（4）データベース作成に必要な情報を入力します。入力する内容は、以下を参考にしてください。</p>
                <ul class="list-disc pl-6 mt-4 space-y-2">
                    <li><strong>Name：</strong>アプリケーション名を入力</li>
                    <li><strong>Database Password：</strong>データベースのパスワードを入力。ただし<strong>「Generate a password」</strong>のリンクをクリックしてパスワード文字列を自動生成するのを推奨（ある程度強力なパスワード文字列にしないとアカウント登録できないため）</li>
                    <li><strong>Region：</strong><strong>「Northeast Asia(Tokyo)」</strong>を選択</li>
                    <li class="text-red-600 font-bold">※自動生成したパスワードは、「Copy」をクリックしてクリップボードにコピーし、別途メモかどこかにペーストして保管しておいてください。</li>
                    <li><strong>Security：</strong>Enable Data APIとAutomatically expose new tablesにチェックが入っていることを確認</li>
                </ul>
            </div>
            <img src="/images/Lesson17-13.png" alt="Database settings" class="max-w-full h-auto border rounded shadow-sm">

            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded">
                入力が完了したら<strong>「Create new project」</strong>をクリックします。作成した直後のプロジェクトは「Setting up project」の状態となっていて、すぐには使えないので、しばらく待ちます。
            </div>

            <p>（5）「Setting up project」の状態が終わり、プロジェクトのHome画面が以下の表示になりましたら、一旦完了です</p>
            <img src="/images/Lesson17-15.png" alt="Project Home Screen" class="max-w-full h-auto border rounded shadow-sm">
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}