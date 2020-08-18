<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class AuthRequest extends FormRequest
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
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:8', // password can only be alphanumeric and has to be greater than 3 characters
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        $email = __('messages.email_field');
        $password = __('messages.password_field');
        return [

            'password.required' => $password . __('validation.required'),
            'password.min' => $password . __('validation.min.string'),
            'email.email' => $email . __('validation.email'),

        ];
    }
}
