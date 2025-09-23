<?php

namespace App\Services\v2\AIModel;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleGemini
{
    public static function request(
        string $prompt,
        ?int $timeout = 120,
        ?int $retry = 3,
        ?int $sleepMilliseconds = 2000
    ): string {
        try {
            $response = Http::timeout($timeout)
                ->connectTimeout(10)
                ->retry($retry, $sleepMilliseconds)
                ->post(config('services.gemini.api_url') . '?key=' . config('services.gemini.api_key'), [
                    'contents' => [
                        'parts' => [
                            ['text' => $prompt],
                        ],
                    ],
                    'generationConfig' => ['maxOutputTokens' => 10000]
                ]);

            if (!$response->successful()) {
                throw new \Exception('Gemini API failed ' . $response);
            }

            $data = $response->json();
            return $data['candidates'][0]['content']['parts'][0]['text'];
        } catch (ConnectionException $e) {
            Log::error('Gemini error', ['response' => $e->getMessage()]);
            throw new ConnectionException('Gemini API exception ' . $e->getMessage());
        }
    }
}
