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
            /*'subtotal' => [],
            'shipping_cost' => ['integer'],
            'subcharge' => [],
            'total' => [],
            'reference' => [],
            'payment_channel' => [],
            'coupon_code' => isset($request['coupon_code']) ? $request['coupon_code'] : NULL*/
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
