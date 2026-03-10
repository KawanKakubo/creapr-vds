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
echo "  TESTE - USUÁRIO JÁ EXISTE (Londrina)\n";
echo "═══════════════════════════════════════════\n\n";

$email = 'kawanhrs@gmail.com';
$protocol = 'CREA-2026-TEST-' . time();
$municipio = 'Londrina';

// Verifica usuário
$user = User::where('email', $email)->first();

if (!$user) {
    echo "❌ Usuário não encontrado! Criando...\n";
    // Cria para teste
    $user = User::create([
        'name' => 'Kawan Teste',
        'email' => $email,
        'password' => Hash::make('senha_antiga_123'),
        'role' => 'municipality',
        'is_temporary_password' => true,
        'must_change_password' => true,
    ]);
}

echo "✅ Usuário encontrado!\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "ID: {$user->id}\n";
echo "Nome: {$user->name}\n";
echo "Email: {$user->email}\n";
echo "Senha temporária: " . ($user->is_temporary_password ? '✅ SIM' : '❌ NÃO') . "\n";
echo "Deve trocar senha: " . ($user->must_change_password ? '✅ SIM' : '❌ NÃO') . "\n\n";

// Simula a lógica do controller
if ($user->is_temporary_password || $user->must_change_password) {
    echo "🔄 Usuário tem senha temporária - GERANDO NOVA SENHA\n\n";
    
    // Gera nova senha
    $newPassword = Str::random(12) . rand(10, 99);
    $user->password = Hash::make($newPassword);
    $user->is_temporary_password = true;
    $user->must_change_password = true;
    $user->save();
    
    echo "✅ Nova senha gerada: {$newPassword}\n\n";
    
    // Envia email de credenciais
    echo "📧 Enviando email de CREDENCIAIS...\n";
    
    try {
        Mail::to($user->email)->send(
            new CredentialsEmail($user, $newPassword, $protocol, $municipio)
        );
        
        echo "✅ Email de CREDENCIAIS enviado com sucesso!\n\n";
        
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📋 NOVAS CREDENCIAIS:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "Email: {$user->email}\n";
        echo "Senha: {$newPassword}\n";
        echo "Protocolo: {$protocol}\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        
        echo "✅ Verifique no Mailtrap:\n";
        echo "   https://mailtrap.io/inboxes\n";
        
    } catch (\Exception $e) {
        echo "❌ Erro ao enviar email:\n";
        echo $e->getMessage() . "\n";
    }
} else {
    echo "ℹ️  Usuário já tem senha própria - enviaria apenas CONFIRMAÇÃO\n";
}
