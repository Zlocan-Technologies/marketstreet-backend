<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'coupon_code' => 'required|string|max:225',
            'coupon_type' => 'nullable|string|max:225',
            'coupon_value' => 'nullable',
            'percent_off' => 'nullable',
        ];
    }
}
