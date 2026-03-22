<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3_3Seeder extends Seeder
{
    public function run(): void
    {
        $lesson3 = Lesson::where('title', 'HTML基礎')->first();

        if (!$lesson3) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson3->id,
                'sort_order' => 4
            ],
            [
                'title' => 'HTMLの基本',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section>
        <p class="text-lg leading-relaxed">HTMLファイルの基本構成について学びます。</p>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            HTMLファイルの編集
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>HTMLファイルはテキストファイルです。編集には「テキストエディタ」を使用します。本格的なコーディングには、入力補助機能が充実したエディタが欠かせません。</p>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p><strong>拡張子のルール：</strong></p>
                <ul class="list-disc ml-6 mt-2">
                    <li>HTML文書として認識させるには <code>.html</code> にする必要があります。</li>
                    <li><code>.txt</code> のままだと、ブラウザで開いてもソースコードがそのまま表示されてしまいます。</li>
                </ul>
            </div>
            <p>本カリキュラムでは <strong>VS Code（Visual Studio Code）</strong> を使用します。未インストールの方は以下を参考に準備しましょう。</p>
            <div class="flex flex-col sm:flex-row gap-4 mt-2">
                <a href="https://qiita.com/watamura/items/51c70fbb848e5f956fd6" target="_blank" class="flex-1 p-3 bg-white border border-blue-200 rounded text-blue-600 hover:bg-blue-50 text-center text-sm font-bold">VS Code インストール (Mac)</a>
                <a href="https://trustbrain.jp/blog/blog15513/" target="_blank" class="flex-1 p-3 bg-white border border-blue-200 rounded text-blue-600 hover:bg-blue-50 text-center text-sm font-bold">VS Code インストール (Windows)</a>
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            最小のHTML文書
        </h4>
        <p>Webブラウザで正しく表示させるために必要な、最小限の構造を確認しましょう。</p>
        <div class="bg-gray-800 rounded-lg p-4 shadow-inner">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-400 text-xs font-mono font-bold">minimum.html</span>
            </div>
            <pre class="text-green-400 font-mono text-sm leading-relaxed"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;タイトル&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;p&gt;本文です。&lt;/p&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            作業手順
        </h4>
        <div class="space-y-8">
            <div class="flex gap-4">
                <div class="flex-none"><span class="bg-[#6A73A6] text-white rounded-full w-8 h-8 flex items-center justify-center font-bold">1</span></div>
                <div>
                    <p class="font-bold text-gray-800">VS Codeを起動し、作業フォルダを開く</p>
                    <p class="text-sm text-gray-600">「ファイル」→「フォルダーを開く」から、新規作成した <code>SunTechAcademy</code> フォルダを選択します。</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex-none"><span class="bg-[#6A73A6] text-white rounded-full w-8 h-8 flex items-center justify-center font-bold">2</span></div>
                <div>
                    <p class="font-bold text-gray-800">HTMLファイルを新規作成する</p>
                    <p class="text-sm text-gray-600">フォルダ名の横にある「新しいファイル」アイコンから <code>minimum.html</code> を作成します。</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex-none"><span class="bg-[#6A73A6] text-white rounded-full w-8 h-8 flex items-center justify-center font-bold">3</span></div>
                <div>
                    <p class="font-bold text-gray-800">コードを入力して保存する</p>
                    <p class="text-sm text-gray-600">上記のコードを入力し、<code>Ctrl + S</code> (Win) または <code>Command + S</code> (Mac) で保存します。</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex-none"><span class="bg-[#6A73A6] text-white rounded-full w-8 h-8 flex items-center justify-center font-bold">4</span></div>
                <div>
                    <p class="font-bold text-gray-800">ブラウザで表示する (Live Server)</p>
                    <p class="text-sm text-gray-600">拡張機能 <strong>Live Server</strong> を使うと、右クリックから「Open with Live Server」を選択するだけでリアルタイムにプレビューが可能です。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            HTMLタグの構造
        </h4>
        <p>HTMLタグは「文書に意味付け（マークアップ）」をするための記号です。</p>
        
        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">開始と終了がある要素</h5>
            <p>多くの要素は、開始タグと終了タグで内容を挟みます。このまとまりを<strong>要素</strong>と呼びます。</p>
            <img src="/images/Lesson2-22.png" alt="HTMLタグの構造図" class="mx-auto border rounded shadow-sm">
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">終了タグのない要素</h5>
            <p><code>&lt;meta&gt;</code> や <code>&lt;img&gt;</code> のように、終了タグを持たない要素も存在します。これらは単独で機能します。</p>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            属性
        </h4>
        <p><strong>属性</strong>とは、タグの中に記述する付加情報のことです。</p>
        <div class="bg-gray-50 p-6 rounded-lg text-center">
            <code class="text-xl font-bold text-pink-600">&lt;meta charset="UTF-8"&gt;</code>
            <p class="text-sm text-gray-500 mt-2">属性名="属性値" の形式で記述します</p>
        </div>
        <img src="/images/Lesson2-23.png" alt="属性の説明図" class="mx-auto border rounded shadow-sm">
    </section>

    <section class="space-y-8">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            基本構成の役割
        </h4>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-2 bg-blue-50 p-4 rounded-lg">
                <p class="font-bold text-blue-900">DOCTYPE宣言</p>
                <p class="text-sm"><code>&lt;!DOCTYPE html&gt;</code> は、これが最新のHTML文書であることをブラウザに伝えます。必ず1行目に記述します。</p>
            </div>
            <div class="space-y-2 bg-green-50 p-4 rounded-lg">
                <p class="font-bold text-green-900">HTMLのコメント</p>
                <p class="text-sm"><code>&lt;!-- --&gt;</code> で囲んだ部分はブラウザに表示されません。制作者のメモとして使います。</p>
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">headとbodyの使い分け</h5>
            <p>HTML文書は大きく2つのパーツに分かれます。</p>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="border p-4 rounded bg-white shadow-sm">
                    <p class="font-bold text-[#6A73A6]">&lt;head&gt; (メタ情報)</p>
                    <p class="text-sm text-gray-600 mt-1">画面には表示されない設定情報。タイトル、文字コード、CSSの読み込みなど。</p>
                </div>
                <div class="border p-4 rounded bg-white shadow-sm">
                    <p class="font-bold text-[#6A73A6]">&lt;body&gt; (本文)</p>
                    <p class="text-sm text-gray-600 mt-1">実際にブラウザの画面上に表示されるコンテンツ（テキスト、画像など）。</p>
                </div>
            </div>
            <img src="/images/Lesson2-24.png" alt="headとbodyの構造図" class="mx-auto border rounded shadow-sm mt-4">
        </div>
    </section>

    <section class="space-y-4 bg-yellow-50 p-6 rounded-xl border border-yellow-200">
        <h4 class="font-bold text-lg text-yellow-900">⚠️ インデントと全角スペースの注意</h4>
        <p class="text-sm text-yellow-800 leading-relaxed">
            階層構造をわかりやすくするために、半角スペース2〜4文字分で字下げ（インデント）を行いましょう。
            <strong>特に注意すべきは「全角スペース」です。</strong> 見た目ではわかりにくいですが、プログラムに全角スペースが混じるとエラーの原因になります。
        </p>
        <img src="/images/Lesson2-25.png" alt="全角スペース注意図" class="mx-auto rounded border border-yellow-300 mt-4">
    </section>

    <div class="text-center pt-8">
        <p class="text-gray-500 text-sm mb-4">お疲れ様でした！HTMLの基本構造が理解できたら次へ進みましょう。</p>
    </div>
</div>'
            ]
        );
    }
}