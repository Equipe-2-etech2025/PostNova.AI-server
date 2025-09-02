<?php

namespace Tests\Feature\Features;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
            'name' => 'Nouvelle Fonctionnalité',
        ];
    }
}
