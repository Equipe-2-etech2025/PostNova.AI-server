<?php

namespace App\Http\Controllers\API\Campaign;

use App\DTOs\SocialPost\SocialPostDto;
use App\DTOs\TemplateUse\TemplateUseDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\CreateCampaignRequest;
use App\Http\Resources\Campaign\CampaignResource;
use App\Services\Interfaces\CampaignServiceInterface;
use App\Services\Interfaces\SocialPostServiceInterface;
use App\Services\Interfaces\TemplateUseServiceInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignStoreByTemplateController extends Controller
{
    use AuthorizesRequests;

    private CampaignServiceInterface $campaignService;

    private TemplateUseServiceInterface $templateUseService;

    private SocialPostServiceInterface $socialPostService;

    public function __construct(
        CampaignServiceInterface $campaignService,
        TemplateUseServiceInterface $templateUseService,
        SocialPostServiceInterface $socialPostService
    ) {
        $this->campaignService = $campaignService;
        $this->templateUseService = $templateUseService;
        $this->socialPostService = $socialPostService;
    }

    public function __invoke(CreateCampaignRequest $request)
    {
        $campaignDto = $request->toDto();

        $campaign = $this->campaignService->createCampaign($campaignDto);

        $templateId = $request->get('template_id');

        $this->authorize('create', $campaign);

        // Créer l'enregistrement d'utilisation du template
        $templateUseDto = new TemplateUseDto(
            id: null,
            template_id: $templateId,
            user_id: $campaignDto->user_id,
            used_at: Carbon::now()
        );

        $this->templateUseService->createTemplateUse($templateUseDto);

        // Créer les social posts si fournis
        if ($request->has('social_posts') && is_array($request->get('social_posts'))) {
            $this->createSocialPosts($request->get('social_posts'), $campaign->id);
        }

        return new CampaignResource($campaign);
    }

    /**
     * Créer les social posts associés à la campagne
     */
    private function createSocialPosts(array $socialPostsData, int $campaignId): void
    {
        // Debug pour voir la structure des données
        \Log::info('Social posts data received:', $socialPostsData);

        foreach ($socialPostsData as $index => $socialPostData) {
            \Log::info("Processing social post {$index}:", $socialPostData);

            // Vérifier si c'est bien un array
            if (! is_array($socialPostData)) {
                \Log::warning('Social post data is not an array:', [$socialPostData]);

                continue;
            }

            // Debug du contenu spécifiquement
            $content = $socialPostData['content'] ?? null;
            $socialId = $socialPostData['social']['id'] ?? null;

            \Log::info("Content: '{$content}', Social ID: {$socialId}");

            // Valider que les données nécessaires sont présentes
            if (empty($content) || empty($socialId)) {
                \Log::warning('Missing content or social ID', [
                    'content' => $content,
                    'social_id' => $socialId,
                ]);

                continue;
            }

            $socialPostDto = new SocialPostDto(
                id: null,
                content: $content,
                campaign_id: $campaignId,
                social_id: $socialId,
                is_published: false,
                prompt_id: null
            );

            \Log::info('Creating social post with DTO:', $socialPostDto->toArray());

            $this->socialPostService->createSocialPost($socialPostDto);
        }
    }
}
