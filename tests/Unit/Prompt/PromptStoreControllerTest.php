<?php

namespace Tests\Unit\Prompt;

use App\Models\Campaign;
use App\Models\User;
use App\Services\Interfaces\PromptServiceInterface;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class PromptStoreControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_prompt_store_returns_error_when_quota_reached()
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create();

        $tarifUserMock = (object) [
            'tarif' => (object) [
                'max_limit' => 2,
            ],
        ];

        $tarifUserService = Mockery::mock(TarifUserServiceInterface::class);
        $tarifUserService->shouldReceive('getLatestByUserId')
            ->withArgs([$user->id])
            ->andReturn($tarifUserMock);

        $promptService = Mockery::mock(PromptServiceInterface::class);
        $promptService->shouldReceive('countTodayPromptsByUser')
            ->withArgs([$user->id])
            ->andReturn(3);

        $this->app->instance(TarifUserServiceInterface::class, $tarifUserService);
        $this->app->instance(PromptServiceInterface::class, $promptService);

        $response = $this->actingAs($user)->postJson('/api/prompts', [
            'campaign_id' => $campaign->id,
            'content' => 'Test prompt content',
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'status' => 'error',
                'type' => 'quota_exceeded',
                'quota_used' => 3,
                'quota_max' => 2,
            ]);
    }

    public function test_prompt_store_returns_error_when_no_tarif_found()
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create();

        $tarifUserService = Mockery::mock(TarifUserServiceInterface::class);
        $tarifUserService->shouldReceive('getLatestByUserId')
            ->withArgs([$user->id])
            ->andReturn(null);

        $promptService = Mockery::mock(PromptServiceInterface::class);
        $promptService->shouldReceive('countTodayPromptsByUser')
            ->withArgs([$user->id])
            ->andReturn(0);

        $this->app->instance(TarifUserServiceInterface::class, $tarifUserService);
        $this->app->instance(PromptServiceInterface::class, $promptService);

        $response = $this->actingAs($user)->postJson('/api/prompts', [
            'campaign_id' => $campaign->id,
            'content' => 'Test prompt content',
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'Aucun tarif trouvé pour cet utilisateur',
                'status' => 'error',
            ]);
    }

    public function test_prompt_store_returns_error_when_no_tarif_details()
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create();

        $tarifUserMock = (object) [
            'tarif' => null,
        ];

        $tarifUserService = Mockery::mock(TarifUserServiceInterface::class);
        $tarifUserService->shouldReceive('getLatestByUserId')
            ->withArgs([$user->id])
            ->andReturn($tarifUserMock);

        $promptService = Mockery::mock(PromptServiceInterface::class);
        $promptService->shouldReceive('countTodayPromptsByUser')
            ->withArgs([$user->id])
            ->andReturn(0);

        $this->app->instance(TarifUserServiceInterface::class, $tarifUserService);
        $this->app->instance(PromptServiceInterface::class, $promptService);

        $response = $this->actingAs($user)->postJson('/api/prompts', [
            'campaign_id' => $campaign->id,
            'content' => 'Test prompt content',
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'Aucun détail de tarif trouvé',
                'status' => 'error',
            ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
