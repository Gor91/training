<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            're_password' => 'required|min:6|same:password',


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


            'old_password.required' => __('messages.old_password') . __('validation.required'),
            'password.required' => __('messages.password') . __('validation.required'),
            're_password.required' => __('messages.re_password') . __('validation.required'),

        ];
    }
}
