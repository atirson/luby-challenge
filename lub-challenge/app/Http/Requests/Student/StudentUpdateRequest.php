<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentUpdateRequest extends FormRequest
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
            'test_grade.max' => 'You can not change this field.',
            'id.exists' => 'ID of Student does not exists!.',
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
            'id' => 'exists:App\Models\Student,id',
            'name' => 'max:255',
            'series' => 'max:11',
            'gender' => 'in:M,F',
            'age' => 'integer|between:1,999',
            'phone' => 'max:12',
            'cpf' => 'size:11',
            'address' => 'max:250',
            'test_grade' => 'max:0',
            'status' => 'max:0',
            'number_registration' => 'max:0'
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
