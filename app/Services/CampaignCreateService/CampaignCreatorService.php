<?php

namespace App\Services\CampaignCreateService;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Repositories\Interfaces\TypeCampaignRepositoryInterface;
use App\Services\Interfaces\CampagnGenerateInterface\CampaignDescriptionGeneratorServiceInterface;
use App\Services\Interfaces\CampagnGenerateInterface\CampaignNameGeneratorServiceInterface;

class CampaignCreatorService
{
    public function __construct(
        private CampaignRepositoryInterface $campaignRepository,
        private TypeCampaignRepositoryInterface $typeCampaignRepository,
        private CampaignNameGeneratorServiceInterface $nameGeneratorService,
        private CampaignDescriptionGeneratorServiceInterface $descriptionGeneratorService
    ) {}

    public function createCampaignFromDescription(array $data)
    {
        $campaignTypeName = $this->getCampaignTypeName($data['type_campaign_id']);

        $generatedName = $this->nameGeneratorService->generateFromDescription(
            $data['description'],
            $campaignTypeName
        );

        $generatedDescription = $this->descriptionGeneratorService->generateDescriptionFromDescription(
            $data['description'],
            $campaignTypeName
        );

        $status = isset($data['status'])
            ? StatusEnum::fromLabel($data['status'])->value
            : StatusEnum::Created->value;

        $campaignDto = new CampaignDto(
            id: null,
            name: $generatedName,
            description: $generatedDescription,
            type_campaign_id: $data['type_campaign_id'],
            user_id: $data['user_id'],
            status: $status,
            is_published: false
        );

        return $this->campaignRepository->create($campaignDto);
    }

    /**
     * Récupère le nom du type de campagne
     */
    private function getCampaignTypeName(int $typeCampaignId): string
    {
        try {
            $typeCampaign = $this->typeCampaignRepository->find($typeCampaignId);

            return $typeCampaign ? $typeCampaign->name : 'Marketing';
        } catch (\Exception $e) {
            return 'Marketing';
        }
    }
}
