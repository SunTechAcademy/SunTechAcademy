<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson11_2Seeder extends Seeder
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
                'sort_order' => 2,
            ],
            [
                'title' => 'HTMLへの埋め込み用としてPHPを使う',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12">
    <section>
        <p class="text-gray-700 leading-relaxed">
            雛形のHTMLへ適切なデータを埋め込むためにPHPを使うのが、WebプログラミングとしてのPHPの使い方です。<br>
            今までに学んだPHPの知識を応用して、WebサーバでPHPを実行させる学習をすぐにでも行いたいところですが、このセクションでは前段としてHTMLの中にPHPのコードを埋め込んで、<code>php</code> コマンドを実行してHTMLの一部分が動的に書き換わることを確認します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">PHPが入っていないHTMLファイルをPHPファイルとして扱う</h3>
        <p class="text-gray-700">
            PHPファイルの中にHTMLを書き、動的な表示が必要な部分にPHPの命令を記述する流れで進めます。<br>
            まずは最小のHTMLファイルをtest.phpとして保存しましょう。
        </p>

        <div class="bg-gray-800 rounded-lg overflow-hidden">
            <div class="bg-gray-700 px-4 py-2 text-xs text-gray-200 font-mono">test.php</div>
            <pre class="p-4 text-sm text-white font-mono overflow-x-auto"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;タイトル&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;p&gt;本文です。&lt;/p&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>

        <p class="text-gray-700 font-bold">そしてこれをターミナルでPHPとして実行してみます。何が返ってくるでしょうか？</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-black p-4 rounded-lg">
                <p class="text-xs text-gray-400 mb-2 font-bold uppercase tracking-widest">ターミナルでPHPを実行</p>
                <code class="text-green-400">php test.php</code>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg border border-gray-300 font-mono text-xs">
                <p class="text-xs text-gray-500 mb-2 font-bold uppercase tracking-widest">実行結果</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="ja"&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;head&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;title&gt;タイトル&lt;/title&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;/head&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;body&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;本文です。&lt;/p&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;/body&gt;<br>
                &lt;/html&gt;
            </div>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
            <p class="text-gray-700">
                実は、記述したHTMLがそのまま返ってきます。変化がなかったのは、<code>&lt;?php ... ?&gt;</code> を使った記述が1か所もないからです。php コマンドでPHPのプログラムを処理する際、 <code>&lt;?php ... ?&gt;</code> 以外の部分はそのまま文字列を返します。
            </p>
            <p class="text-gray-700 mt-2">
                ここで思い出していただきたいのは、Lesson7以前のPHPプログラムで、 <code>?&gt;</code> という閉じタグを使いませんでした。<br>
                Lesson8ではHTMLの中にPHPプログラムを埋め込むため、 <code>&lt;?php ... ?&gt;</code> のように <code>?&gt;</code> という閉じタグを使います。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">PHPをHTMLに埋め込む</h3>
        <h4 class="text-lg font-bold text-blue-600 underline decoration-blue-200">print文を埋め込む</h4>
        <p class="text-gray-700">
            それでは、HTMLに埋め込む形でPHPを書いてみます。body要素内の本文です。を書き換えてPHPの命令を埋め込んでみましょう。
        </p>
        <p class="text-gray-700">
            今までは、PHPの閉じタグである <code>?&gt;</code> を記載しませんでした。これは、 <code>?&gt;</code> を記載しない文法が良い書き方とされているためでした。<br>
            HTMLにPHPを埋め込むときは、 <code>&lt;?php ... ?&gt;</code> のように、 <code>?&gt;</code> という閉じタグを記載します。<br>
            <strong>HTMLにPHPを埋め込むときは、 <code>?&gt;</code> が絶対必要である点に注意しながらコードを見てみましょう。</strong>
        </p>

        <div class="bg-gray-800 rounded-lg overflow-hidden">
            <div class="bg-gray-700 px-4 py-2 text-xs text-gray-200 font-mono">test.php</div>
            <pre class="p-4 text-sm text-white font-mono overflow-x-auto"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;タイトル&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;p&gt;&lt;?php print 'ここにPHPコードを埋め込む。' ?&gt;&lt;/p&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-black p-4 rounded-lg">
                <p class="text-xs text-gray-400 mb-2 font-bold uppercase tracking-widest text-center">ターミナルでPHPを実行</p>
                <code class="text-green-400">php test.php</code>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg border border-gray-300 font-mono text-xs">
                <p class="text-xs text-gray-500 mb-2 font-bold uppercase tracking-widest">出力結果(PHP => HTML)</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="ja"&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;head&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;title&gt;タイトル&lt;/title&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;/head&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;body&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;ここにPHPコードを埋め込む。&lt;/p&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;/body&gt;<br>
                &lt;/html&gt;
            </div>
        </div>

        <h4 class="text-lg font-bold text-blue-600 underline decoration-blue-200 mt-8">HTMLタグごと埋め込む</h4>
        <p class="text-gray-700 italic">
            先ほどは、<code>&lt;p&gt;&lt;?php print 'ここにPHPコードを埋め込む。'; ?&gt;&lt;/p&gt;</code> として、p要素の中にPHPコードを入れました。今回は、PHPコードの中にHTMLタグも入れてみます。
        </p>

        <div class="bg-gray-800 rounded-lg overflow-hidden">
            <div class="bg-gray-700 px-4 py-2 text-xs text-gray-200 font-mono">test.php</div>
            <pre class="p-4 text-sm text-white font-mono overflow-x-auto"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;タイトル&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;?php print '&lt;p&gt;ここにPHPコードを埋め込む。&lt;/p&gt;'. PHP_EOL;  ?&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>

        <p class="text-gray-700">極端な話をすると、下記の通りに書いても同じ結果になります。</p>
        <div class="bg-gray-100 p-4 rounded-lg border font-mono text-sm">
<pre><code>&lt;?php print '&lt;!DOCTYPE html&gt;' . PHP_EOL; ?&gt;
&lt;?php print '&lt;html lang="ja"&gt;' . PHP_EOL; ?&gt;
&lt;?php print '    &lt;head&gt;' . PHP_EOL; ?&gt;
&lt;?php print '        &lt;meta charset="UTF-8"&gt;' . PHP_EOL; ?&gt;
&lt;?php print '        &lt;title&gt;タイトル&lt;/title&gt;' . PHP_EOL; ?&gt;
&lt;?php print '    &lt;/head&gt;' . PHP_EOL; ?&gt;
&lt;?php print '    &lt;body&gt;' . PHP_EOL; ?&gt;
&lt;?php print '        &lt;p&gt;ここにPHPコードを埋め込む。&lt;/p&gt;' . PHP_EOL; ?&gt;
&lt;?php print '    &lt;/body&gt;' . PHP_EOL; ?&gt;
&lt;?php print '&lt;/html&gt;' . PHP_EOL; ?&gt;</code></pre>
        </div>

        <div class="bg-red-50 border-l-4 border-red-400 p-4 mt-6">
            <p class="font-bold text-red-800">printでHTMLタグを埋め込む際の注意点</p>
            <p class="text-gray-700 mt-2">
                このようにPHPのprint文からHTMLタグを出力できますが、セキュリティの観点においては、お行儀の悪い方法です。
                どうしても print でHTMLタグを埋め込みたい場合を除き、HTMLタグが入り込む可能性のある変数やデータには <strong>htmlspecialchars()</strong> 関数を適用してからHTML内に埋め込むことが推奨されています。
            </p>
            <div class="mt-4 bg-white p-3 rounded border">
                <code class="text-sm font-mono">&lt;?php print htmlspecialchars('&lt;p&gt;ここにPHPコードを埋め込む。&lt;/p&gt;', ENT_QUOTES, 'UTF-8') . PHP_EOL; ?&gt;</code>
            </div>
            <p class="text-sm text-gray-600 mt-2 italic">※htmlspecialchars()については、本レッスンの後半で、あらためて説明します。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">print以外の関数や変数を埋め込む</h3>
        <p class="text-gray-700 leading-relaxed">
            次は、HTMLの中に、現在時刻を埋め込んでみます。<br>
            それを実現するには、表示内容を埋め込む場所よりも前のところに、必要な事前処理を埋め込んでおく必要があります。それは、「どの地域の時刻に合わせるか」という設定と、「現在時刻を取得する」処理です。
        </p>

        <h4 class="font-bold text-gray-800">1. どの地域の時刻に合わせるかの設定</h4>
        <p class="text-gray-700">
            まず、地域の設定には、<code>date_default_timezone_set()</code>という、PHPによって最初から定義されている関数を呼び出します。今回は日本（Asia/Tokyo）へ合わせるようにします。
        </p>
        <code class="block bg-gray-100 p-2 rounded">date_default_timezone_set('Asia/Tokyo');</code>

        <h4 class="font-bold text-gray-800 mt-4">2. 現在時刻を取得する処理</h4>
        <p class="text-gray-700">
            現在時刻を取得するため、同じく最初から定義されている関数の <code>date()</code> を呼び出します。
        </p>

        <table class="min-w-full border-collapse border border-gray-300 my-4 text-sm text-gray-700">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">文字</th>
                    <th class="border border-gray-300 p-2 text-left">詳細</th>
                </tr>
            </thead>
            <tbody>
                <tr><td class="border border-gray-300 p-2 font-mono text-center">Y</td><td class="border border-gray-300 p-2 text-left">Year（年：西暦4桁）</td></tr>
                <tr><td class="border border-gray-300 p-2 font-mono text-center">m</td><td class="border border-gray-300 p-2 text-left">month（月：2桁）</td></tr>
                <tr><td class="border border-gray-300 p-2 font-mono text-center">d</td><td class="border border-gray-300 p-2 text-left">day（日：2桁）</td></tr>
                <tr><td class="border border-gray-300 p-2 font-mono text-center">H</td><td class="border border-gray-300 p-2 text-left">hour（時間：24時間表記：2桁）</td></tr>
                <tr><td class="border border-gray-300 p-2 font-mono text-center">i</td><td class="border border-gray-300 p-2 text-left">minutes（分：2桁）</td></tr>
                <tr><td class="border border-gray-300 p-2 font-mono text-center">s</td><td class="border border-gray-300 p-2 text-left">second（秒：2桁）</td></tr>
            </tbody>
        </table>

        <p class="text-gray-700">
            以下のコードにより、<code>$now</code> には <code>2018/09/13 15:08:01</code> のような形式の文字列として、現在時刻の情報が代入されます。
        </p>
        <code class="block bg-gray-100 p-2 rounded">$now = date("Y/m/d H:i:s");</code>

        <div class="bg-gray-800 rounded-lg overflow-hidden mt-6">
            <div class="bg-gray-700 px-4 py-2 text-xs text-gray-200 font-mono text-center font-bold">サンプルコード：現在時刻の埋め込み (test.php)</div>
            <pre class="p-4 text-sm text-white font-mono overflow-x-auto"><code>&lt;?php
    date_default_timezone_set('Asia/Tokyo');
    $now = date("Y/m/d H:i:s");
?&gt;&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;タイトル&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;p&gt;&lt;?php print $now; ?&gt;&lt;/p&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">if文を埋め込む</h3>
        <p class="text-gray-700">次に作成するのは、現在時刻によって <strong>おはよう／こんにちは／こんばんは</strong> と表示を分けるプログラムです。</p>

        <h4 class="font-bold text-gray-800 italic">現在時刻を取得する</h4>
        <p class="text-gray-700">
            まずは <code>date()</code> を実行し、時間（hour）のみの情報を取得します。引数の <code>G</code> はhourのみ（24時間表記：1桁（10の位の0埋めは無し））の情報を取得します。
        </p>
        <div class="bg-yellow-50 p-4 border rounded">
            <p class="text-sm font-bold mb-2">型変換（キャスト）</p>
            <code>$now_hour = (int)date("G");</code>
            <p class="text-sm mt-2 text-gray-600 italic">
                参考：型の相互変換（<a href="https://www.php.net/manual/ja/language.types.type-juggling.php" target="_blank" class="text-blue-500 underline">https://www.php.net/manual/ja/language.types.type-juggling.php</a>）
            </p>
        </div>

        <h4 class="font-bold text-gray-800 mt-6 italic underline decoration-gray-300">時間によって処理を分ける</h4>
        <ul class="list-disc list-inside space-y-1 text-gray-700 ml-4">
            <li>朝（6時〜12時）：おはようを表示</li>
            <li>昼（12時〜18時）：こんにちはを表示</li>
            <li>夜（それ以外の時間帯（18時〜翌日の6時））：こんばんはを表示</li>
        </ul>

        <div class="bg-gray-800 rounded-lg overflow-hidden mt-6 shadow-xl">
            <div class="bg-gray-700 px-4 py-2 text-xs text-gray-200 font-mono text-center font-bold">条件分岐の埋め込み (test.php)</div>
            <pre class="p-6 text-sm text-white font-mono overflow-x-auto leading-relaxed"><code>&lt;?php
    date_default_timezone_set('Asia/Tokyo');
    $now_hour = (int)date("G");
?&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;タイトル&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;p&gt;今は&lt;?php print $now_hour; ?&gt;時です。&lt;/p&gt;
        &lt;?php if (6 &lt;= $now_hour &amp;&amp; $now_hour &lt; 12) { ?&gt;
            &lt;p&gt;おはよう、太郎さん&lt;/p&gt;
        &lt;?php } elseif (12 &lt;= $now_hour &amp;&amp; $now_hour &lt; 18) { ?&gt;
            &lt;p&gt;こんにちは、太郎さん&lt;/p&gt;
        &lt;?php } else { ?&gt;
            &lt;p&gt;こんばんは、太郎さん&lt;/p&gt;
        &lt;?php } ?&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg border border-gray-300 font-mono text-xs">
            <p class="text-xs text-gray-500 mb-2 font-bold tracking-widest text-center italic underline">実行結果 (19時台に実行した場合)</p>
            &lt;!DOCTYPE html&gt;<br>
            &lt;html lang="ja"&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&lt;head&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;title&gt;タイトル&lt;/title&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&lt;/head&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&lt;body&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;今は19時です。&lt;/p&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;こんばんは、太郎さん&lt;/p&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&lt;/body&gt;<br>
            &lt;/html&gt;
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">for文を埋め込む</h3>
        <p class="text-gray-700 leading-relaxed italic border-l-2 pl-4 border-gray-300">
            せっかくなのでfor文を埋め込んだサンプルコードを作ってみましょう。以下は、九九の3の段を表示するプログラムです。
        </p>

        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <div class="bg-gray-700 px-4 py-2 text-xs text-gray-200 font-mono text-center font-bold italic">test.php</div>
            <pre class="p-6 text-sm text-white font-mono overflow-x-auto leading-relaxed"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;タイトル&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;ul&gt;
            &lt;?php for($i = 1; $i &lt; 10; $i++) { ?&gt;
                &lt;li&gt;&lt;?php print '3 x ' . $i . ' = ' . (3 * $i);?&gt;&lt;/li&gt;
            &lt;?php } ?&gt;
        &lt;/ul&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>

        <div class="bg-black p-4 rounded-lg">
            <p class="text-xs text-gray-400 mb-2 font-bold uppercase tracking-widest italic border-b border-gray-700 pb-1">ターミナルでPHPを実行: php test.php</p>
            <pre class="text-green-400 text-xs font-mono"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;タイトル&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;ul&gt;
                            &lt;li&gt;3 x 1 = 3&lt;/li&gt;
                            &lt;li&gt;3 x 2 = 6&lt;/li&gt;
                            &lt;li&gt;3 x 3 = 9&lt;/li&gt;
                            &lt;li&gt;3 x 4 = 12&lt;/li&gt;
                            &lt;li&gt;3 x 5 = 15&lt;/li&gt;
                            &lt;li&gt;3 x 6 = 18&lt;/li&gt;
                            &lt;li&gt;3 x 7 = 21&lt;/li&gt;
                            &lt;li&gt;3 x 8 = 24&lt;/li&gt;
                            &lt;li&gt;3 x 9 = 27&lt;/li&gt;
                    &lt;/ul&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}