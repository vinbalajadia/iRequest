<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\DocumentRequest;

class CheckRequestOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = $request->route('id') ?? $request->route('request');
        $documentRequest = DocumentRequest::find($requestId);

        if (!$documentRequest) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Document request not found'
                ], 404);
            }

            abort(404, 'Document request not found');
        }

        //check if the authenticated student has requests
        $student = auth('web')->user();

        if ($documentRequest->student_id !== $student->id) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'You do not have permission to access this document request.'
                ], 403);
            }

            abort(403, 'Unauthorized access to this request.');
        }

        $request->merge(['document_request' => $documentRequest]);

        return $next($request);
    }
}
