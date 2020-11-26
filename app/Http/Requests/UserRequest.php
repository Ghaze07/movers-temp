<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'user.name' => 'required',
            'user.email' => 'nullable|email|unique:users,email',
            'user.mobile' => 'required|unique:users,mobile|int|regex:/[0-9]{10}/|digits:10',
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
            'user.name.required' => 'Your name is required',
            'user.mobile.required' => 'Your Mobile number is required',
            'user.email.email' => 'Your email must be an email',
            'user.email.unique' => 'This Email is already Taken',
            'user.mobile.unique' => 'This Mobile number is already Taken',
            'user.mobile.integer' => 'Receiver Mobile Number must be an integer like 3335812345',
            'user.mobile.regex' => 'Receiver Mobile Number is not in proper format Enter number like 3335812345',
            'user.mobile.digits' => 'Receiver Mobile Number must be 10 digits like 3335812345',
        ];
    }
}
