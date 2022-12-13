<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password'  =>   'required',
            'password'  =>   'required|min:8',
            'confirm_password' => 'required|same:new_password',
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
