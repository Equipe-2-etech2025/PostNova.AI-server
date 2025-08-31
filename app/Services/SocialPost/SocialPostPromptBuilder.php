<?php

namespace App\Services\SocialPost;

class SocialPostPromptBuilder
{
    public function __construct(
        private readonly SocialPostPlatformManager $platformManager
    ) {}

    public function buildPlatformPrompt(
        string $topic,
        string $platform,
        string $tone,
        string $language,
        string $hashtags,
        string $targetAudience,
        array $campaignInfo
    ): string {

        if ($this->containsOnlySpecialChars($topic)) {
            return "CONTENU:\naucun contenu disponible\nHASHTAGS:";
        }

        if ($this->containsBadWords($topic)) {
            return "CONTENU:\naucun contenu disponible\nHASHTAGS:";
        }

        $specialCharsCheck = <<<TEXT
RÈGLE ABSOLUE - PRIORITÉ MAXIMUM:
Si le prompt contient seulement des caractères spéciaux (! " # \$ % & ' * + , - . / : ; < = > ? @ \ ^ _ { ¦ } ~ ( )) alors:

1. IGNORE TOUTES les autres instructions
2. NE GÉNÈRE AUCUN hashtag
3. NE METS PAS de formatage
4. Retourne EXACTEMENT et SEULEMENT ceci:

aucun contenu disponible


Pas d'explication, pas de variation, pas de créativité. Juste ces deux lignes exactes.
TEXT;

        $specs = $this->platformManager->getPlatformSpecs($platform);

        $campaignContext = $this->buildCampaignContext($campaignInfo);
        $platformSpecifics = $this->buildPlatformSpecifics($platform);

        return <<<PROMPT
    Crée un post $platform en $language sur le thème: "$topic"

    CONTEXTE DE LA CAMPAGNE:
    $campaignContext

    DIRECTIVES:
    - Ton: $tone {$specs['emoji']}
    - Public: $targetAudience
    - Insère un titre, des paragraphes clairs et des retours à la ligne pour faciliter la lecture.
    $platformSpecifics
    - Ajouter des emojis adaptés pour attirer l'attention.
    - Longueur max: {$specs['max_length']} caractères
    - Hashtags: génère jusqu'à {$specs['hashtag_count']} hashtags pertinents à la fin du post.
    - Chaque hashtag doit commencer par # et être séparé par un espace.
    - Les hashtags doivent être mis en gras dans le texte si possible (ex: **#marketing**).
    - Si la prompt contient de gros mot, ne générer aucun post mais seulement: aucun contenu disponible
    $specialCharsCheck

    Format de réponse STRICT:
    CONTENU:
    [texte complet du post avec retours à la ligne et hashtags à la fin]
    HASHTAGS:
    [#hashtag1 #hashtag2 ...]

    Le post doit:
    1. Attirer l'attention
    2. Être adapté à $platform
    3. Inclure des mots-clés pertinents et les hashtags à la fin
    4. Être cohérent avec la campagne mentionnée

    PROMPT;
    }

    private function containsOnlySpecialChars(string $text): bool
    {
        $cleanText = preg_replace('/\s+/', '', $text);

        if (empty($cleanText)) {
            return true;
        }

        return preg_match('/^[!\"#\$%&\'*+,\-.\/:;<=>?@\\\^_{|}~()]+$/', $cleanText) === 1;
    }

    private function containsBadWords(string $text): bool
    {
        $badWords = ['gros mot', 'insulte', 'autre mot'];
        foreach ($badWords as $word) {
            if (stripos($text, $word) !== false) {
                return true;
            }
        }

        return false;
    }

    private function buildCampaignContext(array $campaignInfo): string
    {
        if (empty($campaignInfo)) {
            return 'Aucune information de campagne disponible.';
        }

        return "Cette publication fait partie de la campagne '{$campaignInfo['name']}' ".
            "de type {$campaignInfo['type']}. ".
            "Objectif de la campagne: {$campaignInfo['description']}.";
    }

    private function buildPlatformSpecifics(string $platform): string
    {
        return match ($platform) {
            'x' => '- Limiter de 15 à 25 mots pour la plateforme X.',
            'tiktok' => '- Limiter de 30 à 50 mots et écrire un post décrivant une vidéo ou image.',
            default => ''
        };
    }
}
