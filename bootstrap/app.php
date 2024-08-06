<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->redirectGuestsTo(function ($request) {
            return $request->is('admin*') ? route('admin.login') : route('login');
        });
        $middleware->redirectUsersTo(function ($request) {
            if ($request->is('admin/login') && auth()->guard('admin')->check()) {
                return route('admin.dashboard');
            } elseif ($request->is('login') && auth()->guard('web')->check()) {
                return route('dashboard');
            }
            return null;
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
