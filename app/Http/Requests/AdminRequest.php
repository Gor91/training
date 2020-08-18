<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class AdminRequest extends FormRequest
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
            'name' => 'required|min:2|max:127',
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|confirmed|alphaNum|min:8', // password can only be alphanumeric and has to be greater than 3 characters
            'password_confirmation' => 'sometimes|required_with:password',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        $name = __('messages.name');
        $email = __('messages.email_field');
        $password = __('messages.password_field');
        return [
            'name.required' => $name . __('validation.required'),
            'name.min' => $name . __('validation.min.string'),
            'name.max' => $name . __('validation.max.string'),
            'email.required' => $email . __('validation.required'),
            'password.required' => $password . __('validation.required'),
            'password.min' => $password . __('validation.min.string'),
            'email.email' => $email . __('validation.email'),

        ];
    }
}
