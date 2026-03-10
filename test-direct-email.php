<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Mail\CredentialsEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

echo "═══════════════════════════════════════════\n";
echo "  TESTE ENVIO DIRETO (SEM FILA)\n";
echo "═══════════════════════════════════════════\n\n";

$testEmail = 'teste.novo@example.com';
$protocol = 'CREA-2026-DIRETO-' . time();
$municipio = 'Município Teste Direto';

// Verifica/remove usuário de teste
$existing = User::where('email', $testEmail)->first();
if ($existing) {
    $existing->delete();
    echo "⚠️  Usuário de teste anterior removido\n";
}

// Cria novo usuário
$tempPassword = Str::random(12) . rand(10, 99);
$user = User::create([
    'name' => 'Teste Direto',
    'email' => $testEmail,
    'password' => Hash::make($tempPassword),
    'role' => 'municipality',
    'is_temporary_password' => true,
    'must_change_password' => true,
]);

echo "✅ Usuário criado: {$user->email}\n";
echo "🔑 Senha: {$tempPassword}\n\n";

// Envia email DIRETAMENTE (sem fila)
echo "📧 Enviando email de credenciais...\n";

try {
    $startTime = microtime(true);
    
    Mail::to($user->email)->send(
        new CredentialsEmail($user, $tempPassword, $protocol, $municipio)
    );
    
    $endTime = microtime(true);
    $duration = round(($endTime - $startTime) * 1000, 2);
    
    echo "✅ Email enviado com sucesso!\n";
    echo "⏱️  Tempo: {$duration}ms\n\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "✅ SUCESSO! Verifique no Mailtrap:\n";
    echo "   https://mailtrap.io/inboxes\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    echo "📋 CREDENCIAIS:\n";
    echo "Email: {$user->email}\n";
    echo "Senha: {$tempPassword}\n";
    
} catch (\Exception $e) {
    echo "❌ ERRO ao enviar email:\n";
    echo $e->getMessage() . "\n\n";
    echo "Stack trace:\n";
    echo $e->getTraceAsString() . "\n";
}

// Verifica se tem jobs na fila (não deveria ter)
$jobs = DB::table('jobs')->count();
echo "\n📊 Jobs na fila: {$jobs} (deveria ser 0 - envio direto)\n";
