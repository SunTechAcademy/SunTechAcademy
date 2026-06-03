<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_12Seeder extends Seeder
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
                'sort_order' => 12,
            ],
            [
                'title' => 'お気に入り機能',
                'is_assignment' => 1,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">お気に入り機能</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                次の課題で「Micropostをお気に入りに追加する」機能を作成します。「フォロー／フォロワー」機能で学んだ「多対多」の関係を活用しますが、ここであらためて「多対多の関係」ならびに「本課題のヒント」について解説します。<br>
                （参考）リクエストからレスポンスまでの流れを振り返っていただくと、理解しやすくなります。
            </p>
        </div>
        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl mt-4">
            <img src="/images/Lesson18-62.png" alt="Lesson18-62.png" class="w-full h-auto rounded border">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">お気に入り機能を構築するうえでのヒント</h3>
        
        <div class="space-y-4">
            <h4 class="font-bold text-base text-gray-800">「ユーザ」と「お気に入り投稿」の関係は多対多</h4>
            <p class="text-sm leading-relaxed">
                投稿機能のときに見たUserとMicropostの関係、つまり「ユーザ」と「ユーザが投稿した内容」の関係は一対多でした。1人のUserは複数のMicropostを持てるものの、1つのMicropostが所属するUserはたった1人です。このような関係は一対多になります。<br>
                しかし今回のUserとMicropostの関係は異なります。下の図を見てください。
            </p>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl my-4">
                <img src="/images/Lesson18-63.png" alt="Lesson18-63.png" class="w-full h-auto rounded border">
            </div>
            <p class="text-sm leading-relaxed">
                ここで考えるUserとMicropostの関係は「ユーザ」と「ユーザがお気に入りに追加した 投稿内容」の関係です。<br>
                X（旧Twitter）クローンのWebアプリケーションには多くのユーザが多くの投稿をしています。1人のユーザが複数の投稿内容をお気に入りに追加する、ということもできますし、1つの投稿内容が複数のユーザからお気に入りに追加される可能性もあります。<br>
                よって、「ユーザ」と「ユーザがお気に入りに追加した投稿内容」という関係で見たときのUserとMicropostは 多対多 になるのです。
            </p>
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-base text-gray-800">多対多の関係では中間テーブルを用意する必要がある</h4>
            <p class="text-sm leading-relaxed">
                ユーザのフォロー機能で学んだように、多対多の関係では 中間テーブル を用意します。今回作りたい機能がお気に入り機能であるため、テーブル名は favorites のような名前で良いでしょう。<br>
                中間テーブルには、お馴染みの id や timestamps() の他、関係するテーブルのIDを格納するカラムが2つ必要です。<br>
                今回はUserとMicropostの関係なので user_id と micropost_id を追加しましょう。<br>
                先ほどの図にある中間テーブルでは左側が user_id、右側が micropost_id になります。<br>
                たとえば [ 1 | 2 ] となっているレコードは「user_id が1のユーザは micropost_id が2の投稿内容をお気に入りに追加した」もしくは「micropost_id が2の投稿内容は user_id が1のユーザからお気に入りに追加された」という意味合いになります。<br>
                他にも、user_id と micropost_id のそれぞれに外部キー制約をつけたり、user_id と micropost_id の組み合わせの重複を許さない制約をつけたりする必要があるでしょう。<br>
                以上の内容でマイグレーション用のファイルを作成し、マイグレーションを実行してください。
            </p>
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-base text-gray-800">ユーザが追加したお気に入りの数と一覧を取得する機能の構築</h4>
            <p class="text-sm leading-relaxed">
                ここではお気に入りを追加・削除する機能だけでなく「あるユーザが追加したお気に入りの一覧と数」を取得してもらいたいと思います。<br>
                お気に入りの一覧を取得する機能はUserモデルに favorites() のような名前の関数を用意し、belongsToMany() を指定すると良いでしょう。<br>
                また、お気に入りの数については、 User クラスの中で loadCount メソッドに指定しているリレーション名に 'favorites' も追加し、件数を取得できるようにすると良いでしょう。<br>
                なお、多対多の関係を正確に記述するため、Micropostモデルにも favorite_users() のような名前の関数を用意して belongsToMany() を指定してください。
            </p>
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-base text-gray-800">お気に入りに関するアクションとビューの作成</h4>
            <p class="text-sm leading-relaxed mb-2">お気に入りに関する機能としては、以下の内容が必要です。</p>
            <ol class="list-decimal list-inside text-sm space-y-2 pl-2">
                <li>ユーザが追加したお気に入りを一覧表示するページ</li>
                <li>ユーザが特定の投稿内容をお気に入りに追加する機能</li>
                <li>ユーザがお気に入りを削除する機能</li>
            </ol>

            <div class="mt-6 space-y-6">
                <div>
                    <h5 class="font-bold text-sm text-gray-900 mb-1">【ユーザが追加したお気に入りを一覧表示するページ】</h5>
                    <p class="text-sm leading-relaxed">
                        1はUserモデルの favorites() から一覧の取得ができるのでUsersControllerにアクションを追加すれば良いでしょう。Viewの作成も必要です。部品化したbladeファイルを利用しましょう。また、ナビゲーションタブに1つタブを追加し、FollowingsやFollowersと同じように「お気に入り一覧へのリンク」と「お気に入りの数」を表示してください。
                    </p>
                </div>

                <div>
                    <h5 class="font-bold text-sm text-gray-900 mb-1">【ユーザが特定の投稿内容をお気に入りに追加する機能 および ユーザがお気に入りを削除する機能】</h5>
                    <p class="text-sm leading-relaxed">
                        2と3については中間テーブルを操作することになるため、FavoritesControllerのような名前のControllerを新規作成し、そこに該当のアクションを追加してください。データの登録／削除をするアクションとなるため、Viewは不要です（back() で戻ればOKです）。実際の中間テーブルへのデータ登録／削除はUserモデルに favorite() や unfavorite() のような名前の関数を作成して、そこに構築してください。その際、すでにお気に入りに追加しているMicropostかどうかを調べる処理が必要です。
                    </p>
                    <p class="text-sm leading-relaxed mt-2">
                        ルーティングの設定も忘れないようにしましょう。今回の場合、URLで渡したいIDはMicropostのIDになるため、以下のようにフォロー／フォロワーのものとは違う新しいGroupをauthグループの中に用意すると良いでしょう。
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-2 pt-4">
            <p class="text-xs font-bold text-gray-500 italic">サンプルコード</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');            // 追加
    });
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);

    Route::group(['prefix' => 'microposts/{id}'], function () {                                             // 追加
        Route::post('favorites', [FavoritesController::class, 'store'])->name('favorites.favorite');        // 追加
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('favorites.unfavorite'); // 追加
    });                                                                                                     // 追加
});</pre>
        </div>

        <p class="text-sm leading-relaxed pt-2">
            あとは投稿一覧の各投稿のところに favorite や unfavorite のボタンを設置すればOKです。
        </p>

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 space-y-2 mt-6">
            <h4 class="font-bold text-sm text-blue-900">最後に</h4>
            <p class="text-sm leading-relaxed text-blue-800">
                ヒントの説明は以上です。これでもまだ難しいかもしれませんが フォロー／フォロワー機能で作成したソースコードは非常に参考になります。ぜひ頑張って「お気に入り機能」の構築に取り組んでみてください！
            </p>
        </div>
    </section>

    <section class="space-y-6 bg-red-50/30 p-6 rounded-xl border border-red-200">
        <h3 class="text-xl font-bold text-red-800 border-b border-red-200 pb-2">課題：課題Micropostにお気に入り機能を追加しよう</h3>
        <p class="text-sm font-medium text-gray-800">Micropostのお気に入り機能を追加してください。</p>
        
        <div class="space-y-3">
            <p class="text-sm font-bold text-gray-800">以下に、仕様を述べます。</p>
            <ul class="list-disc list-inside text-sm space-y-3 pl-2 leading-relaxed text-gray-700">
                <li>特定のMicropostを、ログインユーザがお気に入りリストに追加できるようにボタンを設置してください。なお、そのボタンは、すでにお気に入りに追加したものに対しては、お気に入りを削除するボタンとなるように工夫してください。</li>
                <li>「登録されているUserがお気に入りに追加したMicropostを一覧表示するページ」を、ユーザー詳細ページのページタブに追記してください。</li>
                <li>トップページ もしくは ナビゲーションバー のどちらか一方からで良いので、前述のお気に入り一覧ページにアクセスできるようにリンクを作成してください。</li>
            </ul>
        </div>

        <div class="space-y-4 pt-4">
            <p class="text-sm text-gray-700">下記は参考資料として用意したイメージ図です。赤枠部分を参考に作成ください。</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="border rounded p-2 bg-white shadow-sm"><img src="/images/Lesson18-64.png" alt="Lesson18-64.png" class="w-full h-auto"></div>
                <div class="border rounded p-2 bg-white shadow-sm"><img src="/images/Lesson18-65.png" alt="Lesson18-65.png" class="w-full h-auto"></div>
                <div class="border rounded p-2 bg-white shadow-sm"><img src="/images/Lesson18-66.png" alt="Lesson18-66.png" class="w-full h-auto"></div>
            </div>
            <p class="text-xs text-gray-500 italic mt-2">
                （お気に入りボタンと投稿内容の削除（赤いDelete）ボタンは横並びにしなくても構いませんが、GridやFlexboxを利用すると上手く横並びになります。）
            </p>
        </div>

        <div class="space-y-4 pt-6 border-t border-red-200">
            <p class="text-sm leading-relaxed">
                GitHubにプッシュしてそのプッシュしたGitHubのMiclopostリポジトリを講師に共有してください。
            </p>
            <p class="text-sm leading-relaxed">
                Fly.io にデプロイしてください。Fly.io 上のアプリケーションに対してもマイグレーションや動作確認を忘れないようにしてください。
            </p>
            <p class="text-sm leading-relaxed">
                すでにFly.ioにデプロイしているアプリケーションがある場合は削除してください。本課題のアプリケーションをデプロイする際は、Fly.ioとSupabaseの管理画面で、タスク管理のデプロイ時に登録されたアプリケーションやデータベースを削除したうえで、このアプリのデプロイを進めてください。
            </p>
            <p class="text-sm leading-relaxed">
                Fly.ioにクレジットカードを登録して無料の範囲内でデプロイできる数を増やすこともできますが、その場合は課金の発生にご注意ください。現在の利用状況は、Fly.ioの「Billing」ページで確認できます（要ログイン）。
            </p>
            <p class="text-sm font-bold text-blue-700 bg-white p-3 rounded border border-blue-100 shadow-sm">
                Billingページを確認する際は、コチラをクリックしてください。<br>
                （<a href="https://fly.io/app/sign-in?return_to=%2Fdashboard%2Fpersonal%2Fbilling" target="_blank" class="underline hover:text-blue-900 break-all">https://fly.io/app/sign-in?return_to=%2Fdashboard%2Fpersonal%2Fbilling</a>）
            </p>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}