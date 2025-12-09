<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'protocolo',
        'municipio_nome',
        'prefeito_nome',
        'prefeito_mandato',
        'habitantes_num',
        'possui_lei_inovacao',
        'link_lei_inovacao',
        'possui_fundo_inovacao',
        'cnpj_fundo_inovacao',
        'possui_conselho_cti',
        'link_portaria_conselho',
        'possui_normativa_governanca',
        'link_normativa_governanca',
        'possui_secretaria_cti',
        'orgao_responsavel_cti',
        'rodou_contrato_solucao_inovadora',
        'link_evidencia_contrato',
        'possui_politica_sandbox',
        'link_evidencia_sandbox',
        'possui_politica_living_lab',
        'link_evidencia_living_lab',
        'possui_estrategia_transformacao_digital',
        'link_evidencia_estrategia',
        'startups_num',
        'ambientes_inovacao',
        'hackathons_realizados',
        'possui_planejamento_estrategico',
        'link_evidencia_planejamento',
        'relevancia_engenharias',
        'relevancia_engenharias_descricao',
        'ganhou_premio_inovacao',
        'descricao_premio_relevante',
        'ponto_focal_nome',
        'ponto_focal_cargo',
        'ponto_focal_email',
        'ponto_focal_telefone',
        'ponto_focal_celular',
        'declaracao_interesse',
    ];

    protected $casts = [
        'possui_lei_inovacao' => 'boolean',
        'possui_fundo_inovacao' => 'boolean',
        'possui_conselho_cti' => 'boolean',
        'possui_normativa_governanca' => 'boolean',
        'possui_secretaria_cti' => 'boolean',
        'rodou_contrato_solucao_inovadora' => 'boolean',
        'possui_politica_sandbox' => 'boolean',
        'possui_politica_living_lab' => 'boolean',
        'possui_estrategia_transformacao_digital' => 'boolean',
        'possui_planejamento_estrategico' => 'boolean',
        'ganhou_premio_inovacao' => 'boolean',
        'declaracao_interesse' => 'boolean',
        'ambientes_inovacao' => 'array',
        'hackathons_realizados' => 'array',
        'habitantes_num' => 'integer',
        'startups_num' => 'integer',
    ];
}
