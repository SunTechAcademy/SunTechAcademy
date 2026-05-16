<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson12_3Seeder extends Seeder
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
                'sort_order' => 3,
            ],
            [
                'title' => 'リレーショナルデータベース',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left">
    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">リレーショナルデータベース</h2>
        <p class="text-gray-700 leading-relaxed">
            データベースソフトウェアには、そのデータの保存の仕方によってさまざまな種類があります。その中でもっとも利用されている種類は、<strong>リレーショナルデータベース</strong>です。また、リレーショナルデータベースを管理するシステムを、<strong>リレーショナルデータベース管理システム（RDBMS）</strong>と呼びます。
        </p>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">リレーショナルデータベースの構成</h3>
        <p class="text-gray-700 leading-relaxed">
            リレーショナルデータベースの構造はとても単純で、基本的には、<strong>1つのアプリケーションに対して1つのデータベースがあり、1つのデータベースの中に複数のテーブル（表）があります。</strong>
        </p>
        <p class="text-gray-700 leading-relaxed">
            1つ1つのテーブル（表）は、その名の通りExcelシートと同じように縦横の表となっているというイメージを持ってください。Excelで例えると、<strong>Excelファイルが1つのデータベース</strong>であり、その中にある<strong>複数のシートがテーブル</strong>にあたり、シートの中の1つ1つのセルが具体的なデータとなります。
        </p>

        <div class="my-8 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm flex justify-center p-4">
            <img src="/images/Lesson12-2.png" alt="データベースとExcelの比較イメージ" class="max-w-full h-auto">
        </div>

        <p class="text-gray-700 leading-relaxed">
            有名なRDBMSには、Oracle Database、Microsoft SQL Server、MySQL、PostgreSQL、SQLiteなどがあります。今回は、無料で利用できるデータベースの中で、もっとも広く利用されている<strong>MySQL</strong>を学びます。他のRDBMSも基本的にはほぼ同じ機能を持っているため、MySQLを学んでおけば他のSQLにも応用が効きます。
        </p>

        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 mt-8">
            <h4 class="font-bold text-blue-800 mb-4">リレーショナルデータベースの3つの特徴</h4>
            <ul class="space-y-3">
                <li class="flex items-start gap-2">
                    <span class="bg-blue-600 text-white text-xs px-1.5 py-0.5 rounded mt-1">1</span>
                    <span class="text-gray-700">テーブルは、カラム（縦）とレコード（横）で構成される</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="bg-blue-600 text-white text-xs px-1.5 py-0.5 rounded mt-1">2</span>
                    <span class="text-gray-700">カラムに、保存するデータの制約を設定できる</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="bg-blue-600 text-white text-xs px-1.5 py-0.5 rounded mt-1">3</span>
                    <span class="text-gray-700">データの保存や取得には、SQLという言語を使用する</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="font-bold text-gray-800 text-lg border-l-2 border-gray-400 pl-3">テーブルは、カラム（縦）とレコード（横）で構成される</h4>
        <p class="text-gray-700 leading-relaxed">
            テーブルにおいて、<strong>縦をカラム（column）</strong>と呼び、<strong>横をレコード（record）</strong>と呼びます。
        </p>
        <ul class="list-disc ml-6 text-gray-700 space-y-2">
            <li><strong>カラム：</strong> nameやemailといった名前をつけることができます。</li>
            <li><strong>レコード：</strong> id, nameなどのカラムの具体的な値（id: 1, name: 太郎）を持つ1つのデータのまとまりのことです。</li>
        </ul>
        
        <p class="text-sm text-gray-600 mt-4">
            下記のテーブルであれば、ユーザデータのレコードが3件あり、idカラムの値が 2 のレコードのnameカラムの値は、<strong>次郎</strong> となります。
        </p>

        <div class="my-8 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm flex justify-center p-4">
            <img src="/images/Lesson12-3.png" alt="テーブル内のカラムとレコード" class="max-w-full h-auto">
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="font-bold text-gray-800 text-lg border-l-2 border-gray-400 pl-3">カラムに、保存するデータの制約を設定できる</h4>
        <p class="text-gray-700 leading-relaxed">
            カラムには制約を設定できます。制約を設定することで、データの整合性や一貫性を保ちます。データにあるはずの値が無かったり、数字であるべき箇所が文字列といったデータの不整合を防げます。
        </p>

        <h5 class="font-bold text-gray-800 mt-4 underline decoration-blue-300 underline-offset-4">データ型</h5>
        <p class="text-gray-700 text-sm leading-relaxed">
            下記のキャプチャのように、idには <strong>int</strong> という整数型が、nameには <strong>varchar</strong> という文字列型が設定されています。カラムで指定された型以外の値を含んだレコードは、保存できません。
        </p>

        <div class="my-8 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm flex justify-center p-4">
            <img src="/images/Lesson12-4.png" alt="テーブル内のカラムにおけるデータ型" class="max-w-full h-auto">
        </div>

        <h5 class="font-bold text-gray-800 mt-6 underline decoration-blue-300 underline-offset-4">NULL許容／禁止</h5>
        <p class="text-gray-700 text-sm leading-relaxed">
            <strong>NULL</strong> とは、「何も値がないことを示す」値 です（ちなみにですが、PHPにおいても、 NULL は「何も値がないこと」を示します）。NULLを許容したカラムにはNULLを保存できますが、NULLを禁止したカラムにはNULLは保存できません。
        </p>

        <h5 class="font-bold text-gray-800 mt-6 underline decoration-blue-300 underline-offset-4">主キー（プライマリーキー）</h5>
        <p class="text-gray-700 text-sm leading-relaxed">
            主キーは1つのテーブルに対して1つだけ指定できます。Laravelでは、基本的に <strong>id</strong> が主キーとなります。主キーには、テーブルの各レコードを1行に特定できるカラムを指定します。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="font-bold text-gray-800 text-lg border-l-2 border-gray-400 pl-3">データの保存や取得などの処理にSQLという言語を使用する</h4>
        <p class="text-gray-700 leading-relaxed">
            リレーショナルデータベースでは、<strong>SQL</strong>というデータベースを操作する言語を使用して命令文を記述し、データの保存や取得をします。
        </p>
        <div class="bg-gray-800 p-6 rounded-lg shadow-inner">
            <p class="text-blue-300 font-mono text-xs mb-2">// ユーザテーブル（users）から全員分の名前（name）を取得する例</p>
            <pre class="text-white font-mono text-sm"><code>select name from users;</code></pre>
        </div>
        <p class="text-gray-600 text-sm italic">※SQLに関してはこのレッスンで詳しく学びます。</p>
    </section>

    <section class="bg-gray-50 p-8 rounded-2xl border border-gray-200 mt-12">
        <h4 class="font-bold text-gray-800 text-xl mb-4">ここまでのまとめ</h4>
        <p class="text-gray-700 leading-relaxed">
            このように、リレーショナルデータベースソフトウェアは1つのデータベースとそれに紐付いた複数のテーブルを持ち、各テーブルにはカラムの制約によってデータの整合性を担保したレコードが保存されています。このデータの操作にはSQLを使用します。
        </p>
    </section>
</div>
EOF
            ]
        );
    }
}