<?php

namespace Tests\Feature\TarifUsers;

use App\Models\TarifUser;
use Carbon\Carbon;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class TarifUserSearchTest extends BaseTarifUserTest
{
    #[Test]
    public function can_filter_tarif_users_by_user()
    {
        TarifUser::factory()->create(['user_id' => $this->user->id]);
        TarifUser::factory()->create(['user_id' => $this->otherUser->id]);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/tarif-users/search?user_id={$this->user->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.user_id', $this->user->id);
    }

    #[Test]
    public function can_filter_tarif_users_by_tarif()
    {
        TarifUser::factory()->create(['tarif_id' => $this->tarif->id]);
        TarifUser::factory()->create(['tarif_id' => $this->expiredTarif->id]);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/tarif-users/search?tarif_id={$this->tarif->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.tarif_id', $this->tarif->id);
    }

    #[Test]
    public function can_combine_multiple_search_filters()
    {
        TarifUser::factory()->create([
            'user_id' => $this->user->id,
            'tarif_id' => $this->tarif->id,
            'expired_at' => Carbon::now()->addMonth(),
        ]);

        TarifUser::factory()->create([
            'user_id' => $this->otherUser->id,
            'tarif_id' => $this->expiredTarif->id,
            'expired_at' => Carbon::now()->subMonth(),
        ]);

        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/tarif-users/search?user_id={$this->user->id}&tarif_id={$this->tarif->id}");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.user_id', $this->user->id);
    }
}
