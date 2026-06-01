<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 16 を取得
        $lesson16 = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：基礎')->first();

        if (!$lesson16) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson16->id,
                'sort_order' => 3,
            ],
            [
                'title' => 'Laravelプロジェクトの開始',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">Laravelプロジェクトの開始</h2>
        <p class="leading-relaxed">
            では、さっそくLaravelを使ってWebアプリケーションを開発します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">今回作成するWebアプリケーション</h3>
        <p class="leading-relaxed">
            このレッスンではとても単純なWebアプリケーションを作成します。操作可能なリソースは、メッセージ（Message）のみです。Webアプリケーション名は<strong>メッセージボード</strong>で、これは単純な掲示板です。<br>
            メッセージボードの開発を通して、Laravelを利用したWebアプリケーション開発について、しっかりと学びましょう。
        </p>
        
        <div class="bg-blue-50 p-6 rounded-xl">
            <h4 class="font-bold text-blue-900 mb-4">完成イメージ</h4>
            <p class="text-sm mb-4">このレッスンでは、メッセージに関係した4つのページを作成します。</p>
            <ul class="list-disc pl-6 space-y-2 text-sm text-blue-800 mb-6">
                <li>メッセージ一覧ページ（トップページ）</li>
                <li>メッセージ新規作成ページ</li>
                <li>メッセージ詳細ページ</li>
                <li>メッセージ編集ページ</li>
            </ul>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <img src="/images/Lesson16-6.png" alt="メッセージ一覧ページ" class="rounded border shadow-sm w-full">
                    <p class="text-xs text-center text-gray-500 italic">メッセージ一覧ページ（トップページ）</p>
                </div>
                <div class="space-y-2">
                    <img src="/images/Lesson16-7.png" alt="メッセージ新規作成ページ" class="rounded border shadow-sm w-full">
                    <p class="text-xs text-center text-gray-500 italic">メッセージ新規作成ページ</p>
                </div>
                <div class="space-y-2">
                    <img src="/images/Lesson16-8.png" alt="メッセージ詳細ページ" class="rounded border shadow-sm w-full">
                    <p class="text-xs text-center text-gray-500 italic">メッセージ詳細ページ</p>
                </div>
                <div class="space-y-2">
                    <img src="/images/Lesson16-9.png" alt="メッセージ編集ページ" class="rounded border shadow-sm w-full">
                    <p class="text-xs text-center text-gray-500 italic">メッセージ編集ページ</p>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Laravelプロジェクトの作成コマンド</h3>
        
        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="bg-gray-800 text-white text-xs px-2 py-1 rounded">1</span>
                phpのバージョンを確認する
            </h4>
            <p class="text-sm leading-relaxed">
                今回利用するLaravelのバージョン9.xを動作させるには、<strong>PHP8.0.2以上</strong>と<strong>composer</strong>が必要です。念のためバージョンを確認します。
            </p>
            <div class="bg-gray-900 rounded-lg p-4 space-y-3">
                <div>
                    <p class="text-gray-400 text-xs mb-1">// PHPバージョン確認</p>
                    <code class="text-green-400 font-mono">php -v</code>
                </div>
                <div>
                    <p class="text-gray-400 text-xs mb-1">// Composerの確認</p>
                    <code class="text-green-400 font-mono">composer about</code>
                </div>
            </div>

            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded text-sm">
                <p class="font-bold text-red-800 mb-2">エラーが出る場合（インストール手順）</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div class="space-y-2">
                        <p class="font-bold underline decoration-red-200 text-red-700">PHPのインストール</p>
                        <p class="text-xs text-gray-600">macの場合: <code class="bg-white px-1 border">brew install php</code></p>
                        <p class="text-xs text-gray-600">Windowsの場合: <code class="bg-white px-1 border">winget install PHP.PHP</code></p>
                        <p class="text-xs font-bold mt-2">※PHP8.0.2以上になっていればOKです。</p>
                    </div>
                    <div class="space-y-2">
                        <p class="font-bold underline decoration-red-200 text-red-700">コンポーザーのインストール</p>
                        <p class="text-xs text-gray-600">macの場合: <code class="bg-white px-1 border">brew install composer</code></p>
                        <p class="text-xs text-gray-600">Windowsの場合: <a href="https://getcomposer.org/download/" class="text-blue-600 underline">公式配布サイト</a> からWindows Installerを実行</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="bg-gray-800 text-white text-xs px-2 py-1 rounded">2</span>
                Laravelプロジェクトを作成する
            </h4>
            <p class="text-sm leading-relaxed">
                ここから開発のスタートです。まずはLaravelプロジェクトを作成します。Laravelプロジェクトには、Laravelによるアプリケーション開発のベースとなる一連のファイルが格納されています。<br>
                XAMPPのhtdocsファイルに移動したうえで<code>composer create-project</code>コマンドを実行します。
            </p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-sm overflow-x-auto">
                # Laravelプロジェクトの作成<br>
                htdocs/ $ composer create-project --prefer-dist laravel/laravel message-board ^9.0
            </div>
            
            <div class="p-4 bg-orange-50 border-l-4 border-orange-400 text-sm space-y-2">
                <p class="font-bold text-orange-800 italic">エラーが出る場合は以下を試してください</p>
                <code class="block bg-white p-2 border mb-1">composer config --global audit.block-insecure false</code>
                <code class="block bg-white p-2 border mb-1">rm -rf message-board</code>
                <code class="block bg-white p-2 border">composer create-project --prefer-dist laravel/laravel message-board "^9.0"</code>
            </div>

            <p class="text-sm leading-relaxed">
                これはcomposerを使って、message-boardというLaravelプロジェクトを作成するコマンドです。完了まではすこし時間がかかります。最後に <strong>Application key set successfully.</strong> と表示されれば成功です。
            </p>
            <div class="flex flex-col items-center gap-4 py-4">
                <img src="/images/Lesson16-11.png" alt="実行結果" class="max-w-2xl w-full h-auto border rounded shadow">
                <img src="/images/Lesson16-10.png" alt="成功確認" class="max-w-2xl w-full h-auto border rounded shadow">
            </div>
            <p class="text-sm text-red-600 font-bold bg-red-50 p-3 rounded text-center">
                成功したかどうかを必ず確認しましょう。もし、成功しなかった場合はメンターにご相談ください。
            </p>
        </div>

        <div class="bg-gray-100 p-6 rounded-xl border-l-4 border-gray-400">
            <h4 class="font-bold text-gray-800 mb-3 underline decoration-gray-300 decoration-2">バージョニングの知識</h4>
            <p class="text-sm leading-relaxed mb-4">
                バージョンは、<strong>メジャー.マイナー.パッチ</strong> という3つのバージョン番号の形式で表現されることが多いです。
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                <div class="bg-white p-3 rounded shadow-sm border border-gray-200">
                    <span class="font-bold text-blue-600">メジャー (9)</span><br>大規模なアップデート
                </div>
                <div class="bg-white p-3 rounded shadow-sm border border-gray-200">
                    <span class="font-bold text-blue-600">マイナー (0)</span><br>中程度のアップデート
                </div>
                <div class="bg-white p-3 rounded shadow-sm border border-gray-200">
                    <span class="font-bold text-blue-600">パッチ (1)</span><br>軽微なバグ修正
                </div>
            </div>
            <p class="text-xs mt-4 text-gray-600">※ <code>^9.0</code> と書けば、バージョン9.xの最新版が自動選択されます。</p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="bg-gray-800 text-white text-xs px-2 py-1 rounded">3</span>
                GitHubにプッシュする
            </h4>
            <p class="text-sm">一旦ここでGitHubにプッシュしておきましょう。GitHubで新しいリポジトリを作成してください。</p>
            <div class="flex justify-center">
                <img src="/images/Lesson16-12.png" alt="GitHubリポジトリ作成" class="max-w-xl w-full h-auto border rounded">
            </div>
            <p class="text-sm">VSCodeの作業フォルダを <code>message-board</code> に変更した上で、以下のコマンドを実行します。</p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-xs space-y-1">
                <p>git init</p>
                <p>git add .</p>
                <p>git commit -m "init Laravel Project"</p>
                <p>git branch -M main</p>
                <p>git remote add origin https://github.com/ユーザー名/message-board.git</p>
                <p>git push -u origin main</p>
            </div>
            <p class="text-sm font-bold text-blue-600">
                URL：https://github.com/ユーザー名/message-board にアクセスして反映されていれば成功です。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-[#4A5180]">composerとは</h3>
        <p class="leading-relaxed">
            composerとは、<strong>PHPのライブラリ管理システム</strong>です。PHPのライブラリをインストールしたり、バージョンをコントロールしたりするために利用します。
        </p>
        <p class="leading-relaxed text-sm">
            composerを利用すれば、あるライブラリをインストールするときに、そのライブラリに必要なライブラリ（依存ライブラリ）も自動的にインストールされるため、手動で探す必要がありません。
        </p>
        <p class="leading-relaxed text-sm">
            LaravelもPHPのライブラリの1つであるため、composerで扱います。Laravelにも多くの依存ライブラリがありますが、composerを使うと簡単にLaravelプロジェクトを作成できます。今後も、PHPライブラリを使用するときはcomposerを使用します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">ファイル構成</h3>
        <p class="leading-relaxed text-sm font-bold text-orange-600 bg-orange-50 p-3 rounded">この段階では、軽く眺めるだけにとどめて次に進んでください。</p>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-xs">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ファイル/フォルダ</th>
                        <th class="px-4 py-3 text-left">役割</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr><td class="px-4 py-3 font-mono font-bold">app/</td><td class="px-4 py-3">アプリケーションのためのファイル（ControllerやModel等）が格納されます</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">bootstrap/</td><td class="px-4 py-3">Laravel起動のためのファイルが置かれています（デザインのBootstrapとは別物）</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">config/</td><td class="px-4 py-3">アプリケーションの設定ファイルがあります</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">lang/</td><td class="px-4 py-3">多言語化のためのすべての言語ファイルを格納します</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">database/</td><td class="px-4 py-3">データベース関連（マイグレーションやシーダー等）のファイルがあります</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">public/</td><td class="px-4 py-3">公開設定ファイルや、CSS、JavaScript、画像等が格納されます</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">resources/</td><td class="px-4 py-3">View (Blade/HTML) などのファイルが格納されます</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">routes/</td><td class="px-4 py-3">ルーティング（URLの設定）などのファイルが格納されます</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">storage/</td><td class="px-4 py-3">キャッシュやログなどが格納されます</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">tests/</td><td class="px-4 py-3">自動テストファイルが格納されます</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">vendor/</td><td class="px-4 py-3">composerにより追加された外部ライブラリが格納されます</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">.editorconfig</td><td class="px-4 py-3">エディタのコードフォーマット設定ファイルです</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">.env</td><td class="px-4 py-3">DBの接続情報やパスワードなど機密情報を記述する環境変数ファイルです</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">artisan</td><td class="px-4 py-3"><code>php artisan ...</code> という形式の便利な独自コマンドを提供します</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">composer.json</td><td class="px-4 py-3">ライブラリの依存関係を管理するファイルです</td></tr>
                    <tr><td class="px-4 py-3 font-mono font-bold">vite.config.js</td><td class="px-4 py-3">フロントエンド構築ツール Vite の設定ファイルです</td></tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 p-6 bg-white border border-blue-200 rounded-xl shadow-sm">
            <h4 class="font-bold text-blue-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                本レッスンで頻繁に使う重要フォルダ
            </h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                <div class="bg-blue-50 p-2 rounded font-mono border border-blue-100">app/Http/Controllers</div>
                <div class="bg-blue-50 p-2 rounded font-mono border border-blue-100">app/Models/</div>
                <div class="bg-blue-50 p-2 rounded font-mono border border-blue-100">.env</div>
                <div class="bg-blue-50 p-2 rounded font-mono border border-blue-100">database/migrations/</div>
                <div class="bg-blue-50 p-2 rounded font-mono border border-blue-100">resources/views/</div>
                <div class="bg-blue-50 p-2 rounded font-mono border border-blue-100">routes/web.php</div>
            </div>
            <a href="https://readouble.com/laravel/9.x/ja/structure.html" target="_blank" class="text-xs text-blue-600 hover:underline mt-4 block">参考: アプリケーション構造（公式ドキュメント）</a>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">リンクをHTTPSにする設定を行なう</h3>
        <p class="leading-relaxed">
            おまじないを設定します。以下の設定を行なうことで、Laravelの機能で自動生成されるリンクのURLがhttpsになります。<br>
            Laravelプロジェクトの中にある <code>app/Providers/AppServiceProvider.php</code> を開き、<code>boot()</code>メソッドを以下のように変更してください。
        </p>
        <div class="bg-gray-800 rounded-lg p-5">
            <p class="text-gray-400 text-xs mb-3">// app/Providers/AppServiceProvider.php</p>
            <pre class="text-sm font-mono text-gray-300 leading-relaxed">
<span class="text-blue-400">public function</span> <span class="text-yellow-400">boot</span>()
{
    \<span class="text-green-400">URL</span>::forceScheme(<span class="text-orange-400">'https'</span>); <span class="text-gray-500">//リンクをHTTPSにする設定を行う</span>
}</pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">初期状態での動作確認</h3>
        <p class="leading-relaxed text-sm">
            Laravelを使ったメッセージボードの開発を始める前に、Webサーバを起動して動作確認しましょう。
        </p>
        
        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">サーバの起動</h4>
            <p class="text-sm">下記のコマンドを、プロジェクトフォルダ（<code>message-board/</code>）のトップで実行してください。</p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-sm">
                php artisan serve --host=127.0.0.1 --port=8000
            </div>
            <div class="flex justify-center py-4">
                <img src="/images/Lesson16-13.png" alt="サーバ起動結果" class="max-w-xl w-full h-auto border rounded shadow">
            </div>
            <p class="text-sm leading-relaxed">
                <code>artisan</code>（アルチザン）はLaravel専用の便利な職人コマンドです。今後、開発中に何度も使用することになります。
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl border-2 border-green-200">
            <h4 class="font-bold text-green-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                ブラウザで動作確認
            </h4>
            <div class="bg-gray-50 p-4 rounded mb-4">
                <p class="text-xs text-gray-500 mb-1">アクセスURL</p>
                <a href="http://127.0.0.1:8000" target="_blank" class="text-blue-600 font-mono font-bold hover:underline">http://127.0.0.1:8000</a>
            </div>
            <p class="text-sm mb-4">次のようにLaravelの初期画面が表示されれば、正常にプロジェクトが作成されています！</p>
            <div class="flex justify-center">
                <img src="/images/Lesson16-14.png" alt="Laravel初期表示画面" class="max-w-2xl w-full h-auto border rounded shadow-md">
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}