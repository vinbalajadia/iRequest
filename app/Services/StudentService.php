<?php

namespace App\Services;

use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class StudentService
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function createStudent(array $data)
    {
        if (!isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->studentRepository->create($data);
    }

    public function updateStudent($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->studentRepository->update($id, $data);
    }

    public function getStudentById($id)
    {
        return $this->studentRepository->find($id);
    }

    public function getAllStudents()
    {
        return $this->studentRepository->paginate();
    }

    public function findByStudentId($studentId)
    {
        return $this->studentRepository->findByStudentId($studentId);
    }
}
