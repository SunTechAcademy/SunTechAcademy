<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_4Seeder extends Seeder
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
                'sort_order' => 4,
            ],
            [
                'title' => 'データベースの役割',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">データベースの役割</h2>
        <p class="text-gray-700 leading-relaxed">
            データベースの役割について、まとめます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">CRUD</h3>
        <p class="text-gray-700 leading-relaxed">
            データベースがデータを扱う基本操作には、次の4つがあります。
        </p>

        <div class="overflow-hidden border border-gray-200 rounded-xl shadow-sm max-w-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">英語</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">日本語</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-blue-600 font-bold">Create</td>
                        <td class="px-6 py-4 whitespace-nowrap">作成・保存</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-blue-600 font-bold">Read</td>
                        <td class="px-6 py-4 whitespace-nowrap">取得</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-blue-600 font-bold">Update</td>
                        <td class="px-6 py-4 whitespace-nowrap">更新</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-blue-600 font-bold">Delete</td>
                        <td class="px-6 py-4 whitespace-nowrap">削除</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="text-gray-700 leading-relaxed mt-4">
            この4つの基本機能のことを、頭文字をとって<strong>CRUD（クラッド）</strong>と呼びます。<br>
            CRUD操作はSQLを使用して実行します。
        </p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">アプリケーションとデータベースの関係</h3>
        <p class="text-gray-700 leading-relaxed">
            データベースは、PHPなどのプログラムから必要なデータ操作（CRUD）を要求され、それに応えてデータ操作をします。これがアプリケーションにおけるデータベースの役割です。
        </p>
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 flex items-center justify-center gap-8">
            <div class="text-center">
                <div class="bg-white p-3 rounded shadow-sm font-bold text-blue-800 border border-blue-200">PHPプログラム</div>
                <div class="text-xs text-gray-500 mt-1">リクエスト</div>
            </div>
            <div class="text-blue-400 text-2xl">➔</div>
            <div class="text-center italic text-sm text-blue-600 font-bold">CRUD操作</div>
            <div class="text-blue-400 text-2xl">➔</div>
            <div class="text-center">
                <div class="bg-white p-3 rounded shadow-sm font-bold text-gray-800 border border-gray-200">データベース</div>
                <div class="text-xs text-gray-500 mt-1">データの処理</div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">SQLとは</h3>
        <p class="text-gray-700 leading-relaxed">
            SQLは、RDBMSのデータ操作や定義をするための言語です。<br>
            SQLには、大きく3つの役割があります。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm">
                <h4 class="font-bold text-gray-800 mb-2">1. データ操作のSQL</h4>
                <p class="text-xs text-gray-600">データの保存、取得、更新、削除を担います。</p>
            </div>
            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm">
                <h4 class="font-bold text-gray-800 mb-2">2. データ定義のSQL</h4>
                <p class="text-xs text-gray-600">データベースやテーブル自体の作成・削除を担います。</p>
            </div>
            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm">
                <h4 class="font-bold text-gray-800 mb-2">3. データ制御のSQL</h4>
                <p class="text-xs text-gray-600">アクセス権限や操作記録の管理を担います。</p>
            </div>
        </div>

        <div class="mt-8 space-y-8">
            <div>
                <h4 class="font-bold text-gray-800 border-l-2 border-blue-500 pl-3 mb-4">データ操作のSQL</h4>
                <p class="text-gray-700 text-sm mb-4">CRUDを担い、アプリケーション上ではメインとなるSQLです。</p>
                <div class="overflow-hidden border border-gray-200 rounded-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-left text-xs font-bold text-gray-500 uppercase">
                            <tr>
                                <th class="px-6 py-3">SQLキーワード</th>
                                <th class="px-6 py-3">CRUD</th>
                                <th class="px-6 py-3">用途</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                            <tr>
                                <td class="px-6 py-3 font-mono font-bold text-red-600">INSERT</td>
                                <td class="px-6 py-3">Create</td>
                                <td class="px-6 py-3">作成・保存</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 font-mono font-bold text-red-600">SELECT</td>
                                <td class="px-6 py-3">Read</td>
                                <td class="px-6 py-3">取得</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 font-mono font-bold text-red-600">UPDATE</td>
                                <td class="px-6 py-3">Update</td>
                                <td class="px-6 py-3">更新</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 font-mono font-bold text-red-600">DELETE</td>
                                <td class="px-6 py-3">Delete</td>
                                <td class="px-6 py-3">削除</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-gray-800 border-l-2 border-green-500 pl-3 mb-4">データ定義のSQL</h4>
                <p class="text-gray-700 text-sm mb-4">データ自体ではなく、データを格納するためのデータベースやテーブルを作成するときに使います。</p>
                <div class="overflow-hidden border border-gray-200 rounded-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-left text-xs font-bold text-gray-500 uppercase">
                            <tr>
                                <th class="px-6 py-3">SQLキーワード</th>
                                <th class="px-6 py-3">用途</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                            <tr>
                                <td class="px-6 py-3 font-mono font-bold text-green-600">CREATE</td>
                                <td class="px-6 py-3">新しいデータベース、テーブルを作成する</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 font-mono font-bold text-green-600">DROP</td>
                                <td class="px-6 py-3">すでに存在するデータベースや、テーブルを削除する</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-gray-800 border-l-2 border-amber-500 pl-3 mb-4">データ制御のSQL</h4>
                <p class="text-gray-700 text-sm leading-relaxed">
                    アカウントにおけるデータのアクセス制御に使います。データベースは、アカウントによって異なる権限を設定できます。
                </p>
                <ul class="list-disc ml-6 mt-2 text-sm text-gray-600 space-y-1">
                    <li>すべてのデータにアクセスできるアカウント</li>
                    <li>新規データの保存のみでデータ削除は禁止されているアカウント</li>
                    <li>アカウントごとの操作記録（ログ）の取得</li>
                </ul>
                <p class="text-xs text-gray-400 mt-2 italic">※今回は、もともと用意されているアカウントを利用するため、深くは触れません。</p>
            </div>
        </div>
    </section>
</div>
EOF
            ]
        );
    }
}