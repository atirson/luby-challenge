<?php
namespace App\Repositories;

use App\Models\Student;

class StudentRepository {

    /**
     * Method return Student by CPF
     *
     * @param $id
     * @return mixed
     */
    public function getStudentByCPF($cpf) {
        return Student::where('cpf', '=', $cpf)->first();
    }

    /**
     * Method return Student by ID
     *
     * @param $id
     * @return Student
     */
    public function getStudentByID($id) {
        return Student::where('id', '=', $id)->first();
    }
}
