<?php
namespace App\Http\Controllers\API\Mvola;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
   
    public function listAllPayments()
    {
        $payments = Payment::with('user:id,name,email')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($payment) {
                return [
                    'id' => $payment->id,
                    'username' => $payment->user->name ?? '—',
                    'amount' => $payment->amount,
                    'currency' => $payment->currency,
                    'created_at' => $payment->created_at,
                    'expiration_date' => $payment->created_at->copy()->addDays(30),
                    'transaction_reference' => $payment->transaction_reference,
                ];
            });

        return response()->json($payments);
    }
}
