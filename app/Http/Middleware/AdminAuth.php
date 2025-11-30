<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated. Please login as an admin.'
                ], 401);
            }

            return redirect()->route('admin.login')
                ->with('error', 'You must be logged in as an admin to access this page.');
        }

        $admin = Auth::guard('admin')->user();

        if (!$admin->is_active) {
            Auth::guard('admin')->logout();

            return redirect()->route('admin.login')
                ->with('error', 'Your admin account is inactive. Please contact the system administrator.');
        }

        return $next($request);
    }
}