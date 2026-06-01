<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_8Seeder extends Seeder
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
                'sort_order' => 8,
            ],
            [
                'title' => 'その他のユーザ機能',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">その他のユーザ機能</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                ユーザ登録（作成）や認証については、 Laravel Breeze で用意できました。<br>
                しかし、下記のようなUserの機能を加えようとすると、新たにControllerを作成する必要があります。
            </p>
            <ul class="list-disc pl-5 space-y-1 text-gray-600">
                <li>Userの一覧表示</li>
                <li>Userの詳細情報の表示</li>
            </ul>
            <p>
                ここでは、Userの「一覧表示」と「詳細情報の表示」機能を作成します。<br>
                <span class="text-blue-600 font-bold">（参考）リクエストからレスポンスまでの流れを振り返っていただくと、理解しやすくなります。</span>
            </p>
        </div>
        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl mt-4">
            <img src="/images/Lesson18-42.png" alt="Request to Response Flow" class="w-full h-auto rounded border">
        </div>
    </section>

    <section class="space-y-2">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Model</h3>
        <p class="text-sm text-gray-600">用意されていたUserモデルを引き続き利用するため、新規作成するモデルはありません。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Router</h3>
        <div class="prose max-w-none text-sm leading-relaxed space-y-2">
            <p>ユーザー登録では RegisteredUserController が用意していたユーザ登録アクションを利用していました。</p>
            <p>ユーザー登録以外にユーザー表示を行なう必要があるので、 <code>UsersController</code> に下記のアクションを作成します。</p>
            <ul class="list-disc pl-5 space-y-1 text-gray-600">
                <li>ユーザ一覧（index）</li>
                <li>ユーザ詳細（show）</li>
            </ul>
            <p><code>UsersController</code> を作成する前に、 <code>web.php</code> に Router の設定を記載します。</p>
            <ul class="list-none pl-4 border-l-2 border-gray-300 text-xs font-mono space-y-1">
                <li>・UsersController の宣言</li>
                <li>・認証付きのルーティング</li>
            </ul>
        </div>

        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
            <img src="/images/Lesson18-38.png" alt="Router Status Check" class="w-64 h-auto border rounded shadow-sm">
        </div>

        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic">routes/web.php（抜粋）</p>
            <pre class="bg-gray-100 p-4 rounded text-xs font-mono border overflow-x-auto">Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';</pre>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">UsersController の宣言</h4>
            <p class="text-sm">次の <code>// 追記</code> を <code>routes/web.php</code> に記載してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">routes/web.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; // 追記</pre>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">認証付きのルーティング</h4>
            <p class="text-sm leading-relaxed">
                ユーザ一覧とユーザ詳細はログインしていない閲覧者には見せたくありません。そのようなときは auth ミドルウェアを使いましょう。<br>
                guest ミドルウェアと同じようにコントローラのコンストラクタでの指定もできますが、ここではルーティングで指定します。
            </p>
            <p class="text-sm leading-relaxed">
                次の <code>// 追記</code> を <code>routes/web.php</code> に記載してください。<br>
                これにより、 <code>Route::group()</code> でルートのグループを作り、 auth ミドルウェアを指定することで、このグループ内のルートへアクセスする際に、認証を必要とするようにできます。
            </p>
            <p class="text-sm leading-relaxed">
                なお、 <code>['only' => ['index', 'show']]</code> は作成されるルートを絞り込んでいます。この <code>UsersController::class</code> は7つのアクションのうち index（ユーザ一覧）と show（ユーザ詳細）だけで良いからです。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">routes/web.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

// コメント部分省略

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {                                    // 追記
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);     // 追記
});                                                                                       // 追記</pre>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-lg p-5 space-y-2 text-sm leading-relaxed text-gray-800">
            <h4 class="font-bold text-blue-900">💡 ユーザに対するそれ以外のアクション</h4>
            <p>
                ここでは作成しませんが、ユーザが自分の名前を編集するアクション（edit, update)や退会アクション（destroy)を作っても問題ありませんし、さらにユーザの登録情報（年齢や自己紹介など）を充実（usersテーブルのカラム追加）させても良いでしょう。
            </p>
            <p>
                これらはUsersControllerに実装すれば実現可能であり、ここまで学んだ内容で皆さんも充分に対応可能です。カラムの追加についてはメッセージボードの内容で扱いました。このアプリケーションへのアクションやカラムの追加は提出課題にはしませんが、復習を兼ねて学びを深めたい方は実装してみてください。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">UsersController@index</h3>
        
        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800">UsersControllerの作成</h4>
            <p class="text-sm">ターミナルで以下のコマンドを実行し、UsersControllerを作成します。</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">php artisan make:controller UsersController</pre>
            <p class="text-sm text-gray-600">ここではindexとshowのみを実装します。Userに関するControllerを2つ用意する形となります。</p>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800">Controllerの編集</h4>
            <p class="text-sm">次の <code>// 追加</code> の部分を記載してください。まずは、 <code>UsersController.php</code> を利用したindexメソッドから実装していきましょう。</p>
            <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/UsersController.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;                        // 追加
