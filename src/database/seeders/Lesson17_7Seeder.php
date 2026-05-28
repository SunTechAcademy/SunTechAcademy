<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_7Seeder extends Seeder
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
                'sort_order' => 7,
            ],
            [
                'title' => 'Fly.ioにWebアプリケーションをデプロイする',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">Fly.ioにWebアプリケーションをデプロイする</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                ここまででSupabaseの設定は完了しましたので、Fly.ioへ、Laravelで作ったWebアプリケーションをデプロイします。
            </p>
            <p>
                今回はFly.ioのアカウント登録から説明しますので、すでにアカウントをお持ちの方は、以下「Fly.ioのアカウント登録」の手順1から3（Fly.ioのコマンドツールをインストールする）までを実行し、「補足：Fly.ioへのログイン」までスキップしてください。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Fly.ioのアカウント登録</h3>
        
        <div class="space-y-4 text-sm">
            <h4 class="font-bold">Fly.ioのサイトへアクセスする</h4>
            <p>以下にアクセスすると、アカウント登録からデプロイまでの流れを示すドキュメントのページが表示されます（全編英語）。その内容も参考にしながら、以下の手順を進めてください。</p>
            <a href="https://fly.io/docs/getting-started/launch-demo/" target="_blank" class="text-blue-600 underline font-mono italic">Hands on with Fly.io・Fly Docs (https://fly.io/docs/getting-started/launch-demo/)</a>
        </div>

        <div class="space-y-6 mt-8">
            <h4 class="font-bold text-lg">Fly.ioのコマンドツールをインストールする</h4>
            <p class="text-sm">（1）表示されたページには「macOS」「Linux」「Windows」があるのでそれぞれの環境に合わせてコマンドを実施していきましょう。<br>以下コマンドをターミナルへ入力、実行します。コマンドの入力はコピー＆ペーストでかまいません。</p>
            
            <div class="grid grid-cols-1 gap-6">
                <div class="p-4 bg-gray-50 border rounded-lg shadow-sm">
                    <p class="font-bold text-xs mb-2">macOS</p>
                    <p class="text-xs mb-2 text-gray-600">Homebrew パッケージマネージャーをインストールしている場合は、以下のコマンドで flyctl をインストールできます。</p>
                    <code class="block bg-gray-800 text-white p-3 rounded mb-4">brew install flyctl</code>
                    <p class="text-xs mb-2 text-gray-600">Homebrew を使用していない場合は、以下のインストールスクリプトを実行してください。</p>
                    <code class="block bg-gray-800 text-white p-3 rounded">curl -L https://fly.io/install.sh | sh</code>
                    <p class="text-[10px] mt-2 text-gray-500 italic">curl を使用して flyctl をインストールした場合は、flyctl のディレクトリをシェルの rc ファイル（.zshrc や .bashrc など）に追加する必要があります。インストールスクリプト実行後の出力に、コピー＆ペーストする設定内容が表示されるので、それを rc ファイルへ追加してください。設定後は、どのディレクトリからでも fly コマンドを使用できるようになります。</p>
                </div>

                <div class="p-4 bg-gray-50 border rounded-lg shadow-sm">
                    <p class="font-bold text-xs mb-2">Linux</p>
                    <p class="text-xs mb-2 text-gray-600">以下のインストールスクリプトを実行してください。</p>
                    <code class="block bg-gray-800 text-white p-3 rounded">curl -L https://fly.io/install.sh | sh</code>
                </div>

                <div class="p-4 bg-gray-50 border rounded-lg shadow-sm">
                    <p class="font-bold text-xs mb-2">Windows</p>
                    <p class="text-xs mb-2 text-gray-600">以下の PowerShell 用インストールスクリプトを実行してください。<strong>PowerShell ターミナルになっているか確認</strong>（VSCode ターミナル右上に powershell または pwsh と表示されていればOKです）。</p>
                    <code class="block bg-gray-800 text-white p-3 rounded">pwsh -Command "iwr https://fly.io/install.ps1 -useb | iex"</code>
                    <p class="text-[10px] mt-2 text-gray-500 italic">もし pwsh コマンドが見つからないというエラーが表示された場合は、代わりに powershell コマンドを使用できます。ただし、最新版の PowerShell をインストールすることを推奨します。</p>
                </div>
            </div>

            <p class="text-sm mt-6">（2）上記のコマンドの実行が完了したら、デプロイしたいLaravelアプリケーションの直下へ移動し、以下の3つのコマンドを順に実行します。</p>
            
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <p class="text-xs font-bold text-gray-500">Mac版（zsh）</p>
                    <pre class="bg-gray-800 text-white p-4 rounded text-xs mt-2 leading-relaxed">echo 'export FLYCTL_INSTALL="$HOME/.fly"' >> ~/.zshrc
echo 'export PATH="$FLYCTL_INSTALL/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc</pre>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-bold text-gray-500">Windows版（PowerShell）</p>
                    <pre class="bg-gray-800 text-white p-4 rounded text-xs mt-2 leading-relaxed">$env:Path += ";$HOME\.fly\bin"
fly version</pre>
                </div>
            </div>
        </div>

        <div class="space-y-6 mt-12">
            <h4 class="font-bold text-lg">Fly.ioでアカウントを登録する</h4>
            <p class="text-sm">（3）Chromeで、Fly.ioのドキュメントを表示していたタブに戻り、画面を下へスクロールさせて<strong>「2. Sign up or sign in」</strong>を確認します。</p>
            <p class="text-sm">（4）Sign Upのページに書かれている以下のコマンドを実行します。</p>
            
            <div class="p-4 bg-blue-50 border-l-4 border-blue-400">
                <p class="text-xs font-bold text-blue-800 mb-1 italic">Fly.io アカウントを新規作成する</p>
                <p class="text-xs text-blue-700 mb-2">Fly.io を初めて利用する場合は、以下のコマンドを実行します。</p>
                <code class="bg-gray-900 text-white px-3 py-1 rounded">fly auth signup</code>
            </div>

            <p class="text-sm">（5）コマンドを実行するとブラウザが開き、Fly.io のサインアップ画面へ移動します。</p>
            <p class="text-sm">（6）以下のような画面が表示されるので、Full name/Email/Passwordを入力して「Create My Account」をクリックします。GitHubなどのアカウントでの登録も可能ですが、本カリキュラムではメールとパスワードの入力によるアカウント登録を推奨します。</p>
            
            <div class="p-4 bg-red-50 border border-red-100 rounded text-xs text-red-800">
                <strong>※注意：Something went wrong</strong> と表示されてアカウント登録できない場合、Email欄に入力したメールアドレスが、Fly.io側で受け付けできないフリーメールのドメインである可能性が高いです。無料で取得できるメールアドレスではなく、プロバイダや携帯キャリア、あるいは会社のメールアドレスで登録を試みてください。
            </div>
            
            <img src="/images/Lesson17-22.png" alt="Fly.io Signup screen" class="max-w-full h-auto border rounded shadow-sm">

            <p class="text-sm">（7）この画面が表示されたら、「Continue as メールアドレス」を押下して以下のような画面が表示されます。表示されたら画面のブラウザのタブを閉じてください。</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <img src="/images/Lesson17-23.png" alt="Auth Step 1" class="border rounded shadow-sm">
                <img src="/images/Lesson17-24.png" alt="Auth Step 2" class="border rounded shadow-sm">
            </div>

            <p class="text-sm">（8）VScodeの画面に戻り、コンソールに <strong>successfully logged in as [Fly.ioに登録したメールアドレス]</strong> が表示されていることを確認してください。</p>
            <img src="/images/Lesson17-25.jpeg" alt="Successful Login Terminal" class="max-w-full h-auto border rounded shadow-sm">

            <p class="text-sm">（9）登録したメールアドレスに、Fly.ioから以下のようなメールアドレス認証依頼のメールが届きます。<br><strong>メールアドレスを認証しない場合、今後のサービスの利用を制限される可能性があります</strong>ので、メールを確認し、「Verify Email」をクリックして認証してください。</p>
            <img src="/images/Lesson17-26.jpeg" alt="Verification Email" class="max-w-full h-auto border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 italic">補足：Fly.ioへのログイン</h3>
        <p class="text-sm italic">登録済みのアカウントでFly.ioへログインする場合は、以下の手順で進めます。</p>
        <p class="text-sm">（1）Sign In（https://fly.io/docs/hands-on/sign-in/）のページに書かれている以下のコマンドをVScode上で実行します。</p>
        <code class="block bg-gray-800 text-white p-3 rounded text-xs">fly auth login</code>

        <p class="text-sm">（2）アカウント登録での手順7のように <code>Opening https://fly.io/app/auth/cli/...（略）...</code> のような文字列が表示されますので、このURLに、Chromeの別タブを開いてアクセスします。</p>
        <p class="text-sm">（3）画面の指示に沿ってログインします。<br>ログインが完了すると、VScodeのコマンドラインで <strong>successfully logged in as [Fly.ioに登録したメールアドレス]</strong> が表示されますので、確認してください。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Fly.ioにクレジットカードを登録する</h3>
        <p class="text-sm leading-relaxed">Fly.ioは厳格に本人確認を行なっています。アプリケーションのデプロイを行なうには、クレジットカードの登録が必要です。<br>以下の手順で、アカウントにクレジットカードの情報を登録してください。</p>
        
        <p class="text-sm">（1）Fly.ioのダッシュボードのページ（<a href="https://fly.io/dashboard/sunsuntech/billing" target="_blank" class="text-blue-600 underline font-mono italic">https://fly.io/dashboard/sunsuntech/billing</a>）へログインしてアクセスし、画面上部に表示されている緑のバーをクリックします。</p>
        <img src="/images/Lesson17-30.png" alt="Billing Green Bar" class="max-w-full h-auto border rounded shadow-sm">

        <p class="text-sm">Continueを押下</p>
        <img src="/images/Lesson17-31.png" alt="Billing Continue" class="max-w-full h-auto border rounded shadow-sm">

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded text-xs text-yellow-900 italic">
            クレジットカードの有効性を確認するため、10ドル未満の少額の請求をされる場合がありますが、これは一時的な請求です。1週間ほどで返金（請求の取り消し）になります。
        </div>

        <h4 class="font-bold text-lg mt-8">Fly.ioの価格</h4>
        <p class="text-sm">Fly.ioの価格体系は、有料プランと利用状況に応じた従量課金（月単位）となっています。以下は、公式のドキュメントです。</p>
        <ul class="list-disc pl-6 text-xs text-blue-600 underline space-y-1">
            <li><a href="https://fly.io/pricing" target="_blank">Plan Pricing・Fly (https://fly.io/pricing)</a></li>
            <li><a href="https://fly.io/docs/about/pricing/" target="_blank">Fly.io Resource Pricing・Fly Docs (https://fly.io/docs/about/pricing/)</a></li>
        </ul>
        <p class="text-sm leading-relaxed">新規にFly.ioへアカウント登録した直後は、Hobbyプラン（月5ドル）に加入された状態となっています。ただし、5ドル分の試用のクレジットがアカウントに付与されていて、従量課金によって試用のクレジットを使い切らない限りは、Hobbyプランの月額課金は開始されません。</p>
        <p class="text-sm leading-relaxed">従量課金は、Chapter 3で紹介したスペックの制限を超える使い方をすることで発生します。しかし、自身でサーバの性能を増強するなどせず、カリキュラムに記載のとおりに利用する限りは、従量課金やHobbyプランの課金は発生しません（無料でカリキュラムの学習を完了できます）。</p>
        
        <div class="bg-gray-100 p-4 rounded text-xs border border-gray-300">
            カリキュラムの学習完了後、Fly.ioをもう利用しない場合は、アカウントを無効化してください。アカウントの無効化は <a href="https://fly.io/user/settings" target="_blank" class="text-blue-600 underline">ユーザのSettingページ</a> にある「Delete Account」で行なえます。
        </div>

        <div class="p-4 bg-red-50 border border-red-200 rounded text-xs font-bold text-red-800">
            どうしてもクレジットカードを登録できない場合：<br>
            諸事情によりクレジットカードは登録できない、という場合は、本レッスンと以降の学習内容・提出課題でFly.ioを利用できないことになります。
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Fly.ioへデプロイする</h3>
        <p class="text-sm">Fly.ioへログインできている状態になりましたら、以下の手順で、構築したWebアプリケーションをデプロイします。</p>

        <h4 class="font-bold text-lg">デプロイするための初期設定を実施する</h4>
        <p class="text-sm">（1）VScodeのターミナル（コンソール）上で、メッセージボードのプロジェクトのフォルダへ移動し、 <code>fly launch</code> というコマンドを実行します。</p>
        <code class="block bg-gray-900 text-white p-3 rounded text-xs mb-6 italic">fly launch</code>

        <p class="text-sm">（2）Fly.ioのツールは「メッセージボードがLaravelのWebアプリケーションである」ことを自動で認識し、推奨される設定を表示します。それに続いて <strong>Do you want to tweak these settings before proceeding?</strong>（デプロイを進める前に上記の設定を調整しますか？）と表示されますので、 <strong>y</strong> を入力してEnterキーを押します。</p>
        <p class="text-sm">（3）設定を調整するページのURLが表示されますので、そのURLへアクセスします。</p>
        <img src="/images/Lesson17-32.png" alt="Fly Launch tweak URL" class="max-w-full h-auto border rounded shadow-sm">

        <div class="space-y-6 mt-8">
            <p class="text-sm">（4）フォームの入力内容を確認・変更します。</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 bg-gray-50 p-6 rounded-lg border text-xs">
                <div><span class="font-bold">App name:</span> 適当なアプリケーション名 を入力</div>
                <div><span class="font-bold">Organization:</span> Personal を選択</div>
                <div><span class="font-bold">Region:</span> nrt - Tokyo, Japan を選択</div>
                <div><span class="font-bold">Port:</span> 8080 を入力</div>
                <div><span class="font-bold">VM Sizes:</span> shared-cpu-1x を選択</div>
                <div><span class="font-bold">VM Memory:</span> 256MB を選択</div>
                <div><span class="font-bold">Postgres:</span> Provider:none を選択（Supabaseを利用するため）</div>
                <div><span class="font-bold">Tigris Object Storage:</span> Disabled</div>
                <div><span class="font-bold">Redis → Provider:</span> none を選択</div>
                <div><span class="font-bold">Sentry:</span> Disabled</div>
            </div>
            <p class="text-xs text-gray-500 italic mt-2 text-center">入力が完了したら「Confirm Settings」をクリックします。</p>
            <img src="/images/Lesson17-33.png" alt="Fly Launch Settings Form" class="max-w-full h-auto border rounded shadow-sm mx-auto">
        </div>

        <p class="text-sm mt-8">（5）設定が完了すると、以下の文言を表示した画面が表示されます。この画面は閉じてもらってかまいません。</p>
        <img src="/images/Lesson17-34.png" alt="Configuration Finished" class="max-w-full h-auto border rounded shadow-sm mx-auto">

        <p class="text-sm leading-relaxed mt-8">（6）コンソール画面に戻ると、Fly.ioのツールが初期設定を進めていますので、処理が完了するまでしばらく待ちます。コンソールに <strong>Visit your newly deployed app at https://(アプリケーション名).fly.dev/</strong> と表示されれば、処理は完了です。<br>
        <span class="text-red-600 font-bold">ただし、この時点で完了したのは初期設定だけであり、表示されたURLへアクセスしても500エラーになります。注意してください。</span></p>

        <div class="bg-red-50 p-6 border-l-4 border-red-500 rounded-r shadow-sm">
            <h5 class="font-bold text-red-800 text-sm mb-2">エラーが出ている場合はおそらく以下を確認してください</h5>
            <p class="text-xs text-red-700 leading-relaxed">
                <strong>fly.toml</strong> ファイルを開いてください。<br>
                <code>PHP_VERSION = "8.0"</code> となっている箇所を以下のように変更してください。<br>
                <code>PHP_VERSION = "8.4"</code><br>
                その後、VScodeで <code>fly deploy</code> を行ってください。
            </p>
        </div>

        <p class="text-sm mt-10">（7）IPアドレスの設定に問題ない（従量課金の発生する設定になっていない）かを確認します。コンソールで以下のコマンドを実行します。</p>
        <code class="block bg-gray-900 text-white p-3 rounded text-xs mb-4">flyctl ips list</code>
        <p class="text-sm mb-4">以下のような内容が表示されます。ここで <strong>v4</strong> の項目について、TYPE欄に <strong>(shared)</strong>（共有という意味です）と表示されていることを確認します。</p>
        <img src="/images/Lesson17-35.png" alt="IPs list shared check" class="max-w-full h-auto border rounded shadow-sm">

        <div class="p-5 bg-orange-50 border border-orange-200 rounded text-xs text-orange-900 shadow-inner">
            <p class="font-bold mb-2">もし v4 のTYPE欄に (dedicated)（専有という意味です）と表示されている場合、従量課金が発生します。</p>
            <p class="mb-4">そのため、以下の2つのコマンドを順番に実行し、v4が (shared) へ変更されるようにしてください。</p>
            <code class="block bg-gray-800 text-white p-2 rounded mb-2">fly ips release (v4のIPアドレス) -a (アプリケーション名)</code>
            <code class="block bg-gray-800 text-white p-2 rounded">fly ips allocate-v4 --shared -a (アプリケーション名)</code>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 italic">デプロイする</h3>
        <p class="text-sm">（8） <code>fly launch</code> の実行後、プロジェクト内に以下の3つのファイルと1つのフォルダが追加されていることを確認します。</p>
        <ul class="list-disc pl-8 text-sm font-mono text-gray-600 space-y-1">
            <li>.dockerignore</li>
            <li>Dockerfile</li>
            <li>fly.toml</li>
            <li>.fly（フォルダ）</li>
        </ul>

        <div class="space-y-4">
            <p class="text-sm">（9） <strong>fly.toml</strong> を開き、[env]欄に以下の設定値を追加します（xxxxxx の部分はご自身の設定値で置き換えてください）</p>
            <div class="bg-gray-800 text-green-300 p-5 rounded font-mono text-xs leading-relaxed overflow-x-auto shadow-inner">
                APP_URL = 'https://[アプリケーション名].fly.dev' <span class="text-gray-500">（fly launch の際にコンソールで表示されたURL）</span><br>
                APP_NAME = 'message-board' <span class="text-gray-500">（好きな名前でかまいません）</span><br>
                APP_DEBUG = false<br>
                DB_CONNECTION = 'pgsql'<br>
                DB_HOST = 'aws-xxxxxx.supabase.com' <span class="text-gray-500">（SupabaseのConnection Infoの「Host」）</span><br>
                DB_PORT = 6543 <span class="text-gray-500">（SupabaseのConnection Infoの「Port」）</span><br>
                DB_DATABASE = 'postgres' <span class="text-gray-500">（SupabaseのConnection Infoの「Database name」）</span><br>
                DB_USERNAME = 'postgres.xxxxxx...' <span class="text-gray-500">（SupabaseのConnection Infoの「User」）</span>
            </div>
        </div>

        <p class="text-sm">（10） <strong>DB_PASSWORD</strong> のみ、fly.toml ではなく、以下のコマンドで登録します。（xxxxxxxxxx は、別途メモしておいたSupabaseのパスワードで書き換えてください）</p>
        <code class="block bg-gray-900 text-white p-3 rounded text-xs mb-8">fly secrets set DB_PASSWORD='xxxxxxxxxx'</code>

        <div class="space-y-4">
            <p class="text-sm">（11） <strong>fly.toml</strong> の以下の項目について、初期設定で問題なく設定されているかを確認します。異なるものが設定されている場合は修正してください。</p>
            <div class="bg-gray-100 p-5 rounded font-mono text-xs text-gray-800 border shadow-sm">
                [build]<br>
                [build.args]<br>
                PHP_VERSION = '8.4' <span class="text-gray-500 italic">（XAMPP上のPHPと同じバージョンにする）</span><br><br>
                [http_service] <span class="text-gray-500 italic">（※以下の3つは従量課金の発生の可能性を少なくするための設定）</span><br>
                auto_stop_machines = true <span class="text-gray-500 italic">（長時間アクセスがなかった場合にサーバを自動で休止する）</span><br>
                auto_start_machines = true <span class="text-gray-500 italic">（休止状態のサーバにアクセスがあったらサーバを自動で復帰させる）</span><br><br>
                [[vm]] <span class="text-gray-500 italic">（※fly launchコマンドの際に入力した情報のとおりになっていることを確認）</span><br>
                memory = '256mb'<br>
                cpus = 1<br>
                memory_mb = 256
            </div>
        </div>

        <div class="space-y-4 mt-10">
            <p class="text-sm">（12）デプロイ前に「npm run build」を行ないます。以下の手順で進めてください。なお、<span class="font-bold underline">※この手順はメッセージボードやタスク管理アプリのデプロイでは不要なので、手順（13）へスキップしてください。</span></p>
            <div class="p-4 bg-gray-50 border rounded text-xs text-gray-600 leading-relaxed italic">
                具体的に言うと、Laravel Breezeを使っている、あるいはTailwindをnpmからインストールしている場合のみ、この手順は必須となります。Laravel Breezeは、次のレッスンで使用しますので、詳しく知りたい方は次のレッスンを参照してください。
            </div>
            <div class="space-y-4 pl-4 text-xs">
                <p>１． .envを開き、以下の環境変数を追加（[アプリケーション名]はFly.ioの設定値）：<br>
                <code class="bg-gray-200 px-2 py-1 rounded">ASSET_URL=https://[アプリケーション名].fly.dev</code></p>
                
                <p>２． 以下のコマンドを実行：<br>
                <strong>Macの場合：</strong> <code class="bg-gray-200 px-2 py-1 rounded">brew install node</code><br>
                <strong>Windowsの場合：</strong> 公式サイトからLTS版（推奨版）をインストール：<br>
                <a href="https://nodejs.org/ja" target="_blank" class="text-blue-600 underline font-mono italic">Node.js公式サイト (https://nodejs.org/ja)</a></p>
                
                <p>３． 以下のコマンドを実行：<br>
                <code class="bg-gray-800 text-white px-2 py-1 rounded">npm install</code><br>
                <code class="bg-gray-800 text-white px-2 py-1 rounded">npm run build</code></p>
            </div>
        </div>

        <p class="text-sm mt-10">（13）以下のコマンドをVScode上（メッセージボードのアプリケーションのフォルダ内）で実行することで、デプロイが実施されます。完了までしばらく時間がかかるので、待ちましょう。</p>
        <code class="block bg-blue-900 text-white p-3 rounded text-sm font-bold shadow-lg italic">fly deploy</code>

        <p class="text-sm mt-6">（14）<strong>deployed app at</strong> と表示されたら、Chromeで <strong>https://[アプリケーション名].fly.dev</strong> にアクセスする。作成したアプリケーションが閲覧できればOKです！</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">補足：Fly.io上のアプリケーションからSupabaseのマイグレーションを実施する</h3>
        <p class="text-sm leading-relaxed">以下のようなコマンドをVScode上で実行することで、デプロイされたアプリケーションから Supabase 上のデータベースに対してマイグレーションの操作を実施できます。アプリケーションの動作に問題なければ実施不要ですが、補足情報として記載します。</p>
        
        <div class="space-y-4">
            <p class="text-xs font-bold text-gray-500 italic">例: マイグレーションの実行状況を確認する</p>
            <code class="block bg-gray-800 text-white p-3 rounded text-[11px] font-mono shadow-inner">fly ssh console -C "php /var/www/html/artisan migrate:status"</code>
            
            <p class="text-xs font-bold text-gray-500 italic">例: マイグレーションを実行する</p>
            <code class="block bg-gray-800 text-white p-3 rounded text-[11px] font-mono shadow-inner">fly ssh console -C "php /var/www/html/artisan migrate"</code>
        </div>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded text-xs italic">
            <p class="font-bold mb-2">マイグレーション実行時に確認メッセージで止まったとき</p>
            <p><code>Do you really wish to run this command? (yes/no) [no]</code> という確認メッセージで止まった際は <strong>yes</strong> を入力してください。</p>
            <pre class="mt-2 text-gray-800">❯ yes</pre>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}