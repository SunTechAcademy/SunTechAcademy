<?php
require __DIR__.'/../../../vendor/autoload.php';
$app = require __DIR__.'/../../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
// Only run against the disposable SQLite file created by the browser test.
if (config('database.default') !== 'sqlite' || !str_contains(config('database.connections.sqlite.database'), 'academy-e2e-')) {
    throw new RuntimeException('This fixture requires the temporary E2E database.');
}
$user = App\Models\User::factory()->create(['name'=>'E2E受講生', 'email'=>'example-e2e@example.invalid', 'password'=>'ExampleOnly2026!', 'role'=>'student']);
$course = App\Models\Course::forceCreate(['title'=>'テスト用初級']);
$lesson = App\Models\Lesson::forceCreate(['course_id'=>$course->id, 'title'=>'テスト用Lesson', 'sort_order'=>1]);
$chapter = App\Models\Chapter::forceCreate(['lesson_id'=>$lesson->id, 'title'=>'テスト用Chapter', 'sort_order'=>1]);
$user->chapters()->attach($chapter->id, ['completed_at'=>now()]);
