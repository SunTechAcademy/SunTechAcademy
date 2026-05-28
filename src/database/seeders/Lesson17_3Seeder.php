<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson17_3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得
        $lesson = Lesson::where('title', 'アプリケーションのデプロイ')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 3,
            ],
            [
                'title' => 'デプロイするために利用するサービス',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">デプロイするために利用するサービス</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                ここでは、<strong>Fly.io</strong> と <strong>Supabase</strong> という2つの <strong>PaaS (Platform as a Service)</strong> と呼ばれるサービスを利用します。
            </p>
            <p>
                PaaSは、サーバコンピュータを提供してくれるサービスです。Fly.ioやSupabaseに限らず、多くのPaaSのサービスでは、サーバコンピュータやサーバソフトウェアの操作を容易にするためのシステムやツールも提供していますので、それらの使い方さえ習得できれば、Webアプリケーションを公開できます。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Fly.ioの概要</h3>
        <p class="text-sm">
            このレッスンでは <strong>Fly.io（フライ ドット アイオー）</strong>が提供するサーバにメッセージボードをアップロードして、 Webサービスとして一般に公開する手順を学習します。
        </p>
        <div class="text-xs text-blue-600 underline">
            <a href="https://fly.io/" target="_blank">Deploy app servers close to your users · Fly (https://fly.io/)</a>
        </div>
        <p class="text-sm">
            Fly.ioで公開したアプリケーションには、 <code>アプリケーション名.fly.dev</code> のFQDN（ドメイン名）が割り当てられます。
        </p>
        
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <p class="font-bold text-blue-900 mb-3">無料枠の制限とスペック</p>
            <p class="text-sm mb-4">Fly.ioは、利用者として以下の制限に問題がなければ、従量課金の発生しない無料の範囲内で利用できます。</p>
            <ul class="list-disc pl-6 space-y-2 text-sm text-gray-700">
                <li>稼働できるWebアプリケーションは最大3つまで</li>
                <li><strong>制限された性能の仮想サーバCPU：</strong>1サーバにつき1個の、他ユーザと共有状態のもの</li>
                <li><strong>メモリ：</strong>256MB</li>
                <li><strong>ストレージの容量：</strong>3GB（利用中のサーバ合計）</li>
                <li><strong>転送量：</strong>仮想サーバから外部へ出るデータの転送量が160GBまで</li>
                <li>他ユーザと共有状態のIPv4アドレス</li>
            </ul>
        </div>
        <p class="text-sm italic text-gray-600">
            はじめて作ったWebアプリケーションを、学習も兼ねて最初は小さなスペックで公開し、利用者が増えてきたところで増強する、という柔軟な対応が可能です。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Supabaseの概要</h3>
        <p class="text-sm">
            データベースのPaaSのサービスとして、本カリキュラムでは <strong>Supabase（スパベース）</strong> を利用します。
        </p>
        <div class="text-xs text-blue-600 underline">
            <a href="https://supabase.com/" target="_blank">The Open Source Firebase Alternative | Supabase (https://supabase.com/)</a>
        </div>
        <p class="text-sm leading-relaxed">
            Supabaseは、 <strong>PostgreSQL</strong> というデータベースサーバソフトウェアの環境を提供するサービスです。PostgreSQLは、MySQLと同じく、SQLに対応したデータベースサーバソフトウェアです。
        </p>
        
        <div class="bg-green-50 p-6 rounded-xl border border-green-100">
            <p class="font-bold text-green-900 mb-3">無料枠の制限（クレジットカード不要）</p>
            <ul class="list-disc pl-6 space-y-2 text-sm text-gray-700">
                <li>登録できるデータベースは最大2つまで</li>
                <li>データベースの容量は500MBまで</li>
                <li>データベースのユーザ数は50,000ユーザまで</li>
            </ul>
        </div>
        <p class="text-sm italic text-gray-600">
            こちらのサービスも、最初は無料で利用し、Webアプリケーションの利用者が増えてきたところで有料契約にする、という柔軟な対応が可能です。
        </p>
    </section>

    <hr class="border-t border-gray-200">

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">補足：O/Rマッピング</h3>
        
        

        <p class="text-sm leading-relaxed">
            主要なWebアプリケーションのフレームワークでは <strong>O/Rマッピング</strong> と呼ばれる技術が採用されています。O/Rマッピング（Object-Relational Mapping）は、オブジェクト指向プログラミング言語とデータベースのデータ構造の相違を吸収するための技術です。
        </p>
        <p class="text-sm leading-relaxed">
            O/Rマッピングの技術を利用することで、プログラマーは必要以上にSQLのことを気にする必要がなくなり、プログラミング言語とフレームワークの取り扱い（Webアプリケーションの構築）に集中できます。
        </p>
        
        <div class="p-6 bg-yellow-50 rounded-lg border border-yellow-100">
            <h4 class="font-bold text-gray-800 mb-2">SQLの「方言」を吸収する</h4>
            <p class="text-sm leading-relaxed text-gray-700">
                必要以上にSQLのことを気にする必要がなくなるメリットのひとつが、SQLの <strong>方言</strong> です。SQLの言語は、データベースサーバソフトウェアで共通して使えるものがほとんどですが、日本語に方言があるようにMySQLとPostgreSQLで微妙に書き方が異なる、SQLの「方言」が存在します。
            </p>
            <p class="text-sm mt-2 text-gray-700">
                そのため、MySQLで動作したSQLがPostgreSQLで動作しない、ということもよく起こります。
            </p>
        </div>

        <p class="text-sm leading-relaxed">
            Webアプリケーションのフレームワークで採用されているO/Rマッピングの技術により、たとえば、<strong>開発時はXAMPP上のMySQLでWebアプリケーションを構築し、本番公開の際はSupabase上のPostgreSQLを使う、となってもスムーズにデプロイできます。</strong>
        </p>
        <p class="text-sm font-bold bg-gray-100 p-4 rounded border-l-4 border-gray-500">
            Laravelでは、EloquentがO/Rマッピングの技術を採用しています。メッセージボードはEloquentを使って構築を進めました。
        </p>
    </section>

</div>
EOF
            ]
        );
    }
}