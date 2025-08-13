<?php

namespace Tests\Feature\TarifFeatures;

use App\Models\Tarif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseTarifFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected $user;

    protected $tarif;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->tarif = Tarif::factory()->create();
    }

    protected function validTarifFeatureData($tarifId = null): array
    {
        return [
            'tarif_id' => $tarifId ?? $this->tarif->id,
            'name' => 'Feature Test',
        ];
    }
}
