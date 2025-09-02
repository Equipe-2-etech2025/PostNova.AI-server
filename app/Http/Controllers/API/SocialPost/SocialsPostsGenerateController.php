<?php

namespace App\Http\Controllers\API\SocialPost;

use App\Http\Controllers\Controller;
use App\Services\SocialPost\SocialPostCreateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SocialsPostsGenerateController extends Controller
{
    public function __construct(
        private readonly SocialPostCreateService $socialPostCreateService
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'topic' => ['required', 'string'],
            'platforms' => ['required', 'array', 'in:linkedin,x,tiktok'],
            'campaign_id' => ['required', 'int', 'exists:campaigns,id'],
            'prompt_id' => ['required', 'int', 'exists:prompts,id'],
            'tone' => ['sometimes', 'string', 'in:professional,friendly,creative'],
            'language' => ['sometimes', 'string', 'in:french,english'],
            'hashtags' => ['sometimes', 'string'],
            'target_audience' => ['sometimes', 'string'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        try {
            $createdPosts = $this->socialPostCreateService->generateAndCreateForPlatforms([
                'topic' => $validated['topic'],
                'platforms' => $validated['platforms'],
                'tone' => $validated['tone'] ?? 'professional',
                'language' => $validated['language'] ?? 'french',
                'hashtags' => $validated['hashtags'] ?? '',
                'target_audience' => $validated['target_audience'] ?? '',
                'campaign_id' => $validated['campaign_id'],
                'prompt_id' => $validated['prompt_id'],
                'is_published' => $validated['is_published'] ?? false,
            ]);

            return response()->json([
                'success' => true,
                'generated' => true,
                'posts' => $createdPosts,
                'count' => count($createdPosts),
            ]);

        } catch (\Exception $e) {
            Log::error('Post generation failed', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate posts',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
