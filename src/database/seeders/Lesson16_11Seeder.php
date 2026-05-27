<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_11Seeder extends Seeder
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
                'sort_order' => 11,
            ],
            [
                'title' => 'テストデータの生成',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">テストデータの生成</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                indexに表示するメッセージをもっと増やしたい場合に、1件ずつcreateから手作業で登録するのは大変です。ここではプログラムでメッセージを自動生成する方法を学びます。
            </p>
            <p>
                このチャプターでは <strong>db:seed</strong> を利用した基本的な操作と、参考資料として、 <strong>Factory</strong> を利用したテストデータの作成を学習します。
            </p>
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                <p class="font-bold text-blue-800 mb-2">学習のポイント</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>seed を利用して、新規Messageを3件作成する</li>
                    <li>seed を利用して、大量にMessageを生成する</li>
                    <li>Factory を利用して、データ自動生成</li>
                </ul>
            </div>
            <p class="text-xs text-gray-500 italic mt-2">※基本的には、 db:seed で作成できれば大丈夫です。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">seed</h3>
        <p class="text-sm">
            テストデータを自動生成するためのプログラムを <strong>seed</strong> と呼びます。Laravel (Eloquent) では <strong>db:seed</strong> というArtisanコマンドとしてすでに用意されています。
        </p>

        <h4 class="text-lg font-bold text-gray-800">新規Messageを3件作成する</h4>
        <p class="text-sm">
            db:seed コマンドを実行する前に <strong>シーダ（Seeder）</strong> と呼ばれるものを生成する必要があります。下記の php artisan make:seeder コマンドを実行しましょう。
        </p>

        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># make:seederコマンド</p>
            php artisan make:seeder MessagesTableSeeder
        </div>

        <p class="text-sm">
            実行が完了すると <code>database/seeders</code> フォルダ内に <code>MessagesTableSeeder.php</code> が作成されています。中身を確認すると、空っぽの <code>run()</code> のみが記述されています。
        </p>

        <p class="text-xs font-bold text-gray-500">database/seeders/MessagesTableSeeder.php</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-xs text-gray-600">
<pre>
&lt;?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}</pre>
        </div>

        <p class="text-sm">
            この <code>run()</code> のの中に insert の命令を記述します。今回は3件登録したいため、以下のように記述をします。
        </p>

        <p class="text-xs font-bold text-gray-500">database/seeders/MessagesTableSeeder.php (編集後)</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs overflow-x-auto shadow-inner">
<pre>
&lt;?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
<span class="text-yellow-400">use Illuminate\Support\Facades\DB; // 追加するとseederを利用したデータ生成が可能</span>

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        <span class="text-green-400">DB::table('messages')->insert([
            'title' => 'test title 1',
            'content' => 'test content 1'
        ]);
        DB::table('messages')->insert([
            'title' => 'test title 2',
            'content' => 'test content 2'
        ]);
        DB::table('messages')->insert([
            'title' => 'test title 3',
            'content' => 'test content 3'
        ]);</span>
    }
}</pre>
        </div>

        <p class="text-sm mt-6">
            次に <code>database/seeders</code> フォルダにある <code>DatabaseSeeder.php</code> を開いてください。同じように <code>run()</code> が記述されていて、サンプルコードがコメントになっています。その <code>run()</code> メソッドの中へ以下のように <code>$this->call([MessagesTableSeeder::class]);</code> と記述します（サンプルコードのコメントは消しても残しておいても構いません）。
        </p>

        <p class="text-xs font-bold text-gray-500">database/seeders/DatabaseSeeder.php</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs overflow-x-auto shadow-inner">
