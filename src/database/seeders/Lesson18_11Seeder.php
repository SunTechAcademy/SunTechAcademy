<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_11Seeder extends Seeder
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
                'sort_order' => 11,
            ],
            [
                'title' => 'タイムラインの表示',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">タイムラインの表示</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                X（旧Twitter）のトップのタイムラインページでは、自分がフォローしたユーザの投稿も表示されていますよね。<br>
                X（旧Twitter）クローンの最後の学習内容として、フォローしたユーザのマイクロポストも表示させる機能を追加します。
            </p>
            <p class="text-blue-600 font-bold">（参考）リクエストからレスポンスまでの流れを振り返っていただくと、理解しやすくなります。</p>
        </div>
        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl mt-4">
            <img src="/images/Lesson18-61.png" alt="Timeline Flow Diagram" class="w-full h-auto rounded border">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Userモデルに機能追加</h3>
        <p class="text-sm leading-relaxed">
            タイムライン用のマイクロポストを取得するためのメソッドを実装します。<code>public function is_following($userId)</code> の閉じタグ後に追記してください。
        </p>

        <div class="space-y-2">
            <p class="text-xs font-bold text-gray-500 italic">app/Models/User.php</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">class User extends Authenticatable
{
    // 中略

    /**
     * このユーザとフォロー中ユーザの投稿に絞り込む。
     */
    public function feed_microposts()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Micropost::whereIn('user_id', $userIds);
    }
}</pre>
        </div>

        <div class="bg-gray-50 p-5 rounded-lg border text-sm space-y-4 leading-relaxed text-gray-600">
            <p>
                <code class="bg-white px-1 border rounded text-blue-700">$this->followings()->pluck('users.id')->toArray();</code> ではUserがフォローしているUserの <strong>id</strong> の配列を取得しています。
            </p>
            <p>
                <strong>pluck()</strong> は引数として与えられたテーブルのカラムの値だけを抜き出す命令です。
            </p>
            <p>
                そしてさらに <strong>toArray()</strong> を実行して、通常の配列に変換しています。
            </p>
            <p>
                次に <code class="bg-white px-1 border rounded text-blue-700">$userIds[] = $this->id;</code> で自分の <strong>id</strong> も追加しています。自分自身のマイクロポストも表示させるためです。
            </p>
            <p>
                最後に <code class="bg-white px-1 border rounded text-blue-700">return Micropost::whereIn('user_id', $userIds);</code> で、 <code>microposts</code> テーブルのデータのうち <code>$userIds</code> 配列のいずれかの値と合致する <code>user_id</code> を持つものに絞り込んで値を返します。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">MicropostsController@index</h3>
        
        <div class="space-y-4">
            <h4 class="font-bold text-base text-gray-800">Controller</h4>
            <p class="text-sm">先ほど User モデルに追加した <code>feed_microposts()</code> を使うように変更します。</p>
            
            <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/MicropostsController.php（indexアクションの部分のみ抜粋）</p>
            <pre class="bg-gray-800 text-gray-200 p-4 rounded-lg font-mono text-xs overflow-x-auto">    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザとフォロー中ユーザの投稿の一覧を作成日時の降順で取得
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }</pre>
            
            <p class="text-sm bg-blue-50 p-3 rounded border border-blue-100 text-blue-900">
                💡 <code>$user->microposts()</code> としていた部分を <strong><code>$user->feed_microposts()</code></strong> に変更しています。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">最終確認</h3>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                View（dashboardの画面）では、すでに、投稿一覧が表示されるように作成していました。先ほどの修正により、自分の投稿しか表示されていなかったのが、自分とフォローしたユーザの投稿が一覧で表示されるようになっています。
            </p>
        </div>

        <div class="space-y-4 mt-6">
            <h4 class="font-bold text-base text-gray-800">表示確認</h4>
            <p class="text-sm">表示確認をしてみましょう。</p>
            <p class="text-xs font-bold text-gray-500 italic">Laravelの起動</p>
            <pre class="bg-gray-900 text-green-400 p-4 rounded font-mono text-xs shadow-lg leading-relaxed">npm run build
php artisan serve --host=127.0.0.1 --port=8080</pre>
        </div>

        <div class="space-y-4 pt-6">
            <p class="text-xs font-bold text-gray-500 italic">Gitコマンド</p>
            <pre class="bg-gray-800 text-white p-5 rounded-lg font-mono text-sm shadow-md">git add -A
git commit -m "timeline"
git push origin main</pre>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}