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
            'profession' => '|in:doctor, nurse, pharmacist, provider',
            'palace' => 'required|bool|nullable',
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
            'palace.required' => __('messages.member_of_palace') . __('validation.required'),
            'palace.boolean' => __('messages.member_of_palace') . __('validation.boolean'),
            'diploma_1.required' => __('messages.diploma') . __('validation.required'),
            'diploma_1.image' => __('messages.diploma') . __('validation.image'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'palace' => (bool)$this->palace
        ]);
          }

}
