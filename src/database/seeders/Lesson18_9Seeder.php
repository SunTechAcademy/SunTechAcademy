<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_9Seeder extends Seeder
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
                'sort_order' => 9,
            ],
            [
                'title' => '投稿機能',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">投稿機能</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-2">
            <p>次は、投稿機能を作成します。</p>
            <p class="text-blue-600 font-bold">（参考）リクエストからレスポンスまでの流れを振り返っていただくと、理解しやすくなります。</p>
        </div>
        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl mt-4">
            <img src="/images/Lesson18-47.png" alt="Post Feature Flow" class="w-full h-auto rounded border">
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Model</h3>
        <p class="text-sm">ユーザの投稿を <code>Micropost</code> というモデル名で作成します。</p>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">一対多の関係</h4>
            <div class="prose max-w-none text-sm leading-relaxed space-y-2">
                <p>UserとMicropostは <strong>一対多</strong> の関係です。</p>
                <p>一対多の関係とは、ある1つのModelインスタンス（A）に対して複数のModelインスタンス（B, B, …）を保持する関係のことです。</p>
                <p>たとえば今回のUserとMicropostでは、1人のUserは複数のMicropostをツイートすることが可能（<code>hasMany</code>）であり、 1つのMicropostは必ず1人のUserに所属（<code>belongsTo</code>）することが決まっています。</p>
            </div>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl mt-2">
                <img src="/images/Lesson18-48.png" alt="One to Many Relationship" class="w-full h-auto rounded border">
            </div>
            <p class="text-sm leading-relaxed text-gray-600 bg-gray-50 p-3 rounded border">
                Model同士が一対多の関係であることに気付くことは重要です。今後のWebアプリケーション開発において、 一対多の関係となるリソースを次々と作っていくことになります。ここで一対多のModelの作成方法や扱い方をしっかり抑えておきましょう。
            </p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">テーブル設計</h4>
            
            <p class="text-sm font-bold text-gray-700">マイグレーションファイルの作成</p>
            <p class="text-sm">次のコマンドを実行してください。</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">php artisan make_migration create_microposts_table --create=microposts</pre>
            
            <p class="text-sm leading-relaxed">マイグレーションファイルが作成されますので、 <code>database/migrations/年月日時_create_microposts_table.php</code> の <code>public function up()</code> を次のように修正してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">database/migrations/年月日時_create_microposts_table.php の up() と down()</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">    public function up()
    {
        Schema::create('microposts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('content');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('microposts');
    }</pre>
            <p class="text-xs text-gray-600">Micropostには、各Micropostを識別する id、そのMicropostを投稿したユーザのID（user_id）、投稿内容（content）、登録日時と更新日時（timestamps()）をカラムとして持たせます。</p>
        </div>

        <div class="bg-gray-50 p-5 rounded-lg border space-y-3 text-sm leading-relaxed">
            <h4 class="font-bold text-gray-800 text-sm border-b pb-1">💡 外部キー制約について</h4>
            <pre class="bg-white p-2 rounded text-xs font-mono border text-blue-700">$table->foreign(外部キー制約を設定するカラム名)->references(参照されるカラム名)->on(参照されるテーブル名);</pre>
            <p>外部キー制約 の機能はLaravelの機能ではなく、データベース側の機能です。</p>
            <p>この機能は保存されるテーブルの整合性を担保するために利用します。整合性とは、データが矛盾なく一貫している状態を意味します。</p>
            <p>たとえば、あるMicropostのuser_idに存在しないUserのidが設定されていたとします。このとき、そのMicropostの情報自体はデータベース上に存在しますが、どのUserとも紐づいていない状態となります。</p>
            <p>このようなデータは表示されないゴミデータになるだけでなく、エラーを引き起こす原因にもなりかねません。言い換えれば、外部キー制約はUserとMicropostの「つながり」を保証するための機能です。</p>
            <p class="font-bold text-gray-900">つまり、外部キー制約は外部テーブルのデータを参照する場合には必須機能と言えます。</p>
        </div>

        <div class="space-y-2">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">マイグレーションの実行</h4>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">php artisan migrate</pre>
            <p class="text-xs text-gray-600">マイグレーションが実行済みになったことを <code>php artisan migrate:status</code> コマンドで確認しておきましょう。 MySQL側でテーブルの内容を <code>describe microposts;</code> で確認しておくのも良いでしょう。</p>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">Micropost Model</h4>
            <p class="text-sm leading-relaxed">
                まず、 Micropostのモデルファイルを作成します。<br>
                モデルファイルの作成：
            </p>
            <pre class="bg-gray-900 text-green-400 p-3 rounded font-mono text-xs shadow">php artisan make_model Micropost</pre>
            <p class="text-sm leading-relaxed">
                作成したモデルファイルに <code>$fillable</code> を設定しておきましょう。<br>
                そして、モデルファイルの中にも一対多の関係を記述しておきましょう。<br>
                Micropostを持つUserは1人であるため、 <code>function user()</code> のように単数形userでメソッドを定義し、中身は <code>return $this->belongsTo(User::class)</code> とします。
            </p>
            <p class="text-sm leading-relaxed">
                このようにすることで、 Micropostのインスタンスが所属している唯一のUser（投稿者の情報）を <code>$micropost->user()->first()</code> もしくは <code>$micropost->user</code> という簡単な記述で取得できるようになります。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">app/Models/Micropost.php（namespaceなど省略）</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">class Micropost extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}</pre>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">User Model</h4>
            <p class="text-sm leading-relaxed">
                Userモデルファイルにも一対多の表現を記述しておきます。 Userが持つMicropostは複数存在するため、 <code>function microposts()</code> のように複数形micropostsでメソッドを定義します。<br>
                中身は <code>return $this->hasMany(Micropost::class);</code> とします（先ほどとは異なりhasManyを使用していることに着目してください）。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">app/Models/User.php 追記分</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">class User extends Authenticatable 
{
    // 中略

    /**
     * このユーザが所有する投稿。（ Micropostモデルとの関係を定義）
     */
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
}</pre>
            <p class="text-xs text-gray-600">Micropostのときと同様に記述することで、 UserのインスタンスからそのUserが持つMicropostsを <code>$user->microposts()->get()</code> もしくは <code>$user->microposts</code> という簡単な記述で取得できるようになります。</p>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">Micropostの数をカウントする機能を追加</h4>
            <p class="text-sm leading-relaxed">
                Userが持つMicropostの数をカウントするためのメソッドも作成しておきます。<br>
                <code>loadCount</code> メソッドの引数に指定しているのはリレーション名です。先ほどモデル同士の関係を表すメソッドを定義しましたが、そのメソッド名がリレーション名になります。これによりUserのインスタンスに <code>{リレーション名}_count</code> プロパティが追加され、件数を取得できるようになります。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">app/Models/User.php 追記分</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">class User extends Authenticatable 
{
    // 中略

    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('microposts');
    }
}</pre>
            <p class="text-xs text-gray-600 bg-gray-100 p-2 rounded">
                このあと出てきますが、アクションでこのメソッドを <code>$user->loadRelationshipCounts()</code> のように呼び出し、ビューで <code>$user->microposts_count</code> のように件数を取得することになります。<br>
                参考: <a href="https://readouble.com/laravel/9.x/ja/eloquent-relationships.html#counting-related-models" target="_blank" class="text-blue-600 underline font-mono">関連するモデルのカウント - Laravel 9.x</a>
            </p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">tinkerで投稿を作成</h4>
            <p class="text-sm leading-relaxed">
                Laravelは、一対多などの関係を持つモデルに新しいレコードを追加するための便利なメソッドを用意しています。<br>
                たとえば、 <code>User</code> モデルに関係する新しい <code>Micropost</code> を挿入するためには <code>create</code> メソッドを使うことができます。このメソッドは、引数で受け取った連想配列をもとに、モデルを作成しデータベースへ挿入します。<br>
                参考資料：<a href="https://readouble.com/laravel/9.x/ja/eloquent-relationships.html#the-create-method" target="_blank" class="text-blue-600 underline font-mono">createメソッド（Eloquent - Laravel 9.xドキュメント）</a>
            </p>
            <p class="text-sm">tinkerを使って、新しいMicropost 1個をデータベースへ挿入してみましょう。投稿の作成は <code>$user->microposts()->create(['content' => 'micropost test'])</code> のように操作します（以下の表示結果は一例です）。</p>

            <div class="space-y-4 bg-gray-900 text-white p-4 rounded-lg font-mono text-xs shadow-lg">
                <div>
                    <p class="text-green-400">// コマンド入力 1</p>
                    <p>microposts $ php artisan tinker</p>
                    <p>Psy Shell v0.11.8 (PHP 8.1.8 — cli) by Justin Hileman</p>
                    <p>&gt; use User</p>
                    <p>&gt; $user = User::first()</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 1】</p>
                    <img src="/images/Lesson18-49.png" alt="Tinker First User Result" class="w-full h-auto rounded">
                </div>

                <div class="pt-2 border-t border-gray-700">
                    <p class="text-green-400">// コマンド入力 2</p>
                    <p>&gt; $user-&gt;microposts()-&gt;get()</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 2】</p>
                    <img src="/images/Lesson18-50.png" alt="Tinker Empty Microposts Result" class="w-full h-auto rounded">
                </div>

                <div class="pt-2 border-t border-gray-700">
                    <p class="text-green-400">// コマンド入力 3</p>
                    <p>&gt; $user-&gt;microposts()-&gt;create(['content' =&gt; 'micropost test'])</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 3】</p>
                    <img src="/images/Lesson18-51.png" alt="Tinker Create Micropost Result" class="w-full h-auto rounded">
                </div>

                <div class="pt-2 border-t border-gray-700">
                    <p class="text-green-400">// コマンド入力 4</p>
                    <p>&gt; $user-&gt;microposts()-&gt;get()</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 4】</p>
                    <img src="/images/Lesson18-52.png" alt="Tinker Get Microposts Updated Result" class="w-full h-auto rounded">
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Router</h3>
        <p class="text-sm">このチャプターでは、 <code>MicropostsController</code> を生成するので、 Router でも <code>MicropostsController</code> を利用できるように宣言しておきます。</p>
        
        <p class="text-xs font-bold text-gray-500 italic">routes/web.php（抜粋・コントローラ宣言の追記）</p>
        <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MicropostsController; //追記</pre>

        <p class="text-sm leading-relaxed">認証を必要とするルーティンググループ内に、 Micropostsのルーティングを設定します（登録のstoreと削除のdestroyのみ）。これで、認証済みのユーザだけがこれらのアクションにアクセスできます。</p>
        <p class="text-xs font-bold text-gray-500 italic">routes/web.php（抜粋・ルーティング設定）</p>
        <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">Route::group(['middleware' => ['auth']], function () {
    // 中略
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
});</pre>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded text-sm space-y-2">
            <p>また、 今まで <code>/</code> と <code>/dashboard</code> はRouterからControllerへ飛ばさずに直接dashboardのViewを表示させていました。</p>
            <p class="text-xs font-bold text-gray-500 italic">routes/web.php（抜粋・変更前）</p>
            <pre class="bg-white p-3 rounded font-mono text-xs border">Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');</pre>
            
            <p class="pt-2">ここからは少し複雑なことを行っていくのですが、上記の記述を下記のように変更し、Controller ( <code>MicropostsController@index</code> ) を経由してdashboardを表示するようにします。</p>
            <p class="text-xs font-bold text-gray-500 italic">routes/web.php（変更内容）</p>
            <pre class="bg-white p-3 rounded font-mono text-xs border text-blue-700">Route::get('/', [MicropostsController::class, 'index']);
Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');</pre>
        </div>

        <p class="text-sm">この設定内容に変更した結果、 <code>routes/web.php</code> の全体像は以下のようになります。</p>
        <p class="text-xs font-bold text-gray-500 italic">routes/web.php（全体）</p>
        <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MicropostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MicropostsController::class, 'index']);
Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
});</pre>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MicropostsController@index</h3>
        <p class="text-sm">それぞれのアクションを実装していきましょう。まずは、MicropostsControllerを生成して、indexアクションを書いていきます。</p>
        
        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-600">MicropostsControllerの生成コマンド</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">php artisan make_controller MicropostsController</pre>
        </div>

        <div class="space-y-2">
            <p class="text-sm">生成された <code>MicropostsController.php</code> を次のように修正してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/MicropostsController.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micropost;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $microposts = $user-&gt;microposts()-&gt;orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }
}</pre>
        </div>

        <div class="space-y-4 pt-2">
            <h4 class="font-bold text-base text-gray-800">View</h4>
            <p class="text-sm leading-relaxed">
                Micropostの一覧を表示する共通のViewとして、 <code>microposts.blade.php</code> を作成します。<br>
                1. <code>resources/views</code> フォルダに <code>microposts</code> フォルダを作成してください。<br>
                2. <code>resources/views/microposts</code> フォルダに、 <code>microposts.blade.php</code> ファイルを作成してください。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/microposts/microposts.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;div class="mt-4"&gt;
    @if (isset($microposts))
        &lt;ul class="list-none"&gt;
            @foreach ($microposts as $micropost)
                &lt;li class="flex items-start gap-x-2 mb-4"&gt;
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    &lt;div class="avatar"&gt;
                        &lt;div class="w-12 rounded"&gt;
                            &lt;img src="{{ Gravatar::get($micropost-&gt;user-&gt;email) }}" alt="" /&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                    &lt;div&gt;
                        &lt;div&gt;
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            &lt;a class="link link-hover text-info" href="{{ route('users.show', $micropost-&gt;user-&gt;id) }}"&gt;{{ $micropost-&gt;user-&gt;name }}&lt;/a&gt;
                            &lt;span class="text-muted text-gray-500"&gt;posted at {{ $micropost-&gt;created_at }}&lt;/span&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            {{-- 投稿内容 --}}
                            &lt;p class="mb-0"&gt;{!! nl2br(e($micropost-&gt;content)) !!}&lt;/p&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/li&gt;
            @endforeach
        &lt;/ul&gt;
        {{-- ページネーションのリンク --}}
        {{ $microposts-&gt;links() }}
    @endif
