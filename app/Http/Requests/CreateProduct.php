<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProduct extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => ['required', 'integer'],
            'name' => "required|string",
            'brand' => "required|string",
            'quantity' => 'integer',
            'price' => ['required', 'numeric'],
            'description' => 'required',
            'shipping_cost' => ['required', 'numeric'],
            'is_negotiable' => 'integer',
            'id' => 'integer'
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
