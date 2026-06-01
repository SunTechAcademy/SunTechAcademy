<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象 of Lesson を取得
        $lesson = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：応用')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 5,
            ],
            [
                'title' => 'Breezeとは',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">Breezeとは</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                Breezeとは、ログイン機能、ユーザー登録、パスワードのリセット、メールの検証、パスワードの確認など、Laravelを利用した認証機能の最小構成をシンプルに利用できるライブラリです。
            </p>
            <p>
                Breezeでは、Tailwind CSSでスタイルを設定したBladeテンプレートが利用可能です。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Breezeの概要</h3>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                認証というのは、ユーザー登録やログイン・ログアウト処理を意味します。<br>
                このレッスンでは認証にLaravel Breezeを利用します。
            </p>
            
            <h4 class="font-bold text-base text-gray-800 mt-6 mb-2">Breezeの登場</h4>
            <p>
                Laravel5以前では、Laravelに備わっているAuthライブラリを利用して、エンジニア独自の認証処理を実装する必要がありました。
            </p>
            <p>
                Laravel6からは、Laravel/UIという認証ライブラリを利用して、認証機能の実装が可能になりました。Laravel/UIの登場で、一気に認証機能実装の工数が削減できました。<br>
                Laravel/UIには、ログイン機能・パスワードリセット・メール認証などの基本的な認証機能が用意されています。また、フロントエンドフレームワークとして、Bootstrap、Vue.js、Reactから選択できます。
            </p>
            <p>
                Laravel8から、Laravel Breezeという認証ライブラリを利用して、認証機能の実装が可能になりました。<br>
                Laravel Breezeには、Laravel/UIと同様に、ログイン機能・パスワードリセット・メール認証などの基本的な認証機能が用意されています。Laravel Breezeでは、Tailwind CSSというCSSフレームワークを利用できます。
            </p>
        </div>

        <div class="text-xs space-y-1 bg-gray-50 p-4 rounded border">
            <p>公式Laravel Breeze：<a href="https://readouble.com/laravel/9.x/ja/starter-kits.html" target="_blank" class="text-blue-600 underline font-mono">https://readouble.com/laravel/9.x/ja/starter-kits.html</a></p>
            <p>Github:Laravel/Breeze：<a href="https://github.com/laravel/breeze" target="_blank" class="text-blue-600 underline font-mono">https://github.com/laravel/breeze</a></p>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-3">
            <h4 class="font-bold text-sm text-gray-800">（参考）Jetstream</h4>
            <p class="text-xs leading-relaxed text-gray-600">
                Laravel8からは、Laravel Breeze以外にも、Laravel Jetstreamという認証ライブラリも用意されました。Laravel Jetstreamでは、ログイン機能・パスワードリセット・メール認証・2段階認証・セッション管理・プロフィール更新・チーム機能など、Laravel/UIやLaravel Breezeに比べても高機能なライブラリです。しかし、実装難易度が高くなるため、カリキュラムではLaravel Breezeを利用しています。
            </p>
            <p class="text-xs text-gray-500">
                Github:Jetstream：<a href="https://github.com/laravel/jetstream" target="_blank" class="text-blue-600 underline font-mono">https://github.com/laravel/jetstream</a>
            </p>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Breezeのインストール</h3>
        <p class="text-sm leading-relaxed">
            ここではcomposerを利用してLaravel Breezeをインストールします。microposts フォルダに移動していない場合は、 <code class="bg-gray-100 px-1 rounded text-red-600 font-bold">cd microposts</code> で移動しておいてください。
        </p>

        <ul class="list-disc pl-5 text-sm space-y-1 text-gray-600 font-bold">
            <li>composer require laravel/breeze --dev で、composerでLaravel Breezeを準備</li>
            <li>php artisan breeze:install で、Laravel Breezeをインストール</li>
            <li>php artisan migrate で、Laravel Breezeで利用するテーブルを生成</li>
            <li>npmでフロントエンドライブラリの準備</li>
        </ul>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-lg text-gray-800 border-l-2 border-gray-400 pl-2">1. composerでLaravel Breezeを準備</h4>
            <p class="text-sm leading-relaxed">
                次のコマンドでLaravel Breezeの情報をcomposer.json と composer.lockに自動追加します。<br>
                今回のコマンドで、Laravel Breezeのパッケージ名とバージョンが記載されます。パッケージは、プロジェクトフォルダの直下にあるvendorフォルダの下に配置されます。
            </p>
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 italic">Laravel Breezeの情報を追加</p>
                <code class="block bg-gray-900 text-white p-4 rounded font-mono text-sm shadow-inner">$ composer require laravel/breeze --dev</code>
            </div>
            
            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded text-xs text-yellow-800 leading-relaxed">
                もし、次のような表示が出れた場合は <strong>Y</strong> を入力してください。<br>
                <strong>Continue as root/super user [yes]?</strong>
            </div>

            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 italic">実行結果</p>
                <pre class="bg-gray-800 text-gray-300 p-4 rounded font-mono text-xs overflow-x-auto">79 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
> @php artisan vendor:publish --tag=laravel-assets --ansi --force
PHP Warning:  Module "curl" is already loaded in Unknown on line 0

   INFO  No publishable resources for tag [laravel-assets].</pre>
                <p class="text-sm text-gray-600">次のような表示が出れば、パッケージの準備が完了していることを意味します。</p>
            </div>
        </div>

        <div class="space-y-4 pt-6">
            <h4 class="font-bold text-lg text-gray-800 border-l-2 border-gray-400 pl-2">2. Laravel Breezeをインストール</h4>
            <p class="text-sm leading-relaxed">
                次の composer install を実行することで、composer.json と composer.lockに追加されたライブラリをインストールします。
            </p>
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 italic">composer install の実行</p>
                <code class="block bg-gray-900 text-white p-4 rounded font-mono text-sm shadow-inner">$ php artisan breeze:install</code>
            </div>

            <p class="text-sm">すると、以下の選択画面となります。ここでは、bladeの0を入力します。</p>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                <img src="/images/Lesson18-13.png" alt="Breeze install option select" class="w-full h-auto rounded border">
            </div>

            <p class="text-sm">なお、選択項目については以下のとおりです。</p>
            <ul class="list-none pl-4 space-y-1 text-sm border-l-2 border-gray-200">
                <li><strong>blade</strong>は、LaravelのテンプレートエンジンであるBladeを利用するとき</li>
                <li><strong>react</strong>は、フロントエンドフレームワークのReactを利用するとき</li>
                <li><strong>vue</strong> は、フロントエンドフレームワークのVueを利用するとき</li>
                <li><strong>api</strong>は、モダンなJavaScriptアプリケーションで認証するAPIを利用するとき</li>
            </ul>

            <p class="text-sm mt-4">次に、画面テーマの色を選択する項目が表示されます。ここではEnterを入力します。</p>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                <img src="/images/Lesson18-14.png" alt="Breeze darkmode option select" class="w-full h-auto rounded border">
            </div>
            <p class="text-xs text-gray-500 italic">※ なお、画面テーマを黒にする場合は、yesと入力します。</p>

            <p class="text-sm mt-4">最後に、PHPテストフレームワークを利用有無についての選択が表示されます。ここでもEnterを入力します。</p>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                <img src="/images/Lesson18-15.png" alt="Breeze test framework select" class="w-full h-auto rounded border">
            </div>
            <p class="text-sm">すると、インストール作業が開始されますので、しばらく待ちます。</p>
        </div>

        <div class="space-y-4 pt-6">
            <h4 class="font-bold text-lg text-gray-800 border-l-2 border-gray-400 pl-2">3. Laravel Breezeで利用するテーブルを生成</h4>
            <p class="text-sm leading-relaxed">
                次の、 <code>php artisan migrate</code> でマイグレーションを実行することで、Laravel Breezeを利用するために必要なusersテーブル情報を反映させます。
            </p>
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 italic">マイグレーションの実行</p>
                <code class="block bg-gray-900 text-white p-4 rounded font-mono text-sm shadow-inner">$ php artisan migrate</code>
            </div>
            <p class="text-sm leading-relaxed">
                ユーザテーブル以外にも、パスワードリセットやキュージョブのためのマイグレーションファイルがあらかじめ用意されており、それらのテーブルも作成されます。このカリキュラムでは扱わないため、詳しく知りたい方は公式ドキュメントをご覧ください。
            </p>
            <div class="text-xs space-y-1 bg-gray-50 p-4 rounded border">
                <p>パスワードリセット - Laravel 9.x：<a href="https://readouble.com/laravel/9.x/ja/passwords.html" target="_blank" class="text-blue-600 underline font-mono">https://readouble.com/laravel/9.x/ja/passwords.html</a></p>
                <p>キュー - Laravel 9.x：<a href="https://readouble.com/laravel/9.x/ja/queues.html" target="_blank" class="text-blue-600 underline font-mono">https://readouble.com/laravel/9.x/ja/queues.html</a></p>
            </div>

            <p class="text-sm mt-4">mysqlで確認すると次のようなテーブルが作成されていることがわかります。</p>
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 italic">テーブル一覧</p>
                <pre class="bg-gray-800 text-green-400 p-4 rounded font-mono text-xs overflow-x-auto">DB > USE tables
DB > show tables;
+--------------------------+
| Tables_in_microposts     |
+--------------------------+
| failed_jobs              |
| migrations               |
| password_resets          |
| personal_access_tokens   |
| users                    |
+--------------------------+
5 rows in set (0.00 sec)</pre>
            </div>
        </div>

        <div class="space-y-4 pt-6">
            <h4 class="font-bold text-lg text-gray-800 border-l-2 border-gray-400 pl-2">4. npmでフロントエンドライブラリの準備</h4>
            <p class="text-sm leading-relaxed">
                最後に、 npm コマンドを実行してください。
            </p>
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 italic">npmコマンドの実行</p>
                <pre class="bg-gray-900 text-white p-4 rounded font-mono text-sm shadow-inner">$ npm install
$ npm run build</pre>
            </div>
            <p class="text-sm leading-relaxed">
                <code>npm install</code> では、package.jsonに記載された依存パッケージをまとめてローカルインストールします。<br>
                <code>npm run build</code> では、複数存在するJavaScriptファイルや、cssファイルをマージ（合併）して、buildディレクトリに圧縮する処理です。<br>
                これで、Laravel Breezeをインストールが完了しました。
            </p>
        </div>

        <div class="mt-8 bg-gray-50 p-6 rounded-xl border space-y-6">
            <h4 class="font-bold text-base text-gray-800">試しにtinkerでユーザを作成してみる</h4>
            <p class="text-sm">
                tinkerの起動方法を復習しましょう。次のコマンドでtinkerを起動できます。
            </p>
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 italic">tinkerの起動</p>
                <code class="block bg-gray-900 text-white p-3 rounded font-mono text-sm">$ php artisan tinker</code>
            </div>
            <p class="text-sm">
                tinkerを起動したらユーザー作成してみましょう。<br>
                参考までに試しにtinkerでユーザを作成してみる一連の操作例を記載しておきます。<br>
                <code>></code> と <code>...</code> 部分で記載しているコマンドをコピー・アンド・ペーストして実行してみてください。
            </p>

            <div class="space-y-4">
                <p class="text-xs font-bold text-gray-600">コマンド入力1</p>
                <code class="block bg-gray-900 text-white p-2 rounded font-mono text-xs">$ php artisan tinker</code>
                <img src="/images/Lesson18-16.png" alt="Tinker Command 1" class="max-w-md w-full h-auto border rounded shadow-sm">
            </div>

            <div class="space-y-4">
                <p class="text-xs font-bold text-gray-600">コマンド入力2</p>
                <pre class="bg-gray-900 text-white p-2 rounded font-mono text-xs">> use App\Models\User;
> User::all()</pre>
                <img src="/images/Lesson18-17.png" alt="Tinker Command 2" class="max-w-md w-full h-auto border rounded shadow-sm">
            </div>

            <div class="space-y-4">
                <p class="text-xs font-bold text-gray-600">コマンド入力3</p>
                <pre class="bg-gray-900 text-white p-2 rounded font-mono text-xs">> User::create([
. 'name' => 'test',
. 'email' => 'test@test.com',
. 'password' => Hash::make('test') ])</pre>
                <img src="/images/Lesson18-18.png" alt="Tinker Command 3" class="max-w-md w-full h-auto border rounded shadow-sm">
            </div>

            <div class="space-y-4">
                <p class="text-xs font-bold text-gray-600">コマンド入力4</p>
                <pre class="bg-gray-900 text-white p-2 rounded font-mono text-xs">> User::all()</pre>
                <img src="/images/Lesson18-19.png" alt="Tinker Command 4" class="max-w-md w-full h-auto border rounded shadow-sm">
            </div>

            <p class="text-sm leading-relaxed">
                最後の <code>all()</code> の結果を見ると、 passwordやremember_tokenに#がついています。これはModelファイル側のコードで <code>$hidden</code> として設定されているからです。
            </p>
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-base text-gray-800">Userモデルの確認</h4>
            <p class="text-sm">こちらもLaravelプロジェクトを作成した時点で用意されています。</p>
            <p class="text-xs font-bold text-gray-500 italic">app/Models/User.php（抜粋）</p>
            <pre class="bg-gray-100 p-4 rounded-lg font-mono text-xs border overflow-x-auto">&lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}</pre>
            <p class="text-sm"><code>$fillable</code> と <code>$hidden</code> という配列が書かれています。</p>
        </div>

        <div class="space-y-6">
            <div>
                <h5 class="font-bold text-sm text-gray-800 mb-2">■ $fillable</h5>
                <pre class="bg-gray-100 p-2 text-xs font-mono border rounded w-max">protected $fillable = [ 'name', 'email', 'password', ];</pre>
                <p class="text-sm leading-relaxed mt-2">
                    $fillableは、想定外のデータが代入されたパラメータの保存を防ぐ処理です。<br>
                    ユーザーデータを作成する場合、一気にデータを代入できますが、すべての項目がデフォルトで「一気に保存可能」になっていると、想定外のデータが保存されるかもしれず、セキュリティ上それは良いことでありません。<br>
                    そこで通常は、すべてのカラムをデフォルトでは「一気に保存不可」とし、<code>$fillable</code> で「一気に保存可能」なパラメータを指定します。こうすることで、想定外のデータが代入されるのを防ぎ、なおかつ、一気にデータを代入することが可能になります。
                </p>
            </div>

            <div>
                <h5 class="font-bold text-sm text-gray-800 mb-2">■ $hidden</h5>
                <p class="text-sm leading-relaxed">
                    パスワードなど秘匿しておきたいカラムを、モデルで <code>$hidden</code> に指定しておくと、見られないように隠してくれます。たとえば、 tinkerで <code>User::first()->toArray()</code> や <code>(string)User::first()</code> とUser::first()で取得した値を配列や文字列に変換したときに、 Userモデルのコーディングで <code>$hidden = ['password']</code> と代入されていると、password は変換されません。
                </p>
            </div>

            <div class="p-4 bg-gray-50 border rounded-lg text-sm space-y-2">
                <p class="font-bold text-gray-800">（補足）$table</p>
                <p class="text-xs leading-relaxed">
                    今回は必要ありませんが <code>$table</code> という変数も指定できます。<br>
                    モデルと接続されるテーブル名は、モデル名によって決められます。たとえば、 Messageモデルはmessagesテーブルと自動的に接続されます。この規則を破って独自のテーブル名をつけたい場合に、 <code>$table</code> を使用します。たとえば、 Messageモデルだけど、 msgテーブルを使いたいとなれば <code>$table = 'msg'</code> とすれば接続されます。<br>
                    今回はUserモデルに対して <code>$table = 'users'</code> で、規則通りであるため省略されています。
                </p>
            </div>

            <div class="p-4 bg-gray-50 border rounded-lg text-sm space-y-2">
                <p class="font-bold text-gray-800">（補足）Hashファサード</p>
                <p class="text-xs leading-relaxed">
                    今回は利用しませんが、 Hash ファサードについても、ここで触れておきます。<br>
                    Hash ファサードはハッシュの機能を提供します。セキュリティの観点から、パスワードはハッシュしてからデータベースに保存すべきで、パスワードを平文（そのまま）保存すべきではありません。パスワードは必ずハッシュする必要があります。<br>
                    今回は、Laravel Breezeで良い感じで処理していますが、考え方としては知っておくと実務で役に立ちます。<br>
                    tinkerを起動してどんなハッシュが行われるか確認してください。
                </p>
                <p class="text-xs font-bold text-gray-500 italic">コマンド入力</p>
                <code class="block bg-gray-900 text-white p-2 rounded font-mono text-xs">> $test = Hash::make('test')</code>
                <p class="text-xs font-bold text-gray-500 italic mt-2">実行結果</p>
                <img src="/images/Lesson18-20.png" alt="Hash Make Result" class="max-w-md w-full h-auto border rounded shadow-sm">
                <p class="text-xs leading-relaxed mt-2">
                    'test' をハッシュすれば、 "$2y$10$mcIYPM0RVuKdFs/AUBsLOes4oHPk1bJ7rzTQ2kbJfclfgfAAt6u9u" となりました。<br>
                    実は <code>$test = Hash::make('test')</code> を何度も実行するとわかりますが、ハッシュ値は一定ではなく変化します。<br>
                    しかし、下記のように、 <code>Hash::check()</code> を利用すると「test という文字列をハッシュしたものかどうか」を判定できます。
                </p>
                <p class="text-xs font-bold text-gray-500 italic mt-2">実行結果</p>
                <img src="/images/Lesson18-21.png" alt="Hash Check Result" class="max-w-md w-full h-auto border rounded shadow-sm">
                <p class="text-xs leading-relaxed mt-2">
                    詳しくは述べませんが、ログイン時には内部で <code>Hash::check()</code> が呼び出され、入力されたパスワードとデータベースに保存されているハッシュ値が一致しているかを確認しています。<br>
                    これで、ユーザ登録時のパスワードをハッシュしてからデータベースに保存でき、さらに、ログイン時にもパスワードの一致を確認できます。
                </p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Laravel Breezeの表示確認</h3>
        <p class="text-sm leading-relaxed">
            Laravelを起動してLaravel Breezeの表示確認をしてみましょう。
        </p>
        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic">Laravelの起動</p>
            <code class="block bg-gray-900 text-white p-3 rounded font-mono text-sm shadow-inner">$ php artisan serve --host=127.0.0.1 --port=8080</code>
        </div>

        <div class="space-y-6 mt-6 text-sm">
            <div>
                <h4 class="font-bold text-gray-800 mb-2">■ トップページ</h4>
                <p class="mb-2">トップページを表示すると、右上に log in と Register という文字が表示されるようになりました。<br>
                log in をクリックするとログインページに移動します。<br>
                Register をクリックすると会員登録ページに移動します。</p>
                <p class="text-xs font-bold text-gray-500 italic">表示例</p>
                <img src="/images/Lesson18-22.png" alt="Breeze Welcome Page Top" class="max-w-xl w-full h-auto border rounded shadow-sm">
            </div>

            <div>
                <h4 class="font-bold text-gray-800 mb-2">■ Laravel Breezeログインページ</h4>
                <p class="mb-2">トップページの log in をクリックして、ログインページに移動してください。会員登録が完了していれば、ログインページからログインできます。</p>
                <p class="text-xs font-bold text-gray-500 italic">表示例</p>
                <img src="/images/Lesson18-23.png" alt="Breeze Login Page" class="max-w-xl w-full h-auto border rounded shadow-sm">
            </div>

            <div>
                <h4 class="font-bold text-gray-800 mb-2">■ Laravel Breeze会員登録ページ</h4>
                <p class="mb-2">トップページの Register をクリックして、会員登録ページに移動してください。次のページがLaravel Breeze会員登録ページです。</p>
                <p class="text-xs font-bold text-gray-500 italic">表示例</p>
                <img src="/images/Lesson18-24.png" alt="Breeze Register Page" class="max-w-xl w-full h-auto border rounded shadow-sm">
            </div>

            <div>
                <h4 class="font-bold text-gray-800 mb-2">■ Laravel Breeze会員登録処理</h4>
                <p class="mb-2">会員登録フォームには次の情報を入力してください。</p>
                <ul class="list-disc pl-5 space-y-1 mb-2">
                    <li>Nameに <strong>User</strong></li>
                    <li>Emailに <strong>user@example.jp</strong></li>
                    <li>Passwordに <strong>password</strong></li>
                    <li>Confirm Passwordに <strong>password</strong></li>
                </ul>
                <p class="mb-2">REGISTER をクリックすると、自動的にログインします。</p>
                <p class="text-xs font-bold text-gray-500 italic">表示例</p>
                <img src="/images/Lesson18-25.png" alt="Breeze Registered Dashboard" class="max-w-xl w-full h-auto border rounded shadow-sm">
            </div>

            <div>
                <h4 class="font-bold text-gray-800 mb-2">■ Laravel Breezeログアウト処理</h4>
                <p class="mb-2">会員登録フォームに入力し、 REGISTER をクリックすると、自動的にログインしました。ログアウトしたい場合は、右上のユーザー名をクリックして、Logoutをクリックするとログアウトが可能です。</p>
                <img src="/images/Lesson18-26.png" alt="Breeze Logout Action" class="max-w-xl w-full h-auto border rounded shadow-sm">
            </div>
        </div>

        <div class="mt-4 p-4 bg-blue-50 border border-blue-100 rounded-lg text-sm text-blue-900 leading-relaxed">
            <h4 class="font-bold mb-1">Laravel Breezeの認証機能完了</h4>
            <p>ここまでで、Laravel Breezeの認証機能の基本的な操作が完了できました。コマンドを実行するだけで、認証機能の実装が完成できた、Laravel Breezeを利用する最大のメリットをご確認頂けたかと思います。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">daisyUIとtypographyのインストール</h3>
        <p class="text-sm leading-relaxed">
            Tailwindは、Laravel Breezeインストール時にインストール済みです。<br>
            「tailwindcss/typography」は、Tailwindのタイポグラフィライブラリです。タイポグラフィとは、文字を綺麗に表示する考え方です。
        </p>

        <div class="bg-gray-50 p-4 border rounded-lg text-sm space-y-2">
            <p class="font-bold text-gray-800">daisyUIとtypographyのインストールに必要な操作</p>
            <ol class="list-decimal pl-5 space-y-1 text-xs">
                <li>npmコマンドでdaisyuiとtypographyをインストールする</li>
                <li>tailwind.config.js ファイルを修正する</li>
                <li>resources/css/app.css ファイルを修正する</li>
                <li>npm run build を実行する</li>
            </ol>
        </div>

        <div class="space-y-2">
            <h4 class="font-bold text-sm text-gray-800">1. npmコマンドでdaisyUIとtypographyをインストールする</h4>
            <p class="text-sm text-gray-600">ターミナルで次のコマンドをコピー・アンド・ペーストして実行してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">daisyUI・typographyのインストール</p>
            <pre class="bg-gray-900 text-white p-4 rounded font-mono text-sm shadow-inner">$ npm install
