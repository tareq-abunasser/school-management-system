<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'list_grades.*.name' => 'required|unique:grades,name->ar,' . $this->id,
            'list_grades.*.name_en' => 'required|unique:grades,name->en,' . $this->id,
            'list_grades.*.stage_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
            'name_en.required' => trans('validation.required'),
            'name_en.unique' => trans('validation.unique'),
            'stage_id.required' => trans('validation.required'),

        ];
    }

    protected $stopOnFirstFailure = true;

}
