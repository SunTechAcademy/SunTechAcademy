<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_14Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得
        $lesson = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：基礎')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 14,
            ],
            [
                'title' => 'エラー画面とデバッグ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">エラー画面とデバッグ</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                ここでは補足として、Laravelのエラー画面とデバッグ方法について解説します。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Laravelのエラー画面</h3>
        <p class="text-sm">
            これまでLaravelのアプリケーションを作ってきて、さまざまなエラー画面に遭遇したかもしれません。
            エラー画面を読み解くことはLaravelプログラミングの上達に欠かせません。ここで解説していきましょう。
        </p>

        <h4 class="text-lg font-bold text-gray-800">エラー画面に含まれる情報</h4>
        <p class="text-sm">
            以下の画像は、Laravelのエラー画面に注釈を加えたものです。エラー画面にはコードを修正するのに必要なさまざまな情報が含まれています。
        </p>

        <div class="my-6">
            <img src="/images/Lesson16-71.png" alt="Laravel Error Screen Annotation" class="max-w-full h-auto border rounded shadow-lg">
        </div>

        <p class="text-sm font-bold mb-2">エラー画面に含まれる情報は以下の通りです。</p>
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-left border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2 w-16">番号</th>
                        <th class="border border-gray-300 p-2 w-48">名称</th>
                        <th class="border border-gray-300 p-2">含まれる情報</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 p-2 text-center">1</td>
                        <td class="border border-gray-300 p-2 font-bold italic">エラータイトル</td>
                        <td class="border border-gray-300 p-2 text-xs">エラーの概要です。Laravelから出力された例外クラス（この場合BadMethodCallException）の名前です。</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-2 text-center">2</td>
                        <td class="border border-gray-300 p-2 font-bold italic">エラー詳細</td>
                        <td class="border border-gray-300 p-2 text-xs">例外クラスに含まれる、エラーメッセージが出力されます。最初はエラータイトルとここを読みましょう。</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-2 text-center">3</td>
                        <td class="border border-gray-300 p-2 font-bold italic">エラーが起きたファイル名</td>
                        <td class="border border-gray-300 p-2 text-xs">エラーが起きたファイルのパスが書いてあります。</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-2 text-center">4</td>
                        <td class="border border-gray-300 p-2 font-bold italic">エラーが起きた行</td>
                        <td class="border border-gray-300 p-2 text-xs">エラーが起きた行を強調表示しています。また、周辺の行も表示されています。</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-2 text-center">5</td>
                        <td class="border border-gray-300 p-2 font-bold italic">トレース表示</td>
                        <td class="border border-gray-300 p-2 text-xs">エラーが起きたメソッドの呼び出し状況を出力します。上級者向けですが、メソッドがどこから呼び出されたか特定するのに使えます。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">エラーの修正手順</h3>
        <p class="text-sm">
            ここでは、エラー画面を元に、エラー内容を理解して修正に入るまでどのように進めるべきか解説します。
        </p>

        <div class="space-y-8">
            <div>
                <h4 class="font-bold text-blue-700">1. エラーの概要を理解する</h4>
                <p class="text-sm mb-4">
                    まず、エラータイトルとエラー詳細を読んで、エラーの概要を理解します。エラーメッセージはすべて英語であるため、ネットで翻訳・検索してかまいません。よく出るエラーメッセージとして、以下があります。
                </p>
                
                <div class="space-y-4">
                    <div class="p-4 bg-gray-50 border-l-4 border-gray-400 rounded">
                        <p class="font-mono text-xs font-bold">Parse error: syntax error, unexpected …</p>
                        <p class="text-xs text-gray-600 mt-1">プログラムの文法エラーです。カッコのとじ忘れ、カンマ忘れ、セミコロンがない場合などさまざまな場合に発生します。正しい文法になるように修正してください。</p>
                    </div>
                    <div class="p-4 bg-gray-50 border-l-4 border-gray-400 rounded">
                        <p class="font-mono text-xs font-bold">Call to undefined method …</p>
                        <p class="text-xs text-gray-600 mt-1">指定された名前の関数が存在しないというエラーです。関数が定義されていないか、関数名が間違っていることが考えられます。</p>
                    </div>
                    <div class="p-4 bg-gray-50 border-l-4 border-gray-400 rounded">
                        <p class="font-mono text-xs font-bold">Trying to get property ‘id’ of non-object …</p>
                        <p class="text-xs text-gray-600 mt-1">非オブジェクトのプロパティを取得しようとしているというエラーです。たとえば、 <code>$message->id</code> のようなコードで発生している場合は <code>$message</code> 変数の値が null になっていると考えられます。原因として多いのは、想定外のケースでそのコードが実行されている、 <code>$message</code> 変数に値を代入しているところに問題があるなどです。</p>
                    </div>
                    <div class="p-4 bg-gray-50 border-l-4 border-gray-400 rounded">
                        <p class="font-mono text-xs font-bold">View [○○] not found.</p>
                        <p class="text-xs text-gray-600 mt-1">○○で示されるビューが存在しないというエラーです。bladeのファイルが存在しているか、およびファイルのパスが間違っていないか確認してください。</p>
                    </div>
                    <div class="p-4 bg-gray-50 border-l-4 border-gray-400 rounded">
                        <p class="font-mono text-xs font-bold">Route [○○] not defined.</p>
                        <p class="text-xs text-gray-600 mt-1">○○というルートが定義されていないというエラーです。その名前のルートが定義されているか、あるいは、エラー発生箇所で指定しているそのルート名が間違っていないか確認してください。</p>
                    </div>
                    <div class="p-4 bg-gray-50 border-l-4 border-gray-400 rounded">
                        <p class="font-mono text-xs font-bold">Undefined variable: foo</p>
                        <p class="text-xs text-gray-600 mt-1">fooという変数が定義されていません、という意味のエラーです。fooの定義を宣言する文を追加しましょう。</p>
                    </div>
                </div>
                <p class="text-xs italic text-gray-500 mt-4">その他にもさまざまなエラーメッセージがあるため、わからない部分は調べたり、メンターに質問したりして内容を理解しましょう。</p>
            </div>

            <div>
                <h4 class="font-bold text-blue-700">2. エラーが起きた部分を特定する</h4>
                <p class="text-sm">
                    エラーが起きた行を参考に、ソースコード上のどの行でエラーが出たかを特定します。また、行の中で実際にエラーが起きたメソッド呼び出しを3のエラー詳細を元に特定します。
                </p>
                <p class="text-sm mt-2">
                    その行にとくに問題がなさそうな場合は、その行より前に実行した部分をトレース表示や実際のソースコードを参考にしながら探します。
                </p>
            </div>

            <div>
                <h4 class="font-bold text-blue-700">3. ソースコードを修正する。</h4>
                <p class="text-sm">実際にエラーを起こす元となった部分を修正します。</p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Laravelのデバッグ関数</h3>
        <p class="text-sm leading-relaxed">
            上記のような手順を踏んでエラー修正を行いますが、エラーの原因はさまざまで、とくにプログラミングを始めたばかりだと、修正するのは難しく感じるかもしれません。
        </p>
        <p class="text-sm">
            プログラミング言語では、デバッガと呼ばれる、バグ（プログラミングのミス）を修正するための支援ツールが用意されています。PHPの場合、 <code>var_dump()</code> がその1つです。Laravelでは標準で <strong><code>dd()</code></strong> というデバッグ用の関数が用意されています。
        </p>

        <h4 class="font-bold text-gray-800">dd()の使い方</h4>
        <p class="text-sm leading-relaxed">
            <code>dd()</code> を使うことで、ソースコードの途中でLaravelアプリケーションの処理を止め、そのタイミングにおける特定の変数の内容を確認できます。実行を止めたい部分に <strong><code>dd(中身を確認したい変数）</code></strong> という一行を追加すればOKです。
        </p>
        <p class="text-sm">
            たとえば、メッセージボードの MessagesController のupdateメソッドで引数の <code>$request</code> を確認したい場合は、以下のようにします。
        </p>

        <p class="text-xs font-bold text-gray-500 italic">サンプルコード</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-[11px] overflow-x-auto shadow-inner">
<pre>
    public function update(Request $request, $id)
    {
        <span class="text-yellow-400">dd($request);   // 追加</span>

        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:255',
        ]);
        // (以下略)
    }</pre>
        </div>

        <p class="text-sm">
            Laravelを起動していない場合は <code>php artisan serve --host=$IP --port=$PORT</code> で起動しましょう。適当なメッセージを選択して内容を更新します。
            すると、ページが遷移し、以下のような画面が表示されます。
        </p>

        <img src="/images/Lesson16-72.png" alt="dd($request) result" class="max-w-full h-auto border rounded shadow-md my-4">

        <p class="text-sm">
            <strong>▶</strong> となっているところをクリックすると、折りたたまれていた詳細情報が表示されます（ <strong>▼</strong> のクリックで再度折りたためます）。フォームから送信した情報は <strong>+request → #parameters</strong> で確認できます。
        </p>

        <img src="/images/Lesson16-73.png" alt="dd detailed view" class="max-w-full h-auto border rounded shadow-md my-4">

        <p class="text-sm mt-10">
            <code>dd()</code> の位置を変更し、以下の場所に <code>dd($message);</code> と記述してみます。再度更新ページを開いてフォームを送信した際に、 <code>$message</code> の内容が確認できます。
        </p>

        <p class="text-xs font-bold text-gray-500 italic">サンプルコード</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-[11px] overflow-x-auto shadow-inner">
<pre>
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:255',
        ]);

        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        // メッセージを更新
        $message->title = $request->title;
        $message->content = $request->content;

        <span class="text-yellow-400">dd($message);   // 追加</span>

        $message->save();
        // (以下略)
    }</pre>
        </div>

        <img src="/images/Lesson16-74.png" alt="dd($message) result" class="max-w-full h-auto border rounded shadow-md my-4">

        <p class="text-sm">
            このようにして、少しずつコードやデータを確認しながら「どこまでは正常に動作しているか（どこでエラーが発生しているか）」を調査できます。
        </p>
    </section>

    <section class="mt-20 pt-10 border-t border-gray-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4">GitHubへプッシュしましょう</h2>
        
        <div class="bg-gray-900 text-green-400 p-5 rounded-lg font-mono text-sm shadow-lg">
            git add -A<br>
            git commit -m "Perfect Push"<br>
            git push origin main
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}