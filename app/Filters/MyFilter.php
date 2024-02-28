<?php
namespace App\Filters;



class MyFilter{

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
    protected $operatorMap = [
        'eq'=>'=',
        'gt'=>'>',
        'lt'=>'<',
        'gte'=>'>=',
        'lte'=>'>=',
        'eq'=>'=',
        'ne'=>'!=',
    ];


    public function transform($request){
        $eloQuery = [];

        foreach($this->safeParams as $param => $operators){
            $query = $request->query($param);
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$param] ?? $param;

            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[] = [$column,$this->operatorMap[$operator],$query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
