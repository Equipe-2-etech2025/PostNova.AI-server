<?php

namespace Tests\Feature\Auth\Campaigns;

use App\Models\Campaign;
use App\Models\TypeCampaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CampaignEndpointsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $admin;
    protected $typeCampaign;

    protected function setUp(): void
    {
        parent::setUp();

        $this->typeCampaign = TypeCampaign::factory()->create();
        $this->user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    }

    #[Test]
    public function test_filter_campaigns_by_type()
    {
        $otherType = TypeCampaign::factory()->create();

        Campaign::factory()->create([
            'type_campaign_id' => $this->typeCampaign->id,
            'user_id' => $this->user->id
        ]);

        Campaign::factory()->create([
            'type_campaign_id' => $otherType->id,
            'user_id' => $this->user->id
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/campaigns/type/{$this->typeCampaign->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
