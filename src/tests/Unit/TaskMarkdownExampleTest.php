<?php

namespace Tests\Unit;

use App\Support\TaskMarkdown;
use PHPUnit\Framework\TestCase;

class TaskMarkdownExampleTest extends TestCase
{
    public function test_bold_text_is_rendered_and_raw_script_is_not_executed(): void
    {
        // Arrange（準備）：利用者が入力する文章を用意する。
        $input = "**完了条件**\n\n<script>alert('test')</script>";

        // Act（実行）：DBやHTTPを使わず、変換処理だけを呼び出す。
        $html = TaskMarkdown::render($input);

        // Assert（確認）：太字は表示用HTMLになり、scriptタグは無害な文字になる。
        $this->assertStringContainsString('<strong>完了条件</strong>', $html);
        $this->assertStringNotContainsString('<script>', $html);
        $this->assertStringContainsString('&lt;script&gt;', $html);
    }
}
