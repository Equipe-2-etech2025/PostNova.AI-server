<?php

namespace Tests\Feature\Features;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

abstract class BaseFeaturesTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->user = User::factory()->create(['role' => User::ROLE_USER]);
    }

    protected function validFeatureData(): array
    {
        return [
            'name' => 'Nouvelle Fonctionnalité'
        ];
    }
}
