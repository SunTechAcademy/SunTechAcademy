<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_8Seeder extends Seeder
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
                'sort_order' => 8,
            ],
            [
                'title' => 'ControllerとViewの構築',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">ControllerとViewの構築</h2>
        <p class="text-sm leading-relaxed">
            ControllerとViewは密接に関わるので、同時に開発します。まずはControllerから作成します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">RESTful Resource Controllerの生成</h3>
        <p class="text-sm">先ほどのルーティングに対応したControllerを作成します。</p>
        <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400 text-sm">
            <code>Route::resource('messages', MessagesController::class);</code> で指定したController名で作成してください。 Routerに対応したController名をつけないとルーティングされません。
        </div>
        
        <p class="text-sm font-bold">コマンド入力</p>
        <div class="bg-gray-800 text-white p-4 rounded font-mono text-sm">
            php artisan make:controller MessagesController --resource
        </div>

        <p class="text-xs italic text-gray-500">実行結果</p>
        <div class="flex justify-start py-2">
            <img src="/images/Lesson16-45.png" alt="Controller生成結果" class="max-w-full border rounded">
        </div>

        <p class="text-sm">生成された <code>app/Http/controllers/MessagesController.php</code> というファイルの中身を確認してください。</p>
        
        <div class="prose max-w-none text-sm space-y-4">
            <p>
                <code>--resource</code> をつけて <code>make:controller</code> で作成されたControllerは先ほどの7つのルーティングに対応した7つのアクションが入った形で作られます。この形のControllerを<strong>RESTful Resource Controller</strong>と呼びます。
            </p>
            <p>
                <strong>RESTful</strong>とはリソース（URL）に対して、取得（GET）/ 新規登録（POST）/ 更新（PUT）/ 削除（DELETE）といったHTTPリクエストメソッドをURIに応じて実行する、という考え方です。
            </p>
        </div>

        <p class="text-xs font-bold text-gray-500 mt-4">routes/web.php（抜粋）</p>
        <div class="bg-gray-100 p-3 rounded font-mono text-sm">
            Route::resource('messages', MessagesController::class);
        </div>

        <p class="text-sm mt-4">日本語の説明でコメントを書き換えた <code>app/Http/Controllers/MessagesController.php</code> を下記に示します。</p>

        <div class="bg-gray-900 text-green-400 p-6 rounded-lg font-mono text-xs overflow-x-auto shadow-inner">
<pre>
&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController extends Controller
{
    // getでmessages/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        //
    }

    // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        //
    }

    // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        //
    }

    // getでmessages/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        //
    }

    // getでmessages/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        //
    }

    // putまたはpatchでmessages/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        //
    }

    // deleteでmessages/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        //
    }
}</pre>
        </div>

        <p class="text-sm mt-6 font-bold">クラス図での表現：</p>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-46.png" alt="RESTful Controllerクラス図" class="max-w-2xl w-full border rounded shadow-sm">
        </div>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded text-sm text-gray-700">
            ただし、ただの雛形であるため、アクションの中身はまだ何も処理が書かれていません。この中身をコーディングしていくことになります。<br>
            Controllerが生成されると、 <code>php artisan route:list</code> でルーティングの確認が可能です。
        </div>

        <p class="text-sm font-bold">ルーティングの確認</p>
        <div class="bg-gray-800 text-white p-4 rounded font-mono text-sm mb-4">
            php artisan route:list
        </div>

        <div class="bg-black text-white p-5 rounded font-mono text-[10px] leading-tight overflow-x-auto">
<pre>
GET|HEAD        / ............................................................ MessagesController@index
POST            _ignition/execute-solution ......................... ignition.executeSolution › Spatie...
GET|HEAD        _ignition/health-check ................................. ignition.healthCheck › Spatie...
POST            _ignition/update-config ............................... ignition.updateConfig › Spatie...
GET|HEAD        api/user .............................................................................. 
GET|HEAD        messages ........................................... messages.index › MessagesController@index
POST            messages ........................................... messages.store › MessagesController@store
GET|HEAD        messages/create .................................. messages.create › MessagesController@create
GET|HEAD        messages/{message} ................................... messages.show › MessagesController@show
PUT|PATCH       messages/{message} ............................... messages.update › MessagesController@update
DELETE          messages/{message} ............................. messages.destroy › MessagesController@destroy
GET|HEAD        messages/{message}/edit .............................. messages.edit › MessagesController@edit
GET|HEAD        sanctum/csrf-cookie ......................... sanctum.csrf-cookie › Laravel\Sanctum › ...

