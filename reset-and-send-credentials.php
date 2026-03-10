<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Mail\CredentialsEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$email = $argv[1] ?? null;
$protocol = $argv[2] ?? 'CREA-2026-0005';
$municipio = $argv[3] ?? 'Teste';

if (!$email) {
    echo "❌ USO: php reset-and-send-credentials.php EMAIL [PROTOCOLO] [MUNICIPIO]\n";
    echo "Exemplo: php reset-and-send-credentials.php kawanhrs@gmail.com CREA-2026-0005 Teste\n";
    exit(1);
}

$user = User::where('email', $email)->first();

if (!$user) {
    echo "❌ Usuário não encontrado com email: {$email}\n";
    exit(1);
}

echo "═══════════════════════════════════════════\n";
echo "  RESET DE SENHA E ENVIO DE CREDENCIAIS\n";
echo "═══════════════════════════════════════════\n\n";

echo "👤 Usuário: {$user->name}\n";
echo "📧 Email: {$user->email}\n";
echo "📋 Protocolo: {$protocol}\n";
echo "🏙️  Município: {$municipio}\n\n";

// Gera nova senha temporária
$newPassword = Str::random(12) . rand(10, 99);

// Atualiza no banco
$user->password = Hash::make($newPassword);
$user->is_temporary_password = true;
$user->must_change_password = true;
$user->save();

echo "✅ Nova senha gerada e salva no banco!\n\n";

// Envia email
try {
    Mail::to($user->email)->send(
        new CredentialsEmail($user, $newPassword, $protocol, $municipio)
    );
    
    echo "✅ Email de credenciais enviado com sucesso!\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "📋 CREDENCIAIS:\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "Email: {$user->email}\n";
    echo "Senha: {$newPassword}\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    echo "⚠️  ATENÇÃO:\n";
    echo "Como MAIL_MAILER=log, verifique o email no log.\n";
    echo "Para enviar email REAL, configure MAIL_MAILER (Gmail/Mailtrap).\n";
    
} catch (\Exception $e) {
    echo "❌ Erro ao enviar email:\n";    echo $e->getMessage() . "\n";
}
