<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_12Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得（タイトルは既存の教材データに合わせて適宜調整してください）
        $lesson = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：基礎')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 12,
            ],
            [
                'title' => 'ページネーション',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">ページネーション</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                indexで表示するMessageが大量（たとえば1万件）にある場合、1ページで表示すると非常に縦長のページとなってしまいます。また、データベースから全レコードを取得して表示するのにも時間がかかるため、ページの表示も遅くなります。
            </p>
            <p>
                こういった場合に対応するには、<strong>ページネーション</strong>という技術を使うのが有効です。
            </p>
            <p>
                ページネーションは、レコードの取得の範囲を決めて、その範囲内のもののみを表示する機能です。たとえば、1ページに25件まで表示すると決めると、100件レコードがあれば4ページに分けられます。1ページ目には1から25までのレコードを表示し、2ページ目には26から50までのレコードを表示するといった形です。
            </p>

            <div class="my-8">
                <img src="/images/Lesson16-69.png" alt="Pagination conceptual diagram" class="max-w-full h-auto border rounded shadow-sm">
                <p class="text-xs text-gray-500 mt-2 italic">ページネーションの一例</p>
            </div>

            <p>これをindexで実現しましょう。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テストデータの用意</h3>
        <p class="text-sm">
            ここでは1ページに表示するメッセージを25件にしたいと思います。前のセクションの内容を参考に、<strong>最低でも26件はテストデータを登録してください。</strong>26件ないとページネーションが表示できません。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MessagesController@indexの修正</h3>
        
        <h4 class="font-bold text-gray-800">Controllerの修正</h4>
        <p class="text-sm">
            一覧を取得する際、今までは <code>all()</code> メソッドを使いましたが、 <strong><code>paginate()</code> メソッド</strong>へ変更します。paginate()メソッドの戻り値であるページネータ（ページネーションを行なうオブジェクト）が <code>$messages</code> 変数へ代入されます。
        </p>

        <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/MessagesController.php（indexのみ抜粋）</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs overflow-x-auto shadow-inner">
<pre>
    public function index()
    {
        // メッセージ一覧を取得
        <span class="text-green-400">$messages = Message::orderBy('id', 'desc')->paginate(25);</span>

        // メッセージ一覧ビューでそれを表示
        return view('messages.index', [
            'messages' => $messages,
        ]);
    }</pre>
        </div>

        <p class="text-sm">
            とりあえず、これだけでindexでの表示件数が25件のみになります。
        </p>

        <h4 class="font-bold text-gray-800 mt-8">Viewの修正</h4>
        <p class="text-sm">
            続いて、Viewを修正してページネーションのリンクを追加します。その方法は <strong><code>{{ $messages->links() }}</code></strong> を追記するだけです。
            ここでは、 <code>index.blade.php</code> を修正します。
        </p>

        <p class="text-xs font-bold text-gray-500 italic">resources/views/messages/index.blade.php（末尾の部分の抜粋）</p>
        <div class="bg-gray-900 text-green-400 p-5 rounded font-mono text-[11px] overflow-x-auto shadow-xl">
<pre>
    @endif

    <span class="text-yellow-400">{{-- ページネーションのリンク --}}
    {{ $messages->links() }}</span>

    {{-- メッセージ作成ページへのリンク --}}
    &lt;a class="btn btn-primary" href="{{ route('messages.create') }}"&gt;新規メッセージの投稿&lt;/a&gt;
@endsection</pre>
        </div>

        <div class="bg-blue-50 p-6 rounded border border-blue-100 text-sm leading-relaxed text-gray-700">
            <p>
                これだけでページネーションを利用したリンクが表示されます。
            </p>
            <p class="mt-2">
                ページネーションの「2」のリンクをクリックすると、URLに <code>?page=2</code> が付加されます。Laravelはこれを受け取って、そのページに対応するデータを、指定した件数（25件）表示します。1ページ目がid：1から25までなら、2ページ目はid：26から50までです。すべてLaravelが処理してくれるため、何か処理を追記する必要はありません。
            </p>
        </div>

        <p class="text-xs text-blue-500 underline">
            <a href="https://readouble.com/laravel/9.x/ja/pagination.html" target="_blank">参考：ページネーション（Laravel9.x）</a>
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">順番の変更</h3>
        <p class="text-sm">
            Message一覧表示の順番を変更したい場合には、 Controller側で <strong><code>orderBy()</code></strong> を記述します。
        </p>

        <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/MessagesController.php（indexのみ抜粋）</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs shadow-inner">
<pre>
    public function index()
    {
        // メッセージ一覧をidの降順で取得
        <span class="text-green-400">$messages = Message::orderBy('id', 'desc')->paginate(25);</span>

        // メッセージ一覧ビューでそれを表示
        return view('messages.index', [
            'messages' => $messages,
        ]);
    }</pre>
        </div>

        <p class="text-sm">
            上記のように記述すると、id のカラムを基準に <strong>desc（降順）</strong>でMessage一覧が表示されます。1ページ目がid：100から76まで、2ページ目がid：75から51までになっていることを確認してください。
        </p>
    </section>

</div>
EOF
            ]
        );
    }
}