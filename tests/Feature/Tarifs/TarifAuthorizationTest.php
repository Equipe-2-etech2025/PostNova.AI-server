<?php

namespace Tests\Feature\Tarifs;

use App\Models\Tarif;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifAuthorizationTest extends BaseTarifTest
{
    #[Test]
    public function only_admin_has_full_access_to_tarif_endpoints()
    {
        $tarif = Tarif::factory()->create();

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/tarifs'],
            ['method' => 'getJson', 'url' => '/api/tarifs/search'],
            ['method' => 'getJson', 'url' => '/api/tarifs/' . $tarif->id],
            ['method' => 'postJson', 'url' => '/api/tarifs', 'data' => $this->validTarifData()],
            ['method' => 'putJson', 'url' => "/api/tarifs/{$tarif->id}", 'data' => $this->validTarifData()],
            ['method' => 'deleteJson', 'url' => "/api/tarifs/{$tarif->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function all_users_can_view_tarifs()
    {
        Tarif::factory()->create();

        Sanctum::actingAs($this->admin);
        $response = $this->getJson('/api/tarifs');
        $response->assertOk();

        Sanctum::actingAs($this->user);
        $response = $this->getJson('/api/tarifs');
        $response->assertOk();
    }

    #[Test]
    public function guest_cannot_access_protected_tarif_endpoints()
    {
        $tarif = Tarif::factory()->create();

        $protectedEndpoints = [
            ['method' => 'postJson', 'url' => '/api/tarifs'],
            ['method' => 'putJson', 'url' => "/api/tarifs/{$tarif->id}"],
            ['method' => 'deleteJson', 'url' => "/api/tarifs/{$tarif->id}"],
        ];

        foreach ($protectedEndpoints as $endpoint) {
            $response = $this->{$endpoint['method']}($endpoint['url']);
            $response->assertUnauthorized();
        }
    }
}
