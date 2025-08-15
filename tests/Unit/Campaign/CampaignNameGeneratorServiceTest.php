<?php

namespace Tests\Unit\Campaign;

use App\Services\CampaignCreateService\CampaignNameGeneratorService;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CampaignNameGeneratorServiceTest extends TestCase
{
    #[Test]
    public function test_it_generates_name_from_description()
    {
        Http::fake([
            '*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Super Campagne Test']
                            ]
                        ]
                    ]
                ]
            ], 200)
        ]);

        $service = new CampaignNameGeneratorService();
        $name = $service->generateFromDescription("Description de test");
        dump($name);

        $this->assertEquals('Super Campagne Test', $name);
    }

    #[Test]
    public function test_it_returns_default_name_if_api_fails()
    {
        Http::fake([
            '*' => Http::response([], 500)
        ]);

        $service = new CampaignNameGeneratorService();
        $name = $service->generateFromDescription("Description de test");

        dump($name);
        $this->assertEquals('Nom par défaut', $name);
    }
}
