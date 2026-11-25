<?php

namespace Tests\Feature;

use App\Models\IntermediateTask;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TaskLifecycleExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_creation_connects_request_database_images_and_completion(): void
    {
        // テスト専用DBと仮の保存領域を使い、実データを変更しない。
        Storage::fake('public');
        $user = User::factory()->create(['role' => 'admin']);
        $related = IntermediateTask::create([
            'title' => '関連する設計', 'description' => '確認する設計',
            'phase' => 'basic_design', 'status' => 'incomplete',
        ]);

        // HTTPの入力が、タスク・担当者・画像・関連タスクへ保存されることを確認。
        $this->actingAs($user)->post(route('courses.intermediate.store'), [
            'title' => 'テスト例のタスク', 'phase' => 'implementation',
            'description' => '**完了条件**を確認する', 'description_format' => 'markdown',
            'assignee_id' => $user->id, 'related_task_ids' => [$related->id],
            'images' => [UploadedFile::fake()->image('first.png'), UploadedFile::fake()->image('second.png')],
        ])->assertSessionHasNoErrors()->assertRedirect(route('courses.intermediate.index'));

        $task = IntermediateTask::where('title', 'テスト例のタスク')->firstOrFail();
        $this->assertSame('assigned', $task->status);
        $this->assertTrue($task->completedUsers->contains($user));
        $this->assertCount(2, $task->attachmentPaths());
        Storage::disk('public')->assertExists($task->attachmentPaths());
        $this->assertTrue($related->relatedTasks()->whereKey($task->id)->exists());
        $this->get(route('courses.intermediate.show_task', $task->id))->assertOk()->assertSee('<strong>完了条件</strong>', false);

        // 担当者が完了すると、DBが更新され、担当中一覧から外れる。
        $this->post(route('courses.intermediate.complete_task', $task->id))->assertRedirect();
        $this->assertSame('completed', $task->fresh()->status);
        $this->get(route('courses.intermediate.index'))->assertOk()
            ->assertViewHas('assignedTasks', fn ($tasks) => $tasks->total() === 0);
    }
}
