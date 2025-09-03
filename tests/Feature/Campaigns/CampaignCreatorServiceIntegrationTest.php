<?php

namespace Feature\Campaigns;

use App\Models\Campaign;
use App\Models\TypeCampaign;
use App\Models\User;
use App\Repositories\CampaignRepository;
use App\Repositories\Interfaces\TypeCampaignRepositoryInterface;
use App\Services\CampaignCreateService\CampaignCreatorService;
use App\Services\CampaignCreateService\CampaignDescriptionGeneratorService;
use App\Services\CampaignCreateService\CampaignNameGeneratorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

// test réel avec api gemini
class CampaignCreatorServiceIntegrationTest extends TestCase
{
    //    use RefreshDatabase;
    //
    //    #[Test]
    //    #[Group('slow')]
    //    public function test_real_gemini_integration()
    //    {
    //        $service = new CampaignNameGeneratorService;
    //        $result = $service->generateFromDescription('Test description', 'type campaign');
    //        $this->assertNotEmpty($result);
    //    }

    //    #[Test]
    //    public function test_create_campaign_from_description_with_gemini()
    //    {
    //        $this->artisan('migrate:fresh');
    //
    //        $user = User::factory()->create();
    //        $typeCampaign = TypeCampaign::factory()->create();
    //
    //        // Créer les mocks pour TOUTES les dépendances
    //        $mockNameGenerator = $this->createMock(CampaignNameGeneratorService::class);
    //        $mockNameGenerator->method('generateFromDescription')
    //            ->willReturn('Nom de campagne mocké');
    //
    //        $mockDescriptionGenerator = $this->createMock(CampaignDescriptionGeneratorService::class);
    //        $mockDescriptionGenerator->method('generateDescriptionFromDescription')
    //            ->willReturn('Une campagne pour promouvoir un nouveau produit tech');
    //
    //        // Mock pour le TypeCampaignRepository
    //        $mockTypeCampaignRepository = $this->createMock(TypeCampaignRepositoryInterface::class);
    //        $mockTypeCampaignRepository->method('getTypeName')
    //            ->willReturn('Marketing Digital'); // Ou le nom de votre type de campagne
    //
    //        $repository = new CampaignRepository(new Campaign);
    //
    //        // Correction: Passer les arguments dans le BON ordre
    //        $service = new CampaignCreatorService(
    //            $repository,                     // Argument #1: CampaignRepositoryInterface
    //            $mockTypeCampaignRepository,     // Argument #2: TypeCampaignRepositoryInterface ← CORRECTION ICI
    //            $mockNameGenerator,              // Argument #3: CampaignNameGeneratorServiceInterface
    //            $mockDescriptionGenerator        // Argument #4: CampaignDescriptionGeneratorServiceInterface
    //        );
    //
    //        $data = [
    //            'description' => 'Une campagne pour promouvoir un nouveau produit tech',
    //            'type_campaign_id' => $typeCampaign->id,
    //            'user_id' => $user->id,
    //            'status' => 'Created',
    //        ];
    //
    //        $campaign = $service->createCampaignFromDescription($data);
    //
    //        dump($campaign);
    //        $this->assertNotEmpty($campaign->name);
    //        $this->assertEquals('Nom de campagne mocké', $campaign->name);
    //        $this->assertEquals('Une campagne pour promouvoir un nouveau produit tech', $campaign->description);
    //        $this->assertDatabaseHas('campaigns', ['id' => $campaign->id]);
    //    }
}
