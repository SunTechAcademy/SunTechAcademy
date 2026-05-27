<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_9Seeder extends Seeder
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
                'sort_order' => 9,
            ],
            [
                'title' => 'バリデーション',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">バリデーション</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                <strong>バリデーション（Validation）</strong>とは、検証という意味です。
                ではLaravelで一体何を検証するのかというと、<strong>ユーザが入力したフォームデータを検証</strong>します。
            </p>
            <p>
                ユーザは得てして想定外の形式でデータを入力します。たとえば年齢の入力が必須のフォームで、漢字や全角数字で入力していたり、年齢を入力していない場合などです。
                ユーザが想定外の値を入力することは避けられないため、その入力に対して適切な処理（想定外のデータに対して修正を促すエラーメッセージを表示するなど）をする必要があります。
            </p>
            <p>
                また、セキュリティの脆弱性をついた攻撃などを行なう悪意を持ったユーザもいます。決められた範囲内でのデータしか受け取れないように制限を設けるのは、このような攻撃からアプリケーションを守るためでもあります。
                ここでは、先ほど作成したメッセージボードのフォームを扱うページで、バリデーションによる入力データの検証を行ない、適切なエラーメッセージを表示させます。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">create, store</h3>
        <h4 class="font-bold text-gray-800">バリデーション</h4>
        <p class="text-sm">
            MessagesControllerのstoreアクションは、メッセージの新規作成を行ないます。ここではメッセージのフォームデータが送信されてくるため、バリデーションを行なう必要があります。
        </p>

        <p class="text-xs font-bold text-gray-500">app/Http/Controllers/MessagesController.phpのstoreアクションの現状確認</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-xs text-gray-600">
<pre>
    public function store(Request $request)
    {
        // メッセージを作成
        $message = new Message;
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }</pre>
        </div>

        <div class="bg-yellow-50 p-4 rounded border border-yellow-200 text-sm space-y-3">
            <p>
                このままだと、PHP側はカラのメッセージを投稿してもそのままメッセージとして保存しようとします。データベース側ではcontentカラムにNOT NULL制約をかけているため、カラのメッセージを投稿しようとすると、制約に違反するためシステムエラーが発生します。システムエラーを防ぐためにも、バリデーションを行なう必要があります。
            </p>
            <p>メッセージ投稿に必要なバリデーション項目は以下の2項目です。これをコーディングしていきましょう。</p>
            <ul class="list-disc pl-6">
                <li><strong>content が空になっていないか</strong></li>
                <li><strong>content が255文字を超えていないか</strong>（content カラムは varchar(255) のデータ型なため）</li>
            </ul>
        </div>

        <p class="text-sm leading-relaxed">
            下記のコードのように、<code>$request->validate()</code> を使用してバリデーションを行います。 <code>$request</code> の <code>content</code> に対して、 <strong>required</strong>（カラでない）かつ <strong>max:255</strong>（255文字を超えていない）であることを検証しています。
        </p>

        <p class="text-xs font-bold text-gray-500">app/Http/Controllers/MessagesController.phpのstoreアクション</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs overflow-x-auto shadow-inner">
<pre>
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);

        // メッセージを作成
        $message = new Message;
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }</pre>
        </div>

        <div class="bg-blue-50 p-4 rounded text-sm text-gray-700 italic">
            この段階で動作確認をします。 <code>/messages/create</code> にアクセスし、 content をカラのまま「投稿」ボタンをクリックしてみましょう。すると、更新されたように見えるものの <code>/</code> にリダイレクトされず、 <code>/messages/create</code> に戻ってきます。 <code>/</code> を見てもカラのメッセージは保存されていません。
            しかし、ユーザからしてみると、何が起こっているのかわかりません。「入力エラーです」のような適切なエラーメッセージを表示する必要があります。
        </div>

        <h4 class="font-bold text-gray-800 mt-8">エラーメッセージの表示</h4>
        <p class="text-sm leading-relaxed">
            バリデーションエラーが発生した場合、自動的に元のページへリダイレクトされ、さらに <strong>$errors</strong> 変数にエラーメッセージが格納されます。
            処理の流れとしては、 <code>app.blade.php</code> の <code>@include('commons.error_messages')</code> でバリデーションエラーを表示します。
        </p>

        <p class="text-xs font-bold text-gray-500">resources/views/layouts/app.blade.php（抜粋）</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-xs">
