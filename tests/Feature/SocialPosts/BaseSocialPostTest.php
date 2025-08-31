<?php

namespace Tests\Feature\SocialPosts;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\Social;
use App\Models\User;
use App\Models\Prompt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseSocialPostTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $admin;
    protected $campaign;
    protected $social;
    protected $otherUser;
    protected $otherCampaign;
    private $prompt;

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
        $this->prompt = Prompt::factory()->create([
            'content' => 'Test prompt content',
            'campaign_id' => $this->campaign->id,
        ]);
    }

    protected function validSocialPostData($campaignId = null): array
    {
        return [
            'content' => 'Test social post content',
            'is_published' => false,
            'campaign_id' => $campaignId ?? $this->campaign->id,
            'social_id' => $this->social->id,
            'prompt_id' =>$this->prompt->id
        ];
    }
}
