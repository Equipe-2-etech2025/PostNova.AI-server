<?php

namespace App\Services\Interfaces\CampagnGenerateInterface;

interface CampaignDescriptionGeneratorServiceInterface
{
    public function generateDescriptionFromDescription(string $description, string $campaignType): string;
}
