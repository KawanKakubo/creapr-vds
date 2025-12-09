<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Http\Requests\StoreSubmissionRequest;
use Illuminate\Http\Request;

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
        
        // Adiciona o protocolo aos dados validados
        $validated['protocolo'] = $protocolo;
        
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
        
        return redirect()->route('inscricao.sucesso', ['protocolo' => $protocolo]);
    }

    /**
     * Exibe a página de confirmação com o protocolo
     */
    public function success($protocolo)
    {
        $submission = Submission::where('protocolo', $protocolo)->firstOrFail();
        
        return view('public.success', compact('submission'));
    }
}
