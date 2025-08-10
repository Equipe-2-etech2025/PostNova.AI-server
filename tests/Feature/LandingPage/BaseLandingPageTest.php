<?php

namespace Tests\Feature\LandingPage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;
use App\Models\Campaign;
use App\Enums\StatusEnum;

abstract class BaseLandingPageTest extends TestCase
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

    protected function validLandingPageData($campaignId = null): array
    {
        return [
            'path' => 'test/path/landing-page',
            'content' => ['key' => 'value'],
            'is_published' => false,
            'campaign_id' => $campaignId ?? $this->campaign->id,
        ];
    }
}
