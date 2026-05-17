<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_7Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lesson 12 (MySQL) を取得
        $lesson12 = Lesson::where('title', 'MySQL')->first();

        if (!$lesson12) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson12->id,
                'sort_order' => 7,
            ],
            [
                'title' => 'データベースの作成',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">データベースの作成</h2>
        <p class="text-gray-700 leading-relaxed">
            ここから本格的にデータベースを学習します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベースの初期設定</h3>
        <p class="text-gray-700 leading-relaxed">
            ここでは、以下の初期設定をします。
        </p>

        <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm space-y-4">
            <h4 class="font-bold text-gray-800">ユーザの追加</h4>
            <p class="text-sm text-gray-600 leading-relaxed">
                現在、MySQLの中には <strong>root</strong> というユーザが登録されています。本レッスンはrootユーザを使ってMySQLの操作を学びますが、次以降のレッスンではroot以外のユーザを使うことにします。
            </p>
            <div class="grid grid-cols-2 gap-4 max-w-xs bg-gray-50 p-4 rounded-lg">
                <div class="text-xs text-gray-500 font-bold uppercase">ユーザ名</div>
                <div class="text-sm font-mono font-bold text-blue-600">dbuser</div>
                <div class="text-xs text-gray-500 font-bold uppercase">パスワード</div>
                <div class="text-sm font-mono font-bold text-blue-600">dbpass</div>
            </div>
            <p class="text-sm text-gray-600">このタイミングで、次のレッスン用のユーザをMySQLに追加します。</p>
        </div>

        <div class="space-y-8 mt-6">
            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                <div>
                    <p class="text-gray-700 font-bold">XAMPPを起動</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                <div class="space-y-4">
                    <p class="text-gray-700">
                        phpMyAdmin（<a href="http://localhost/phpmyadmin/" target="_blank" class="text-blue-600 hover:underline">http://localhost/phpmyadmin/</a>）にアクセスして「ユーザアカウント」に移動します。
                    </p>
                    <img src="/images/Lesson12-8.png" alt="phpMyAdminユーザアカウントタブ" class="border rounded shadow-sm">
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                <div class="space-y-4">
                    <p class="text-gray-700 font-bold">「新規作成：ユーザアカウントを追加する」を押下</p>
                    <div class="bg-gray-50 p-4 rounded-lg text-sm space-y-2">
                        <p><strong>【ログイン情報】</strong><br>ユーザ名：dbuser / パスワード：dbpass</p>
                        <p><strong>【ユーザアカウント専用データベース】</strong><br>「ワイルドカード（ユーザ名_%）に該当するデータベースに全ての権限を与える」にチェック。</p>
                    </div>
                    <p class="text-gray-700">入力を終えたら画面右下の「実行」を押下します。</p>
                    <img src="/images/Lesson12-9.png" alt="ユーザアカウント追加画面" class="border rounded shadow-sm">
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">4</div>
                <div class="space-y-4">
                    <p class="text-gray-700 font-bold">ユーザアカウント概要に「dbuser」が追加されていること</p>
                    <img src="/images/Lesson12-10.png" alt="ユーザ追加確認" class="border rounded shadow-sm">
                    <p class="text-sm text-green-700">上記のように表示されていれば、dbuserは問題なく作成されています。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベースの作成</h3>
        <p class="text-gray-700 leading-relaxed">
            初期設定が済んだらデータベースを作成しましょう。<br>
            GUIでも作成は可能ですが今回は実務的に多く使用される<strong>CUI</strong>で実行していきます。
        </p>

        <div class="bg-gray-800 p-6 rounded-xl shadow-inner space-y-6">
            <div class="space-y-2">
                <h4 class="text-blue-300 text-sm font-bold">① VSCodeのターミナルに入りMySQLサーバに接続（ログイン）</h4>
                <div class="space-y-4 mt-2">
                    <div>
                        <p class="text-white text-xs mb-1">■ Macの場合</p>
                        <code class="block bg-black text-green-400 p-3 rounded">/Applications/XAMPP/xamppfiles/bin/mysql -u root -p</code>
                    </div>
                    <div>
                        <p class="text-white text-xs mb-1">■ Windowsの場合</p>
                        <code class="block bg-black text-green-400 p-3 rounded">C:\xampp\mysql\bin\mysql.exe -u root -p</code>
                    </div>
                </div>
                <p class="text-gray-400 text-xs mt-2 italic">※Passwordは空白（そのままEnter）でOKです</p>
            </div>
        </div>

        <img src="/images/Lesson12-11.png" alt="MySQLログイン成功画面" class="border rounded shadow-sm mx-auto">

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">CREATE DATABASE構文</h4>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
                CREATE DATABASE データベース名;
            </div>
            <p class="text-gray-700 leading-relaxed">
                今回作成するデータベースは、本のオンライン通販サイトを想定しています。データベース名は <strong>bookstore</strong> にしましょう。
            </p>
            <div class="bg-gray-800 p-6 rounded-xl">
                <p class="text-blue-300 text-xs mb-2">// データベース bookstore を作成</p>
                <code class="text-white font-mono">mysql> CREATE DATABASE bookstore;</code>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベース一覧の確認</h3>
        <p class="text-gray-700 leading-relaxed">
            現在作成されているデータベースの一覧を確認するには、<code>show databases</code>を利用します。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">show databases構文</h4>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
                show databases;
            </div>
            <div class="bg-gray-800 p-6 rounded-xl">
                <code class="text-white font-mono">mysql> show databases;</code>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">実行結果</h4>
            <pre class="bg-black text-green-400 p-6 rounded-xl font-mono text-sm">
+--------------------+
| Database           |
+--------------------+
| bookstore          |
| information_schema |
| mysql              |
| performance_schema |
| phpmyadmin         |
| test               |
+--------------------+
6 rows in set (0.001 sec)</pre>
            <p class="text-gray-700"><code>bookstore</code>が作成されていることを確認できたら大丈夫です。</p>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
            <h4 class="text-gray-800 font-bold mb-4">GUIでの確認方法</h4>
            <p class="text-sm text-gray-600 mb-4">phpMyAdminを確認してbookstoreが作成されていることを確認してください。</p>
            <img src="/images/Lesson12-12.png" alt="phpMyAdminでのデータベース一覧確認" class="border rounded shadow-sm mx-auto">
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データベースを削除したいとき</h3>
        <p class="text-gray-700 leading-relaxed">
            データベースを削除することも簡単です。データベースの削除は、<strong>DROP DATABASE構文</strong>を利用します。
        </p>
        <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
            DROP DATABASE データベース名;
        </div>
        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-xl">
            <h4 class="text-red-800 font-bold flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                【最重要注意点】
            </h4>
            <p class="text-red-700 text-sm leading-relaxed">
                このSQL文は <strong>確認無しに削除される</strong> ため、実際の現場で管理者の確認なしに行なうことは絶対にやめてください。どれだけ多くのデータがあろうと一瞬で消し飛んでしまいます。
            </p>
            <p class="text-red-700 text-sm mt-2 italic">※本コースでは消して困るデータはないため、学習中は安心して使用してください。</p>
        </div>
        <p class="text-sm text-gray-600">
            <code>DROP DATABASE bookstore;</code>を試しに実行された方は、再度<code>CREATE DATABASE bookstore;</code>を実行して、bookstoreデータベースを作成してください。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">操作するデータベースを選択</h3>
        <p class="text-gray-700 leading-relaxed">
            MySQLサーバに接続した後は、操作対象のデータベースを選択します。この操作は、<strong>サーバに接続する都度行なう必要があります。</strong>
        </p>
        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">USE構文</h4>
            <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800">
                USE データベース名;
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">
                <code>USE データベース名</code> を実行しないと、たとえば <code>bookstore</code> データベースの <code>books</code> テーブルのデータ操作をする際、 <code>bookstore.books</code> のように <code>データベース名.テーブル名</code> と指定しなければなりません。<code>USE データベース名</code> を実行することで、<code>books</code>（テーブル名のみ）で指定できるようになります。
            </p>
            <div class="bg-gray-800 p-6 rounded-xl">
                <p class="text-blue-300 text-xs mb-2">// 操作するデータベースの選択</p>
                <code class="text-white font-mono">mysql> USE bookstore;</code>
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}