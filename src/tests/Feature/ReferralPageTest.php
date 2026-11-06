<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReferralPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_can_view_campaign_and_reward_diagram_without_portal_guidance(): void
    {
        $this->get(route('referral'))->assertOk()
            ->assertSee('紹介から謝礼までの流れ。')
            ->assertSee('<figure class="referral-flow-image">', false)
            ->assertSee('images/referral/referral-reward-flow.jpg')
            ->assertDontSee('SunPortal')
            ->assertDontSee('紹介コード')
            ->assertDontSee('portal.sunsuntech.com')
            ->assertDontSee('ご紹介の前に')
            ->assertSee('images/referral/referral-site-header.jpg')
            ->assertDontSee('data-referral-float');
    }

    public function test_members_see_campaign_with_member_header_and_no_floating_banner(): void
    {
        $this->actingAs(User::factory()->create())->get(route('referral'))->assertOk()
            ->assertSee('member-header')->assertSee('最大50,000円')->assertDontSee('data-referral-float');
    }

    public function test_banner_appears_on_home_and_dashboard_but_not_profile_or_login(): void
    {
        $this->get('/')->assertOk()->assertSee('data-referral-float')->assertSee(route('referral'));
        $this->get(route('login'))->assertOk()->assertDontSee('data-referral-float');
        $this->actingAs(User::factory()->create());
        $this->get(route('dashboard'))->assertOk()->assertSee('data-referral-close');
        $this->get(route('profile.edit'))->assertOk()->assertDontSee('data-referral-float');
    }
}
