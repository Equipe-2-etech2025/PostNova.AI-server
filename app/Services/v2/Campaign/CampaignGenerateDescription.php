<?php

namespace App\Services\v2\Campaign;

use App\Services\v2\AIModel\ApiModelAI;

class CampaignGenerateDescription
{
    public function improveDescription(string $description, string $campaignType): string
    {
        try {
            $response = ApiModelAI::request(prompt: $this->buildPrompt($description, $campaignType));
            return $this->cleanResponse($response);
        } catch (\Exception $e) {
            return $this->generateFallbackDescription($description, $campaignType);
        }
    }

    private function buildPrompt(string $description, string $campaignType): string
    {
        return "Génère une description professionnelle et détaillée pour une campagne marketing de type '$campaignType' basée sur: '$description'.
                La description doit être :
                - Concise mais informative (2-3 phrases maximum)
                - Mettre en avant les objectifs et la valeur ajoutée
                - Professionnelle et engageante
                - Adaptée au type de campagne $campaignType
                Réponds uniquement avec la description générée, sans guillemets ni texte supplémentaire et pas de nouvelle ligne.";
    }

    private function cleanResponse(string $response): string
    {
        return trim(str_replace(['"'], '', $response));
    }

    private function generateFallbackDescription(string $description, string $campaignType): string
    {
        return "Campagne $campaignType conçue pour atteindre des objectifs spécifiques basés sur : $description.
                Stratégie optimisée pour maximiser l'engagement et les résultats.";
    }
}