use App\Models\User;                                        // 追加

class UsersController extends Controller
{
    public function index()                                 // 追加       
    {                                                       // 追加
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10); // 追加

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [                        // 追加
            'users' => $users,                              // 追加
        ]);                                                 // 追加
    }                                                       // 追加
    
    public function show($id)                               // 追加
    {                                                       // 追加
    }                                                       // 追加
}</pre>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h4 class="font-bold text-base text-gray-800">View</h4>
            
            <div class="bg-gray-50 p-5 rounded-lg border space-y-3">
                <h5 class="font-bold text-gray-800 text-sm">Gravatar表示ライブラリをインストール</h5>
                <p class="text-sm leading-relaxed">
                    Viewを作っていく前にGravatarを設定していきましょう。<br>
                    Gravatarとは、 メールアドレスに対して自分のアバター画像を登録するサービスです。Gravatarを登録しておき、 Gravatarに対応しているサイトでメールアドレスを設定して発言などをすると、そのアバター画像が表示されるようになります。
                </p>
                <p class="text-xs text-gray-500">Gravatar公式：<a href="https://ja.gravatar.com/" target="_blank" class="text-blue-600 underline font-mono">https://ja.gravatar.com/</a></p>
                <p class="text-sm leading-relaxed">
                    MicropostsもGravatarへ対応させ、メールアドレスからアバター画像を表示させるようにしましょう。実際にメールアドレスに対してGravatarを作成してみるとよくわかるかと思います。<br>
                    では、以下のGitHubで配布されているパッケージをインストールします。
                </p>
                <p class="text-xs text-gray-500">Gravatar for Laravel 9：<a href="https://github.com/brainpink/gravatar" target="_blank" class="text-blue-600 underline font-mono">https://github.com/brainpink/gravatar</a></p>
                <p class="text-sm"><code>composer require</code> を使って、以下のコマンドを実行してください。</p>
                <p class="text-xs font-bold text-gray-500 italic">コマンド実行</p>
                <pre class="bg-gray-900 text-green-400 p-3 rounded font-mono text-xs shadow">composer require "creativeorange/gravatar:~1.0"</pre>
            </div>

            <div class="space-y-2 pt-2">
                <h5 class="font-bold text-sm text-blue-700">◆ users.index（ index.blade.php ）</h5>
                <p class="text-sm leading-relaxed">
                    ユーザ一覧を表示するために、 <code>index.blade.php</code> を読み込みます。<br>
                    1. <code>resources/views</code> フォルダに、 <code>users</code> フォルダを作成してください。<br>
                    2. <code>resources/views/users</code> フォルダに、 <code>index.blade.php</code> ファイルを作成してください。
                </p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/users/index.blade.php</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')
    {{-- ユーザ一覧 --}}
    @include('users.users')
