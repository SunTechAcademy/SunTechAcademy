<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson15_6Seeder extends Seeder
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
                'sort_order' => 6,
            ],
            [
                'title' => 'まとめ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">まとめ</h2>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-6">
            <p>
                インターネットに繋がることについて、最後にまとめておきましょう。
            </p>
            <p>
                アプリケーション間の通信モデルは<strong>クライアント／サーバモデル</strong>でした。クライアントがサーバに向けてリクエストを送り、サーバはリクエストを受け取ると、要求に応じたレスポンスをクライアントに向けて返します。
            </p>
            <p>
                このとき、サーバのリソースの位置は<strong>URL</strong>によって特定されました。そして実際にはURLの中のホスト名＋ドメイン名（FQDN）は<strong>IPアドレス</strong>と1対1で対応し、<strong>DNSサーバ</strong>にリクエストを送ることで相互に変換が可能でした。コンピュータの位置はIPアドレスによって特定されます。コンピュータの中のリソースはURLのパス部分によって指定されます。
            </p>
            <p>
                インターネットを介したアプリケーション間の通信は、<strong>TCP/IPモデル</strong>によって実現されています。TCP/IPモデルは5つの階層になっており、それらはユーザに近い上位層のアプリケーション層から、下位層の物理層まであります。
            </p>

            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                <ul class="space-y-2 font-bold text-blue-900">
                    <li class="flex items-center gap-2">
                        <span class="w-4 h-4 bg-blue-600 rounded-full"></span>
                        アプリケーション層（HTTP, SMTP, POP, FTP, DNS, NTP等）
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-4 h-4 bg-blue-400 rounded-full"></span>
                        トランスポート層（TCP, UDP）
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-4 h-4 bg-blue-300 rounded-full"></span>
                        インターネット層（IP等）
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-4 h-4 bg-gray-400 rounded-full"></span>
                        データリンク層（PPPoE等）
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-4 h-4 bg-gray-300 rounded-full"></span>
                        物理層（回線、ケーブル等）
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="flex flex-col items-center py-6">
        <img src="/images/Lesson15-13.png" alt="TCP/IPモデルのアプリケーション間通信" class="max-w-2xl w-full h-auto shadow-md rounded-lg border">
        <p class="text-xs text-gray-500 mt-3 font-medium text-center italic">TCP/IPモデルのアプリケーション間通信（インターネット標準仕様）</p>
    </section>

    <section class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
                <h4 class="text-lg font-bold text-blue-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    アプリケーション層
                </h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    アプリケーション層の中でも、本コースではWebを中心に見ていくため、WebブラウザとWebサーバのアプリケーション間通信を支えるプロトコルである<strong>HTTP</strong>について詳しく学びました。そのとき、HTTPリクエストによるリソースの操作（CRUD）のために <strong>GET, POST, PUT, DELETE</strong>の4つのメソッドが用意されていました。
                </p>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
                <h4 class="text-lg font-bold text-blue-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    トランスポート層
                </h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    トランスポート層は、<strong>TCP</strong>もしくは<strong>UDP</strong>が利用されます。TCPは通信相手とのコネクションを確立し、しっかりデータが送受信されているかを監視します。再送信できる仕組みも提供しており、信頼性の高いプロトコルです。それに対し、UDPはコネクションを確立しないため信頼性が低く、音声や映像などで利用されているプロトコルです。
                </p>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
                <h4 class="text-lg font-bold text-blue-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    インターネット層
                </h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    インターネット層では、コンピュータ同士を繋げるための核となる通信プロトコルである<strong>IP</strong>を提供しています。インターネット上の小さなネットワークは<strong>グローバルIPアドレス</strong>によって特定され、さらに小さなネットワーク内では<strong>プライベートIPアドレス</strong>によって対応するコンピュータが特定されました。
                </p>
                <p class="text-sm text-blue-700 font-bold mt-2">
                    インターネットはIPによって繋がっています。そしてそれを実現する機器は<strong>ルータ</strong>でした。
                </p>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
                <h4 class="text-lg font-bold text-blue-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    データリンク層・物理層
                </h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    データリンク層、物理層は、より機械的な部分のプロトコルです。電気や光で通信するために定められたルールとなります。インターネット層によってインターネットの接続は実現されていますが、そのためには下層であるデータリンク層や物理層の支えが不可欠です。
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