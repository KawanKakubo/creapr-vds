<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\DiagnosticQuestion;
use App\Mail\ApprovalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminSubmissionController extends Controller
{
    /**
     * Exibe o dashboard com estatísticas
     */
    public function dashboard()
    {
        // Estatísticas gerais
        $totalSubmissoes = Submission::count();
        $pendentes = Submission::where('status', 'pending')->count();
        $aprovadas = Submission::where('status', 'approved')->count();
        $emAnalise = Submission::where('status', 'under_review')->count();
        $rejeitadas = Submission::where('status', 'rejected')->count();
        
        // Mais Engenharia
        $maisEngenharia = Submission::where('faz_parte_mais_engenharia', true)->count();
        $naoMaisEngenharia = Submission::where('faz_parte_mais_engenharia', false)->count();
        
        // Diagnósticos completos
        $diagnosticosCompletos = Submission::whereNotNull('diagnostico_estimulo_concluido_em')
            ->whereNotNull('diagnostico_educacao_concluido_em')
            ->whereNotNull('diagnostico_estruturas_concluido_em')
            ->count();
        
        // Médias de pontuação
        $mediaPontuacaoEstimulo = Submission::where('status', 'approved')
            ->whereNotNull('diagnostico_estimulo_concluido_em')
            ->avg('pontuacao_estimulo') ?? 0;
            
        $mediaPontuacaoEducacao = Submission::where('status', 'approved')
            ->whereNotNull('diagnostico_educacao_concluido_em')
            ->avg('pontuacao_educacao') ?? 0;
            
        $mediaPontuacaoEstruturas = Submission::where('status', 'approved')
            ->whereNotNull('diagnostico_estruturas_concluido_em')
            ->avg('pontuacao_estruturas') ?? 0;
        
        // Distribuição por regional
        $porRegional = Submission::select('regional_creapr', DB::raw('count(*) as total'))
            ->groupBy('regional_creapr')
            ->orderBy('total', 'desc')
            ->get();
        
        // Últimas submissões
        $ultimasSubmissoes = Submission::with('user')->latest()->take(10)->get();
        
        // Timeline de submissões (últimos 6 meses)
        $timeline = Submission::select(
                DB::raw("TO_CHAR(created_at, 'YYYY-MM') as mes"),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
        
        return view('admin.dashboard', compact(
            'totalSubmissoes',
            'pendentes',
            'aprovadas',
            'emAnalise',
            'rejeitadas',
            'maisEngenharia',
            'naoMaisEngenharia',
            'diagnosticosCompletos',
            'mediaPontuacaoEstimulo',
            'mediaPontuacaoEducacao',
            'mediaPontuacaoEstruturas',
            'porRegional',
            'ultimasSubmissoes',
            'timeline'
        ));
    }

    /**
     * Lista todas as submissões com filtros
     */
    public function index(Request $request)
    {
        $request->validate([
            'municipio' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,approved,under_review,rejected',
            'regional' => 'nullable|string|max:255',
            'mais_engenharia' => 'nullable|in:sim,nao',
        ]);
        
        $query = Submission::with('user');
        
        // Filtros
        if ($request->filled('municipio')) {
            $query->where('municipio_nome', 'like', '%' . $request->municipio . '%');
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('regional')) {
            $query->where('regional_creapr', $request->regional);
        }
        
        if ($request->filled('mais_engenharia')) {
            $query->where('faz_parte_mais_engenharia', $request->mais_engenharia === 'sim');
        }
        
        $submissions = $query->latest()->paginate(20)->withQueryString();
        
        // Lista de regionais para filtro
        $regionais = Submission::distinct()->pluck('regional_creapr')->filter();
        
        return view('admin.submissions.index', compact('submissions', 'regionais'));
    }
    
    /**
     * Exibe detalhes de uma submissão específica
     */
    public function show(Submission $submission)
    {
        $submission->load(['user', 'committeeMembers', 'diagnosticAnswers.diagnosticQuestion']);
        
        return view('admin.submissions.show', compact('submission'));
    }
    
    /**
     * Atualiza o status de uma submissão (aprovar/rejeitar)
     */
    public function updateStatus(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,under_review,rejected',
            'observacao' => 'nullable|string|max:1000',
        ]);
        
        $oldStatus = $submission->status;
        $submission->status = $validated['status'];
        $submission->status_observacao = $validated['observacao'] ?? null;
        $submission->save();
        
        // Se foi aprovado e tem usuário, envia email de notificação
        if ($validated['status'] === 'approved' && $oldStatus !== 'approved' && $submission->user) {
            try {
                Mail::to($submission->user->email)->send(new ApprovalNotification($submission));
                Log::info('Email de aprovação enviado', [
                    'submission_id' => $submission->id,
                    'email' => $submission->user->email,
                ]);
            } catch (\Exception $e) {
                Log::error('Erro ao enviar email de aprovação', [
                    'submission_id' => $submission->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Status atualizado com sucesso!');
    }
    
    /**
     * Exporta submissões para CSV
     */
    public function export(Request $request)
    {
        $query = Submission::with('user');
        
        // Aplicar filtros
        if ($request->filled('municipio')) {
            $query->where('municipio_nome', 'like', '%' . $request->municipio . '%');
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('regional')) {
            $query->where('regional_creapr', $request->regional);
        }
        
        $submissions = $query->latest()->get();
        
        $filename = 'submissoes_smart_crea_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        
        $callback = function() use ($submissions) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8
            
            fputcsv($file, [
                'Protocolo',
                'Status',
                'Município',
                'Habitantes',
                'Regional CREA-PR',
                'Setores Econômicos',
                'Mais Engenharia',
                'Responsável Nome',
                'Responsável Email',
                'Responsável Telefone',
                'Pontuação Estímulo',
                'Pontuação Educação',
                'Pontuação Estruturas',
                'Score Total',
                'Diagnóstico Completo',
                'Data Criação',
            ]);
            
            foreach ($submissions as $sub) {
                fputcsv($file, [
                    $sub->protocolo,
                    $sub->status,
                    $sub->municipio_nome,
                    $sub->habitantes_num,
                    $sub->regional_creapr,
                    is_array($sub->setores_economicos) ? implode(', ', $sub->setores_economicos) : '',
                    $sub->faz_parte_mais_engenharia ? 'Sim' : 'Não',
                    $sub->responsavel_nome ?? '',
                    $sub->responsavel_email ?? '',
                    $sub->responsavel_telefone ?? '',
                    $sub->pontuacao_estimulo ?? 0,
                    $sub->pontuacao_educacao ?? 0,
                    $sub->pontuacao_estruturas ?? 0,
                    $sub->getTotalScore(),
                    $sub->allDiagnosticsCompleted() ? 'Sim' : 'Não',
                    $sub->created_at->format('d/m/Y H:i'),
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
