<?php

namespace Tests\Unit\Campaign;

use App\Services\CampaignCreateService\CampaignDescriptionGeneratorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CampaignDescriptionGeneratorServiceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_it_generates_description_from_description()
    {
        Http::fake([
            '*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Description professionnelle générée pour la campagne'],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $service = new CampaignDescriptionGeneratorService;
        $description = $service->generateDescriptionFromDescription('Description de test', 'type de campagne');

        $this->assertEquals('Description professionnelle générée pour la campagne', $description);
    }

    #[Test]
    public function test_it_returns_default_description_if_api_fails()
    {
        Http::fake([
            '*' => Http::response([], 500),
        ]);

        $service = new CampaignDescriptionGeneratorService;
        $description = $service->generateDescriptionFromDescription('Description de test spécifique', 'type de campagne');

        $this->assertStringContainsString('Description de test spécifique', $description);
        $this->assertStringContainsString('Campagne type de campagne conçue pour atteindre des objectifs spécifiques', $description);
        $this->assertStringContainsString('Stratégie optimisée pour maximiser l\'engagement et les résultats', $description);
    }

    #[Test]
    public function test_it_returns_default_description_on_exception()
    {
        Http::fake([
            '*' => Http::response([], 200),
        ]);

        $service = new CampaignDescriptionGeneratorService;
        $description = $service->generateDescriptionFromDescription('Test exception', 'type de campagne');
        $this->assertStringContainsString('Test exception', $description);
        $this->assertStringContainsString('Campagne type de campagne conçue pour atteindre des objectifs spécifiques', $description);
    }

    #[Test]
    public function test_clean_response_removes_unwanted_characters()
    {
        $service = new CampaignDescriptionGeneratorService;

        $reflection = new \ReflectionClass($service);
        $method = $reflection->getMethod('cleanResponse');

        $result = $method->invokeArgs($service, ['"texte de test"']);

        $this->assertEquals('texte de test', $result);
    }

    #[Test]
    public function test_generate_fallback_description_includes_original()
    {
        $service = new CampaignDescriptionGeneratorService;

        $reflection = new \ReflectionClass($service);
        $method = $reflection->getMethod('generateFallbackDescription');

        $result = $method->invokeArgs($service, ['description originale', 'campagne type']);

        $this->assertStringContainsString('description originale', $result);
        $this->assertStringContainsString('Campagne campagne type conçue', $result);
    }
}
