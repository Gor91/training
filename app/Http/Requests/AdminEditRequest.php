<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class AdminEditRequest extends FormRequest
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
            'name' => 'required|min:2|max:127',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        $email = __('messages.email_field');
        $name = __('messages.name');
        return [

            'email.required' => $email . __('validation.required'),
            'name.required' => $name . __('validation.required'),
            'name.min' => $name . __('validation.min.string'),
            'name.max' => $name . __('validation.max.string'),
            'email.email' => $email . __('validation.email'),

        ];
    }
}
