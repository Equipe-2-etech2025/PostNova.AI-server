<?php

namespace App\Http\Controllers\API\Mvola;

use App\DTOs\Payment\PaymentDTO;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\MvolaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DTOs\TarifUser\TarifUserDto;
use App\Services\Interfaces\TarifUserServiceInterface;
use Carbon\Carbon;

class PaymentController extends Controller
{
    private MvolaService $mvola;
    private TarifUserServiceInterface $tarifUserService;

    public function __construct(MvolaService $mvola, TarifUserServiceInterface $tarifUserService)
    {
        $this->mvola = $mvola;
        $this->tarifUserService = $tarifUserService;
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|string',
                'currency' => 'nullable|string',
                'description' => 'required|string',
                'customer_msisdn' => 'required|string',
                'merchant_msisdn' => 'required|string',
            ]);
            $userId = Auth::id();
            $dto = new PaymentDTO(
                amount: $request->amount,
                currency: $request->currency ?? 'Ar',
                description: $request->description,
                customerMsisdn: $request->customer_msisdn,
                merchantMsisdn: $request->merchant_msisdn,
                userId: $userId,
            );

            $payment = $this->mvola->initiatePayment($dto);

            $now = Carbon::now();
            $tarifUserDto = new TarifUserDto(
                id: null,
                tarif_id: 2, //Pro
                user_id: $userId,
                created_at: $now,
                expired_at: $now->copy()->addMonth()
            );

            $this->tarifUserService->createTarifUser($tarifUserDto);


            return response()->json($payment);
        } catch (\Exception $e) {
            \Log::error('Payment error: '.$e->getMessage());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listUserPayments(Request $request)
    {
        $user = $request->user();

        $payments = Payment::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get(['amount', 'currency', 'transaction_reference', 'created_at']);

        return response()->json($payments);
    }
}
