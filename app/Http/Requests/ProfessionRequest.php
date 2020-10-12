<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class ProfessionRequest extends FormRequest
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
            'specialty_id' => 'required|integer',
            'education_id' => 'required|integer',
            'profession' => 'required|integer',
            'member_of_palace' => 'boolean',
            'diploma_1' => 'image',
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
            'specialty_id.required' => __('messages.specialty') . __('validation.required'),
            'specialty_id.integer' => __('messages.specialty') . __('validation.integer'),
            'education_id.required' => __('messages.education') . __('validation.required'),
            'education_id.integer' => __('messages.education') . __('validation.integer'),
            'profession.required' => __('messages.profession') . __('validation.required'),
            'member_of_palace.boolean' => __('messages.member_of_palace') . __('validation.boolean'),
            'diploma_1.required' => __('messages.diploma') . __('validation.required'),
            'diploma_1.image' => __('messages.diploma') . __('validation.image'),
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->member_of_palace === "true")
            $this->merge([
                'member_of_palace' => 1
            ]);
        else
            $this->merge([
                'member_of_palace' => 0
            ]);
    }

}
