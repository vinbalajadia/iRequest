<?php

namespace App\Repositories\Eloquent;

use App\Models\DocumentRequest;
use App\Repositories\Contracts\DocumentRequestRepositoryInterface;
use Carbon\Carbon;

class DocumentRequestRepository implements DocumentRequestRepositoryInterface
{
    protected $model;

    public function __construct(DocumentRequest $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByRequestNumber($requestNumber)
    {
        return $this->model->with(['student'])->where('request_number', $requestNumber)->first();
    }

    public function findByStudent($studentId)
    {
        return $this->model->where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $request = $this->find($id);

        if ($request) {
            $request->update($data);
            return $request;
        }

        return null;
    }

    public function updateStatus($id, $status, $adminRemarks = null)
    {
        $request = $this->find($id);

        if ($request) {
            $updateData = [
                'status' => $status,
                'admin_remarks' => $adminRemarks,
            ];

            if ($adminRemarks)
                $updateData['admin_remarks'] = $adminRemarks;

            switch ($status) {
                case 'processing':
                    $updateData['processed_at'] = now();
                    break;
                case 'ready_for_pickup':
                    $updateData['ready_at'] = now();
                    break;
                case 'completed':
                    $updateData['completed_at'] = now();
                    break;
            }

            $request->update($updateData);
            return $request;
        }

        return null;
    }

    public function getByStatus($status)
    {
        return $this->model->with(['student'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByPendingRequests()
    {
        return $this->model->with(['student'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getRequestsByDateRange($startDate, $endDate)
    {
        return $this->model->with(['student'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function generateReports($date)
    {
        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    public function generateRequestNumber()
    {
        $year = date('Y');
        $month = date('m');
        $latestRequest = $this->model->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'desc')
            ->first();
        $sequence = $latestRequest ? intval(substr($latestRequest->request_number, -4)) + 1 : 1;
        return sprintf('REQ-%s%s-%04d', $year, $month, $sequence);
    }
}
