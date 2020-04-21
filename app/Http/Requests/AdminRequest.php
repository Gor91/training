<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;

class AdminRequest extends FormRequest
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
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:5' // password can only be alphanumeric and has to be greater than 3 characters
        ];
    }

    public function messages()
    {
        $email = Lang::get('messages.email_field');
        $password = Lang::get('messages.password_field');
        return [

            'email.required' => $email . Lang::get('validation.required'),
            'password.required' => $password . Lang::get('validation.required'),
            'password.min' => $password . Lang::get('validation.min.string'),
            'email.email' => $email . Lang::get('validation.email'),

        ];
    }
}
