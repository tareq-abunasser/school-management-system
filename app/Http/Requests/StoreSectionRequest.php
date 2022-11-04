<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
            'section_name_ar' => 'required',
            'section_name_en' => 'required',
            'Stage_id' => 'required',
            'grade_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'section_name_ar.required' => trans('Sections_trans.required_ar'),
            'section_name_en.required' => trans('Sections_trans.required_en'),
            'Stage_id.required' => trans('Sections_trans.Stage_id_required'),
            'Grade_id.required' => trans('Sections_trans.Grade_id_required'),
        ];
    }
}
