<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'address.user_id' => 'required',
            'address.city_id' => 'required',
            'address.complete_address' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'address.user_id' => 'Select user before address',
            'address.city_id.required' => 'Your City is required',
            'address.complete_address.required' => 'Your Complete Address is required',
        ];
    }
}
