<?php

namespace App\Repositories\Eloquent;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    public function find($id)
    {
        return Student::find($id);
    }

    public function findByStudentId($studentId)
    {
        return Student::where('student_id', $studentId)->first();
    }

    public function findByEmail($email)
    {
        return Student::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return Student::create($data); 
    }

    public function update($id, array $data)
    {
        $student = Student::find($id);
        if ($student) {
            $student->update($data);
            return $student;
        }
        return null;
    }

    public function delete($id)
    {
        return Student::destroy($id);
    }

    public function all()
    {
        return Student::all();
    }

    public function paginate($perPage = 15)
    {
        return Student::paginate($perPage);
    }
}