Showing [13] routes</pre>
        </div>

        <div class="p-4 bg-gray-50 text-xs text-gray-600 border rounded italic">
            <strong>PATCH</strong> は <strong>PUT</strong> と同じです。HEAD を含め、深く考える必要はありません。また、 <code>{id}</code> で説明してきたものが <code>{message}</code> に代わっていますが、この場合でも <code>/messages/1/edit</code> のように id が入ることに変わりありません。
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Viewの構成について</h3>
        <h4 class="font-bold text-gray-800">4つのアクションに対応したViewファイルの作成</h4>
        <p class="text-sm leading-relaxed">
            messagesの7つのアクションの中でViewが必要なのは<strong>GETメソッドが指定された4つのみ</strong>です。なぜならそれ以外のPOST, PUT, DELETEなどのメソッドが指定された3つは保存や削除の操作であり、ページの表示ではないからです。
        </p>

        <div class="overflow-x-auto shadow rounded-lg border text-[11px]">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr><th class="px-4 py-2 border">Method</th><th class="px-4 py-2 border">URI</th><th class="px-4 py-2 border">Name</th><th class="px-4 py-2 border">Action</th></tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="bg-blue-50 font-bold text-blue-800"><td class="px-4 py-1 border">GET|HEAD</td><td class="px-4 py-1 border">messages</td><td class="px-4 py-1 border">messages.index</td><td class="px-4 py-1 border">MessagesController@index</td></tr>
                    <tr><td class="px-4 py-1 border">POST</td><td class="px-4 py-1 border">messages</td><td class="px-4 py-1 border">messages.store</td><td class="px-4 py-1 border">MessagesController@store</td></tr>
                    <tr class="bg-blue-50 font-bold text-blue-800"><td class="px-4 py-1 border">GET|HEAD</td><td class="px-4 py-1 border">messages/create</td><td class="px-4 py-1 border">messages.create</td><td class="px-4 py-1 border">MessagesController@create</td></tr>
                    <tr class="bg-blue-50 font-bold text-blue-800"><td class="px-4 py-1 border">GET|HEAD</td><td class="px-4 py-1 border">messages/{message}</td><td class="px-4 py-1 border">messages.show</td><td class="px-4 py-1 border">MessagesController@show</td></tr>
                    <tr><td class="px-4 py-1 border">PUT|PATCH</td><td class="px-4 py-1 border">messages/{message}</td><td class="px-4 py-1 border">messages.update</td><td class="px-4 py-1 border">MessagesController@update</td></tr>
                    <tr><td class="px-4 py-1 border">DELETE</td><td class="px-4 py-1 border">messages/{message}</td><td class="px-4 py-1 border">messages.destroy</td><td class="px-4 py-1 border">MessagesController@destroy</td></tr>
                    <tr class="bg-blue-50 font-bold text-blue-800"><td class="px-4 py-1 border">GET|HEAD</td><td class="px-4 py-1 border">messages/{message}/edit</td><td class="px-4 py-1 border">messages.edit</td><td class="px-4 py-1 border">MessagesController@edit</td></tr>
                </tbody>
            </table>
        </div>

        <p class="text-sm">GETのルーティングである index, show, create, edit に対応するViewを作成します。具体的なファイルの場所と名前は下記の通りです。</p>
        <ul class="list-none space-y-1 font-mono text-sm bg-gray-50 p-4 rounded border">
            <li>📁 resources/views/messages/index.blade.php</li>
            <li>📁 resources/views/messages/show.blade.php</li>
            <li>📁 resources/views/messages/create.blade.php</li>
            <li>📁 resources/views/messages/edit.blade.php</li>
        </ul>
        
        <p class="text-sm">VSCode上で <code>resources/views/</code> の直下に <strong>messages</strong> フォルダを作成し、空っぽのファイルで良いので、上記の4つのファイルを作成してください。</p>

        <div class="bg-red-50 p-4 rounded border border-red-200 text-sm italic">
            Viewは resources/views/ の下にフォルダ分けされながら配置されます。残念ながらViewを作成するartisanコマンドは用意されていないため、手作業で1つずつ作成してください。
        </div>

        <h4 class="font-bold text-gray-800 mt-8 border-l-4 border-green-500 pl-3">Bladeとは</h4>
        <p class="text-sm leading-relaxed">
            <code>index.blade.php</code> のように <code>.php</code> の前に <code>.blade</code> という拡張子が含まれています。これはBlade形式のViewを表しています。<br>
            Bladeは、PHPプログラムのようにHTMLを埋め込みます。さらに便利な機能もついています。
        </p>
        <ul class="list-disc pl-6 text-sm space-y-1">
            <li>Bladeの継承: <code>@yield</code></li>
            <li>Bladeの読込: <code>@include</code></li>
        </ul>
        <p class="text-[11px] text-blue-500">
            <a href="https://readouble.com/laravel/9.x/ja/blade.html" target="_blank">参考: Bladeテンプレート - Laravel 9.x 公式</a>
        </p>
        
        <div class="bg-gray-100 p-4 rounded text-xs">
            <strong>bladeファイルのコメント記法:</strong><br>
            bladeでは <code>{{-- --}}</code> を使ってコメントアウトを行います。
        </div>

        <h4 class="font-bold text-gray-800 mt-8 border-l-4 border-green-500 pl-3">共通部利用の考え方</h4>
        <p class="text-sm leading-relaxed">
            HTMLを書くときには必ず <code>&lt;!DOCTYPE html&gt;</code> や <code>head</code> 要素などの共通する部分が存在します。これらをすべてのページに書くのは非効率であり、バグの原因にもなります。<br>
            Bladeを使えば共通部を1つのファイルにまとめて手軽に管理できます。
        </p>

        <p class="text-sm font-bold">フォルダの作成</p>
        <p class="text-xs">次のフォルダを作成してください。</p>
        <ul class="list-disc pl-6 text-xs space-y-1">
            <li>resources/views/ の直下に <strong>commons</strong> フォルダを作成してください。</li>
            <li>resources/views/ の直下に <strong>layouts</strong> フォルダを作成してください。</li>
            <li>resources/views/ の直下に <strong>messages</strong> フォルダを作成してください。</li>
        </ul>
        <div class="flex justify-start py-2">
            <img src="/images/Lesson16-47.png" alt="フォルダ構成" class="max-w-xs border rounded shadow-sm">
        </div>

        <div class="bg-red-50 p-4 border border-red-200 rounded text-red-800 font-bold text-sm text-center">
            ⚠️ この段階ではまだ作成しないで下さい
        </div>
        <ul class="list-none space-y-1 font-mono text-[11px] bg-gray-50 p-4 rounded border text-gray-500">
            <li>resources/views/layouts/app.blade.php</li>
            <li>resources/views/commons/navbar.blade.php</li>
            <li>resources/views/commons/error_messages.blade.php</li>
            <li>resouces/views/messages/index.blade.php</li>
            <li>resouces/views/messages/show.blade.php</li>
            <li>resouces/views/messages/create.blade.php</li>
            <li>resouces/views/messages/edit.blade.php</li>
        </ul>

        <h4 class="font-bold text-gray-800 mt-8">共通レイアウト利用の流れ</h4>
        <p class="text-sm italic">現段階ではファイル未作成のため分かりづらい部分もありますが、<code>app.blade.php</code> という共通レイアウトを利用する流れを記載しておきます。目を通すだけで構いません。</p>
        
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 space-y-3 text-sm">
            <p class="font-bold">index.blade.php を表示させたい場合：</p>
            <ol class="list-decimal pl-6 space-y-2">
                <li><code>index.blade.php</code> の <code>@extends('layouts.app')</code> で、 <code>app.blade.php</code> の内容を継承することを宣言。</li>
                <li><code>app.blade.php</code> のhtml部分を上から順番に継承して利用。</li>
                <li><code>app.blade.php</code> の <code>@include('commons.navbar')</code> でナビバーを読み込む。</li>
                <li><code>app.blade.php</code> の <code>@include('commons.error_messages')</code> でエラーメッセージを読み込む。</li>
                <li><code>app.blade.php</code> の <code>@yield('content')</code> に、 <code>index.blade.php</code> の <code>@section('content')</code> の内容を埋め込む。</li>
            </ol>
        </div>

        <div class="space-y-6 mt-8">
            <h5 class="font-bold text-gray-800">resources/views/layouts/app.blade.phpファイルの作成</h5>
            <p class="text-sm">共通の内容を1つにまとめて管理します。 <code>resources/views/layouts/</code> フォルダに作成してください。</p>
            <div class="bg-gray-800 rounded-lg p-5 font-mono text-xs text-white">