&lt;/div&gt;</pre>

            <p class="text-sm leading-relaxed">
                <code>resources/views/dashboard.blade.php</code> の <code>@include('microposts.microposts')</code> で、 <code>resources/views/microposts/microposts.blade.php</code> を dashboardの中で @include すれば、ログイン後のトップページに自分の投稿したMicropostsが表示されるようになります。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/dashboard.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')
    @if (Auth::check())
        &lt;div class="sm:grid sm:grid-cols-3 sm:gap-10"&gt;
            &lt;aside class="mt-4"&gt;
                {{-- ユーザ情報 --}}
                @include('users.card')
            &lt;/aside&gt;
            &lt;div class="sm:col-span-2"&gt;
                {{-- 投稿フォーム --}}
                @include('microposts.form')
                {{-- 投稿一覧 --}}
                @include('microposts.microposts')
            &lt;/div&gt;
        &lt;/div&gt;
    @else
        &lt;div class="prose hero bg-base-200 mx-auto max-w-full rounded"&gt;
            &lt;div class="hero-content text-center my-10"&gt;
                &lt;div class="max-w-md mb-10"&gt;
                    &lt;h2&gt;Welcome to the Microposts&lt;/h2&gt;
                    {{-- ユーザ登録ページへのリンク --}}
                    &lt;a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}"&gt;Sign up now!&lt;/a&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    @endif
