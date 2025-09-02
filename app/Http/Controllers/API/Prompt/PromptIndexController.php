<?php

namespace App\Http\Controllers\API\Prompt;

use App\Http\Controllers\Controller;
use App\Http\Resources\Prompt\PromptCollection;
use App\Models\Campaign;
use App\Services\Interfaces\PromptServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class PromptIndexController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly PromptServiceInterface $service
    ) {}

    public function __invoke()
    {
        $user = Auth::user();
        $this->authorize('viewAny', Campaign::class);

        $prompts = $user->hasRole('admin')
            ? $this->service->getAllPrompts()
            : $this->service->getPromptByUserId($user->id);

        return new PromptCollection($prompts);
    }
}
