<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_7Seeder extends Seeder
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
                'sort_order' => 7,
            ],
            [
                'title' => 'Routerの構築',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">Routerの構築</h2>
        <div class="prose max-w-none space-y-4">
            <p>
                開発するとき、まずはどんな機能を作るかを考えます。実装すべき機能を列挙できたら、そのためのルーティング（Router）を決めます。ルーティングが決まるとControllerの関数が決まり、 Controllerの関数が決まるとViewの名前が決まります。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">リソースに対するCRUDのための4つのルーティング</h3>
        <p class="text-sm leading-relaxed">
            Webアプリケーションは、ユーザがHTTPリクエストの4つのCRUDメソッド（POST, GET, PUT, DELETE）を使って、Web上のリソースを操作できるアプリケーションであると説明しました。ここでは各CRUDメソッドに対応したルーティングを見ていきます。
        </p>
        
        <p class="text-sm">リソース1つのCRUDに対応するHTTPリクエストのメソッドは下記の4つでした。</p>
        <ul class="list-disc pl-6 text-sm space-y-1">
            <li><strong>GET</strong> (Read)</li>
            <li><strong>POST</strong> (Create)</li>
            <li><strong>PUT</strong> (Update)</li>
            <li><strong>DELETE</strong> (Delete)</li>
        </ul>

        <p class="text-sm">これに対応するルーティングを <code>routes/web.php</code> に書いてみます。</p>
        <div class="bg-gray-800 rounded-lg p-5 font-mono text-xs text-gray-300 overflow-x-auto">
            <p class="text-gray-500 mb-2">// routes/web.php（コメント部分は省略）</p>
            <pre>
use App\Http\Controllers\MessagesController;

(省略)
Route::get('messages/{id}', [MessagesController::class, 'show']);
Route::post('messages', [MessagesController::class, 'store']);
Route::put('messages/{id}', [MessagesController::class, 'update']);
Route::delete('messages/{id}', [MessagesController::class, 'destroy']);</pre>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">コントローラーの指定</h4>
            <p class="text-sm leading-relaxed">
                <code>use App\Http\Controllers\MessagesController;</code> で、 <code>App/Http/Controllers/</code> フォルダ にある <code>MessagesController.php</code> を利用できるようにしています。<br>
                <code>[MessagesController::class, 'show']</code> のように <strong>[Controller名::class, 'アクション名']</strong> という形で表記されています。
            </p>
            <p class="text-sm"><code>post</code> や <code>put</code> や <code>delete</code> はページというより操作の名前です。<code>{id}</code> についても知っておきましょう。</p>
            
            <div class="bg-blue-50 p-6 rounded-xl text-sm space-y-3">
                <p>
                    <code>get</code>, <code>put</code>, <code>delete</code> はどのレコードを操作するのか明確にする必要があるため、 URLに <strong>id</strong> が入ることになります。
                </p>
                <p>
                    たとえば、 <code>/messages/1</code> というURLに対して <code>get</code> のリクエストを送ると、 <strong>id: 1</strong> のMessageを表示します。
                </p>
                <p>
                    <code>get</code> 以外の <code>put</code> や <code>delete</code> でも同様に <code>/messages/1</code> などのURLに対してリクエストに応じた操作が実行されます。
                </p>
                <p>
                    <code>post</code> の場合は新規作成のメソッドとなることから、 id は不要です。そのため、 <code>/messages</code> に <code>post</code> のリクエストを送ると、新たに id が採番されMessageが作成されます。
                </p>
            </div>
            
            <p class="text-sm leading-relaxed">
                このアクション名には任意のアクションを設定できますが、 Laravelが <code>show</code>, <code>store</code>, <code>update</code>, <code>destroy</code> という命名を基本としているため、それに従うのがベターです。また、次のセクションで学びますが、 <code>index</code>, <code>create</code>, <code>edit</code> も同様で、Laravelが決めている基本の命名です。
            </p>
        </div>

        <div class="mt-8">
            <p class="text-sm font-bold mb-3">（参考資料）リソースアクション例</p>
            
            <div class="overflow-x-auto shadow rounded-lg border">
                <table class="min-w-full divide-y divide-gray-200 text-xs text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 border">動詞</th>
                            <th class="px-4 py-3 border">URI</th>
                            <th class="px-4 py-3 border">アクション</th>
                            <th class="px-4 py-3 border">ルート名</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr><td class="px-4 py-2 border font-mono">GET</td><td class="px-4 py-2 border font-mono">/messages</td><td class="px-4 py-2 border">index</td><td class="px-4 py-2 border font-mono">messages.index</td></tr>
                        <tr><td class="px-4 py-2 border font-mono">GET</td><td class="px-4 py-2 border font-mono">/messages/create</td><td class="px-4 py-2 border">create</td><td class="px-4 py-2 border font-mono">messages.create</td></tr>
                        <tr><td class="px-4 py-2 border font-mono">POST</td><td class="px-4 py-2 border font-mono">/messages</td><td class="px-4 py-2 border">store</td><td class="px-4 py-2 border font-mono">messages.store</td></tr>
                        <tr><td class="px-4 py-2 border font-mono">GET</td><td class="px-4 py-2 border font-mono">/messages/{id}</td><td class="px-4 py-2 border">show</td><td class="px-4 py-2 border font-mono">messages.show</td></tr>
                        <tr><td class="px-4 py-2 border font-mono">GET</td><td class="px-4 py-2 border font-mono">/messages/{id}/edit</td><td class="px-4 py-2 border">edit</td><td class="px-4 py-2 border font-mono">messages.edit</td></tr>
                        <tr><td class="px-4 py-2 border font-mono">PUT/PATCH</td><td class="px-4 py-2 border font-mono">/messages/{id}</td><td class="px-4 py-2 border">update</td><td class="px-4 py-2 border font-mono">messages.update</td></tr>
                        <tr><td class="px-4 py-2 border font-mono">DELETE</td><td class="px-4 py-2 border font-mono">/messages/{id}</td><td class="px-4 py-2 border">destroy</td><td class="px-4 py-2 border font-mono">messages.destroy</td></tr>
                    </tbody>
                </table>
            </div>
            <p class="text-[10px] text-blue-600 mt-2">
                <a href="https://readouble.com/laravel/8.x/ja/controllers.html" target="_blank">リソースコントローラにより処理されるアクション（公式ドキュメント）</a>
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">CRUDのための残り3つの補助ページ</h3>
        <p class="text-sm leading-relaxed">
            ルーティングは4つのみではありません。あと3つのルーティング（<strong>index, create, edit</strong>）について見ていきます。<br>
            ユーザがどうやってHTTPリクエストを出すのか考えてみてください。直接HTTPリクエストを送信するのではなく、ユーザはWebブラウザ上に表示されたWebページ上でリソースのCRUD操作を行ないます。そのため、操作のためのWebページも用意する必要があります。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 underline decoration-blue-200">詳細ページ（show）にアクセスするには、一覧ページ（index）が必要</h4>
            <p class="text-xs text-gray-500 italic">routes/web.php（既存部分の抜粋：追記不要）</p>
            <div class="bg-gray-100 p-3 rounded font-mono text-xs">
                Route::get('messages/{id}', [MessagesController::class, 'show']);
            </div>
            <p class="text-sm">
                これが詳細ページ（show）のルーティングでした。しかし、まずリソースの一覧ページがないと個別のリソースページである詳細ページへ（直接URLを入力するしか）辿り着けません。<br>
                そのため、一覧ページ（index）をつけ加えることになります。既存部分にもコメントをつけたため、以下の内容で <strong>routes/web.php を上書きしてください。</strong>
            </p>
            <div class="bg-gray-800 rounded-lg p-5 font-mono text-xs text-white overflow-x-auto">
                <p class="text-gray-500 mb-2">// routes/web.php</p>
                <pre>
&lt;?php
use Illuminate\Support\Facades\Route;

// デフォルトのコメント部分は省略
Route::get('/', function () {
    return view('welcome');
});

// CRUD
// メッセージの個別詳細ページ表示
Route::get('messages/{id}', [MessagesController::class, 'show']);

// メッセージの新規登録を処理（新規登録画面を表示するためのものではありません）
Route::post('messages', [MessagesController::class, 'store']);

// メッセージの更新処理（編集画面を表示するためのものではありません）
Route::put('messages/{id}', [MessagesController::class, 'update']);

// メッセージを削除
Route::delete('messages/{id}', [MessagesController::class, 'destroy']);

// index: showの補助ページ
Route::get('/', [MessagesController::class, 'index']);</pre>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 underline decoration-green-200">保存アクション（store）にデータを送るには、新規作成用のフォームページ（create）が必要</h4>
            <p class="text-xs text-gray-500 italic">routes/web.php（既存部分の抜粋：追記不要）</p>
            <div class="bg-gray-100 p-3 rounded font-mono text-xs">
                Route::post('messages', [MessagesController::class, 'store']);
            </div>
            <p class="text-sm">
                これが保存アクション（store）でした。このアクションを起こすときには必ず何らかのデータを渡す必要があります。そのために使われるのが入力フォームです。<br>
                そのため、新規作成用のフォームページ（create）をつけ加えることになります。<strong>create のルーティング設定を routes/web.php に追記してください。</strong>
            </p>
            <div class="bg-gray-800 rounded-lg p-5 font-mono text-xs text-white">
                <p class="text-gray-500 mb-2">// routes/web.php（抜粋）</p>
                <pre>
// CRUD
// （中略）
// index: showの補助ページ
Route::get('messages', [MessagesController::class, 'index']);

// create: 新規作成用のフォームページ
Route::get('messages/create', [MessagesController::class, 'create']);</pre>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800 underline decoration-yellow-200">更新アクション（update）にデータを送るには、更新用のフォームページ（edit）が必要</h4>
            <p class="text-xs text-gray-500 italic">routes/web.php（既存部分の抜粋：追記不要）</p>
            <div class="bg-gray-100 p-3 rounded font-mono text-xs">
                Route::put('messages/{id}', [MessagesController::class, 'update']);
            </div>
            <p class="text-sm">
                これが更新アクション（update）でした。このアクションを起こすときには必ず何らかのデータを渡す必要があります。そのために使われるのが入力フォームです。<br>
                そのため、更新用のフォームページ（edit）をつけ加えることになります。<strong>routes/web.php の index、create、edit のルーティング設定を以下の内容で上書きしてください。</strong>
            </p>
            <div class="bg-gray-800 rounded-lg p-5 font-mono text-xs text-white">
                <p class="text-gray-500 mb-2">// routes/web.php（抜粋）</p>
                <pre>
// CRUD
// （中略）
// index: showの補助ページ
Route::get('messages', [MessagesController::class, 'index'])->name('message.index');

// create: 新規作成用のフォームページ
Route::get('messages/create', [MessagesController::class, 'create'])->name('message.create');

// edit: 更新用のフォームページ
Route::get('messages/{id}/edit', [MessagesController::class, 'edit'])->name('message.edit');</pre>
            </div>
            <p class="text-sm leading-relaxed">
                ルーティングの後ろに新規でつなげた <strong>name</strong> は「名前つきルート」というもので、特定のルートへのURLを生成したり、リダイレクトしたりする場合に便利なものです。
            </p>
        </div>

        <div class="bg-gray-50 p-4 rounded border">
            <h4 class="font-bold text-gray-800 text-sm mb-2">削除アクション（delete）を起こすには、ボタンがあれば大丈夫</h4>
            <p class="text-xs text-gray-600">
                削除アクションは、フォームのデータが不要であるため、index, show, editページのどこかに削除ボタンが設置してあればそれで事足ります。そのため、削除のためのページは不要です。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">7つの基本ルーティングの省略形</h3>
        <p class="text-sm">
            ここまで、1つのリソース操作のためのルーティングを長々とコーディングしてきました。しかし、この7つのルーティングは基本のものなので、実はたった1行の記述で7つの基本ルーティングが用意できる省略形もあります。
        </p>
        
        <div class="bg-red-50 p-4 border border-red-200 rounded text-red-800 font-bold text-sm text-center">
            ⚠️ まだ追記しないでください
        </div>

        <div class="bg-gray-800 rounded-lg p-5 font-mono text-sm text-gray-300 overflow-x-auto">
            <p class="text-gray-500 mb-2">// 省略形の記述例</p>
            use App\Http\Controllers\MessagesController;<br>
            (省略)<br>
            Route::resource('messages', MessagesController::class);
        </div>

        <p class="text-sm leading-relaxed">
            たったこれだけで、先ほど書いたルーティングとまったく同じ意味になります。メッセージボードは省略形の <code>Route::resource('messages', MessagesController::class);</code> を使って実現させましょう。
        </p>

        <div class="p-4 bg-gray-50 rounded text-xs text-gray-600 italic border-l-4">
            今回、省略形ではないルートも説明した理由は、基本ルーティング以外にもたとえば複写機能をルート追加したい場合に、新たなルートを作成できることを理解して欲しかったためです。
            <div class="bg-white p-2 mt-2 border rounded font-mono">
                Route::resource('messages', MessagesController::class);<br>
                // 複写機能（ボタン）<br>
                Route::get('messages/{id}/copy', [MessagesController::class, 'copy']);
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Routerの完成</h3>
        <p class="text-sm">最後に、デフォルトで表示されていた下記のルーティングを書き換えます。</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-xs text-gray-500">
            Route::get('/', function () {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;return view('welcome');<br>
            });
        </div>
        <p class="text-sm">
            この設定を、トップページ <code>/</code> をMessagesControllerのindexアクションに設定するように書き換えます。
        </p>
        
        <div class="bg-red-50 p-4 border border-red-200 rounded text-red-800 font-bold text-sm text-center">
            ⚠️ まだ追記しないでください
        </div>
        <div class="bg-gray-800 p-4 rounded font-mono text-sm text-white">
            Route::get('/', [MessagesController::class, 'index']);
        </div>

        <h4 class="font-bold text-gray-800 mt-8 underline">routes/web.php完成版</h4>
        <p class="text-sm">最終的に <code>routes/web.php</code> は下記の通りになります。<strong>この内容で routes/web.php を上書きしてください。</strong></p>
        
        <div class="bg-gray-900 rounded-lg p-6 font-mono text-xs text-green-400 overflow-x-auto shadow-inner">
<pre>
&lt;?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [MessagesController::class, 'index']);

Route::resource('messages', MessagesController::class);</pre>
        </div>

        <div class="bg-yellow-50 p-6 rounded-xl border-l-4 border-yellow-400 mt-6">
            <h5 class="font-bold text-yellow-800 mb-2">（補足）</h5>
            <p class="text-xs text-yellow-700 leading-relaxed">
                ただし、この段階でプレビューしても、 <strong>Target class [MessagesController] does not exist</strong> というエラーになります。<br>
                理由は、MessagesControllerを作成していないためです。次のチャプターでMessagesControllerの作成を開始するので、プレビューせずに学習を続けてみてください。
            </p>
            <div class="flex justify-center mt-4">
                <img src="/images/Lesson16-44.png" alt="エラー画面のプレビュー" class="max-w-md w-full border border-yellow-200 rounded shadow-sm">
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}