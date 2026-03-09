<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckMustChangePassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se o usuário está autenticado e precisa mudar a senha
        if (Auth::check() && Auth::user()->must_change_password) {
            // Não redirecionar se já estiver na página de mudança de senha ou logout
            if (!$request->is('change-password') && !$request->is('logout')) {
                return redirect()->route('change-password.show')
                    ->with('warning', 'Por segurança, você deve alterar sua senha temporária.');
            }
        }

        return $next($request);
    }
}
