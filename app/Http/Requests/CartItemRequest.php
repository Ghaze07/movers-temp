<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
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
            'cart_item.farm_product_id' => 'required',
            'cart_item.quantity' => 'required',
            'cart_item.user_id' => 'required',
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
            'cart_item.farm_product_id.required' => 'Select a Farm product',
            'cart_item.quantity.required' => 'Select quantity for Farm product',
            'cart_item.user_id.required' => 'Select a User',
        ];
    }
}
