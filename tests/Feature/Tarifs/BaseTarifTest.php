<?php

namespace Tests\Feature\Tarifs;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseTarifTest extends TestCase
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

    protected function validTarifData(): array
    {
        return [
            'name' => 'Free',
            'amount' => 14.99,
            'max_limit' => 3,
        ];
    }
}
