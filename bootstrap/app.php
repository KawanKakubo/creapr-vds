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
    ->withMiddleware(function (Middleware $middleware): void {
        // Redirect guests to appropriate login page
        $middleware->redirectGuestsTo(function (Request $request) {
            // Se estiver tentando acessar área admin, redireciona para login admin
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            // Caso contrário, redireciona para login de município
            return route('login');
        });
        
        // Redirect authenticated users based on their role
        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();
            if ($user && $user->role === 'admin') {
                return route('admin.dashboard');
            }
            return route('municipality.dashboard');
        });
        
        // Register middleware aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
            'municipality' => \App\Http\Middleware\EnsureUserIsMunicipality::class,
        ]);
        
        // Headers de segurança globais
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        
        // Configuração do TrustProxies para funcionar atrás do WAF do CREA-PR
        // Confia em todos os proxies e utiliza todos os headers X-Forwarded
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR |
                     Request::HEADER_X_FORWARDED_HOST |
                     Request::HEADER_X_FORWARDED_PORT |
                     Request::HEADER_X_FORWARDED_PROTO |
                     Request::HEADER_X_FORWARDED_AWS_ELB
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
