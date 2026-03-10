<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Mail\CredentialsEmail;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;

echo "═══════════════════════════════════════════\n";
echo "  TESTE COM FILA (ShouldQueue)\n";
echo "═══════════════════════════════════════════\n\n";

$user = User::where('email', 'kawanhrs@gmail.com')->first();
$protocol = 'CREA-2026-QUEUE-' . time();
$municipio = 'Teste Fila';
$tempPassword = 'SenhaFila456';

echo "📧 Enfileirando emails...\n\n";

// Email 1: Confirmação
Mail::to('kawanhrs@gmail.com')->send(
    new ConfirmationEmail($protocol, $municipio)
);
echo "✅ Email de confirmação enfileirado\n";

// Email 2: Credenciais
Mail::to('kawanhrs@gmail.com')->send(
    new CredentialsEmail($user, $tempPassword, $protocol, $municipio)
);
echo "✅ Email de credenciais enfileirado\n\n";

// Verifica fila
$jobsCount = DB::table('jobs')->count();
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📊 Jobs na fila: {$jobsCount}\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "⏳ O queue worker está processando...\n";
echo "   (com delay de 3 segundos entre cada email)\n\n";
echo "Verifique no Mailtrap em cerca de 10 segundos!\n";
echo "https://mailtrap.io/inboxes\n";
