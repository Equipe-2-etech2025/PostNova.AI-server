<?php

namespace Tests\Feature\TarifUsers;

use App\Models\Tarif;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseTarifUserTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected $user;

    protected $otherUser;

    protected $tarif;

    protected $expiredTarif;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->otherUser = User::factory()->create(['role' => User::ROLE_USER]);

        $this->tarif = Tarif::factory()->create(['name' => 'Premium']);
        $this->expiredTarif = Tarif::factory()->create(['name' => 'Expired']);

        Carbon::setTestNow(now());
    }

    protected function validTarifUserData($userId = null, $tarifId = null): array
    {
        return [
            'user_id' => $userId ?? $this->user->id,
            'tarif_id' => $tarifId ?? $this->tarif->id,
            'expired_at' => now()->addMonth(),
        ];
    }
}
