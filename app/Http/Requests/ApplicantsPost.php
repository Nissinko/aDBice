<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantsPost extends FormRequest
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
            'name' => 'required',
            'furigana' => 'required',
            'gender' => 'required',
            'age' => 'required|integer',
            'prefecture' => 'required',
            'phone' => 'required',
            'company' => 'required',
            'company_num' => 'required|integer',
            'education' => 'required',
            'job_class' => 'required',
            'gyoukai' => 'required',
            'salary' => 'required',
            'hope_place' => 'required',
            'hope_gyoukai' => 'required',
            'hope_job_class' => 'required'
        ];
    }
}
