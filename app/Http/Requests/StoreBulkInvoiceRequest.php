<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBulkInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.customerId'=>['required',"integer"],
            '*.amount'=>['required',"integer"],
            '*.status'=>['required',Rule::in('B',"P","V","b","p","v")],
            '*.billedDate'=>['required',"date_format:Y-m-d H:i:s"],
            '*.paidDate'=>['date_format:Y-m-d H:i:s',"nullable"],
        ];
    }


    protected function prepareForValidation(){
        $data = [];
        foreach($this->toArray() as $obj){
            $obj["billed_date"] = $obj['billedDate'] ??null;
            $obj["customer_id"] = $obj['customerId'] ??null;
            $obj["paid_at"] = $obj['paidDate'] ??null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}
