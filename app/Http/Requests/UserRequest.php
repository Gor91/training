<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class UserRequest extends FormRequest
{
    /**
     * @param array $errors
     * @return mixed
     */
    public function response(array $errors)
    {
        return Redirect::back()->withErrors($errors)->withInput();
    }

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
            'email' => 'required|email|unique:users,id',
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

        $email = __('messages.email');
        $phone = __('messages.phone');
        $group = __('messages.group');
        return [

            'email.required' => $email . __('validation.required'),
            'password.required' => __('messages.password') . __('validation.required'),
            're_password.required' => __('messages.password') . __('validation.required'),
            'email.email' => $email . __('validation.email'),
            'email.unique' => __('validation.unique'),
//            'phone.required' => $phone . __('validation.required'),
//            'group.required' => $group . __('validation.required'),
//            'phone.numeric' => $phone . __('validation.numeric'),
//            'group.numeric' => $group . __('validation.numeric'),
////            'phone.size' => $phone . __('validation.size.numeric'),
//            'file.image' => __('validation.image'),
        ];
    }
}
