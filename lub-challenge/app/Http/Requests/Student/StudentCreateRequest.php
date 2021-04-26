<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentCreateRequest extends FormRequest
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
     * Custom message for validation
     *
     * @return array
     */

    public function messages()
    {
        return [
            'number_registration.max' => 'You can not change this field.',
            'status.max' => 'You can not change this field.',
            'test_grade.max' => 'You can not change this field.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'series' => 'required|integer|max:11',
            'gender' => 'required|in:M,F',
            'age' => 'required|integer|between:1,999',
            'phone' => 'required|max:12',
            'cpf' => 'required|unique:student|size:11',
            'address' => 'required|max:250',
            'test_grade' => 'max:0',
            'status' => 'max:0'
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                "success" => false,
                "code" => 400,
                "error" => $validator->errors(),
            ], 400));
    }
}
