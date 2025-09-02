<?php

namespace Tests\Feature\Images;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseImageTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $admin;

    protected $campaign;

    protected $otherUser;

    protected $otherCampaign;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->otherUser = User::factory()->create(['role' => User::ROLE_USER]);

        $this->campaign = Campaign::factory()->create([
            'user_id' => $this->user->id,
            'status' => StatusEnum::Processing->value,
        ]);

        $this->otherCampaign = Campaign::factory()->create([
            'user_id' => $this->otherUser->id,
            'status' => StatusEnum::Processing->value,
        ]);
    }

    protected function validImageData($campaignId = null): array
    {
        return [
            'path' => 'test/path/image.jpg',
            'is_published' => false,
            'campaign_id' => $campaignId ?? $this->campaign->id,
        ];
    }
}
