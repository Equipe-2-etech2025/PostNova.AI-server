<?php

namespace App\Http\Controllers\API\Prompt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prompt\CreatePromptRequest;
use App\Http\Resources\Prompt\PromptResource;
use App\Models\Prompt;
use App\Services\Interfaces\PromptServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PromptStoreController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly PromptServiceInterface $service
    ) {}

    public function __invoke(CreatePromptRequest $request)
    {
        $promptDto = $request->toDto();
        $this->authorize('create', [Prompt::class, $promptDto->campaign_id]);
        $prompt = $this->service->createPrompt($promptDto);
        return new PromptResource($prompt);
    }
}
