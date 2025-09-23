<?php

namespace App\Services\v2\Campaign;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Repositories\Interfaces\TypeCampaignRepositoryInterface;
use App\Services\v2\Campaign\CampaignGenerateDescription;
use App\Services\v2\Campaign\CampaignGenerateName;

class CampaignGenerateService
{

    public function __construct(
        private CampaignGenerateName $nameGenerator,
        private CampaignGenerateDescription $desciptionGenerator,
        private CampaignRepositoryInterface $campaignRepository,
        private TypeCampaignRepositoryInterface $typeCampaignRepository,
    ) {}

    public function generateCampaign(CampaignDto $data)
    {

        $campaignTypeName = $this->getCampaignTypeName($data->type_campaign_id);

        $generatedName = $this->nameGenerator->generateNameFromDescription(
            $data->description,
            $campaignTypeName
        );

        $generatedDescription = $this->desciptionGenerator->improveDescription(
            $data->description,
            $campaignTypeName
        );

        $campaignDto = new CampaignDto(
            id: null,
            name: $generatedName,
            description: $generatedDescription,
            type_campaign_id: $data->type_campaign_id,
            user_id: $data->user_id,
            status: StatusEnum::Created->value,
            is_published: false,
            business_name: $data->business_name ?? null,
            email: $data->email ?? null,
            phone_numbers: $data->phone_numbers ?? null,
            company: $data->company ?? null,
            website: $data->website ?? null,
            industry: $data->industry ?? null,
            location: $data->location ?? null,
            target_audience: $data->target_audience ?? null,
            goals: $data->goals ?? null,
            budget: $data->budget ?? null,
            keywords: $data->keywords ?? null,
            additional_notes: $data->additional_notes ?? null,
            preferred_style: $data->preferred_style ?? null
        );
        return $this->campaignRepository->create($campaignDto);
    }

    private function getCampaignTypeName(int $typeCampaignId): string
    {
        try {
            $typeCampaign = $this->typeCampaignRepository->find($typeCampaignId);
            return $typeCampaign ? $typeCampaign->name : 'Marketing';
        } catch (\Exception) {
            return 'Marketing';
        }
    }
}
