<?php

namespace Tests\Feature\TarifFeatures;

use App\Models\Tarif;
use App\Models\TarifFeature;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifFeatureSearchTest extends BaseTarifFeatureTest
{
    #[Test]
    public function can_search_tarif_features_by_name()
    {
        TarifFeature::factory()->create(['name' => 'Premium Feature']);
        TarifFeature::factory()->create(['name' => 'Standard Feature']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/tarif-features/search?name=premium');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Premium Feature');
    }

    #[Test]
    public function can_filter_tarif_features_by_tarif_id()
    {
        $tarif2 = Tarif::factory()->create();
        TarifFeature::factory()->create(['tarif_id' => $this->tarif->id]);
        TarifFeature::factory()->create(['tarif_id' => $tarif2->id]);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/tarif-features/search?tarif_id={$this->tarif->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.tarif_id', $this->tarif->id);
    }

    #[Test]
    public function search_returns_empty_when_no_match()
    {
        TarifFeature::factory()->create(['name' => 'Basic Feature']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/tarif-features/search?name=Advanced');
        $response->assertOk()
            ->assertJsonCount(0, 'data');
    }

    #[Test]
    public function can_combine_search_filters()
    {
        TarifFeature::factory()->create([
            'tarif_id' => $this->tarif->id,
            'name' => 'Premium Storage'
        ]);
        TarifFeature::factory()->create([
            'tarif_id' => $this->tarif->id,
            'name' => 'Basic Storage'
        ]);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/tarif-features/search?tarif_id='.$this->tarif->id.'&name=Premium');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Premium Storage');
    }
}
