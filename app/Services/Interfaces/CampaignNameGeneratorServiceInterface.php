<?php

namespace App\Services\Interfaces;

interface CampaignNameGeneratorServiceInterface
{
    public function generateFromDescription(string $description): string;
}
