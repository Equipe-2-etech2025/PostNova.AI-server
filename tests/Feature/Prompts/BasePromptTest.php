<?php

namespace Tests\Feature\Prompts;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BasePromptTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $admin;

    protected $campaign;

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
    }

    protected function validPromptData($campaignId = null): array
    {
        return [
            'content' => 'Test prompt content',
            'campaign_id' => $campaignId ?? $this->campaign->id,
        ];
    }
}
