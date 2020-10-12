<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountVideoRequest extends FormRequest
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
            'id' => 'required|integer|min:1',
            'user_id' => 'required|integer|min:1',
            'point' => 'required|numeric|min:1',
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
            'id.required' => __('messages.id') . __('validation.required'),
            'id.min' => __('messages.id') . __('validation.min.string'),

            'user_id.required' => __('messages.user_id') . __('validation.required'),
            'user_id.min' => __('messages.user_id') . __('validation.min.string'),

            'point.required' => __('messages.point') . __('validation.required'),

        ];
    }
}
