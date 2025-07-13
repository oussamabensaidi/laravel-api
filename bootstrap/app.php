<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\JwtMiddleware;
use App\Providers\RouteServiceProvider; 
// use Fruitcake\Cors\HandleCors;
// Illuminate\Http\Middleware\HandleCors

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Apply CORS before API middleware
        // $middleware->append(HandleCors::class);

        $middleware->group('api', [



            // \Fruitcake\Cors\HandleCors::class,
            // 'throttle:api',
            // \Illuminate\Routing\Middleware\SubstituteBindings::class,
        // ]);
        // $middleware->alias([
        //     'jwt.verify' => JwtMiddleware::class,
        ]);
        
        // $middleware->alias('jwt.verify', JwtMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create()
        // ->withProviders([
        // RouteServiceProvider::class,
        // ])
        ;