<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Submission;
use App\Models\User;

$sub = Submission::where('protocolo', 'CREA-2026-0005')->first();
$user = User::find(3);

echo "═══════════════════════════════════════════\n";
echo "  ANÁLISE DO PROBLEMA - CREA-2026-0005\n";
echo "═══════════════════════════════════════════\n\n";

// Verifica se havia usuário antes
$usersBeforeSubmission = User::where('created_at', '<', $sub->created_at)->where('email', $user->email)->count();

if ($usersBeforeSubmission > 0) {
    echo "❌ PROBLEMA IDENTIFICADO!\n\n";
    echo "O usuário com email '{$user->email}' já existia ANTES desta submission.\n\n";
    echo "EXPLICAÇÃO:\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "No código do PublicFormController, linha ~137:\n\n";
    echo "if (\$user) {\n    echo \"   // Usuário já existe - apenas vincula\n";
    echo "    \$temporaryPassword = null; // ← Não gera senha!\n";
    echo "} else {\n";
    echo "    // Cria novo usuário\n";
    echo "    \$temporaryPassword = Str::random(12);\n";
    echo "}\n\n";
    echo "CONCLUSÃO:\n";
    echo "Como \$temporaryPassword = null, o código enviou apenas\n";
    echo "o email de CONFIRMAÇÃO, não o de CREDENCIAIS!\n\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
} else {
    echo "✅ É um usuário novo!\n\n";
    echo "Submission criada em: " . $sub->created_at->format('d/m/Y H:i:s') . "\n";
    echo "Usuário criado em: " . $user->created_at->format('d/m/Y H:i:s') . "\n\n";
    
    echo "❓ O problema pode ser:\n";
    echo "1. O email de credenciais foi para fila mas não processado\n";
    echo "2. Houve erro no envio e não foi logado\n";
    echo "3. O email foi enviado mas MAIL_MAILER=log não salvou corretamente\n";
}

echo "\n";
echo "SOLUÇÃO:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "1. Resetar a senha do usuário manualmente\n";
echo "2. Reenviar email de credenciais\n";
echo "3. OU corrigir o fluxo para detectar usuário duplicado\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
