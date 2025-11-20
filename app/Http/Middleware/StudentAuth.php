<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class StudentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('web')->check()) {
            if($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated. Please login as a student.'
                ], 401);
            }

            return redirect()->route('')
                ->with('error', 'You must be logged in as a student to access this page.');
        }

        return $next($request);
    }
}
