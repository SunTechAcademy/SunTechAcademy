<?php
namespace App\Support;

use Illuminate\Support\Str;

class TaskMarkdown
{
    public static function render(string $text): string
    {
        return Str::markdown($text, ['html_input' => 'escape', 'allow_unsafe_links' => false, 'max_nesting_level' => 20]);
    }
}
