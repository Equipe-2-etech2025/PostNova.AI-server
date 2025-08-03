<?php

namespace App\Http\Controllers\API\Prompt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prompt\UpdatePromptRequest;
use App\Http\Resources\Prompt\PromptResource;
use App\Models\Prompt;
use App\Services\Interfaces\PromptServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PromptUpdateController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly PromptServiceInterface $service
    ) {}

    public function __invoke(UpdatePromptRequest $request, int $id)
    {
        $prompt = $this->service->getPromptById($id);
        $this->authorize('update', $prompt);
        $updatedPrompt = $this->service->updatePrompt($id, $request->toDto($prompt));
        return new PromptResource($updatedPrompt);
    }
}
