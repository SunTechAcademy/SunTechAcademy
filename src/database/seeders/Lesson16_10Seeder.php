<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_10Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象となるLessonを取得
        $lesson = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：基礎')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 10,
            ],
            [
                'title' => 'カラムの追加',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">カラムの追加</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                最後に、メッセージにカラムを増やしたいときにどのように作業していくのかも把握しておきましょう。
                ここではメッセージボードに、メッセージの<strong>「タイトル」</strong>を追加します。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">カラムを増やすマイグレーション</h3>
        <p class="text-sm">
            カラム追加用のマイグレーションファイルを生成します。マイグレーション名を <code>add_title_to_messages_table</code> とし、 <code>--table=messages</code> でテーブルを指定します。
        </p>
        <p class="text-sm">
            マイグレーション名に命名規則はありませんが、何を行なうかがわかるような名前にしましょう。今回は「messagesテーブルにtitleを追加」というマイグレーション名にしています。
            次のコマンドを実行してタイトルカラム追加用のマイグレーションファイルを生成してください。
        </p>

        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># マイグレーションファイルの生成</p>
            php artisan make:migration add_title_to_messages_table --table=messages
        </div>

        <p class="text-xs italic text-gray-500">実行結果</p>
        <div class="flex justify-start py-2">
            <img src="/images/Lesson16-63.png" alt="Migration file creation" class="max-w-md border rounded shadow-sm">
        </div>

        <div class="bg-yellow-50 p-4 rounded border border-yellow-200 text-sm">
            <p>生成されたマイグレーションは、 <code>up()</code> の中身も <code>down()</code> の中身もコードが書かれていないので、コーディングする必要があります。</p>
            <p class="mt-2"><code>$table->string('title');</code> と書けばカラムを追加でき、 <code>$table->dropColumn('title');</code> と書けばカラムを削除できます。そのため、それぞれを <code>up()</code> と <code>down()</code> 内に入れます。</p>
        </div>

        <p class="text-xs font-bold text-gray-500">database/migrations/年月日時_add_title_to_messages_table.phpのupとdown抜粋</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs overflow-x-auto shadow-inner">
<pre>
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('title');
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }</pre>
        </div>

        <p class="text-sm">このマイグレーションを実行する前に、現在の実行状況を確認してみましょう。</p>
        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># 現在の実行状況確認</p>
            php artisan migrate:status
        </div>

        <p class="text-sm">以前の4つのマイグレーションは実行済みであり、このマイグレーションはまだ実行されていないことがわかります。</p>

        <p class="text-xs italic text-gray-500">実行結果</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-[11px] text-gray-600 border border-gray-300">
<pre>
$ php artisan migrate:status

  Migration name ............................................................................................. Batch / Status  
  2014_10_12_000000_create_users_table .............................................................................. [1] Ran  
  2014_10_12_100000_create_password_resets_table .................................................................... [1] Ran  
  2019_08_19_000000_create_failed_jobs_table ........................................................................ [1] Ran  
  2019_12_14_000001_create_personal_access_tokens_table ............................................................. [1] Ran  
  2022_08_21_185456_create_messages_table ........................................................................... [1] Ran  
  2022_08_21_213014_add_title_to_messages_table ..................................................................... Pending</pre>
        </div>
        <img src="/images/Lesson16-64.png" alt="Migration status Pending" class="max-w-xs mt-2">

        <p class="text-sm mt-8">では、このマイグレーションファイルを実行しましょう。 <code>php artisan migrate</code> コマンドは、実行されていないマイグレーションファイルだけを実行します。</p>
        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># マイグレーションファイルの実行</p>
            php artisan migrate
        </div>
        
        <p class="text-xs italic text-gray-500">実行結果</p>
        <img src="/images/Lesson16-65.png" alt="Migration success" class="max-w-md border rounded shadow-sm">

        <p class="text-sm mt-8">再び実行状況を確認すると、このマイグレーションも実行されたことを確認できます。</p>
        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># 再度、実行状況を確認</p>
            php artisan migrate:status
        </div>

        <p class="text-xs italic text-gray-500">実行結果</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-[11px] text-gray-600 border border-gray-300">
