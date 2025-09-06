<?php

namespace App\Services;

use App\Models\Payment;
use App\DTOs\Payment\PaymentDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
 
class MvolaService
{
    private string $authUrl;
    private string $baseUrl;
    private string $partnerName;
    private string $partnerMsisdn;
    private string $clientId;
    private string $clientSecret;

    public function __construct()
    {   
        $this->authUrl = config('services.mvola.auth_url');
        $this->baseUrl = config('services.mvola.base_url');
        $this->partnerName = config('services.mvola.partner_name');
        $this->partnerMsisdn = config('services.mvola.partner_msisdn');
        $this->clientId = config('services.mvola.client_id');
        $this->clientSecret = config('services.mvola.client_secret');
    }

    private function authenticate(): string
    {
         if (cache()->has('mvola_access_token')) {
        return cache('mvola_access_token');
        }

        $response = Http::asForm()->post("{$this->authUrl}/oauth2/token", [
        "grant_type" => "client_credentials",
        "client_id" => $this->clientId,
        "client_secret" => $this->clientSecret,
        "scope" => config('services.mvola.scope'),
        ]);

        if ($response->failed()) {
            
            throw new \Exception("MVola authentication failed: " . $response->body());
        }  

            $data = $response->json();

            cache()->put('mvola_access_token', $data['access_token'], $data['expires_in'] - 60);

        return $data['access_token'];
    }

    public function initiatePayment(PaymentDTO $dto): Payment
    {
        $accessToken = $this->authenticate();
        $correlationId = (string) Str::uuid();
        $transactionReference = (string) Str::uuid();
        //$requestingOrganisationTransactionReference = (string) Str::uuid();
        $payload = [
        "amount" => $dto->amount,
        "currency" => $dto->currency,
        "descriptionText" => $dto->description,
        "requestDate" => Carbon::now()->format('Y-m-d\TH:i:s.v\Z'),
        "transactionReference" => $transactionReference,
        "debitParty"  => [["key" => "msisdn", "value" => $dto->customerMsisdn]],
        "creditParty" => [["key" => "msisdn", "value" => $dto->merchantMsisdn]],
        "metadata" => [["key" => "partnerName", "value" => $this->partnerName]],
        "requestingOrganisationTransactionReference" => (string) Str::uuid(),
        "originalTransactionReference" => (string) Str::uuid(),
        "debitParty" => [
            ["key" => "msisdn", "value" => $dto->customerMsisdn]
            ],
        "creditParty" => [
            ["key" => "msisdn", "value" => $dto->merchantMsisdn]
            ],
        "metadata" => [
            ["key" => "partnerName", "value" => $this->partnerName],
            ["key" => "transactionType", "value" => "MerchantPay"],
            ["key" => "fc", "value" => "USD"],
            ["key" => "amountFc", "value" => "1"]
            ],
        ];

        \Log::info('MVola Payment Request Payload', $payload);

        $response = Http::withHeaders([
            "Authorization" => "Bearer $accessToken",
            "Version" => 1,
            "X-CorrelationID" => $correlationId,
            "UserLanguage" => "mg",
            "partnerName" => "postnova",
            "Content-Type" => "application/json",
            "Cache-Control" => "no-cache"

        ])->post("{$this->baseUrl}/mvola/mm/transactions/type/merchantpay/1.0.0/", $payload);

        if ($response->failed()) {
            \Log::error('MVola Payment Failed', [
            'status' => $response->status(),
            'body' => $response->body(),
            'headers' => $response->headers()
            ]);
            throw new \Exception("Payment initiation failed");
        }

        $data = $response->json();

        \Log::info("Réponse MVola", ['status' => $response->status(), 'json' => $data]);


        return Payment::create([
            "user_id" => $dto->userId,
            "amount" => $dto->amount,
            "currency" => $dto->currency,
            "description" => $dto->description,
            "customer_msisdn" => $dto->customerMsisdn,
            "merchant_msisdn" => $dto->merchantMsisdn,
            "status" => $data['status'],
            "server_correlation_id" => $data['serverCorrelationId'],
            "transaction_reference" => $transactionReference,
        ]);
    }

    /*public function checkStatus(Payment $payment): array
    {
        $accessToken = $this->authenticate();
        $correlationId = (string) Str::uuid();

        $response = Http::withHeaders([
            "Authorization" => "Bearer $accessToken",
            "Version" => "1",
            "X-CorrelationID" => $correlationId,
            "UserLanguage" => "mg",
            "UserAccountIdentifier" => "msisdn;{$this->partnerMsisdn}",
            "partnerName" => $this->partnerName,
            "Cache-Control" => "no-cache"
        ])->get("{$this->baseUrl}/mvola/mm/transactions/type/merchantpay/1.0.0/status/{$payment->server_correlation_id}");

        if ($response->failed()) {
            \Log::error("MVola checkStatus failed", [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            throw new \Exception("Failed to check payment status");
        }

        $data = $response->json();

        // ⚡ Met à jour seulement si pas pending
        if (!empty($data['status']) && $data['status'] !== 'pending') {
            $payment->update(['status' => $data['status']]);
        }

        return $data;
    }*/

}
