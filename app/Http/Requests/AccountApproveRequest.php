<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountApproveRequest extends FormRequest
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


        $this->merge([
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
            'passport' => 'required|min:2|max:127',
            'date_of_issue' => 'required|date|date_format:d-m-Y',
            'date_of_expiry' => 'required|date|date_format:d-m-Y|after:date_of_issue',
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
            'passport.required' => __('messages.passport') . __('validation.required'),
            'passport.min' => __('messages.passport') . __('validation.min.string'),
            'passport.max' => __('messages.passport') . __('validation.max.string'),
            'date_of_issue.required' => __('messages.date_of_issue') . __('validation.required'),
            'date_of_issue.date_format' => __('messages.date_of_issue') . __('validation.date_format'),
            'date_of_expiry.required' => __('messages.date_of_expiry') . __('validation.required'),
            'date_of_expiry.date_format' => __('messages.date_of_expiry') . __('validation.date_format'),
        ];
    }

    public function convert_day($d)
    {

        $day = explode(" ", $d);
        return $day['1'] . " " . $day['2'] . " " . $day['3'];
    }

}
