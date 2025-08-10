<?php

namespace Tests\Feature\Auth\Campaigns;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\TypeCampaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CampaignUserAccessTest extends TestCase
{
    use RefreshDatabase;

    protected TypeCampaign $typeCampaign;

    protected function setUp(): void
    {
        parent::setUp();

        $this->typeCampaign = TypeCampaign::factory()->create();
        $this->user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    }

    private function createUserWithRole(string $role = User::ROLE_USER): User
    {
        return User::factory()->create(['role' => $role]);
    }

    private function validCampaignData(): array
    {
        return [
            'name' => 'Test Campaign',
            'description' => 'Test Description',
            'type_campaign_id' => $this->typeCampaign->id,
            'status' => StatusEnum::Processing->value,
        ];
    }

    #[Test]
    public function user_can_access_and_manage_only_own_campaigns()
    {
        $user = $this->createUserWithRole(User::ROLE_USER);
        $otherUser = $this->createUserWithRole(User::ROLE_USER);

        $userCampaign = Campaign::factory()->create([
            'user_id' => $user->id,
            'status' => StatusEnum::Processing->value,
            'type_campaign_id' => $this->typeCampaign->id,
        ]);

        $otherCampaign = Campaign::factory()->create([
            'user_id' => $otherUser->id,
            'status' => StatusEnum::Processing->value,
            'type_campaign_id' => $this->typeCampaign->id,
        ]);

        Sanctum::actingAs($user, ['*']);

        $this->getJson("/api/campaigns/{$userCampaign->id}")->assertOk();
        $this->postJson("/api/campaigns", array_merge($this->validCampaignData(), ['user_id' => $user->id]))
            ->assertCreated();
        $this->putJson("/api/campaigns/{$userCampaign->id}", [
            'name' => 'Updated Name',
            'status' => StatusEnum::Completed->value,
        ])->assertOk();

        $this->deleteJson("/api/campaigns/{$userCampaign->id}")->assertOk();

        $this->getJson("/api/campaigns/user/{$user->id}")
            ->assertOk()
            ->assertJsonCount(1, 'data');

        $response = $this->getJson('/api/campaigns');
        $response->assertOk();

        $campaigns = $response->json('data');

        foreach ($campaigns as $campaign) {
            $this->assertEquals(auth()->id(), $userCampaign->user_id);
        }

        $this->getJson("/api/campaigns/{$otherCampaign->id}")->assertForbidden();

        $this->putJson("/api/campaigns/{$otherCampaign->id}", [
            'name' => 'Hacking attempt',
        ])->assertForbidden();

        $this->deleteJson("/api/campaigns/{$otherCampaign->id}")->assertForbidden();
    }

    #[Test]
    public function test_user_can_only_access_own_campaigns_via_user_endpoint()
    {
        $otherUser = User::factory()->create();

        Campaign::factory()->create(['user_id' => $this->user->id]);
        Campaign::factory()->create(['user_id' => $otherUser->id]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/campaigns/user/{$this->user->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
