<?php

namespace App\Services\v2\Prompt;

use App\DTOs\Prompt\PromptDto;
use App\Exceptions\TarifException;
use App\Repositories\Interfaces\PromptRepositoryInterface;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PromptHelper
{
    public function __construct(
        private readonly TarifUserServiceInterface $tarifUserService,
        private readonly PromptRepositoryInterface $promptRepository
    ) {}

    public function checkUserQuotas(int $userId)
    {
        $userTarif = $this->tarifUserService->getLatestByUserId($userId);
        $quotaPrompt = $this->promptRepository->countTodayPromptsByUser($userId);

        if (! $userTarif) {
            throw new NotFoundHttpException('Aucun tarif trouvé pour cet utilisateur', code: Response::HTTP_BAD_REQUEST);
        }

        if (! $userTarif->tarif) {
            throw new NotFoundHttpException('Aucun détail de tarif trouvé', code: Response::HTTP_NOT_FOUND);
        }

        $maxLimit = $userTarif->tarif->max_limit;

        if ($quotaPrompt >= $maxLimit) {
            throw new TarifException('Quotas quotidien atteint: '.$quotaPrompt.'/'.$maxLimit, Response::HTTP_LOCKED);
        }
    }

    public function savePrompt(PromptDto $promptDto)
    {
        try {
            $this->promptRepository->create($promptDto);
        } catch (\Throwable $th) {
            throw new \Throwable($th->getMessage());
        }
    }
}
