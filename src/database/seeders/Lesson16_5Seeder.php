<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_5Seeder extends Seeder
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
                'sort_order' => 5,
            ],
            [
                'title' => 'Modelの構築',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">Modelの構築</h2>
        <div class="prose max-w-none space-y-4">
            <p>
                開発の流れで解説したとおり、リソース（操作対象）となるModelから作成します。
            </p>
            <p>
                Modelは表示するデータの元となるリソースです。つまり、永久保存されるデータであり、データベースと密接に関係しています。<strong>データベースのレコード1つが、Modelのインスタンス1つに対応しています。</strong>
            </p>
            <p>
                最初に、今から作成するWebアプリケーションは <strong>どんなデータを扱うのか</strong> を決めなければいけません。なんとなく開発を開始するのではなく、何のためのWebアプリケーションなのかを決め、そのためにどんなデータを扱う必要があるのか考えておく必要があります。<br>
                そして、どんなデータが扱うかが決まると、Modelを作成するための情報が揃ったということになります。開発はModelの作成からスタートさせましょう。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">メッセージのテーブル設計</h3>
        <p class="text-sm leading-relaxed">
            今までデータベースのテーブルを <code>CREATE TABLE ...</code> のようにSQLを書いて実行していましたが、 Laravelでは <strong>マイグレーションファイル</strong> というテーブル作成ファイルによって管理・実行できます。
        </p>
        
        <div class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-400">
            <h4 class="font-bold text-blue-900 mb-2">マイグレーションとは</h4>
            <p class="text-sm text-blue-800 leading-relaxed mb-4">
                通常、テーブルを新規作成するには、SQLコマンドをデータベースに直接実行します。カラムを追加する場合も同じです。<br>
                それに対してマイグレーション機能では、テーブルを新規に作成するためのマイグレーションファイルと呼ばれるファイルを作成します。マイグレーションを実行することで、マイグレーションファイルに書かれたテーブルの定義がMySQLなどのデータベースに間接的に反映されるのです。
            </p>
            <p class="text-sm text-blue-800 leading-relaxed">
                たとえば既存のテーブルに後からカラムを追加したい場合には、カラムを追加するためのマイグレーションファイルを新たに作成して実行することで、テーブルの定義を変更していくのです。<br>
                なぜ、このような面倒にも思えることを行なうのでしょうか。ですが、直接SQLコマンドを実行するからこそ発生しうる問題があるのです。
            </p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">マイグレーションのコマンド</h4>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-sm">
                $ php artisan migrate
            </div>
            
            <div class="bg-red-50 p-6 rounded-xl border border-red-200">
                <p class="font-bold text-red-800 mb-2 italic">※コマンド実行後にエラーが出る場合</p>
                <p class="text-xs text-red-700 leading-relaxed mb-4">
                    dbuserがmessage-board DB にアクセスできていない可能性があるので phpMyAdmin で設定を確認してみましょう。
                </p>
                <ol class="list-decimal pl-6 text-xs text-red-800 space-y-2">
                    <li><a href="http://localhost/phpmyadmin/" class="underline">http://localhost/phpmyadmin/</a> を開く</li>
                    <li>「ユーザーアカウント」から <strong>dbuser</strong> を押下 (2つある場合は2回同じ作業を行う)</li>
                    <li>「データベース」タブを押下</li>
                    <li>「message-board」を選択して実行</li>
                    <li>「すべてチェックする」を押下して実行してください。</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">マイグレーションファイルの作成</h3>
        <p class="text-sm leading-relaxed">
            マイグレーションファイルとは、Laravelからデータベースのテーブルを管理するためのファイルです。主に、テーブルの作成・削除、カラムの追加・削除に関することが記述されます。
        </p>
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-sm mb-4">
            $ php artisan make:migration create_messages_table --create=messages
        </div>
        <div class="flex flex-col items-center gap-2 py-4">
            <img src="/images/Lesson16-18.png" alt="マイグレーションファイル作成結果" class="max-w-2xl w-full border rounded shadow-sm">
        </div>
        <p class="text-sm leading-relaxed">
            <code>php artisan make:migration</code> までがコマンドです。 <code>create_messages_table</code> はファイル名で、何をするファイルか分かる名前にします。最後の <code>--create=messages</code> によって作成するテーブル名を決定しています。
        </p>
        <div class="p-4 bg-gray-50 rounded border text-xs italic">
            <strong>テーブル名の命名規則：</strong> --create=messages ← すべて小文字で複数形。テーブルには複数のレコードが格納されるためです。
        </div>

        <div class="space-y-4 mt-8">
            <h4 class="font-bold text-gray-800">生成されたファイルの解説</h4>
            <p class="text-xs text-gray-600">database/migrations/年_月_日_時_create_messages_table.php</p>
            <div class="bg-gray-800 rounded-lg p-5 font-mono text-xs text-gray-300 overflow-x-auto">
<pre>
&lt;?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};</pre>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm mt-4">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h5 class="font-bold text-blue-900 mb-2 underline decoration-blue-200">up() メソッド</h5>
                    <p class="text-xs text-blue-800 leading-relaxed">
                        マイグレーション実行時に呼ばれ、テーブルを作成します。<br>
                        <strong>$table->id();</strong>：自動増分ID（主キー）を作成。符号なしBIGINT型。<br>
                        <strong>$table->timestamps();</strong>：created_at と updated_at カラムを自動作成。
                    </p>
                </div>
                <div class="bg-orange-50 p-4 rounded-lg">
                    <h5 class="font-bold text-orange-900 mb-2 underline decoration-orange-200">down() メソッド</h5>
                    <p class="text-xs text-orange-800 leading-relaxed">
                        ロールバック時に呼ばれます。<code>Schema::dropIfExists('messages');</code> によって、テーブルを削除し、up()での変更を元に戻します。
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-4 mt-8">
            <h4 class="font-bold text-gray-800">マイグレーションファイルの修正</h4>
            <p class="text-sm leading-relaxed">
                自動生成されたファイルは雛形ですので、不足分を補います。メッセージ本文を保存する <strong>content</strong> カラム（VARCHAR型）を追加しましょう。
            </p>
            <div class="bg-gray-800 rounded-lg p-5 font-mono text-xs text-gray-300">
                <p class="text-gray-500 mb-2">// up()抜粋</p>
                Schema::create('messages', function (Blueprint $table) {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;$table->id();<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-yellow-400 font-bold">$table->string('content'); // contentカラム追加</span><br>
                &nbsp;&nbsp;&nbsp;&nbsp;$table->timestamps();<br>
                });
            </div>
            <p class="text-xs text-gray-500 italic">
                ※string()は varchar(255) になります。それ以上必要な場合は <code>$table->text('content')</code> などを利用します。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">マイグレーションの実行</h3>
        <p class="text-sm">MySQLサーバを起動した状態で、以下のコマンドを実行します。</p>
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-sm">
            $ php artisan migrate
        </div>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-19.png" alt="マイグレーション実行結果" class="max-w-xl w-full border rounded shadow-sm">
        </div>

        <h4 class="font-bold text-gray-800 mt-8 underline decoration-gray-200 decoration-2">マイグレーションの確認</h4>
        <div class="bg-gray-100 p-6 rounded-xl space-y-4">
            <p class="text-xs font-bold font-mono">1. 状況の確認</p>
            <code class="block bg-white p-2 border text-xs">php artisan migrate:status</code>
            <p class="text-xs">各ファイルが <strong>Ran</strong> となっていれば実行済みです。</p>
            
            <p class="text-xs font-bold font-mono mt-4">2. MySQLでの確認</p>
            <div class="bg-gray-800 rounded p-4 font-mono text-[10px] text-gray-300 leading-tight">
                mysql> use message-board;<br>
                mysql> show tables;<br>
                mysql> describe messages;
            </div>
            <div class="flex justify-center py-2">
                <img src="/images/Lesson16-20.png" alt="describe messages結果" class="max-w-md w-full border rounded">
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">モデルの作成</h3>
        <p class="text-sm">モデルの作成にも artisan コマンドを使用します。</p>
        <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-sm">
            $ php artisan make:model Message
        </div>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-21.png" alt="モデル作成結果" class="max-w-xl w-full border rounded shadow-sm">
        </div>
        <p class="text-sm">Modelは <code>app/Models/Message.php</code> に生成されます。命名規則は <strong>「頭が大文字で単数形」</strong> です。</p>
        <div class="bg-blue-50 p-4 rounded-lg text-xs italic">
            <strong>命名規則例：</strong> class UserMail (単語ごとに頭が大文字、最後は単数形。最後が単数なら途中の単語は複数形でもOK)
        </div>
        
        <div class="p-4 bg-gray-50 border border-gray-200 rounded text-xs space-y-2">
            <p><strong>Eloquent（エロケント）：</strong> LaravelのモデルはEloquentモデルと呼ばれます。ORM（Object-Relational Mapping）をサポートしており、PHPコードで直感的にDBを操作できます。</p>
            <a href="https://api.laravel.com/docs/9.x/Illuminate/Database/Eloquent/Model.html" target="_blank" class="text-blue-600 hover:underline inline-block mt-2">参考: extendsしているModelクラスの中身 - Laravel API</a>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Modelで使用できるCRUD関数の一例</h3>
        <p class="text-sm leading-relaxed italic">
            モデルの関数を使うと、 SQLを書くことがほとんど無くなります。オブジェクト指向のコードでDBを操作する技法を <strong>O/Rマッピング (ORM)</strong> と呼びます。
        </p>
        <div class="overflow-x-auto shadow rounded-lg border">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-800 text-white">
                    <tr><th class="px-6 py-3">関数名</th><th class="px-6 py-3">用途</th></tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr><td class="px-6 py-3 font-mono font-bold text-blue-600">all</td><td class="px-6 py-3">すべてのレコードを取得する</td></tr>
                    <tr><td class="px-6 py-3 font-mono font-bold text-blue-600">find</td><td class="px-6 py-3">idを指定して検索</td></tr>
                    <tr><td class="px-6 py-3 font-mono font-bold text-blue-600">first</td><td class="px-6 py-3">最初のレコードを1件だけ取得する</td></tr>
                    <tr><td class="px-6 py-3 font-mono font-bold text-blue-600">where</td><td class="px-6 py-3">検索条件を指定</td></tr>
                    <tr><td class="px-6 py-3 font-mono font-bold text-blue-600">save</td><td class="px-6 py-3">レコードの作成および更新</td></tr>
                    <tr><td class="px-6 py-3 font-mono font-bold text-blue-600">delete, destroy</td><td class="px-6 py-3">データの削除。destroyは主キー複数指定可能</td></tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">tinkerでModelのCRUD操作</h3>
        <p class="text-sm font-bold text-red-600 underline">この段階でModelについての理解を深めておいてください。</p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">1. tinkerの起動</h4>
            <p class="text-xs italic text-gray-500">※MySQLサーバが停止しているとエラーになるため、起動を確認してください。</p>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-green-400 text-sm">
                php artisan tinker
            </div>
            <div class="bg-yellow-50 p-3 border border-yellow-200 rounded text-[10px] text-yellow-800">
                Psy Shellのプロンプトが「>>>」となっている箇所は、環境により「>」となる場合があります。適宜読み換えてください。
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">2. Modelの一覧を確認</h4>
            <div class="bg-gray-800 rounded p-4 font-mono text-xs text-white">
                <span class="text-gray-500">>>></span> App\Models\Message::all()
            </div>
            <div class="flex justify-center"><img src="/images/Lesson16-22.png" alt="all実行結果" class="max-w-md w-full border rounded"></div>
            <p class="text-[10px] text-gray-600 leading-relaxed italic">
                戻り値は <strong>Collection</strong> オブジェクトです。配列のように複数の値を扱えます。
            </p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">3. Modelのインスタンスを作成・代入</h4>
            <div class="bg-gray-800 rounded p-4 font-mono text-xs text-white space-y-2">
                <p><span class="text-gray-500">>>></span> $message = new App\Models\Message</p>
                <p><span class="text-gray-500">>>></span> $message->content = 'hello'</p>
                <p><span class="text-gray-500">>>></span> $message</p>
            </div>
            <div class="flex justify-center"><img src="/images/Lesson16-24.png" alt="インスタンス代入結果" class="max-w-md w-full border rounded"></div>
            <p class="text-xs text-red-600 italic">※まだ <code>save()</code> をしていないため、DBには保存されていません。</p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">4. データベースへ保存 (Create)</h4>
            <div class="bg-gray-800 rounded p-4 font-mono text-xs text-white space-y-2">
                <p><span class="text-gray-500">>>></span> $message->save()</p>
            </div>
            <div class="flex justify-center"><img src="/images/Lesson16-26.png" alt="save結果" class="max-w-md w-full border rounded"></div>
            <p class="text-xs text-gray-600 italic">
                <code>=> true</code> と出れば成功です。<code>all()</code> で確認すると、 <strong>id, created_at, updated_at</strong> が自動付与されていることがわかります。
            </p>
            <div class="flex justify-center"><img src="/images/Lesson16-27.png" alt="保存後の一覧確認" class="max-w-md w-full border rounded"></div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">5. インスタンスの取得 (Read)</h4>
            <div class="bg-gray-100 p-4 rounded-lg space-y-4 text-xs">
                <div>
                    <p class="font-bold font-mono">first()：最初の1件を取得</p>
                    <code class="block bg-gray-800 text-white p-2 mt-1">App\Models\Message::first()</code>
                    <div class="flex justify-center py-2"><img src="/images/Lesson16-30.png" alt="first結果" class="max-w-xs w-full"></div>
                </div>
                <div>
                    <p class="font-bold font-mono">find(id)：ID指定で取得</p>
                    <code class="block bg-gray-800 text-white p-2 mt-1">App\Models\Message::find(2)</code>
                    <div class="flex justify-center py-2"><img src="/images/Lesson16-31.png" alt="find結果" class="max-w-xs w-full"></div>
                </div>
                <div>
                    <p class="font-bold font-mono">where() + get() / first()：条件検索</p>
                    <code class="block bg-gray-800 text-white p-2 mt-1">$messages = App\Models\Message::where('content', 'sample2')->get()</code>
                    <div class="flex justify-center py-2"><img src="/images/Lesson16-33.png" alt="where結果" class="max-w-xs w-full"></div>
                    <p class="mt-2 text-[10px] text-gray-500 italic">※where引数3つの例：<code>where('id', '>=', '2')->get()</code> / <code>where('content', 'LIKE', 'sample%')->get()</code></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div class="p-4 border-2 border-blue-100 rounded-xl">
                <h4 class="font-bold text-blue-900 mb-2">レコードの更新 (Update)</h4>
                <div class="bg-gray-800 rounded p-3 font-mono text-[10px] text-gray-300">
                    >>> $message = Message::find(1)<br>
                    >>> $message->content = 'updated'<br>
                    >>> $message->save()
                </div>
                <div class="flex justify-center py-2"><img src="/images/Lesson16-37.png" alt="update結果" class="max-w-full"></div>
            </div>
            <div class="p-4 border-2 border-red-100 rounded-xl">
                <h4 class="font-bold text-red-900 mb-2">レコードの削除 (Delete)</h4>
                <div class="bg-gray-800 rounded p-3 font-mono text-[10px] text-gray-300">
                    // クラス関数で削除<br>
                    >>> Message::destroy([1, 2])<br><br>
                    // インスタンスで削除<br>
                    >>> $message = Message::first()<br>
                    >>> $message->delete()
                </div>
                <div class="flex justify-center py-2"><img src="/images/Lesson16-39.png" alt="delete結果" class="max-w-full"></div>
            </div>
        </div>
    </section>

    <section class="bg-blue-600 text-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-bold mb-4">ここまでのまとめ</h3>
        <p class="opacity-90 leading-relaxed text-sm mb-6">
            WebアプリケーションではModelがもっとも大事です。ModelのCRUD関数を使って、しっかりレコードを操作できるようにしておきましょう。また、実際の開発でもtinkerは頻繁に使いますので、操作に慣れておくことが重要です。
        </p>
        <div class="bg-blue-800 p-4 rounded-lg font-mono text-xs">
            git add -A<br>
            git commit -m "message model"<br>
            git push origin main
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}