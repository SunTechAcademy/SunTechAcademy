<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\IntermediateTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelatedTasksTest extends TestCase
{
    use RefreshDatabase;

    private function task(User $user, string $title): IntermediateTask
    {
        return IntermediateTask::create(['user_id'=>$user->id,'title'=>$title,'phase'=>'implementation','description'=>'Description','status'=>'incomplete']);
    }

    public function test_multiple_links_are_bidirectional_and_can_be_removed_from_either_side(): void
    {
        $admin=User::factory()->create(['role'=>'admin']);
        $b=$this->task($admin,'B'); $c=$this->task($admin,'C'); $d=$this->task($admin,'D');
        $b->syncRelatedTasks([$d->id]);
        $payload=['title'=>'A','phase'=>'implementation','description'=>'Description','assignee_id'=>$admin->id,'related_task_ids'=>[$b->id,$c->id]];
        $this->actingAs($admin)->post(route('courses.intermediate.store'),$payload)->assertSessionHasNoErrors()->assertRedirect();
        $a=IntermediateTask::where('title','A')->firstOrFail();
        $this->assertEqualsCanonicalizing([$b->id,$c->id],$a->relatedTasks()->pluck('id')->all());
        $this->assertEqualsCanonicalizing([$a->id,$d->id],$b->relatedTasks()->pluck('id')->all());
        $this->get(route('courses.intermediate.show_task',$b->id))->assertOk()->assertSee(route('courses.intermediate.show_task',$a->id));
        $this->get(route('courses.intermediate.edit_task',$a->id))->assertOk()->assertViewHas('selectedRelated',fn($ids)=>count($ids)===2);
        $this->put(route('courses.intermediate.update_task',$b->id),['title'=>'B','phase'=>'implementation','description'=>'Description','related_task_ids'=>[$d->id]])->assertSessionHasNoErrors()->assertRedirect();
        $this->assertSame([$c->id],$a->relatedTasks()->pluck('id')->all());
        $this->assertSame([$d->id],$b->relatedTasks()->pluck('id')->all());
        $this->delete(route('courses.intermediate.destroy_task',$a->id))->assertRedirect();
        $this->assertModelExists($c);
        $this->assertSame(0,$c->relatedTasks()->count());
    }

    public function test_invalid_self_and_duplicate_links_are_rejected_and_student_cannot_edit(): void
    {
        $admin=User::factory()->create(['role'=>'admin']); $a=$this->task($admin,'A'); $b=$this->task($admin,'B');
        $base=['title'=>'A','phase'=>'implementation','description'=>'Description'];
        $this->actingAs($admin)->put(route('courses.intermediate.update_task',$a->id),$base+['related_task_ids'=>[$a->id]])->assertSessionHasErrors('related_task_ids.0');
        $this->put(route('courses.intermediate.update_task',$a->id),$base+['related_task_ids'=>[999999]])->assertSessionHasErrors('related_task_ids.0');
        $this->put(route('courses.intermediate.update_task',$a->id),$base+['related_task_ids'=>[$b->id,$b->id]])->assertSessionHasErrors('related_task_ids.0');
        $a->syncRelatedTasks([$b->id]); $b->syncRelatedTasks([$a->id]);
        $this->assertDatabaseCount('intermediate_task_links',1);
        $this->withoutMiddleware(\App\Http\Middleware\CheckBeginnerCourseCompletion::class)->actingAs(User::factory()->create())->put(route('courses.intermediate.update_task',$a->id),$base)->assertForbidden();
        $this->assertDatabaseCount('intermediate_task_links',1);
        $this->actingAs($admin)->put(route('courses.intermediate.update_task',$a->id),$base)->assertRedirect();
        $this->assertDatabaseCount('intermediate_task_links',0);
    }
}
