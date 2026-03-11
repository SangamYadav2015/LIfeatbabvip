<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'autologout' => \App\Http\Middleware\AutoLogoutMiddleware::class,
            '2fa' => \App\Http\Middleware\TwoFactorAuthMiddleware::class,
            'api.token' => \App\Http\Middleware\ApiTokenMiddleware::class,
    'auth.applicant.api' => \App\Http\Middleware\ApplicantMiddlewareAPI::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
