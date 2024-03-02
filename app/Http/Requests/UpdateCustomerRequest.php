<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
        if($this->method() == "PUT"){
            return [
                'name' => ['required', 'string'],
                'email' => ['required', 'email'],
                'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
                'address' => ['required', 'string'],
                'city' => ['required', 'string'],
                'state' => ['required', 'string'],
                'postal_code' => ['required', 'string'],
            ];
        }else{
            return [
                'name' => ['sometimes','required', 'string'],
                'email' => ['sometimes','required', 'email'],
                'type' => ['sometimes','required', Rule::in(['I', 'B', 'i', 'b'])],
                'address' => ['sometimes','required', 'string'],
                'city' => ['sometimes','required', 'string'],
                'state' => ['sometimes','required', 'string'],
                'postal_code' => ['sometimes','required', 'string'],
            ];
        }

    }


    public function prepareForValidation()
    {
        if($this->postalCode){
            $this->merge([
                'postal_code' => $this->postalCode
            ]);
        }

    }
}