<pre>
ubuntu:~/environment/message-board $ php artisan migrate:status

  Migration name ............................................................................................. Batch / Status  
  2014_10_12_000000_create_users_table .............................................................................. [1] Ran  
  2014_10_12_100000_create_password_resets_table .................................................................... [1] Ran  
  2019_08_19_000000_create_failed_jobs_table ........................................................................ [1] Ran  
  2019_12_14_000001_create_personal_access_tokens_table ............................................................. [1] Ran  
  2022_08_21_185456_create_messages_table ........................................................................... [1] Ran  
  2022_08_21_213014_add_title_to_messages_table ..................................................................... [2] Ran</pre>
        </div>
        <img src="/images/Lesson16-66.png" alt="Migration status Ran" class="max-w-xs mt-2">

        <p class="text-sm mt-4">これでmessagesテーブルにtitleカラムが追加され、 <strong>Messageモデルでもtitleプロパティを使用できる</strong>ようになります。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">カラムが増えたことによって発生する作業</h3>
        <p class="text-sm">では、カラムが増えたことによって発生する作業を、いつも通りModel, Router, Controller, Viewの順番で見ていきます。</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-4 border rounded-lg bg-gray-50">
                <h4 class="font-bold border-b mb-2 text-blue-700">Model</h4>
                <p class="text-xs">変更が必要そうな箇所はありません。</p>
            </div>
            <div class="p-4 border rounded-lg bg-gray-50">
                <h4 class="font-bold border-b mb-2 text-blue-700">Router</h4>
                <p class="text-xs">ルーティングはModelに対して <code>resource</code> 1つであるため、カラムが増えたことによる変更箇所は無さそうです。</p>
            </div>
        </div>

        <h4 class="font-bold text-gray-800 mt-8">Controller</h4>
        <p class="text-sm">ここでは、 <code>MessagesController.php</code> を修正します。</p>
        <p class="text-sm">7つのアクションをざっと眺めると、content カラムを使用しているのがstoreとupdateだけだと気付きます。この2つのアクションに対して <strong>title カラムを操作する処理を追加</strong>しましょう。</p>

        <p class="text-xs font-bold text-gray-500">app/Http/Controllers/MessagesController.phpのstoreアクション</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs">
<pre>
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',   // 追加
            'content' => 'required|max:255',
        ]);

        // メッセージを作成
        $message = new Message;
        $message->title = $request->title;    // 追加
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }</pre>
        </div>

        <p class="text-xs font-bold text-gray-500 mt-6">app/Http/Controllers/MessagesController.phpのupdateアクション</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs">
<pre>
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',   // 追加
            'content' => 'required|max:255',
        ]);

        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        // メッセージを更新
        $message->title = $request->title;    // 追加
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }</pre>
        </div>
        <p class="text-sm italic"><code>$request->title</code> は受信するリクエストに含まれる「タイトル」の値を取得しています。リクエストを送信するフォーム側も「タイトル」の値を含めるよう修正します。</p>

        <h4 class="font-bold text-gray-800 mt-10">View</h4>
        <p class="text-sm">フォームがあるのはcreateとeditです。どちらもフォーム内にtitleカラムを追加するのみです。</p>
        <p class="text-sm">ここでは次のファイルを修正します。</p>
        <ul class="list-disc pl-8 text-sm font-bold text-blue-600">
            <li>create.blade.php</li>
            <li>edit.blade.php</li>
            <li>index.blade.php</li>
            <li>show.blade.php</li>
        </ul>

        <div class="space-y-8">
            <div>
                <p class="text-xs font-bold text-gray-500">resources/views/messages/create.blade.php</p>
                <div class="bg-gray-900 text-green-400 p-5 rounded font-mono text-[11px] overflow-x-auto shadow-xl">
<pre>
@extends('layouts.app')

@section('content')

    &lt;div class="prose ml-4"&gt;
        &lt;h2&gt;メッセージ新規作成ページ&lt;/h2&gt;
    &lt;/div&gt;

    &lt;div class="flex justify-center"&gt;
        &lt;form method="POST" action="{{ route('messages.store') }}" class="w-1/2"&gt;
            @csrf

                &lt;div class="form-control my-4"&gt;
                    &lt;label for="title" class="label"&gt;
                        &lt;span class="label-text"&gt;タイトル:&lt;/span&gt;
                    &lt;/label&gt;
                    &lt;input type="text" name="title" class="input input-bordered w-full"&gt;
                &lt;/div&gt;

                &lt;div class="form-control my-4"&gt;
                    &lt;label for="content" class="label"&gt;
                        &lt;span class="label-text"&gt;メッセージ:&lt;/span&gt;
                    &lt;/label&gt;
                    &lt;input type="text" name="content" class="input input-bordered w-full"&gt;
                &lt;/div&gt;

            &lt;button type="submit" class="btn btn-primary btn-outline"&gt;投稿&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;
@endsection</pre>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-gray-500">resources/views/messages/edit.blade.php</p>
                <div class="bg-gray-900 text-green-400 p-5 rounded font-mono text-[11px] overflow-x-auto shadow-xl">
<pre>
@extends('layouts.app')

