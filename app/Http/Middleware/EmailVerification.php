<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        $user = Auth::guard($guard)->user();

        if(!$user || !$user->hasVerifiedEmail()) {
            if($request->expectsJson()) {
                return response()->json([
                    'message' => 'Your email address is not verified.'
                ], 403);
            }

            return redirect()->route($guard === 'admin' ? '' : '')
                ->with('error', 'Your email address is not verified.');
        }

        return $next($request);
    }
}
