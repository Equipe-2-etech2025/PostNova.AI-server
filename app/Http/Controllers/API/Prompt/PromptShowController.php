<?php

namespace App\Http\Controllers\API\Prompt;

use App\Http\Controllers\Controller;
use App\Http\Resources\Prompt\PromptResource;
use App\Models\Prompt;
use App\Services\Interfaces\PromptServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PromptShowController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly PromptServiceInterface $service
    ) {}

    public function __invoke(int $id)
    {
        $prompt = $this->service->getPromptById($id);
        $this->authorize('view', $prompt);
        return new PromptResource($prompt);
    }
}