<pre>
&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8"&gt;
        &lt;title&gt;MessageBoard&lt;/title&gt;
        &lt;meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"&gt;
        &lt;meta name="csrf-token" content="{{ csrf_token() }}"&gt;
        &lt;link href="https://cdn.jsdelivr.net/npm/daisyui@2.24.0/dist/full.css" rel="stylesheet" type="text/css" /&gt;
        &lt;script src="https://cdn.tailwindcss.com"&gt;&lt;/script&gt;
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
            
            <div class="space-y-4 text-sm bg-gray-50 p-4 rounded border">
                <p><strong>@include('commons.navbar')</strong> : <code>resources/views/commons/navbar.blade.php</code> を読み込みます。</p>
                <p><strong>@include('commons.error_messages')</strong> : <code>resources/views/commons/error_messages.blade.php</code> を読み込みます。</p>
                <p><strong>@yield('content')</strong> : 継承先（indexなど）の <code>@section('content')</code> の内容がここに入ります。</p>
            </div>
        </div>

        <div class="space-y-6 mt-8">
            <h5 class="font-bold text-gray-800">各ファイルの作成（navbar, error_messages）</h5>
            <p class="text-xs"><code>resources/views/commons/</code> フォルダに、空の <code>navbar.blade.php</code> と <code>error_messages.blade.php</code> を作成してください。（内容は次チャプターで詳述します）</p>
            
            <h5 class="font-bold text-gray-800 mt-6">各.blade.phpファイルの作成（メッセージ関連）</h5>
            <p class="text-sm"><code>resouces/views/messages/</code> フォルダに4つのファイルを作成し、一旦以下の雛形を記述してください。</p>
            <div class="bg-gray-100 p-4 rounded font-mono text-xs">
                @extends('layouts.app')<br>
                @section('content')<br><br>
                &lt;!-- ここにページ毎のコンテンツを書く --&gt;<br><br>
                @endsection
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-300 mt-10">
            <h5 class="font-bold text-gray-800 mb-2">（参考）コマンドでファイルとフォルダ作成</h5>
            <p class="text-xs text-gray-600 leading-relaxed mb-4">
                1回目の学習中はマウス操作で行ってください。復習段階で慣れてきたら、以下のコマンドで一括作成すると効率的です。
            </p>
            <div class="bg-gray-900 text-green-400 p-4 rounded font-mono text-[11px] overflow-x-auto">
                message-board $ cd resources/views/<br>
                message-board/resources/views $ mkdir commons layouts messages<br>
                message-board/resources/views $ touch messages/{index.blade.php,show.blade.php,create.blade.php,edit.blade.php}<br>
                message-board/resources/views $ touch commons/error_messages.blade.php<br>
                message-board/resources/views $ touch layouts/app.blade.php
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MessagesController@index</h3>
        <p class="text-sm">7つのルーティングに対するレスポンスを実装します。まずはindexアクションから開発しましょう。</p>
        
        <h4 class="font-bold text-gray-800">Controllerの実装</h4>
        <p class="text-sm leading-relaxed">
            indexアクションの役割はMessageレコードの<strong>一覧表示</strong>です。 Modelの全レコード取得は <code>Message::all()</code> です。<code>use App\Models\Message;</code> を追加することで、名前空間の記述を省略できます。
        </p>

        <p class="text-xs font-bold text-gray-500">app/Http/Controllers/MessagesController.php (一部抜粋)</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs overflow-x-auto">
