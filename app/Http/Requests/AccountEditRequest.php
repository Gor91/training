<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Validator;

class AccountEditRequest extends FormRequest
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
     *
     */
    protected function prepareForValidation(): void
    {
        $bday = (strlen($this->bday) > 10)
            ?
            date('d-m-Y', strtotime($this->convert_day($this->bday)))
            :
            date('d-m-Y', strtotime($this->bday));
        $this->merge([
            'bday' => $bday
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $year = date("Y") - 16;
        return [

            'phone' => 'required|min:8|max:11',
            'bday' => 'required|date|date_format:d-m-Y|before:' . $year,
            'h_region' => 'required|integer',
            'w_region' => 'required|integer',
            'w_territory' => 'required|integer',
            'h_territory' => 'required|integer',
            'w_street' => 'required|min:2|max:127',
            'h_street' => 'required|min:2|max:127',
            'workplace_name' => 'required|min:2|max:127',
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

            'phone.required' => __('messages.phone') . __('validation.required'),
            'phone.min' => __('messages.phone') . __('validation.min.string'),
            'phone.max' => __('messages.phone') . __('validation.max.string'),
            'passport.required' => __('messages.passport') . __('validation.required'),
            'passport.min' => __('messages.passport') . __('validation.min.string'),
            'passport.max' => __('messages.passport') . __('validation.max.string'),
            'workplace_name.required' => __('messages.workplace_name') . __('validation.required'),
            'workplace_name.min' => __('messages.workplace_name') . __('validation.min.string'),
            'workplace_name.max' => __('messages.workplace_name') . __('validation.max.string'),
            'h_region.required' => __('messages.h_region') . __('validation.required'),
            'w_region.required' => __('messages.w_region') . __('validation.required'),
            'h_territory.required' => __('messages.h_territory') . __('validation.required'),
            'w_territory.required' => __('messages.w_territory') . __('validation.required'),
            'bday.required' => __('messages.bday') . __('validation.required'),
            'bday.date_format' => __('messages.bday') . __('validation.date_format'),
        ];
    }

    public function convert_day($d)
    {

        $day = explode(" ", $d);
        return $day['1'] . " " . $day['2'] . " " . $day['3'];
    }

    public function withValidator(Validator $validator)
    {
//        dd($validator->fails());
    }
}
