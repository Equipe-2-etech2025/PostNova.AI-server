<?php

namespace Tests\Feature\TypeCampaigns;

use App\Models\TypeCampaign;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TypeCampaignCrudOperationsTest extends BaseTypeCampaignTest
{
    #[Test]
    public function admin_can_create_type_campaign()
    {
        Sanctum::actingAs($this->admin);
        $response = $this->postJson('/api/type-campaigns', $this->validTypeCampaignData());

        $response->assertCreated();
        $this->assertDatabaseHas('type_campaigns', $this->validTypeCampaignData());
    }

    #[Test]
    public function can_retrieve_single_type_campaign()
    {
        $type = TypeCampaign::factory()->create(['name' => 'Type Spécial']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/type-campaigns/{$type->id}");

        $response->assertOk()
            ->assertJsonPath('data.name', 'Type Spécial');
    }

    #[Test]
    public function admin_can_update_type_campaign()
    {
        $type = TypeCampaign::factory()->create();
        Sanctum::actingAs($this->admin);

        $updateData = ['name' => 'Type Mis à Jour'];

        $response = $this->putJson("/api/type-campaigns/{$type->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('type_campaigns', array_merge(
            ['id' => $type->id],
            $updateData
        ));
    }

    #[Test]
    public function admin_can_delete_type_campaign()
    {
        $type = TypeCampaign::factory()->create();
        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson("/api/type-campaigns/{$type->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('type_campaigns', ['id' => $type->id]);
    }

    #[Test]
    public function can_list_type_campaigns()
    {
        TypeCampaign::factory(3)->create();
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/type-campaigns');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
