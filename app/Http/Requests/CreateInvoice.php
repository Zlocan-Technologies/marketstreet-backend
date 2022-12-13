<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateInvoice extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => ['required', 'integer'],
            'cart.id' => ['required', 'integer'],
            'cart.price' => ['required', 'integer'],
            'cart.quantity' => ['integer']
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
