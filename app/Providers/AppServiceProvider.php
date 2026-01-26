<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Força HTTPS em todos os ambientes exceto local
        // Necessário para funcionar corretamente atrás do WAF do CREA-PR
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
