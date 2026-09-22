<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectUsersTo('/admin');
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            'throttle:web-traffic',
        ]);

        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'no_cache' => \App\Http\Middleware\PreventBackHistory::class,
            'module_access' => \App\Http\Middleware\ModuleAccessMiddleware::class,
            'log_admin_activity' => \App\Http\Middleware\LogAdminActivityMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

return $app;
