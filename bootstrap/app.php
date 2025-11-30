<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'student.auth' => \App\Http\Middleware\StudentAuth::class,
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'admin.role' => \App\Http\Middleware\CheckAdminRole::class,
            'request.ownership' => \App\Http\Middleware\CheckRequestOwnership::class,
            'throttle.requests' => \App\Http\Middleware\ThrottleRequest::class,
            'log.activity' => \App\Http\Middleware\LogRequestActivity::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }
            
            return route('student.login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();