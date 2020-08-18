<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class PageRequest extends FormRequest
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
            'title' => 'required|max:1024',
            'homedescription' => 'required|max:3000',
            'description' => 'required|max:8000',
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
            'value.required' => __('messages.title') . __('validation.required'),
            'value.required' => __('messages.homedescription') . __('validation.required'),
            'value.required' => __('messages.description') . __('validation.required'),
            /* 'value.max' => __('messages.value') . __('validation.max.string'),
             'value.key' => __('messages.key') . __('validation.max.string'),
             'value.name' => __('messages.name') . __('validation.max.string'),*/
        ];
    }

}
