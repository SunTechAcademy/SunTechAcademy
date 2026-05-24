<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_4Seeder extends Seeder
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
                'sort_order' => 4,
            ],
            [
                'title' => 'データベースとLaravelの接続設定',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">データベースとLaravelの接続設定</h2>
        <div class="prose max-w-none space-y-4">
            <p>
                Modelの作成を始める前に、 Laravelアプリケーションとデータベースの接続を行ないましょう。データベースを接続しないと、 Modelが持っているデータの保存場所がありません。 <strong>Modelはデータベースと密接に関わっており、データベースのレコードやカラムを参照します。</strong>
            </p>
            <p>
                Laravelはいくつかのデータベースに対応しています。本コースでは前のレッスンで学んだMySQLを使用しましょう。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MySQLサーバの起動</h3>
        <p class="text-sm">まずはMySQLサーバが起動しているか、以下のコマンドで確認してください。</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-900 rounded-lg p-4">
                <p class="text-gray-400 text-xs mb-2">Macの場合</p>
                <code class="text-green-400 text-xs break-all">/Applications/XAMPP/xamppfiles/bin/mysql -u root -p</code>
            </div>
            <div class="bg-gray-900 rounded-lg p-4">
                <p class="text-gray-400 text-xs mb-2">Windowsの場合</p>
                <code class="text-green-400 text-xs break-all">C:\xampp\mysql\bin\mysql.exe -u root -p</code>
            </div>
        </div>
        <p class="text-sm italic text-gray-500">※パスワードは空で大丈夫です</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Laravelのデータベース接続設定</h3>
        <p class="text-sm">Laravelのデータベースの接続設定を管理しているファイルは <code>config/database.php</code> です。下記には重要な箇所のみ抽出しています。</p>
        
        <div class="bg-gray-800 rounded-lg p-5 font-mono text-sm overflow-x-auto">
            <p class="text-gray-500 mb-2">// config/database.php</p>
            <code class="text-gray-300">'default' => env('DB_CONNECTION', 'mysql'),</code>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-400 text-sm space-y-4">
            <p>
                <code>env()</code> 関数は <code>env('A', 'B')</code> と書かれたときは <strong>A という 環境変数の値</strong> を返しますが、 A という環境変数が定義されていなかった場合には <strong>'B' という文字列</strong> を返します。
            </p>
            <p>
                上記のように、 <code>env('DB_CONNECTION', 'mysql')</code> と書かれていれば、まずは <code>DB_CONNECTION</code> という環境変数が定義されているか確認します。定義されていればその値を返し、定義されていなければ、 <code>'mysql'</code> を返します。
            </p>
            <p>
                環境変数 <code>DB_CONNECTION</code> が設定されていればその値が優先されるため、環境変数で指定されたデータベースが選択されます。逆に、環境変数 <code>DB_CONNECTION</code> が設定されていなければ、データベースはMySQLが選択されます。
            </p>
            <a href="https://readouble.com/laravel/9.x/ja/helpers.html#method-env" target="_blank" class="text-blue-600 hover:underline inline-block">参考: env() - 公式ドキュメント</a>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">環境変数</h4>
            <p class="text-sm leading-relaxed">
                環境変数とは、ターミナルの変数です。変数と言えばプログラム内で利用され、プログラムが終了すると消えてしまうものでしたが、環境変数を使えばいつまでも設定値が残ります。
            </p>
            <p class="text-sm leading-relaxed">
                Laravelサーバ起動時のコマンドにも環境変数が入っていました。 <code>$IP</code> と <code>$PORT</code> です。これらはターミナル上で、 <code>echo $IP</code> や <code>echo $PORT</code> を実行すると、環境変数の値を確認できます。
            </p>
            <p class="text-sm leading-relaxed">
                また、 Laravelサーバ起動中の環境変数はすべて <code>$_ENV</code> の中に入っており、 <code>$_ENV</code> はLaravelプロジェクト内のPHPファイルで操作できます（ただし、その機会はほとんどありません）。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">tinkerで環境変数を確認</h3>
        <p class="text-sm">Laravelの環境変数を確認してみましょう。まずは、以下のコマンドを入力し、tinkerの起動します。</p>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-sm mb-4">
            php artisan tinker
        </div>

        <div class="bg-yellow-50 p-4 border border-yellow-200 rounded text-xs text-yellow-800 mb-4">
            <strong>Psy Shell(artisan tinker)のプロンプト表示について</strong><br>
            以降のカリキュラムにおいて、プロンプトが「>>>」となっている箇所がありますが、環境により「>」となる場合があります。適宜読み換えてご確認ください。
        </div>

        <p class="text-sm">tinkerが起動したら、下記コマンドを入力してください。</p>
        <div class="bg-gray-800 rounded-lg p-4 font-mono text-white text-sm">
            <span class="text-gray-500">>>></span> print_r($_ENV);
        </div>
        <p class="text-sm mt-2">すると、設定されている環境変数が表示されます。 <code>DB_CONNECTION</code> は、おそらく 'mysql' になっていると思います。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">.envファイルが環境変数を設定している</h3>
        <p class="text-sm">
            では、 Laravelの環境変数を決めているのは誰かというと、<strong>.envファイル</strong>です。Laravelプロジェクトのトップにある <code>.env</code> ファイルを開いてみてください。
        </p>
        
        <div class="bg-gray-800 rounded-lg p-5 font-mono text-sm text-gray-300">
            <p class="text-gray-500 mb-2"># .env （一部抜粋）</p>
            DB_CONNECTION=mysql
        </div>

        <p class="text-sm leading-relaxed">
            上記のように .envファイルによって環境変数が設定されていることがわかります。<br>
            もし、 MySQLでないデータベースを選びたい場合には、 .envファイルの <code>DB_CONNECTION=mysql</code> の値を変更して設定することになります。
        </p>
        <p class="text-sm bg-gray-50 p-4 rounded border italic">
            ※config/database.phpのコード自体を書き換えるのではなく、環境情報を1つのファイル（.env）に集約することで設定漏れなどのミスを防ぐ方法が推奨されます。
        </p>

        <h4 class="font-bold text-gray-800 mt-8">DB_CONNECTION以外の接続情報を確認する</h4>
        <p class="text-sm">次にMySQLのその他の接続設定値も見ていきましょう。</p>
        <div class="bg-gray-900 rounded-lg p-5 font-mono text-xs overflow-x-auto text-gray-400">
            <p class="text-gray-600 mb-2">// config/database.php （一部抜粋）</p>
            <pre>
'mysql' => [
    'driver'      => 'mysql',
    'url'         => env('DATABASE_URL'),
    'host'        => env('DB_HOST', '127.0.0.1'),
    'port'        => env('DB_PORT', '3306'),
    'database'    => env('DB_DATABASE', 'forge'),
    'username'    => env('DB_USERNAME', 'forge'),
    'password'    => env('DB_PASSWORD', ''),
    ...
],</pre>
        </div>
        <p class="text-sm leading-relaxed">
            <code>DB_CONNECTION</code> に 'mysql' が設定されていると、上記の内容が適用されます。大事なのは <strong>database, username, password</strong> ですが、すべて <code>env()</code> です。したがって、 <code>.env</code> で設定しましょう。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">.envのDB接続のための環境変数を修正する</h3>
        <p class="text-sm">初期状態では <code>laravel</code> というデータベースへ接続する設定になっているため、 <code>DB_DATABASE</code> の値を変更します。</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-red-50 p-4 rounded border border-red-100">
                <p class="text-xs text-red-400 mb-2">修正前 (.env)</p>
                <code class="text-sm text-red-700">DB_DATABASE=laravel<br>DB_USERNAME=root<br>DB_PASSWORD=</code>
            </div>
            <div class="bg-green-50 p-4 rounded border border-green-100">
                <p class="text-xs text-green-400 mb-2">修正後 (.env)</p>
                <code class="text-sm text-green-700 font-bold">DB_DATABASE=message-board<br>DB_USERNAME=dbuser<br>DB_PASSWORD=dbpass</code>
            </div>
        </div>

        <div class="p-4 bg-gray-50 border-l-4 border-gray-400 text-xs leading-relaxed">
            これにより、<strong>message-board</strong>というデータベースへ<strong>dbuser</strong>ユーザ（パスワードは <strong>dbpass</strong>）で接続することになります。このユーザは Lesson 12 で作成したものです。
        </div>

        <p class="text-sm font-bold text-red-600 bg-red-50 p-3 rounded">
            変更したら .env ファイルを必ず保存してください。WebサーバやTinkerが動作中の場合は再起動が必要です（起動時に読み込まれるため）。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">message-boardデータベースの作成</h3>
        <p class="text-sm">まだ <code>message-board</code> データベース本体を作成していませんでした。まずは作成しましょう。</p>
        
        <div class="space-y-4">
            <p class="text-sm font-bold">1. MySQLにログインします</p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-xs text-green-400">
                # Macの場合<br>
                /Applications/XAMPP/xamppfiles/bin/mysql -u root -p<br><br>
                # Windowsの場合<br>
                C:\xampp\mysql\bin\mysql.exe -u root -p
            </div>
        </div>

        <div class="space-y-4">
            <p class="text-sm font-bold">2. データベース作成のSQLを実行します</p>
            <div class="bg-gray-800 rounded-lg p-4 font-mono text-sm text-white">
                <span class="text-gray-500">mysql></span> CREATE DATABASE `message-board`;
            </div>
            <p class="text-xs text-gray-500 italic">
                ※注意： <code>message-board</code> は <code>-</code>（ハイフン）を含むため、 <strong>`</strong>（バッククオート）で囲う必要があります。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">tinkerでデータベースの接続確認</h3>
        <p class="text-sm">接続されているか確認するためにtinkerを起動（<code>php artisan tinker</code>）します。</p>
        
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-green-400">
            $ php artisan tinker
        </div>

        <p class="text-sm">tinker上で、 <code>DB::reconnect();</code> を実行してみましょう。</p>
        <div class="bg-gray-800 rounded-lg p-4 font-mono text-sm text-white">
            <span class="text-gray-500">>>></span> DB::reconnect();
        </div>

        <div class="bg-blue-50 p-4 rounded text-xs text-blue-800">
            <code>DB::connection();</code> でも確認できますが、 <code>reconnect()</code> の方がMySQLサーバが停止している際などに確実にエラーを検知できます。
        </div>

        <div class="space-y-2">
            <p class="text-sm font-bold text-green-600 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                成功時の表示例
            </p>
            <code class="block bg-gray-100 p-2 text-xs">=> Illuminate\Database\MySqlConnection {#7179}</code>
        </div>

        <div class="space-y-2">
            <p class="text-sm font-bold text-red-600 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                失敗（エラー）時の例
            </p>
            <code class="block bg-red-100 p-2 text-xs text-red-700">PDOException with message 'SQLSTATE[HY000] [2002] Connection refused'</code>
            <p class="text-xs text-gray-600 italic">※エラーが出た場合はDBが起動しているか、.envの設定値が正しいか見直してください。</p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">タイムゾーンの設定</h3>
        <p class="text-sm leading-relaxed">
            タイムゾーンの設定を「東京（Asia/Tokyo）」にしておけば、 Modelからレコードを保存したときなどにおいて、時間情報（created_at など）が設定したタイムゾーンの時間で保存されます。
        </p>
        <div class="bg-gray-800 rounded-lg p-5 font-mono text-sm text-gray-300">
            <p class="text-gray-500 mb-2">// config/app.php</p>
            'timezone' => 'Asia/Tokyo',
        </div>
    </section>

    <section class="bg-gray-100 p-6 rounded-2xl">
        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
            GitHubにプッシュしましょう
        </h3>
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-xs space-y-1">
            <p>git add -A</p>
            <p>git commit -m "set timezone"</p>
            <p>git push origin main</p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}