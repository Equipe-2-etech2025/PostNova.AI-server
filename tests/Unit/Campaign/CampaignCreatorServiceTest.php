<?php

namespace Tests\Unit\Campaign;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Services\CampaignCreateService\CampaignCreatorService;
use App\Services\Interfaces\CampaignNameGeneratorServiceInterface;
use PHPUnit\Framework\TestCase;

class CampaignCreatorServiceTest extends TestCase
{
    public function testCreateCampaignFromDescriptionGeneratesNameAndSaves()
    {
        // 1. Mock du repository
        $repositoryMock = $this->createMock(CampaignRepositoryInterface::class);

        // Quand create() est appelé, on retourne un Campaign Eloquent factice
        $repositoryMock->method('create')
            ->willReturnCallback(function(CampaignDto $dto) {
                $campaign = new Campaign();
                $campaign->id = 1;
                $campaign->name = $dto->name;
                $campaign->description = $dto->description;
                $campaign->type_campaign_id = $dto->type_campaign_id;
                $campaign->user_id = $dto->user_id;
                $campaign->status = $dto->status;
                return $campaign;
            });

        // 2. Mock du service Gemini
        $nameGeneratorMock = $this->createMock(CampaignNameGeneratorServiceInterface::class);
        $nameGeneratorMock->method('generateFromDescription')
            ->willReturn('Nom Généré Test');

        // 3. Instanciation du service à tester
        $service = new CampaignCreatorService($repositoryMock, $nameGeneratorMock);

        // 4. Données d’entrée simulées
        $data = [
            'description' => 'Description de test',
            'type_campaign_id' => 1,
            'user_id' => 42,
            'status' => 'Created'
        ];

        // 5. Appel du service
        $campaign = $service->createCampaignFromDescription($data);

        // 6. Assertions
        $this->assertEquals('Nom Généré Test', $campaign->name);
        $this->assertEquals('Description de test', $campaign->description);
        $this->assertEquals(1, $campaign->type_campaign_id);
        $this->assertEquals(42, $campaign->user_id);
        $this->assertEquals(StatusEnum::fromLabel('Created')->value, $campaign->status);
    }
}
