<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_6Seeder extends Seeder
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
                'sort_order' => 6,
            ],
            [
                'title' => '認証機能の仕組み',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">認証機能の仕組み</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                今回、Laravel Breezeを利用して認証機能を実装しました。<br>
                実務でもLaravel Breezeを利用して認証機能を実装しますが、認証処理がどのような流れで進んでいるかを解説します。
            </p>
            <p>
                Laravel Breeze以外のライブラリを利用する場合もコマンドだけで機能が完成することがあります。<br>
                機能を構築している関数ひとつひとつに対する深い理解は必要ありませんが、処理の流れを把握することでスキルアップになりおすすめです。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">ログインの仕組み</h3>
        <p class="text-sm leading-relaxed">
            機能として用意されているとはいえ、「一般的にWebアプリへのログインはどのような仕組みになっているか」を簡単にでも知っておくと、Laravelでのログイン機能の構築に関する理解が深まります。<br>
            ここでは、ログインというものが、ブラウザと Web アプリの間でどのように実現されているかを解説します。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">HTTP はステートレスな通信</h4>
            <p class="text-sm leading-relaxed">
                まず、前提として、HTTP はステートレスな通信だということを知っておきましょう。ステートレスとは、ステート（状態）がレス（無い）ということで、状態を維持しないということです。HTTP は以前の通信を全く覚えないと言い換えることもできます。
            </p>
            <p class="text-sm leading-relaxed">
                ステートレスな通信として例え話をします。ハンバーガーショップでの、客と店員のやりとりを考えてみましょう。
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-4">
                <div class="bg-green-50 border border-green-200 rounded-xl p-6 space-y-3 shadow-sm">
                    <h5 class="font-bold text-green-900 text-sm border-b border-green-200 pb-1">【ステートフル（状態を維持する）な会話の場合】</h5>
                    <div class="text-xs space-y-2 font-mono text-green-800 leading-relaxed">
                        <p><strong>店員：</strong>「ご注文をどうぞ」</p>
                        <p><strong>客：</strong>「ハンバーガーセットをお願いします」</p>
                        <p><strong>店員：</strong>「サイドメニューは何になさいますか？」</p>
                        <p><strong>客：</strong>「ポテトで」</p>
                        <p><strong>店員：</strong>「ドリンクは何になさいますか？」</p>
                        <p><strong>客：</strong>「コーラで」</p>
                        <p><strong>店員：</strong>「+50円でドリンクをLサイズにできますがいかがですか？」</p>
                        <p><strong>客：</strong>「Mでいいです」</p>
                        <p><strong>店員：</strong>「以上でよろしいですか？」</p>
                        <p><strong>客：</strong>「はい」</p>
                        <p><strong>店員：</strong>「かしこまりました」</p>
                    </div>
                    <p class="text-xs text-green-900 leading-relaxed pt-2">
                        客の要望は店員に伝わっているため、このような会話で以下のような情報が店員に伝わっています。<br>
                        ・注文はハンバーガーセット<br>
                        ・サイドメニューはポテト<br>
                        ・ドリンクはコーラ<br>
                        ・ドリンクのサイズはM<br>
                        人と人との会話ではステートフルなのが基本です。
                    </p>
                </div>

                <div class="bg-orange-50 border border-orange-200 rounded-xl p-6 space-y-3 shadow-sm">
                    <h5 class="font-bold text-orange-900 text-sm border-b border-orange-200 pb-1">【ステートレス（状態を維持しない）な会話の場合】</h5>
                    <div class="text-xs space-y-2 font-mono text-orange-800 leading-relaxed">
                        <p><strong>店員：</strong>「ご注文をどうぞ」</p>
                        <p><strong>客：</strong>「ハンバーガーセットをお願いします</p>
                        <p><strong>店員：</strong>「サイドメニューは何になさいますか？」</p>
                        <p><strong>客：</strong>「ハンバーガーセットをポテトで」</p>
                        <p><strong>店員：</strong>「ドリンクは何になさいますか？」</p>
                        <p><strong>客：</strong>「ハンバーガーセットをポテトとコーラで」</p>
                        <p><strong>店員：</strong>「+50円でドリンクをLサイズにできますがいかがですか？」</p>
                        <p><strong>客：</strong>「ハンバーガーセットをポテトとコーラ(M)で」</p>
                        <p><strong>店員：</strong>「以上でよろしいですか？」</p>
                        <p><strong>客：</strong>「ハンバーガーセットをポテトとコーラ(M)で。以上です。」</p>
                        <p><strong>店員：</strong>「かしこまりました」</p>
                    </div>
                    <p class="text-xs text-orange-900 leading-relaxed pt-2">
                        客が何度も同じ事を繰り返し言っています。これは、店員がステートレスなせいで、毎回言ってあげないと忘れてしまうからです。<br>
                        その割に、店員の会話が進展しているのは、客が一言にどこまで含めているかを毎回確認しているからです。セットメニューとサイドメニューの名前を言っても、ドリンクの名前がなければ、店員は「ドリンクは何になさいますか？」と尋ねることになります。
                    </p>
                </div>
            </div>

            <p class="text-sm leading-relaxed mt-4">
                HTTP 通信の実態も、まさに、このような形です。置き換える場合、<strong>客がブラウザ</strong>であり、<strong>店員がサーバ（Webアプリ）</strong>となります。
            </p>
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">ログインの仕組み</h4>
            <p class="text-sm leading-relaxed">
                HTTP はステートレスなので、ログインを維持するのは HTTP という通信内ではありません。ログイン情報は、ブラウザ内部と、サーバ（Webアプリ）内部で保存されることになっていて、以下の流れでログインの有無を判定します。
            </p>
            <ol class="list-decimal pl-5 text-sm space-y-2 text-gray-600">
                <li>ブラウザが保存しているログイン情報を、ブラウザがサーバにアクセスするたびに毎回 HTTP で送受信します。</li>
                <li>サーバ側はブラウザからのアクセスがあるたびに、受け取ったブラウザからのログイン情報を毎回自分（サーバ）の持っているログイン情報と照合します。</li>
                <li>照合した結果で、ログインされているかを判定します。</li>
            </ol>
            <p class="text-sm leading-relaxed">
                このとき、ブラウザが持っているログイン情報は <strong>Cookie</strong> として保存され、サーバが持っているログイン情報は <strong>Session</strong> として保存されます。つまり、Cookie はブラウザ側の情報保管所で、Session はサーバ側の情報保管所だと思ってください。<br>
                ログインしているかどうかは、お互いを照合できる情報が、ブラウザの Cookie とサーバの Session に保存されているかどうかで決まります。
            </p>
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-base text-gray-800 border-l-2 border-gray-400 pl-2">SunTechAcademyのログイン情報</h4>
            <p class="text-sm leading-relaxed">
                SunTechAcademyもログイン情報を扱っているので、当然ブラウザの Cookie にログイン情報を保存しています。
            </p>
            <p class="text-sm mb-2">Google Chrome ブラウザを使用している場合、以下の手順で、皆さんの Google Chrome に保存された Cookie 一覧を確認することができます。</p>
            
            <div class="bg-gray-50 p-4 border rounded-lg text-sm space-y-1">
                <p><strong>１．</strong>ディベロッパーツールの [アプリケーション] タブを選択してください。</p>
                <p><strong>２．</strong>左のメニューで [ストレージ] > [Cookie] を選択してください。</p>
            </div>

            <p class="text-sm leading-relaxed">
                <a href="https://suntechacademy.fly.dev" target="_blank" class="text-blue-600 underline font-mono">https://suntechacademy.fly.dev</a> の Cookie を見てください。いくつか保存されていますが、以下のように<code>suntechacademy-session</code>と入力してみましょう。こちらが、保存されたログイン情報です。当然暗号化されているので、ぱっと見ただけではどのような形でログイン情報を記録しているのかはわかりません。
            </p>

            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-2xl">
                <img src="/images/Lesson18-33.png" alt="Cookie Session Check" class="w-full h-auto rounded border">
            </div>

            <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-xs text-red-800 leading-relaxed font-bold">
                ⚠️ この値はプライベートな値なので、他人に漏らさないようにしてください。暗号化されているとはいえ、この値が漏れると、他人に自分のアカウントが乗っ取られる可能性があります。充分ご注意ください。
            </div>

            <p class="text-sm leading-relaxed">
                他のサイトの Cookie を確認するのも面白いでしょう。また、 X（旧Twitter） クローンのログイン機能を実装したあとに、自分のブラウザの Cookie を調べてみるのも良いでしょう。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Auth</h3>
        <p class="text-sm leading-relaxed">
            Laravel Breezeインストール後に、どのURLにアクセスしたら、どのControllerの処理を実行するかという route 処理が、 <code>auth.php</code> に自動生成されています。<br>
            この段階では、 <code>auth.php</code> の細かい処理自体を理解する必要はありません。
        </p>
        <p class="text-xs font-bold text-gray-500 italic">routes/auth.phpファイル</p>
        <pre class="bg-gray-100 p-4 rounded-lg font-mono text-xs border overflow-x-auto">&lt;?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});</pre>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">ユーザ登録の仕組み</h3>
        <p class="text-sm leading-relaxed">
            ここではLaravel Breezeで行われているユーザ登録を解説します。<br>
            まずはそういうものだと納得して、使い方を覚えるようにしてください。しくみを理解せずとも使い方さえわかれば、Webアプリケーションを作ることは充分できます。Lessonとしては、Laravel Breezeのインストールと初期設定を完了して、Laravel Breezeを利用したユーザー登録ができれば問題ありません。
        </p>

        <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg text-xs leading-relaxed text-blue-900">
            💡 しくみは一切知る必要がないという提言ではなく、学習には段階があるということです。まずは使い方を知って、充分に慣れたらし組みを知る段階に入れば良いのです。Laravelの使い方をマスターしたのちに興味があれば、フレームワークのコア部分のソースコードを読み解けば良いように上手く設計されているのです。
        </div>

        <p class="text-sm leading-relaxed">
            自動販売機の裏側のしくみを詳しく知らなくても、飲み物を買うことができることと同じ要領です。<br>
            <span class="text-blue-600 font-bold">（参考）リクエストからレスポンスまでの流れを振り返っていただくと、理解しやすくなりおすすめです。</span>
        </p>

        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-2xl">
            <img src="/images/Lesson18-34.png" alt="Request Response Flow Review" class="w-full h-auto rounded border">
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-base text-gray-800">ユーザー登録で利用されているファイル</h4>
            <p class="text-sm">ユーザー登録の処理は次の流れで行われます。</p>
            <ol class="list-decimal pl-5 text-xs font-mono space-y-1 text-gray-600 bg-gray-50 p-4 rounded border w-max">
                <li>routes/auth.php</li>
                <li>app/Http/Controllers/Auth/RegisteredUserController.php</li>
                <li>resources/views/auth/register.blade.php</li>
                <li>app/Http/Controllers/Auth/RegisteredUserController.php</li>
                <li>routes/auth.php</li>
            </ol>
            <p class="text-sm leading-relaxed">
                トップページの右上に表示されている <strong>Register</strong> をクリックすると、 <code>register</code> というURLに遷移して、ユーザ登録画面が表示されます。
            </p>

            <div class="space-y-4 mt-4">
                <p class="text-xs font-bold text-gray-500 italic">routes/auth.php（Register抜粋）</p>
                <pre class="bg-gray-100 p-4 rounded text-xs font-mono border">Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);</pre>
                <p class="text-sm leading-relaxed">
                    ここでは、ログインしていないユーザが <code>register</code> というURLに遷移した場合、 <code>RegisteredUserController</code> の <code>create</code> メソッドが実行されることがわかります。<br>
                    <code>RegisteredUserController</code> は、 <code>app/Http/Controllers/Auth/RegisteredUserController.php</code> に存在します。
                </p>

                <p class="text-xs font-bold text-gray-500 italic">resources/views/auth/register.blade.php（抜粋）</p>
                <pre class="bg-gray-100 p-4 rounded text-xs font-mono border">@section('content')

    &lt;div class="prose mx-auto text-center"&gt;
        &lt;h2&gt;Sign up&lt;/h2&gt;
    &lt;/div&gt;

    &lt;div class="flex justify-center"&gt;
        &lt;form method="POST" action="{{ route('register') }}" class="w-1/2"&gt;</pre> <p class="text-sm leading-relaxed">
                    <code>&lt;form method="POST" action="{{ route('register') }}" class="w-1/2"&gt;</code> の <code>{{ route('register') }}</code> が、 <code>method="POST"</code> で送信され、 <code>RegisteredUserController.php</code> の <code>store()</code> メソッドが実行されます。
                </p>

                <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/Auth/RegisteredUserController.php（抜粋）</p>
                <pre class="bg-gray-100 p-4 rounded text-xs font-mono border">    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }</pre>
                <p class="text-sm leading-relaxed">
                    <code>RegisteredUserController.php</code> の <code>store()</code> メソッドでは、上から順番にユーザー登録処理が行われることで、ユーザー登録が完了します。
                </p>
                <ul class="list-none pl-4 space-y-1 text-sm border-l-2 border-blue-500">
                    <li>1. <strong>バリデーション処理</strong>（validateメソッドを利用）</li>
                    <li>2. <strong>ユーザー作成処理</strong>（User::createモデルを利用）</li>
                    <li>3. <strong>ユーザー登録処理</strong>（event関数を実行）</li>
                    <li>4. <strong>自動的ログイン処理</strong>（Auth::login($user);）</li>
                    <li>5. <strong>トップページにリダイレクト</strong>（redirect関数を利用）</li>
                </ul>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
            <h4 class="font-bold text-sm text-gray-800">（参考）event(new Registered($user));</h4>
            <p class="text-xs text-red-600 font-bold italic">⚠️ この内容は参考資料のため実際に操作しないでください。</p>
            <p class="text-xs leading-relaxed">
                <code>event(new Registered($user));</code> で利用されている <code>Registered</code> は、 <code>app/Providers/EventServiceProvider.php</code>にある、 <code>Registered::class</code> です。<br>
                <code>Registered::class</code> が実行されると、 <code>SendEmailVerificationNotification::class</code> が実行されます。<br>
                <code>SendEmailVerificationNotification::class</code> は、登録したユーザのメールが正しいものか確認するメール認証を行なうクラスです。<br>
                実際にここではメール認証は行われず、ユーザー登録が完了しています。<br>
                どちらのクラスも次のように <code>use</code> で宣言されているように、 <code>Illuminate</code> フォルダ内から呼び出されています。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">サンプルコード</p>
            <pre class="bg-gray-800 text-gray-200 p-3 rounded font-mono text-xs">use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;</pre>
            <p class="text-xs leading-relaxed text-gray-600">
                <code>Illuminate</code> フォルダは、 <code>vendor/laravel/framework/src/Illuminate</code> という <code>vendor</code> フォルダ内に存在するフォルダです。<br>
                <span class="text-red-600 font-bold">学習段階で vendor フォルダ内のファイルやフォルダを手動で修正するとプログラムが動作しなくなるため絶対に触れないでください。</span>
            </p>
            <p class="text-xs font-bold text-gray-500 italic">app/Providers/EventServiceProvider.php（抜粋）</p>
            <pre class="bg-gray-800 text-gray-200 p-3 rounded font-mono text-xs">class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array&lt;class-string, array&lt;int, class-string&gt;&gt;
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];
}</pre>
            <p class="text-xs mt-4 font-bold text-gray-600">ここまでをシーケンス図で表すと以下のようになります。</p>
            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                <img src="/images/Lesson18-35.png" alt="Register Sequence Diagram" class="w-full h-auto rounded border">
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
            <h4 class="font-bold text-sm text-gray-800">（参考）メール認証を行なう場合</h4>
            <p class="text-xs text-red-600 font-bold italic">⚠️ この内容は参考資料のため実際に操作しないでください。</p>
            <p class="text-xs font-bold text-gray-500 italic">app/Models/User.php（抜粋）初期状態</p>
            <pre class="bg-gray-800 text-gray-300 p-3 rounded font-mono text-xs overflow-x-auto">&lt;?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{</pre>
            <p class="text-xs text-gray-600">
                1. コメントアウトされている <code>use Illuminate\Contracts\Auth\MustVerifyEmail;</code> を有効にする。<br>
                2. <code>class User extends Authenticatable</code> に <code>implements MustVerifyEmail</code> を追記する。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">修正後のUser.php（抜粋）</p>
            <pre class="bg-gray-800 text-gray-300 p-3 rounded font-mono text-xs overflow-x-auto">&lt;?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // 追記
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail // 追記
{</pre>
        </div>

        <div class="space-y-4 pt-2">
            <h4 class="font-bold text-base text-gray-800">ファサードについて</h4>
            <p class="text-sm leading-relaxed">
                ファサードとは、各クラスのメソッドを、クラスのインスタンスを作らなくてもstaticメソッドとして利用できるようにし、使いやすくしたものです。<br>
                また、そのファサードを、さらに使いやすいようにグローバールの名前空間（\）で扱えるようにしたものがエイリアスです。<br>
                ファサードは、 <code>vendor/laravel/framework/src/Illuminate/Support/Facades</code>フォルダ内 で定義されています。<br>
                例えば、 <code>Auth</code> ファサードは、 <code>vendor/laravel/framework/src/Illuminate/Support/Facades/Auth.php</code> で定義されています。
            </p>
            <p class="text-sm leading-relaxed">
                中でも、 <code>Auth</code>ファサードは認証に関する一連のメソッドを提供しています。<br>
                例えば、 <code>Auth::check()</code> は、ユーザがログインしているかどうかを調べるための関数です。<br>
                また、 <code>Auth::user()</code> を利用するとログイン中のユーザを取得できます。
            </p>
            <p class="text-xs text-gray-500">
                参考: ファサードLaravel 9.x：<a href="https://readouble.com/laravel/9.x/ja/facades.html" target="_blank" class="text-blue-600 underline font-mono">https://readouble.com/laravel/9.x/ja/facades.html</a></p>
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">ログイン処理の仕組み</h3>
        <p class="text-sm leading-relaxed">
            ここではLaravel Breezeで行われているログイン処理を解説します。<br>
            まずはログインできるものだと納得して、使い方を覚えるようにしてください。しくみを理解せずとも使い方さえわかれば、Webアプリケーションを作ることは充分できます。Lessonとしては、Laravel Breezeのインストールと初期設定を完了して、Laravel Breezeを利用したログイン処理ができれば問題ありません。
        </p>

        <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg text-xs leading-relaxed text-blue-900">
            💡 しくみは一切知る必要がないという提言ではなく、学習には段階があるということです。まずは使い方を知って、充分に慣れたらし組みを知る段階に入れば良いのです。Laravelの使い方をマスターしたのちに興味があれば、フレームワークのコア部分のソースコードを読み解けば良いように上手く設計されているのです。
        </div>

        <p class="text-sm leading-relaxed">
            自動販売機の裏側のしくみを詳しく知らなくても、飲み物を買うことができることと同じ要領です。<br>
            <span class="text-blue-600 font-bold">（参考）リクエストからレスポンスまでの流れを振り返ると、理解しやすくなります。</span>
        </p>

        <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-2xl">
            <img src="/images/Lesson18-36.png" alt="Login Flow Diagram Review" class="w-full h-auto rounded border">
        </div>

        <div class="space-y-4 pt-4">
            <h4 class="font-bold text-base text-gray-800">ログイン処理で利用されているファイル</h4>
            <p class="text-sm">ログイン処理は次の流れで行われます。</p>
            <ol class="list-decimal pl-5 text-xs font-mono space-y-1 text-gray-600 bg-gray-50 p-4 rounded border w-max">
                <li>routes/auth.php</li>
                <li>app/Http/Controllers/Auth/AuthenticatedSessionController.php</li>
                <li>resources/views/auth/login.blade.php</li>
                <li>app/Http/Controllers/Auth/AuthenticatedSessionController.php</li>
                <li>routes/auth.php</li>
            </ol>
            <p class="text-sm leading-relaxed">
                トップページの右上に表示されている <strong>log in</strong> をクリックすると、 <code>login</code> というURLに遷移して、ユーザ登録画面が表示されます。<br>
                <code>routes/auth.php</code> には次の内容が記載されています。
            </p>

            <div class="space-y-4 mt-4">
                <p class="text-xs font-bold text-gray-500 italic">routes/auth.php（Register抜粋）</p>
                <pre class="bg-gray-100 p-4 rounded text-xs font-mono border">    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);</pre>
                <p class="text-sm leading-relaxed">
                    <code>Route::get('login', [AuthenticatedSessionController::class, 'create'])-&gt;name('login');</code> では、 ログインしていないユーザーが <code>login</code> というURLに遷移した場合、 <code>AuthenticatedSessionController</code> の <code>create</code> メソッドが実行されることがわかります。
                </p>

                <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/Auth/AuthenticatedSessionController.php（抜粋）</p>
                <pre class="bg-gray-100 p-4 rounded text-xs font-mono border">    public function create()
    {
        return view('auth.login');
    }</pre>
                <p class="text-sm leading-relaxed">
                    <code>create()</code> メソッドでは、 <code>auth.login</code> を返しています。<br>
                    <code>auth.login</code> は、 <code>resources/views/auth/login.blade.php</code> です。
                </p>

                <p class="text-xs font-bold text-gray-500 italic">resources/views/auth/login.blade.php（抜粋）</p>
                <pre class="bg-gray-100 p-4 rounded text-xs font-mono border">@extends('layouts.app')

@section('content')

    &lt;div class="prose mx-auto text-center"&gt;
        &lt;h2&gt;Log in&lt;/h2&gt;
    &lt;/div&gt;

    &lt;div class="flex justify-center"&gt;
        &lt;form method="POST" action="{{ route('login') }}" class="w-1/2"&gt;</pre> <p class="text-sm leading-relaxed">
                    <code>&lt;form method="POST" action="{{ route('login') }}" class="w-1/2"&gt;</code> の <code>{{ route('login') }}</code> が、 <code>method="POST"</code> で送信され、 <code>AuthenticatedSessionController.php</code> の <code>store()</code> メソッドが実行されます。
                </p>

                <p class="text-xs font-bold text-gray-500 italic">app/Http/Controllers/Auth/AuthenticatedSessionController.php（抜粋）</p>
                <pre class="bg-gray-100 p-4 rounded text-xs font-mono border">    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }</pre>
                <p class="text-sm leading-relaxed">
                    ・<code>$request->authenticate()</code> でログイン処理を行っています。<br>
                    ・<code>$request->session()->regenerate();</code> でログインユーザーのセッション処理を行っています。<br>
                    ・<code>return redirect()->intended(RouteServiceProvider::HOME);</code> で、トップページ移動しています。
                </p>
                
                <p class="text-xs mt-4 font-bold text-gray-600">シーケンス図で表すと以下のようになります。</p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner max-w-xl">
                    <img src="/images/Lesson18-37.png" alt="Login Sequence Diagram" class="w-full h-auto rounded border">
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
            <h4 class="font-bold text-sm text-gray-800">（参考）$request->authenticate()</h4>
            <p class="text-xs text-red-600 font-bold italic">⚠️ この内容は参考資料のため実際に操作しないでください。</p>
            <p class="text-xs leading-relaxed">
                <code>authenticate()</code> メソッドで実際のログイン処理を行っています。<br>
                <code>authenticate()</code> メソッドは、 <code>app/Http/Requests/Auth/LoginRequest.php</code> にあります。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">LoginRequest.php（抜粋）</p>
            <pre class="bg-gray-800 text-gray-300 p-3 rounded font-mono text-xs overflow-x-auto">    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }</pre>
            <p class="text-xs leading-relaxed">
                <code>Auth::attempt</code> を利用した、 <code>if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) { RateLimiter::hit($this->throttleKey());</code> でログイン処理を行っています。<br>
                Auth ファサードの仕様については次のページも参考にしてください。
            </p>
            <p class="text-xs text-gray-500">
                AuthManager：<a href="https://api.laravel.com/docs/9.x/Illuminate/Auth/AuthManager.html" target="_blank" class="text-blue-600 underline font-mono">https://api.laravel.com/docs/9.x/Illuminate/Auth/AuthManager.html</a>
            </p>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
            <h4 class="font-bold text-sm text-gray-800">（参考）失敗時の処理</h4>
            <p class="text-xs text-red-600 font-bold italic">⚠️ この内容は参考資料のため実際に操作しないでください。</p>
            <p class="text-xs font-bold text-gray-500 italic">LoginRequest.php（抜粋）</p>
            <pre class="bg-gray-800 text-gray-300 p-3 rounded font-mono text-xs overflow-x-auto">throw ValidationException::withMessages([
    'email' => trans('auth.failed'),
]);</pre>
            <p class="text-xs leading-relaxed">
                <code>throw</code> の部分でログイン失敗したときの例外処理を行っています。<br>
                現在は、ログイン失敗したとき、ログイン画面が表示されたままですが、次のように実装することで、 <code>login_error</code> というURLのログインエラーページに遷移させることも可能です。
            </p>
            <p class="text-xs font-bold text-gray-500 italic">追記不要</p>
            <pre class="bg-gray-800 text-green-400 p-3 rounded font-mono text-xs overflow-x-auto">throw ValidationException::withMessages([
    'email' => trans('auth.failed'),
])->redirectTo('/login_error');</pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GitHub</h3>
        <div class="space-y-4">
            <p class="text-xs font-bold text-gray-500 italic">Gitコマンド</p>
            <div class="bg-gray-800 text-white p-6 rounded-lg font-mono text-sm shadow-lg leading-relaxed">
                git add -A<br>
                git commit -m "laravel breeze daisyui"<br>
                git push origin main
            </div>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}