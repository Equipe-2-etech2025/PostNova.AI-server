<?php

namespace Tests\Feature\Tarifs;

use App\Models\Tarif;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifSearchTest extends BaseTarifTest
{
    #[Test]
    public function can_search_tarifs_by_name()
    {
        Tarif::factory()->create(['name' => 'Tarif Basique']);
        Tarif::factory()->create(['name' => 'Tarif Premium']);
        Tarif::factory()->create(['name' => 'Offre Spéciale']);

        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/tarifs/search?name=Premium');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Tarif Premium');
    }

    #[Test]
    public function can_combine_multiple_search_filters()
    {
        Tarif::factory()->create([
            'name' => 'Pro',
            'amount' => 14.99,
            'max_limit' => 30
        ]);

        Tarif::factory()->create([
            'name' => 'Free',
            'amount' => 0,
            'max_limit' => 3
        ]);

        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/tarifs/search?name=Pro&amount=14.99');
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Pro');
    }
}
