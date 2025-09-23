<?php

namespace App\Services\v2\AIModel;

class ApiModelAI
{
    public static function request
    (
        string $prompt,
        ?string $model = 'gemini'
    ): string {
        // if ($model === 'gemini') {
        //     return GoogleGemini::request($prompt, $timeout, $retry, $sleepMilliseconds);
        // }
        return GoogleGemini::request($prompt);
    }
}
