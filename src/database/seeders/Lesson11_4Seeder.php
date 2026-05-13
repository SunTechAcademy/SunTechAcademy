<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson11_4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 11 (PHPその4) を取得
        $lesson11 = Lesson::where('title', 'PHPその4')->first();

        if (!$lesson11) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson11->id,
                'sort_order' => 4,
            ],
            [
                'title' => 'フォームデータの送受信',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">フォームデータの送受信</h2>
        <p class="text-gray-700 leading-relaxed mb-4">
            ここまで学んだ内容（変数、関数、HTMLの埋め込み）を活用して、実際に<strong>フォームのあるWebページ</strong>と、その<strong>フォームデータを受け取って処理するPHPプログラム</strong>を作ってみます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">GETとPOST</h3>
        <p class="text-gray-700 leading-relaxed">
            WebブラウザがWebサーバに対して要求を送ることを、<strong>HTTPリクエスト</strong>と呼びます。<br>
            ブラウザからHTTPリクエストを送る際の技術的な仕様として、主に <strong>GET</strong> と <strong>POST</strong> の2種類が存在します。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h4 class="font-bold text-blue-800 mb-3 flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-blue-600 text-white text-xs rounded">GET</span>
                    主な利用シーン
                </h4>
                <ul class="list-disc ml-5 text-sm text-gray-700 space-y-2">
                    <li>リンクをクリックしたとき</li>
                    <li>ブラウザのURL欄に直接URLを打ち込んだとき</li>
                    <li>GoogleやYahoo!で検索ボタンをクリックしたとき</li>
                </ul>
            </div>

            <div class="bg-green-50 p-6 rounded-xl border border-green-100">
                <h4 class="font-bold text-green-800 mb-3 flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-green-600 text-white text-xs rounded">POST</span>
                    主な利用シーン
                </h4>
                <ul class="list-disc ml-5 text-sm text-gray-700 space-y-2">
                    <li>問い合わせフォームで内容を入力して送信ボタンをクリックしたとき</li>
                    <li>IDとパスワードを入力してログインボタンをクリックしたとき</li>
                </ul>
            </div>
        </div>

        <p class="text-gray-700 leading-relaxed bg-yellow-50 p-4 rounded border-l-4 border-yellow-400">
            <strong>「HTTPリクエストをする際、大事な情報を送信する必要のあるときは、POSTを使う」</strong>と覚えておいて間違いありません。このあと作成するプログラムも、POSTで送信することを前提としています。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">POSTでフォームから情報を送信する</h3>
        <p class="text-gray-700 leading-relaxed text-left">
            ここでは、HTTPリクエストの中でPOSTメソッドを使ってフォームを送信するところを学びます。<br>
            今回はシンプルに、利用者の名前を入力する欄が1つあるのみとし、入力した名前を送信するフォームを作りましょう。先ほどの <code>index.php</code>（時間帯によって挨拶文が変わるページ）にフォームを追加します。
        </p>

        <h4 class="font-bold text-gray-800 text-left">フォーム部分のHTMLコード</h4>
        <div class="bg-gray-800 p-4 rounded-lg shadow-inner">
            <pre class="text-blue-300 font-mono text-sm"><code>&lt;form action="index.php" method="POST"&gt;
    &lt;label&gt;名前: &lt;input type="text" name="target_name" required&gt;&lt;/label&gt;
    &lt;input type="submit" value="送信"&gt;
&lt;/form&gt;</code></pre>
        </div>

        <div class="space-y-8 mt-8">
            <div class="text-left">
                <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2 mb-2">送信先の指定</h5>
                <p class="text-gray-700 text-sm leading-relaxed">
                    送信先は <code>form</code> タグの <strong><code>action</code></strong> 属性で指定します。<code>action="index.php"</code> となっているので、このフォームは <code>index.php</code>、つまり自分自身にリクエストが送信されることになります。<br>
                    したがって、<code>index.php</code> の中に「送信されたフォームデータの処理」も記述する必要があります。
                </p>
                <p class="text-xs text-gray-500 mt-1 italic">※送信元と送信先を別にした場合は、送信先のPHPファイルに処理を記述します。</p>
            </div>

            <div class="text-left">
                <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2 mb-2">送信手段の指定</h5>
                <p class="text-gray-700 text-sm leading-relaxed text-left">
                    HTTPリクエストのPOSTを使って送信することを指定しているのが、<code>form</code> タグの <strong><code>method="POST"</code></strong> です。<code>method="GET"</code> と記述した場合、送信手段がGETになります。
                </p>
            </div>

            <div class="text-left">
                <h5 class="font-bold text-gray-800 border-l-2 border-gray-400 pl-2 mb-2">名前を入力するテキストボックス</h5>
                <p class="text-gray-700 text-sm leading-relaxed">
                    <code>&lt;input type="text" name="target_name" required&gt;</code><br>
                    指定した <strong><code>name="target_name"</code></strong> は、フォームの部品に名前をつけるための属性です。PHP側で受け取るときに「どの値が何の入力ボックスの値か」を特定するのに必要です。
                </p>
                <p class="text-gray-700 text-sm mt-2">
                    名前は自由ですが、<code>email</code> や <code>mail</code> など、内容がわかりやすいものをつけます。今回は <code>target_name</code> としました。また、<strong><code>required</code></strong> 属性は必須入力を意味し、未入力での送信を防ぎます。
                </p>
            </div>
        </div>

        <h4 class="font-bold text-gray-800 mt-10 text-left">サンプルコード：index.php（フォーム追加版）</h4>
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-xl">
            <pre class="p-6 text-sm text-white font-mono overflow-x-auto leading-relaxed"><code>&lt;?php
    date_default_timezone_set('Asia/Tokyo');
    $now_hour =  (int)date("G");

    function greeting($hour) {
        $result = "";

        if (6 &lt;= $hour &amp;&amp; $hour &lt; 12) {
            $result = "おはよう";
        }
        elseif (12 &lt;= $hour &amp;&amp; $hour &lt; 18) {
            $result = "こんにちは";
        }
        else {
            $result = "こんばんは";
        }

        return $result;
    }
?&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;タイトル&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;form action="index.php" method="POST"&gt;
        &lt;label&gt;名前: &lt;input type="text" name="target_name" required&gt;&lt;/label&gt;
        &lt;input type="submit" value="送信"&gt;
    &lt;/form&gt;
    &lt;p&gt;今は&lt;?php print $now_hour; ?&gt;時です。&lt;/p&gt;
    &lt;p&gt;&lt;?php print greeting($now_hour); ?&gt;、太郎さん&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
        <p class="text-sm text-gray-600 italic">※現状は、送信してもデータを受け取る処理がないため、何も起こりません。実際に動作を確認してみましょう。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-left">POSTで受け取ったデータを処理</h3>
        <p class="text-gray-700 leading-relaxed text-left">
            送信されてくる <code>target_name</code> を処理する部分を書きましょう。今まで「太郎」と固定で表示していた部分を、受け取ったデータに書き換えます。
        </p>

        <h4 class="font-bold text-gray-800 text-left">POSTで送られたデータの受け取り方</h4>
        <p class="text-gray-700 leading-relaxed text-left">
            POSTメソッドで送ったデータは、PHPの <strong><code>$_POST</code></strong> という変数に格納されます。これは <strong>スーパーグローバル変数</strong> と呼ばれ、PHPが最初から用意してくれている連想配列です。
        </p>
        
        <div class="my-6 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
            <img src="/images/Lesson11-5.png" alt="GETとPOSTの仕組みイメージ" class="w-full h-auto">
        </div>

        <h4 class="font-bold text-gray-800 mt-8 text-left">GETとPOSTで処理を分ける</h4>
        <p class="text-gray-700 text-sm leading-relaxed text-left">
            リクエストが直接アクセス（GET）か、フォーム送信（POST）かを判別する必要があります。<code>array_key_exists()</code> を使って、<code>$_POST</code> の中にデータがあるか確認します。
        </p>
        <div class="bg-gray-100 p-4 rounded font-mono text-sm text-blue-700 text-left">
            $name = "名無し";<br>
            if (array_key_exists('target_name', $_POST)) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;$name = $_POST['target_name'];<br>
            }
        </div>

        <h4 class="font-bold text-gray-800 mt-8 text-left">フォームから受け取ったデータを表示する（安全な表示）</h4>
        <p class="text-gray-700 text-sm mb-4 text-left">
            受け取った値を表示する際は、セキュリティのために <strong><code>htmlspecialchars()</code></strong> を適用します。
        </p>
        <div class="bg-gray-800 p-4 rounded text-white font-mono text-xs overflow-x-auto text-left">
            &lt;p&gt;&lt;?php print greeting($now_hour); ?&gt;、&lt;?php print htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?&gt;さん&lt;/p&gt;
        </div>

        <h4 class="font-bold text-gray-800 mt-10 text-left">完全版：index.php</h4>
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-xl">
            <pre class="p-6 text-sm text-white font-mono overflow-x-auto leading-relaxed text-left"><code>&lt;?php
    date_default_timezone_set('Asia/Tokyo');
    $now_hour =  (int)date("G");

    $name = "名無し";
    if (array_key_exists('target_name', $_POST)) {
        $name = $_POST['target_name'];
    }

    function greeting($hour) {
        $result = "";

        if (6 &lt;= $hour &amp;&amp; $hour &lt; 12) {
            $result = "おはよう";
        }
        elseif (12 &lt;= $hour &amp;&amp; $hour &lt; 18) {
            $result = "こんにちは";
        }
        else {
            $result = "こんばんは";
        }

        return $result;
    }