@endsection</pre>
                <p class="text-xs text-gray-600 leading-relaxed bg-gray-50 p-3 rounded border">
                    💡 <code>{{-- ユーザ一覧 --}}</code> 部分は、あとで「ユーザがフォローしているユーザ一覧／ユーザのフォロワー一覧」にも使用するため、1つにまとめます。<br>
                    <code>index.blade.php</code> の <code>@include('users.users')</code> に、<code>resources/views/users/users.blade.php</code> を読み込みます。
                </p>
            </div>

            <div class="space-y-2 pt-2">
                <h5 class="font-bold text-sm text-blue-700">◆ users.users（ users.blade.php ）</h5>
                <p class="text-sm"><code>users.blade.php</code> は、 <code>index.blade.php</code> の <code>@include('users.users')</code> に読み込み表示する内容です。ファイルを作成して次のコードを記載してください。</p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/users/users.blade.php</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@if (isset($users))
    &lt;ul class="list-none"&gt;
        @foreach ($users as $user)
            &lt;li class="flex items-center gap-x-2 mb-4"&gt;
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                &lt;div class="avatar"&gt;
                    &lt;div class="w-12 rounded"&gt;
                        &lt;img src="{{ Gravatar::get($user-&gt;email) }}" alt="" /&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
                &lt;div&gt;
                    &lt;div&gt;
                        {{ $user-&gt;name }}
                    &lt;/div&gt;
                    &lt;div&gt;
                        {{-- ユーザ詳細ページへのリンク --}}
                        &lt;p&gt;&lt;a class="link link-hover text-info" href="{{ route('users.show', $user-&gt;id) }}"&gt;View profile&lt;/a&gt;&lt;/p&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/li&gt;
        @endforeach
    &lt;/ul&gt;
    {{-- ページネーションのリンク --}}
    {{ $users-&gt;links() }}
@endif</pre>
                <p class="text-xs text-gray-500">
                    ※ <code>&lt;a href="{{ route('users.show', $user-&gt;id) }}"&gt;</code> で使用している <code>route()</code> はヘルパー関数と呼ばれるものです。<br>
                    参考: <a href="https://readouble.com/laravel/9.x/ja/helpers.html#method-route" target="_blank" class="text-blue-600 underline font-mono">ヘルパー関数 - Laravel 9.x</a>
                </p>
            </div>

            <div class="bg-gray-50 p-4 border rounded-lg space-y-2 text-sm leading-relaxed">
                <h5 class="font-bold text-gray-800">ページネーションについて（※追記不要です）</h5>
                <p>
                    ページネーションとは、1ページに表示する件数以上のデータを、次のページに表示したとき、次以降のページへのリンクを表示したものを言います。<br>
                    <code>$users = User::orderBy('id', 'desc')->paginate(10);</code> で、10件ずつ取得する形式にしています（10件ないとページネーションが表示されないため、試しに <code>paginate(1)</code> として確認しても良いでしょう）。<br>
                    <code>{{ $users->links() }}</code> でページネーションの部品が表示されます。
                </p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/users/users.blade.php（抜粋）</p>
                <pre class="bg-white p-3 rounded font-mono text-xs border text-gray-600">        ...
        @endforeach
    &lt;/ul&gt;
    {{-- ページネーションのリンク --}}
    {{ $users-&gt;links() }}
