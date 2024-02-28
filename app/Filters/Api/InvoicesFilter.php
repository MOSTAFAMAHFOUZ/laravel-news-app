<?php
namespace App\Filters\Api;

use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter{

    protected $safeParams = [
        'customer'=>['eq','ne'],
        'amount'=>['eq','gt','lt','ne'],
        'status'=>['eq','ne'],
        'billedDate'=>['eq','gt','lt','ne'],
        'paidAt'=>['eq','gt','lt','ne'],
    ];

    protected $columnMap = [
        'customer'=>'customer_id',
        'billedDate'=>'billed_date',
        'paidAt'=>'paid_at',
    ];



}
