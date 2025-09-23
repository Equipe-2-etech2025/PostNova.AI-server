<?php

namespace App\Services\v2\Campaign;

use App\Services\v2\AIModel\ApiModelAI;

class CampaignGenerateName
{
    public function generateNameFromDescription(string $description, string $campaignType): string
    {
        try {
            $response = ApiModelAI::request(prompt: $this->buildPrompt($description, $campaignType));
            return $this->cleanResponse($response);
        } catch (\Exception $e) {
            return $this->generateFallbackName($description, $campaignType);
        }
    }

    private function buildPrompt(string $description, string $campaignType): string
    {
        return "Génère un nom professionnel pour une campagne marketing de type '$campaignType' basée sur: '$description'.
                Le nom doit être :
                - Maximum 10 mots
                - Accrocheur et mémorable
                - Adapté au type de campagne $campaignType
                Réponds uniquement avec le nom généré, sans guillemets.";
    }

    private function cleanResponse(string $response): string
    {
        return trim(str_replace(['"', 'Nom :'], '', $response));
    }

    private function generateFallbackName(string $description, string $campaignType): string
    {
        $keywords = ['Innovation', 'Excellence', 'Future', 'Projet', 'Solution'];
        $randomKeyword = $keywords[array_rand($keywords)];

        return 'Campagne ' . $campaignType . ' ' . $randomKeyword . ' ' . date('Y');
    }
}
