<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_5Seeder extends Seeder
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
                'sort_order' => 5,
            ],
            [
                'title' => 'データベース作成の流れ',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">データベース作成の流れ</h2>
        <p class="text-gray-700 leading-relaxed">
            データベースは、どのタイミングで用意するものなのでしょうか？
        </p>
        <p class="text-gray-700 leading-relaxed mt-4">
            データベースは、アプリケーション側の仕様として「データベースが必要だ」となったら、作成します。基本的には、<strong>1アプリケーションに対して1データベース</strong>です。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブルの作成と追加</h3>
        <p class="text-gray-700 leading-relaxed">
            データベースの中のテーブルは、必要になるたび、新規作成します。
        </p>
        
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h4 class="font-bold text-blue-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                具体例：機能拡張によるテーブル追加
            </h4>
            <p class="text-sm text-gray-700 leading-relaxed">
                たとえば「ブログ用のWebアプリケーションを作成してブログ記事を保存するテーブルは作成したが、さらに記事に対してコメントできる機能が必要になった」場合、<strong>コメント用のテーブルを新規作成する</strong>必要があります。
            </p>
            <p class="text-sm text-gray-700 mt-2">
                このように、テーブルは、必要なデータの種類に応じて増やしていきます。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">テーブル設計</h3>
        <p class="text-gray-700 leading-relaxed">
            テーブルを作成する際、テーブルにどんなデータを保存するのか設計する必要があります。<strong>テーブル設計とは、データをどのような形式で保存するか決めること</strong>です。
        </p>

        <div class="space-y-4">
            <h4 class="font-bold text-gray-800">設計例：articleテーブル</h4>
            <p class="text-sm text-gray-600">ブログ記事を保存するテーブルであれば、下記のような構成が考えられます。</p>
            
            <div class="overflow-hidden border border-gray-200 rounded-xl shadow-sm max-w-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 text-left text-xs font-bold text-gray-500 uppercase">
                        <tr>
                            <th class="px-6 py-3">カラム名</th>
                            <th class="px-6 py-3">データ型</th>
                            <th class="px-6 py-3">役割</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold">id</td>
                            <td class="px-6 py-3 font-mono text-blue-600">int</td>
                            <td class="px-6 py-3">レコードを一意に決めるための主キー</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold">title</td>
                            <td class="px-6 py-3 font-mono text-blue-600">varchar</td>
                            <td class="px-6 py-3">ブログ記事のタイトル</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-mono font-bold">content</td>
                            <td class="px-6 py-3 font-mono text-blue-600">text</td>
                            <td class="px-6 py-3">ブログ記事の内容</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">データ型について</h3>
        <p class="text-gray-700 leading-relaxed">
            <code>int</code>, <code>varchar</code>, <code>text</code> は保存するときのデータの型です。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-6">
            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm">
                <div class="font-mono text-blue-600 font-bold mb-1">int</div>
                <p class="text-sm text-gray-600"><strong>整数値</strong>を保存します。<br>例：1, 2, 100 など</p>
            </div>
            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm">
                <div class="font-mono text-blue-600 font-bold mb-1">varchar</div>
                <p class="text-sm text-gray-600"><strong>文字列</strong>を保存します。<br>例：〜な方法10選 など</p>
            </div>
            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm">
                <div class="font-mono text-blue-600 font-bold mb-1">text</div>
                <p class="text-sm text-gray-600"><strong>長い文字列</strong>を保存します。<br>例：ブログの本文など</p>
            </div>
        </div>

        <p class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg border-l-4 border-gray-300">
            したがって、上記の設計では、<code>id</code> には <strong>1, 2</strong> などの整数データ、<code>title</code> には <strong>「〜な方法10選」</strong> などの文字列データの保存が可能になります。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}