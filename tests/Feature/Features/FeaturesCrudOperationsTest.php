<?php

namespace Tests\Feature\Features;

use App\Models\Features;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class FeaturesCrudOperationsTest extends BaseFeaturesTest
{
    #[Test]
    public function admin_can_create_feature()
    {
        Sanctum::actingAs($this->admin);
        $response = $this->postJson('/api/features', $this->validFeatureData());

        $response->assertCreated();
        $this->assertDatabaseHas('features', $this->validFeatureData());
    }

    #[Test]
    public function can_retrieve_single_feature()
    {
        $feature = Features::factory()->create(['name' => 'Feature Test']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/features/{$feature->id}");

        $response->assertOk()
            ->assertJsonPath('data.name', 'Feature Test');
    }

    #[Test]
    public function admin_can_update_feature()
    {
        $feature = Features::factory()->create();
        Sanctum::actingAs($this->admin);

        $updateData = ['name' => 'Feature Mise à Jour'];

        $response = $this->putJson("/api/features/{$feature->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('features', $updateData);
    }

    #[Test]
    public function admin_can_delete_feature()
    {
        $feature = Features::factory()->create();
        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson("/api/features/{$feature->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('features', ['id' => $feature->id]);
    }

    #[Test]
    public function can_list_features()
    {
        Features::factory(3)->create();
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/features');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
