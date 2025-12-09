<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicFormController;
use App\Http\Controllers\Admin\AdminSubmissionController;
use Illuminate\Support\Facades\Route;

// Página inicial - Redireciona para o formulário
Route::get('/', function () {
    return redirect()->route('manifestacao.show');
});

// Rotas Públicas - Formulário de Manifestação de Interesse
Route::get('/manifestacao-interesse', [PublicFormController::class, 'show'])->name('manifestacao.show');
Route::post('/manifestacao-interesse', [PublicFormController::class, 'store'])->name('manifestacao.store');
Route::get('/inscricao-concluida/{protocolo}', [PublicFormController::class, 'success'])->name('inscricao.sucesso');

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
