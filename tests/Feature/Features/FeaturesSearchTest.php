<?php

namespace Tests\Feature\Features;

use App\Models\Features;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class FeaturesSearchTest extends BaseFeaturesTest
{
    #[Test]
    public function can_search_features_by_name()
    {
        Features::factory()->create(['name' => 'Landing page']);
        Features::factory()->create(['name' => 'Image']);
        Features::factory()->create(['name' => 'Image contenu publicitaire']);

        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/features/search?name=Image');
        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }

    #[Test]
    public function search_returns_empty_when_no_match()
    {
        Features::factory()->create(['name' => 'Premium Feature']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/features/search?name=Standard');
        $response->assertOk()
            ->assertJsonCount(0, 'data');
    }

    #[Test]
    public function can_search_with_case_insensitive()
    {
        Features::factory()->create(['name' => 'FEATURE IMPORTANTE']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/features/search?name=importante');
        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
