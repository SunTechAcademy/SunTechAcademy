<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson8_4Seeder extends Seeder
{
    public function run(): void
    {
        $lesson8 = Lesson::where('title', 'PHPその1')->first();

        if (!$lesson8) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson8->id,
                'sort_order' => 4
            ],
            [
                'title' => '変数',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <section class="space-y-4">
        <p class="text-lg leading-relaxed text-gray-700">
            引き続き、PHPが持つプログラミングのための機能を学んでいきます。ここでは非常に重要な<strong>「変数（へんすう）」</strong>について解説します。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            変数へデータを代入
        </h4>
        <p class="text-gray-700">
            プログラムは「これは必要なデータだから保存してください」という命令を出すことができます。これが<strong>変数への代入</strong>です。
        </p>
        
        

        <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4">
            <p class="text-sm text-indigo-900 leading-relaxed">
                変数は、<strong>データを保存しておける箱</strong>だとイメージしてください。コンピュータのメモリにデータを一時的に保存しておくことで、あとで必要なときに再利用できます。
            </p>
        </div>

        <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white">
            <span class="text-gray-500">// まだ実行しないでください</span><br>
            <span class="text-blue-400">$hensuu</span> = <span class="text-green-400">"何らかのデータ"</span>;
        </div>

        <div class="space-y-3 text-sm text-gray-700">
            <p>● <code class="font-bold text-blue-600">$</code> の後に英数字をつけると変数になります（ターミナルの$とは無関係です）。</p>
            <p>● <code class="font-bold text-red-600">=</code> は「等しい」ではなく、<strong>「右辺のデータを左辺の変数に代入（格納）する」</strong>という意味です。</p>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            変数の中のデータを参照する
        </h4>
        <p class="text-gray-700">
            変数に入れたデータを使いたいときは、変数名を書くだけです。これを<strong>参照（さんしょう）</strong>といいます。
        </p>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 shadow-sm">
            <h5 class="font-bold text-gray-800 mb-4">【実習】 test.php を書き換えて実行</h5>
            <div class="bg-gray-900 rounded-lg p-4 font-mono text-sm text-white mb-4">
                <span class="text-gray-500">test.php</span><br>
                &lt;?php<br>
                &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">$hensuu</span> = <span class="text-green-400">"何らかのデータ"</span>;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;print <span class="text-blue-400">$hensuu</span>;
            </div>
            <div class="bg-gray-800 rounded p-4 font-mono text-xs text-white">
                <span class="text-green-400">%</span> php test.php<br>
                何らかのデータ
            </div>
        </div>
        <p class="text-sm text-gray-600">
            <code>print</code> に変数を渡すと、変数名ではなく、その<strong>中身のデータ</strong>が表示されます。箱の中身を覗き見るイメージです。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            変数を使ううえでの注意点
        </h4>
        
        <h5 class="font-bold text-lg text-gray-800">変数名の名付け方</h5>
        <p class="text-gray-700">
            コンピュータにとって変数名は何でも良いですが、人間にとって<strong>可読性（読みやすさ）</strong>は非常に重要です。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="border border-red-200 rounded-lg p-4 bg-red-50">
                <p class="text-xs font-bold text-red-600 mb-2 uppercase">bad example</p>
                <code class="text-sm">$x = 86400;</code>
                <p class="text-xs text-gray-500 mt-2">何の数字かさっぱりわかりません。</p>
            </div>
            <div class="border border-green-200 rounded-lg p-4 bg-green-50">
                <p class="text-xs font-bold text-green-600 mb-2 uppercase">good example</p>
                <code class="text-sm">$seconds_per_day = 86400;</code>
                <p class="text-xs text-gray-500 mt-2">「1日の秒数」だとひと目でわかります。</p>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">
            <h5 class="text-blue-900 font-bold mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                開発のセオリー
            </h5>
            <ul class="text-sm text-blue-800 space-y-2 list-disc list-inside">
                <li><strong>英語で命名する：</strong> <code>$ichiniti_byou</code> ではなく <code>$seconds_per_day</code>。</li>
                <li><strong>計算過程を残す：</strong> <code>86400</code> ではなく <code>24 * 60 * 60</code> と書くほうが意図が伝わります。</li>
                <li><strong>バランス：</strong> 丁寧すぎても冗長になります。チームで理解できる範囲を心がけましょう。</li>
            </ul>
        </div>
    </section>

    <section class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <h5 class="font-bold text-gray-800 border-l-4 border-[#6A73A6] pl-2">複数の単語をつなぐ場合</h5>
                <table class="w-full text-sm">
                    <tr class="border-b">
                        <th class="py-2 text-left text-gray-500">スネークケース</th>
                        <td class="py-2 font-mono"><code>$seconds_per_day</code></td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-2 text-left text-gray-500">キャメルケース</th>
                        <td class="py-2 font-mono"><code>$secondsPerDay</code></td>
                    </tr>
                </table>
                <p class="text-xs text-gray-600">基本的にはプロジェクトのルールに合わせます。</p>
            </div>

            <div class="space-y-4">
                <h5 class="font-bold text-gray-800 border-l-4 border-[#6A73A6] pl-2">データは上書きできる</h5>
                <div class="bg-gray-800 rounded p-4 font-mono text-xs text-white">
                    $hensuu = "何らかのデータ";<br>
                    $hensuu = 86400; <span class="text-gray-500">// 別の型で上書きOK</span><br>
                    print $hensuu; <span class="text-yellow-400">// 86400と表示される</span>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-2xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            変数名にできないもの（命名規則と予約語）
        </h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white border border-gray-200 rounded-lg p-5">
                <h5 class="font-bold text-red-600 mb-3 flex items-center gap-1 text-sm">
                    ❌ 使えない形式
                </h5>
                <ul class="text-xs text-gray-600 space-y-2">
                    <li>・<strong>数字から始まる名前</strong> (例: <code>$1abc</code>)</li>
                    <li>・<strong>ハイフンを含む名前</strong> (例: <code>$a-to-b</code>)</li>
                </ul>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-5">
                <h5 class="font-bold text-indigo-600 mb-3 flex items-center gap-1 text-sm">
                    ⚠️ 避けるべき「予約語」
                </h5>
                <p class="text-xs text-gray-600">
                    PHPが既に特別な意味として使っている単語（予約語）は、変数名などに使うと混乱やエラーの元になります。
                </p>
            </div>
        </div>

        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h5 class="font-bold text-gray-800 mb-4 text-sm">覚えておきたい予約語・定義済ワード</h5>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <h6 class="text-[10px] uppercase text-gray-400 font-bold mb-2">基本型・値</h6>
                    <ul class="text-[11px] font-mono text-gray-700 bg-white p-2 rounded shadow-sm leading-relaxed">
                        <li>int, float, string</li>
                        <li>bool, array, object</li>
                        <li>true, false, null</li>
                        <li>void, mixed, never</li>
                    </ul>
                </div>
                <div>
                    <h6 class="text-[10px] uppercase text-gray-400 font-bold mb-2">定義済クラス・エラー</h6>
                    <ul class="text-[11px] font-mono text-gray-700 bg-white p-2 rounded shadow-sm leading-relaxed">
                        <li>Exception, Error</li>
                        <li>stdClass, Closure</li>
                        <li>self, parent, static</li>
                    </ul>
                </div>
                <div>
                    <h6 class="text-[10px] uppercase text-gray-400 font-bold mb-2">マジック定数・システム</h6>
                    <ul class="text-[11px] font-mono text-gray-700 bg-white p-2 rounded shadow-sm leading-relaxed">
                        <li>__LINE__, __FILE__</li>
                        <li>__DIR__, __CLASS__</li>
                        <li>PHP_VERSION, PHP_EOL</li>
                    </ul>
                </div>
            </div>
            <div class="mt-4 bg-yellow-50 p-3 rounded text-[10px] text-yellow-800 leading-relaxed italic">
                ※ ざっくりとした認識として、<strong>「PHP_」や「__」で始まる単語</strong>、および<strong>基本的なデータ型名</strong>は変数名に使わないようにしましょう。
            </div>
        </div>
    </section>
</div>'
            ]
        );
    }
}