@endsection</pre>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 text-sm space-y-3 leading-relaxed">
            <h4 class="font-bold text-blue-900 text-base">📌 補足：{!! と !!} について</h4>
            <p>上記の <code>microposts.blade.php</code> のコードでは、変数の内容や関数の結果を表示するのに <code>{!!, !!}</code> で囲っています。今までは <code>{{, }}</code> で囲っていましたが、これらには以下の違いがあります。</p>
            <ul class="list-disc pl-5 space-y-1 text-xs font-mono">
                <li><code>{{, }}</code> で囲った場合は、htmlspecialchars関数に通したものが出力されます。</li>
                <li><code>{!!, !!}</code> で囲った場合は、そのまま出力されます。</li>
            </ul>
            <p>文章で説明するより実際に2つの動作確認をする方がわかりやすいでしょう。</p>
            <p class="text-xs text-red-600 font-bold border-t pt-2">
                ※ Bladeでは基本的に <code>{{, }}</code> で囲う記法を使ってください。これはPHPのレッスンで学んだように、悪意あるユーザによってフォーム経由で入力されたHTMLがそのまま実行されることを防ぐためです。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MicropostsController@store</h3>
        <p class="text-sm leading-relaxed">では次にWeb上のフォームでMicropostを投稿できるようにします。</p>
        
        <h4 class="font-bold text-base text-gray-800">Controller</h4>
        <p class="text-sm">storeアクションを実装します。以前にtinkerで投稿を作成したのと同様に、storeアクションでは <code>create</code> メソッドを使ってMicropostを保存しています。</p>
        <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/MicropostsController.php 追記部分（storeアクション）のみ</p>
        <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        
        // 前のURLへリダイレクトさせる
        return back();
    }</pre>
        <p class="text-xs text-gray-600 font-bold">
            <code>return back()</code> とすることで、前のページへリダイレクトされます。この store アクションの場合、リクエスト元の投稿フォームのページへ戻ることになります。<br>
            参考: <a href="https://readouble.com/laravel/9.x/ja/helpers.html#method-back" target="_blank" class="text-blue-600 underline font-mono">back() - Laravel 9.x</a>
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MicropostsController@destroy</h3>
        <p class="text-sm">投稿の削除を実装します。</p>
        
        <h4 class="font-bold text-base text-gray-800">Controller</h4>
        <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/MicropostsController.php 追記部分（destroy）のみ抜粋</p>
        <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $micropost = \App\Models\Micropost::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
            return back()
                ->with('success','Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }</pre>
        <p class="text-sm">削除を実行する部分は、if文で囲みました。</p>
        <p class="text-xs font-bold text-gray-400 italic">（追記不要）</p>
        <pre class="bg-gray-100 p-3 rounded font-mono text-xs border text-gray-500">        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }</pre>
        <p class="text-xs text-gray-600 leading-relaxed">他者のMicropostを勝手に削除されないよう、ログインユーザのIDとMicropostの所有者のID（user_id）が一致しているかを調べるようにしています。</p>

        <div class="space-y-2 pt-2 border-t">
            <h4 class="font-bold text-base text-gray-800">View</h4>
            <p class="text-sm">Viewに削除ボタンをつけ足します。 <code>microposts.blade.php</code> は完成形です。</p>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/microposts/microposts.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;div class="mt-4"&gt;
    @if (isset($microposts))
        &lt;ul class="list-none"&gt;
            @foreach ($microposts as $micropost)
                &lt;li class="flex items-start gap-x-2 mb-4"&gt;
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    &lt;div class="avatar"&gt;
                        &lt;div class="w-12 rounded"&gt;
                            &lt;img src="{{ Gravatar::get($micropost-&gt;user-&gt;email) }}" alt="" /&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                    &lt;div&gt;
                        &lt;div&gt;
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            &lt;a class="link link-hover text-info" href="{{ route('users.show', $micropost-&gt;user-&gt;id) }}"&gt;{{ $micropost-&gt;user-&gt;name }}&lt;/a&gt;
                            &lt;span class="text-muted text-gray-500"&gt;posted at {{ $micropost-&gt;created_at }}&lt;/span&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            {{-- 投稿内容 --}}
                            &lt;p class="mb-0"&gt;{!! nl2br(e($micropost-&gt;content)) !!}&lt;/p&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            @if (Auth::id() == $micropost-&gt;user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                &lt;form method="POST" action="{{ route('microposts.destroy', $micropost-&gt;id) }}"&gt;
                                    @csrf
                                    @method('DELETE')
                                    &lt;button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('Delete id = {{ $micropost-&gt;id }} ?')"&gt;Delete&lt;/button&gt;
                                &lt;/form&gt;
                            @endif
                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/li&gt;
            @endforeach
        &lt;/ul&gt;
        {{-- ページネーションのリンク --}}
        {{ $microposts-&gt;links() }}
    @endif
&lt;/div&gt;</pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">UsersController@show</h3>
        
        <div class="space-y-2">
            <h4 class="font-bold text-base text-gray-800">Controller</h4>
            <p class="text-sm">対象のUserを取得後に、関係するモデルの件数と投稿の一覧を取得して、ビューに渡します。</p>
            <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/UsersController.php showアクションのみ抜粋</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user-&gt;loadRelationshipCounts();
        
        // ユーザーの投稿一覧を作成日時の降順で取得
        $microposts = $user-&gt;microposts()-&gt;orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }</pre>
        </div>

        <div class="space-y-4 pt-2">
            <h4 class="font-bold text-base text-gray-800">View</h4>
            <p class="text-sm leading-relaxed">ユーザ詳細ページではユーザの投稿の一覧を表示します。また、ログインユーザ自身の詳細ページである場合は投稿フォームも設置します。投稿フォームは別のページにも設置するため、共通のViewとして作成しておきます。なお、このアプリケーションでは投稿用の専用ページを作りません。</p>
            
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 italic">resources/views/users/show.blade.php</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')
    &lt;div class="sm:grid sm:grid-cols-3 sm:gap-10"&gt;
        &lt;aside class="mt-4"&gt;
            {{-- ユーザ情報 --}}
            @include('users.card')
        &lt;/aside&gt;
        &lt;div class="sm:col-span-2 mt-4"&gt;
            {{-- 投稿フォーム --}}
            @include('microposts.form')
            {{-- 投稿一覧 --}}
            @include('microposts.microposts')
        &lt;/div&gt;
    &lt;/div&gt;
