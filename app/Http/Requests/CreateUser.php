<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUser extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname'   =>  "required|string|max:50",
            'lastname'     =>  "required|string|max:70",
            'email'     => "required|email|max:255|unique:users,email",
            'phone' => ['required', 'numeric', 'min:11', 'unique:users,phone'],
            'password'  =>   'required|min:8',
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
