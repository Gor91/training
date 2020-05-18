<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionRequest extends FormRequest
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
            'specialty' => 'required|integer',
            'edu' => 'required|integer',
            'prof' => '|in:doctor, nurse, pharmacist, provider',
            'palace' => 'required|bool',
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
            'specialty_id.required' =>  __('messages.specialty_name') . __('validation.required'),
            'specialty_id.integer' =>  __('messages.specialty_name') . __('validation.integer'),
            'education_id.required' => __('messages.education__name'). __('validation.required'),
            'education_id.integer' => __('messages.education__name'). __('validation.integer'),
            'profession.required' => __('messages.profession') . __('validation.required'),
            'member_of_palace.required' => __('messages.member_of_palace') . __('validation.required'),
            'member_of_palace.boolean' => __('messages.member_of_palace') . __('validation.boolean'),
        ];
    }

}
