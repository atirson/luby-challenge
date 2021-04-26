<?php

namespace App\Http\Requests\Student\StudentTestGrade;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Student;

class StudentTestGradeRequest extends FormRequest
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
            'id.exists' => 'ID of Student does not exists!.',
            '*.max' => 'You can not change this field.'
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
            'test_grade' => 'required|integer|between:1,10',
            'name' => 'max:0',
            'series' => 'max:0',
            'gender' => 'max:0',
            'age' => 'max:0',
            'phone' => 'max:0',
            'cpf' => 'max:0',
            'address' => 'max:0',
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
