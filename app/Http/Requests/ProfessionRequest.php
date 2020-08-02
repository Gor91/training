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
            'specialty_id' => 'required|integer',
            'education_id' => 'required|integer',
            'profession' => 'required|integer',
            'member_of_palace' => 'integer|nullable',
            'diploma_1' => 'required|image',
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
            'specialty_id.required' => __('messages.specialty_name') . __('validation.required'),
            'specialty_id.integer' => __('messages.specialty_name') . __('validation.integer'),
            'education_id.required' => __('messages.education__name') . __('validation.required'),
            'education_id.integer' => __('messages.education__name') . __('validation.integer'),
            'profession.required' => __('messages.profession') . __('validation.required'),
//            'member_of_palace.required' => __('messages.member_of_palace') . __('validation.required'),
            'member_of_palace.integer' => __('messages.member_of_palace') . __('validation.integer'),
            'diploma_1.required' => __('messages.diploma') . __('validation.required'),
            'diploma_1.image' => __('messages.diploma') . __('validation.image'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'member_of_palace' => (bool)$this->member_of_palace
        ]);
          }

}
