<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\IntermediateTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserProgressTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_teachers_can_view_user_progress(): void
    {
        $student = User::factory()->create();
        $this->get(route('management.users.show', $student))->assertRedirect(route('login'));
        $this->actingAs($student)->get(route('management.users.show', $student))->assertForbidden();
        foreach (['admin', 'super_admin'] as $role) {
            $teacher = User::factory()->create(['role'=>$role]);
            $this->actingAs($teacher)->get(route('management.users'))->assertOk()->assertSee(route('management.users.show', $student));
            $this->get(route('management.users.show', $student))->assertOk()->assertSee('担当タスクはまだありません')->assertViewHas('progress', 0);
        }
    }

    public function test_progress_and_calendar_belong_to_selected_user_not_teacher(): void
    {
        $teacher = User::factory()->create(['role'=>'admin']);
        $student = User::factory()->create();
        $course = DB::table('courses')->insertGetId(['title'=>'Course']);
        $lesson = DB::table('lessons')->insertGetId(['course_id'=>$course,'title'=>'Lesson','sort_order'=>1]);
        $first = DB::table('chapters')->insertGetId(['lesson_id'=>$lesson,'title'=>'Chapter A','sort_order'=>1]);
        $second = DB::table('chapters')->insertGetId(['lesson_id'=>$lesson,'title'=>'Chapter B','sort_order'=>2]);
        DB::table('lessons')->insert(['course_id'=>$course,'title'=>'Empty lesson','sort_order'=>2]);
        $student->chapters()->attach($first, ['completed_at'=>'2024-02-15 12:00:00']);
        $teacher->chapters()->attach($second, ['completed_at'=>'2024-02-16 12:00:00']);
        $student->loginHistories()->create(['login_date'=>'2024-02-15']);
        $teacher->loginHistories()->create(['login_date'=>'2024-02-16']);
        foreach (['assigned', 'completed'] as $status) {
            $task = IntermediateTask::create(['user_id'=>$teacher->id,'title'=>'Student '.$status,'description'=>'Description','phase'=>'implementation','status'=>$status]);
            $task->completedUsers()->attach($student, ['completed_at'=>now()]);
        }
        $other = IntermediateTask::create(['user_id'=>$teacher->id,'title'=>'Teacher private task','description'=>'Description','phase'=>'implementation','status'=>'completed']);
        $other->completedUsers()->attach($teacher, ['completed_at'=>now()]);
        $this->actingAs($teacher)->get(route('management.users.show', ['user'=>$student, 'month'=>'2024-02']))
            ->assertOk()->assertViewHas('completedCount',1)->assertViewHas('completedLessons',0)->assertViewHas('progress',50.0)
            ->assertViewHas('activeTasks',1)->assertViewHas('completedTasks',1)
            ->assertViewHas('nextChapter',fn($chapter)=>$chapter->id===$second)
            ->assertSee('Student assigned')->assertSee('Student completed')->assertDontSee('Teacher private task')
            ->assertSee('2月15日 ログインあり')->assertSee('2月16日 ログイン記録なし');
        $student->chapters()->attach($second, ['completed_at'=>now()]);
        $this->get(route('management.users.show',$student))->assertOk()->assertViewHas('progress',100.0)->assertViewHas('completedLessons',1)->assertSee('初級の全Chapterが完了しています');
    }
}
