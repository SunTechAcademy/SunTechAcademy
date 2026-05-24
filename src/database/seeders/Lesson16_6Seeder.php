<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 16 (Laravelを用いたWebアプリケーション開発：基礎) を取得
        $lesson16 = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：基礎')->first();

        if (!$lesson16) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson16->id,
                'sort_order' => 6,
            ],
            [
                'title' => 'RouterとControllerとViewの開発の概要',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">RouterとControllerとViewの開発の概要</h2>
        <div class="prose max-w-none space-y-4 leading-relaxed">
            <p>
                ModelはWebアプリケーションにとって、もっとも大事なリソースです。そのため、Webアプリケーションとしての機能の中でも比較的独立しています。 tinkerで動作確認するのもほとんどがModelの動作確認です。
            </p>
            <p>
                他の要素であるRouterとController、Viewは、各々の関係性が強いと言えます。そのためModelのように独立して学ぶのではなく、関連を確認しながら学びましょう。
            </p>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">RouterとControllerとViewの関係</h3>
        <p class="text-sm">ユーザのリクエストからレスポンスまでの流れは下記のようになっていました。</p>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-40.png" alt="リクエストからレスポンスの流れ" class="max-w-2xl w-full border rounded shadow-sm">
        </div>

        <p class="text-sm mt-8">ここで、Modelは他よりも独立した存在なので、 RouterとController、Viewの関係を見ていきます。</p>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-41.png" alt="Router/Controller/Viewの関係図" class="max-w-2xl w-full border rounded shadow-sm">
        </div>
        
        <div class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-400 text-sm italic">
            この図はRouterに書かれた1つのルーティングがControllerの1つの関数（アクション）に対応し、Controllerの1つの関数（アクション）が1つのViewファイルに対応するということを表現しています。
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
                <h4 class="font-bold text-blue-600 mb-2">Router</h4>
                <p class="text-xs leading-relaxed">
                    URLのルーティングを一元管理している機能です。 <code>routes/web.php</code> を見れば、Webアプリケーションのすべての機能リストを把握できます。
                </p>
            </div>
            <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
                <h4 class="font-bold text-blue-600 mb-2">Controller</h4>
                <p class="text-xs leading-relaxed">
                    HTTPリクエストの処理を担当します。割り当てられた関数のことを<strong>アクション</strong>と呼び、Modelの取得や保存を行います。
                </p>
            </div>
            <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
                <h4 class="font-bold text-blue-600 mb-2">View</h4>
                <p class="text-xs leading-relaxed">
                    処理結果として返すWebページです。ユーザに結果を示すためのもので、適切なModelの情報が埋め込まれます。
                </p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-42.png" alt="静的なWebページの流れ" class="max-w-2xl w-full border rounded shadow-sm">
        </div>
        <h4 class="font-bold text-gray-800 border-l-4 border-gray-400 pl-3">静的なWebページの場合の流れ</h4>
        
        <div class="bg-gray-800 rounded-lg p-5 font-mono text-sm text-gray-300">
            <p class="text-gray-500 mb-2">// routes/web.php抜粋</p>
            Route::get('/', function () {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;return view('welcome');<br>
            });
        </div>
        
        <div class="prose max-w-none text-sm text-gray-700 space-y-2">
            <p>・ <code>'/'</code> がトップページを意味しています。</p>
            <p>・ <code>welcome</code> は表示する view ファイルである、 <code>welcome.blade.php</code> を指定しています。</p>
            <p>つまり、トップページ <code>/</code> にアクセスしたら、 <code>welcome.blade.php</code> を表示するという処理の流れになります。</p>
        </div>

        <div class="mt-6">
            <p class="text-xs font-bold mb-2 italic">シーケンス図での表現：</p>
            <div class="flex justify-center py-4">
                <img src="/images/Lesson16-43.png" alt="ルーティングのシーケンス図" class="max-w-xl w-full border rounded shadow-sm">
            </div>
        </div>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded text-xs text-gray-700 leading-relaxed">
            LaravelのRouterに対し、Controllerに代わってController的な仕事をさせることもできますが、推奨される方法ではありません。基本的にはControllerの仕事をRouterが行なうべきではありません。
            ただし、静的HTMLを返すだけのルーティングであれば、例外的に上記の方法も許されるでしょう。
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">RouterとControllerとViewの開発の流れ</h3>
        <p class="text-sm leading-relaxed">
            先ほど見たようにユーザからのHTTPリクエストは入り口であるRouterを経て、Controllerのアクションを通り、 アクションに対応した名前のViewをHTTPレスポンスとして返します。<br>
            開発する際にも、この一連の流れに沿って作業していくのが良いでしょう。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}