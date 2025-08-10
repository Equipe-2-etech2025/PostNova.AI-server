<?php

namespace Tests\Feature\Auth\Campaigns;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\TypeCampaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CampaignAdminAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->typeCampaign = TypeCampaign::factory()->create();
    }

    private function createUserWithRole(string $role): User
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
    public function admin_can_access_all_campaign_routes()
    {
        $admin = $this->createUserWithRole(User::ROLE_ADMIN);
        $campaign = Campaign::factory()->create([
            'status' => StatusEnum::Processing->value,
            'type_campaign_id' => $this->typeCampaign->id
        ]);

        $routes = [
            ['method' => 'getJson', 'url' => '/api/campaigns'],
            ['method' => 'postJson', 'url' => '/api/campaigns', 'data' => $this->validCampaignData()],
            ['method' => 'getJson', 'url' => "/api/campaigns/{$campaign->id}"],
            ['method' => 'putJson', 'url' => "/api/campaigns/{$campaign->id}", 'data' => [
                'name' => 'Updated',
                'status' => StatusEnum::Completed->value,
                'type_campaign_id' => $this->typeCampaign->id
            ]],
            ['method' => 'deleteJson', 'url' => "/api/campaigns/{$campaign->id}"],
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($admin)
                ->{$route['method']}(
                    $route['url'],
                    $route['data'] ?? []
                );

            $response->assertSuccessful();
        }
    }

}
