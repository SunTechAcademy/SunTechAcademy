<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得
        $lesson = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：応用')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 3,
            ],
            [
                'title' => 'プロジェクトの開始',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">プロジェクトの開始</h2>
        <p class="text-sm leading-relaxed">
            では、さっそくLaravelプロジェクトを作成します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">プロジェクトの作成</h3>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                まずはLaravelプロジェクトを作成します。Laravelプロジェクトには、Laravelによるアプリケーション開発のベースとなる一連のファイルが格納されています。<br>
                XAMPPのhtdocsファイルに移動したうえでcomposer create-projectコマンドを実行します。
            </p>
        </div>

        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic"># Laravelプロジェクトの作成</p>
            <code class="block bg-gray-900 text-white p-4 rounded-md font-mono text-sm shadow-lg">
                htdocs/ $ composer create-project --prefer-dist laravel/laravel microposts ^9.0
            </code>
        </div>

        <div class="mt-10 space-y-6">
            <h4 class="font-bold text-lg text-gray-800">使用フォルダとファイル</h4>
            <p class="text-sm leading-relaxed">
                VScodeを利用してmicropostsプロジェクトを作成していくうえで、使用するフォルダやファイルを紹介します。<br>
                <span class="text-blue-600 font-bold">（参考）リクエストからレスポンスまでの流れを振り返っていただくと、理解しやすくなります。</span>
            </p>
            
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                <img src="/images/Lesson18-9.png" alt="Request Response Flow" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
            </div>

            <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg text-sm text-blue-800">
                紹介するだけなので操作不要です。<br>
                初期状態で多くのフォルダやファイルが存在するため少し驚かれたことでしょう。<br>
                次のように、実際に利用するフォルダやファイルは限定されているため、安心してください。
            </div>

            <p class="text-sm">
                今回のレッスンで主に修正するフォルダやファイルを紹介します。<br>
                初期設定用ファイルなどは省略しております。
            </p>

            <ul class="list-none space-y-2 text-sm font-bold text-gray-600 pl-4 border-l-2 border-gray-200">
                <li>・/app/Http/Controllersフォルダ</li>
                <li>・/app/Modelsフォルダ</li>
                <li>・/database/migrationsフォルダ</li>
                <li>・/resource/viewsフォルダ</li>
                <li>・/routesフォルダ</li>
            </ul>
            <p class="text-xs text-gray-500 italic">※ 現段階で各ファイル内のコードを読んで頂く必要はございません。後日復習される際の参考にして下さい。</p>

            <div class="space-y-6 mt-8">
                <div class="flex gap-4 items-start">
                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded shrink-0">（1）</span>
                    <div class="text-sm">
                        <p class="font-bold text-gray-800">/microposts/app/Http/Controllersフォルダ</p>
                        <p class="leading-relaxed">アプリ開発に必要な各種Controllerファイルは、カリキュラム内で追加作成します。view と Model とのデータのやり取りのために利用します。</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded shrink-0">（2）</span>
                    <div class="text-sm">
                        <p class="font-bold text-gray-800">/microposts/app/Modelsフォルダ</p>
                        <p class="leading-relaxed">User.php を使用します。User.phpファイル以外にも、必要に応じてModelファイルを追加作成します。Controller と Mysql データベースとのデータのやり取りのために利用します。</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded shrink-0">（3）</span>
                    <div class="text-sm">
                        <p class="font-bold text-gray-800">/microposts/database/migrationsフォルダ</p>
                        <p class="leading-relaxed">次の4ファイル以外にも、必要に応じてMigrationファイルを作成します。Mysql データベースのテーブルを生成する際に利用します。</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded shrink-0">（4）</span>
                    <div class="text-sm">
                        <p class="font-bold text-gray-800">/microposts/resource/viewsフォルダ</p>
                        <p class="leading-relaxed">index.blade.php などの ●●.blade.php ファイルを作成し使用します。resources/views フォルダの中に必要に応じてフォルダを作成します。表示を行なう view の処理に利用します。</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded shrink-0">（5）</span>
                    <div class="text-sm">
                        <p class="font-bold text-gray-800">/microposts/routesフォルダ</p>
                        <p class="leading-relaxed">web.php ファイルを使用します。route の処理に利用します。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">動作確認</h3>
        <p class="text-sm leading-relaxed">
            Laravelアプリケーションの作成ができたので、初期状態での動作確認を行います。
        </p>

        <div class="bg-white border-l-4 border-green-500 p-6 shadow-sm space-y-4">
            <h4 class="font-bold text-green-800">動作確認操作</h4>
            <p class="text-sm">作成できた microposts のディレクトリへ移動し、次のコマンドで、Laravelのアプリケーションを起動してください。<br>
            <span class="text-red-600 font-bold italic">※ microposts フォルダに移動していない場合は、 cd microposts で移動しておいてください。</span></p>
            
            <p class="text-xs font-bold text-gray-500 italic">Laravelアプリケーションの起動</p>
            <code class="block bg-gray-900 text-white p-3 rounded font-mono text-sm">
                microposts % php artisan serve --host=127.0.0.1 --port=8000
            </code>
        </div>

        <div class="space-y-4">
            <p class="text-sm font-bold text-gray-600">実行結果</p>
            <img src="/images/Lesson18-10.png" alt="Terminal Serve Result" class="max-w-2xl w-full h-auto border rounded shadow-sm">
        </div>

        <div class="space-y-4 mt-8">
            <p class="text-sm font-bold text-gray-600">表示例</p>
            <p class="text-sm">welcome.blade.php が読み込まれ「Laravel」が表示されていれば大丈夫です。welcome ページが表示されていることを意味します。</p>
            <img src="/images/Lesson18-11.png" alt="Laravel Welcome Page" class="max-w-2xl w-full h-auto border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GitHub</h3>
        <p class="text-sm leading-relaxed">
            GitHubでバージョン管理を開始しておきましょう。
        </p>
        
        <p class="text-sm font-bold text-gray-600">GitHubで新しいリポジトリを作成してください。</p>
        <img src="/images/Lesson18-12.png" alt="GitHub New Repository" class="max-w-2xl w-full h-auto border rounded shadow-sm">

        <div class="space-y-4 mt-6">
            <p class="text-sm">VSCodeの作業フォルダを <strong>microposts</strong> に変更した上で、以下のコマンドを実行します。</p>
            <div class="bg-gray-800 text-white p-6 rounded-lg font-mono text-sm leading-relaxed shadow-lg">
                git init<br>
                git add .<br>
                git commit -m "first commit"<br>
                git branch -M main<br>
                git remote add origin https://github.com/ユーザー名/micropost.git<br>
                git push -u origin main
            </div>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}