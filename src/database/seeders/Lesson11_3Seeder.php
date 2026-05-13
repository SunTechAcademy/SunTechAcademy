<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson11_3Seeder extends Seeder
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
                'sort_order' => 3,
            ],
            [
                'title' => 'Webサーバ（XAMPP）の導入とブラウザでの確認',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">Webサーバ（XAMPP）の導入とブラウザでの確認</h2>
        <p class="text-gray-700 leading-relaxed mb-4">
            これまではターミナル上で <code>php</code> コマンドを入力してプログラムを実行してきましたが、ここからは<strong>「Webサーバ」</strong>を使って、ブラウザ（Chromeなど）にプログラムの結果を表示させる学習に入ります。
        </p>
        <p class="text-gray-700 leading-relaxed">
            そのために、PHPの開発環境を丸ごとセットアップできる <strong>XAMPP（ザンプ）</strong> を導入します。
        </p>
    </section>

    <section class="space-y-6 text-left">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">1. XAMPPをインストール・起動する</h3>
        <p class="text-gray-700 leading-relaxed">
            OSによってインストール手順が異なります。自分のPCのOSに合わせた資料を確認して進めてください。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6 text-left">
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2 py-1 bg-blue-600 text-white text-xs rounded font-bold">Windows用</span>
                    <h4 class="font-bold text-blue-900 text-lg">Qiita 解説記事</h4>
                </div>
                <a href="https://qiita.com/Lyla56/items/7d36f178347e78dc9fc2" target="_blank" class="inline-flex items-center gap-2 px-4 py-3 bg-white border border-blue-300 rounded-lg hover:bg-blue-50 transition-colors text-blue-700 font-bold text-sm shadow-sm break-all">
                    Windows版 XAMPPインストール手順
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2 py-1 bg-gray-800 text-white text-xs rounded font-bold">Mac用</span>
                    <h4 class="font-bold text-gray-900 text-lg">補足資料 (PDF)</h4>
                </div>
                <a href="https://www.ric.co.jp/pdfs/content/81/php_hosoku_4_3_b.pdf" target="_blank" class="inline-flex items-center gap-2 px-4 py-3 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-gray-800 font-bold text-sm shadow-sm break-all">
                    Mac版 XAMPPセットアップガイド
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
        </div>

        <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded shadow-sm">
            <h4 class="font-bold text-green-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                XAMPPを起動する手順
            </h4>
            <p class="text-gray-700 mb-4">インストールが完了したら、以下の手順でWebサーバを起動します。</p>
            <ol class="list-decimal ml-6 space-y-2 text-gray-700">
                <li>XAMPP（またはManager-osx）を開き、<strong>Manage Servers</strong> タブを選択します。</li>
                <li><strong>MySQL Database</strong>、<strong>ProFTPD</strong>、<strong>Apache Web Server</strong> を順番に選択し、<strong>Start</strong> ボタンをクリックします。</li>
                <li>すべてのステータスが<strong>緑色</strong>になれば正常に起動しています。</li>
            </ol>
            <div class="mt-6 border border-green-200 rounded-xl overflow-hidden bg-white">
                <img src="/images/Lesson11-3.png" alt="XAMPP起動画面" class="w-full h-auto">
            </div>
        </div>
    </section>

    <section class="space-y-8 text-left">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-left">2. 環境構築 STEP 1 & 2</h3>
        
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <span class="bg-blue-600 text-white font-bold px-3 py-1 rounded">STEP 1</span>
                <h4 class="text-lg font-bold text-gray-800">htdocsフォルダを探す</h4>
            </div>
            <p class="text-gray-700">Webに公開するファイルを置くための特別なフォルダを探します。</p>
            <ul class="space-y-2 font-mono text-sm bg-gray-100 p-4 rounded-lg border">
                <li class="flex items-center gap-2">
                    <span class="w-20 font-bold text-blue-600 inline-block">Windows:</span>
                    <span>C:\xampp\htdocs</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-20 font-bold text-gray-600 inline-block">Mac:</span>
                    <span>/Applications/XAMPP/htdocs</span>
                </li>
            </ul>
        </div>

        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <span class="bg-blue-600 text-white font-bold px-3 py-1 rounded">STEP 2</span>
                <h4 class="text-lg font-bold text-gray-800">フォルダとファイルを作成</h4>
            </div>
            <p class="text-gray-700">
                <code>htdocs</code> の中に <strong><code>lesson</code></strong> というフォルダを作ります。
            </p>

            <div class="bg-amber-50 border-l-4 border-amber-400 p-4">
                <p class="font-bold text-amber-800 mb-1">MacBookユーザーの方へ：VS Codeでの開き方</p>
                <p class="text-sm text-gray-700 leading-relaxed">
                    VS Codeで以下のパスを開いて作業してください。<br>
                    <strong>アプリケーション ＞ XAMPP ＞ xamppfiles ＞ htdocs</strong><br>
                    を開き、その中に <code>lesson</code> フォルダを作成してください。
                </p>
            </div>

            <p class="text-gray-700 mt-4 italic">
                作成した <code>lesson</code> フォルダ内に、新規ファイル <strong><code>hello.php</code></strong> を作成し、以下のコードを全て記載してください。
            </p>

            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-xl">
                <div class="bg-gray-700 px-4 py-2 text-xs text-gray-200 font-mono text-left">hello.php</div>
                <pre class="p-6 text-sm text-white font-mono overflow-x-auto leading-relaxed"><code>&lt;?php
    // タイムゾーンを設定
    date_default_timezone_set('Asia/Tokyo');
?&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;PHP HelloWorld&lt;/title&gt;
    &lt;style&gt;
        body { font-family: "Helvetica Neue", Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; }
        h1 { color: #333; margin-bottom: 1rem; }
        .msg { color: #666; font-size: 1.2rem; }
        .time { color: #3498db; font-weight: bold; margin-top: 1rem; }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;div class="card"&gt;
        &lt;h1&gt;&lt;?php print "Hello World!"; ?&gt;&lt;/h1&gt;
        &lt;p class="msg"&gt;ブラウザでPHPを動かしています！&lt;/p&gt;
        &lt;p class="time"&gt;現在時刻：&lt;?php print date('H:i:s'); ?&gt;&lt;/p&gt;
    &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
            </div>
        </div>
    </section>

    <section class="space-y-6 text-left">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-left">3. ブラウザで確認する</h3>
        <p class="text-gray-700 leading-relaxed text-left">
            ファイルが保存できたら、ブラウザ（Chromeなど）のアドレスバーに以下のURLを入力して、Enterキーを押してください。
        </p>

        <div class="bg-black p-6 rounded-xl my-6 border-2 border-blue-500 shadow-lg">
            <p class="text-xs text-blue-400 mb-2 font-bold uppercase tracking-widest text-center">ブラウザに入力するURL</p>
            <code class="text-white text-xl block text-center font-mono">http://localhost/lesson/hello.php</code>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm space-y-4">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                表示の確認
            </h4>
            <p class="text-gray-700 text-left">ブラウザ上に以下のように表示されればOKです！</p>
            <div class="border-2 border-dashed border-gray-300 p-8 rounded-lg bg-gray-50 text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center">Hello World!</h1>
                <p class="text-gray-600 text-center">ブラウザでPHPを動かしています！</p>
                <p class="text-blue-500 font-bold mt-2 text-center">現在時刻：(その時の時間)</p>
            </div>
            
            <div class="mt-8 border border-gray-200 rounded-xl overflow-hidden shadow-md">
                <img src="/images/Lesson11-4.png" alt="ブラウザ実行結果画面" class="w-full h-auto">
            </div>
        </div>
    </section>

    <section class="space-y-8 text-left border-t pt-12">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-left">（補足）関数を使ってプログラムをすっきりさせる</h3>
        <p class="text-gray-700 leading-relaxed text-left">
            関数を使い、ソースコードを見やすくしましょう。
        </p>

        <div class="space-y-4 text-left">
            <p class="text-gray-700"><code>lesson</code> フォルダに、新しく <strong><code>index.php</code></strong> という名前のファイルを作成してください。</p>
            
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-xl">
                <div class="bg-gray-700 px-4 py-2 text-xs text-gray-200 font-mono text-left">index.php</div>
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
    &lt;p&gt;今は&lt;?php print $now_hour; ?&gt;時です。&lt;/p&gt;
    &lt;p&gt;&lt;?php print greeting($now_hour); ?&gt;、太郎さん&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
            </div>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 space-y-6 text-left shadow-sm">
            <h4 class="font-bold text-blue-900 flex items-center gap-2 text-left">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                引数の名前についての補足
            </h4>
            <p class="text-gray-700 text-sm leading-relaxed text-left">
                引数名は同じでなくても動作します。<br>
                <code>&lt;?php print greeting( 渡す値の変数名 ); ?&gt;</code> の引数で指定した値を、<br>
                <code>&lt;?php function greeting( 受け取る値の変数名 ) { ... } ?&gt;</code> の引数で受け取ります。
            </p>
            <p class="text-gray-700 text-sm leading-relaxed text-left">
                変数名が何であれ、<strong>渡す値の変数名</strong> で指定した変数の中身を、 <strong>受け取る値の変数名</strong> で指定した変数で受け取るというしくみになっているので、文法上同じ変数名である必要がないのです。
            </p>
            <p class="text-gray-700 text-sm leading-relaxed text-left">
                よって、上記のサンプルのように 渡す値の変数名 が <code>$now_hour</code> で、 受け取る値の変数名 が <code>$hour</code> と引数名を変えても、プログラムは正常に動作します。
            </p>
            
            <div class="border-t border-blue-200 pt-4">
                <p class="font-bold text-blue-800 text-sm mb-2 text-left">もう少し詳しく：イメージ図</p>
                <div class="bg-white p-4 rounded border border-blue-200 font-mono text-sm text-blue-700">
                    $a = 1;<br>
                    $b = $a; // aの値をbに渡している<br>
                    print($b); // 結果は 1
                </div>
                <p class="text-gray-700 text-sm mt-3 leading-relaxed text-left">
                    このことと、今回の引数は似ています。イメージとして、引数でも <code>$hour = $now_hour;</code> のような受け渡しが内部で行われていると考えて構いません。
                </p>
            </div>
        </div>
    </section>

    <div class="mt-12 p-8 bg-blue-600 rounded-2xl text-white text-center shadow-xl">
        <h4 class="text-xl font-bold mb-2 text-left">おめでとうございます！</h4>
        <p class="opacity-90 text-left">
            これで、PHPを「Webプログラミング言語」として扱う準備が整いました。<br>
            ブラウザを更新（リロード）するたびに秒数が変わるのを見て、プログラムがその場で動いていることを実感しましょう。
        </p>
    </div>
</div>
EOF
            ]
        );
    }
}