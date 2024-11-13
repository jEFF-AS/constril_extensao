<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\AdminOrVendor;
use App\Http\Middleware\EmailcheckMiddleware;
use App\Http\Middleware\AuthenticadoMiddleware;
use App\Http\Middleware\User;
use App\Http\Middleware\Vendor;
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
            'authen' => AuthenticadoMiddleware::class,
            'admin' => Admin::class,
            'adminOrVendor' => AdminOrVendor::class,
            'user' => User::class,
            'vendor' => Vendor::class,
            'emailcheck' => EmailcheckMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