@endif</pre>
            </div>

            <div class="space-y-3 pt-2">
                <h5 class="font-bold text-sm text-gray-800">ナビゲーションバー</h5>
                <p class="text-sm leading-relaxed">
                    usersのindexを作成したので、この段階からナビゲーションバーにあった <strong>Users</strong> へのリンクが動作するようになります。
                </p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/commons/navbar.blade.php（抜粋・追記不要）</p>
                <pre class="bg-gray-100 p-3 rounded text-xs font-mono border text-gray-600">        &lt;div class="flex-none"&gt;
            &lt;form method="POST" action="{{ route('logout') }}"&gt;
                @csrf
                &lt;ul tabindex="0" class="menu hidden lg:menu-horizontal"&gt;
                    @include('commons.link_items')
                &lt;/ul&gt;</pre>
                <p class="text-sm"><code>navbar.blade.php</code> の <code>@include('commons.link_items')</code> で、 <code>resources/views/commons/link_items.blade.php</code> を読み込んで表示します。</p>
                
                <h6 class="font-bold text-xs text-blue-700">link_items.blade.php の修正</h6>
                <p class="text-sm">Users に設定するリンクとして <code>{{ route('users.index') }}</code> と <code>{{ route('users.show', Auth::user()->id) }}</code> を追記してください。</p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/commons/link_items.blade.php（抜粋）</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@if (Auth::check())
    {{-- ユーザ一覧ページへのリンク --}}
    &lt;li&gt;&lt;a class="link link-hover" href="{{ route('users.index') }}"&gt;Users&lt;/a&gt;&lt;/li&gt;
    {{-- ユーザ詳細ページへのリンク --}}
    &lt;li&gt;&lt;a class="link link-hover" href="{{ route('users.show', Auth::user()->id) }}"&gt;{{ Auth::user()-&gt;name }}&amp;#39;s profile&lt;/a&gt;&lt;/li&gt;</pre>
                <p class="text-xs text-gray-600 leading-relaxed mt-2">
                    ここでは <code>@if (Auth::check())</code> で、ログインしているかチェックしています。<br>
                    ログインしている場合、<code>&lt;li&gt;&lt;a class="link link-hover" href="{{ route('users.index') }}"&gt;Users&lt;/a&gt;&lt;/li&gt;</code> でユーザー一覧画面のリンク、<code>&lt;li&gt;&lt;a class="link link-hover" href="{{ route('users.show', Auth::user()->id) }}"&gt;{{ Auth::user()-&gt;name }}&amp;#39;s profile&lt;/a&gt;&lt;/li&gt;</code> でユーザ詳細ページへのリンクが、ナビゲーションバーの右上に表示されます。
                </p>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h4 class="font-bold text-base text-gray-800">表示の確認</h4>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">npm run build
php artisan serve --host=127.0.0.1 --port=8080</pre>
            
            <p class="text-xs font-bold text-gray-500 italic">ユーザー一覧ページ表示例</p>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                <img src="/images/Lesson18-43.png" alt="Users Index Preview" class="w-full h-auto rounded border">
            </div>

            <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-xs leading-relaxed text-red-900">
                ⚠️ <strong>メールのエラーが表示される場合は：</strong><br>
                <code>.env</code> ファイルの <code>MAIL_MAILER=</code> を <code>log</code> に変更してみてください。すると <code>storage/logs/laravel.log</code> にメール内容が出力されるようになり、内容を確認できます。<br>
                変更後は以下のキャッシュクリアコマンドを実行してください。
                <pre class="bg-gray-800 text-gray-200 p-2 rounded font-mono text-xs mt-2">php artisan config:clear
php artisan cache:clear</pre>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">UsersController@show</h3>
        
        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800">Controller</h4>
            <p class="text-sm font-bold text-gray-600">UsersController</p>
            <p class="text-sm leading-relaxed">showでは、 <code>$id</code> の引数を利用して表示すべきユーザを特定します。<br>
            次の内容を <code>public function index()</code> の閉じタグ <code>}</code> の後にある <code>show()</code> の内容へ追記してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/UsersController.php の show アクション</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }</pre>
        </div>

        <div class="space-y-4 pt-2">
            <h4 class="font-bold text-base text-gray-800">View</h4>
            
            <div class="space-y-2">
                <h5 class="font-bold text-sm text-blue-700">◆ users.show（show.blade.php）</h5>
                <p class="text-sm leading-relaxed">現時点で、ユーザ詳細ページでは、ユーザの名前とGravatarを表示しているだけです。後ほど、さまざまな機能を実装して充実させていきます。</p>
                <p class="text-xs font-bold text-yellow-600">※resources/views/users フォルダに、 show.blade.php ファイルを作成してください。</p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/users/show.blade.php</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')
    &lt;div class="sm:grid sm:grid-cols-3 sm:gap-10"&gt;
        &lt;aside class="mt-4"&gt;
            {{-- ユーザ情報 --}}
            @include('users.card')
        &lt;/aside&gt;
    &lt;/div&gt;
