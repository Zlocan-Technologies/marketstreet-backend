<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PasswordReset extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'     => "required|email|exists:users",
            'password'  =>   'required|min:8|confirmed',
            'password_confirmation' => 'required',
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
