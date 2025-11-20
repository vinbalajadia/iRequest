<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Str;

class ThrottleRequest
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }
    public function handle(Request $request, Closure $next): Response
    {
        $key = $this->resolveRequestSignature($request);
        $maxAttempts = 5; //max 5 attempts
        $decayMinutes = 60; //per hour

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            $seconds = $this->limiter->availableIn($key);

            return response()->json([
                'message' => 'Too many requests. Please try again in ' . $seconds . ' seconds.',
                'retry_after' => $seconds
            ], 429);
        }

        $this->limiter->hit($key, $decayMinutes * 60);
        return $next($request);
    }

    protected function resolveRequestSignature(Request $request)
    {
        return Str::slug(
            'throttle_requests_' . $request->user('web')->id
        );
    }
}
