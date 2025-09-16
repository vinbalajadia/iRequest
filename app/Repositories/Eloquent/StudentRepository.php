<?php

namespace App\Repositories\Eloquent;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    protected $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByStudentId($studentId)
    {
        return $this->model->find($studentId);
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $student = $this->find($id);

        if ($student) {
            $student->update($data);
            return $student;
        }

        return null;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }
}
