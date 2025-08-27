<?php

namespace App\Services\Interfaces\CampagnGenerateInterface;

interface CampaignNameGeneratorServiceInterface
{
    public function generateFromDescription(string $description): string;
}
