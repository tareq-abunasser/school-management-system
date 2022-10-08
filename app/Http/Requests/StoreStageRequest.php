<?php

namespace App\Http\Requests;

use App\http\Controllers\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class StoreStageRequest extends FormRequest
{
    use ApiResponseTrait;

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
            'name' => 'required|unique:stages,name->ar,' . $this->id,
            'name_en' => 'required|unique:stages,name->en,' . $this->id,
        ];
    }


// if you want to overwrite the validation response

//    public function failedValidation(Validator $validator)
//
//    {
//          // or if($this->wantsJson()){}
////        if (Request::wantsJson()) {
////            throw new HttpResponseException($this->api_response(null, $validator->errors(), 400));
////        }
//
////        if (Request::wantsJson()) {
////
////            throw new HttpResponseException(response()->json([
////
////                'success' => false,
////
////                'message' => 'Validation errors',
////
////                'data' => $validator->errors()
////
////            ]));
////        }
//
//
//    }


    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
            'name_en.required' => trans('validation.required'),
            'name_en.unique' => trans('validation.unique'),

        ];
    }

    protected $stopOnFirstFailure = true;

}
