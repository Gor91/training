<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'name' => 'required|min:2|max:127',
            'surname' => 'required|min:2|max:127',
            'father_name' => 'required|min:2|max:127',
            'gender' => 'in:male,female',
            'bday' => 'required|date|date_format:DD-MM-YYYY',
            'married_status' => 'in:married,single',
            'phone'=>'required|min:8|max:11',
            'passport'=>'required|min:2|max:127',
            'date_of_issue'=>'required|date|date_format:DD-MM-YYYY',
            'date_of_expiry'=>'required|date|date_format:DD-MM-YYYY|after:date_of_issue',
            'home_address',
            'work_address',
            'workplace_name'=> 'required|min:2|max:127',
            'image_name'=>'required|min:2|max:191',

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
            'name.required' => __('messages.name') . __('validation.required'),
            'name.min' =>__('messages.name') . __('validation.min.string'),
            'name.max' => __('messages.name') . __('validation.max.string'),
            'surname.required' => __('messages.surname') . __('validation.required'),
            'surname.min' =>__('messages.surname') . __('validation.min.string'),
            'surname.max' => __('messages.surname') . __('validation.max.string'),
            'father_name.required' => __('messages.father_name') . __('validation.required'),
            'father_name.min' =>__('messages.father_name') . __('validation.min.string'),
            'father_name.max' => __('messages.father_name') . __('validation.max.string'),
            'phone.required' => __('messages.phone') . __('validation.required'),
            'phone.min' =>__('messages.phone') . __('validation.min.string'),
            'phone.max' => __('messages.phone') . __('validation.max.string'),
            'passport.required' => __('messages.passport') . __('validation.required'),
            'passport.min' =>__('messages.passport') . __('validation.min.string'),
            'passport.max' => __('messages.passport') . __('validation.max.string'),
            'workplace_name.required' => __('messages.workplace_name') . __('validation.required'),
            'workplace_name.min' =>__('messages.workplace_name') . __('validation.min.string'),
            'workplace_name.max' => __('messages.workplace_name') . __('validation.max.string'),
            'image_name.required' => __('messages.image_name') . __('validation.required'),
            'image_name.min' =>__('messages.image_name') . __('validation.min.string'),
            'image_name.max' => __('messages.image_name') . __('validation.max.string'),
            'gender.required' => __('messages.image_name') . __('validation.required'),
            'married_status.required' => __('messages.image_name') . __('validation.required'),
            'bday.required' => __('messages.bday') . __('validation.required'),
            'bday.date_format' => __('messages.bday') . __('validation.date_format'),
            'date_of_issue.required' => __('messages.date_of_issue') . __('validation.required'),
            'date_of_issue.date_format' => __('messages.date_of_issue') . __('validation.date_format'),
            'date_of_expiry.required' => __('messages.date_of_expiry') . __('validation.required'),
            'date_of_expiry.date_format' => __('messages.date_of_expiry') . __('validation.date_format'),

        ];
    }
}
