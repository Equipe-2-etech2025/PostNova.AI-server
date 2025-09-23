<?php

namespace App\Http\Controllers\API\v2\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prompt\CreatePromptRequest;
use App\Http\Resources\LandingPage\LandingPageResource;
use App\Services\v2\LandingPage\LandingPageGenerateService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LandingPageGenerateController extends Controller
{
    public function __construct(
        private readonly LandingPageGenerateService $landingPageGenerateService
    ) {}

    public function __invoke(CreatePromptRequest $request)
    {
        $validated = $request->toDto();
        $landingPage = $this->landingPageGenerateService->generateLandingPage($validated, $request->user()->id);
        return $this->success(
            new LandingPageResource($landingPage),
            Response::HTTP_CREATED
        );
    }
}