<pre>
&lt;?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;    // 追加

class MessagesController extends Controller
{
    public function index()
    {
        // メッセージ一覧を取得
        $messages = Message::all();

        // メッセージ一覧ビューでそれを表示
        return view('messages.index', [
            'messages' => $messages,
        ]);
    }
}</pre>
        </div>

        <div class="bg-blue-50 p-4 rounded text-sm space-y-2">
            <p><strong>view('messages.index', [...])</strong>: 第一引数はViewのパス（<code>.</code>区切り）、第二引数は連想配列形式で渡すデータです。</p>
            <p><strong>'messages' => $messages</strong>: 左側がView側で呼び出す変数名、右側がコントローラ内の変数です。</p>
        </div>

        <p class="text-sm font-bold">クラス図での表現：</p>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-48.png" alt="Indexアクション クラス図" class="max-w-2xl w-full border rounded shadow-sm">
        </div>

        <h4 class="font-bold text-gray-800">Viewの実装</h4>
        <p class="text-xs italic text-gray-500">resources/views/messages/index.blade.php</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-[11px] overflow-x-auto">
<pre>
@extends('layouts.app')

@section('content')
    &lt;div class="prose ml-4"&gt;
        &lt;h2&gt;メッセージ 一覧&lt;/h2&gt;
    &lt;/div&gt;

    @if (isset($messages))
        &lt;table class="table table-zebra w-full my-4"&gt;
            &lt;thead&gt;
                &lt;tr&gt;
                    &lt;th&gt;id&lt;/th&gt;
                    &lt;th&gt;メッセージ&lt;/th&gt;
                &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
                @foreach ($messages as $message)
                &lt;tr&gt;
                    &lt;td&gt;&lt;a class="link link-hover text-info" href="#"&gt;{{ $message-&gt;id }}&lt;/a&gt;&lt;/td&gt;
                    &lt;td&gt;{{ $message-&gt;content }}&lt;/td&gt;
                &lt;/tr&gt;
                @endforeach
            &lt;/tbody&gt;
        &lt;/table&gt;
    @endif
