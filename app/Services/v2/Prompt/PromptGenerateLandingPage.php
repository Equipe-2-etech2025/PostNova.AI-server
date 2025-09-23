<?php

namespace App\Services\v2\Prompt;

use App\DTOs\Prompt\PromptDto;
use App\Models\Campaign;

class PromptGenerateLandingPage
{
    public function buildPrompt(PromptDto $promptDto, Campaign $campaign): array
    {
        $promptDto->business_name = $promptDto->business_name ?? $campaign->business_name;
        $promptDto->email = $promptDto->email ?? $campaign->email;
        $promptDto->phone_numbers = $promptDto->phone_numbers ?? $campaign->phone_numbers;
        $promptDto->company = $promptDto->company ?? $campaign->company;
        $promptDto->website = $promptDto->website ?? $campaign->website;
        $promptDto->industry = $promptDto->industry ?? $campaign->industry;
        $promptDto->location = $promptDto->location ?? $campaign->location;
        $promptDto->target_audience = $promptDto->target_audience ?? $campaign->target_audience;
        $promptDto->goals = $promptDto->goals ?? $campaign->goals;
        $promptDto->budget = $promptDto->budget ?? $campaign->budget;
        $promptDto->keywords = $promptDto->keywords ?? $campaign->keywords;
        $promptDto->preferred_style = $promptDto->preferred_style ?? $campaign->preferred_style;
        $promptDto->additional_notes = $promptDto->additional_notes ?? $campaign->additional_notes;
        
        $phoneNumbers = implode(', ', $promptDto->phone_numbers);
        $keywords = implode(', ', $promptDto->keywords);

        $prompt =
            <<<PROMPT
Génère le contenu d'une landing page moderne, complete, intuitive et responsive, adapté au contexte du campagne :
Context: $campaign->description,
Campaign name: $campaign->name,
Prompt principal: $promptDto->content

Voici d'autres informations à ajouter dans la page :
- business name: $promptDto->business_name;
- email: $promptDto->email;
- phone number: $phoneNumbers;
- company: $promptDto->company;
- website: $promptDto->website;
- industry: $promptDto->industry;
- location: $promptDto->location;
- target audience: $promptDto->target_audience;
- goals: $promptDto->goals;
- budget: $promptDto->budget;
- keywords: $keywords;
- additional notes: $promptDto->additional_notes;
- preferred style: $promptDto->preferred_style;

IMPORTANT: Génère uniquement du HTML pur avec tous les styles CSS intégrés dans des balises <style> dans le <head>. N'utilise AUCUNE librairie CSS externe ou JavaScript. Tout doit être autonome.
Directives pour le HTML:
1. Document HTML complet avec DOCTYPE, head et body
2. Design responsive avec media queries
3. Couleurs modernes et harmonieuses adaptées au contexte
4. Typographie claire et lisible
5. Script Javascript autorisé dans le balise <script> dans body
6. Utilisation d'image existant et libre de droit sur internet (lien existant)
7. Sans commentaire HTML

IMPORTANT: N'utilise PAS les balises de code markdown (``` ou ```) dans ta réponse. Utilise uniquement le format ci-dessous. Format de réponse STRICT (respecte exactement ce format):
<!DOCTYPE html><html><head><style>/* Tous les styles CSS ici */</style></head><body><!-- Contenu HTML complet --><script></script></body></html>
PROMPT;

        return [
            'promptDto' => $promptDto,
            'fullPrompt' => $prompt
        ];
    }
}
