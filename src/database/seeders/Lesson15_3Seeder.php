<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson15_3Seeder extends Seeder
{
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
                'sort_order' => 3,
            ],
            [
                'title' => 'URL',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-10">
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-4">URL</h2>
        <p class="text-gray-700 leading-relaxed">
            インターネットを理解するには、URLの理解が不可欠です。これから、インターネットで接続先を特定できるしくみについて学んでいきます。「指定したURLへアクセスするとWebページが表示される」ということについて深掘りしていきましょう。
        </p>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800">URLはインターネット上のリソースの住所</h3>
        <p class="text-gray-700 leading-relaxed">
            <code class="bg-gray-100 px-1 rounded text-blue-600">https://www.google.co.jp/</code>, <code class="bg-gray-100 px-1 rounded text-blue-600">http://news.yahoo.co.jp/pickup/1</code> のようなURLは「Uniform Resource Locator」の略称で、日本語に訳すと「統一資源位置指定子」と書きます。
        </p>
        <p class="text-gray-700 leading-relaxed">
            難しい日本語になりましたが、要するにURLは、インターネット上のリソース（資源）の位置を特定するために使用される文字列です。URLは、インターネット上に公開されている1つのリソースに対して1つだけ割り当てられており、いうなれば <strong>リソースをインターネット上で特定するための住所</strong> です。
        </p>
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 mt-4">
            <h4 class="font-bold text-blue-800 mb-2">補足：URLとURIの違いについて</h4>
            <p class="text-sm text-gray-700 leading-relaxed">
                URLに似た用語としてURI（Uniform Resource Identifier、統一資源位置識別子）があります。厳密に言うと、URIとURLには異なる部分がありますが、「大きな違いはない（同じである）」とみなしても問題はありません。<br><br>
                実はURLという用語は非公式の用語とされており、公式にはURIと呼ぶ方が正しいです。ただ、URLという用語がこれだけ普及してしまったため、どちらも同じ意味として使っても通じているのが現状です。本コースでは、聞き慣れているURLを使用します。
            </p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800">URLの一般形式</h3>
        <p class="text-gray-700">URLの一般形式は、以下の通りです。</p>
        <div class="bg-gray-800 text-white p-4 rounded-lg font-mono text-center mb-4">
            （httpなどのプロトコル名）:（プロトコルごとに定められた形式）
        </div>
        <p class="text-gray-700">URLの最初に付く記号はhttp以外にもいくつかあります。</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="border border-gray-200 p-4 rounded-lg bg-white">
                <ul class="space-y-3">
                    <li><strong class="text-blue-600">http / https</strong>：ここまでの学習内容で触れたので省略します。</li>
                    <li>
                        <strong class="text-blue-600">ftp</strong><br>
                        <span class="text-sm text-gray-600">FTP（File Transfer Protocol）を表すもので、ネットワーク上でファイルを転送するための通信プロトコルです。形式は <code class="text-xs">ftp://example.com/</code> のようになります。HTTPでもファイル転送ができるため、最近はあまり見かけなくなりました。</span>
                    </li>
                </ul>
            </div>
            <div class="border border-gray-200 p-4 rounded-lg bg-white">
                <ul class="space-y-3">
                    <li>
                        <strong class="text-blue-600">mailto</strong><br>
                        <span class="text-sm text-gray-600">メールの宛先を表すものです。プロトコルではありませんが、<code class="text-xs">mailto:taro@example.com</code> のように記述します。リンクをクリックするとメールソフトが起動します。</span>
                    </li>
                    <li>
                        <strong class="text-blue-600">file</strong><br>
                        <span class="text-sm text-gray-600">自分のコンピュータ内のファイルを表すものです。<code class="text-xs">file:///users/taro/memo.txt</code> のような形式になります。ブラウザでローカルファイルを開くと表示されます。</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 italic">HTTPのURLの構成</h3>
        <p class="text-gray-700 leading-relaxed">
            HTTP以外のURLも確認しましたが、インターネットに繋げる限り、一般的な通信プロトコルはHTTPになります。ここからはHTTPを基本として解説します。
        </p>
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
            <h4 class="font-bold text-gray-800">住所の特定（現実世界での例え）</h4>
            <p class="text-sm text-gray-700 leading-relaxed">
                日本国内の1つのリソース（資料など）を特定する場合：<br><br>
                1. まずは住所：<strong>東京都渋谷区1-2-5</strong>（領域をある程度特定）<br>
                2. ビル名まで：<strong>東京都渋谷区1-2-5 MFPR渋谷ビル</strong>（より明確に）<br>
                3. 何階何号室まで：<strong>東京都渋谷区1-2-5 MFPR渋谷ビル 801号室</strong>（だいぶ近づきました）<br>
                4. 完全に特定：<strong>東京都渋谷区1-2-5 MFPR渋谷ビル 801号室 の手前から3番目の机の真下においてある引き出しの 上から3番目にある黄色い表紙の資料</strong><br><br>
                これで、間違う余地なく、1つのリソースを特定できました。
            </p>
        </div>

        <h4 class="font-bold text-lg text-gray-800">HTTPのURLの一般形式</h4>
        <p class="text-gray-700">URLは、上記の発想とまったく同じものです。この形でインターネット上のリソースを1つに特定できます。</p>
        <div class="bg-blue-600 text-white p-4 rounded-lg font-mono text-center shadow-md">
            http://ホスト名.ドメイン名:ポート番号/パス
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-xl bg-white mt-6">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 font-bold text-gray-700">用語</th>
                        <th class="px-4 py-3 font-bold text-gray-700">候補例</th>
                        <th class="px-4 py-3 font-bold text-gray-700">説明</th>
                        <th class="px-4 py-3 font-bold text-gray-700">現実世界の例</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-3 font-bold text-blue-600">ホスト名（host）</td>
                        <td class="px-4 py-3">www, mail, maps, news</td>
                        <td class="px-4 py-3">コンピュータ名</td>
                        <td class="px-4 py-3">何階何号室（901号室など）</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 font-bold text-blue-600">ドメイン名（domain）</td>
                        <td class="px-4 py-3">yahoo.co.jp, google.co.jp</td>
                        <td class="px-4 py-3">ネットワーク名</td>
                        <td class="px-4 py-3">ビル名までの住所</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 font-bold text-blue-600">ポート番号（port）</td>
                        <td class="px-4 py-3">80, 25, 110, 443</td>
                        <td class="px-4 py-3">通信する番号</td>
                        <td class="px-4 py-3">宛名、宛先の部署名など</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 font-bold text-blue-600">パス（path）</td>
                        <td class="px-4 py-3">/magazine/9081, /pg/list.html</td>
                        <td class="px-4 py-3">ホスト内のリソースの場所</td>
                        <td class="px-4 py-3">物の場所（引き出しの中の資料など）</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b-2 border-gray-100 pb-2">用語の説明</h3>
        
        <div class="space-y-4">
            <h4 class="font-bold text-lg text-gray-800">ドメイン名</h4>
            <p class="text-gray-700 leading-relaxed text-sm">
                ドメイン名（Domain）とは、インターネット上のネットワークを特定するための住所です。たとえば <code class="text-blue-600">google.co.jp</code> というドメイン名は、日本（co.jp）におけるGoogleのネットワークの住所を表しています。
            </p>
            <div class="flex justify-center p-4 bg-white rounded-xl border">
                <img src="/images/Lesson15-3.png" alt="Lesson15-3" class="max-w-md w-full h-auto">
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-lg text-gray-800">ホスト名</h4>
            <p class="text-gray-700 leading-relaxed text-sm">
                ホスト名（Host）とは、ネットワーク上のコンピュータにつける識別用の名前です。たとえば <code class="text-blue-600">www.google.co.jp</code> はドメイン名が <code class="text-gray-800">google.co.jp</code> で、ホスト名が <code class="text-gray-800">www</code> になります。ホスト名をどのように決めるかは自由ですが、とくに <code class="text-gray-800">www</code> は、Webサーバが起動しているホストの名前にすることが多いです。
            </p>
            <div class="flex justify-center p-4 bg-white rounded-xl border">
                <img src="/images/Lesson15-4.png" alt="Lesson15-4" class="max-w-md w-full h-auto">
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-lg text-gray-800">ポート番号</h4>
            <p class="text-gray-700 leading-relaxed text-sm">
                ポート番号（Port Number）は、通信プロトコルと密接な関係があり、たとえばHTTPのプロトコルは80番と決まっています。したがって、ポート番号は省略できる場合がほとんどです。例外的に「HTTPではあるものの80番ポートを使わずに3000番を使う」とした場合には、ポート番号を明記することで対応できるようになっています。
            </p>
            <p class="text-xs text-gray-500 italic">※ポート番号が必要な理由については、次のチャプターで解説します。</p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-lg text-gray-800">パス</h4>
            <p class="text-gray-700 leading-relaxed text-sm">
                パス（Path）とは、コンピュータ内のファイルの位置を表したものです。 <code class="font-bold text-blue-600">/</code> によってフォルダ名を区切ります。 <code class="text-gray-800">/news/tech/computer.html</code> であれば、newsフォルダの中のtechフォルダの中にあるcomputer.htmlと指定できます。
            </p>
            <p class="text-gray-700 text-sm">パスが省略された場合には、index.html など、index.xxx がデフォルトで表示されます。</p>
        </div>
    </section>

    <section class="space-y-4">
        <h3 class="text-xl font-bold text-gray-800 italic">URLの一例</h3>
        <p class="text-gray-700">たとえば、以下のようなURLがあるとします。</p>
        <p class="text-lg font-mono text-blue-600 bg-blue-50 p-4 rounded-lg border border-blue-100 text-center">
            http://www.example.com/news/tech/computer.html
        </p>
        <p class="text-gray-700">このようなURLを分類した場合、下記のようになります。</p>
        <div class="max-w-md mx-auto overflow-hidden border border-gray-200 rounded-xl">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 font-bold text-gray-700">項目</th>
                        <th class="px-6 py-3 font-bold text-gray-700">内容</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr><td class="px-6 py-3 text-gray-600">通信プロトコル</td><td class="px-6 py-3 font-mono">http</td></tr>
                    <tr><td class="px-6 py-3 text-gray-600">ホスト名</td><td class="px-6 py-3 font-mono">www</td></tr>
                    <tr><td class="px-6 py-3 text-gray-600">ドメイン名</td><td class="px-6 py-3 font-mono">example.com</td></tr>
                    <tr><td class="px-6 py-3 text-gray-600">ポート番号</td><td class="px-6 py-3">省略（80）</td></tr>
                    <tr><td class="px-6 py-3 text-gray-600">パス</td><td class="px-6 py-3 font-mono">/news/tech/computer.html</td></tr>
                </tbody>
            </table>
        </div>
        <p class="text-center text-gray-700 font-bold mt-4">これらが定まることで、インターネット上のリソースを特定できます。</p>
    </section>
</div>'
            ]
        );
    }
}