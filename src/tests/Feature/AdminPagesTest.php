<?php
namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): Admin
    {
        return Admin::create(['name'=>'運営管理者','email'=>'operations@example.com','password'=>Hash::make('password')]);
    }

    public function test_admin_login_uses_modern_layout_and_admin_guard(): void
    {
        $admin = $this->admin();
        $this->get(route('admin.login'))->assertOk()->assertSee('管理者ログイン')->assertSee('学びの一歩を、')->assertSee('autocomplete="current-password"',false);
        $this->post(route('admin.login'), ['email'=>$admin->email,'password'=>'wrong'])->assertSessionHasErrors('email');
        $this->assertGuest('admin');
        $this->post(route('admin.login'), ['email'=>$admin->email,'password'=>'password'])->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin,'admin');
        $this->assertGuest('web');
        $this->get(route('admin.dashboard'))->assertOk()->assertSee('運営管理者')->assertSee('新規アカウントを発行')->assertSee(route('admin.logout'))->assertDontSee('href="'.route('dashboard').'"',false);
        $this->post(route('admin.logout'))->assertRedirect(route('admin.login'));
        $this->assertGuest('admin');
    }

    public function test_operator_can_create_student_and_returns_to_dashboard(): void
    {
        $admin=$this->admin();
        $this->actingAs($admin,'admin')->get(route('register'))->assertOk()->assertSee('受講生のアカウント情報');
        $this->post(route('register'),['name'=>'新しい受講生','email'=>'new@example.com','password'=>'password','password_confirmation'=>'password','role'=>'super_admin'])->assertRedirect(route('admin.dashboard'))->assertSessionHas('success');
        $this->assertDatabaseHas('users',['email'=>'new@example.com','role'=>'student']);
        $this->get(route('admin.dashboard'))->assertOk()->assertViewHas('totalUsers',1)->assertViewHas('studentCount',1)->assertViewHas('instructorCount',0)->assertSee('アカウントを発行しました');
        $this->post(route('register'),['name'=>'重複','email'=>'new@example.com','password'=>'password','password_confirmation'=>'password'])->assertSessionHasErrors('email');
        $this->assertDatabaseCount('users',1);
    }

    public function test_regular_users_cannot_enter_operator_dashboard_or_issue_accounts(): void
    {
        $this->actingAs(User::factory()->create(['role'=>'admin']))->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
        $this->get(route('register'))->assertRedirect();
        $this->post(route('register'),[])->assertRedirect();
    }
}
