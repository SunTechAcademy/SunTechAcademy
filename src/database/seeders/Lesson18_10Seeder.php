<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_10Seeder extends Seeder
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
                'sort_order' => 10,
            ],
            [
                'title' => 'フォロー機能',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">フォロー機能</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-2">
            <p>続いて、ユーザがユーザをフォローする／フォローされる機能を構築します。少しむずかしい話になるため、少しずつ理解していってください。</p>
            <p class="text-blue-600 font-bold">（参考）リクエストからレスポンスまでの流れを振り返っていただくと、理解しやすくなります。</p>
        </div>
        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl mt-4">
            <img src="/images/Lesson18-53.png" alt="Follow Feature Flow" class="w-full h-auto rounded border">
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Model</h3>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">多対多の関係</h4>
            <div class="prose max-w-none text-sm leading-relaxed space-y-2">
                <p>一対多だけでなく、<strong>多対多</strong> の関係もあります。</p>
                <p>このチャプターで解説する機能である「フォローしている／フォローされている」の関係は、多対多の関係です。また、課題である「お気に入り機能」も、多対多の関係です。</p>
                <p>多対多の関係は、一対多の関係を拡張した関係です。一対多との違いから理解しましょう。</p>
                <p>一対多の関係だったUserとMicropostでは、 Userが複数のMicropostを持ち、 Micropostは必ず1つのUserに所属しました。</p>
                <p>「フォローしている／フォローされている」の関係では、あるUser が フォローしているUserは複数存在する場合があり、逆にあるUser を フォローしているUserも複数存在する場合があるという、双方に複数相手が存在する可能性のある関係なのです。</p>
                <p class="font-bold text-gray-900 bg-yellow-50 p-3 rounded border border-yellow-200">この違いは必ず理解してください。一対多と同様に多対多のリソースを扱う方法もしっかりと学んでおく必要があります。多対多の関係が稀な関係だとは思わないでください。一対多と同様、頻繁に出てくる関係です。</p>
            </div>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">多対多では中間テーブルが必要</h4>
            <div class="prose max-w-none text-sm leading-relaxed space-y-2">
                <p>一対多では、 micropostsテーブルを作成するときにuser_idを付与しました。micropostsテーブルにuser_idを設置することで、 Micropostが所属するUserを特定できたのです。</p>
                <p>And, belongsToとhasManyのメソッドによって両者をModelファイルで繋げたので、 <code>$user->microposts</code> や <code>$micropost->user</code> が使用可能になったわけです。</p>
                <p>多対多では、片方のテーブルにxxxx_idのようなカラムを設置するだけでは、よい感じに実現できません。カラムの中身が配列になってしまい、データベースの1つの値が配列になってしまうと、とても扱いにくく好ましくありません。</p>
                <p>そこで、多対多の場合には、<strong>中間テーブル</strong> を設置するのがもっとも有効な方法です。</p>
                <p>中間テーブルとは、 usersやmicropostsのようなメインとなるリソースではなく、その関係を繋げるためだけのテーブルを言います。</p>
                <p>上図の中間テーブルでは、フォローする側のUserとフォローされる側のUserの情報をペアとして持っており、たとえば [ 1 | 2 ] となっている中間テーブルのレコードは「id: 1のユーザがid: 2のユーザをフォローしている」ことを意味していると思ってください。</p>
                <p>このように中間テーブルを用意することで、フォローしているUserとフォローされているUserの関係を表現できるのです。</p>
                <p>一見難しく思えますが、この中間テーブルを利用する方法は今まで使用してきた一対多の関係を拡張した関係になっています。</p>
                <p>中間テーブルはUserのフォローの関係を表すだけのテーブルであり、「左側のUser」と「中間テーブルの左側」の関係だけで見ると一対多、同じく「右側のユーザ」と「中間テーブルの右側」の関係も一対多です。</p>
                <p class="font-bold text-blue-700">一対多の関係を2つ（上図で言うと左右から）くっつけることで、相手が双方向に複数存在する『多対多』という関係を表現できるようになっているわけです。</p>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">マイグレーション</h4>
            <p class="text-sm font-bold text-gray-700">マイグレーションファイルの作成</p>
            <p class="text-sm">では、 UserとUserのフォロー関係のレコードを保存する中間テーブルuser_followを作成し、up() にカラムの情報を追記します。念のため id と timestamps() は残していますが、中間テーブルとして重要なのは user_id と follow_id です。</p>
            <p class="text-sm">次のマイグレーションコマンドを実行してください。</p>
            
            <p class="text-xs font-bold text-gray-600">マイグレーションコマンドの実行</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">php artisan make_migration create_user_follow_table --create=user_follow</pre>
            
            <p class="text-xs font-bold text-gray-500 italic">実行結果イメージ</p>
            <div class="border border-gray-200 rounded-xl p-3 bg-white shadow-inner max-w-md">
                <img src="/images/Lesson18-54.png" alt="Migration Create Follow Table Result" class="w-full h-auto rounded border">
            </div>

            <p class="text-sm leading-relaxed">生成されたマイグレーションファイルの <code>public function up()</code> 内を次のように修正してください。</p>
            <p class="text-xs font-bold text-gray-500 italic">database/migrations/年月日時_create_user_follow_table.php の up() と down()</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">    public function up()
    {
        Schema::create('user_follow', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('follow_id');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('follow_id')->references('id')->on('users')->onDelete('cascade');

            // user_idとfollow_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'follow_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_follow');
    }</pre>
            
            <div class="prose max-w-none text-sm text-gray-600 space-y-2 leading-relaxed bg-gray-50 p-4 rounded border">
                <p>follow_idという名前にしていますが、保存する内容はユーザIDです。user_idとカラム名が被ることを避けるため、follow_idにしています。これで「フォローしている／フォローされている」の関係を保存できます。</p>
                <p>また、<code>$table->unique(['user_id', 'follow_id']);</code> を追加することでuser_idとfollow_idの組み合わせの重複を許さないようにしています。これは一度保存したフォロー関係を何度も保存しないようにテーブルの制約として入れています。</p>
            </div>
        </div>

        <div class="bg-gray-50 p-5 rounded-lg border space-y-3 text-sm leading-relaxed">
            <h4 class="font-bold text-gray-800 text-sm border-b pb-1">💡 （補足）onDeleteオプション</h4>
            <p>onDeleteは参照先のデータが削除されたときにこのテーブルの行をどのように扱うかを指定します。 オプションとして以下の値をセットして、削除後の挙動を制御できます。</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                <div class="bg-white p-3 rounded border shadow-sm"><span class="font-bold text-blue-600">set null:</span> NULLに設定 (IDをNULLに変更します）</div>
                <div class="bg-white p-3 rounded border shadow-sm"><span class="font-bold text-blue-600">no action:</span> なにもしない (存在しないIDが残ります）</div>
                <div class="bg-white p-3 rounded border shadow-sm font-bold bg-blue-50 text-blue-800 border-blue-200"><span class="font-bold text-blue-600">cascade:</span> 一緒に消す (このテーブルのデータも一緒に消えます）</div>
                <div class="bg-white p-3 rounded border shadow-sm"><span class="font-bold text-blue-600">restrict:</span> 禁止する (参照先のデータが消せなくなります）</div>
            </div>
            <p class="pt-2">今回は、<code>onDelete('cascade')</code> とすることで、ユーザテーブルのデータが削除されると同時に、それにひもづくフォローテーブルのフォロー、フォロワーのレコードも削除されるようにしました。</p>
        </div>

        <div class="space-y-2">
            <p class="text-sm font-bold text-gray-700">マイグレーションの実行</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">php artisan migrate</pre>
            <p class="text-xs text-gray-600">マイグレーションが実行済みになったことを <code>php artisan migrate:status</code> コマンドで確認しておきましょう。 MySQL側でテーブルの内容を <code>describe user_follow;</code> で確認しておくのも良いでしょう。</p>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">belongsToMany()</h4>
            <p class="text-sm leading-relaxed">
                中間テーブルのためのModelファイルは不要です。<br>
                その代わり、 Userのモデルファイルに多対多の関係を記述します。そのためには <code>belongsToMany</code> メソッドを使用します。<br>
                フォロー関係の場合、多対多の関係がどちらもUserに対するものなので、どちらもUserのModelファイルに記述します。<code>loadRelationshipCounts()</code> の定義の下に追記してください。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">app/Models/User.php（抜粋）</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">class User extends Authenticatable
{
    // 中略

    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('microposts');
    }
    
    /**
     * このユーザがフォロー中のユーザ。（Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    /**
     * このユーザをフォロー中のユーザ。（Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
}</pre>
            
            <div class="prose max-w-none text-sm text-gray-600 space-y-2 leading-relaxed bg-gray-50 p-4 rounded border">
                <p>これで、一対多のときと同様に <code>$user->followings</code> で <code>$user</code> が フィローしているUser達を取得できます。 <code>$user->followers</code> も同様で <code>$user</code> をフォローしているUser達を取得可能です。</p>
                <p>followingsはUser が フィローしているUser達で、 followersはUser を フォローしているUser達です。</p>
                <p>（followingsを例にとると）<code>belongsToMany()</code> では、関係先のModelのクラス（<code>User::class</code>）を第一引数に指定します。</p>
                <p>第二引数に中間テーブル（<code>user_follow</code>）を指定します。</p>
                <p>第三引数には中間テーブルに保存されている自分のidを示すカラム名（<code>user_id</code>）を指定します。</p>
                <p>第四引数には中間テーブルに保存されている関係先のidを示すカラム名（<code>follow_id</code>）を指定します。</p>
                <p>followersの場合、第三引数と第四引数が逆になります。つまり、followingsは「user_id のUserは follow_id のUserをフォローしている」ことを表し、followersは「follow_id のUserは user_id のUserからフォローされている」ことを表しています。</p>
                <p>なお、 <code>withTimestamps()</code> は中間テーブルにもcreated_atとupdated_atを保存するためのメソッドで、タイムスタンプを管理できるようになります。</p>
                <p class="pt-1 text-xs">参考: <a href="https://readouble.com/laravel/9.x/ja/eloquent-relationships.html#many-to-many" target="_blank" class="text-blue-600 underline font-mono">多対多 - Laravel 9.x</a></p>
            </div>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">follow(), unfollow()</h4>
            <p class="text-sm leading-relaxed">
                フォロー／アンフォローするための <code>follow()</code> と<code>unfollow()</code> メソッド、ならびにフォローしているかを確認するための <code>is_following()</code> メソッドをUserモデルで定義しておきましょう。<code>followers() { ... }</code> の下に、以下のコードを追記します。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">app/Models/User.php（抜粋）</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">class User extends Authenticatable
{
    // 中略

    /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function follow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    /**
     * $userIdで指定されたユーザをアンフォローする。
     * * @param  int $usereId
     * @return bool
     */
    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 指定された$userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     * * @param  int $userId
     * @return bool
     */
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
}</pre>
            
            <div class="prose max-w-none text-sm text-gray-600 space-y-2 leading-relaxed bg-gray-50 p-4 rounded border">
                <p>フォロー／アンフォローするときには、以下の2点に注意が必要です。</p>
                <ol class="list-decimal pl-5 space-y-1 font-bold text-gray-800">
                    <li>すでにフォローしているか</li>
                    <li>対象が自分自身かどうかの確認</li>
                </ol>
                <p>これらをしっかり判定してからフォロー／アンフォローを実行しましょう。</p>
                <p>フォロー／アンフォローとは、中間テーブルのレコードを保存／削除することです。そのために、あらかじめ用意された<code>attach()</code> と <code>detach()</code> というメソッドを使用します。</p>
                <p>念のため、フォロー／アンフォローに成功すれば <code>return true</code> 、失敗すれば <code>return false</code> を実行するようにしています。今回は true, false の結果を使用していませんが、何かしらの処理で成功失敗を判定したい場合には利用できます。</p>
                <p class="pt-1 text-xs">参考: <a href="https://readouble.com/laravel/9.x/ja/eloquent-relationships.html#updating-many-to-many-relationships" target="_blank" class="text-blue-600 underline font-mono">attach/detach - Laravel 9.x</a></p>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">tinkerでフォロー／アンフォロー</h4>
            <p class="text-sm bg-yellow-50 p-3 rounded border border-yellow-200">
                <strong>前提としてUserを2人以上作成しておきましょう。</strong>1人がもう1人をフォロー／アンフォローするためです。<br>
                そのために、あらかじめデータベース上に2人以上のユーザを登録しておいてください。登録がないとfindメソッドを実行してもnullが返ってきてしまいます。
            </p>

            <div class="space-y-4 bg-gray-900 text-white p-4 rounded-lg font-mono text-xs shadow-lg">
                <div>
                    <p class="text-green-400">// コマンド入力 1</p>
                    <p>microposts $ php artisan tinker</p>
                    <p>Psy Shell v0.11.8 (PHP 8.1.8 — cli) by Justin Hileman</p>
                    <p>&gt; use User</p>
                    <p>&gt; $user1 = User::find(1)</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 1】</p>
                    <img src="/images/Lesson18-55.png" alt="Tinker Find User 1 Result" class="w-full h-auto rounded">
                </div>

                <div class="pt-2 border-t border-gray-700">
                    <p class="text-green-400">// コマンド入力 2</p>
                    <p>&gt; $user2 = User::find(2)</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 2】</p>
                    <img src="/images/Lesson18-56.png" alt="Tinker Find User 2 Result" class="w-full h-auto rounded">
                </div>

                <div class="pt-2 border-t border-gray-700">
                    <p class="text-green-400">// コマンド入力 3</p>
                    <p>&gt; $user1-&gt;follow($user2-&gt;id)</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 3】</p>
                    <img src="/images/Lesson18-57.png" alt="Tinker Action Follow Result" class="w-full h-auto rounded">
                </div>

                <div class="pt-2 border-t border-gray-700">
                    <p class="text-green-400">// コマンド入力 4</p>
                    <p>&gt; $user1-&gt;followings()-&gt;get()</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 4】</p>
                    <img src="/images/Lesson18-58.png" alt="Tinker Followings List Result" class="w-full h-auto rounded">
                </div>

                <div class="pt-2 border-t border-gray-700">
                    <p class="text-green-400">// コマンド入力 5</p>
                    <p>&gt; $user1-&gt;unfollow($user2-&gt;id)</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 5】</p>
                    <img src="/images/Lesson18-59.png" alt="Tinker Action Unfollow Result" class="w-full h-auto rounded">
                </div>

                <div class="pt-2 border-t border-gray-700">
                    <p class="text-green-400">// コマンド入力 6</p>
                    <p>&gt;  $user1-&gt;followings()-&gt;get()</p>
                </div>
                <div class="bg-gray-800 p-2 rounded text-gray-400 border border-gray-700 max-w-md">
                    <p class="text-xs font-sans mb-1">【実行結果イメージ 6】</p>
                    <img src="/images/Lesson18-60.png" alt="Tinker Followings List Empty Result" class="w-full h-auto rounded">
                </div>
            </div>
            <p class="text-sm leading-relaxed mt-2">
                これでUserのフォロー／アンフォローが自由にできるようになりました。<br>
                中間テーブルがどうなっているのか気になれば、 MySQLクライアントで直接レコードを確認してみるのも良いでしょう。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Router</h3>
        <p class="text-sm font-bold text-gray-800">routes/web.phpのauthグループ設定</p>
        <p class="text-sm">次のRouterを <code>routes/web.php</code> を修正してください。</p>
        
        <p class="text-xs font-bold text-gray-500 italic">routes/web.php（抜粋）</p>
        <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MicropostsController;
use App\Http\Controllers\UserFollowController;  // 追記

（中略）

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {                                          // 追記
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');         // 追記
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow'); // 追記
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings'); // 追記
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');    // 追記
    });                                                                                             // 追記
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
});</pre>

        <div class="prose max-w-none text-sm leading-relaxed bg-gray-50 p-4 rounded border text-gray-600 space-y-2">
            <p>authの <code>Route::group</code> の中に <code>['prefix' => 'users/{id}']</code> とした <code>Route::group</code> を追加しています。このグループ内のルーティングではURLの最初に <code>/users/{id}/</code> が付与され、以下のような形となります。</p>
            <ul class="list-disc pl-5 font-mono text-xs text-gray-800">
                <li>POST /users/{id}/follow</li>
                <li>DELETE /users/{id}/unfollow</li>
                <li>GET /users/{id}/followings</li>
                <li>GET /users/{id}/followers</li>
            </ul>
            <p class="pt-2">上記だけではイメージしづらいと思うため、以下にデモサイトのURLを基にした完全なURLを参考情報として記載します。あくまでもURLは参考であるため、一覧以外のURLにはアクセスしても何も起こりません。</p>
        </div>

        <div class="p-4 bg-blue-50 border border-blue-200 rounded text-sm space-y-2">
            <p class="font-bold text-blue-900 text-xs">URLの参考（例：ユーザID125のユーザの場合）</p>
            <div class="space-y-2 text-xs font-mono bg-white p-3 rounded border">
                <p class="text-gray-500">// 125番目のユーザをフォローする</p>
                <p class="text-blue-700">http://laravel-microposts.herokuapp.com/users/125/follow [POST形式]</p>
                <p class="text-gray-500">// 125番目のユーザをアンフォローする</p>
                <p class="text-blue-700">http://laravel-microposts.herokuapp.com/users/125/unfollow [DELETE形式]</p>
                <p class="text-gray-500">// 125番目のユーザがフォローしているユーザ一覧を表示する</p>
                <p class="text-blue-700">http://laravel-microposts.herokuapp.com/users/125/followings [GET形式]</p>
                <p class="text-gray-500">// 125番目のユーザをフォローしているユーザ一覧を表示する</p>
                <p class="text-blue-700">http://laravel-microposts.herokuapp.com/users/125/followers [GET形式]</p>
            </div>
            <p class="text-xs text-gray-600 pt-1">
                上記のPOSTとDELETEはフォロー／アンフォローをHTTPで操作可能にするルーティングです。UserFollowControllerは、あとで新規作成するため、その際に説明します。<br>
                そして、 GETの2つはフォローしている人とフォローされている人のUser一覧を表示するルーティングとなります。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">UserFollowController@store, destroy</h3>
        
        <div class="space-y-2">
            <h4 class="font-bold text-base text-gray-800">Controller</h4>
            <div class="prose max-w-none text-sm leading-relaxed space-y-2 text-gray-600">
                <p>フォロー機能のためのモデルやルーティングが作成できたため、次はコントローラを作成しましょう。</p>
                <p>UsersController.phpやMicropostsController.phpのファイルがすでにありますが、今回は中間テーブルを操作するアクションであるため新しくUserFollowController.phpファイルを作成します。</p>
                <p>その中に、フォローするためのstoreメソッドとアンフォローするためのdestroyメソッドを作成することにします。</p>
                <p>storeメソッドではUser.phpに定義されているfollowメソッドを使って、ユーザをフォローできるようにします。</p>
                <p>destroyメソッドではUser.phpに定義されているunfollowメソッドを使って、ユーザをアンフォローできるようにします。</p>
            </div>
            <p class="text-sm">次のコマンドを実行して、 <code>UserFollowController.php</code> ファイルを作成してください。</p>
            
            <p class="text-xs font-bold text-gray-600">UserFollowController.phpファイルの作成</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">php artisan make_controller UserFollowController</pre>
        </div>

        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/UserFollowController.php の store と destroy</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    /**
     * ユーザをフォローするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをフォローする
        \Auth::user()->follow($id);
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * ユーザをアンフォローするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをアンフォローする
        \Auth::user()->unfollow($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}</pre>
        </div>

        <div class="space-y-2 border-t pt-4">
            <h4 class="font-bold text-base text-gray-800">フォロー／フォロワー数のカウント</h4>
            <p class="text-sm leading-relaxed">投稿数に加えて、フォロー数とフォロワー数も取得したいため、以下のように <code>loadCount</code> に指定するリレーション名として <code>'followings'</code> と <code>'followers'</code> も追加します。</p>
            <p class="text-xs font-bold text-gray-500 italic">app/Models/User.php（抜粋）</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['microposts', 'followings', 'followers']);
    }</pre>
        </div>

        <div class="space-y-4 border-t pt-4">
            <h4 class="font-bold text-base text-gray-800">View</h4>
            <ul class="list-disc pl-5 text-sm space-y-1">
                <li><code>resources/views/</code> フォルダに <code>user_follow</code> フォルダを作成</li>
                <li><code>resources/views/user_follow/</code> フォルダに <code>follow_button.blade.php</code> ファイルを作成し、フォロー／アンフォローボタンを記載</li>
                <li><code>resources/views/users/card.blade.php</code> ファイルに <code>follow_button.blade.php</code> 読み込み表示を記載</li>
            </ul>

            <div class="space-y-2">
                <p class="text-sm font-bold text-gray-800">フォロー／アンフォローボタン</p>
                <p class="text-sm leading-relaxed">
                    <code>resources/views/user_follow/follow_button.blade.php</code> ファイルにフォロー／アンフォローボタンを作成します。<br>
                    <span class="text-xs text-gray-500 font-mono">@include(‘user_follow.follow_button’)（follow_button.blade.php）</span>
                </p>
                <p class="text-xs text-gray-600 bg-gray-100 p-2 rounded">
                    1. <code>resources/views/</code> フォルダに <code>user_follow</code> フォルダを作成<br>
                    2. <code>resources/views/user_follow/</code> フォルダに <code>follow_button.blade.php</code> ファイルを作成
                </p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/user_follow/follow_button.blade.php</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@if (Auth::id() != $user-&gt;id)
    @if (Auth::user()-&gt;is_following($user-&gt;id))
        {{-- アンフォローボタンのフォーム --}}
        &lt;form method="POST" action="{{ route('user.unfollow', $user-&gt;id) }}"&gt;
            @csrf
            @method('DELETE')
            &lt;button type="submit" class="btn btn-error btn-block normal-case" 
                onclick="return confirm('id = {{ $user-&gt;id }} のフォローを外します。よろしいですか？')"&gt;Unfollow&lt;/button&gt;
        &lt;/form&gt;
    @else
        {{-- フォローボタンのフォーム --}}
        &lt;form method="POST" action="{{ route('user.follow', $user-&gt;id) }}"&gt;
            @csrf
            &lt;button type="submit" class="btn btn-primary btn-block normal-case"&gt;Follow&lt;/button&gt;
        &lt;/form&gt;
    @endif
@endif</pre>
                <p class="text-xs text-gray-600"><code>@include('user_follow.follow_button')</code> すると、フォローボタンを表示できます。すでにフォローしている場合にはアンフォローボタンになります。また、自分自身の場合には表示されません。</p>
            </div>

            <div class="space-y-2 border-t pt-2">
                <p class="text-sm font-bold text-gray-800">フォロー／アンフォローボタンの設置</p>
                <p class="text-sm"><code>resources/views/users/card.blade.php</code> ファイルで <code>follow_button.blade.php</code> 読み込み表示を記載します。users.cardの末尾のほうに、 <code>{{-- フォロー／アンフォローボタン --}}</code> を設置しましょう。</p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/users/card.blade.php 抜粋</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;/div&gt;
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')</pre>
                <p class="text-xs text-gray-600"><code>@include('user_follow.follow_button')</code> すると、<code>resources/views/user_follow/follow_button.blade.php</code> ファイルを読み込んで表示しています。</p>
            </div>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">UsersController@followings, followers</h3>
        
        <div class="space-y-2">
            <h4 class="font-bold text-base text-gray-800">Controller</h4>
            <p class="text-sm">こちらはUserの情報を取得できれば良いため、UsersController へ記述します。</p>
            <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/UsersController.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // 中略

    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user-&gt;loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user-&gt;followings()-&gt;paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user-&gt;loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user-&gt;followers()-&gt;paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
}</pre>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-base text-gray-800">View</h4>
            <div class="prose max-w-none text-sm text-gray-600 space-y-2 leading-relaxed">
                <p>ユーザの詳細情報表示（users.show）、自分がフォローしているUser一覧（users.followings）、自分をフォローしているUser一覧（users.followers）には共通している部分があるため、まずは共通部分（ユーザ名とGravatarの表示部分、ナビゲーションタブの部分）を切り出しましょう。</p>
                <p>また、ナビゲーションタブの方にfollowingsとfollowersのリンクを追記します。</p>
                <p class="font-mono text-xs">@include(‘users.navtabs’)（navtabs.blade.php ）</p>
                <p><code>resources/views/users/</code> フォルダに <code>navtabs.blade.php</code> ファイルを作成します。</p>
            </div>
            
            <p class="text-xs font-bold text-gray-500 italic">resources/views/users/navtabs.blade.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">&lt;div class="tabs"&gt;
    {{-- ユーザ詳細タブ --}}
    &lt;a href="{{ route('users.show', $user-&gt;id) }}" class="tab tab-lifted grow {{ Request::routeIs('users.show') ? 'tab-active' : '' }}"&gt;
        TimeLine
        &lt;div class="badge ml-1"&gt;{{ $user-&gt;microposts_count }}&lt;/div&gt;
    &lt;/a&gt;
    {{-- フォロー一覧タブ --}}
    &lt;a href="{{ route('users.followings', $user-&gt;id) }}" class="tab tab-lifted grow {{ Request::routeIs('users.followings') ? 'tab-active' : '' }}"&gt;
        Followings
        &lt;div class="badge ml-1"&gt;{{ $user-&gt;followings_count }}&lt;/div&gt;
    &lt;/a&gt;
    {{-- フォロワー一覧タブ --}}
    &lt;a href="{{ route('users.followers', $user-&gt;id) }}" class="tab tab-lifted grow {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}"&gt;
        Followers
        &lt;div class="badge ml-1"&gt;{{ $user-&gt;followers_count }}&lt;/div&gt;
    &lt;/a&gt;
&lt;/div&gt;</pre>

            <div class="bg-gray-50 p-4 rounded-lg border text-sm space-y-4 text-gray-600 leading-relaxed">
                <div>
                    <p class="font-bold text-gray-800 text-xs">【ユーザ詳細タブ】について解説します。</p>
                    <p><code>{{ route('users.show', $user->id) }}</code> では、対象ユーザーの詳細ページを表示するリンクを指定しています。リンクは、 <code>/users/$id</code> のように、 <code>$id</code> には対象ユーザーの番号が指定されます。</p>
                    <p><code>{{ Request::routeIs('users.show') ? 'tab-active' : '' }}</code> では、ユーザー詳細タブが選択されていることがわかるデザインのclassを指定しています。</p>
                    <p><code>{{ $user->microposts_count }}</code> では、Userに関係するMicropostの件数を取得しています。<br>これは、 UsersController@show アクションで呼び出したUserの loadRelationshipCounts メソッドの中で、リレーション microposts の件数をロードしたことより可能になっています。</p>
                </div>
                <div>
                    <p class="font-bold text-gray-800 text-xs">【フォロー一覧タブ】について解説します。</p>
                    <p><code>{{ route('users.followings', $user->id) }}</code> では、対象ユーザーがフォローしている一覧を表示するリンクを指定しています。リンクは、 <code>/users/$id/followings</code> のように、 <code>$id</code> には対象ユーザーの番号が指定されます。</p>
                    <p><code>{{ Request::routeIs('users.followings') ? 'tab-active' : '' }}</code> では、フォロー一覧タブが選択されていることがわかるデザインのclassを指定しています。</p>
                    <p><code>{{ $user->followings_count }}</code> では、 Followingsに関係するMicropostの件数を取得しています。<br>この後のカリキュラムで実装する予定である、UsersController@followings アクションで呼び出したUserの loadRelationshipCounts メソッドの中で、リレーション microposts の件数をロードしたことより可能になっています。</p>
                </div>
                <div>
                    <p class="font-bold text-gray-800 text-xs">【フォロワー一覧タブ】について解説します。</p>
                    <p><code>{{ route('users.followers', $user->id) }}</code> では、対象ユーザーのフォロワー一覧を表示するリンクを指定しています。リンクは、 <code>/users/$id/followers</code> のように、 <code>$id</code> には対象ユーザーの番号が指定されます。</p>
                    <p><code>{{ Request::routeIs('users.followers') ? 'tab-active' : '' }}</code> では、フォロワー一覧タブが選択されていることがわかるデザインのclassを指定しています。</p>
                    <p><code>{{ $user->followers_count }}</code> では、 Followersに関係するMicropostの件数を取得しています。<br>この後のカリキュラムで実装する予定である、UsersController@followers アクションで呼び出したUserの loadRelationshipCounts メソッドの中で、リレーション microposts の件数をロードしたことより可能になっています。</p>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 text-sm space-y-2 leading-relaxed">
                <h5 class="font-bold text-blue-900 text-sm">📌 三項演算子</h5>
                <p><code>{{ Request::routeIs('users.show') ? 'tab-active' : '' }}</code> のような <code>(式1) ? (式2) : (式3)</code> の形式を三項演算子といいます。</p>
                <p>式1 が true なら 式2 、 式1 が false なら 式3 が値となります。</p>
                <p><code>{{ Request::routeIs('users.show') ? 'tab-active' : '' }}</code> は、リクエストされたルートが <code>users.show</code> の場合は <code>tab-active</code> という文字列を出力します。</p>
                <p>タブ部品は a 要素の class 属性に active クラスを付与することで、強調表示されて今開いているタブであることがわかりやすくなるため、このような記述にしています。</p>
                <p class="pt-1 text-xs">
                    参考: <a href="https://api.laravel.com/docs/9.x/Illuminate/Http/Request.html#method_routeIs" target="_blank" class="text-blue-600 underline font-mono">Request::routeIs - Laravel API</a><br>
                    参考: <a href="https://www.php.net/manual/ja/language.operators.comparison.php#language.operators.comparison.ternary" target="_blank" class="text-blue-600 underline font-mono">三項演算子 - PHP Manual</a>
                </p>
            </div>

            <div class="space-y-2 border-t pt-4">
                <p class="text-sm font-bold text-gray-800">show.blade.php</p>
                <p class="text-sm"><code>show.blade.php</code> に <code>{{-- タブ --}}@include('users.navtabs')</code> を追記して、 <code>resources/views/users/navtabs.blade.php</code> を読み込んで表示しています。</p>
                <p class="text-xs font-bold text-gray-500 italic">resources/views/users/show.blade.php</p>
                <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')
    &lt;div class="sm:grid sm:grid-cols-3 sm:gap-10"&gt;
        &lt;aside class="mt-4"&gt;
            {{-- ユーザ情報 --}}
            @include('users.card')
        &lt;/aside&gt;
        &lt;div class="sm:col-span-2 mt-4"&gt;
            {{-- タブ --}}  
            @include('users.navtabs')
            {{-- 投稿フォーム --}}
            @include('microposts.form')
            {{-- 投稿一覧 --}}
            @include('microposts.microposts')
        &lt;/div&gt;
    &lt;/div&gt;
@endsection</pre>
                <p class="text-xs text-gray-600"><code>{{-- タブ --}}</code> では、 <code>@include('users.navtabs')</code> を読み込んでいます。<code>@include('users.navtabs')</code> では、 <code>resources/views/users/navtabs.blade.php</code> を読み込んで表示しています。</p>
            </div>

            <div class="space-y-4 border-t pt-4">
                <p class="text-sm font-bold text-gray-800">followingsとfollowersのViewを作成</p>
                <ul class="list-disc pl-5 text-sm space-y-1 text-gray-600">
                    <li><code>resources/views/users/</code> フォルダに <code>followings.blade.php</code> ファイルを作成</li>
                    <li><code>resources/views/users/</code> フォルダに <code>followers.blade.php</code> ファイルを作成</li>
                </ul>

                <div class="space-y-1">
                    <p class="text-xs font-bold text-gray-800">followings</p>
                    <p class="text-xs text-gray-600"><code>resources/views/users/</code> フォルダに <code>followings.blade.php</code> ファイルを作成し、次のコードを記載してください。</p>
                    <p class="text-xs font-bold text-gray-500 italic">resources/views/users/followings.blade.php</p>
                    <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')
    &lt;div class="sm:grid sm:grid-cols-3 sm:gap-10"&gt;
        &lt;aside class="mt-4"&gt;
            {{-- ユーザ情報 --}}
            @include('users.card')
        &lt;/aside&gt;
        &lt;div class="sm:col-span-2 mt-4"&gt;
            {{-- タブ --}}
            @include('users.navtabs')
            &lt;div class="mt-4"&gt;
                {{-- ユーザ一覧 --}}
                @include('users.users')
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
@endsection</pre>
                </div>

                <div class="space-y-1 pt-2">
                    <p class="text-xs font-bold text-gray-800">followers</p>
                    <p class="text-xs text-gray-600"><code>resources/views/users/</code> フォルダに <code>followers.blade.php</code> ファイルを作成し、次のコードを記載してください。</p>
                    <p class="text-xs font-bold text-gray-500 italic">resources/views/users/followers.blade.php</p>
                    <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">@extends('layouts.app')

@section('content')
    &lt;div class="sm:grid sm:grid-cols-3 sm:gap-10"&gt;
        &lt;aside class="mt-4"&gt;
            {{-- ユーザ情報 --}}
            @include('users.card')
        &lt;/aside&gt;
        &lt;div class="sm:col-span-2 mt-4"&gt;
            {{-- タブ --}}
            @include('users.navtabs')
            &lt;div class="mt-4"&gt;
                {{-- ユーザ一覧 --}}
                @include('users.users')
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
@endsection</pre>
                </div>
                <p class="text-xs text-gray-600 bg-gray-50 p-2 rounded">この2つはまったく同じ内容ですが、将来的に表示内容を分けることもできるようにファイルを分割しています。</p>
            </div>
        </div>

        <div class="space-y-2 border-t pt-4">
            <h4 class="font-bold text-base text-gray-800">表示確認</h4>
            <p class="text-sm">Laravelの起動：</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow">npm run build
php artisan serve --host=127.0.0.1 --port=8080</pre>
        </div>

        <div class="space-y-2 pt-2">
            <p class="text-xs font-bold text-gray-500 italic">Git操作</p>
            <pre class="bg-gray-900 text-white p-5 rounded-lg font-mono text-sm shadow-md">git add -A
git commit -m "follow, unfollow"
git push origin main</pre>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}