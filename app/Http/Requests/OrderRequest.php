<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class OrderRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($request->address) {
            return [
                'address.city' => 'required',
                'address.complete_address' => 'required',
                'order.receiver.name' => 'required',
                'order.receiver.mobile' => 'required|int|regex:/[0-9]{10}/|digits:10',
                'order.processing_option' => 'required',
            ];
        } else {
            return [
                'order.address_id' => 'required',
                'order.receiver.name' => 'required',
                'order.receiver.mobile' => 'required|int|regex:/[0-9]{10}/|digits:10',
                'order.processing_option' => 'required',
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'address.city.required' => 'Select your City where you want to receive',
            'address.complete_address.required' => 'Your Complete address is required',
            'order.receiver.name.required' => 'Order Receiver name is required',
            'order.receiver.mobile.required' => 'Order Receiver mobile number is required',
            'order.processing_option.required' => 'Select any Order processing option',
            'order.address_id.required' => 'If you have any saved address, select one or add new address',

            'order.receiver.mobile.integer' => 'Receiver Mobile Number must be an integer like 3335812345',
            'order.receiver.mobile.regex' => 'Receiver Mobile Number is not in proper format Enter number like 3335812345',
            'order.receiver.mobile.digits' => 'Receiver Mobile Number must be 10 digits like 3335812345',


        ];
    }
}
