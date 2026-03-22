<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson3_8Seeder extends Seeder
{
    public function run(): void
    {
        $lesson3 = Lesson::where('title', 'HTML基礎')->first();

        if (!$lesson3) return;

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson3->id,
                'sort_order' => 9
            ],
            [
                'title' => '参考資料・補足',
                'is_assignment' => 0,
                'content' => '
<div class="space-y-12">
    <script>
        function runMockValidator() {
            const code = document.getElementById("validator-input").value;
            const resultDiv = document.getElementById("validation-result");
            let messages = [];
            
            // 簡易的なエラーチェック
            if (!code.includes("<!DOCTYPE html>")) {
                messages.push({type: "error", msg: "DOCTYPE宣言が見当たりません。"});
            }
            if (code.includes("<img") && !code.includes("alt=")) {
                messages.push({type: "error", msg: "img要素にalt属性がありません。"});
            }
            if (code.match(/id="([^"]+)"(.|\n)*id="\\1"/)) {
                messages.push({type: "error", msg: "同じID名が重複して使用されています。"});
            }
            if (code.includes("<font")) {
                messages.push({type: "warning", msg: "font要素は非推奨です。CSSを使用してください。"});
            }

            if (messages.length === 0 && code.trim() !== "") {
                resultDiv.innerHTML = `
                    <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded text-green-700">
                        <p class="font-bold">✅ Passed!</p>
                        <p class="text-sm">文法的な問題は見つかりませんでした（簡易チェック）。</p>
                    </div>`;
            } else if (code.trim() === "") {
                resultDiv.innerHTML = "<p class=\"text-gray-400 text-sm\">コードを入力して「チェック」を押してください。</p>";
            } else {
                let html = "<div class=\'space-y-2\'>";
                messages.forEach(m => {
                    const color = m.type === "error" ? "red" : "yellow";
                    html += `
                        <div class="bg-${color}-100 border-l-4 border-${color}-500 p-3 rounded text-${color}-800 text-sm">
                            <strong>${m.type === "error" ? "❌ Error" : "⚠️ Warning"}:</strong> ${m.msg}
                        </div>`;
                });
                html += "</div>";
                resultDiv.innerHTML = html;
            }
        }
    </script>

    <section>
        <p class="text-lg leading-relaxed">
            HTMLのコーディングに慣れてきたら、自分の書いたコードが「正しい文法かどうか」をチェックしてみましょう。
            ここでは、世界標準の文法チェックサービスを紹介します。
        </p>
    </section>

    <section class="space-y-6">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            HTML文法チェックサービス
        </h4>
        <p>
            <strong>「The W3C Markup Validation Service」</strong>は、HTMLの仕様を定めているW3Cという団体が提供している公式サービスです。
        </p>
        
        <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
            <div class="bg-gray-100 p-3 border-b flex justify-between items-center">
                <span class="text-sm font-bold text-gray-600">公式サイト</span>
                <a href="https://validator.w3.org/#validate_by_input" target="_blank" class="text-blue-600 text-xs hover:underline flex items-center gap-1">
                    validator.w3.org を開く ↗
                </a>
            </div>
            <div class="p-6">
                <h5 class="font-bold mb-4">チェックの手順（Direct Input）</h5>
                <ol class="list-decimal ml-6 space-y-4 text-sm text-gray-700">
                    <li>
                        <strong>Validate by Direct Input</strong> タブを選択します。
                        <p class="text-xs text-gray-500 mt-1">URLではなく、コードを直接貼り付けてチェックするモードです。</p>
                    </li>
                    <li>
                        エディタ上のHTMLコードを <strong>すべて選択 (Ctrl+A)</strong> して <strong>コピー (Ctrl+C)</strong> します。
                    </li>
                    <li>
                        サイトのテキストエリアに <strong>貼り付け (Ctrl+V)</strong> し、<strong>Check</strong> ボタンをクリックします。
                    </li>
                </ol>
            </div>
        </div>
    </section>
    <div class="text-center pt-8">
        <p class="text-[#6A73A6] font-bold mb-4">🎉 HTML基礎レッスン完了です！</p>
        <p class="text-gray-500 text-sm mb-6">次は、いよいよデザインを彩る「CSS」の世界へ進みましょう。</p>
    </div>
</div>'
            ]
        );
    }
}