@endsection</pre>
                <p class="text-xs text-gray-600 bg-gray-50 p-2 rounded">
                    ・<code>@include('microposts.form')</code> は、 <code>resources/views/microposts/form.blade.php</code> を読み込んで表示しています。<br>
                    ・<code>@include('microposts.microposts')</code> は、 <code>resources/views/microposts/microposts.blade.php</code> を読み込んで表示しています。
                </p>
            </div>

            <div class="space-y-2 pt-2 border-t">
                <p class="text-xs font-bold text-gray-500 italic">resources/views/microposts/form.blade.php</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@if (Auth::id() == $user-&gt;id)
    &lt;div class="mt-4"&gt;
        &lt;form method="POST" action="{{ route('microposts.store') }}"&gt;
            @csrf
        
            &lt;div class="form-control mt-4"&gt;
                &lt;textarea rows="2" name="content" class="input input-bordered w-full"&gt;&lt;/textarea&gt;
            &lt;/div&gt;
        
            &lt;button type="submit" class="btn btn-primary btn-block normal-case"&gt;Post&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;
@endif</pre>
                <p class="text-xs text-gray-600">
                    <code>{{ route('microposts.store') }}</code> では、 <code>app/Http/Controllers/MicropostsController.php</code> の <code>store()</code> メソッドに、 <code>method="POST"</code> で投稿データをPOST送信しています。
                </p>
            </div>
        </div>

        <div class="space-y-4 pt-2">
            <p class="text-sm leading-relaxed">これでログインユーザ自身の情報が表示されるUserのページからMicropostが投稿できるようになりました。実際にいくつか投稿して表示内容を確認してみてください。この投稿フォームは、先ほどトップページにも設置しました。</p>
            
            <p class="text-xs font-bold text-gray-400 italic">resources/views/dashboard.blade.php（追記不要）</p>
            <pre class="bg-gray-100 p-4 rounded font-mono text-xs border text-gray-500">@extends('layouts.app')

