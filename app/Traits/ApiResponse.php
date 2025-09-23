<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($data, int $code = 200) : JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ], $code);
    }

    public function fail($message, int $code = 400, array $errors = []) : JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if (empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}