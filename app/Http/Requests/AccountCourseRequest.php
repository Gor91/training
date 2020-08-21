<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountCourseRequest extends FormRequest
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
            /*'title' => 'required|max:1024',
            'homedescription' => 'required|max:3000',
            'description' => 'required|max:8000',*/
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
            /*'value.required' => __('messages.title') . __('validation.required'),
            'value.required' => __('messages.homedescription') . __('validation.required'),
            'value.required' => __('messages.description') . __('validation.required'),*/

        ];
    }

}