@section('content')

    &lt;div class="prose ml-4"&gt;
        &lt;h2&gt;id: {{ $message-&gt;id }} のメッセージ編集ページ&lt;/h2&gt;
    &lt;/div&gt;

    &lt;div class="flex justify-center"&gt;
        &lt;form method="POST" action="{{ route('messages.update', $message-&gt;id) }}" class="w-1/2"&gt;
            @csrf
            @method('PUT')

                &lt;div class="form-control my-4"&gt;
                    &lt;label for="title" class="label"&gt;
                        &lt;span class="label-text"&gt;タイトル:&lt;/span&gt;
                    &lt;/label&gt;
                    &lt;input type="text" name="title" value="{{ $message-&gt;title }}" class="input input-bordered w-full"&gt;
                &lt;/div&gt;

                &lt;div class="form-control my-4"&gt;
                    &lt;label for="content" class="label"&gt;
                        &lt;span class="label-text"&gt;メッセージ:&lt;/span&gt;
                    &lt;/label&gt;
                    &lt;input type="text" name="content" value="{{ $message-&gt;content }}" class="input input-bordered w-full"&gt;
                &lt;/div&gt;

            &lt;button type="submit" class="btn btn-primary btn-outline"&gt;更新&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;

@endsection</pre>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded text-sm italic text-gray-700 border-l-4 border-blue-400">
            Controller側はすでに修正しているため、上記を更新したあとに、一度動作確認してみましょう。<br>
            すると、 <strong>indexとshowのViewにもカラムの追加作業が必要なことに気付くでしょう</strong>。基本的に、カラムが変更されるとすべてのViewを修正する必要があります。
        </div>

        <div>
            <p class="text-xs font-bold text-gray-500">resources/views/messages/index.blade.php</p>
            <div class="bg-gray-900 text-green-400 p-5 rounded font-mono text-[11px] overflow-x-auto shadow-xl">
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
                    &lt;th&gt;タイトル&lt;/th&gt;
                    &lt;th&gt;メッセージ&lt;/th&gt;
                &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
                @foreach ($messages as $message)
                &lt;tr&gt;
                    &lt;td&gt;&lt;a class="link link-hover text-info" href="{{ route('messages.show', $message-&gt;id) }}"&gt;{{ $message-&gt;id }}&lt;/a&gt;&lt;/td&gt;
                    &lt;td&gt;{{ $message-&gt;title }}&lt;/td&gt;
                    &lt;td&gt;{{ $message-&gt;content }}&lt;/td&gt;
                &lt;/tr&gt;
                @endforeach
            &lt;/tbody&gt;
        &lt;/table&gt;
    @endif

    {{-- メッセージ作成ページへのリンク --}}
    &lt;a class="btn btn-primary" href="{{ route('messages.create') }}"&gt;新規メッセージの投稿&lt;/a&gt;

@endsection</pre>
            </div>
        </div>

        <div>
            <p class="text-xs font-bold text-gray-500">resources/views/messages/show.blade.php</p>
            <div class="bg-gray-900 text-green-400 p-5 rounded font-mono text-[11px] overflow-x-auto shadow-xl">
<pre>
@extends('layouts.app')

@section('content')

    &lt;div class="prose ml-4"&gt;
        &lt;h2&gt;id = {{ $message-&gt;id }} のメッセージ詳細ページ&lt;/h2&gt;
    &lt;/div&gt;

    &lt;table class="table w-full my-4"&gt;
        &lt;tr&gt;
            &lt;th&gt;id&lt;/th&gt;
            &lt;td&gt;{{ $message-&gt;id }}&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
            &lt;th&gt;タイトル&lt;/th&gt;
            &lt;td&gt;{{ $message-&gt;title }}&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
            &lt;th&gt;メッセージ&lt;/th&gt;
            &lt;td&gt;{{ $message-&gt;content }}&lt;/td&gt;
        &lt;/tr&gt;
    &lt;/table&gt;

    {{-- メッセージ編集ページへのリンク --}}
    &lt;a class="btn btn-outline" href="{{ route('messages.edit', $message-&gt;id) }}"&gt;このメッセージを編集&lt;/a&gt;

    {{-- メッセージ削除フォーム --}}
    &lt;form method="POST" action="{{ route('messages.destroy', $message-&gt;id) }}" class="my-2"&gt;
        @csrf
        @method('DELETE')
        
        &lt;button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('id = {{ $message-&gt;id }} のメッセージを削除します。よろしいですか？')"&gt;削除&lt;/button&gt;
    &lt;/form&gt;

@endsection</pre>
            </div>
        </div>
    </section>

    <section class="mt-20 pt-10 border-t border-gray-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4">GitHubへプッシュしましょう</h2>
        
        <div class="bg-gray-900 text-green-400 p-5 rounded-lg font-mono text-sm shadow-lg">
            git add -A<br>
            git commit -m "add column"<br>
            git push origin main
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}