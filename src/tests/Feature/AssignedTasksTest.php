<?php

namespace Tests\Feature;

use App\Models\IntermediateTask;
use App\Models\User;
use App\Http\Middleware\CheckBeginnerCourseCompletion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssignedTasksTest extends TestCase
{
    use RefreshDatabase;

    private function task(User $assignee, string $title, string $status = 'assigned', string $phase = 'implementation'): IntermediateTask
    {
        $task = IntermediateTask::create(compact('title', 'status', 'phase') + ['description' => '内容']);
        $task->completedUsers()->attach($assignee);
        return $task;
    }

    public function test_only_current_users_active_tasks_are_shown_across_phases_and_completion_removes_them(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $a = $this->task($user, '自分の実装タスク');
        $b = $this->task($user, '自分の運用タスク', 'assigned', 'operation');
        $this->task($other, '他人の担当タスク');
        $this->task($user, '完了済みのタスク', 'completed');
        $this->task($user, '未着手のタスク', 'incomplete');

        $this->withoutMiddleware(CheckBeginnerCourseCompletion::class)->actingAs($user);
        $this->get(route('courses.intermediate.index'))->assertOk()
            ->assertSee('自分の実装タスク')->assertSee('自分の運用タスク')
            ->assertSee(route('courses.intermediate.show_task', $b->id))
            ->assertDontSee('他人の担当タスク')->assertDontSee('完了済みのタスク')->assertDontSee('未着手のタスク')
            ->assertViewHas('assignedTasks', fn ($tasks) => $tasks->total() === 2);

        $a->update(['status' => 'completed']);
        $this->get(route('courses.intermediate.index'))->assertOk()->assertDontSee('自分の実装タスク')
            ->assertViewHas('assignedTasks', fn ($tasks) => $tasks->total() === 1);
    }

    public function test_empty_state_and_pagination_keep_all_assigned_tasks_accessible(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user)->get(route('courses.intermediate.index'))->assertOk()->assertSee('現在、担当中のタスクはありません');
        for ($i = 1; $i <= 11; $i++) {
            $this->task($user, "担当タスク番号{$i}");
        }
        $this->get(route('courses.intermediate.index'))->assertOk()
            ->assertViewHas('assignedTasks', fn ($tasks) => $tasks->total() === 11 && $tasks->count() === 10)
            ->assertSee('assigned_page=2#assigned-tasks', false);
        $this->get(route('courses.intermediate.index', ['assigned_page' => 2]))->assertOk()
            ->assertViewHas('assignedTasks', fn ($tasks) => $tasks->count() === 1 && $tasks->first()->title === '担当タスク番号1');
    }
}
