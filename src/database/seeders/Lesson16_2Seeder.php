<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson16_2Seeder extends Seeder
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
                'sort_order' => 2,
            ],
            [
                'title' => 'Laravelを使用したWebアプリケーションの基本',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">Laravelを使用したWebアプリケーションの基本</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                最初に述べたように、Laravelを使用すると、効率的かつ高度なWebアプリケーション開発が可能です。ただし、そのためのルールをしっかりと学ぶ必要があります。<br>
                そもそもWebアプリケーションとは何か、から考えていきましょう。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Webアプリケーションとは</h3>
        <p class="text-gray-700 leading-relaxed">
            今まで、HTML/CSS, PHP, MySQLと学んできましたが、Webアプリケーションとは一体何でしょうか？<br>
            Webアプリケーションとは、<strong>ユーザがHTTPリクエストの4つのCRUDメソッド（POST, GET, PUT, DELETE）を使って、Web上のリソースを操作できるアプリケーション</strong> です。このことを忘れてしまうと、自分が何を行っているのかわからなくなってしまいます。しっかり覚えておきましょう。
        </p>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-2.png" alt="WebアプリケーションのCRUD操作イメージ" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Web上のリソースとは</h3>
        <p class="text-gray-700 leading-relaxed">
            <strong>Web上のリソース</strong> とは、Webページに表示されているものすべてです。<br>
            ただし、ユーザに変更が許可されているものと、そうでないものとがあります。
        </p>
        <div class="bg-gray-50 p-6 rounded-xl space-y-4">
            <p class="text-sm text-gray-700">
                X（旧Twitter）やFacebookでユーザの変更が許可されているリソースとは、たとえば、ツイートや、コメントです。他にもプロフィールや、投稿画像などがあります。
            </p>
            <p class="text-sm text-gray-700">
                しかし、X（旧Twitter）やFacebookのロゴや、メニューの変更は許可されていません（そもそも操作できるようにはなっていません）。<br>
                したがって、変更が許可されていないリソースに関しては、読み込み操作（Read, HTTPメソッドとしてはGET）しかできません。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">URLとは</h3>
        <p class="text-gray-700 leading-relaxed">
            Web上のリソースは、URLによって位置を特定されます。URL(Uniform Resource Locator)のRはリソースです。URLはその名の通り、リソースの位置を特定するために使用されます。同じ意味としてURIとも呼ばれます。<br>
            Webアプリケーションをブラウザから使う際、ブラウザは指定のURLに対してHTTPリクエストメソッドを送ります。そうすることで、リソースを操作できます。
        </p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Laravelとは</h3>
        <p class="text-gray-700 leading-relaxed">
            Laravelは、Webアプリケーションを効率的かつ高度に開発できるWebアプリケーションフレームワークです。さらにセキュリティも高く、安全とも言えます。
        </p>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
            <a href="https://laravel.com/" target="_blank" class="text-blue-600 font-bold hover:underline flex items-center gap-2">
                参考：Laravel公式サイト（https://laravel.com/）
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
        </div>
        <p class="text-gray-700 leading-relaxed">
            また、LaravelはPHPで作られているため、Laravelを使ってWebアプリケーションを構築する際は、PHPを使用して開発していくことになります。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Webアプリケーションフレームワークとは</h3>
        <p class="text-gray-700 leading-relaxed">
            Webアプリケーションフレームワークとは、Webアプリケーションの土台となるプログラムです。Web開発を何度か経験しているとわかりますが、似た処理がいくつも出てきます。このWeb開発における共通処理を、まとめあげたものがWebアプリケーションフレームワークです。共通処理を書かなくて良いため、労力が削減され、効率的に開発できます。
        </p>
        <div class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-400">
            <h4 class="font-bold text-blue-900 mb-2">ライブラリとフレームワークの違い</h4>
            <p class="text-sm text-blue-800 leading-relaxed">
                ライブラリが「ユーザの書いたプログラムによって <strong>呼び出される</strong>」側なのに対して、フレームワークは「ユーザの書いたプログラムを <strong>呼び出す</strong>」側です。<br>
                ライブラリは、ユーザの意思によって取り出す便利な道具（ライブラリをどう使うかはユーザ次第）です。しかし、フレームワークはそのしくみを利用するかどうかをユーザに委ねてはいません。<br>
                フレームワークという巨大な土台（ルール）の上でプログラムが動くため、ユーザは、フレームワークのルールに沿って開発する必要があります。<br>
                なお、ここでいうユーザとは、開発者のことです。
            </p>
        </div>
        <div class="flex justify-center py-4">
            <img src="/images/Lesson16-3.png" alt="ライブラリとフレームワークの制御の逆転イメージ" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>
        <p class="text-gray-700 leading-relaxed">
            ライブラリと比較すると、制御の逆転（主従の逆転）が起こっています。まるで「フレームワークにプログラムを書かされている」ような表現をしていますが、まさにそうなのです。そのおかげで、複数人の開発者がいてもある程度規律の整った書き方でWebアプリケーションを開発できます。
        </p>
        <p class="text-gray-700 leading-relaxed text-sm">
            Webアプリケーションフレームワークには、Laravelだけではなく、CakePHPやFuelPHP、PHP以外の言語のフレームワークならRailsやDjango、Springなどがあります。どれも、根本的な構造は似ています。<br>
            フレームワークとしての設計思想はそれぞれ異なりますが、どれも目的はWebアプリケーションの効率的な開発であるため、根本的な部分や利用可能な共通処理は、あまり変わらないのです。
        </p>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Laravelのリクエストからレスポンスまで</h3>
        <p class="text-gray-700 leading-relaxed">これからLaravelを学んでいきますが、LaravelはWebサーバの中に位置します。</p>
        <div class="flex justify-center">
            <img src="/images/Lesson16-4.png" alt="Webサーバ内でのLaravelの位置付け" class="max-w-xl w-full h-auto shadow-sm rounded border">
        </div>
        <p class="text-gray-700 leading-relaxed">
            今まで、ここには単なるPHPプログラムがありましたが、それがLaravelというフレームワークで構成されます。開発者は、Laravel上にPHPプログラムを書き、それがWebアプリケーションとして実行されます。<br>
            では、Laravelでの処理の流れを見てみましょう。
        </p>

        <div class="bg-gray-800 text-white p-8 rounded-2xl shadow-lg">
            <h4 class="text-2xl font-bold mb-4 flex items-center gap-2">
                <span class="text-yellow-400">MVC</span>
            </h4>
            <p class="mb-6 opacity-90">
                Laravelには <strong>MVC</strong> という役割分担の構造があります。 MVCとは、以下の略です。
            </p>
            <ul class="grid grid-cols-3 gap-4 font-mono text-xl mb-8">
                <li class="bg-gray-700 p-3 rounded text-center border border-gray-600">Model</li>
                <li class="bg-gray-700 p-3 rounded text-center border border-gray-600">View</li>
                <li class="bg-gray-700 p-3 rounded text-center border border-gray-600">Controller</li>
            </ul>
            <p class="text-sm opacity-80 leading-relaxed">
                Webアプリケーションフレームワークの多くは、MVCの構造をしています。以下の図にもあるように、厳密にはRouterという役割の層もあります。しかし、 Routerは言葉の中に含めず、MVCと呼ぶのが一般的です。
            </p>
        </div>

        <div class="flex justify-center">
            <img src="/images/Lesson16-5.png" alt="MVCとRouterの流れ" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-4 border border-gray-200 rounded-xl">
                <h5 class="font-bold text-blue-600 mb-1">Router（ルータ）</h5>
                <p class="text-sm text-gray-600">リクエストを受け取って、URLとHTTPメソッドから適切なControllerを選び出し、リクエストデータを渡す役割。</p>
            </div>
            <div class="p-4 border border-gray-200 rounded-xl">
                <h5 class="font-bold text-blue-600 mb-1">Model（モデル）</h5>
                <p class="text-sm text-gray-600">リソース（データ）に処理を施すために必要な、ビジネスロジックやデータベース操作を担う役割。</p>
            </div>
            <div class="p-4 border border-gray-200 rounded-xl">
                <h5 class="font-bold text-blue-600 mb-1">View（ビュー）</h5>
                <p class="text-sm text-gray-600">Modelを表示・整形する雛形。多くの場合HTMLで作られ、ユーザーに表示される画面を担う役割。</p>
            </div>
            <div class="p-4 border border-gray-200 rounded-xl">
                <h5 class="font-bold text-blue-600 mb-1">Controller（コントローラ）</h5>
                <p class="text-sm text-gray-600">Routerからデータを受け取り、ModelやViewを制御してレスポンスを生成する司令塔の役割。</p>
            </div>
        </div>
        <p class="text-gray-700 font-bold text-center">これからはRouter, Model, View, Controllerのそれぞれの役割を考慮しながら開発します。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Laravelでの開発の流れ</h3>
        <p class="text-gray-700 leading-relaxed">
            とくに従わなければいけないルールではありませんが、Laravelを用いた開発は、基本的に下記の流れで行います。
        </p>
        <div class="flex flex-col gap-2 max-w-sm mx-auto">
            <div class="p-3 bg-blue-600 text-white rounded shadow-sm text-center font-bold">1. Model</div>
            <div class="flex justify-center text-gray-400">↓</div>
            <div class="p-3 bg-blue-500 text-white rounded shadow-sm text-center font-bold">2. Router</div>
            <div class="flex justify-center text-gray-400">↓ (ルーティングごとに)</div>
            <div class="grid grid-cols-2 gap-2">
                <div class="p-3 bg-blue-400 text-white rounded shadow-sm text-center font-bold text-xs">3.1. Controller</div>
                <div class="p-3 bg-blue-400 text-white rounded shadow-sm text-center font-bold text-xs">3.2. View</div>
            </div>
        </div>
        <div class="prose max-w-none text-gray-700 text-sm space-y-4 leading-relaxed mt-4">
            <p>
                最初に、もっとも重要なModelから着手します。<strong>Modelこそがリソース（操作対象）であり、作成するWebアプリケーションの扱うデータを決めます。</strong>まずは操作対象であるModelを明確にするところから始めます。
            </p>
            <p>
                次にRouterです。Modelを作成したら、その ModelをどのようなURLで操作(CRUD)するかを決めます。Routerによって、URLを定めますが、分かりやすさのためModelの名前を使ったURLにします。 Routerが決まるとControllerが決まり、Controllerが決まるとViewが決まります。
            </p>
            <p>
                まずは本カリキュラムの順序にならって作成してください。慣れてくればとくに意識せずとも、この流れで開発ができるようになるでしょう。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">LaravelのバージョンとLTS</h3>
        <p class="text-gray-700 leading-relaxed">
            今回利用するLaravelのバージョンは<strong>9</strong>です。 Laravelでは複数のバージョンが存在します。<br>
            各バージョンにはサポート期間が設けられており、その中でも<strong>LTS</strong>と呼ばれるバージョンが設定されたものがあります。
        </p>
        <div class="bg-gray-100 p-6 rounded-xl">
            <p class="text-sm text-gray-700 leading-relaxed">
                <strong>LTSとは：</strong>Long Term Supportの略で、長期間サポートの対象という意味です。例えば、LTSであるLaravel6の公式リリースノートには下記のように書かれています。
            </p>
            <blockquote class="border-l-4 border-gray-300 pl-4 my-4 italic text-sm text-gray-600">
                Laravel6のようなLTSリリースでは、バグフィックスは２年間、セキュリティフィックスは３年間提供します。これらのリリースは長期間に渡るサポートとメンテナンスを提供します。 一般的なリリースでは、バグフィックスは６ヶ月、セキュリティフィックスは１年です。
            </blockquote>
            <p class="text-sm text-gray-700 leading-relaxed">
                数年前からの流れで言えば、Laravel9もLTSの予定でした。しかし、さまざまな理由から2022年8月現在、LTSとはなっていません。セキュリティFixと呼ばれるサポート期間は、2024年2月8日までとなっています。<br>
                PHPやLaravelにセキュリティホールが発見された場合、サポート期間が過ぎたものは無視されますが、LTSであればサポート期間が長いため安定して利用できます。当然、9.xのxのバージョンをアップデートしていくことは必要です。<br>
                また、リリースノートには9.xにおける新機能やバージョニングについての基本的な考え方が書かれています。
            </p>
            <a href="https://readouble.com/laravel/9.x/ja/releases.html" target="_blank" class="text-blue-600 text-sm hover:underline mt-2 inline-block">リリースノート（https://readouble.com/laravel/9.x/ja/releases.html）</a>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">参考資料</h3>
        <p class="text-gray-700 leading-relaxed">
            本コースではLaravelの基本的な部分を学んでいきます。必要なことはレッスン内に書かれているはずですが、少し応用的なことを学ぼうとしたときにこのカリキュラムでは説明不足な面もあります。その場合は、下記に示す公式ドキュメントやサンプルコードなどを参考にしてください。
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h4 class="font-bold text-gray-800 mb-2">公式ドキュメント</h4>
                <p class="text-xs text-gray-600 mb-4">有志により日本語化されています。目次（左上の本のアイコン）を活用しましょう。</p>
                <a href="http://readouble.com/laravel/9.x/ja/" target="_blank" class="text-blue-600 text-sm hover:underline font-bold">Laravel 9.x公式ドキュメント</a>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h4 class="font-bold text-gray-800 mb-2">Google</h4>
                <p class="text-xs text-gray-600 mb-4">開発者にとっても最高の検索サイトです。不明な点は能動的に検索しましょう。</p>
                <a href="https://www.google.com" target="_blank" class="text-blue-600 text-sm hover:underline font-bold">Google</a>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h4 class="font-bold text-gray-800 mb-2">Qiita</h4>
                <p class="text-xs text-gray-600 mb-4">プログラマのための技術情報共有サービスです。サンプルコードが豊富です。</p>
                <a href="https://qiita.com/tags/laravel" target="_blank" class="text-blue-600 text-sm hover:underline font-bold">Laravelタグの記事一覧</a>
            </div>
        </div>
    </section>

    <section class="bg-blue-600 text-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-xl font-bold mb-4">ここまでのまとめ</h3>
        <p class="opacity-90 leading-relaxed">
            Webアプリケーションフレームワークとその代表例であるLaravelについて学びました。ここからLaravelを実際に利用して、サンプルアプリケーションを開発します。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}