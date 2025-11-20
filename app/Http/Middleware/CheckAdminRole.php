<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $admin = auth('admin')->user();

        if (!$admin)
            abort(403, 'Unauthorized action.');

        if (!in_array($admin->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'You dont have permission to access this resource.'
                ], 403);
            }

            abort(403, 'Insufficient permissions to access this resource.');
        }
        return $next($request);
    }
}
