<?php

namespace App\Services\CampaignCreateService;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Services\Interfaces\CampagnGenerateInterface\CampaignDescriptionGeneratorServiceInterface;
use App\Services\Interfaces\CampagnGenerateInterface\CampaignNameGeneratorServiceInterface;

class CampaignCreatorService
{
    public function __construct(
        private readonly CampaignRepositoryInterface $campaignRepository,
        private readonly CampaignNameGeneratorServiceInterface $nameGeneratorService,
        private readonly CampaignDescriptionGeneratorServiceInterface $descriptionGeneratorService
    ) {}

    public function createCampaignFromDescription(array $data)
    {
        $generatedName = $this->nameGeneratorService->generateFromDescription($data['description']);
        $generatedDescription = $this->descriptionGeneratorService->generateDescriptionFromDescription($data['description']);

        $status = isset($data['status'])
            ? StatusEnum::fromLabel($data['status'])->value
            : StatusEnum::Created->value;

        $campaignDto = new CampaignDto(
            id: null,
            name: $generatedName,
            description: $generatedDescription,
            type_campaign_id: $data['type_campaign_id'],
            user_id: $data['user_id'],
            status: $status
        );

        return $this->campaignRepository->create($campaignDto);
    }
}