<pre>
&lt;?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        <span class="text-green-400">$this->call([MessagesTableSeeder::class]);</span>
    }
}</pre>
        </div>

        <p class="text-sm mt-6">ここまでできたら、下記コマンドを実行してください。これで <code>database/seeders/MessagesTableSeeder</code> が実行され、上述のレコードが3つ生成されているはずです。</p>

        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># コマンド実行</p>
            php artisan db:seed --class=MessagesTableSeeder
        </div>

        <div class="bg-yellow-50 p-4 rounded text-sm text-gray-700 italic border-l-4 border-yellow-400">
            シーダは何度でも実行でき、実行した分だけレコードが生成されます。<br>
            なお、<code>--class=MessagesTableSeeder</code> は、特定のシーダのみ実行したい場合に指定します。DatabaseSeeder の中で指定したすべてのシーダを実行するときは不要です。
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">大量にMessageを生成する</h3>
        <p class="text-sm leading-relaxed">
            db:seed を利用したデータ登録の方法はわかりましたが、たとえば1000件レコードを作成しようとしたときに、このように1つずつ書いていては非効率です。
        </p>
        <p class="text-sm">
            そこで、<strong>繰り返し処理</strong>を使用して記述します。以下の例では、1件ずつ指定していた記述をやめ、繰り返し処理（for文）により、100件のMessageのレコードを作成する記述にしています。
        </p>

        <p class="text-xs font-bold text-gray-500">database/seeders/MessagesTableSeeder.php (大量生成用)</p>
        <div class="bg-gray-800 text-white p-5 rounded-lg font-mono text-xs overflow-x-auto shadow-inner">
<pre>
&lt;?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        <span class="text-green-400">for($i = 1; $i <= 100; $i++) {
            DB::table('messages')->insert([
                'title' => 'test title ' . $i,
                'content' => 'test content ' . $i
            ]);
        }</span>
    }
}</pre>
        </div>

        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg mt-4">
            <p class="text-gray-400"># コマンド実行</p>
            php artisan db:seed --class=MessagesTableSeeder
        </div>

        <p class="text-sm">
            100件レコードを登録できました。これで100件と言わず1万件でも登録できます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブル再作成登録</h3>
        <p class="text-sm">
            その他のデータを削除して、シーダで記述したデータのみを利用したい場合もあります。そんなときには <code>migrate:refresh</code> のArtisanコマンドを使用してください。
        </p>

        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># migrate:refreshコマンド</p>
            php artisan migrate:refresh --seed
        </div>

        <div class="bg-gray-50 p-6 rounded border border-gray-200 text-sm">
            <p class="font-bold mb-3">このコマンドが内部で行なっていること：</p>
            <ol class="list-decimal pl-6 space-y-2">
                <li><code>php artisan migrate:reset</code>（データベースの初期状態まで一気にロールバック）</li>
                <li><code>php artisan migrate</code>（マイグレーションを再実行）</li>
                <li><code>php artisan db:seed</code>（DatabaseSeeder の中で指定したシーダをすべて実行）</li>
            </ol>
        </div>

        <p class="text-sm">今後、Webアプリケーション開発でテストデータが必要となるときがあるでしょう。その際はシーダを存分に活用してください。</p>

        <h4 class="font-bold text-gray-800 mt-10">GitHubへプッシュ</h4>
        <p class="text-sm">Seederを追加したところまでをプッシュしておきましょう。</p>
        <div class="bg-gray-900 text-green-400 p-5 rounded font-mono text-xs">
            git add -A<br>
            git commit -m "add seeder"<br>
            git push origin main
        </div>
    </section>

    <hr class="border-t-2 border-gray-100">

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Factoryでデータ自動生成</h3>
        <h4 class="text-lg font-bold text-gray-800 italic">Factory</h4>
        <p class="text-sm leading-relaxed">
            Factoryを利用すると、Modelを利用するより簡単に、大量のサンプルデータを自動生成できます。以下のドキュメントサイトのページで、Factoryに関する説明がされています。
        </p>
        <p class="text-xs text-blue-500 underline mb-6">
            <a href="https://readouble.com/laravel/9.x/ja/database-testing.html" target="_blank">参考: データベーステスト（Laravel 9.x）</a>
        </p>

        <h4 class="font-bold text-gray-800 mt-8">Factoryの使い方</h4>
        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># make:factoryコマンド</p>
            php artisan make:factory Message
        </div>
        <p class="text-sm"><code>database/factories/</code> フォルダ内に、 <code>MessageFactory.php</code> ファイルが生成されました。</p>

        <p class="text-xs italic text-gray-500">実行結果</p>
        <img src="/images/Lesson16-67.png" alt="make:factory result" class="max-w-md border rounded shadow-sm py-2">

        <h4 class="font-bold text-gray-800 mt-8">モデルの修正 (fillableの追記)</h4>
        <p class="text-sm">
            すべての項目がデフォルトで「一気に保存可能（Mass Assignment）」になっていると、想定外のデータが保存されるかもしれず、セキュリティ上それは良いことでありません。
        </p>
        <p class="text-sm">
            そこで、 <strong>$fillable</strong> で「一気に保存可能」なパラメータを指定します。こうすることで、想定外のデータが代入されるのを防ぎ、なおかつ、一気にデータを代入することが可能になります。
        </p>

        <p class="text-xs font-bold text-gray-500">app/Models/Message.php</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs overflow-x-auto shadow-inner">
