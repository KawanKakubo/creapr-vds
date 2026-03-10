<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    /**
     * Exibe o formulário de mudança de senha
     */
    public function show()
    {
        // Se o usuário não precisa mudar a senha, redireciona para dashboard
        if (!Auth::user()->must_change_password) {
            return redirect()->route('municipality.dashboard');
        }

        return view('auth.change-password');
    }

    /**
     * Processa a mudança de senha
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validação dos campos
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => [
                'required', 
                'string',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ], [
            'current_password.required' => 'A senha atual é obrigatória.',
            'new_password.required' => 'A nova senha é obrigatória.',
            'new_password.confirmed' => 'A confirmação da nova senha não corresponde.',
            'new_password.min' => 'A nova senha deve ter no mínimo 8 caracteres.',
            'new_password.mixed' => 'A nova senha deve conter letras maiúsculas e minúsculas.',
            'new_password.numbers' => 'A nova senha deve conter pelo menos um número.',
            'new_password.symbols' => 'A nova senha deve conter pelo menos um símbolo (ex: @, #, !, $, %, etc).',
        ]);

        // Verifica se a senha atual está correta
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'A senha atual está incorreta.'
            ])->withInput();
        }

        // Verifica se a nova senha é diferente da atual
        if (Hash::check($validated['new_password'], $user->password)) {
            return back()->withErrors([
                'new_password' => 'A nova senha deve ser diferente da senha atual.'
            ])->withInput();
        }

        // Atualiza a senha e os flags
        $user->password = Hash::make($validated['new_password']);
        $user->must_change_password = false;
        $user->is_temporary_password = false;
        $user->save();

        return redirect()->route('municipality.dashboard')
            ->with('success', 'Senha alterada com sucesso! Bem-vindo ao Smart Crea Cities.');
    }
}
