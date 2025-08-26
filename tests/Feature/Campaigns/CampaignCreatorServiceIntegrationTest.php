<?php

namespace Feature\Campaigns;

use App\Models\Campaign;
use App\Models\TypeCampaign;
use App\Models\User;
use App\Repositories\CampaignRepository;
use App\Services\CampaignCreateService\CampaignCreatorService;
use App\Services\CampaignCreateService\CampaignNameGeneratorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CampaignCreatorServiceIntegrationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('slow')]
    public function test_real_gemini_integration()
    {
        $service = new CampaignNameGeneratorService;
        $result = $service->generateFromDescription('Test description');
        $this->assertNotEmpty($result);
    }

    #[Test]
    public function test_create_campaign_from_description_with_gemini()
    {
        $this->artisan('migrate:fresh');

        $user = User::factory()->create();
        $typeCampaign = TypeCampaign::factory()->create();

        $mockNameGenerator = $this->createMock(CampaignNameGeneratorService::class);
        $mockNameGenerator->method('generateFromDescription')
            ->willReturn('Nom de campagne mocké');

        $repository = new CampaignRepository(new Campaign);
        $service = new CampaignCreatorService($repository, $mockNameGenerator);

        $data = [
            'description' => 'Une campagne pour promouvoir un nouveau produit tech',
            'type_campaign_id' => $typeCampaign->id,
            'user_id' => $user->id,
            'status' => 'Created',
        ];

        $campaign = $service->createCampaignFromDescription($data);

        dump($campaign);
        $this->assertNotEmpty($campaign->name);
        $this->assertEquals('Nom de campagne mocké', $campaign->name);
        $this->assertEquals($data['description'], $campaign->description);
        $this->assertDatabaseHas('campaigns', ['id' => $campaign->id]);
    }
}
