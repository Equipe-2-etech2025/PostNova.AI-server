<?php

namespace App\Http\Controllers\API\LandingPage;

use App\Http\Controllers\Controller;
use App\Services\LandingPage\LandingPageGenerateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandingPageGenerateController extends Controller
{
    public function __construct(private LandingPageGenerateService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'prompt' => 'required|string',
            'campaign_id' => 'required|integer'
        ]);

        try {
            $result = $this->service->generate($data);
            return response()->json([
                'success' => true,
                'data' => $result,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error generating landing page', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Failed to generate landing page'
            ], 500);
        }
    }
}
