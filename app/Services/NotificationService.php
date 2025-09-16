<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\DocumentRequest;

class NotificationService
{
    public function sendRequestCreatedNotification(DocumentRequest $request)
    {
        Log::info("Request created notification sent for request: {$request->request_number} " );
    }

    public function sendRequestStatusUpdatedNotification(DocumentRequest $request)
    {
        Log::info("Request status updated notification sent for request: {$request->request_number} - Status: {$request->status}");
    }
}