@endsection</pre>
                <p class="text-xs text-gray-600">※ <code>{{-- ユーザ情報 --}}</code> では、 <code>@include('users.card')</code> を読み込んでいます。これは <code>resources/views/users/card.blade.php</code> に作成します。</p>
            </div>

            <div class="space-y-2 pt-2">
                <h5 class="font-bold text-sm text-blue-700">◆ @include('users.card）（card.blade.php ）</h5>
                <p class="text-xs font-bold text-yellow-600">※resources/views/users フォルダに、 card.blade.php ファイルを作成してください。</p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/users/card.blade.php</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;div class="card border border-base-300"&gt;
    &lt;div class="card-body bg-base-200 text-4xl"&gt;
        &lt;h2 class="card-title"&gt;{{ $user-&gt;name }}&lt;/h2&gt;
    &lt;/div&gt;
    &lt;figure&gt;
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        &lt;img src="{{ Gravatar::get($user-&gt;email, ['size' => 500]) }}" alt=""&gt;
    &lt;/figure&gt;
&lt;/div&gt;</pre>
                <p class="text-xs text-gray-600 leading-relaxed bg-gray-50 p-3 rounded border">
                    ・<code>{{ $user->name }}</code> では、対象のユーザー名を表示します。<br>
                    ・<code>{{ Gravatar::get($user->email, ['size' => 500]) }}</code> では、ユーザのメールアドレスをもとにGravatarを取得して500pxのサイズで表示しています。
                </p>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h4 class="font-bold text-base text-gray-800">表示の確認</h4>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">npm run build
php artisan serve --host=127.0.0.1 --port=8080</pre>
            
            <p class="text-xs font-bold text-gray-500 italic">ユーザー詳細ページ表示例</p>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                <img src="/images/Lesson18-44.png" alt="User Show Profile Preview" class="w-full h-auto rounded border">
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">登録・ログインデザイン変更</h3>
        <p class="text-sm">ここでは、ユーザー登録ページとログインページのデザインも変更していきます。</p>
        <ul class="list-disc pl-5 text-xs font-mono text-gray-600">
            <li>register.blade.php</li>
            <li>login.blade.php</li>
        </ul>

        <div class="space-y-2 pt-2 border-t">
            <h4 class="font-bold text-base text-gray-800">ユーザー登録ページ</h4>
            <p class="text-sm"><code>register.blade.php</code> を次のように変更してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/auth/register.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')

    &lt;div class="prose mx-auto text-center"&gt;
        &lt;h2&gt;Sign up&lt;/h2&gt;
    &lt;/div&gt;

    &lt;div class="flex justify-center"&gt;
        &lt;form method="POST" action="{{ route('register') }}" class="w-1/2"&gt;
            @csrf

            &lt;div class="form-control my-4"&gt;
                &lt;label for="name" class="label"&gt;
                    &lt;span class="label-text"&gt;Name&lt;/span&gt;
                &lt;/label&gt;
                &lt;input type="text" name="name" class="input input-bordered w-full"&gt;
            &lt;/div>

            &lt;div class="form-control my-4"&gt;
                &lt;label for="email" class="label"&gt;
                    &lt;span class="label-text"&gt;Email&lt;/span&gt;
                &lt;/label&gt;
                &lt;input type="email" name="email" class="input input-bordered w-full"&gt;
            &lt;/div&gt;

            &lt;div class="form-control my-4"&gt;
                &lt;label for="password" class="label"&gt;
                    &lt;span class="label-text"&gt;Password&lt;/span&gt;
                &lt;/label&gt;
                &lt;input type="password" name="password" class="input input-bordered w-full"&gt;
            &lt;/div&gt;

            &lt;div class="form-control my-4"&gt;
                &lt;label for="password_confirmation" class="label"&gt;
                    &lt;span class="label-text"&gt;Confirmation&lt;/span&gt;
                &lt;/label&gt;
                &lt;input type="password" name="password_confirmation" class="input input-bordered w-full"&gt;
            &lt;/div&gt;

            &lt;button type="submit" class="btn btn-primary btn-block normal-case"&gt;Sign up&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;
@endsection</pre>
        </div>

        <div class="space-y-2 pt-2 border-t">
            <h4 class="font-bold text-base text-gray-800">ログインページ</h4>
            <p class="text-sm"><code>login.blade.php</code> を次のように変更してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/auth/login.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')

    &lt;div class="prose mx-auto text-center"&gt;
        &lt;h2&gt;Log in&lt;/h2&gt;
    &lt;/div&gt;

    &lt;div class="flex justify-center"&gt;
        &lt;form method="POST" action="{{ route('login') }}" class="w-1/2"&gt;
            @csrf

            &lt;div class="form-control my-4"&gt;
                &lt;label for="email" class="label"&gt;
                    &lt;span class="label-text"&gt;Email&lt;/span&gt;
                &lt;/label&gt;
                &lt;input type="email" name="email" class="input input-bordered w-full"&gt;
            &lt;/div&gt;

            &lt;div class="form-control my-4"&gt;
                &lt;label for="password" class="label"&gt;
                    &lt;span class="label-text"&gt;Password&lt;/span&gt;
                &lt;/label&gt;
                &lt;input type="password" name="password" class="input input-bordered w-full"&gt;
            &lt;/div&gt;

            &lt;button type="submit" class="btn btn-primary btn-block normal-case"&gt;Log in&lt;/button&gt;

            {{-- ユーザ登録ページへのリンク --}}
            &lt;p class="mt-2"&gt;New user? &lt;a class="link link-hover text-info" href="{{ route('register') }}"&gt;Sign up now!&lt;/a&gt;&lt;/p&gt;
        &lt;/form&gt;
    &lt;/div&gt;
@endsection</pre>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h4 class="font-bold text-base text-gray-800">表示確認</h4>
            <p class="text-sm">Laravelを起動して表示確認してみてください。</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">npm run build
php artisan serve --host=127.0.0.1 --port=8080</pre>

            <div class="space-y-4 pt-2">
                <p class="text-xs font-bold text-gray-500">ユーザー登録ページ表示例（https://インスタンスID.vfs.cloud9.ap-northeast-1.amazonaws.com/register）</p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                    <img src="/images/Lesson18-45.png" alt="Register Page Layout Preview" class="w-full h-auto rounded border">
                </div>

                <p class="text-xs font-bold text-gray-500">ログインページ表示例（https://インスタンスID.vfs.cloud9.ap-northeast-1.amazonaws.com/login）</p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                    <img src="/images/Lesson18-46.png" alt="Login Page Layout Preview" class="w-full h-auto rounded border">
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Git</h3>
        <div class="bg-gray-50 p-5 rounded-lg border text-sm space-y-2 leading-relaxed">
            <h4 class="font-bold text-gray-800">ここまでのまとめ</h4>
            <p>
                このレッスンではX（旧Twitter）のクローンサイトを構築しています。まずはサイトのユーザに関わる機能として「ユーザ登録」と「ログイン」の機能を作りました。これから作る投稿機能などは、ユーザがログインしていなければ利用できない機能となっています。
            </p>
        </div>
        
        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic">Gitコマンド</p>
            <pre class="bg-gray-900 text-white p-5 rounded-lg font-mono text-sm shadow-md">git add -A
git commit -m "user pages"
git push origin main</pre>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}