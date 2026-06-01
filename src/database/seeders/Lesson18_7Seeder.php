<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_7Seeder extends Seeder
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
                'sort_order' => 7,
            ],
            [
                'title' => 'トップページ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">トップページ</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-2">
            <p>ログイン前のトップページにはModel操作はないため、Viewのみを作成します。共通で利用するレイアウトやエラーメッセージなども実装しておきましょう。トップページの内容は <code>dashboard.blade.php</code> に記述します。</p>
        </div>
    </section>

    <section class="space-y-2">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Model</h3>
        <p class="text-sm text-gray-600">トップページ専用のモデルを用意する必要はありません。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Router</h3>
        <p class="text-sm"><code>routes/web.php</code> を確認し、編集してみましょう。</p>
        
        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
            <img src="/images/Lesson18-38.png" alt="Router Web PHP Status" class="w-64 h-auto border rounded shadow-sm">
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

        <div class="space-y-4">
            <p class="text-sm">ここで、変更前の記述を以下のように書き換えます。</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-xs font-bold text-red-800 mb-2">【変更前】routes/web.phpのget()</p>
                    <pre class="bg-white p-3 rounded text-xs font-mono border text-red-600">Route::get('/', function () {
    return view('welcome');
});</pre>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-xs font-bold text-green-800 mb-2">【変更後】routes/web.phpのget()</p>
                    <pre class="bg-white p-3 rounded text-xs font-mono border text-green-600">Route::get('/', function () {
    return view('dashboard');
});</pre>
                </div>
            </div>

            <div class="space-y-2 pt-2">
                <p class="text-xs font-bold text-gray-500 italic">routes/web.php（変更後・抜粋）</p>
                <pre class="bg-gray-100 p-4 rounded text-xs font-mono border overflow-x-auto">Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';</pre>
            </div>
        </div>

        <div class="bg-gray-50 p-5 rounded-lg border text-sm space-y-3">
            <h4 class="font-bold text-gray-800 border-b pb-1">変更後のコードについて解説します。</h4>
            <p>
                <code class="bg-gray-200 px-1 rounded text-xs font-mono">Route::get('/', function () { return view('dashboard');});</code><br>
                これは、<code>/</code> というURLにアクセスしたとき、 <code>dashboard</code> という view（<code>dashboard.blade.php</code>）が表示される指定をしています。
            </p>
            <p>
                <code class="bg-gray-200 px-1 rounded text-xs font-mono">Route::get('/dashboard', function () { return view('dashboard');})-&gt;middleware(['auth'])-&gt;name('dashboard');</code><br>
                これは、<code>/dashboard</code> というURLにアクセスしたとき、 <code>dashboard</code> という view（<code>dashboard.blade.php</code>）が表示される指定をしています。
            </p>
            <p>
                <code class="bg-gray-200 px-1 rounded text-xs font-mono">require __DIR__.'/auth.php';</code><br>
                これは、<code>auth.php</code> を利用する宣言をしています。
            </p>
            <p class="text-xs text-gray-600 pt-1 border-t">
                <code>/</code> はトップページ、<code>/dashboard</code> はログイン直後に遷移するページです。最終的には <code>resources/views/dashboard.blade.php</code> の内容を、ログインしている状態か、否かで、表示が変わるように作成します。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">トップページ</h3>
        
        <div class="space-y-2">
            <h4 class="font-bold text-base text-gray-800">Controller</h4>
            <p class="text-sm leading-relaxed">Routerで <code>return view('dashboard');</code> と記述し、 <code>resources/views/dashboard.blade.php</code> という view を表示していたとおり、トップページでは Controller は使用しません。</p>
        </div>

        <div class="space-y-4 pt-2">
            <h4 class="font-bold text-base text-gray-800">View</h4>
            <p class="text-sm">このチャプターでは次の操作を行ないます。</p>
            <ul class="list-disc pl-5 text-sm space-y-1 text-gray-600">
                <li>共通レイアウトの作成</li>
                <li>エラーメッセージの作成</li>
                <li>ナビゲーションバーの作成</li>
                <li>リンクアイテムズの作成</li>
                <li>トップページの修正</li>
            </ul>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h5 class="font-bold text-sm text-blue-700">◆ 共通レイアウトの作成</h5>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                <img src="/images/Lesson18-39.png" alt="App Layout Struct" class="w-64 h-auto border rounded shadow-sm">
            </div>
            <p class="text-sm text-gray-600">ここでは、共通して利用するレイアウトとして、 <code>resources/views/layouts/app.blade.php</code> を用意します。</p>
            <p class="text-xs font-bold text-red-500">※app.blade.php ファイルに次のコードを上書きしてください。</p>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/layouts/app.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8"&gt;
        &lt;title&gt;Microposts&lt;/title&gt;
        &lt;meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"&gt;
        &lt;meta name="csrf-token" content="{{ csrf_token() }}"&gt;
        @vite('resources/css/app.css')
    &lt;/head&gt;

    &lt;body&gt;

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        &lt;div class="container mx-auto"&gt;
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        &lt;/div&gt;

    &lt;/body&gt;
&lt;/html&gt;</pre>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h5 class="font-bold text-sm text-blue-700">◆ エラーメッセージの作成</h5>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                <img src="/images/Lesson18-40.png" alt="Error Message Layout" class="w-64 h-auto border rounded shadow-sm">
            </div>
            <div class="p-3 bg-yellow-50 border border-yellow-200 rounded text-xs space-y-1 text-gray-700 font-bold">
                <p>手順1：resources/views フォルダに、 <code>commons</code> フォルダを作成してください。</p>
                <p>手順2：resources/views/commons/ フォルダに <code>error_messages.blade.php</code> ファイルを作成してください。</p>
            </div>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/commons/error_messages.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@if (count($errors) &gt; 0)
    @foreach ($errors-&gt;all() as $error)
        &lt;div class="alert alert-error mb-4"&gt;
            &lt;div&gt;
                &lt;svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"&gt;
                    &lt;path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /&gt;
                &lt;/svg&gt;
                {{ $error }}
            &lt;/div&gt;
        &lt;/div&gt;
    @endforeach
@endif</pre>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h5 class="font-bold text-sm text-blue-700">◆ ナビゲーションバーの作成</h5>
            <p class="text-xs font-bold text-yellow-600">※resources/views/commons/ フォルダに navbar.blade.php ファイルを作成してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/commons/navbar.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;header class="mb-4"&gt;
    &lt;nav class="navbar bg-neutral text-neutral-content"&gt;
        {{-- トップページへのリンク --}}
        &lt;div class="flex-1"&gt;
            &lt;h1&gt;&lt;a class="btn btn-ghost normal-case text-xl" href="/"&gt;Microposts&lt;/a&gt;&lt;/h1&gt;
        &lt;/div&gt;

        &lt;div class="flex-none"&gt;
            &lt;form method="POST" action="{{ route('logout') }}"&gt;
                @csrf
                &lt;ul tabindex="0" class="menu hidden lg:menu-horizontal"&gt;
                    @include('commons.link_items')
                &lt;/ul&gt;
                &lt;div class="dropdown dropdown-end"&gt;
                    &lt;button type="button" tabindex="0" class="btn btn-ghost normal-case font-normal lg:hidden"&gt;
                        @if (Auth::check())
                            {{ Auth::user()-&gt;name }}
                        @else
                            Guest
                        @endif
                        &lt;svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"&gt;
                            &lt;path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /&gt;
                        &lt;/svg&gt;
                    &lt;/button&gt;
                    &lt;ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52 text-info"&gt;
                        @include('commons.link_items')
                    &lt;/ul&gt;
                &lt;/div&gt;
            &lt;/form&gt;
        &lt;/div&gt;
    &lt;/nav&gt;
&lt;/header&gt;</pre>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h5 class="font-bold text-sm text-blue-700">◆ リンクアイテムズの作成</h5>
            <p class="text-sm leading-relaxed">
                ナビゲーションバーで読み込まれた <code>@include('commons.link_items')</code> を作成します。<br>
                resources/views/commons/ フォルダに <code>link_items.blade.php</code> ファイルを作成してください。<br>
                <span class="text-xs bg-gray-100 p-1 rounded font-mono text-gray-600">※ &#39; は、HTML上でシングルクォーテーション（'）を表示させるための特殊な記述です。</span>
            </p>
            <p class="text-xs font-bold text-gray-500 italic">microposts/resources/views/commons/link_items.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@if (Auth::check())
    {{-- ユーザ一覧ページへのリンク --}}
    &lt;li&gt;&lt;a class="link link-hover" href="#"&gt;Users&lt;/a&gt;&lt;/li&gt;
    {{-- ユーザ詳細ページへのリンク --}}
    &lt;li&gt;&lt;a class="link link-hover" href="#"&gt;{{ Auth::user()-&gt;name }}&amp;#39;s profile&lt;/a&gt;&lt;/li&gt;
    &lt;li class="divider lg:hidden"&gt;&lt;/li&gt;
    {{-- ログアウトへのリンク --}}
    &lt;li&gt;&lt;a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();"&gt;Logout&lt;/a&gt;&lt;/li&gt;
@else
    {{-- ユーザ登録ページへのリンク --}}
    &lt;li&gt;&lt;a class="link link-hover" href="{{ route('register') }}"&gt;Signup&lt;/a&gt;&lt;/li&gt;
    &lt;li class="divider lg:hidden"&gt;&lt;/li&gt;
    {{-- ログインページへのリンク --}}
    &lt;li&gt;&lt;a class="link link-hover" href="{{ route('login') }}"&gt;Login&lt;/a&gt;&lt;/li&gt;
@endif</pre>
            
            <div class="bg-gray-50 p-4 rounded border text-xs text-gray-600 space-y-2 leading-relaxed">
                <p>・<code>@if (Auth::check())</code> では、ログイン済みユーザーかどうかを判定しています。</p>
                <p>・Laravel Breezeの初期状態では、ユーザー登録ページを <strong>Register</strong> と表示していましたが、今回の変更で <strong>Signup</strong> と表示するようにしました。URLは、 <code>register</code> のままです。</p>
                <p>・Laravel Breezeの初期状態では、ログインページを <strong>log in</strong> と表示していましたが、今回の変更で <strong>Login</strong> と表示するようにしました。URLは、 <code>login</code> のままです。</p>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t">
            <h5 class="font-bold text-sm text-blue-700">◆ トップページの修正</h5>
            <p class="text-sm font-bold text-red-500">※dashboard.blade.php にあらかじめ書かれていた内容は不要であるため、すべて削除して下記の通りにしてください。</p>
            <p class="text-xs font-bold text-gray-500 italic">resources/views/dashboard.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')
    &lt;div class="prose hero bg-base-200 mx-auto max-w-full rounded"&gt;
        &lt;div class="hero-content text-center my-10"&gt;
            &lt;div class="max-w-md mb-10"&gt;
                &lt;h2&gt;Welcome to the Microposts&lt;/h2&gt;
                {{-- ユーザ登録ページへのリンク --}}
                &lt;a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}"&gt;Sign up now!&lt;/a&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
