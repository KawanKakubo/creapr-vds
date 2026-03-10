<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Mail\CredentialsEmail;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;

echo "═══════════════════════════════════════════\n";
echo "  TESTE DE ENVIO - SIMULANDO FORMULÁRIO\n";
echo "═══════════════════════════════════════════\n\n";

$user = User::where('email', 'kawanhrs@gmail.com')->first();

if (!$user) {
    echo "❌ Usuário não encontrado\n";
    exit(1);
}

$testEmail = 'kawanhrs@gmail.com';
$protocol = 'CREA-2026-TEST-' . time();
$municipio = 'Município Teste';
$tempPassword = 'SenhaTeste123';

echo "📧 Email destino: {$testEmail}\n";
echo "📋 Protocolo: {$protocol}\n";
echo "🏙️  Município: {$municipio}\n\n";

// Teste 1: Email de Confirmação (similar ao formulário)
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "TESTE 1: Enviando email de CONFIRMAÇÃO\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

try {
    Mail::to($testEmail)->send(
        new ConfirmationEmail($protocol, $municipio)
    );
    echo "✅ Email de confirmação enviado com sucesso!\n\n";
} catch (\Exception $e) {
    echo "❌ Erro ao enviar email de confirmação:\n";
    echo $e->getMessage() . "\n\n";
}

// Teste 2: Email de Credenciais (quando é novo usuário)
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "TESTE 2: Enviando email de CREDENCIAIS\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

try {
    Mail::to($testEmail)->send(
        new CredentialsEmail($user, $tempPassword, $protocol, $municipio)
    );
    echo "✅ Email de credenciais enviado com sucesso!\n\n";
} catch (\Exception $e) {
    echo "❌ Erro ao enviar email de credenciais:\n";
    echo $e->getMessage() . "\n\n";
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "✅ TESTES CONCLUÍDOS!\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "Verifique sua inbox no Mailtrap:\n";
echo "https://mailtrap.io/inboxes\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
