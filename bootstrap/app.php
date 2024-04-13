<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'user-role' =>  \App\Http\Middleware\UserRoleMiddleware::class,
            'redirectIfAuthenticated' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'auto-logout' => \App\Http\Middleware\AutoLogoutInactiveUsers::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
