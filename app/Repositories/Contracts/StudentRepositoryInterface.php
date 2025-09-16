<?php

namespace App\Repositories\Contracts;

interface StudentRepositoryInterface
{
    public function find($id);
    public function findByStudentId($studentId);
    public function findByEmail($email);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function all();
    public function paginate($perPage = 15);
}