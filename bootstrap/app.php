<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Language;
use App\Http\Middleware\IsDeveloper;
use App\Http\Middleware\UserPermission;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {


        $middleware->appendToGroup('web',Language::class);
        // $middleware->appendToGroup('web',ActiveUser::class);


        $middleware->alias([
            'setLanguage' => Language::class,
            'UserPermission' => UserPermission::class,
            'IsDeveloper' => IsDeveloper::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
