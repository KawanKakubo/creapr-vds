<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicFormController;
use App\Http\Controllers\Admin\AdminSubmissionController;
use Illuminate\Support\Facades\Route;

// Página inicial - Nova Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Rotas Públicas - Formulário de Manifestação de Interesse
// Rate limiting: 60 requisições por minuto
Route::get('/manifestacao-interesse', [PublicFormController::class, 'show'])
    ->middleware('throttle:60,1')
    ->name('manifestacao.show');

// Rate limiting: 5 submissões por hora para prevenir spam
Route::post('/manifestacao-interesse', [PublicFormController::class, 'store'])
    ->middleware('throttle:5,60')
    ->name('manifestacao.store');

// Rate limiting: 10 acessos por minuto para prevenir força bruta no token
Route::get('/inscricao-concluida/{protocolo}/{token}', [PublicFormController::class, 'success'])
    ->middleware('throttle:10,1')
    ->name('inscricao.sucesso');

// Rotas Administrativas (requerem autenticação)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminSubmissionController::class, 'dashboard'])->name('dashboard');
    
    // Gerenciamento de Submissões
    Route::get('/submissoes', [AdminSubmissionController::class, 'index'])->name('submissoes.index');
    Route::get('/submissoes/exportar', [AdminSubmissionController::class, 'export'])->name('submissoes.export');
    Route::get('/submissoes/{submission}', [AdminSubmissionController::class, 'show'])->name('submissoes.show');
});

// Rotas de Perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
