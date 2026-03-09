<?php

namespace App\Http\Controllers\Municipality;

use App\Http\Controllers\Controller;
use App\Models\DiagnosticQuestion;
use App\Models\DiagnosticAnswer;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiagnosticController extends Controller
{
    /**
     * Exibe diagnóstico de Estímulo
     */
    public function estimulo()
    {
        return $this->showDiagnostic('estimulo');
    }
    
    /**
     * Exibe diagnóstico de Educação
     */
    public function educacao()
    {
        return $this->showDiagnostic('educacao');
    }
    
    /**
     * Exibe diagnóstico de Estruturas
     */
    public function estruturas()
    {
        return $this->showDiagnostic('estruturas');
    }
    
    /**
     * Método genérico para exibir diagnóstico
     */
    private function showDiagnostic($category)
    {
        $user = Auth::user();
        $submission = $user->submission;
        
        // Verifica se está aprovado
        if (!$submission->isApproved()) {
            return redirect()->route('municipality.dashboard')
                ->with('error', 'Aguardando aprovação da manifestação.');
        }
        
        // Busca perguntas da categoria
        $questions = DiagnosticQuestion::active()
            ->byCategory($category)
            ->get();
        
        // Busca respostas existentes
        $existingAnswers = DiagnosticAnswer::where('submission_id', $submission->id)
            ->whereIn('diagnostic_question_id', $questions->pluck('id'))
            ->get()
            ->keyBy('diagnostic_question_id');
        
        // Marca como iniciado se ainda não foi
        $fieldName = "diagnostico_{$category}_iniciado_em";
        if ($submission->$fieldName === null) {
            $submission->$fieldName = now();
            $submission->save();
        }
        
        return view('municipality.diagnostic', compact('category', 'questions', 'existingAnswers', 'submission'));
    }
    
    /**
     * Salva as respostas do diagnóstico
     */
    public function store(Request $request, $category)
    {
        $user = Auth::user();
        $submission = $user->submission;
        
        // Validação básica
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'array',
            'partial' => 'nullable|boolean',
        ]);
        
        $isPartial = $validated['partial'] ?? false;
        
        DB::beginTransaction();
        
        try {
            $totalPoints = 0;
            
            foreach ($validated['answers'] as $questionId => $answerData) {
                $question = DiagnosticQuestion::findOrFail($questionId);
                
                // Remove resposta existente se houver
                DiagnosticAnswer::where('submission_id', $submission->id)
                    ->where('diagnostic_question_id', $questionId)
                    ->delete();
                
                // Prepara dados da resposta
                $answerRecord = [
                    'submission_id' => $submission->id,
                    'diagnostic_question_id' => $questionId,
                    'category' => $category,
                    'answer_yes_no' => null,
                    'answer_checkboxes' => null,
                    'answer_multiple_input' => null,
                    'answer_text' => null,
                    'evidence_url' => $answerData['evidence_url'] ?? null,
                ];
                
                // Preenche de acordo com o tipo
                switch ($question->type) {
                    case 'yes_no':
                    case 'yes_no_evidence':
                        $answerRecord['answer_yes_no'] = $answerData['answer'] ?? null;
                        break;
                    
                    case 'checkbox':
                        $answerRecord['answer_checkboxes'] = $answerData['checkboxes'] ?? [];
                        break;
                    
                    case 'multiple_input':
                        $answerRecord['answer_multiple_input'] = $answerData['inputs'] ?? [];
                        break;
                    
                    case 'text':
                        $answerRecord['answer_text'] = $answerData['text'] ?? null;
                        break;
                }
                
                // Cria resposta
                $answer = DiagnosticAnswer::create($answerRecord);
                
                // Calcula e salva pontos
                $answer->calculateAndSavePoints();
                
                $totalPoints += $answer->points_earned;
            }
            
            // Atualiza pontuação na submission
            $scoreField = "pontuacao_{$category}";
            $submission->$scoreField = round($totalPoints);
            
            // Só marca como concluído se não for salvamento parcial
            if (!$isPartial) {
                $completedField = "diagnostico_{$category}_concluido_em";
                $submission->$completedField = now();
            }
            
            $submission->save();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => $isPartial ? 'Respostas salvas com sucesso!' : 'Diagnóstico finalizado com sucesso!',
                'score' => round($totalPoints),
                'redirect' => route('municipality.dashboard')
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar diagnóstico: ' . $e->getMessage()
            ], 500);
        }
    }
}
