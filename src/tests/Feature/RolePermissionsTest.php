<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\IntermediateTask;
use App\Http\Middleware\CheckBeginnerCourseCompletion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_super_admin_can_manage_roles(): void
    {
        $student = User::factory()->create();
        foreach (['student', 'admin'] as $role) {
            $actor = User::factory()->create(['role' => $role]);
            $response = $this->actingAs($actor)->get(route('management.users'));
            $role === 'admin' ? $response->assertOk()->assertDontSee('name="role"', false) : $response->assertForbidden();
            $this->patch(route('management.users.role', $student), ['role' => 'admin'])->assertForbidden();
        }
        $owner = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($owner)->get(route('management.users'))->assertOk();
        $this->patch(route('management.users.role', $student), ['role' => 'admin'])->assertRedirect();
        $this->assertSame('admin', $student->fresh()->role);
        $this->patch(route('management.users.role', $owner), ['role' => 'student'])->assertSessionHasErrors('role');
        $this->assertSame('super_admin', $owner->fresh()->role);
        $this->patch(route('management.users.role', $student), ['role' => 'super_admin'])->assertRedirect();
        $this->assertSame('super_admin', $student->fresh()->role);
        $this->patch(route('management.users.role', $student), ['role' => 'invalid'])->assertSessionHasErrors('role');
        $this->patch(route('management.users.role', $student), ['role' => 'student'])->assertRedirect();
        $this->assertSame('student', $student->fresh()->role);
    }

    public function test_all_users_are_listed_and_search_and_pagination_work(): void
    {
        $owner = User::factory()->create(['role' => 'super_admin']);
        User::factory()->count(30)->create();
        $student = User::factory()->create(['name' => '検索対象受講生', 'email' => 'find@example.com']);
        $this->actingAs($owner)->get(route('management.users'))->assertOk()->assertViewHas('totalUsers', 32);
        $this->get(route('management.users', ['page' => 2]))->assertOk()->assertSee($student->email);
        $this->get(route('management.users', ['search' => '検索対象']))->assertOk()->assertSee($student->email)->assertDontSee($owner->email.'</p>', false);
        $this->get(route('management.users', ['search' => 'no-match']))->assertOk()->assertSee('該当するユーザーが見つかりません');
    }

    public function test_owner_can_transfer_authority_and_demote_self(): void
    {
        $owner = User::factory()->create(['role' => 'super_admin']);
        $other = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($owner)->patch(route('management.users.role', $owner), ['role' => 'admin'])->assertRedirect(route('dashboard'));
        $this->assertSame('admin', $owner->fresh()->role);
        $this->actingAs($owner->fresh())->get(route('management.users'))->assertOk()->assertDontSee('name="role"', false);
        $this->actingAs($other)->patch(route('management.users.role', $other), ['role' => 'student'])->assertSessionHasErrors('role');
    }

    public function test_student_can_issue_for_self_but_cannot_modify_task_definition(): void
    {
        $this->withoutMiddleware(CheckBeginnerCourseCompletion::class);
        $student = User::factory()->create();
        $task = IntermediateTask::create(['user_id' => $student->id, 'phase' => 'implementation', 'title' => 'Task', 'description' => 'Description', 'status' => 'incomplete']);
        $this->actingAs($student)->get(route('courses.intermediate.index'))->assertOk()->assertSee('＋ タスクを発行する');
        $this->get(route('courses.intermediate.create'))->assertOk();
        $other = User::factory()->create();
        $payload = ['phase' => 'implementation', 'title' => 'Self task', 'description' => 'Description', 'assignee_id' => $other->id];
        $this->post(route('courses.intermediate.store'), $payload)->assertSessionHasErrors('assignee_id');
        $this->assertDatabaseMissing('intermediate_tasks', ['title' => 'Self task']);
        $payload['assignee_id'] = $student->id;
        $this->post(route('courses.intermediate.store'), $payload)->assertRedirect();
        $created = IntermediateTask::where('title', 'Self task')->firstOrFail();
        $this->assertSame('assigned', $created->status);
        $this->assertTrue($created->completedUsers->contains($student->id));
        $this->get(route('courses.intermediate.edit_task', $task->id))->assertForbidden();
        $this->put(route('courses.intermediate.update_task', $task->id), ['title' => 'changed'])->assertForbidden();
        $this->delete(route('courses.intermediate.destroy_task', $task->id))->assertForbidden();
        $this->post(route('courses.intermediate.assign_task', $task->id))->assertRedirect();
        $this->post(route('courses.intermediate.complete_task', $task->id))->assertRedirect();
        $this->assertSame('completed', $task->fresh()->status);
    }

    public function test_admins_can_issue_and_manage_tasks_without_finishing_beginner(): void
    {
        foreach (['admin', 'super_admin'] as $role) {
            $actor = User::factory()->create(['role' => $role]);
            $this->actingAs($actor)->get(route('courses.intermediate.create'))->assertOk();
            $this->post(route('courses.intermediate.store'), ['phase' => 'implementation', 'title' => $role, 'description' => 'Description', 'assignee_id' => $actor->id])->assertRedirect();
            $task = IntermediateTask::where('title', $role)->firstOrFail();
            $this->get(route('courses.intermediate.show_task', $task->id))->assertOk();
            $this->get(route('courses.intermediate.edit_task', $task->id))->assertOk();
            $this->put(route('courses.intermediate.update_task', $task->id), ['phase' => 'operation', 'title' => 'Updated', 'description' => 'Updated'])->assertRedirect();
            $this->assertSame('operation', $task->fresh()->phase);
            $this->delete(route('courses.intermediate.destroy_task', $task->id))->assertRedirect();
            $this->assertModelMissing($task);
        }
    }

    public function test_admin_can_assign_any_role_and_only_assignee_can_complete(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->withoutMiddleware(CheckBeginnerCourseCompletion::class);
        foreach (['student', 'admin', 'super_admin'] as $role) {
            $assignee = User::factory()->create(['role' => $role]);
            $this->actingAs($admin)->get(route('courses.intermediate.create'))->assertOk()->assertSee($assignee->email);
            $this->post(route('courses.intermediate.store'), ['phase' => 'implementation', 'title' => $role, 'description' => 'Description', 'assignee_id' => $assignee->id])->assertRedirect();
            $task = IntermediateTask::where('title', $role)->firstOrFail();
            $this->assertSame($admin->id, $task->user_id);
            $this->assertSame('assigned', $task->status);
            $this->assertTrue($task->completedUsers->contains($assignee->id));
            $this->post(route('courses.intermediate.complete_task', $task->id))->assertRedirect();
            $this->assertSame('assigned', $task->fresh()->status);
            $this->actingAs($assignee)->post(route('courses.intermediate.complete_task', $task->id))->assertRedirect();
            $this->assertSame('completed', $task->fresh()->status);
        }
        $this->actingAs($admin)->post(route('courses.intermediate.store'), ['phase' => 'implementation', 'title' => 'Invalid', 'description' => 'Description', 'assignee_id' => 999999])->assertSessionHasErrors('assignee_id');
        $this->assertDatabaseMissing('intermediate_tasks', ['title' => 'Invalid']);
        $student = User::factory()->create();
        $this->actingAs($student)->get(route('courses.intermediate.create'))->assertOk()->assertSee($student->email)->assertDontSee($admin->email);
    }

    public function test_bootstrap_only_promotes_existing_account_and_email_changes_do_not_grant_roles(): void
    {
        $owner = User::factory()->create(['email' => 'test@test.com']);
        $migration = require database_path('migrations/2026_11_07_000001_assign_initial_super_admin.php');
        $migration->up();
        $this->assertTrue($owner->fresh()->isSuperAdmin());
        $owner->email = 'owner@example.com';
        $owner->save();
        $student = User::factory()->create(['email' => 'test@test.com']);
        $this->assertFalse($student->isSuperAdmin());
        $this->actingAs($student)->patch(route('profile.update'), ['name' => $student->name, 'email' => $student->email, 'role' => 'super_admin'])->assertRedirect();
        $this->assertSame('student', $student->fresh()->role);
        $this->actingAs($owner->fresh())->delete(route('profile.destroy'), ['password' => 'password'])->assertSessionHasErrorsIn('userDeletion', 'password');
        $this->assertModelExists($owner);
    }
}
