<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Http\Requests\StoreSubmissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PublicFormController extends Controller
{
    /**
     * Exibe o formulário de manifestação de interesse
     */
    public function show()
    {
        return view('public.form');
    }

    /**
     * Processa e salva a submissão do formulário
     */
    public function store(StoreSubmissionRequest $request)
    {
        $validated = $request->validated();
        
        // Gera o protocolo único
        $year = date('Y');
        $lastSubmission = Submission::whereYear('created_at', $year)->latest('id')->first();
        $sequence = $lastSubmission ? ((int) substr($lastSubmission->protocolo, -4)) + 1 : 1;
        $protocolo = sprintf('CREA-%s-%04d', $year, $sequence);
        
        // Gera token único de acesso (válido por 30 dias)
        $accessToken = Str::random(64);
        $tokenExpiresAt = now()->addDays(30);
        
        // Adiciona o protocolo e token aos dados validados
        $validated['protocolo'] = $protocolo;
        $validated['access_token'] = $accessToken;
        $validated['token_expires_at'] = $tokenExpiresAt;
        
        // Converte valores booleanos de string para boolean
        $booleanFields = [
            'possui_lei_inovacao',
            'possui_fundo_inovacao',
            'possui_conselho_cti',
            'possui_normativa_governanca',
            'possui_secretaria_cti',
            'rodou_contrato_solucao_inovadora',
            'possui_politica_sandbox',
            'possui_politica_living_lab',
            'possui_estrategia_transformacao_digital',
            'possui_planejamento_estrategico',
            'ganhou_premio_inovacao',
            'declaracao_interesse',
        ];
        
        foreach ($booleanFields as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = filter_var($validated[$field], FILTER_VALIDATE_BOOLEAN);
            }
        }
        
        // Cria a submissão
        $submission = Submission::create($validated);
        
        return redirect()->route('inscricao.sucesso', [
            'protocolo' => $protocolo,
            'token' => $accessToken
        ]);
    }

    /**
     * Exibe a página de confirmação com o protocolo e token
     */
    public function success($protocolo, $token)
    {
        // Validação básica dos parâmetros
        if (strlen($token) !== 64 || !ctype_alnum($token)) {
            Log::warning('Tentativa de acesso com token inválido', [
                'protocolo' => $protocolo,
                'ip' => request()->ip(),
            ]);
            abort(404);
        }
        
        // Busca com hash_equals para prevenir timing attacks
        $submission = Submission::where('protocolo', $protocolo)->first();
        
        if (!$submission || !hash_equals($submission->access_token, $token)) {
            Log::warning('Tentativa de acesso com token incorreto', [
                'protocolo' => $protocolo,
                'ip' => request()->ip(),
            ]);
            abort(404);
        }
        
        // Verifica se o token está expirado
        if ($submission->token_expires_at && $submission->token_expires_at->isPast()) {
            Log::info('Acesso com token expirado', [
                'protocolo' => $protocolo,
                'ip' => request()->ip(),
            ]);
            abort(410, 'Este link de acesso expirou.');
        }
        
        return view('public.success', compact('submission'));
    }
}