@endsection</pre>
        </div>
        
        <p class="text-sm mt-4">シーケンス図での表現：</p>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-49.png" alt="Indexアクション シーケンス図" class="max-w-xl w-full border rounded shadow-sm">
        </div>

        <h4 class="font-bold text-gray-800">動作確認</h4>
        <p class="text-sm">Laravelサーバを起動し、 <code>/messages</code> もしくは <code>/</code> にアクセスしてください。</p>
        <div class="bg-gray-100 p-3 rounded font-mono text-sm">http://127.0.0.1:8000/messages</div>
        
        <div class="flex justify-start py-4">
            <img src="/images/Lesson16-50.png" alt="表示例" class="max-w-md border rounded shadow-sm">
        </div>

        <div class="bg-red-50 p-4 rounded text-xs space-y-2 border border-red-200">
            <p class="font-bold text-red-800">MySQLサーバが起動していないときのエラー</p>
            <p><code>Connection refused</code> と出た場合は、XAMPPのMySQLを起動してください。</p>
            <p class="font-bold text-red-800 mt-2">一覧が表示されない場合</p>
            <p>レコードが0件の場合は表示されません。tinkerを起動し、 <code>$message = new App\Models\Message; $message->content = 'hello'; $message->save();</code> でテストデータを作成してください。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MessagesController@create</h3>
        <p class="text-sm leading-relaxed">
            createアクションは、 POSTメソッドを送信する新規作成用の入力フォーム置き場になります。
        </p>
        
        <h4 class="font-bold text-gray-800">Controllerの実装</h4>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs">
