<?php

namespace Tests\Feature;

use App\Services\CampaignService;
use App\Services\PromptService;
use App\Services\SuggestionService;
use App\Services\TarifUserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuggestionServiceTest extends TestCase
{
    // Optionnel si tu veux reset la base à chaque test
    // use RefreshDatabase;

    protected SuggestionService $suggestionService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->suggestionService = new SuggestionService(
            app(CampaignService::class),
            app(PromptService::class),
            app(TarifUserService::class),
        );
    }

    /** @test */
    public function it_returns_real_suggestions_from_gemini()
    {
        // Remplace avec un ID d'utilisateur réel existant en base
        $userId = 1;

        $suggestions = $this->suggestionService->getSuggestions($userId);
        dump($suggestions);

        $this->assertNotEmpty($suggestions);

        foreach ($suggestions as $suggestion) {
            $this->assertArrayHasKey('id', $suggestion);
            $this->assertArrayHasKey('title', $suggestion);
            $this->assertArrayHasKey('content', $suggestion);
            $this->assertArrayHasKey('type', $suggestion);
            $this->assertArrayHasKey('priority', $suggestion);
            $this->assertArrayHasKey('iconType', $suggestion);
            $this->assertArrayHasKey('hasAction', $suggestion);
        }
    }
}
