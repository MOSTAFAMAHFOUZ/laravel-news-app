<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGatway;

class PayOrderController extends Controller
{

    public function index(PaymentGatway $paymentGatway)
    {
        dd($paymentGatway->charge(1500));
    }


    public function sendService()
    {
    }
}
