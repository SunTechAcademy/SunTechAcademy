<?php
namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use App\Models\IntermediateTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    private function operator(): Admin
    {
        return Admin::create(['name'=>'Operator','email'=>'operator@example.com','password'=>Hash::make('password')]);
    }

    public function test_search_roles_and_delete_require_admin_guard(): void
    {
        $student = User::factory()->create(['name'=>'対象受講生']);
        $this->get(route('admin.users.index'))->assertRedirect(route('admin.login'));
        $this->actingAs(User::factory()->create(['role'=>'super_admin']), 'web')->delete(route('admin.users.destroy',$student),['confirm_delete'=>1])->assertRedirect(route('admin.login'));
        $this->actingAs($this->operator(),'admin')->get(route('admin.users.index',['search'=>'対象受講生','role'=>'student']))->assertOk()->assertSee($student->email)->assertViewHas('users',fn($users)=>$users->total()===1);
        $this->get(route('admin.users.index',['role'=>'admin']))->assertOk()->assertSee('該当するユーザーがいません');
        $this->get(route('admin.users.delete',$student))->assertOk()->assertSee($student->email)->assertSee('元に戻せない');
        $this->delete(route('admin.users.destroy',$student))->assertSessionHasErrors('confirm_delete');
        $this->assertModelExists($student);
        $owner = User::factory()->create(['role'=>'super_admin']);
        $this->delete(route('admin.users.destroy',$owner),['confirm_delete'=>1])->assertSessionHasErrors('confirm_delete');
        $this->assertModelExists($owner);
    }

    public function test_deletion_preserves_tasks_and_other_students_history(): void
    {
        $departing = User::factory()->create();
        $other = User::factory()->create();
        $departing->loginHistories()->create(['login_date'=>'2026-11-01']);
        DB::table('password_reset_tokens')->insert(['email'=>$departing->email,'token'=>'old-token','created_at'=>now()]);
        $course = DB::table('courses')->insertGetId(['title'=>'Course']);
        $lesson = DB::table('lessons')->insertGetId(['course_id'=>$course,'title'=>'Lesson','sort_order'=>1]);
        $chapter = DB::table('chapters')->insertGetId(['lesson_id'=>$lesson,'title'=>'Chapter','sort_order'=>1]);
        $departing->chapters()->attach($chapter,['completed_at'=>now()]);
        $other->chapters()->attach($chapter,['completed_at'=>now()]);
        $assigned = IntermediateTask::create(['user_id'=>$departing->id,'phase'=>'implementation','title'=>'Keep task','description'=>'Keep description','status'=>'assigned','image_path'=>'keep.png']);
        $assigned->completedUsers()->attach($departing);
        $completed = IntermediateTask::create(['user_id'=>$departing->id,'phase'=>'operation','title'=>'Keep completed','description'=>'Keep description','status'=>'completed']);
        $completed->completedUsers()->attach([$departing->id,$other->id]);
        $this->actingAs($this->operator(),'admin')->delete(route('admin.users.destroy',$departing),['confirm_delete'=>1])->assertRedirect(route('admin.users.index'))->assertSessionHas('success');
        $this->assertModelMissing($departing);
        $this->assertNull($assigned->fresh()->user_id);
        $this->assertSame('incomplete',$assigned->fresh()->status);
        $this->assertSame('keep.png',$assigned->fresh()->image_path);
        $this->assertSame('completed',$completed->fresh()->status);
        $this->assertTrue($completed->fresh()->completedUsers->contains($other->id));
        $this->assertDatabaseMissing('chapter_user',['user_id'=>$departing->id]);
        $this->assertDatabaseHas('chapter_user',['user_id'=>$other->id]);
        $this->assertDatabaseMissing('login_histories',['user_id'=>$departing->id]);
        $this->assertDatabaseMissing('password_reset_tokens',['email'=>$departing->email]);
        $this->assertDatabaseMissing('intermediate_task_user',['user_id'=>$departing->id]);
    }
}
