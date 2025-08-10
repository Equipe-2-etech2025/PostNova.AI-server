<?php

namespace Tests\Feature\Tarifs;

use App\Models\Tarif;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifCrudOperationsTest extends BaseTarifTest
{
    #[Test]
    public function admin_can_create_tarif()
    {
        Sanctum::actingAs($this->admin);
        $response = $this->postJson('/api/tarifs', $this->validTarifData());

        $response->assertCreated();
        $this->assertDatabaseHas('tarifs', $this->validTarifData());
    }

    #[Test]
    public function can_retrieve_single_tarif()
    {
        $tarif = Tarif::factory()->create($this->validTarifData());
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/tarifs/{$tarif->id}");

        $response->assertOk()
            ->assertJsonPath('data.name', 'Free')
            ->assertJsonPath('data.amount', 14.99);
    }

    #[Test]
    public function admin_can_update_tarif()
    {
        $tarif = Tarif::factory()->create();
        Sanctum::actingAs($this->admin);

        $updateData = [
            'name' => 'X',
            'amount' => 14.99,
            'max_limit' => 3
        ];

        $response = $this->putJson("/api/tarifs/{$tarif->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('tarifs', $updateData);
    }

    #[Test]
    public function admin_can_update_tarif_with_valid_data()
    {
        $tarif = Tarif::factory()->create();
        Sanctum::actingAs($this->admin);

        $updateData = [
            'name' => 'Nom plus de 10 caractères',
            'amount' => 19.99,
            'max_limit' => 12
        ];

        $response = $this->putJson("/api/tarifs/{$tarif->id}", $updateData);

        $response->assertUnprocessable();
    }

    #[Test]
    public function admin_can_delete_tarif()
    {
        $tarif = Tarif::factory()->create();
        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson("/api/tarifs/{$tarif->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('tarifs', ['id' => $tarif->id]);
    }

    #[Test]
    public function can_list_tarifs()
    {
        Tarif::factory(3)->create();
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/tarifs');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