<pre>
    &lt;body&gt;
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        &lt;div class="container mx-auto"&gt;
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        &lt;/div&gt;
    &lt;/body&gt;</pre>
        </div>

        <p class="text-sm mt-4">ここで利用されるのが、 <code>resources/views/commons/error_messages.blade.php</code> です。</p>
        <p class="text-xs font-bold text-gray-500">resources/views/commons/error_messages.blade.php</p>
        <div class="bg-gray-900 text-green-400 p-5 rounded-lg font-mono text-[11px] overflow-x-auto shadow-xl">
<pre>
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
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

        <p class="text-sm italic text-gray-500">エラーメッセージ表示処理の解説は、別のチャプターで行います。</p>
        <p class="text-sm">
            それでは、 <code>/messages/create</code> にアクセスし、動作確認をしてください。メッセージに未入力の状態で「投稿」ボタンをすると、 <strong>The content field is required.</strong> とエラーメッセージが表示されます。
        </p>

        <p class="text-xs italic text-gray-500">実行結果</p>
        <div class="flex justify-start py-4">
            <img src="/images/Lesson16-61.png" alt="バリデーションエラー表示" class="max-w-md border rounded shadow-sm">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">edit, update</h3>
        <p class="text-sm leading-relaxed">storeアクションと同様にupdateアクションもバリデーションしておきましょう。</p>
        
        <h4 class="font-bold text-gray-800">バリデーション</h4>
        <p class="text-xs font-bold text-gray-500">app/Http/Controllers/MessagesController.phpのupdateアクション</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs overflow-x-auto shadow-inner">
<pre>
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);

        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        // メッセージを更新
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }</pre>
        </div>

        <h4 class="font-bold text-gray-800 mt-8">エラーメッセージの表示</h4>
        <p class="text-sm">エラーメッセージは、 MessagesController.phpのstore アクション時同様、 <code>error_messages.blade.php</code> で表示されます。</p>

        <p class="text-xs font-bold text-gray-500 italic">resources/views/commons/error_messages.blade.php（抜粋、追記不要）</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-[11px] text-gray-500">
<pre>
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        &lt;div class="alert alert-error mb-4"&gt;
            {{-- 省略 --}}
            {{ $error }}
        &lt;/div&gt;
    @endforeach
@endif</pre>
        </div>
        <p class="text-sm italic text-gray-500">エラーメッセージ表示処理は、次のチャプターで解説します。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">エラーメッセージ表示処理解説</h3>
        <p class="text-sm">
            <code>resources/views/commons</code> フォルダの下に <code>error_messages.blade.php</code> ファイルを作成して、エラーメッセージを管理していました。
        </p>

        <h4 class="font-bold text-gray-800">エラーメッセージ表示処理の流れ</h4>
        
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 space-y-3 text-sm">
            <ol class="list-decimal pl-6 space-y-2">
                <li><code>create.blade.php</code> 利用時に、フォームがからの状態で登録しようとする。</li>
                <li><code>MessagesController.php</code> の <code>storeアクション</code> にある、 <code>$request->validate([...]);</code> により、エラーが発生する。</li>
                <li>発生したエラーは、 <strong>$errors</strong> に格納される。</li>
                <li><code>create.blade.php</code> は <code>app.blade.php</code> を継承しているので、 <code>app.blade.php</code> の <code>@include('commons.error_messages')</code> でエラー表示処理を行なう。</li>
                <li><code>app.blade.php</code> の <code>@include('commons.error_messages')</code> で <code>error_messages.blade.php</code> が読み込まれる。</li>
                <li><code>error_messages.blade.php</code> で <strong>$errors</strong> 変数の値が利用され、エラーメッセージ表示を行なう。</li>
            </ol>
            <p class="text-xs text-gray-500 mt-2">※@includeの復習用です。処理の流れを追う際の参考にして下さい。</p>
        </div>

        <p class="text-xs font-bold text-gray-500 mt-8">resources/views/layouts/app.blade.php（抜粋）</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-[11px]">
