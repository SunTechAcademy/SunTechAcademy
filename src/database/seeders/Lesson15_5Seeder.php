<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson15_5Seeder extends Seeder
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
                'sort_order' => 5,
            ],
            [
                'title' => 'TCP/IPモデル',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">TCP/IPモデル</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>これまで下記の内容について学んできました。</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>クライアント／サーバモデル（リクエスト／レスポンス）</li>
                <li>HTTP</li>
                <li>URL</li>
                <li>IP</li>
            </ul>
            <p>
                この中で、通信プロトコルに分類されるのがHTTPとIPです。IPはインターネット接続を支えるための通信プロトコルで、HTTPはIPを前提としたアプリケーション同士（WebブラウザとWebサーバ）でやりとりするための通信プロトコルです。
            </p>
            <p>
                「IPを前提とした」の部分がわかりにくいかも知れません。これは、HTTPとIPではプロトコルの階層が異なっているという意味です。
            </p>
            <p>
                下記で紹介している各種プロトコルは階層構造になっており、その階層を <strong>TCP/IPモデル</strong> と呼んでいます。現在のインターネットを介したアプリケーション間の通信は、TCP/IPモデルという階層構造によって成り立っています。
            </p>
            <p>ここからはTCP/IPモデル（プロトコルの階層）について体系的に学んでいきます。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">TCP/IPモデルの階層構造</h3>
        <p class="text-gray-700 leading-relaxed">TCP/IPモデルは5つの階層によって成り立っています。</p>
        
        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-800 text-white font-bold">
                    <tr>
                        <th class="px-4 py-3 whitespace-nowrap">5階層</th>
                        <th class="px-4 py-3">プロトコル例</th>
                        <th class="px-4 py-3">役割</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr>
                        <td class="px-4 py-4 font-bold text-blue-600 bg-blue-50">アプリケーション層</td>
                        <td class="px-4 py-4">HTTP, SMTP, POP, FTP, DNS, NTP 等</td>
                        <td class="px-4 py-4">アプリケーション同士がデータをやり取りするための通信プロトコル群</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 font-bold text-blue-600 bg-blue-50">トランスポート層</td>
                        <td class="px-4 py-4">TCP, UDP</td>
                        <td class="px-4 py-4">アプリケーションがしっかりデータを送れるように通信路を確保する</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 font-bold text-blue-600 bg-blue-50">インターネット層</td>
                        <td class="px-4 py-4">IP 等</td>
                        <td class="px-4 py-4">複数のネットワークを相互に接続した環境（インターネット）で、個々のコンピュータ間のデータ送受信を実現する</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 font-bold text-blue-600 bg-blue-50">データリンク層</td>
                        <td class="px-4 py-4">PPPoE 等</td>
                        <td class="px-4 py-4">電気信号の伝送路を確保する</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 font-bold text-blue-600 bg-blue-50">物理層</td>
                        <td class="px-4 py-4">回線、ケーブル 等</td>
                        <td class="px-4 py-4">物理的に繋がっていて電気信号を送れるようにする</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>
                先ほど学んだHTTPはアプリケーション層の通信プロトコルで、IPはインターネット層の通信プロトコルとなります。
            </p>
            <p>
                これらの階層は下層にいくほど、物理的なケーブルや回線による電気信号の通信プロトコルに近くなります。そして上層に行くほど、Webブラウザといったユーザが直接操作するアプリケーションの通信プロトコルに近くなります。
            </p>
        </div>

        <div class="flex flex-col items-center py-6">
            <img src="/images/Lesson15-10.png" alt="TCP/IPモデルの階層イメージ" class="max-w-2xl w-full h-auto shadow-sm rounded border">
            <p class="text-xs text-gray-500 mt-2 italic text-center">TCP/IPモデルで通信するWebアプリケーション例</p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">アプリケーション層の役割</h3>
        <p class="text-gray-700 leading-relaxed">
            アプリケーション層は、<strong>実際にユーザが使うようなアプリケーションの通信を可能にする</strong> ためのプロトコル群です。たとえば、HTTPはWeb用データを送受信するためのプロトコルであり、SMTP, POP, IMAPはメール送受信のためのプロトコルです。アプリケーションごとに送受信するデータの形式が違うため、それぞれ別で定義されています。
        </p>
        <p class="text-gray-700 leading-relaxed">
            コンピュータ同士の通信は、アプリケーション層の通信からスタートします。そのため、アプリケーション層はTCP/IPモデルの中で最上位に位置します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">トランスポート層の役割</h3>
        <p class="text-gray-700 leading-relaxed">
            トランスポート層の役割は、<strong>通信路を作ってデータを通信相手に届ける</strong> ことです。
            トランスポート層にはTCPとUDPがあります。
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm space-y-3">
                <h4 class="font-bold text-blue-600">TCP（Transmission Control Protocol）</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    コネクション型の通信プロトコルで、信頼性が高く、確実にデータを届けるプロトコルです。ただし、高い信頼性のための手続きが増えるため、通信開始するまでに手間がかかるプロトコルです。
                </p>
                <p class="text-sm text-gray-700 leading-relaxed">
                    HTTPも基本的にはTCPを使用して通信しているため、Webページ内の単語が一部表示されないなどのデータ受信ミスはありません。TCP/IPモデルの名のとおり、通常のインターネット通信では、TCPがトランスポート層のプロトコルとして採用されています。
                </p>
            </div>
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm space-y-3">
                <h4 class="font-bold text-green-600">UDP（User Datagram Protocol）</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    高い信頼性を持ったTCPと違って、コネクションレス型の通信プロトコルです。高速通信が可能ですが、信頼性は低くなります。
                </p>
                <p class="text-sm text-gray-700 leading-relaxed">
                    UDPは、音声通話やビデオ通話などリアルタイム性を重視して多少のデータ転送ミスを許せる通信に使用されます。たとえば、ビデオ通話でたまに映像が止まったり音声が届かなかったりしますが、これはUDPが採用されているためです。
                </p>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2 text-[#4A5180]">インターネット層の役割</h3>
        <p class="text-gray-700 leading-relaxed">
            インターネット層、とりわけIPの役割は、個々のコンピュータにIPアドレスを割り当てて、識別することです。IPアドレスを伝って目的の通信相手までデータを転送します。それを実際に実現する機器が <strong>ルータ</strong> です。
        </p>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
            <h4 class="font-bold text-gray-800">ルータはIP通信のための機器</h4>
            <p class="text-sm text-gray-700 leading-relaxed">
                自分のコンピュータが所属するネットワークのIPアドレスは変更されることがあります。インターネットサービスプロバイダ（ISP）との契約内容などによりますが、今日と明日でIPアドレスが変わっていることは珍しくありません。
            </p>
            <p class="text-sm text-gray-700 leading-relaxed font-bold">
                IPアドレスが変更されても同じコンピュータへ通信できるのは、ルータという機器のおかげです。
            </p>
            <p class="text-sm text-gray-700 leading-relaxed">
                ルータはネットワークとネットワークを繋ぐための機器です。ルータはインターネット層（IP）における通信を支える機器であり、ルータのおかげでインターネットに繋がっていると言えます。
            </p>
            <p class="text-sm text-gray-700 leading-relaxed">
                ルータは内部で「ルーティングテーブル」と呼ばれる情報を持ち、宛先IPアドレスを元にデータを届けるためのルートを特定します。データはルータからルータへとバケツリレー形式で運ばれていき、最終的に目的地へ届きます。
            </p>
        </div>

        <div class="flex justify-center py-4">
            <img src="/images/Lesson15-11.png" alt="ルーティングのイメージ" class="max-w-2xl w-full h-auto shadow-sm rounded border">
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データリンク層</h3>
        <p class="text-gray-700 leading-relaxed">
            データリンク層は、このあと触れる「物理層」で直接接続された機器間の通信を可能にします。
            具体的にはLANボード（コンピュータに内蔵されている通信装置）などの機器を制御・識別し、そのための伝送路を確保します。
        </p>
    </section>

    <section class="space-y-6 text-gray-700">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">物理層</h3>
        <p class="text-gray-700 leading-relaxed">
            物理層では、LANボードなどから送出されたデータを電気信号に変換し、ケーブルなどの物理的な伝送媒体に流し込む機能を提供します。
        </p>
        <p class="text-gray-700 leading-relaxed">
            コンピュータのデータを電気信号に変え、無線LANやLANケーブルで繋がっているルータまで運び、光ファイバケーブルなどを伝って外へ出ます。そして、張り巡らされた電線を伝って日本国内のネットワーク（インターネット）に流れていきます。
        </p>
        <div class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-400">
            <p class="text-sm text-blue-900 leading-relaxed">
                国内から海外のネットワークについては、海の底に<strong>「海底ケーブル」</strong>と呼ばれる電線が敷かれていて、それを伝って海外までインターネットが繋がっています。海底ケーブルがすべて切断されてしまうと海外のコンピュータには届かなくなりますが、そうならないように何本も整備されています。
            </p>
            <p class="text-sm text-blue-900 font-bold mt-2 italic">インターネット上のすべてのコンピュータが物理的に繋がっているのです。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">階層構造の役割</h3>
        <p class="text-gray-700 leading-relaxed">
            通信プロトコルの階層構造によって、明確に役割が分担され、各通信プロトコル自身の責任を持つ範囲が小さくなりました。そのおかげで、自分の役割外の機能は、下層のプロトコルにすべて任せることができます。
        </p>
        <p class="text-gray-700 leading-relaxed text-sm">
            たとえば、HTTPはアプリケーション間の通信のことだけを考えます。しっかり通信路を確保しているかはTCPに、インターネットに繋げられるかはIPに、回線が繋がっているかはデータリンク層や物理層に完全に任せてしまいます。
        </p>
        <div class="flex flex-col items-center py-4">
            <img src="/images/Lesson15-12.png" alt="階層構造のメリット" class="max-w-md w-full h-auto">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">OSI参照モデル</h3>
        <p class="text-gray-700 leading-relaxed">
            TCP/IPモデルと似たもので、<strong>OSI参照モデル</strong>というのもあります。OSI参照モデルは7階層で構成されています。TCP/IPのアプリケーション層が、OSI参照モデルでは「アプリケーション層」「プレゼンテーション層」「セッション層」の3つに分けられています。
        </p>

        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-100 text-gray-700 font-bold">
                    <tr>
                        <th class="px-4 py-3">7階層</th>
                        <th class="px-4 py-3">役割</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white text-gray-600">
                    <tr><td class="px-4 py-3 font-bold">アプリケーション層</td><td class="px-4 py-3">アプリケーションの種類やサービスに関する規定</td></tr>
                    <tr><td class="px-4 py-3 font-bold">プレゼンテーション層</td><td class="px-4 py-3">データの種類・表現形式や送信ビット数に関する規定</td></tr>
                    <tr><td class="px-4 py-3 font-bold">セッション層</td><td class="px-4 py-3">通信モードや同期方式に関する規定</td></tr>
                    <tr><td class="px-4 py-3 font-bold">トランスポート層</td><td class="px-4 py-3">信頼性の確保やアプリケーション識別に関する規定</td></tr>
                    <tr><td class="px-4 py-3 font-bold">ネットワーク層</td><td class="px-4 py-3">通信経路や中継経路の選択、識別アドレスに関する規定</td></tr>
                    <tr><td class="px-4 py-3 font-bold">データリンク層</td><td class="px-4 py-3">通信路の確保や伝送制御手段、エラー訂正に関する規定</td></tr>
                    <tr><td class="px-4 py-3 font-bold">物理層</td><td class="px-4 py-3">物理的な回線や機器類、電気信号に関する規定</td></tr>
                </tbody>
            </table>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl text-sm text-gray-700 leading-relaxed space-y-4">
            <p>
                TCP/IPモデルが「実際にプロトコルをコンピュータに実装するには、どのように構成すれば良いか」という<strong>実用化と改良の繰り返しのなかで洗練されていった</strong>のに対して、OSI参照モデルは「通信プロトコルに必要な機能は何か？」という<strong>理論的なアプローチ</strong>で作られたという相違点があります。
            </p>
            <p>
                結果的に、実際にインターネットを構成しているのは実践的なTCP/IPモデルです。
            </p>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">標準化団体</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <h4 class="font-bold text-lg text-blue-800">IETF</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    インターネットの取り決めを行ってきた中心的組織です。HTTPなどのプロトコルの標準化を策定してきました。策定された標準は<strong>RFC（Request For Comments）</strong>という名前で文書化、保存され、広く参照できます。
                </p>
                <p class="text-sm text-gray-700 leading-relaxed">
                    世界中の技術者に門戸が開かれた非常にオープンな組織です。
                </p>
            </div>
            <div class="space-y-4">
                <h4 class="font-bold text-lg text-green-800">ISO</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    国際標準化機構。インターネットだけでなく世界のあらゆる標準化を行っている非政府組織です。
                </p>
                <p class="text-sm text-gray-700 leading-relaxed">
                    各国の代表機関が議論して標準を策定します。OSI参照モデルはこちらの議論によって策定されたモデルです。
                </p>
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}