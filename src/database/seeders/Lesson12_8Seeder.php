<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_8Seeder extends Seeder
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
                'sort_order' => 8,
            ],
            [
                'title' => 'テーブルの作成',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">テーブルの作成</h2>
        <p class="text-gray-700 leading-relaxed">
            続いて、テーブルを作成します。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データ型</h3>
        <p class="text-gray-700 leading-relaxed">
            PHPのレッスンでもデータ型について学びました。同じくMySQLにもデータ型があります。
        </p>
        <p class="text-gray-700 leading-relaxed">
            データ型を指定しなければいけないのは、そのデータが文字なのか数値なのかコンピュータが判断できないからです。コンピュータの内部では電気信号によってデータが保存されているため、見分けが付きません。この点、データ型を指定することで扱うデータの種類を決めていれば、MySQLが「これは○○型のデータだな」と判断して処理してくれます。
        </p>
        
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
            <h4 class="font-bold text-gray-800 mb-4">MySQLの基本データ型</h4>
            <ul class="space-y-2">
                <li class="flex items-center gap-2"><span class="font-mono font-bold text-blue-600">INT</span><span class="text-gray-600">（整数）</span></li>
                <li class="flex items-center gap-2"><span class="font-mono font-bold text-blue-600">DOUBLE</span><span class="text-gray-600">（小数）</span></li>
                <li class="flex items-center gap-2"><span class="font-mono font-bold text-blue-600">VARCHAR</span><span class="text-gray-600">（可変長の文字列）</span></li>
                <li class="flex items-center gap-2"><span class="font-mono font-bold text-blue-600">TEXT</span><span class="text-gray-600">（文章用の長い文字列）</span></li>
                <li class="flex items-center gap-2"><span class="font-mono font-bold text-blue-600">TIMESTAMP</span><span class="text-gray-600">（日付時刻型）</span></li>
            </ul>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">bookstoreデータベースにbooksテーブルを作成する</h3>
        <p class="text-gray-700 leading-relaxed">
            作成した <code>bookstore</code> のデータベースにテーブルを作成しましょう。<br>
            1行で書くには長いので、下記のようにVSCodeのターミナルで作成してください。
        </p>

        <div class="bg-gray-800 p-6 rounded-xl shadow-inner">
            <pre class="text-green-400 font-mono text-sm leading-relaxed"><code>CREATE TABLE books (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    title VARCHAR(100),
    price INT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);</code></pre>
        </div>

        <div class="my-8 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm flex justify-center p-4">
            <img src="/images/Lesson12-13.png" alt="ターミナルでのテーブル作成" class="max-w-full h-auto">
        </div>

        <div class="space-y-8 mt-10">
            <h4 class="text-lg font-bold text-gray-800 border-l-4 border-blue-600 pl-3">SQL文の解説</h4>
            
            <div class="space-y-6">
                <div class="bg-white border border-gray-200 p-4 rounded-lg">
                    <h5 class="font-bold text-blue-700 mb-2">CREATE TABLE books ( ... );</h5>
                    <p class="text-sm text-gray-700">
                        これは、bookstoreデータベースの中に <strong>booksテーブルを作成する</strong> という意味です。
                        そして <code>( ... )</code> の中に、下記4つのカラム定義（設計）を書いていきます。
                    </p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs">id（ID）</span>
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs">title（本のタイトル）</span>
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs">price（本の価格）</span>
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs">created_at（登録日時）</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="font-mono font-bold text-gray-800">1. id</p>
                    <div class="bg-gray-100 p-3 rounded font-mono text-xs mb-2">id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,</div>
                    <ul class="list-disc ml-6 text-sm text-gray-600 space-y-1">
                        <li><strong>AUTO_INCREMENT：</strong> 1から始まり、自動的に値が1ずつ増えていく設定です。</li>
                        <li><strong>NOT NULL：</strong> 空データを許さない（必ず値が入る）設定です。</li>
                        <li><strong>PRIMARY KEY：</strong> データを一意に特定するための <strong>「主キー」</strong> です。1つのテーブルに必ず1つ必要です。</li>
                    </ul>
                </div>

                <div class="space-y-2">
                    <p class="font-mono font-bold text-gray-800">2. title</p>
                    <div class="bg-gray-100 p-3 rounded font-mono text-xs mb-2">title VARCHAR(100),</div>
                    <p class="text-sm text-gray-600">
                        <strong>VARCHAR(100)</strong> は文字列型で、入力できる文字数を <strong>最大100文字まで</strong> に制限しています。VARCHARでは必ず最大文字数の指定が必要です。
                    </p>
                </div>

                <div class="space-y-2">
                    <p class="font-mono font-bold text-gray-800">3. price</p>
                    <div class="bg-gray-100 p-3 rounded font-mono text-xs mb-2">price INT,</div>
                    <p class="text-sm text-gray-600">
                        価格を <strong>INT（整数型）</strong> で保存する設定です。
                    </p>
                </div>

                <div class="space-y-2">
                    <p class="font-mono font-bold text-gray-800">4. created_at</p>
                    <div class="bg-gray-100 p-3 rounded font-mono text-xs mb-2">created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP</div>
                    <p class="text-sm text-gray-600">
                        <strong>TIMESTAMP（日付時刻型）</strong> で保存します。<strong>DEFAULT CURRENT_TIMESTAMP</strong> を指定することで、データ保存時に自動的にその時の現在日時が保存されます。
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブル一覧の確認</h3>
        <p class="text-gray-700 leading-relaxed">
            選択されたデータベース内で作成されているテーブル一覧を確認したいときは、<strong>show tables構文</strong>を利用します。
        </p>

        <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800 mb-4">
            show tables;
        </div>

        <div class="bg-gray-800 p-6 rounded-xl">
            <code class="text-white font-mono">mysql> show tables;</code>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500 font-bold mb-2">実行結果</p>
            <pre class="bg-black text-green-400 p-4 rounded font-mono text-sm inline-block min-w-[200px]">
+---------------------+
| Tables_in_bookstore |
+---------------------+
| books               |
+---------------------+</pre>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブルの設計内容を確認</h3>
        <p class="text-gray-700 leading-relaxed">
            テーブルの設計内容を確認したいときは、<strong>describe構文</strong>を利用します。
        </p>

        <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800 mb-4">
            describe テーブル名;
        </div>

        <div class="bg-gray-800 p-6 rounded-xl">
            <code class="text-white font-mono">mysql> describe books;</code>
        </div>

        <div class="mt-6 overflow-x-auto">
            <p class="text-xs text-gray-500 font-bold mb-2">実行結果</p>
            <table class="min-w-full bg-black text-green-400 font-mono text-xs border border-gray-700">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="px-4 py-2 border-r border-gray-700">Field</th>
                        <th class="px-4 py-2 border-r border-gray-700">Type</th>
                        <th class="px-4 py-2 border-r border-gray-700">Null</th>
                        <th class="px-4 py-2 border-r border-gray-700">Key</th>
                        <th class="px-4 py-2 border-r border-gray-700">Default</th>
                        <th class="px-4 py-2">Extra</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-700">
                        <td class="px-4 py-2 border-r border-gray-700">id</td>
                        <td class="px-4 py-2 border-r border-gray-700">int(11)</td>
                        <td class="px-4 py-2 border-r border-gray-700">NO</td>
                        <td class="px-4 py-2 border-r border-gray-700">PRI</td>
                        <td class="px-4 py-2 border-r border-gray-700">NULL</td>
                        <td class="px-4 py-2 text-yellow-200">auto_increment</td>
                    </tr>
                    <tr class="border-b border-gray-700">
                        <td class="px-4 py-2 border-r border-gray-700">title</td>
                        <td class="px-4 py-2 border-r border-gray-700">varchar(100)</td>
                        <td class="px-4 py-2 border-r border-gray-700">YES</td>
                        <td class="px-4 py-2 border-r border-gray-700"></td>
                        <td class="px-4 py-2 border-r border-gray-700">NULL</td>
                        <td class="px-4 py-2"></td>
                    </tr>
                    <tr class="border-b border-gray-700">
                        <td class="px-4 py-2 border-r border-gray-700">price</td>
                        <td class="px-4 py-2 border-r border-gray-700">int(11)</td>
                        <td class="px-4 py-2 border-r border-gray-700">YES</td>
                        <td class="px-4 py-2 border-r border-gray-700"></td>
                        <td class="px-4 py-2 border-r border-gray-700">NULL</td>
                        <td class="px-4 py-2"></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border-r border-gray-700">created_at</td>
                        <td class="px-4 py-2 border-r border-gray-700">timestamp</td>
                        <td class="px-4 py-2 border-r border-gray-700">NO</td>
                        <td class="px-4 py-2 border-r border-gray-700"></td>
                        <td class="px-4 py-2 border-r border-gray-700">current_timestamp()</td>
                        <td class="px-4 py-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-sm text-green-700 mt-4">問題なく設定されていれば、上記のようになります。把握しやすい表ですね。</p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブルを削除したい場合</h3>
        <p class="text-gray-700 leading-relaxed">
            テーブルを削除したいときは、<strong>DROP TABLE構文</strong>を利用します。
        </p>

        <div class="bg-gray-100 p-4 rounded-lg font-mono text-gray-800 mb-4">
            DROP TABLE テーブル名;
        </div>

        <div class="bg-gray-800 p-6 rounded-xl mb-6">
            <code class="text-white font-mono">mysql> DROP TABLE books;</code>
        </div>

        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-xl">
            <h4 class="text-red-800 font-bold mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                【最重要注意点】
            </h4>
            <p class="text-red-700 text-sm leading-relaxed">
                この命令はデータベースを削除したいときと同様で、<strong>確認なしに即削除される</strong>ため、実際の現場で管理者の確認なしに行なうことは絶対にやめてください。どれだけ多くのデータがあろうと一瞬で消し飛んでしまいます。
            </p>
            <p class="text-red-700 text-sm mt-2 italic">※本コースでは学習中は安心して使用してください。</p>
        </div>

        <p class="text-sm text-gray-600 mt-4">
            <code>DROP TABLE books;</code>を試しに実行された方は、再度上記のテーブル作成SQLを実行して、<code>books</code> テーブルを作成しておいてください。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}