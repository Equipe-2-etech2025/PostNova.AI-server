<?php

namespace Tests\Feature\Campaigns;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\TypeCampaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseCampaignTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $admin;

    protected $otherUser;

    protected $typeCampaign;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->otherUser = User::factory()->create(['role' => User::ROLE_USER]);

        $this->typeCampaign = TypeCampaign::factory()->create();
    }

    protected function validCampaignData($userId = null, $typeCampaignId = null): array
    {
        return [
            'name' => 'Test Campaign',
            'status' => StatusEnum::Created->value,
            'description' => 'This is a test campaign description',
            'user_id' => $userId ?? $this->user->id,
            'type_campaign_id' => $typeCampaignId ?? $this->typeCampaign->id,
        ];
    }

    protected function createCampaignForUser(User $user, array $overrides = [])
    {
        $defaults = [
            'user_id' => $user->id,
        ];

        return Campaign::factory()->create(array_merge($defaults, $overrides));
    }
}
