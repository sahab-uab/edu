<?php

use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\GuestCheck;
use App\Http\Middleware\RoleBase;
use App\Http\Middleware\RoleCheck;
use App\Http\Middleware\SiteMode;
use App\Http\Middleware\StatusCheck;
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
        $middleware->alias([
            'authCheck' => AuthCheck::class,
            'guestCheck' => GuestCheck::class,
            'checkrole' => RoleCheck::class,
            'roleBase' => RoleBase::class,
            'maintenance' => SiteMode::class,
            'userStatus' => StatusCheck::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
