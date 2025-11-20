<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequestActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if(in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $user = auth('web')->user() ?? auth('admin')->user();

            Log::info('Request Activity', [
                'user_type' => auth('web')->check() ? 'student' : 'admin',
                'user_id' => $user?->id,
                'user_name' => $user?->full_name ?? $user?->name ?? 'Guest',
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now()->toDateTimeString(),
            ]);
        }

        return $response;
    }
}
