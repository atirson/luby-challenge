<?php

namespace App\Http\Controllers;

use App\Exceptions\Validador;
use App\Http\Requests\Student\StudentCreateRequest;
use App\Http\Requests\Student\StudentDeleteRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\StudentServices;

class StudentController extends Controller {

    /**
     * @return Student[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list() {
        return json_encode(['students' => Student::all()]);
    }

    /**
     * @param StudentCreateRequest $request
     * @return Student|string
     */
    public function create(StudentCreateRequest $request) {
        $student = (new StudentServices)->create($request->all());

        return $student;
    }

    /**
     * @param StudentUpdateRequest $request
     * @return string
     */
    public function update(StudentUpdateRequest $request) {
        $student = (new StudentServices)->update($request->all());

        return $student;
    }

    /**
     * @param StudentDeleteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(StudentDeleteRequest $request) {
        return (new StudentServices)->delete($request->all());
    }
}
