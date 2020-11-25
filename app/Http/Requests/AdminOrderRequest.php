<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminOrderRequest extends FormRequest
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
            'order.user_id' => 'required',
            'order.farm_id' => 'required',
            'order.address_id' => 'required',
            'order.receiver.name' => 'required',
            'order.receiver.mobile' => 'required|int|regex:/[0-9]{10}/|digits:10',
            'order.processing_option' => 'required',
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
            'order.user_id.required' => 'Select any user for whom you ordering',
            'order.farm_id.required' => 'Select any farm from where you want your order',
            'order.receiver.name.required' => 'Order Receiver name is required',
            'order.receiver.mobile.required' => 'Order Receiver mobile number is required',
            'order.processing_option.required' => 'Select any Order processing option',
            'order.address_id.required' => 'If you have any saved address, select one or add new address',
            'order.receiver.mobile.integer' => 'Receiver Mobile Number must be an integer like 3335812345',
            'order.receiver.mobile.regex' => 'Receiver Mobile Number is not in proper format Enter number like 3335812345',
            'order.receiver.mobile.digits' => 'Receiver Mobile Number must be 10 digits like 3335812345'
        ];
    }
}
