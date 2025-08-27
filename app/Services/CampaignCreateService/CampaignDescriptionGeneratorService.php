<?php

namespace App\Services\CampaignCreateService;

use App\Services\Interfaces\CampagnGenerateInterface\CampaignDescriptionGeneratorServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CampaignDescriptionGeneratorService implements CampaignDescriptionGeneratorServiceInterface
{
    public function generateDescriptionFromDescription(string $description): string
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->timeout(30)
                ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key='.config('services.gemini.api_key'), [
                    'contents' => [
                        'parts' => [
                            ['text' => $this->buildPrompt($description)],
                        ],
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();

                return $this->cleanResponse($data['candidates'][0]['content']['parts'][0]['text']);
            }

            return $this->generateFallbackDescription($description);

        } catch (\Exception $e) {
            Log::error('Gemini API exception for description generation', ['error' => $e->getMessage()]);

            return $this->generateFallbackDescription($description);
        }
    }

    protected function buildPrompt(string $description): string
    {
        return "Génère une description professionnelle et détaillée pour une campagne marketing basée sur: '$description'.
                La description doit être :
                - Concise mais informative (2-3 phrases maximum)
                - Mettre en avant les objectifs et la valeur ajoutée
                - Professionnelle et engageante
                Réponds uniquement avec la description générée, sans guillemets ni texte supplémentaire.";
    }

    protected function cleanResponse(string $response): string
    {
        return trim(str_replace(['"', "'", 'Description :'], '', $response));
    }

    protected function generateFallbackDescription(string $description): string
    {
        return "Campagne marketing conçue pour atteindre des objectifs spécifiques basés sur : $description.
                Stratégie optimisée pour maximiser l'engagement et les résultats.";
    }
}
