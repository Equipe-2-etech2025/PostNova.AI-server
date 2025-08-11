<?php

namespace Tests\Feature\TarifUsers;

use App\Models\TarifUser;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifUserCrudOperationsTest extends BaseTarifUserTest
{
    #[Test]
    public function admin_can_create_tarif_user_association()
    {
        Sanctum::actingAs($this->admin);
        $response = $this->postJson('/api/tarif-users', $this->validTarifUserData());

        $response->assertCreated();
        $this->assertDatabaseHas('tarif_users', $this->validTarifUserData());
    }

    #[Test]
    public function can_retrieve_single_tarif_user_association()
    {
        $tarifUser = TarifUser::factory()->create($this->validTarifUserData());
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/tarif-users/{$tarifUser->id}");

        $response->assertOk()
            ->assertJsonPath('data.user_id', $this->user->id)
            ->assertJsonPath('data.tarif_id', $this->tarif->id);
    }

    #[Test]
    public function admin_can_update_tarif_user_expiration()
    {
        $tarifUser = TarifUser::factory()->create();
        Sanctum::actingAs($this->admin);

        $updateData = ['expired_at' => now()->addYear()];

        $response = $this->putJson("/api/tarif-users/{$tarifUser->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('tarif_users', array_merge(
            ['id' => $tarifUser->id],
            $updateData
        ));
    }

    #[Test]
    public function admin_can_delete_tarif_user_association()
    {
        $tarifUser = TarifUser::factory()->create();
        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson("/api/tarif-users/{$tarifUser->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('tarif_users', ['id' => $tarifUser->id]);
    }

    #[Test]
    public function can_list_tarif_user_associations()
    {
        TarifUser::factory(3)->create();
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/tarif-users');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    #[Test]
    public function can_get_latest_tarif_for_user()
    {
        $user = User::factory()->create();

        $activeExpiration = now()->addMonth();
        $active = TarifUser::factory()->create([
            'user_id' => $user->id,
            'expired_at' => $activeExpiration,
            'created_at' => now()
        ]);

        Sanctum::actingAs($user);
        $response = $this->getJson("/api/tarif-users/users/{$user->id}/latest-tarif");

        ($response->json());

        $response->assertOk()
            ->assertJsonPath('data.id', $active->id)
            ->assertJsonPath('data.expired_at', $activeExpiration->format('Y-m-d H:i'));
    }
}
