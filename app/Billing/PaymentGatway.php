<?php

namespace App\Billing;

class PaymentGatway
{

    private $currency;
    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    public function charge($amount)
    {
        return [
            "amount" => $amount,
            'currency' => $this->currency
        ];
    }
}
