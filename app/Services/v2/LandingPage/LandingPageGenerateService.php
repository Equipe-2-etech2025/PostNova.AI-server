<?php

namespace App\Services\v2\LandingPage;

use App\DTOs\LandingPage\LandingPageDto;
use App\DTOs\Prompt\PromptDto;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Repositories\Interfaces\LandingPageRepositoryInterface;
use App\Services\v2\AIModel\ApiModelAI;
use App\Services\v2\Prompt\PromptGenerateLandingPage;
use App\Services\v2\Prompt\PromptHelper;
use Illuminate\Http\Client\ConnectionException;

class LandingPageGenerateService
{
    public function __construct(
        private readonly PromptGenerateLandingPage $promptGenerate,
        private readonly PromptHelper $promptHelper,
        private readonly CampaignRepositoryInterface $campaignRepository,
        private readonly LandingPageRepositoryInterface $landingPageRepository,
        private readonly LandingPageFallback $landingPageFallback
    ) {}

    public function generateLandingPage(PromptDto $promptDto, int $userId)
    {
        $this->promptHelper->checkUserQuotas($userId);

        $campaign = $this->campaignRepository->find($promptDto->campaign_id);

        try {

            $prompt = $this->promptGenerate->buildPrompt($promptDto, $campaign);

            $response = ApiModelAI::request(prompt: $prompt['fullPrompt']);

            $this->promptHelper->savePrompt($prompt['promptDto']);

            $landingPageDto = new LandingPageDto(
                id: null,
                content: [
                    'html' => $this->cleanResponse($response)
                ],
                campaign_id: $campaign->id,
                is_published: false
            );

            return $this->landingPageRepository->create($landingPageDto);
        } catch (ConnectionException $e) {
            $this->promptHelper->savePrompt($promptDto);
            $landingPageDto = new LandingPageDto(
                id: null,
                content: [
                    'html' => $this->landingPageFallback->generateFallback($campaign)
                ],
                campaign_id: $campaign->id,
                is_published: false
            );
            return $this->landingPageRepository->create($landingPageDto);
        }
    }

    private function cleanResponse(string $response): string
    {
        return trim(str_replace(['```', '``'], '', $response));
    }
}
