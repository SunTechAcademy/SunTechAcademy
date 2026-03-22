<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3_4Seeder extends Seeder
{
    public function run(): void
    {
        $lesson3 = Lesson::where('title', 'HTML基礎')->first();

        if (!$lesson3) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson3->id,
                'sort_order' => 5
            ],
            [
                'title' => 'head要素内の記述',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">

    <section>
        <p class="text-lg leading-relaxed">
            <code>&lt;head&gt;</code> 要素内には、Webページの設定情報（メタ情報）を記述します。
            主に <code>meta</code> 要素、<code>title</code> 要素、<code>link</code> 要素などが含まれます。
        </p>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            meta要素
        </h4>

        <p>meta要素には、文書の<strong>メタ情報</strong>を記述します。メタ情報には、文書の説明や文字エンコーディングなどが含まれます。</p>

        <div class="bg-gray-800 rounded-lg p-4">
<pre class="text-green-400 text-sm font-mono"><code>&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="description" content="文書の説明..."&gt;
&lt;/head&gt;</code></pre>
        </div>

        <div class="space-y-4 leading-relaxed">
            <p><code>&lt;meta charset="UTF-8"&gt;</code> は、HTML文書の文字コードをUTF-8で記述する宣言です。これを記述しないと文字化けの原因になります。</p>

            <p><code>name="description"</code> は、ページの概要を検索エンジンに伝えるための情報です。検索結果にも表示されるため、SEO上とても重要です。</p>

            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <p class="font-bold text-blue-800">💡 ポイント</p>
                <p class="text-sm text-blue-700">
                    meta要素はタグ自体に意味はなく、属性（charsetやnameなど）によって役割が決まります。
                </p>
            </div>
        </div>

        <div class="space-y-4">
            <h5 class="font-bold text-lg text-gray-800 border-l-4 border-gray-400 pl-3">（参考）OGP</h5>

            <p>SNSでシェアされたときの表示を制御するmeta情報を<strong>OGP</strong>と呼びます。</p>

            <div class="bg-gray-800 rounded-lg p-4">
<pre class="text-green-400 text-sm font-mono"><code>&lt;meta property="og:title" content="サイトタイトル"&gt;
&lt;meta property="og:description" content="サイト説明"&gt;
&lt;meta property="og:url" content="https://example.com"&gt;
&lt;meta property="og:image" content="https://example.com/image.jpg"&gt;</code></pre>
            </div>

            <p class="text-sm text-gray-600">
                これにより、TwitterやFacebookでURLを共有した際に、画像や説明が自動表示されます。
            </p>

            <img src="/images/Lesson2-26.png" class="mx-auto border rounded shadow-sm" alt="OGPの例">
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            title要素
        </h4>

        <p><code>title</code> 要素には、Webページのタイトルを記述します。</p>

        <div class="bg-gray-800 rounded-lg p-4">
<pre class="text-green-400 text-sm font-mono"><code>&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;HTML文書の基本&lt;/title&gt;
&lt;/head&gt;</code></pre>
        </div>

        <p class="leading-relaxed">
            タイトルは検索結果に表示されるため、SEOにおいて最も重要な要素の一つです。
            ページ内容に合った適切なタイトルを設定しましょう。
        </p>

        <img src="/images/Lesson2-27.png" class="mx-auto border rounded shadow-sm" alt="titleの例">
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            link要素
        </h4>

        <p>link要素は、CSSなどの外部ファイルを読み込むために使用します。</p>

        <div class="bg-gray-800 rounded-lg p-4">
<pre class="text-green-400 text-sm font-mono"><code>&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;HTML文書の基本&lt;/title&gt;
    &lt;link rel="stylesheet" href="style.css"&gt;
&lt;/head&gt;</code></pre>
        </div>

        <div class="space-y-2 text-sm text-gray-700">
            <p><strong>rel属性：</strong> ファイルの種類を指定（CSSの場合は <code>stylesheet</code>）</p>
            <p><strong>href属性：</strong> ファイルの場所（URLやパス）を指定</p>
        </div>
    </section>

    <section class="space-y-4 bg-green-50 p-6 rounded-xl border border-green-200">
        <h4 class="font-bold text-lg text-green-900">ここまでのまとめ</h4>

        <ul class="list-disc ml-6 text-sm text-green-800 space-y-2">
            <li>head要素には画面に表示されない「設定情報」を記述する</li>
            <li>meta要素はSEOや文字コードなどのメタ情報を定義する</li>
            <li>title要素は検索結果に表示される重要な要素</li>
            <li>link要素はCSSなど外部ファイルの読み込みに使用する</li>
        </ul>

        <p class="text-sm text-green-800 mt-4">
            その他にも、Googleアナリティクスなどのアクセス解析ツールのコードをhead内に記述することがあります。
        </p>
    </section>
</div>'
            ]
        );
    }
}