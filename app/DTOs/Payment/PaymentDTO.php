<?php

namespace App\DTOs\Payment;

class PaymentDTO
{
    public function __construct(
        public string $amount,
        public string $currency,
        public string $description,
        public string $customerMsisdn,
        public string $merchantMsisdn,
        public int $userId,
    ) {}
}
