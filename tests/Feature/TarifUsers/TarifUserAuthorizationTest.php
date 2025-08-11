<?php

namespace Tests\Feature\TarifUsers;

use App\Models\TarifUser;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifUserAuthorizationTest extends BaseTarifUserTest
{
    #[Test]
    public function only_admin_can_manage_tarif_user_associations()
    {
        $tarifUser = TarifUser::factory()->create();

        $endpoints = [
            ['method' => 'getJson', 'url' => '/api/tarif-users'],
            ['method' => 'getJson', 'url' => '/api/tarif-users/'.$tarifUser->id],
            ['method' => 'getJson', 'url' => '/api/tarif-users/search'],
            ['method' => 'postJson', 'url' => '/api/tarif-users', 'data' => $this->validTarifUserData()],
            ['method' => 'putJson', 'url' => "/api/tarif-users/{$tarifUser->id}", 'data' => ['expired_at' => now()->addYear()]],
            ['method' => 'deleteJson', 'url' => "/api/tarif-users/{$tarifUser->id}"],
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->actingAs($this->admin)
                ->{$endpoint['method']}($endpoint['url'], $endpoint['data'] ?? []);
            $response->assertSuccessful();
        }
    }

    #[Test]
    public function user_can_view_own_tarif_associations()
    {
        $tarifUser = TarifUser::factory()->create(['user_id' => $this->user->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/tarif-users/{$tarifUser->id}");
        $response->assertSuccessful();
    }

    #[Test]
    public function user_cannot_view_other_users_tarif_associations()
    {
        $tarifUser = TarifUser::factory()->create(['user_id' => $this->otherUser->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/tarif-users/{$tarifUser->id}");
        $response->assertForbidden();
    }

    #[Test]
    public function user_can_get_own_latest_tarif()
    {
        TarifUser::factory()->create(['user_id' => $this->user->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/tarif-users/users/{$this->user->id}/latest-tarif");
        $response->assertSuccessful();
    }

    #[Test]
    public function user_cannot_get_other_users_latest_tarif()
    {
        Sanctum::actingAs($this->user);
        $response = $this->getJson("/api/tarif-users/users/{$this->otherUser->id}/latest-tarif");
        $response->assertForbidden();
    }
}
