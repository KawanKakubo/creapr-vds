<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class AdminSubmissionController extends Controller
{
    /**
     * Exibe o dashboard com estatísticas
     */
    public function dashboard()
    {
        $totalSubmissoes = Submission::count();
        $comLeiInovacao = Submission::where('possui_lei_inovacao', true)->count();
        $comFundoInovacao = Submission::where('possui_fundo_inovacao', true)->count();
        $ultimasSubmissoes = Submission::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalSubmissoes',
            'comLeiInovacao',
            'comFundoInovacao',
            'ultimasSubmissoes'
        ));
    }

    /**
     * Lista todas as submissões com filtros
     */
    public function index(Request $request)
    {
        // Validação dos inputs para prevenir SQL injection
        $request->validate([
            'municipio' => 'nullable|string|max:255',
            'possui_lei_inovacao' => 'nullable|in:sim,nao',
            'possui_fundo_inovacao' => 'nullable|in:sim,nao',
        ]);
        
        $query = Submission::query();
        
        // Filtro por município (protegido contra SQL injection)
        if ($request->filled('municipio')) {
            $query->where('municipio_nome', 'like', '%' . $request->input('municipio') . '%');
        }
        
        // Filtro por possui lei de inovação
        if ($request->filled('possui_lei_inovacao')) {
            $query->where('possui_lei_inovacao', $request->input('possui_lei_inovacao') === 'sim');
        }
        
        // Filtro por possui fundo de inovação
        if ($request->filled('possui_fundo_inovacao')) {
            $query->where('possui_fundo_inovacao', $request->input('possui_fundo_inovacao') === 'sim');
        }
        
        // Filtro por data inicial
        if ($request->filled('data_inicial')) {
            $query->whereDate('created_at', '>=', $request->data_inicial);
        }
        
        // Filtro por data final
        if ($request->filled('data_final')) {
            $query->whereDate('created_at', '<=', $request->data_final);
        }
        
        // Ordenação
        $submissions = $query->latest()->paginate(20)->withQueryString();
        
        return view('admin.submissions.index', compact('submissions'));
    }
    
    /**
     * Exporta todas as submissões para CSV
     */
    public function export(Request $request)
    {
        $query = Submission::query();
        
        // Aplicar os mesmos filtros da listagem
        if ($request->filled('municipio')) {
            $query->where('municipio_nome', 'like', '%' . $request->municipio . '%');
        }
        
        if ($request->filled('possui_lei_inovacao')) {
            $query->where('possui_lei_inovacao', $request->possui_lei_inovacao === 'sim');
        }
        
        if ($request->filled('possui_fundo_inovacao')) {
            $query->where('possui_fundo_inovacao', $request->possui_fundo_inovacao === 'sim');
        }
        
        if ($request->filled('data_inicial')) {
            $query->whereDate('created_at', '>=', $request->data_inicial);
        }
        
        if ($request->filled('data_final')) {
            $query->whereDate('created_at', '<=', $request->data_final);
        }
        
        $submissions = $query->latest()->get();
        
        $filename = 'submissoes_crea_pr_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        
        $callback = function() use ($submissions) {
            $file = fopen('php://output', 'w');
            
            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Cabeçalhos do CSV - TODOS OS CAMPOS
            fputcsv($file, [
                'Protocolo',
                'Município',
                'Prefeito',
                'Mandato',
                'População',
                // Bloco 1: Marco Legal
                'Possui Lei de Inovação',
                'Link Lei de Inovação',
                'Possui Fundo de Inovação',
                'CNPJ Fundo',
                'Possui Conselho CTI',
                'Link Portaria Conselho',
                // Bloco 2: Governança
                'Possui Normativa Governança Digital',
                'Link Normativa Governança',
                'Possui Secretaria CTI',
                'Órgão Responsável CTI',
                // Bloco 3: Contratos e Políticas
                'Rodou Contrato Solução Inovadora',
                'Link Evidência Contrato',
                'Possui Política Sandbox',
                'Link Evidência Sandbox',
                'Possui Política Living Lab',
                'Link Evidência Living Lab',
                'Possui Estratégia Transformação Digital',
                'Link Evidência Estratégia',
                // Bloco 4: Ecossistema
                'Número de Startups',
                'Ambientes de Inovação',
                'Hackathons Realizados',
                // Bloco 5: Planejamento
                'Possui Planejamento Estratégico',
                'Link Evidência Planejamento',
                'Relevância Engenharias',
                'Descrição Relevância Engenharias',
                // Bloco 6: Prêmios
                'Ganhou Prêmio Inovação',
                'Descrição Prêmio',
                // Bloco 7: Ponto Focal
                'Ponto Focal - Nome',
                'Ponto Focal - Cargo',
                'Ponto Focal - Email',
                'Ponto Focal - Telefone',
                'Ponto Focal - Celular',
                // Meta
                'Data de Submissão'
            ], ';');
            
            // Dados - TODOS OS CAMPOS
            foreach ($submissions as $submission) {
                fputcsv($file, [
                    $submission->protocolo,
                    $submission->municipio_nome,
                    $submission->prefeito_nome,
                    $submission->prefeito_mandato,
                    $submission->habitantes_num,
                    // Bloco 1: Marco Legal
                    $submission->possui_lei_inovacao ? 'Sim' : 'Não',
                    $submission->link_lei_inovacao ?? '',
                    $submission->possui_fundo_inovacao ? 'Sim' : 'Não',
                    $submission->cnpj_fundo_inovacao ?? '',
                    $submission->possui_conselho_cti ? 'Sim' : 'Não',
                    $submission->link_portaria_conselho ?? '',
                    // Bloco 2: Governança
                    $submission->possui_normativa_governanca ? 'Sim' : 'Não',
                    $submission->link_normativa_governanca ?? '',
                    $submission->possui_secretaria_cti ? 'Sim' : 'Não',
                    $submission->orgao_responsavel_cti ?? '',
                    // Bloco 3: Contratos e Políticas
                    $submission->rodou_contrato_solucao_inovadora ? 'Sim' : 'Não',
                    $submission->link_evidencia_contrato ?? '',
                    $submission->possui_politica_sandbox ? 'Sim' : 'Não',
                    $submission->link_evidencia_sandbox ?? '',
                    $submission->possui_politica_living_lab ? 'Sim' : 'Não',
                    $submission->link_evidencia_living_lab ?? '',
                    $submission->possui_estrategia_transformacao_digital ? 'Sim' : 'Não',
                    $submission->link_evidencia_estrategia ?? '',
                    // Bloco 4: Ecossistema
                    $submission->startups_num ?? 0,
                    is_array($submission->ambientes_inovacao) ? implode(', ', $submission->ambientes_inovacao) : '',
                    is_array($submission->hackathons_realizados) ? implode(', ', $submission->hackathons_realizados) : '',
                    // Bloco 5: Planejamento
                    $submission->possui_planejamento_estrategico ? 'Sim' : 'Não',
                    $submission->link_evidencia_planejamento ?? '',
                    $submission->relevancia_engenharias ?? '',
                    $submission->relevancia_engenharias_descricao ?? '',
                    // Bloco 6: Prêmios
                    $submission->ganhou_premio_inovacao ? 'Sim' : 'Não',
                    $submission->descricao_premio_relevante ?? '',
                    // Bloco 7: Ponto Focal
                    $submission->ponto_focal_nome,
                    $submission->ponto_focal_cargo,
                    $submission->ponto_focal_email,
                    $submission->ponto_focal_telefone,
                    $submission->ponto_focal_celular,
                    // Meta
                    $submission->created_at->format('d/m/Y H:i:s')
                ], ';');
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Exibe os detalhes de uma submissão específica
     */
    public function show(Submission $submission)
    {
        return view('admin.submissions.show', compact('submission'));
    }
}
