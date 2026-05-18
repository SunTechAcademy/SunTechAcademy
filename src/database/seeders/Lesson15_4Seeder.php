<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson15_4Seeder extends Seeder
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
                'sort_order' => 4,
            ],
            [
                'title' => 'IP',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">IP</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                HTTP通信は、クライアントのリクエストとサーバのレスポンスという形で通信すること。インターネット上で特定のサーバが持っているリソースにアクセスするには、URLを使うこと。以上を、ここまで学びました。
            </p>
            <p>
                実はインターネット上にあるコンピュータの住所を特定するものは <strong>IPアドレス</strong> であり、URLではありません。URLはIPアドレスへ変換されることになります。
            </p>
            <p>
                Webアプリケーションやインターネット通信のことを学ぶうえで、IPアドレスの理解は欠かせません。このチャプターで学んでいきましょう。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">IPアドレスはコンピュータの住所</h3>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                IP（Internet Protocol）とは、インターネットのための通信プロトコルです。インターネットの通信はIPによって成り立っています。
            </p>
            <p>
                IPがインターネットのプロトコルであるなら、HTTPは何だったのか？と思うかも知れません。実はHTTPは、IPによってインターネットが接続されているという前提があったうえで、アプリケーション同士が通信するための通信プロトコルです。つまり、<strong>IPこそがインターネットを成立させているプロトコル</strong>なのです。
            </p>
            <p>
                WebブラウザがHTTPリクエストメッセージをWebサーバに向けて送りますが、このアプリケーション間の通信がインターネットを介すとき、HTTPリクエストメッセージはIPによって運ばれることになります。
            </p>
        </div>

        <div class="flex justify-center py-4">
            <img src="/images/Lesson15-5.png" alt="IPによるデータの運搬イメージ" class="max-w-md w-full h-auto shadow-sm rounded border">
        </div>

        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                そして、IPアドレスとは、ネットワーク上で個々のコンピュータを特定するための番号（住所）です。ネットワークに繋がっている個々のコンピュータにはそれぞれ固有のIPアドレスが設定されています。
            </p>
            <p>
                IPアドレスは、0~255（2の8乗=256通り、8ビット、1バイト）の数字が.区切りで4つ合わさった形として表現されます。172.217.161.35のようなイメージです。0.0.0.0から255.255.255.255まで住所を割り当てることができるため、約43億通り（256 x 256 x 256 x 256 = 4,294,967,296）の住所パターンを作り出すことができます。
            </p>
        </div>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 space-y-3">
            <p class="text-sm text-gray-700 leading-relaxed">
                上記はIPアドレスの中でも <strong>IPv4</strong> と呼ばれる仕様です。インターネットの爆発的な普及により約43億の住所パターンの空きが急速に減ってきたため、さらに多くの住所パターンを作り出せるIPv6という新しい仕様も登場しました。本カリキュラムではIPv6の解説は省略しますので、興味ある方はご自身で調べてみましょう。
            </p>
            <p class="text-sm text-gray-700 leading-relaxed">
                なお、IPアドレスが重複することはありません。重複を許してしまうと、まったく別の場所に同一の住所が存在してしまい、どちらの住所とやり取りするべきか判断できないためです。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">URLのホスト名とドメイン名は実はIPアドレス</h3>
        <p class="text-gray-700 leading-relaxed">
            URLの中のホスト名（コンピュータ名）＋ドメイン名（ネットワーク名）がインターネットの住所だと説明してきましたが、実は、ホスト名＋ドメイン名は特定のIPアドレスに対応しています。たとえば <code>www.google.co.jp</code> が <code>172.217.161.35</code> と対応している場合、どちらを使っても同じコンピュータへたどり着けます。
        </p>
        <p class="text-gray-700 leading-relaxed">
            <code>www.google.co.jp</code> と <code>172.217.161.35</code> で人間にとって認識しやすいのは、当然<code>www.google.co.jp</code> です。つまりホスト名＋ドメイン名は人間用に作られたIPアドレスだと思ってください。172.217.161.35 といった数字の羅列はコンピュータが内部的に扱うのに便利な形なのです。
        </p>
        <div class="bg-gray-800 text-white p-6 rounded-xl font-mono">
            ちなみに、ホスト名＋ドメイン名のことを <span class="text-yellow-400 font-bold">FQDN（Fully Qualified Domain Name）</span> と呼びます。FQDNと出たらホスト名＋ドメイン名のこと（www.google.co.jp など）だと覚えておきましょう。
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">DNSサーバがURLとIPアドレスの対応表を持っている</h3>
        <p class="text-gray-700 leading-relaxed">
            この広大なインターネットの世界で、<code>www.google.co.jp</code> というFQDNのIPアドレスは <code>172.217.161.35</code> だとわかるには、何らかのシステムがその対応表を常に持って、その表の管理・保守を続ける必要があります。そのためのシステムが <strong>DNS（Domain Name System、ドメイン・ネーム・システム）</strong> です。
        </p>
        <p class="text-gray-700 leading-relaxed">
            以下では、DNSのシステムが動作しているサーバのことを <strong>DNSサーバ</strong> と呼びます。
        </p>
        
        <div class="bg-gray-50 p-8 rounded-2xl border border-gray-200">
            <h4 class="font-bold text-gray-800 mb-4">名前解決の流れ</h4>
            <p class="text-sm text-gray-600 mb-6">私たちがWebブラウザのURL入力欄に <code>https://www.google.co.jp/</code> と入力してアクセスしたときのことを考えます。</p>
            <ol class="space-y-4">
                <li class="flex gap-4">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">1</span>
                    <p class="text-gray-700">Webブラウザは、DNSサーバに「www.google.co.jp のIPアドレスを教えてくれ」とリクエストを送る。</p>
                </li>
                <li class="flex gap-4">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">2</span>
                    <p class="text-gray-700">DNSサーバはその対応表を持っているため、www.google.co.jp のIPアドレス 172.217.161.35 をレスポンスとして返す。</p>
                </li>
            </ol>
        </div>

        <p class="text-gray-700 leading-relaxed">
            このようにDNSからFQDNに対応するIPアドレスをもらって、ようやくインターネットを介した通信ができます。DNSサーバからIPアドレスを教えてもらう操作を <span class="font-bold text-blue-600 underline">名前解決</span> と呼びます。
        </p>

        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm space-y-4">
            <p class="text-sm text-gray-600">下記のリンクではDNSを利用した名前解決サービスを提供しているWebサイトを紹介しています。気になるWebサイトのIPアドレスを確認してみると、おもしろいかもしれません。</p>
            <a href="https://www.cman.jp/network/support/nslookup.html" target="_blank" class="text-blue-600 font-bold hover:underline flex items-center gap-2">
                CMAN（https://www.cman.jp/network/support/nslookup.html）
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
        </div>

        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                逆に、DNSサーバがなければ、<code>https://www.google.co.jp</code> と入力してもIPアドレスを取得できないため、Webページにアクセスできません。<code>https://172.217.161.35/</code> のように、IPアドレスをURL欄に入力しなければなりません。
            </p>
            <p>
                また、それ以外にもDNSには利点があります。たとえばWebサーバのIPアドレスが変更された場合、自分で対応表を持っていると都度自分で更新する必要がありますが、DNSサーバに任せていれば情報の更新もDNSサーバが行なうので、<code>www.google.co.jp</code> で新しいIPアドレスを得ることができるようになるという利点です。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">DNSサーバの階層構造とFQDNの名前解決</h3>
        <p class="text-gray-700 leading-relaxed">
            もう少し詳細に、名前解決をする流れを見てみます。<br>
            <code>www.google.co.jp</code> は <code>.</code> でいくつかに区切られています。<code>www</code>, <code>google</code>, <code>co</code>, <code>jp</code> です。
        </p>
        <ul class="list-disc pl-6 space-y-2 text-gray-700">
            <li>もっとも広い領域を示すのが、日本を示す <strong>jp</strong> です。</li>
            <li>次にあるのが <strong>co</strong> で、これは commercial（商用、営利目的）という意味を示します。</li>
            <li>その次にあるのは、日本の営利目的の会社である <strong>google</strong> のドメインです。</li>
            <li><strong>www</strong> はホスト名です。googleドメインの中の www というホストを指定している、という意味になります。</li>
        </ul>
        <p class="text-gray-700 leading-relaxed">
            この階層構造が、そのままDNSサーバの階層構造になります。名前解決では、この階層構造が重要な点となっています。
        </p>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h4 class="font-bold text-blue-900 mb-4">具体的手順</h4>
            <ol class="list-decimal pl-6 space-y-3 text-gray-800 text-sm">
                <li>まずは <strong>ルートDNSサーバ</strong> に「jp のDNSサーバはどこにありますか？」とリクエストを送り、レスポンスとして jp のDNSサーバのIPアドレスを受け取る</li>
                <li>それを利用して、次は <strong>jpのDNSサーバ</strong> に「co.jp のDNSサーバはどこですか？」とリクエストを送り、co.jp のDNSサーバのIPアドレスを受け取る</li>
                <li>同様にそれを利用して、<strong>co.jp のDNSサーバ</strong> に「google.co.jpはどこですか？」とリクエストを送ると、google.co.jp のDNSサーバのIPアドレスが返ってくる</li>
                <li>最後に <strong>google.co.jp のDNSサーバ</strong> に、「www.google.co.jp のホストはどこですか？」と聞いて、そのIPアドレスを受け取る</li>
            </ol>
        </div>

        <p class="text-gray-700">これでようやく<code>www.google.co.jp</code>のIPアドレスがわかったため、Webサーバへアクセス（HTTPリクエストを送信）できます。</p>

        <div class="flex flex-col items-center py-6">
            <img src="/images/Lesson15-6.png" alt="DNS階層構造のイメージ" class="max-w-md w-full h-auto shadow-sm rounded border">
            <p class="text-xs text-gray-500 mt-2">URLにアクセスする際、DNSサーバにURLのFQDNのIPアドレスを問い合わせるときのイメージ</p>
        </div>

        <div class="bg-yellow-50 p-6 rounded-xl border-l-4 border-yellow-400 space-y-4">
            <p class="text-sm text-gray-800 leading-relaxed">
                <span class="font-bold">💡 ポイント:</span><br>
                上の図は、Webページが表示されるまでの仕組みでもあります。本レッスンの最後に、特定のページへアクセスした際の一連の流れを説明してもらう課題を用意しています。ご自身の言葉で説明できるように確認しましょう。
            </p>
            <p class="text-xs text-gray-600 leading-relaxed">
                ※こちらの内容は説明を単純化しています。実際の名前解決においては、キャッシュサーバが直接の問い合わせを行います。詳細は下記のページを参照ください。<br>
                <a href="https://www.nic.ad.jp/ja/basics/terms/dns-cache.html" target="_blank" class="text-blue-600 hover:underline">参照：DNSキャッシュ（JPNIC）</a>
            </p>
        </div>

        <p class="text-gray-700 text-sm italic">
            なお、.jpだけでなく、.com や .net など、DNSサーバの階層構造はドメインの数だけあります。そのため、今回の例で見たようにルートDNSサーバから順番に名前解決します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">グローバルIPアドレスとプライベートIPアドレス</h3>
        <p class="text-gray-700 leading-relaxed">
            IPアドレスはネットワーク上で個々のコンピュータを特定するための番号（住所）で、ネットワークに繋がっている個々のコンピュータは固有のIPアドレスが設定されている、と説明しました。
        </p>
        <p class="text-red-600 font-bold italic">しかし、厳密には少し異なります。</p>
        <p class="text-gray-700 leading-relaxed">
            実際にはコンピュータではなく、インターネット上に数多くある1つの小さなネットワークに対して1つのIPアドレスが与えられています。そのIPアドレスのことを <strong>グローバルIPアドレス</strong> と呼びます。
        </p>
        <p class="text-gray-700 leading-relaxed">
            グローバルIPアドレスこそ、インターネット上で唯一のIPアドレスとなります。したがって、<code>172.217.161.35</code> というIPアドレスが指し示すのは小さなネットワークで、小さなネットワークはグローバルIPアドレスによって一意に決まります。
        </p>
        <p class="text-gray-700 leading-relaxed">
            そして、小さなネットワーク内、つまり家庭や会社などの小さな組織内の、個々のコンピュータに与えられているIPアドレスのことを <strong>プライベートIPアドレス</strong> と呼びます。プライベートIPアドレスは、<code>192.168.0.100</code>のように<code>192.168.xxx.xxx</code>のような形をしていることが多いです。
        </p>
        <p class="text-gray-700 leading-relaxed">
            プライベートIPアドレスは小さなネットワーク限定のIPアドレスであるため、このアドレスが設定されたコンピュータをインターネット上では特定できません。ただし、AとBという別々のネットワーク内に存在するそれぞれのコンピュータに <code>192.168.0.100</code>という同じIPアドレスが割り当てられている分には問題ありません。
        </p>

        <div class="flex flex-col items-center py-6">
            <img src="/images/Lesson15-7.png" alt="グローバルIPとプライベートIPの概念図" class="max-w-md w-full h-auto shadow-sm rounded border">
            <p class="text-xs text-gray-500 mt-2 italic">※当然ですが、A内で192.168.0.100を割り当てたコンピュータが2つある状態は許されません。</p>
        </div>

        <div class="bg-gray-100 p-6 rounded-xl space-y-4">
            <h4 class="font-bold text-gray-800">プライベートIPアドレスが生まれた背景</h4>
            <p class="text-sm text-gray-700 leading-relaxed">
                プライベートIPアドレスが生まれた背景には、グローバルIPアドレスの数が一因です。<br>
                IPv4の場合、IPアドレスが約43億通りの住所を作れると説明しましたが、将来的に足らなくなると想定されています。そのため、小さなネットワーク内の各コンピュータにまでグローバルIPアドレスを設定すると、すぐに空きが無くなります。<br>
                <strong>グローバルIPアドレスをネットワークの住所、プライベートIPアドレスをネットワーク内の個々のコンピュータの住所</strong>とすることで、グローバルIPアドレスの節約をしているのです。
            </p>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">グローバルIPのネットワークからコンピュータを特定するにはポート番号が活躍する</h3>
        <p class="text-gray-700 leading-relaxed">
            実はプライベートIPアドレスを利用すると、1つ問題が発生します。
        </p>
        <div class="bg-red-50 p-6 rounded-xl border border-red-100 text-red-900 text-sm leading-relaxed">
            プライベートIPアドレスを持っているクライアントがサーバへリクエストを送っても、所属するネットワークの外にリクエストが出ると、リクエストに設定された <strong>クライアント（リクエストの送信元）のIPアドレス</strong> の情報が書き換わってしまいます。<br><br>
            そのため、サーバが受け取ったリクエストに設定されているクライアントのIPアドレスは「所属するネットワークのグローバルIPアドレス」になっています。つまり、サーバにとっては「具体的にどのコンピュータが自分に向けてリクエストを送ったのか」がわからない、という問題です。
        </div>

        <p class="text-gray-700 leading-relaxed">
            これを解決する方法の1つが <strong>NAPT（Network Address Port Translation）</strong> という技術です。NAPTは <strong>IPマスカレード</strong> とも呼ばれます。「P（Port）」とあるように、NAPTではポート番号を利用します。
        </p>
        <p class="text-gray-700 leading-relaxed">
            ポート番号には、送信元ポート番号と宛先ポート番号があります。宛先ポート番号はHTTPの場合80で決まっていますが、送信元ポート番号には決まりがありません。そこで、適当な送信元ポート番号を設定することで、これとグローバルIPアドレスからコンピュータを特定できるようにしたのがNAPTです。<br>
            NAPTの技術により、リクエストを送ったコンピュータへレスポンスが届きます。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-4">
            <img src="/images/Lesson15-8.png" alt="NAPTの動作イメージ1" class="w-full h-auto shadow-sm rounded border">
            <img src="/images/Lesson15-9.png" alt="NAPTの動作イメージ2" class="w-full h-auto shadow-sm rounded border">
        </div>

        <div class="space-y-6 mt-10">
            <h4 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-4">補足：ウェルノウンポート番号</h4>
            <p class="text-gray-700 leading-relaxed">
                ポート番号は、通信プロトコルと密接な関係があります。利用頻度の高い通信プロトコルにはデフォルトのポート番号が決められており、ポート番号から通信プロトコルを推測できます。
            </p>
            <p class="text-gray-700 leading-relaxed">
                以下のようなポート番号を <strong>ウェルノウンポート番号（Well-known Port Number）</strong> と言います。「よく知られたポート番号」という意味です。
            </p>

            <div class="overflow-x-auto border border-gray-200 rounded-xl">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">通信プロトコル</th>
                            <th class="px-4 py-3 text-left">ポート番号</th>
                            <th class="px-4 py-3 text-left">プロトコルの使用目的</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr><td class="px-4 py-3 font-bold">FTP</td><td class="px-4 py-3 font-mono">20, 21</td><td class="px-4 py-3">ファイル転送用</td></tr>
                        <tr><td class="px-4 py-3 font-bold">SMTP</td><td class="px-4 py-3 font-mono">25</td><td class="px-4 py-3">メール送信用</td></tr>
                        <tr><td class="px-4 py-3 font-bold text-blue-600">HTTP</td><td class="px-4 py-3 font-mono text-blue-600">80</td><td class="px-4 py-3 text-blue-600">Web用</td></tr>
                        <tr><td class="px-4 py-3 font-bold">POP</td><td class="px-4 py-3 font-mono">110</td><td class="px-4 py-3">メール受信用</td></tr>
                        <tr><td class="px-4 py-3 font-bold">NTP</td><td class="px-4 py-3 font-mono">123</td><td class="px-4 py-3">時刻同期用</td></tr>
                        <tr><td class="px-4 py-3 font-bold">IMAP</td><td class="px-4 py-3 font-mono">143</td><td class="px-4 py-3">メール受信用</td></tr>
                        <tr><td class="px-4 py-3 font-bold text-green-600">SSL（HTTPS）</td><td class="px-4 py-3 font-mono text-green-600">443</td><td class="px-4 py-3 text-green-600">暗号化用</td></tr>
                    </tbody>
                </table>
            </div>
            <p class="text-sm text-gray-500 italic">
                ウェルノウンポート番号は、正しい使用目的で使う場合、その記述を省略できます。
            </p>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}