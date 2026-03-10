<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Submission;
use App\Models\User;

$sub = Submission::where('protocolo', 'CREA-2026-0005')->first();

if ($sub) {
    echo "✅ Submission encontrada!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "Município: " . $sub->municipio_nome . "\n";
    echo "Faz parte Mais Engenharia: " . ($sub->faz_parte_mais_engenharia ? '✅ SIM' : '❌ NÃO') . "\n";
    echo "User ID: " . ($sub->user_id ?? '❌ NULL') . "\n";
    echo "Email Responsável: " . $sub->responsavel_email . "\n";
    
    if ($sub->user_id) {
        $user = User::find($sub->user_id);
        if ($user) {
            echo "\n👤 Usuário Vinculado:\n";
            echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            echo "Nome: " . $user->name . "\n";
            echo "Email: " . $user->email . "\n";
            echo "Criado em: " . $user->created_at->format('d/m/Y H:i:s') . "\n";
            echo "Senha temporária: " . ($user->is_temporary_password ? '✅ SIM' : '❌ NÃO') . "\n";
            echo "Deve trocar senha: " . ($user->must_change_password ? '✅ SIM' : '❌ NÃO') . "\n";
        }
    } else {
        echo "\n❌ Nenhum usuário vinculado!\n";
        echo "PROBLEMA: Deveria ter criado um usuário já que faz parte do Mais Engenharia\n";
    }
} else {
    echo "❌ Submission não encontrada\n";
}
