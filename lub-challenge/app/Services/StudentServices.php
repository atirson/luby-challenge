<?php
namespace App\Services;

use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentServices {
    /**
     * Method to create a New Student
     * @param $data
     * @return Student|string
     */
    public function create($data) {
        try {
            $data['number_registration'] = strtoupper(substr($data['name'], -1)) . date_timestamp_get(now());

            $student = new Student($data);

            $student->save();

            return $student;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Method to update a Student
     *
     * @param $data
     * @return string
     */
    public function update($data) {
        try {
            $student = (new StudentRepository)->getStudentByID($data['id']);

            $cpfAlreadyUse = (new StudentRepository)->getStudentByCPF($data['cpf']);

            if($cpfAlreadyUse && $student->cpf != $data['cpf']) {
                return response()
                    ->json([
                        "success" => false,
                        "code" => 400,
                        "error" => 'CPF already in using!',
                    ], 400);
            }

            $student->update($data);

            return $student;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($data)
    {
        try {
            $student = (new StudentRepository)->getStudentByID($data['id']);

            $student->delete();

            return response()
                ->json([
                    "success" => false,
                    "code" => 200,
                    "message" => 'Student deleted with success!',
                ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * @param $data
     * @return Student|\Illuminate\Http\JsonResponse
     */
    public function addTestGrade($data) {
        try {
            $student = (new StudentRepository)->getStudentByID($data['id']);

            $data['status'] = $data['test_grade'] > 5 ? 'Passed' : 'Reproved';

            $student->update($data);

            return $student;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }
}
