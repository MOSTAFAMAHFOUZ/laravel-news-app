<?php
namespace App\Filters\Api;

use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter{

    protected $safeParams = [
        'name'=>['eq'],
        'type'=>['eq'],
        'email'=>['eq'],
        'address'=>['eq'],
        'city'=>['eq'],
        'state'=>['eq'],
        'postalCode'=>['eq','gt','lt'],
    ];

    protected $columnMap = [
        'postalCode'=>'postal_code'
    ];

}
