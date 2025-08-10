<?php

namespace Tests\Feature\TypeCampaigns;

use App\Models\TypeCampaign;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TypeCampaignSearchTest extends BaseTypeCampaignTest
{
    #[Test]
    public function can_search_type_campaigns_by_name()
    {
        TypeCampaign::factory()->create(['name' => 'Type Premium']);
        TypeCampaign::factory()->create(['name' => 'Type Standard']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/type-campaigns/search?name=Premium');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Type Premium');
    }

    #[Test]
    public function search_is_case_insensitive()
    {
        TypeCampaign::factory()->create(['name' => 'TYPE SPECIAL']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/type-campaigns/search?name=special');
        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }

    #[Test]
    public function returns_empty_when_no_match()
    {
        TypeCampaign::factory()->create(['name' => 'Type A']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/type-campaigns/search?name=TypeB');
        $response->assertOk()
            ->assertJsonCount(0, 'data');
    }
}
