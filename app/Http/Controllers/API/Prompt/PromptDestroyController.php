<?php

namespace App\Http\Controllers\API\Prompt;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\PromptServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class PromptDestroyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly PromptServiceInterface $service
    ) {}

    public function __invoke(int $id): JsonResponse
    {
        $prompt = $this->service->getPromptById($id);
        $this->authorize('delete', $prompt);
        $this->service->deletePrompt($id);

        return response()->json(['message' => 'Supprimé avec succès.'], 200);
    }
}
