<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Mail\CredentialsEmail;
use Illuminate\Support\Facades\Mail;

// Busca o usuário criado
$user = User::find(3);

if ($user) {
    echo "✅ Usuário encontrado: " . $user->name . "\n";
    echo "Email: " . $user->email . "\n\n";
    
    // Senha temporária de teste
    $tempPassword = "SenhaTest123";
    $protocol = "CREA-2026-0005";
    $municipio = "Teste";
    
    echo "📧 Enviando email de teste com credenciais...\n\n";
    
    try {
        Mail::to($user->email)->send(
            new CredentialsEmail($user, $tempPassword, $protocol, $municipio)
        );
        
        echo "✅ Email enviado com sucesso!\n";
        echo "\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "Como MAIL_MAILER=log, o email foi salvo no log.\n";
        echo "Verifique: storage/logs/laravel.log\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        
    } catch (\Exception $e) {
        echo "❌ Erro ao enviar email:\n";
        echo $e->getMessage() . "\n";
    }
} else {
    echo "❌ Usuário não encontrado\n";
}
