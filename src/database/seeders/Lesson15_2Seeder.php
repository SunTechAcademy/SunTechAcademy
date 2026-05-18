<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson15_2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 15 (インターネット通信の仕組み) を取得
        $lesson15 = Lesson::where('title', 'インターネット通信の仕組み')->first();

        if (!$lesson15) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson15->id,
                'sort_order' => 2,
            ],
            [
                'title' => 'HTTP',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">HTTP</h2>
        <p class="text-gray-700 leading-relaxed">
            HTTPについて詳しい話を学びます。
        </p>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">HTTPリクエストとHTTPレスポンス</h3>
        <p class="text-gray-700 leading-relaxed">
            WebブラウザがWebサーバに対して出すリクエストのことを、<strong>HTTPリクエスト</strong>と呼び、WebサーバがWebブラウザのHTTPリクエストに対して返すレスポンスは、<strong>HTTPレスポンス</strong>と呼びます。
        </p>
        <p class="text-gray-700 leading-relaxed">
            HTTPリクエストを出すということは、HTTPリクエストメッセージをWebサーバに向けて送ることです。下記は、<code>https://news.yahoo.co.jp/</code> のページからリンクをクリックして <code>https://about.yahoo.co.jp/common/terms/</code> のWebページを表示するときに送ったHTTPリクエストメッセージの例です。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-700">HTTPリクエストメッセージの具体例</h4>
            <pre class="bg-gray-800 text-green-400 p-6 rounded-lg overflow-x-auto font-mono text-sm shadow-inner">
GET /common/terms/ HTTP/1.1
Host: about.yahoo.co.jp
Connection: keep-alive
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8
Referer: https://news.yahoo.co.jp/
Accept-Encoding: gzip, deflate, br
Accept-Language: ja,en-US;q=0.9,en;q=0.8
Cookie: ...=...; ...</pre>
        </div>

        <p class="text-gray-700">上記がHTTPリクエストメッセージの具体例です。HTTPリクエストメッセージの一般的な形式は、下記のようになります。</p>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h4 class="font-bold text-blue-900 mb-2 underline decoration-blue-300">HTTPリクエストメッセージの一般形式</h4>
            <div class="font-mono text-blue-800">
                メソッド URL HTTPのバージョン<br>
                ヘッダー部（付加情報）<br>
                （空行）<br>
                ボディ部
            </div>
        </div>

        <div class="space-y-6">
            <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2">1行目</h5>
            <p class="text-gray-700">まずは1行目の <strong>メソッド URLのパス HTTPのバージョン</strong> です。</p>
            <div class="bg-gray-100 p-3 rounded font-mono text-sm">GET /common/terms/ HTTP/1.1</div>
            <p class="text-gray-700 leading-relaxed">
                対比させると、<strong>メソッド</strong> は <code>GET</code> 、 <strong>URLのパス</strong> は <code>/common/terms/</code> 、<strong>HTTPのバージョン</strong> は <code>HTTP/1.1</code> となっています。<br>
                メソッドという言葉に関しては、のちほど説明しますが、GET は読み込みを意味するメソッドであり、GET /common/terms/は該当のパスを読み込むという意味になります。HTTP/1.1 はHTTPのバージョンが1.1であることを意味しています。
            </p>

            <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2">2行目</h5>
            <p class="text-gray-700">次に2行目の <strong>ヘッダー部（付加情報）</strong> です。具体例では、以下の部分です。</p>
            <div class="bg-gray-100 p-3 rounded font-mono text-sm">Host: about.yahoo.co.jp</div>
            <p class="text-gray-700">
                yahoo.co.jp の中にある about という名前のホストへアクセスする、という意味です（ホストについても、のちほど説明します）。<br>
                残りの行については省略しますが、その他、さまざまな接続情報がここに書かれます。
            </p>

            <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2">ボディ部に関する補足</h5>
            <p class="text-gray-700">
                この例では <strong>ボディ部</strong> は存在しませんが、たとえばPOST（フォームデータ送信時に使うメソッド）であれば、ボディ部にはフォームデータが入り、リクエストとしてサーバに送信されます。
            </p>
        </div>

        <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-200">
            <p class="text-gray-800 leading-relaxed">
                このような形式でリクエストを出すことが、HTTPという通信規約（プロトコル）として決まっているのです。したがって、HTTPリクエストは常に上記の形式で通信します。すべて完璧に覚える必要はありませんが、HTTPというWeb用の通信プロトコルでは、このような形式で通信するように定められていることは認識しておきましょう。
            </p>
        </div>

        <h4 class="font-bold text-lg text-gray-800 mt-10">HTTPレスポンスメッセージの例</h4>
        <p class="text-gray-700 leading-relaxed">
            HTTPレスポンスを返すというのは、HTTPレスポンスメッセージをクライアントに向けて送るという意味です。下記は、先ほどのHTTPリクエストメッセージに対するHTTPレスポンスメッセージです。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-700">HTTPレスポンスメッセージの具体例</h4>
            <pre class="bg-gray-800 text-blue-300 p-6 rounded-lg overflow-x-auto font-mono text-sm shadow-inner">
HTTP/1.1 200 OK
age: 0
content-encoding: gzip
content-length: 6271
content-type: text/html; charset=UTF-8
date: Wed, 14 Oct 2020 02:05:12 GMT
p3p: policyref="http://privacy.yahoo.co.jp/w3c/p3p_jp.xml", CP="..."
server: ATS
status: 200
vary: Accept-Encoding
via: http/1.1 edge1441.img.bbt.yahoo.co.jp (ApacheTrafficServer [c sSf ])
x-content-type-options: nosniff
x-xss-protection: 1; mode=block

&lt;!DOCTYPE html&gt;
&lt;html lang="ja" ...&gt;
&lt;head&gt;
...
（以下、Webページのコンテンツが続くので省略）</pre>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 mt-6">
            <h4 class="font-bold text-blue-900 mb-2 underline decoration-blue-300">HTTPレスポンスメッセージの一般形式</h4>
            <div class="font-mono text-blue-800">
                HTTPのバージョン ステータスコード ステータス<br>
                ヘッダー部（付加情報）<br>
                （空行）<br>
                ボディ部
            </div>
        </div>

        <div class="space-y-6">
            <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2">1行目</h5>
            <p class="text-gray-700">1行目は <strong>HTTPのバージョン ステータスコード ステータス</strong> です。</p>
            <div class="bg-gray-100 p-3 rounded font-mono text-sm">HTTP/1.1 200 OK</div>
            <p class="text-gray-700 leading-relaxed">
                対比させると <strong>HTTPのバージョン</strong> は <code>HTTP/1.1</code> 、 <strong>ステータスコード</strong> は <code>200</code> 、<strong>ステータス</strong> は <code>OK</code> となっています。<br>
                HTTPのバージョンが最初に来ているのは、以降のメッセージ形式を最初に知らせるためです。<br>
                ステータスコードは、リクエストに対してサーバがどう反応したかを示す番号になり、今回の <strong>200</strong> であれば正常に動作したことを示します。また、ステータスコードと対応するステータスも文字列として返ってきます。200 の場合は OK の文字列になります。
            </p>

            <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2">2行目以降</h5>
            <p class="text-gray-700">2行目以降は <strong>ヘッダー部（付加情報）</strong> となります。</p>
            <div class="bg-gray-100 p-3 rounded font-mono text-xs">
                age: 0<br>
                content-encoding: gzip<br>
                content-length: 6271<br>
                content-type: text/html; charset=UTF-8<br>
                ...（省略）...
            </div>
            <p class="text-gray-700 leading-relaxed text-sm italic">
                ヘッダー部では、サーバ情報やレスポンスデータの情報が記されています。今の時点で、それぞれの内容を理解する必要はありません。興味ある方は、各項目の内容について調べてみてください。
            </p>

            <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2">ボディ部</h5>
            <p class="text-gray-700 leading-relaxed">
                今回のボディ部は、GETメソッド（読み込み用メソッド）に対するレスポンスです。（<code>&lt;!DOCTYPE html&gt;</code>）以降が実際のWebページ（HTML, コンテンツ）になります。Webブラウザはレスポンスメッセージで送られてきたコンテンツ（HTML文書）を、Webページとして表示します。
            </p>
        </div>

        <p class="text-gray-700 font-bold">以上がHTTPリクエストメッセージとHTTPレスポンスメッセージの概要です。<br>URLの最初にあるHTTPは、Web用の通信プロトコルを示していると覚えておきましょう。</p>

        <div class="flex justify-center py-6">
            <img src="/images/Lesson15-2.png" alt="HTTPリクエストとレスポンスの概念図" class="max-w-md w-full h-auto shadow-sm rounded border">
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">HTTPリクエストの4つのメソッド</h3>
        <p class="text-gray-700 leading-relaxed">
            Webでは基本的に、あるリソースに対して4つのことが可能です。ここでいうリソースとは、Web上にあるWebページやデータのすべてです。たとえば、Yahooのニュース記事ページや、Facebookのコメント、X（旧Twitter）のツイート、ブログの記事やコメントなどです。
        </p>
        <p class="text-gray-700 leading-relaxed">
            それらのリソースは基本的に4つの操作が可能です。それが<strong>CRUD（クラッド）</strong>と呼ばれる操作です。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">4つの操作 - CRUD</h4>
            <p class="text-gray-700">CRUDは4つの操作の頭文字をとったものです。</p>
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">英語</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">日本語</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td class="border border-gray-300 px-4 py-2">Create</td><td class="border border-gray-300 px-4 py-2">作成</td></tr>
                        <tr><td class="border border-gray-300 px-4 py-2">Read</td><td class="border border-gray-300 px-4 py-2">取得</td></tr>
                        <tr><td class="border border-gray-300 px-4 py-2">Update</td><td class="border border-gray-300 px-4 py-2">更新</td></tr>
                        <tr><td class="border border-gray-300 px-4 py-2">Delete</td><td class="border border-gray-300 px-4 py-2">削除</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl space-y-4">
            <p class="text-gray-700 leading-relaxed text-sm">
                FacebookのコメントやX（旧Twitter）のツイートについて考えてみます。<br>
                自分が今までに投稿したコメントやツイートを閲覧するとき、<strong>Read（取得）</strong>の操作をします。そして投稿するときは<strong>Create（作成）</strong>の操作をします。そして、誤変換などを発見して修正したいときは<strong>Update（更新）</strong>の操作をします。そして「やっぱり、この投稿は要らない」と思ったら<strong>Delete（削除）</strong>の操作によって削除できます。
            </p>
            <p class="text-gray-700 leading-relaxed text-sm italic">
                ただし、Yahooのニュース記事などユーザ側が操作権限を持っていないリソースに対しては、Read（取得）以外の操作は許可されていません。
            </p>
        </div>

        <h4 class="font-bold text-gray-800 mt-8">HTTPリクエストでのCRUD</h4>
        <p class="text-gray-700 leading-relaxed">
            WebはHTTPというWeb用のプロトコルによって通信します。HTTP通信におけるCRUDのための4つのメソッドを学びましょう。ここでいうメソッドは、方法論といった意味ではなく、単にHTTPリクエスト内でのCRUD操作をする際に使われる語句のことを言います。
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-[#6A73A6] text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">英語</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">日本語</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">HTTPメソッド</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr><td class="border border-gray-300 px-4 py-2 font-mono">Create</td><td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">作成</td><td class="border border-gray-300 px-4 py-2 font-bold text-blue-600 font-mono text-center">POST</td></tr>
                    <tr><td class="border border-gray-300 px-4 py-2 font-mono">Read</td><td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">取得</td><td class="border border-gray-300 px-4 py-2 font-bold text-blue-600 font-mono text-center">GET</td></tr>
                    <tr><td class="border border-gray-300 px-4 py-2 font-mono">Update</td><td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">更新</td><td class="border border-gray-300 px-4 py-2 font-bold text-blue-600 font-mono text-center">PUT</td></tr>
                    <tr><td class="border border-gray-300 px-4 py-2 font-mono">Delete</td><td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">削除</td><td class="border border-gray-300 px-4 py-2 font-bold text-blue-600 font-mono text-center">DELETE</td></tr>
                </tbody>
            </table>
        </div>

        <div class="space-y-4 pt-6">
            <p class="text-gray-700">先ほどのHTTPリクエストメッセージの具体例をもう一度見てみましょう。</p>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-sm border-l-4 border-gray-400">
                GET /common/terms/ HTTP/1.1
            </div>
            <p class="text-gray-700 leading-relaxed">
                最初の行に <code>GET /common/terms/ HTTP/1.1</code> とあります。これは「/common/terms/というリソース（ヤフーの記事）に対して、<strong>GET（Read, 取得）操作を要求します</strong>」というHTTPリクエストになります。
            </p>
            <p class="text-sm text-gray-600 italic">
                ※HTTP/1.1はHTTPのバージョンの話で、HTTPもバージョンによって少しずつ違うので、このHTTPリクエストメッセージが準拠しているHTTPバージョンを明記しておく必要があります。
            </p>
            <p class="text-gray-700 leading-relaxed">
                GETだけではなく、あるリソースに対してCRUD操作をするとき、POST や PUT・DELETE も同様に、HTTPリクエストメッセージの中の最初の一行目に書かれます。
            </p>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-600">
            <p class="text-gray-800 font-bold">
                このようにWebブラウザとWebサーバの間では、HTTPという通信プロトコルが利用され、HTTPリクエストとHTTPレスポンスというメッセージを送受信することで、リソースに対する操作をしています。これがWeb上の通信の実態です。
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}