<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateOrder extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            /*'subtotal' => 'required|integer',
            'shipping_cost' => 'required|integer',
            'subcharge' => 'required|integer',
            'total' => 'required|integer',
            'reference' => 'required|string',
            'payment_channel' => 'string',
            'cart.id' => 'required|integer',
            'cart.price' => 'required|integer',
            'cart.quantity' => 'required|integer'*/
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422)
        );
    }
}