$ npm install --save-dev daisyui @tailwindcss/typography</pre>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-sm text-gray-800">2. tailwind.config.jsファイルを修正する</h4>
            <p class="text-sm text-gray-600">ここでは、microposts フォルダ直下にある tailwind.config.js ファイルを修正します。<br>
            <code>// 追記</code> の箇所を変更しているので、次のような状態にしてください。</p>
            <img src="/images/Lesson18-27.png"
     alt="Tailwind config diff"
     class="w-64 h-auto border rounded shadow-sm">
            
            <p class="text-xs font-bold text-gray-500 italic">tailwind.config.js</p>
            <pre class="bg-gray-100 p-4 rounded-lg font-mono text-xs border overflow-x-auto">const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
    plugins: [require("@tailwindcss/typography"), require("daisyui")], // 追記
};</pre>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-sm text-gray-800">3. resources/css/app.cssファイルを修正する</h4>
            <p class="text-sm text-gray-600">resources/css/ フォルダに有る app.css ファイルを修正します。</p>
            <img src="/images/Lesson18-28.png" alt="app.css diff" class="w-64 h-auto border rounded shadow-sm">
            <p class="text-sm text-gray-600">resources/css/ フォルダに有る app.css に次の内容をコピー・アンド・ペーストして上書きしてください。<br>
            後ほどnpmをbuildすることで、実際に各cssファイルが適用されます。</p>
            
            <p class="text-xs font-bold text-gray-500 italic">resources/css/app.css</p>
            <pre class="bg-gray-100 p-4 rounded-lg font-mono text-xs border overflow-x-auto">@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';</pre>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-sm text-gray-800">4. npm run buildを実行する</h4>
            <p class="text-sm text-gray-600">次のbuildコマンドを実行することでcssファイルを適用できる状態にしています。コピー・アンド・ペーストして実行してみてください。</p>
            <p class="text-xs font-bold text-gray-500 italic">buildコマンドの実行</p>
            <code class="block bg-gray-900 text-white p-3 rounded font-mono text-sm shadow-inner">$ npm run build</code>
            
            <p class="text-sm text-gray-700 pt-2">以上で、TailwindとdaisyUIを利用できるようになりました。ログインページとユーザー登録ページの表示を確認してみましょう。</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 italic">log in 表示例</p>
                    <img src="/images/Lesson18-29.png" alt="Styled Login Page" class="w-full h-auto border rounded shadow-sm">
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 italic">Register 表示例</p>
                    <img src="/images/Lesson18-30.png" alt="Styled Register Page" class="w-full h-auto border rounded shadow-sm">
                </div>
            </div>
        </div>

        <div class="mt-6 space-y-4 bg-gray-50 p-6 rounded-lg border">
            <h4 class="font-bold text-sm text-gray-800">フォルダとファイルの状態</h4>
            <p class="text-xs text-red-600 italic">※ 以下は確認のみとなり、操作は不要です。</p>
            <p class="text-sm text-gray-600">この段階で、 resources/views フォルダに次のようなフォルダが作成されました。</p>
            <img src="/images/Lesson18-31.png" alt="Created Views Folders" class="w-64 h-auto border rounded shadow-sm">
            <p class="text-sm text-gray-600 mt-2">各フォルダをさらに展開すると、次のようなファイルが現れます。</p>
            <img src="/images/Lesson18-32.png" alt="Created Views Files" class="w-64 h-auto border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GitHub</h3>
        <div class="space-y-4">
            <p class="text-xs font-bold text-gray-500 italic">Gitコマンド</p>
            <div class="bg-gray-800 text-white p-6 rounded-lg font-mono text-sm shadow-lg leading-relaxed">
                git add -A<br>
                git commit -m "laravel breeze daisyui"<br>
                git push origin main
            </div>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}