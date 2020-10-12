<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class AccountRequest extends FormRequest
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
        $expiry = (strlen($this->date_of_expiry) > 10)
            ?
            date('d-m-Y', strtotime($this->convert_day($this->date_of_expiry)))
            :
            date('d-m-Y', strtotime($this->date_of_expiry));

        $issue = (strlen($this->date_of_issue) > 10)
            ?
            date('d-m-Y', strtotime($this->convert_day($this->date_of_issue)))
            : date('d-m-Y', strtotime($this->date_of_issue));

        $bday = (strlen($this->bday) > 10)
            ?
            date('d-m-Y', strtotime($this->convert_day($this->bday)))
            :
            date('d-m-Y', strtotime($this->bday));
        $this->merge([
            'bday' => $bday,
            'date_of_issue' => $issue,
            'date_of_expiry' => $expiry,
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
            'name' => 'required|min:2|max:127',
            'surname' => 'required|min:2|max:127',
            'father_name' => 'required|min:2|max:127',
            'phone' => 'min:8|max:11',
            'passport' => 'required|min:2|max:127',
            'bday' => 'required|date|date_format:d-m-Y|before:' . $year,
            'date_of_issue' => 'required|date|date_format:d-m-Y',
            'date_of_expiry' => 'required|date|date_format:d-m-Y|after:date_of_issue',
            'h_region' => 'required|integer|min:1',
            'w_region' => 'required|integer|min:1',
            'w_territory' => 'required|integer|min:1',
            'h_territory' => 'required|integer|min:1',
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
            'name.required' => __('messages.name') . __('validation.required'),
            'name.min' => __('messages.name') . __('validation.min.string'),
            'name.max' => __('messages.name') . __('validation.max.string'),
            'surname.required' => __('messages.surname') . __('validation.required'),
            'surname.min' => __('messages.surname') . __('validation.min.string'),
            'surname.max' => __('messages.surname') . __('validation.max.string'),
            'father_name.required' => __('messages.father_name') . __('validation.required'),
            'father_name.min' => __('messages.father_name') . __('validation.min.string'),
            'father_name.max' => __('messages.father_name') . __('validation.max.string'),
            'phone.required' => __('messages.phone') . __('validation.required'),
            'phone.min' => __('messages.phone') . __('validation.min.string'),
            'phone.max' => __('messages.phone') . __('validation.max.string'),
            'passport.required' => __('messages.passport') . __('validation.required'),
            'passport.min' => __('messages.passport') . __('validation.min.string'),
            'passport.max' => __('messages.passport') . __('validation.max.string'),
            'workplace_name.required' => __('messages.workplace_name') . __('validation.required'),
            'workplace_name.min' => __('messages.workplace_name') . __('validation.min.string'),
            'workplace_name.max' => __('messages.workplace_name') . __('validation.max.string'),
            'image_name.required' => __('messages.image_name') . __('validation.required'),
            'image_name.min' => __('messages.image_name') . __('validation.min.string'),
            'image_name.max' => __('messages.image_name') . __('validation.max.string'),
            'bday.required' => __('messages.bday') . __('validation.required'),
            'bday.date_format' => __('messages.bday') . __('validation.date_format'),
            'date_of_issue.required' => __('messages.date_of_issue') . __('validation.required'),
            'date_of_issue.date_format' => __('messages.date_of_issue') . __('validation.date_format'),
            'date_of_expiry.required' => __('messages.date_of_expiry') . __('validation.required'),
            'date_of_expiry.date_format' => __('messages.date_of_expiry') . __('validation.date_format'),
            'h_region.required' => __('messages.region') . __('validation.required'),
            'w_region.required' => __('messages.region') . __('validation.required'),
            'w_territory.required' => __('messages.territory') . __('validation.required'),
            'h_territory.required' => __('messages.territory') . __('validation.required'),
            'w_street.required' => __('messages.street') . __('validation.required'),
            'h_street.required' => __('messages.street') . __('validation.required'),
        ];
    }

    public function convert_day($d)
    {

        $day = explode(" ", $d);
        return $day['1'] . " " . $day['2'] . " " . $day['3'];
    }

}
