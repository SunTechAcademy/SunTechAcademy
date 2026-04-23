<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson7_4Seeder extends Seeder
{
    public function run(): void
    {
        // Lesson7（ターミナル）を取得
        $lesson7 = Lesson::where('title', 'ターミナル')->first();

        if (!$lesson7) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson7->id,
                'sort_order' => 4
            ],
            [
                'title' => '基本のコマンド',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            ここから、ターミナル上で使う基礎的なコマンドを学びます。<br>
            <span class="text-sm text-red-500 font-bold">※ここから先は、皆さんのワークスペースのファイル構成と異なりますが、気にせず進めてください。</span>
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            pwd
        </h4>
        <p class="text-gray-700">
            <code>pwd</code> コマンドは、<strong>Print Working Directory</strong>の略で、ターミナル上での現在のディレクトリを表示します（ディレクトリは、フォルダと同じ意味です）。
        </p>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
            <h5 class="font-bold text-blue-900 mb-2">1. pwdコマンドを入力してみましょう</h5>
            <p class="text-sm text-gray-700 mb-3">ターミナルのタブ上で <code>pwd</code> と入力し、Enterキーを押します。</p>
            
            <div class="bg-gray-900 rounded-md p-4 shadow-inner font-mono text-sm overflow-x-auto">
                <div class="text-gray-400 mb-1"># 入力コマンド</div>
                <div class="text-white flex gap-2">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">SunSunTech</span>
                    <span>%</span>
                    <span class="text-yellow-300">pwd</span>
                </div>
                <div class="text-gray-300 mt-2">/Users/tomoyasuzuki/Desktop/summary/サンテックアカデミー/SunSunTech</div>
            </div>
        </div>

        <p class="text-gray-700 mt-4">
            これで、現在のディレクトリ <code>/Users/tomoyasuzuki/Desktop/summary/サンテックアカデミー/SunSunTech</code> が表示されます。<br>
            ここで、いくつかある <code>/</code> はディレクトリごとの階層の区切りを表します。
        </p>

        

        <div class="bg-gray-50 p-4 border border-gray-200 rounded-lg shadow-sm flex flex-col md:flex-row gap-6 items-center mt-4">
            <div class="w-full md:w-1/2">
                <p class="font-bold text-gray-700 mb-2">階層構造のイメージ</p>
                <div class="font-mono text-sm text-gray-600 bg-white p-3 border border-gray-300 rounded">
Users<br>
 └ tomoyasuzuki<br>
  &nbsp;└ Desktop<br>
   &nbsp;&nbsp;└ summary<br>
    &nbsp;&nbsp;&nbsp;└ サンテックアカデミー<br>
     &nbsp;&nbsp;&nbsp;&nbsp;<span class="bg-yellow-200 text-yellow-900 font-bold px-1 rounded">└ SunSunTech</span>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <img src="/images/Lesson7-2.png" alt="ディレクトリの階層構造" class="rounded border border-gray-300 w-full">
            </div>
        </div>

        <div class="bg-yellow-50 p-4 border-l-4 border-yellow-400 text-sm text-gray-700 mt-4">
            ターミナルでは、「現在どこのディレクトリにいるか」を常に把握しておく必要があります。 ターミナルでのコマンド命令は、基本的に現在のディレクトリに対しての命令となります。異なったディレクトリでコマンド命令をしてしまうと意図した操作ができません。<br>
            <strong>pwd コマンドを使って、現在のディレクトリを常に確認しましょう。</strong>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2 mt-10">
            ls
        </h4>
        <p class="text-gray-700">
            <code>ls</code> コマンドは <strong>List Segments</strong>の略で、現在のディレクトリの中にあるファイルやディレクトリを一覧表示します。
        </p>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
            <h5 class="font-bold text-blue-900 mb-2">1. ls コマンドを入力してみましょう</h5>
            <p class="text-sm text-gray-700 mb-3"><code>ls</code> と入力し、Enterキーを押します。</p>
            
            <div class="bg-gray-900 rounded-md p-4 shadow-inner font-mono text-sm overflow-x-auto">
                <div class="text-gray-400 mb-1"># 入力コマンドと出力結果（一例）</div>
                <div class="text-white flex gap-2">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">SunSunTech</span>
                    <span>%</span>
                    <span class="text-yellow-300">ls</span>
                </div>
                <div class="text-gray-300 mt-2 flex gap-4">
                    <span class="text-blue-300">images_kitchen</span>
                    <span>kitchen.css</span>
                    <span>kitchen.html</span>
                </div>
            </div>
        </div>
        <p class="text-sm text-gray-600">
            ファイルの一覧が表示されます。ターミナル上の現在のディレクトリ位置にあるフォルダやファイルが表示されます。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2 mt-10">
            mkdir
        </h4>
        <p class="text-gray-700">
            <code>mkdir</code> コマンドは、<strong>Make Directory</strong>の略で、ディレクトリ内に新規ディレクトリ（フォルダ）を作成するコマンドです。
        </p>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
            <h5 class="font-bold text-blue-900 mb-2">1. 現在のディレクトリ内に terminal-tutorial ディレクトリを作成してみましょう</h5>
            <p class="text-sm text-gray-700 mb-3"><code>mkdir</code> と入力し、スペースを入力し、ディレクトリ名 <code>terminal-tutorial</code> を入力し、Enterキーを押します。</p>
            
            <div class="bg-gray-900 rounded-md p-4 shadow-inner font-mono text-sm overflow-x-auto">
                <div class="text-white flex gap-2">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">SunSunTech</span>
                    <span>%</span>
                    <span class="text-yellow-300">mkdir terminal-tutorial</span>
                </div>
            </div>
        </div>
        
        <p class="text-gray-700">
            現在いるディレクトリ内に、<code>terminal-tutorial</code> という名前のディレクトリが作成されて、画面の左側に表示されます。<code>ls</code> コマンドを実行することで、ターミナル画面でもできていることを確認できます。
        </p>
        
        <div class="border border-gray-300 rounded-lg overflow-hidden mt-4 inline-block">
            <img src="/images/Lesson7-3.png" alt="mkdirの実行結果" class="block">
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2 mt-10">
            cd
        </h4>
        <p class="text-gray-700">
            <code>cd</code> コマンドは、<strong>Change Directory</strong>の略で、現在のディレクトリから他のディレクトリへ移動するコマンドです。<br>
            <span class="text-sm text-red-500">※画面左側のファイル一覧（エクスプローラー）を操作しても、ターミナルの現在のディレクトリは変更できません。</span>
        </p>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 mb-4">
            <h5 class="font-bold text-blue-900 mb-2">1. 現在のディレクトリから terminal-tutorial ディレクトリへ移動しましょう</h5>
            <p class="text-sm text-gray-700 mb-3"><code>cd</code> と入力し、スペースを入力し、移動先のディレクトリ名 <code>terminal-tutorial</code> と入力し、Enterキーを押します。</p>
            
            <div class="bg-gray-900 rounded-md p-4 shadow-inner font-mono text-sm overflow-x-auto">
                <div class="text-white flex gap-2 mb-2">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">SunSunTech</span>
                    <span>%</span>
                    <span class="text-yellow-300">cd terminal-tutorial</span>
                </div>
                <div class="text-white flex gap-2 opacity-80">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">terminal-tutorial</span>
                    <span>%</span>
                </div>
            </div>
        </div>
        <p class="text-gray-700 text-sm">
            現在のディレクトリを移動できました。％の左側（青文字部分）が変わっていることに注目してください。<code>pwd</code>コマンドでも確認できます。
        </p>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 mt-6">
            <h5 class="font-bold text-blue-900 mb-2">2. 1つだけ上の階層に戻ってみましょう</h5>
            <p class="text-sm text-gray-700 mb-3"><code>cd</code> の後、スペースを入力、さらに <code>..</code> と入力し、Enterキーを押します。</p>
            
            <div class="bg-gray-900 rounded-md p-4 shadow-inner font-mono text-sm overflow-x-auto">
                <div class="text-white flex gap-2">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">terminal-tutorial</span>
                    <span>%</span>
                    <span class="text-yellow-300">cd ..</span>
                </div>
            </div>
        </div>
        <p class="text-gray-700 text-sm">
            <code>..</code> は「1つ上の階層」を意味します。これで先ほどの <code>SunSunTech</code> ディレクトリへ戻ります。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2 mt-10">
            touch
        </h4>
        <p class="text-gray-700">
            <code>touch</code> コマンドはファイルを新規作成するコマンドです。
        </p>

        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 flex gap-3 items-start">
            <span class="text-xl">💡</span>
            <div>
                <strong class="text-indigo-900">便利な技：Tabキーによる入力補完</strong><br>
                <p class="text-sm text-indigo-800 mt-1">
                    ターミナルでは、<code>touch ter</code> と打った後に <span class="bg-gray-200 border border-gray-400 text-gray-800 px-2 py-0.5 rounded shadow-sm text-xs font-mono">Tab</span> キーを入力すると、存在するフォルダ名から推測して自動的に <code>touch terminal-tutorial/</code> まで入力してくれます。
                </p>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
            <h5 class="font-bold text-blue-900 mb-2">1. terminal-tutorial ディレクトリの中に sample.txt を作成してみましょう</h5>
            
            <div class="bg-gray-900 rounded-md p-4 shadow-inner font-mono text-sm overflow-x-auto mt-2">
                <div class="text-white flex gap-2">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">SunSunTech</span>
                    <span>%</span>
                    <span class="text-yellow-300">touch terminal-tutorial/sample.txt</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6 mt-4 items-center">
            <div class="w-full md:w-1/2">
                <p class="text-gray-700 text-sm">
                    画面左側で terminal-tutorial ディレクトリの中身を展開してみると、<code>sample.txt</code> ファイルが作成されています。<br><br>
                    画面左側のファイル一覧から、<code>sample.txt</code> ファイルをダブルクリックしてエディタ画面で開き、以下の1行の日本語を入力して上書き保存してください。
                </p>
                <div class="bg-white p-3 border border-gray-300 rounded font-mono text-sm mt-2 text-gray-800">
                    これはサンプルテキストです。
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <img src="/images/Lesson7-4.png" alt="touchコマンドで作成されたファイル" class="rounded border border-gray-300 w-full shadow-sm">
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2 mt-10">
            less
        </h4>
        <p class="text-gray-700">
            ファイルを編集せずに閲覧だけしたい場合は、<code>less</code> コマンドを使います。lessは、標準のビューアです。
        </p>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
            <h5 class="font-bold text-blue-900 mb-2">1. less で sample.txt の内容を確認しましょう</h5>
            <p class="text-sm text-gray-700 mb-3">ディレクトリを移動してから、<code>less</code> とスペースを入力し、ファイル名を入力します。</p>
            
            <div class="bg-gray-900 rounded-md p-4 shadow-inner font-mono text-sm overflow-x-auto">
                <div class="text-white flex gap-2 mb-2">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">SunSunTech</span>
                    <span>%</span>
                    <span class="text-yellow-300">cd terminal-tutorial/</span>
                </div>
                <div class="text-white flex gap-2">
                    <span class="text-green-400">tomoyasuzuki@MacBookPro</span>
                    <span class="text-blue-400">terminal-tutorial</span>
                    <span>%</span>
                    <span class="text-yellow-300">less sample.txt</span>
                </div>
            </div>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex gap-3 items-center">
            <span class="text-2xl">⚠️</span>
            <p class="text-red-900 text-sm font-bold">
                <span class="bg-white border border-gray-400 text-gray-800 px-2 py-0.5 rounded shadow-sm text-xs font-mono mr-1">q</span> キーを押すと、終了（元の画面へ戻る）できます。<br>
                <span class="font-normal text-red-700 mt-1 block">後ほどgitの操作などで less が自動的に立ち上がる場合があるので、qキーで終了することをしっかり覚えておきましょう。</span>
            </p>
        </div>

        <h5 class="font-bold text-xl text-gray-800 mt-6">lessでファイル閲覧中に使えるコマンド（キー操作）</h5>
        <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200 mt-4">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3 border-b border-gray-200 w-1/4">キー</th>
                        <th class="p-3 border-b border-gray-200 w-3/4">動作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                    <tr><td class="p-3 font-mono font-bold bg-gray-50 text-center"><kbd class="bg-white border border-gray-300 rounded px-2 py-1 shadow-sm text-xs">q</kbd></td><td class="p-3 font-bold text-red-600">lessの終了</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">j</td><td class="p-3">1行下にスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">k</td><td class="p-3">1行上にスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center"><kbd class="bg-white border border-gray-300 rounded px-2 py-1 shadow-sm text-xs">Ctrl</kbd> + <kbd class="bg-white border border-gray-300 rounded px-2 py-1 shadow-sm text-xs">d</kbd></td><td class="p-3">画面半分下にスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center"><kbd class="bg-white border border-gray-300 rounded px-2 py-1 shadow-sm text-xs">Ctrl</kbd> + <kbd class="bg-white border border-gray-300 rounded px-2 py-1 shadow-sm text-xs">u</kbd></td><td class="p-3">画面半分上にスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">f</td><td class="p-3">1画面下にスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">b</td><td class="p-3">1画面上にスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">g</td><td class="p-3">ファイルの先頭までスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">G</td><td class="p-3">ファイルの末尾までスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">/検索文字列</td><td class="p-3">/に続けて検索文字列を入れてEnterを押すと検索され該当部分までスクロール</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">n</td><td class="p-3">検索状態でnを押すと、該当文字列を次々と見つけていく</td></tr>
                    <tr><td class="p-3 font-mono bg-gray-50 text-center">N</td><td class="p-3">nの場合と逆方向に戻っていく</td></tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="space-y-4 pt-6 border-t border-gray-200">
        <h4 class="flex items-center gap-2 font-bold text-xl text-gray-800">
            その他のコマンド
        </h4>
        <p class="text-gray-700">
            他にも、ファイルやディレクトリをコピーする <code>cp</code> コマンドや、ファイルの移動や名前変更を行なう <code>mv</code> コマンド、ファイル名で検索する <code>find</code> コマンド、ファイル内の文字列を検索する <code>grep</code> コマンドなど、多くのコマンドが用意されています。
        </p>
        <div class="bg-white border border-gray-200 p-4 rounded-lg shadow-sm">
            <p class="text-sm text-gray-600 mb-2">どのようなものがあるか、下記のサイトなどで確認してみると良いでしょう。</p>
            <a href="https://www.k-tanaka.net/unix/" target="_blank" rel="noopener noreferrer" class="text-blue-600 font-bold hover:underline flex items-center gap-1">
                UNIXコマンド - k-tanaka.net
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
        </div>
        <p class="text-gray-700 font-bold text-center mt-4 bg-yellow-50 py-3 rounded text-yellow-900 border border-yellow-200">
            多くのコマンドはあまり頻繁には使いませんが、ここで学んだコマンドだけは最低限覚えましょう！
        </p>
    </section>
</div>'
            ]
        );
    }
}