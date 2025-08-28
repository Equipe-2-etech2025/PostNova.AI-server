<?php

namespace Tests\Unit\Campaign;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Services\CampaignCreateService\CampaignCreatorService;
use App\Services\Interfaces\CampagnGenerateInterface\CampaignDescriptionGeneratorServiceInterface;
use App\Services\Interfaces\CampagnGenerateInterface\CampaignNameGeneratorServiceInterface;
use PHPUnit\Framework\TestCase;

class CampaignCreatorServiceTest extends TestCase
{
    public function test_create_campaign_from_description_generates_name_and_saves()
    {
        $repositoryMock = $this->createMock(CampaignRepositoryInterface::class);

        $repositoryMock->method('create')
            ->willReturnCallback(function (CampaignDto $dto) {
                $campaign = new Campaign;
                $campaign->id = 1;
                $campaign->name = $dto->name;
                $campaign->description = $dto->description;
                $campaign->type_campaign_id = $dto->type_campaign_id;
                $campaign->user_id = $dto->user_id;
                $campaign->status = $dto->status;

                return $campaign;
            });

        $nameGeneratorMock = $this->createMock(CampaignNameGeneratorServiceInterface::class);
        $nameGeneratorMock->method('generateFromDescription')
            ->willReturn('Nom Généré Test');

        $descriptionGeneratorMock = $this->createMock(CampaignDescriptionGeneratorServiceInterface::class);
        $descriptionGeneratorMock->method('generateDescriptionFromDescription')
            ->willReturn('Description de test générée');

        $service = new CampaignCreatorService($repositoryMock, $nameGeneratorMock, $descriptionGeneratorMock);

        $data = [
            'description' => 'Description de test',
            'type_campaign_id' => 1,
            'user_id' => 42,
            'status' => 'Created',
        ];

        $campaign = $service->createCampaignFromDescription($data);

        $this->assertEquals('Nom Généré Test', $campaign->name);
        $this->assertEquals('Description de test générée', $campaign->description);
        $this->assertEquals(1, $campaign->type_campaign_id);
        $this->assertEquals(42, $campaign->user_id);
        $this->assertEquals(StatusEnum::fromLabel('Created')->value, $campaign->status);
    }
}
