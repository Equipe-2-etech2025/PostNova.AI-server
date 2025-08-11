<?php

namespace Tests\Feature\TypeCampaigns;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseTypeCampaignTest extends TestCase
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

    protected function validTypeCampaignData(): array
    {
        return [
            'name' => 'Nouveau Type',
        ];
    }
}
