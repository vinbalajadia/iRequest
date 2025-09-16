<?php

namespace App\Services;

use App\Repositories\Contracts\DocumentRequestRepositoryInterface;
use App\Services\NotificationService;

class DocumentRequestService
{
    protected $requestRepository;
    protected $notificationService;

    public function __construct(DocumentRequestRepositoryInterface $requestRepository, NotificationService $notificationService)
    {
        $this->requestRepository = $requestRepository;
        $this->notificationService = $notificationService;
    }

    public function createRequest(array $data)
    {
        $request = $this->requestRepository->create($data);

        $this->notificationService->sendRequestCreatedNotification($request);

        return $request;
    }

    public function updateRequestStatus($id, $status, $adminRemarks = null)
    {
        $request = $this->requestRepository->updateStatus($id, $status, $adminRemarks);

        if ($request)
            $this->notificationService->sendRequestStatusUpdatedNotification($request);

        return $request;
    }

    public function getStudentRequests($studentId)
    {
        return $this->requestRepository->findByStudent($studentId);
    }

    public function getPendingRequests()
    {
        return $this->requestRepository->getByPendingRequests();
    }

    public function getRequestById($id)
    {
        return $this->requestRepository->find($id);
    }

    public function generateReports($date = null)
    {
        $date = $date ?? now()->format('Y-m-d');
        return $this->requestRepository->generateReports($date);
    }

    public function getAllRequests()
    {
        return $this->requestRepository->paginate();
    }

    public function trackRequest($requestNumber)
    {
        return $this->requestRepository->findByRequestNumber($requestNumber);
    }
}