<pre>
&lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    <span class="text-yellow-400">// 追記して一括代入を許可し、セキュリティを確保する</span>
    <span class="text-green-400">protected $fillable = ['content', 'title'];</span>
}</pre>
        </div>

        <h4 class="font-bold text-gray-800 mt-10">Factoryの定義</h4>
        <p class="text-sm">
            <code>definition()</code> を実行するたび、配列内から1組のデータを取得して、<code>$content</code> と <code>$title</code> に設定する処理を記述します。
        </p>

        <p class="text-xs font-bold text-gray-500">database/factories/MessageFactory.php</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-[11px] overflow-x-auto shadow-inner">
<pre>
&lt;?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<span class="text-yellow-400">use App\Models\Message; // 追記が必要</span>

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array&lt;string, mixed&gt;
     */
     
    <span class="text-yellow-400">// definition()の処理全体の追記が必要</span>
    <span class="text-green-400">public function definition()
    {
        $content = ['Web用', '機械学習用', 'フロントエンド用', '業務用', 'Unitiy用', 'iphone用', 'Android用'];
        $title = ['php', 'python', 'JavaScript', 'Java', 'C#', 'swift', 'kotolin'];

        $content = $content[rand(0, count($content) - 1)];
        $title = $title[rand(0, count($title) - 1)];
        
        return [
            'content' => $content,
            'title' => $title,
        ];
    }</span>
}</pre>
        </div>
        <p class="text-xs italic text-gray-500 mt-2">※rand関数を利用し、0から要素数までのランダムな要素を配列から取得する処理です。</p>

        <h4 class="font-bold text-gray-800 mt-10">DatabaseSeederからの呼び出し</h4>
        <p class="text-xs font-bold text-gray-500">database/seeders/DatabaseSeeder.php</p>
        <div class="bg-gray-800 text-white p-5 rounded font-mono text-xs overflow-x-auto shadow-inner">
<pre>
&lt;?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<span class="text-yellow-400">use App\Models\Message; // 追記する</span>

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        <span class="text-yellow-400">// 追記する：count(5) を 100 にすれば、100件分のデータを自動生成できます</span>
        <span class="text-green-400">Message::factory()->count(5)->create();</span>
    }
}</pre>
        </div>

        <h4 class="font-bold text-gray-800 mt-10">seederの実行</h4>
        <div class="bg-black text-white p-4 rounded font-mono text-xs shadow-lg">
            <p class="text-gray-400"># db:seedコマンド</p>
            php artisan db:seed
        </div>

        <p class="text-xs italic text-gray-500 mt-4">実行結果</p>
        <img src="/images/Lesson16-68.png" alt="db:seed execution result" class="max-w-md border rounded shadow-sm mb-4">

        <p class="text-sm">たとえば次のように2件目から6件目のデータが自動生成されます。</p>
        <div class="bg-gray-100 p-4 rounded font-mono text-[11px] text-gray-700 border overflow-x-auto">
<pre>
+----+------------+---------------------+---------------------+------------+
| id | content    | created_at          | updated_at          | title      |
+----+------------+---------------------+---------------------+------------+
|  1 | test test  | 2022-08-06 21:58:52 | 2022-08-06 21:58:52 | test       |
|  2 | Android用  | 2022-08-12 07:24:33 | 2022-08-12 07:24:33 | JavaScript |
|  3 | Web用      | 2022-08-12 07:24:33 | 2022-08-12 07:24:33 | php        |
|  4 | 業務用     | 2022-08-12 07:24:33 | 2022-08-12 07:24:33 | Java       |
|  5 | Unitiy用   | 2022-08-12 07:24:33 | 2022-08-12 07:24:33 | swift      |
|  6 | iphone用   | 2022-08-12 07:24:33 | 2022-08-12 07:24:33 | swift      |
+----+------------+---------------------+---------------------+------------+</pre>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}