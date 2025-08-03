<?php
namespace App\Http\Controllers\API\Auth\EmailVerification;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationStatusController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'verified' => $request->user()->hasVerifiedEmail(),
            'email' => $request->user()->email,
            'verified_at' => $request->user()->email_verified_at,
        ]);
    }
}
