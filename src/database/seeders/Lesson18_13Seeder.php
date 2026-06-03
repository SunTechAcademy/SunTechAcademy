<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_13Seeder extends Seeder
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
                'sort_order' => 13,
            ],
            [
                'title' => 'まとめ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section class="space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">まとめ</h2>
        
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                今回作成したMicropostsの大きな特徴と言えば、認証とリレーション（一対多、多対多）です。<br>
                認証は、すでに用意されていたRegisterControllerを使えば良かったですね。復習を兼ねて、下記の公式ドキュメントをひととおり読んでおくことをオススメします。このレッスンで学んでいないこともあるため、まずは学んだところだけでも構いません。
            </p>
        </div>
        
        <p class="text-sm font-bold text-blue-800 bg-blue-50 p-4 rounded-lg border border-blue-100 shadow-sm">
            認証（<a href="https://readouble.com/laravel/9.x/ja/authentication.html" target="_blank" class="underline hover:text-blue-900 break-all">https://readouble.com/laravel/9.x/ja/authentication.html</a>）
        </p>

        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                また、リレーションはModelとModelの関係のことです。一対多か、多対多かによって作成方法が異なりました。<br>
                とくに、多対多のリレーションを作るには、中間テーブルと呼ばれるテーブルが必要でした。中間テーブルは、 ModelとModelを結ぶためのテーブルです。<br>
                余談ですが、 Laravelだけでなく、他のRailsやCakePHPと言ったWebアプリケーションフレームワークでも考え方は同じで、リレーションのために中間テーブルを必要とします。<br>
                一対多、多対多のリレーションの作り方を一度わかってしまえば、 Webアプリケーションの開発はぐっと簡単になり、何でも作れるようになるでしょう。こちらも復習を兼ねて、下記の公式ドキュメントをひととおり読んでおくことをおススメします。
            </p>
        </div>

        <p class="text-sm font-bold text-blue-800 bg-blue-50 p-4 rounded-lg border border-blue-100 shadow-sm">
            リレーション（<a href="https://readouble.com/laravel/9.x/ja/eloquent-relationships.html" target="_blank" class="underline hover:text-blue-900 break-all">https://readouble.com/laravel/9.x/ja/eloquent-relationships.html</a>）
        </p>

        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                ここまで学べばLaravelを使ってWebアプリケーションを作成する方法がほぼわかったと思います。これでオリジナルサービスを開発できます。<br>
                X（旧Twitter）クローンに機能追加をしてみるのも良いでしょう。現状のX（旧Twitter）クローンはまだまだ改良の余地が残されています。X（旧Twitter）クローンを拡張してみようと思った方は以下の「X（旧Twitter）クローン拡張機能の一例」を参考にしてください。
            </p>
        </div>
    </section>

    <section class="space-y-4 bg-gray-50 p-6 rounded-xl border border-gray-200 shadow-inner">
        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-300 pb-2 mb-4">X（旧Twitter）クローン拡張機能の一例</h3>
        <ul class="list-disc list-inside text-sm space-y-3 pl-2 leading-relaxed text-gray-700">
            <li>ツイート内容を編集する機能</li>
            <li>ユーザが自分の情報を編集する機能</li>
            <li>退会機能</li>
            <li>登録できるユーザ情報を増やす（年齢、プロフィールなど）</li>
            <li>権限つきの認証機能（一般、管理者、etc）管理者によるユーザ管理機能</li>
            <li>権限によって使える機能を制限する制御</li>
            <li>Gravatarを止め、「X（旧Twitter）クローンが動作するサーバへアップロードされた画像をアイコンに設定する」、という仕様に変更</li>
        </ul>
    </section>

    <section class="space-y-6">
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                さて、今後のWebアプリケーション開発においてもっとも参考になるのは、当然のことながらLaravelの公式ドキュメントです。プログラミングの資料の多くが英語で説明されている中、公式ドキュメントが日本語に翻訳されていることは幸運なことです。
            </p>
        </div>

        <p class="text-sm font-bold text-blue-800 bg-blue-50 p-4 rounded-lg border border-blue-100 shadow-sm">
            公式ドキュメント（<a href="https://readouble.com/laravel/9.x/ja/" target="_blank" class="underline hover:text-blue-900 break-all">https://readouble.com/laravel/9.x/ja/</a>）
        </p>

        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                また、 Laravel API検索サービスも大いに役に立ちます。公式ドキュメントだけでは理解に至らないケースもあるため、本質的に理解するにはLaravel本体のソースコードを読んでしまうのが一番です。
            </p>
        </div>

        <div class="space-y-3">
            <p class="text-sm font-bold text-blue-800 bg-blue-50 p-4 rounded-lg border border-blue-100 shadow-sm">
                Laravel API（<a href="https://api.laravel.com/docs/9.x/index.html" target="_blank" class="underline hover:text-blue-900 break-all">https://api.laravel.com/docs/9.x/index.html</a>）
            </p>
            <p class="text-sm font-bold text-blue-800 bg-blue-50 p-4 rounded-lg border border-blue-100 shadow-sm">
                Laravel - GitHub（<a href="https://github.com/laravel/framework/tree/9.x/src/Illuminate" target="_blank" class="underline hover:text-blue-900 break-all">https://github.com/laravel/framework/tree/9.x/src/Illuminate</a>）
            </p>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}