<pre>
    public function create()
    {
        $message = new Message;
        return view('messages.create', ['message' => $message]);
    }</pre>
        </div>

        <h4 class="font-bold text-gray-800">Viewの修正</h4>
        <p class="text-xs italic">resources/views/messages/index.blade.php の最後に追加</p>
        <div class="bg-gray-100 p-3 rounded font-mono text-[11px]">
            &lt;a class="btn btn-primary" href="{{ route('messages.create') }}"&gt;新規メッセージの投稿&lt;/a&gt;
        </div>
        <div class="flex justify-start py-2">
            <img src="/images/Lesson16-51.png" alt="新規投稿ボタン" class="max-w-xs border rounded shadow-sm">
        </div>

        <h4 class="font-bold text-gray-800 mt-6">create.blade.phpのフォーム設置</h4>
        <div class="bg-gray-900 text-white p-5 rounded font-mono text-[10px] overflow-x-auto">
<pre>
@extends('layouts.app')
@section('content')
    &lt;h2&gt;メッセージ新規作成ページ&lt;/h2&gt;
    &lt;form method="POST" action="{{ route('messages.store') }}"&gt;
        @csrf
        &lt;input type="text" name="content" class="input input-bordered w-full"&gt;
        &lt;button type="submit" class="btn btn-primary"&gt;投稿&lt;/button&gt;
    &lt;/form&gt;
@endsection</pre>
        </div>

        <div class="space-y-3 text-xs bg-blue-50 p-4 rounded border">
            <p><strong>@csrf</strong>: クロスサイトリクエストフォージェリ攻撃からLaravelを守る必須のセキュリティ処理です。</p>
            <p><strong>route('messages.store')</strong>: storeアクション（POST先）へのURLを生成します。</p>
        </div>
        
        <div class="flex justify-start py-4">
            <img src="/images/Lesson16-52.png" alt="フォーム表示結果" class="max-w-md border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MessagesController@store</h3>
        <p class="text-sm">送られてきたフォームの内容（$request）を取り出して保存します。</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs overflow-x-auto">
<pre>
    public function store(Request $request)
    {
        $message = new Message;
        $message->content = $request->content;
        $message->save();

        return redirect('/');
    }</pre>
        </div>
        <p class="text-sm italic">※保存後はトップページへリダイレクトさせるため、Viewは不要です。</p>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-53.png" alt="Storeアクション シーケンス図" class="max-w-xl w-full border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MessagesController@show</h3>
        <p class="text-sm leading-relaxed">
            showアクションはURLに含まれる <code>$id</code> を受け取り、 <code>Message::findOrFail($id)</code> で特定のレコードを1つ取得して表示します。
        </p>

        <h4 class="font-bold text-gray-800">Controllerの実装</h4>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs overflow-x-auto">
<pre>
    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('messages.show', ['message' => $message]);
    }</pre>
        </div>
        <p class="text-xs text-blue-600">※findOrFailはレコードがない場合に404エラーを出します。</p>

        <h4 class="font-bold text-gray-800 mt-6">Viewの実装 (show.blade.php)</h4>
        <div class="bg-gray-900 text-white p-5 rounded font-mono text-[10px] overflow-x-auto">
<pre>
@extends('layouts.app')
@section('content')
    &lt;h2&gt;id = {{ $message->id }} のメッセージ詳細ページ&lt;/h2&gt;
    &lt;table class="table w-full"&gt;
        &lt;tr&gt;&lt;th&gt;id&lt;/th&gt;&lt;td&gt;{{ $message->id }}&lt;/td&gt;&lt;/tr&gt;
        &lt;tr&gt;&lt;th&gt;メッセージ&lt;/th&gt;&lt;td&gt;{{ $message->content }}&lt;/td&gt;&lt;/tr&gt;
    &lt;/table&gt;
