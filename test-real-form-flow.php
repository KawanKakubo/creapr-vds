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
echo "  TESTE REAL - NOVO USUÁRIO (Mais Engenharia)\n";
echo "═══════════════════════════════════════════\n\n";

// Simula criação de novo usuário
$testEmail = 'teste.municipio@example.com';
$protocol = 'CREA-2026-REAL-' . time();
$municipio = 'Município Teste Real';

// Verifica se usuário já existe
$existingUser = User::where('email', $testEmail)->first();
if ($existingUser) {
    echo "⚠️  Usuário de teste já existe. Deletando...\n";
    $existingUser->delete();
}

// Cria novo usuário (simula fluxo do formulário)
$temporaryPassword = Str::random(12) . rand(10, 99);

$user = User::create([
    'name' => 'Responsável Teste',
    'email' => $testEmail,
    'password' => Hash::make($temporaryPassword),
    'role' => 'municipality',
    'is_temporary_password' => true,
    'must_change_password' => true,
]);

echo "✅ Novo usuário criado!\n";
echo "📧 Email: {$user->email}\n";
echo "🔑 Senha: {$temporaryPassword}\n\n";

// Envia APENAS o email de credenciais (como faz o formulário)
echo "📨 Enviando email de credenciais...\n";

try {
    Mail::to($user->email)->send(
        new CredentialsEmail($user, $temporaryPassword, $protocol, $municipio)
    );
    
    echo "✅ Email enfileirado com sucesso!\n\n";
    
    $jobsCount = DB::table('jobs')->count();
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "📊 Jobs na fila: {$jobsCount}\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    echo "⏳ Aguarde cerca de 15 segundos e verifique no Mailtrap!\n";
    echo "   https://mailtrap.io/inboxes\n\n";
    
    echo "📋 CREDENCIAIS PARA TESTE:\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "Email: {$user->email}\n";
    echo "Senha: {$temporaryPassword}\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    
} catch (\Exception $e) {
    echo "❌ Erro ao enviar email:\n";
    echo $e->getMessage() . "\n";
}
