<?php

namespace App\Http\Controllers;

use App\Exceptions\Validador;
use App\Http\Requests\Student\StudentTestGrade\StudentTestGradeRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\StudentServices;

class StudentTestGradeController extends Controller {
    /**
     * Method to add a test grade to Student
     * @param StudentTestGradeRequest $request
     * @return Student|\Illuminate\Http\JsonResponse
     */
    public function addTestGrade(StudentTestGradeRequest $request) {
        return (new StudentServices)->addTestGrade($request->all());
    }
}
