<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Submission;

echo "═══════════════════════════════════════════\n";
echo "  DIAGNÓSTICO - PROTOCOLO CREA-2026-0006\n";
echo "═══════════════════════════════════════════\n\n";

$submission = Submission::where('protocolo', 'CREA-2026-0006')->first();

if (!$submission) {
    echo "❌ Submission não encontrada!\n";
    exit(1);
}

echo "✅ Submission encontrada!\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "Município: {$submission->municipio_nome}\n";
echo "Email Responsável: {$submission->responsavel_email}\n";
echo "Faz parte Mais Engenharia: " . ($submission->faz_parte_mais_engenharia ? '✅ SIM' : '❌ NÃO') . "\n";
echo "User ID vinculado: " . ($submission->user_id ?? '❌ NULL') . "\n";
echo "Criado em: {$submission->created_at->format('d/m/Y H:i:s')}\n\n";

// Verifica usuário vinculado
if ($submission->user_id) {
    $user = User::find($submission->user_id);
    if ($user) {
        echo "👤 USUÁRIO VINCULADO:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "ID: {$user->id}\n";
        echo "Nome: {$user->name}\n";
        echo "Email: {$user->email}\n";
        echo "Criado em: {$user->created_at->format('d/m/Y H:i:s')}\n";
        echo "Senha temporária: " . ($user->is_temporary_password ? '✅ SIM' : '❌ NÃO') . "\n";
        echo "Deve trocar senha: " . ($user->must_change_password ? '✅ SIM' : '❌ NÃO') . "\n\n";
        
        // Verifica se user foi criado ANTES ou DEPOIS da submission
        if ($user->created_at < $submission->created_at) {
            echo "⚠️  PROBLEMA IDENTIFICADO!\n";
            echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            echo "O usuário foi criado ANTES desta submission.\n";
            echo "Diferença: " . $user->created_at->diffForHumans($submission->created_at) . "\n\n";
            echo "CAUSA: Usuário já existia, então o sistema:\n";
            echo "  1. Detectou usuário existente\n";
            echo "  2. Não gerou nova senha (\$temporaryPassword = null)\n";
            echo "  3. Enviou ConfirmationEmail ao invés de CredentialsEmail\n\n";
        } else {
            echo "✅ Usuário foi criado JUNTO com esta submission\n";
            echo "Deveria ter recebido o email de CREDENCIAIS!\n\n";
        }
    }
} else {
    echo "❌ Nenhum usuário vinculado!\n";
    echo "PROBLEMA: Deveria ter criado e vinculado um usuário!\n\n";
}

// Lista todos os usuários com esse email
echo "📊 HISTÓRICO DO EMAIL:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
$allUsers = User::where('email', $submission->responsavel_email)->get();
echo "Total de usuários com este email: {$allUsers->count()}\n\n";

foreach ($allUsers as $u) {
    echo "  • ID {$u->id}: criado em {$u->created_at->format('d/m/Y H:i:s')}\n";
}
