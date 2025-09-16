<?php

namespace App\Repositories\Contracts;

interface DocumentRequestRepositoryInterface
{
    public function find($id);
    public function findByRequestNumber($requestNumber);
    public function findByStudent($studentId);
    public function create(array $data);
    public function update($id, array $data);
    public function updateStatus($id, $status, $adminRemarks = null);
    public function getByStatus($status);
    public function getByPendingRequests();
    public function getRequestsByDateRange($startDate, $endDate);
    public function generateReports($date);
    public function paginate($perPage = 15);
}