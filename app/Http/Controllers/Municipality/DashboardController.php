<?php

namespace App\Http\Controllers\Municipality;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\ProgramEvent;
use App\Models\DiagnosticQuestion;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard do município
     */
    public function index()
    {
        $user = Auth::user();
        
        // Busca a submission do usuário
        $submission = Submission::where('user_id', $user->id)->firstOrFail();
        
        // Busca eventos publicados e futuros
        $upcomingEvents = ProgramEvent::published()
            ->upcoming()
            ->take(5)
            ->get();
        
        // Conta perguntas ativas por categoria para calcular o total de pontos possível
        $totalQuestionsEstimulo = DiagnosticQuestion::active()
            ->where('category', 'estimulo')
            ->count();
        
        $totalQuestionsEducacao = DiagnosticQuestion::active()
            ->where('category', 'educacao')
            ->count();
        
        $totalQuestionsEstruturas = DiagnosticQuestion::active()
            ->where('category', 'estruturas')
            ->count();
        
        // Calcula percentuais de conclusão
        $percentEstimulo = $submission->pontuacao_estimulo ?? 0;
        $percentEducacao = $submission->pontuacao_educacao ?? 0;
        $percentEstruturas = $submission->pontuacao_estruturas ?? 0;
        
        // Status dos diagnósticos
        $diagnosticStatus = [
            'estimulo' => [
                'iniciado' => $submission->diagnostico_estimulo_iniciado_em !== null,
                'concluido' => $submission->diagnostico_estimulo_concluido_em !== null,
                'score' => $percentEstimulo,
            ],
            'educacao' => [
                'iniciado' => $submission->diagnostico_educacao_iniciado_em !== null,
                'concluido' => $submission->diagnostico_educacao_concluido_em !== null,
                'score' => $percentEducacao,
            ],
            'estruturas' => [
                'iniciado' => $submission->diagnostico_estruturas_iniciado_em !== null,
                'concluido' => $submission->diagnostico_estruturas_concluido_em !== null,
                'score' => $percentEstruturas,
            ],
        ];
        
        // Carrega membros do comitê
        $committeeMembers = $submission->committeeMembers;
        
        // Carrega documentos recentes do repositório
        $recentDocuments = Repository::active()
            ->latest()
            ->take(3)
            ->get();
        
        return view('municipality.dashboard', compact(
            'submission',
            'upcomingEvents',
            'diagnosticStatus',
            'committeeMembers',
            'totalQuestionsEstimulo',
            'totalQuestionsEducacao',
            'totalQuestionsEstruturas',
            'recentDocuments'
        ));
    }
}
