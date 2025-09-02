<?php

namespace App\Http\Controllers\API\Prompt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prompt\CreatePromptRequest;
use App\Http\Resources\Prompt\PromptResource;
use App\Models\Prompt;
use App\Services\Interfaces\PromptServiceInterface;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PromptStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly PromptServiceInterface $service,
        private readonly TarifUserServiceInterface $tarifUserService
    ) {}

    public function __invoke(CreatePromptRequest $request)
    {
        $promptDto = $request->toDto();
        $this->authorize('create', [Prompt::class, $promptDto->campaign_id]);

        if (! $request->user()->isAdmin()) {
            $latestTarifUser = $this->tarifUserService->getLatestByUserId($request->user()->id);
            $quotaPrompt = $this->service->countTodayPromptsByUser($request->user()->id);

            if (! $latestTarifUser) {
                return response()->json([
                    'message' => 'Aucun tarif trouvé pour cet utilisateur',
                    'status' => 'error',
                ], 400);
            }

            if (! $latestTarifUser->tarif) {
                return response()->json([
                    'message' => 'Aucun détail de tarif trouvé',
                    'status' => 'error',
                ], 400);
            }

            $maxLimit = $latestTarifUser->tarif->max_limit;

            if ($quotaPrompt >= $maxLimit) {
                return response()->json([
                    'status' => 'error',
                    'type' => 'quota_exceeded',
                    'quota_used' => $quotaPrompt,
                    'quota_max' => $maxLimit,
                ], 400);
            }
        }
        $prompt = $this->service->createPrompt($promptDto);

        return new PromptResource($prompt);
    }
}