<pre>
    &lt;body&gt;
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        &lt;div class="container mx-auto"&gt;
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        &lt;/div&gt;
    &lt;/body&gt;</pre>
        </div>

        <p class="text-xs font-bold text-gray-500 mt-4">resources/views/commons/error_messages.blade.php</p>
        <div class="bg-gray-900 text-green-400 p-5 rounded font-mono text-[11px] overflow-x-auto">
<pre>
@if (count($errors) > 0)
        @foreach ($errors->all() as $error)
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

        <h4 class="font-bold text-gray-800 mt-10">プログラム解説</h4>
        <p class="text-sm">わかりやすいようにデザイン部分を省いたコードを見てみましょう。</p>
        <div class="p-3 bg-red-50 border border-red-200 rounded text-red-700 text-xs font-bold mb-4">
            ※解説用なのでerror_messages.blade.phpを修正しないようご注意下さい。
        </div>

        <p class="text-xs font-bold text-gray-500">resources/views/commons/error_messages.blade.php（修正不要）</p>
        <div class="bg-gray-100 p-5 rounded font-mono text-sm shadow-sm">
<pre>
@if (count($errors) > 0)
        @foreach ($errors->all() as $error)
                    {{ $error }}
        @endforeach
@endif</pre>
        </div>

        <div class="space-y-4 text-sm leading-relaxed mt-4">
            <p><strong>@if (count($errors) > 0)</strong> では、 <code>$errors</code> 変数に値が入っているか <strong>if文</strong> で条件分岐しています。</p>
            <p><strong>@foreach ($errors->all() as $error)</strong> では、<code>$errors</code> 変数の内容を1つ1つ取り出して、 <code>$error</code> 変数に代入後、 <strong>foreach文</strong> で繰り返し処理しています。</p>
            <p><strong>{{ $error }}</strong> では、 <code>$error</code> 変数の内容を表示しています。</p>
            <p><strong>@endforeach</strong> では、 <code>@foreach</code> を終了しています。</p>
            <p><strong>@endif</strong> では、 <code>@if (count($errors) > 0)</code> を終了しています。</p>
        </div>

        <h4 class="font-bold text-gray-800 mt-10">svgの利用</h4>
        <p class="text-sm">svgを利用して●の中に☓が表示されたエラーマークを利用しています。</p>
        <div class="flex justify-start py-2">
            <img src="/images/Lesson16-62.png" alt="SVGエラーアイコン例" class="max-w-[50px] border rounded shadow-sm">
        </div>
        <p class="text-sm">もし、次のコードを削除するとエラーマークが消えます。</p>

        <p class="text-xs font-bold text-gray-500 italic">サンプルコード</p>
        <div class="bg-gray-900 text-white p-4 rounded font-mono text-[10px] overflow-x-auto">
<pre>
&lt;svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"&gt;
    &lt;path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /&gt;
&lt;/svg&gt;</pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">（参考）バリデーション応用</h3>
        <p class="text-sm leading-relaxed">
            バリデーションはさまざまな実装方法があります。ここでは基本を押さえるだけに留まっており、発展的な内容には踏み込んでいません。さらにバリデーションについて深く理解したい場合は公式マニュアルを読んでください。バリデーションルール（require や max:255 など）も一覧で紹介されています。
        </p>
        <p class="text-xs text-blue-500 underline">
            <a href="https://readouble.com/laravel/9.x/ja/validation.html" target="_blank">参考: バリデーション - Laravel 9.x</a>
        </p>
    </section>

    <section class="mt-20 pt-10 border-t border-gray-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4">GitHubにプッシュしましょう</h2>
        <div class="bg-gray-900 text-green-400 p-5 rounded-lg font-mono text-sm shadow-lg">
            git add -A<br>
            git commit -m "validation"<br>
            git push origin main
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}