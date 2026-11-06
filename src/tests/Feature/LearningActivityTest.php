<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class LearningActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_calendar_shows_only_current_user_history_and_handles_leap_month(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2024-03-01 12:00:00'));
        try {
            $user = User::factory()->create();
            $other = User::factory()->create();
            $user->loginHistories()->create(['login_date' => '2024-02-29']);
            $user->loginHistories()->create(['login_date' => '2024-02-28']);
            $user->loginHistories()->create(['login_date' => '2024-01-10']);
            $other->loginHistories()->create(['login_date' => '2024-02-27']);
            $this->actingAs($user);
            request()->query->set('month', '2024-02');
            $html = Blade::render('<x-learning-activity />');
            $this->assertStringContainsString('2024年2月', $html);
            $this->assertStringContainsString('2月29日 ログインあり', $html);
            $this->assertStringContainsString('2月27日 ログイン記録なし', $html);
            $this->assertStringContainsString('<strong>3</strong> 日', $html);
            $this->assertStringContainsString('累計ログイン日数', $html);
            $this->assertStringContainsString('<strong>2 日</strong>', $html);
            request()->query->set('month', '2024-01');
            $this->assertStringContainsString('<strong>3</strong> 日', Blade::render('<x-learning-activity />'));
            $this->assertStringNotContainsString('2月30日', $html);
        } finally {
            CarbonImmutable::setTestNow();
        }
    }

    public function test_invalid_month_and_empty_history_render_without_errors(): void
    {
        $this->actingAs(User::factory()->create());
        foreach (['2026-99', 'invalid', ['2026-01'], '2099-12'] as $month) {
            request()->query->set('month', $month);
            $html = Blade::render('<x-learning-activity />');
            $this->assertStringContainsString(CarbonImmutable::today()->format('Y年n月'), $html);
            $this->assertStringContainsString('<strong>0</strong> 日', $html);
        }
    }

    public function test_both_course_pages_render_activity_and_current_user_statistics(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $course = \Illuminate\Support\Facades\DB::table('courses')->insertGetId(['title' => 'Test']);
        $lesson = \Illuminate\Support\Facades\DB::table('lessons')->insertGetId(['course_id' => $course, 'title' => 'Test lesson', 'sort_order' => 1]);
        $chapter = \Illuminate\Support\Facades\DB::table('chapters')->insertGetId(['lesson_id' => $lesson, 'title' => 'Test chapter', 'sort_order' => 1]);
        $user->chapters()->attach($chapter, ['completed_at' => now()]);
        $this->get(route('courses.beginner'))->assertOk()->assertSee('学習カリキュラム')->assertSee('login-calendar')
            ->assertSee('100.0')->assertSee('1 / 1 Chapter完了')->assertSee('#chapter-'.$chapter)
            ->assertSee('class="lesson-card lesson-card-completed"', false)->assertSee('全Chapter完了')
            ->assertSee('✦ 100％達成')->assertSee('✓ 全Lesson完了');
        $user->chapters()->detach($chapter);
        $this->get(route('courses.beginner'))->assertOk()->assertDontSee('class="lesson-card lesson-card-completed"', false)->assertDontSee('class="course-stat course-stat-achieved"', false);
        \Illuminate\Support\Facades\DB::table('lessons')->insert(['course_id' => $course, 'title' => 'Empty lesson', 'sort_order' => 2]);
        $this->get(route('courses.beginner'))->assertOk()->assertDontSee('class="lesson-card lesson-card-completed"', false)->assertDontSee('class="course-stat course-stat-achieved"', false);
        $this->withoutMiddleware(\App\Http\Middleware\CheckBeginnerCourseCompletion::class)
            ->get(route('courses.intermediate.index'))->assertOk()->assertSee('実務経験の達成目標')->assertSee('login-calendar');
    }
}
