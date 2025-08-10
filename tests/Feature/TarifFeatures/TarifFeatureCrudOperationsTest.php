<?php

namespace Tests\Feature\TarifFeatures;

use App\Models\TarifFeature;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifFeatureCrudOperationsTest extends BaseTarifFeatureTest
{
    #[Test]
    public function admin_can_create_tarif_feature()
    {
        Sanctum::actingAs($this->admin);
        $response = $this->postJson('/api/tarif-features', $this->validTarifFeatureData());

        $response->assertCreated();
        $this->assertDatabaseHas('tarif_features', $this->validTarifFeatureData());
    }

    #[Test]
    public function can_retrieve_single_tarif_feature()
    {
        $feature = TarifFeature::factory()->create($this->validTarifFeatureData());
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/tarif-features/{$feature->id}");

        $response->assertOk()
            ->assertJsonPath('data.name', 'Feature Test')
            ->assertJsonPath('data.tarif_id', $this->tarif->id);
    }

    #[Test]
    public function admin_can_update_tarif_feature()
    {
        $feature = TarifFeature::factory()->create();
        Sanctum::actingAs($this->admin);

        $updateData = ['name' => 'Feature AXC'];

        $response = $this->putJson("/api/tarif-features/{$feature->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('tarif_features', [
            'id' => $feature->id,
            'name' => 'Feature AXC'
        ]);
    }

    #[Test]
    public function admin_can_delete_tarif_feature()
    {
        $feature = TarifFeature::factory()->create();
        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson("/api/tarif-features/{$feature->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('tarif_features', ['id' => $feature->id]);
    }

    #[Test]
    public function can_list_tarif_features()
    {
        TarifFeature::factory(3)->create(['tarif_id' => $this->tarif->id]);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/tarif-features');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
