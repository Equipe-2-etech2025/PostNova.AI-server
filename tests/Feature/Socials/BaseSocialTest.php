<?php

namespace Tests\Feature\Socials;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseSocialTest extends TestCase
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

    protected function validSocialData(): array
    {
        return [
            'name' => 'Nouveau Réseau Social',
        ];
    }
}