@section('content')
    @if (Auth::check())
        &lt;div class="row"&gt;
            &lt;aside class="col-sm-4"&gt;
                {{-- ユーザ情報 --}}
                @include('users.card')
            &lt;/aside&gt;
            &lt;div class="col-sm-8"&gt;
                {{-- 投稿フォーム --}}
                @include('microposts.form')
                {{-- 投稿一覧 --}}
                @include('microposts.microposts')
            &lt;/div&gt;
        &lt;/div&gt;
    @else
        &lt;div class="center jumbotron"&gt;
            &lt;div class="navbar-brand d-flex flex-row-reverse bd-highlight"&gt;
                Welcome to the Microposts
            &lt;/div&gt;
        &lt;/div&gt;
    @endif
@endsection</pre>
            <p class="text-xs text-gray-500"><code>{{-- 投稿フォーム --}}</code> の <code>@include('microposts.form')</code> で <code>resources/views/microposts/form.blade.php</code> を読み込んで表示しています。</p>
        </div>

        <div class="space-y-2 pt-2 border-t">
            <h4 class="font-bold text-base text-gray-800">表示確認</h4>
            <p class="text-sm">Laravelの起動：</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">npm run build
php artisan serve --host=127.0.0.1 --port=8080</pre>
        </div>

        <div class="space-y-2 pt-2">
            <p class="text-xs font-bold text-gray-500 italic">Git操作</p>
            <pre class="bg-gray-900 text-white p-5 rounded-lg font-mono text-sm shadow-md">git add -A
git commit -m "post"
git push origin main</pre>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}