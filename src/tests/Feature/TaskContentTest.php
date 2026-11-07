<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\IntermediateTask;
use App\Support\TaskMarkdown;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TaskContentTest extends TestCase
{
    use RefreshDatabase;

    private function image(string $name): UploadedFile
    {
        return UploadedFile::fake()->createWithContent($name, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII='));
    }

    public function test_images_and_formatted_content_survive_create_edit_and_delete(): void
    {
        Storage::fake('public');
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $payload = ['title' => 'Images', 'phase' => 'implementation', 'description' => "**太字**\n\n```php\necho 'hello';\n```", 'description_format' => 'markdown', 'assignee_id' => $user->id];
        $this->post(route('courses.intermediate.store'), $payload + ['images' => [$this->image('a.png'), $this->image('b.png')]])->assertSessionHasNoErrors()->assertRedirect();
        $task = IntermediateTask::firstOrFail();
        $paths = $task->attachmentPaths();
        $this->assertCount(2, $paths);
        Storage::disk('public')->assertExists($paths);
        $this->get(route('courses.intermediate.show_task', $task->id))->assertOk()->assertSee('<strong>太字</strong>', false)->assertSee('language-php')->assertSee($paths[0])->assertSee($paths[1]);
        $this->get(route('courses.intermediate.edit_task', $task->id))->assertOk()->assertSee('remove_images[]', false);
        $this->get(route('courses.intermediate.phase', 'implementation'))->assertOk()->assertSee('Images')->assertSee('担当中')->assertSee('あなたの担当')->assertSee('画像 2枚')->assertDontSee('**太字**')->assertSee($user->name);
        $this->get(route('courses.intermediate.phase', 'operation'))->assertOk()->assertSee('このフェーズのタスクはまだありません');
        $this->put(route('courses.intermediate.update_task', $task->id), $payload + ['remove_images' => [$paths[0]], 'images' => [$this->image('c.png')]])->assertSessionHasNoErrors()->assertRedirect();
        $updated = $task->fresh()->attachmentPaths();
        $this->assertCount(2, $updated);
        $this->assertSame($paths[1], $updated[0]);
        Storage::disk('public')->assertMissing($paths[0]);
        Storage::disk('public')->assertExists($updated);
        $this->put(route('courses.intermediate.update_task', $task->id), $payload + ['remove_images' => ['someone-elses.png']])->assertSessionHasErrors('remove_images.0');
        $this->delete(route('courses.intermediate.destroy_task', $task->id))->assertRedirect();
        Storage::disk('public')->assertMissing($updated);
    }

    public function test_upload_validation_and_safe_preview(): void
    {
        Storage::fake('public');
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $payload = ['title' => 'Invalid', 'phase' => 'implementation', 'description' => 'text', 'assignee_id' => $user->id];
        $this->post(route('courses.intermediate.store'), $payload + ['images' => array_map(fn ($i) => $this->image("$i.png"), range(1,11))])->assertSessionHasErrors('images');
        $this->post(route('courses.intermediate.store'), $payload + ['images' => [UploadedFile::fake()->create('unsafe.svg', 1, 'image/svg+xml')]])->assertSessionHasErrors('images.0');
        $this->assertDatabaseCount('intermediate_tasks', 0);
        $response = $this->postJson(route('courses.intermediate.preview'), ['description' => '**bold** <script>alert(1)</script> [bad](javascript:alert(1))']);
        $response->assertOk();
        $this->assertStringContainsString('<strong>bold</strong>', $response->json('html'));
        $this->assertStringNotContainsString('<script>', $response->json('html'));
        $this->assertStringNotContainsString('href="javascript:', $response->json('html'));
    }

    public function test_legacy_image_and_plain_text_remain_supported(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $task = IntermediateTask::create(['user_id' => $user->id, 'title' => 'Legacy', 'phase' => 'implementation', 'description' => '**literal** <script>bad</script>', 'image_path' => 'legacy.png']);
        $this->assertSame(['legacy.png'], $task->attachmentPaths());
        $this->actingAs($user)->get(route('courses.intermediate.show_task', $task->id))->assertOk()->assertSee('**literal**')->assertDontSee('<script>bad</script>', false)->assertSee('legacy.png');
    }
}
