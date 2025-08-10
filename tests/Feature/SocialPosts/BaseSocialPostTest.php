<?php

namespace Tests\Feature\SocialPosts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Social;
use App\Enums\StatusEnum;

abstract class BaseSocialPostTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $admin;
    protected $campaign;
    protected $social;
    protected $otherUser;
    protected $otherCampaign;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->otherUser = User::factory()->create(['role' => User::ROLE_USER]);

        $this->campaign = Campaign::factory()->create([
            'user_id' => $this->user->id,
            'status' => StatusEnum::Processing->value,
        ]);

        $this->otherCampaign = Campaign::factory()->create([
            'user_id' => $this->otherUser->id,
            'status' => StatusEnum::Processing->value,
        ]);

        $this->social = Social::factory()->create();
    }

    protected function validSocialPostData($campaignId = null): array
    {
        return [
            'content' => 'Test social post content',
            'is_published' => false,
            'campaign_id' => $campaignId ?? $this->campaign->id,
            'social_id' => $this->social->id,
        ];
    }
}
