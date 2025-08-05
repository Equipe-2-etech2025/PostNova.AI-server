<?php

namespace App\Http\Controllers\API\Prompt;

use App\Http\Controllers\Controller;
use App\Models\Prompt;
use App\Models\User;
use App\Services\Interfaces\PromptServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class PromptQuotaByUserController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly PromptServiceInterface $service
    ) {}

    public function __invoke(int $userId): JsonResponse
    {
        $this->authorize('viewQuota', [Prompt::class, $userId]);

        $quota = $this->service->countTodayPromptsByUser($userId);
        $dailyLimit = config('prompts.daily_limit');

        return response()->json([
            'success' => true,
            'data' => [
                'user_id' => $userId,
                'daily_quota_used' => $quota,
            ]
        ]);
    }
}