@endsection</pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">表示の確認</h3>
        
        <div class="space-y-2">
            <h4 class="font-bold text-sm text-gray-800">Laravelの起動</h4>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">npm run build
php artisan serve --host=127.0.0.1 --port=8080</pre>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-lg p-5 space-y-3">
            <h4 class="font-bold text-sm text-red-900">💡 レイアウトが崩れている場合は以下を試してみてください。</h4>
            <pre class="bg-gray-800 text-gray-200 p-3 rounded font-mono text-xs overflow-x-auto">npm uninstall daisyui
npm install daisyui@3

rm -rf node_modules
rm package-lock.json
npm install
npm run dev</pre>
        </div>

        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
            <img src="/images/Lesson18-41.png" alt="Welcome Page Preview" class="w-full h-auto rounded border">
        </div>

        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg text-xs leading-relaxed text-blue-950 font-bold shadow-sm">
            📌 本レッスンでは、Tailwind CSSはBreezeに入っているものを利用します。Breezeのものを使う場合やnpmからTailwind CSSをインストールした場合、Viewのファイルを作成・更新して表示確認する際に npm run build の実行が必須となります。これを忘れると、新たに追加したTailwind CSSのクラスの装飾が反映されません。
        </div>

        <div class="space-y-2 pt-2">
            <p class="text-xs font-bold text-gray-500 italic">Git操作</p>
            <pre class="bg-gray-900 text-white p-5 rounded-lg font-mono text-sm shadow-md">git add -A
git commit -m 'top page'
git push origin main</pre>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}