?&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;タイトル&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;form action="index.php" method="POST"&gt;
        &lt;label&gt;名前: &lt;input type="text" name="target_name" required&gt;&lt;/label&gt;
        &lt;input type="submit" value="送信"&gt;
    &lt;/form&gt;
    &lt;p&gt;今は&lt;?php print $now_hour; ?&gt;時です。&lt;/p&gt;
    &lt;p&gt;&lt;?php print greeting($now_hour); ?&gt;、&lt;?php print htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?&gt;さん&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-6 bg-gray-50 p-8 rounded-2xl border border-gray-200 text-left">
        <h4 class="font-bold text-gray-800 text-lg">実行確認</h4>
        <p class="text-gray-700 text-sm">
            フォームに「スズキイチロウ」と入力して送信してみましょう（14時台の例）。<br>
            <strong>実行結果：</strong><br>
            今は14時です。<br>
            こんにちは、スズキイチロウさん
        </p>

        <h4 class="font-bold text-gray-800 mt-6 border-l-4 border-red-500 pl-3">重要：htmlspecialchars() の役割</h4>
        <p class="text-gray-700 text-sm leading-relaxed">
            もしこれを使わずに <code>&lt;p style="color: red;"&gt;名無し&lt;/p&gt;</code> と入力された場合、ブラウザがHTMLタグとして解釈してしまい、文字が赤く表示されるなどの予期せぬ動作を招きます。これを防ぐのがこの関数の役割です。
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 text-center">
            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 uppercase">適用した場合（安全）</p>
                <img src="/images/Lesson11-6.png" alt="タグが無効化される" class="border rounded shadow-sm">
            </div>
            <div class="space-y-2">
                <p class="text-xs font-bold text-red-500 uppercase">適用しない場合（危険）</p>
                <img src="/images/Lesson11-7.png" alt="タグが実行される" class="border rounded shadow-sm">
            </div>
        </div>

        <p class="text-xs text-blue-600 mt-4 text-left">
            詳細：<a href="https://www.php.net/manual/ja/function.htmlspecialchars.php" target="_blank" class="underline">PHP公式ドキュメント - htmlspecialchars()</a>
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-left">フォームの処理のまとめ</h3>
        <p class="text-gray-700 leading-relaxed text-left">
            POSTメソッドを使えば、ユーザから <code>form</code> 要素を通してデータを受け取ることができます。<br>
            受け取ったデータは <strong><code>$_POST</code></strong> という連想配列に自動格納され、<code>$_POST['target_name']</code> のように、<code>input</code> タグの <code>name</code> 属性と同じ名前で取り出すことができます。
        </p>
        <p class="text-gray-700 leading-relaxed font-bold bg-blue-50 p-6 rounded-xl text-left border-l-4 border-blue-600">
            重要なのは、ユーザ側からWebサーバに対して、データの送信が可能になった点です。Webサーバから一方的に情報を受け取るだけだったユーザが、ようやくWebサイトを操作できるようになりました。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}