@endsection</pre>
        </div>

        <div class="flex justify-start py-4">
            <img src="/images/Lesson16-54.png" alt="詳細ページ表示" class="max-w-md border rounded shadow-sm">
        </div>

        <h4 class="font-bold text-gray-800 mt-6">indexからのリンク修正</h4>
        <div class="bg-gray-100 p-4 rounded font-mono text-xs">
            &lt;td&gt;&lt;a class="link" href="{{ route('messages.show', $message-&gt;id) }}"&gt;{{ $message-&gt;id }}&lt;/a&gt;&lt;/td&gt;
        </div>
        <div class="flex justify-start py-4">
            <img src="/images/Lesson16-55.png" alt="リンク表示結果" class="max-w-md border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MessagesController@edit</h3>
        <p class="text-sm">editは既存レコードを編集するため、最初にidで検索し、その値をフォームの初期値（value）としてセットします。</p>
        
        <h4 class="font-bold text-gray-800">Controller & View実装のポイント</h4>
        <ul class="list-disc pl-6 text-sm space-y-2">
            <li><strong>@method('PUT')</strong>: ブラウザはPUT送信ができないため、Laravel側で疑似的に指定します。</li>
            <li><strong>value="{{ $message->content }}"</strong>: 現在の値をあらかじめ表示しておきます。</li>
        </ul>

        <div class="bg-gray-900 text-white p-5 rounded font-mono text-[10px] overflow-x-auto mt-4">
<pre>
{{-- resources/views/messages/edit.blade.php --}}
&lt;form method="POST" action="{{ route('messages.update', $message->id) }}"&gt;
    @csrf
    @method('PUT')
    &lt;input type="text" name="content" value="{{ $message->content }}" class="input input-bordered"&gt;
    &lt;button type="submit" class="btn btn-primary"&gt;更新&lt;/button&gt;
&lt;/form&gt;</pre>
        </div>

        <div class="flex justify-start py-4 space-x-4">
            <img src="/images/Lesson16-56.png" alt="編集リンク" class="max-w-xs border rounded">
            <img src="/images/Lesson16-57.png" alt="編集画面" class="max-w-xs border rounded">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MessagesController@update</h3>
        <p class="text-sm">idで検索し、更新・保存したあとリダイレクトします。</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs overflow-x-auto">
<pre>
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->content = $request->content;
        $message->save();
        return redirect('/');
    }</pre>
        </div>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-58.png" alt="Updateアクション シーケンス図" class="max-w-xl w-full border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MessagesController@destroy</h3>
        <p class="text-sm">レコードを削除します。誤操作を防ぐために <code>confirm</code>（確認ダイアログ）を設置するのが一般的です。</p>
        
        <div class="bg-gray-900 text-white p-5 rounded font-mono text-[10px] overflow-x-auto">
<pre>
{{-- show.blade.php への追記 --}}
&lt;form method="POST" action="{{ route('messages.destroy', $message->id) }}"&gt;
    @csrf
    @method('DELETE')
    &lt;button type="submit" class="btn btn-error" onclick="return confirm('削除します。よろしいですか？')"&gt;削除&lt;/button&gt;
&lt;/form&gt;</pre>
        </div>

        <div class="flex justify-start py-4 space-x-4">
            <img src="/images/Lesson16-59.png" alt="削除ボタン" class="max-w-xs border rounded">
            <img src="/images/Lesson16-60.png" alt="削除確認" class="max-w-xs border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">@includeの復習</h3>
        <p class="text-sm"><code>@include</code> は他のBladeファイルをそのまま取り込みます。ナビゲーションバーなどの共通部品に最適です。</p>
        
        <div class="bg-gray-100 p-4 rounded font-mono text-[11px] text-gray-700">
            📁 resources/views/commons/navbar.blade.php のコードを完成させ、<br>
            📁 resources/views/layouts/app.blade.php の中で <code>@include('commons.navbar')</code> を呼び出してください。
        </div>

        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs overflow-x-auto mt-4">
<pre>
&lt;!-- app.blade.php (抜粋) --&gt;
&lt;body&gt;
    @include('commons.navbar') {{-- navbar.blade.phpの内容がここに展開される --}}
    &lt;div class="container mx-auto"&gt;
        @yield('content')
    &lt;/div&gt;
&lt;/body&gt;</pre>
        </div>
    </section>

    <section class="mt-20 pt-10 border-t">
        <h2 class="text-xl font-bold text-gray-800 mb-4">GitHubにプッシュしましょう</h2>
        <div class="bg-gray-900 text-green-400 p-4 rounded font-mono text-sm shadow-lg">
            git add -A<br>
            git commit -m "CRUD messages"<br>
            git push origin main
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}