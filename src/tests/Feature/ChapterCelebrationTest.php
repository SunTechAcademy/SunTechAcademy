<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ChapterCelebrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_completion_celebrates_chapter_then_whole_lesson_only_once(): void
    {
        $user = User::factory()->create();
        $course = DB::table('courses')->insertGetId(['title' => 'Test course']);
        $lesson = DB::table('lessons')->insertGetId(['course_id' => $course, 'title' => 'Test lesson', 'sort_order' => 1]);
        $first = DB::table('chapters')->insertGetId(['lesson_id' => $lesson, 'title' => 'First chapter', 'sort_order' => 1]);
        $last = DB::table('chapters')->insertGetId(['lesson_id' => $lesson, 'title' => 'Last chapter', 'sort_order' => 2]);
        $this->actingAs($user);

        $this->post(route('chapters.complete', $last))
            ->assertRedirect(route('lessons.show', $lesson).'#chapter-'.$last)
            ->assertSessionHas('chapterCelebration.lesson_complete', false)
            ->assertSessionHas('chapterCelebration.completed', 1)
            ->assertSessionHas('chapterCelebration.chapter_number', 2);
        $this->get(route('lessons.show', $lesson))->assertOk()->assertSee('Chapter 2 が完了しました');
        $this->get(route('lessons.show', $lesson))->assertOk()->assertDontSee('data-celebration');

        $this->post(route('chapters.complete', $first))
            ->assertSessionHas('chapterCelebration.lesson_complete', true)
            ->assertSessionHas('chapterCelebration.completed', 2);
        $this->get(route('lessons.show', $lesson))->assertOk()->assertSee('すごい！すべてのChapterを達成！');

        $this->post(route('chapters.complete', $first))->assertSessionMissing('chapterCelebration');
        $this->assertDatabaseMissing('chapter_user', ['user_id' => $user->id, 'chapter_id' => $first]);
        $this->get(route('lessons.show', $lesson))->assertDontSee('data-celebration');
    }

    public function test_another_users_completion_does_not_count_and_invalid_chapter_is_rejected(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $course = DB::table('courses')->insertGetId(['title' => 'Test course']);
        $lesson = DB::table('lessons')->insertGetId(['course_id' => $course, 'title' => 'Test lesson', 'sort_order' => 1]);
        $first = DB::table('chapters')->insertGetId(['lesson_id' => $lesson, 'title' => 'First', 'sort_order' => 1]);
        $last = DB::table('chapters')->insertGetId(['lesson_id' => $lesson, 'title' => 'Last', 'sort_order' => 2]);
        $other->chapters()->attach($first, ['completed_at' => now()]);
        $this->actingAs($user)->post(route('chapters.complete', $last))
            ->assertSessionHas('chapterCelebration.lesson_complete', false)
            ->assertSessionHas('chapterCelebration.completed', 1);
        $this->post(route('chapters.complete', 99999))->assertNotFound();
    }
}
