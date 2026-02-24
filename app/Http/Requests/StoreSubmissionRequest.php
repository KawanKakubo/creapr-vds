<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Informações do Município
            'municipio_nome' => 'required|string|max:255',
            'prefeito_nome' => 'required|string|max:255',
            'prefeito_mandato' => 'required|string|max:50',
            'habitantes_num' => 'required|integer|min:1',
            
            // Bloco 1: Lei, Fundo, Conselho
            'possui_lei_inovacao' => 'required|boolean',
            'link_lei_inovacao' => 'required_if:possui_lei_inovacao,1|nullable|url|max:255',
            'possui_fundo_inovacao' => 'required|boolean',
            'cnpj_fundo_inovacao' => 'required_if:possui_fundo_inovacao,1|nullable|string|max:255',
            'possui_conselho_cti' => 'required|boolean',
            'link_portaria_conselho' => 'required_if:possui_conselho_cti,1|nullable|url|max:255',
            
            // Bloco 2: Governança e Estrutura
            'possui_normativa_governanca' => 'required|boolean',
            'link_normativa_governanca' => 'required_if:possui_normativa_governanca,1|nullable|url|max:255',
            'possui_secretaria_cti' => 'required|boolean',
            'orgao_responsavel_cti' => 'required_if:possui_secretaria_cti,0|nullable|string|max:255',
            
            // Bloco 3: Contratos e Políticas Públicas
            'rodou_contrato_solucao_inovadora' => 'required|boolean',
            'link_evidencia_contrato' => 'required_if:rodou_contrato_solucao_inovadora,1|nullable|url|max:255',
            'possui_politica_sandbox' => 'required|boolean',
            'link_evidencia_sandbox' => 'required_if:possui_politica_sandbox,1|nullable|url|max:255',
            'possui_politica_living_lab' => 'required|boolean',
            'link_evidencia_living_lab' => 'required_if:possui_politica_living_lab,1|nullable|url|max:255',
            'possui_estrategia_transformacao_digital' => 'required|boolean',
            'link_evidencia_estrategia' => 'required_if:possui_estrategia_transformacao_digital,1|nullable|url|max:255',
            
            // Bloco 4: Ecossistema de Inovação
            'startups_num' => 'required|integer|min:0',
            'ambientes_inovacao' => 'nullable|array',
            'ambientes_inovacao.*' => 'string|in:Coworking,Espaço Maker,Agência de Inovação,Parque Tecnológico,Centro de Inovação,Hub de Inovação,Incubadoras,Aceleradoras,Hotel de Projetos',
            'hackathons_realizados' => 'nullable|array',
            'hackathons_realizados.*' => 'string|in:Com Ensino Superior,Com Educação Básica,Com Empreendedores,Com Agricultores',
            
            // Bloco 5: Planejamento e Relevância
            'possui_planejamento_estrategico' => 'required|boolean',
            'link_evidencia_planejamento' => 'required_if:possui_planejamento_estrategico,1|nullable|url|max:255',
            'relevancia_engenharias' => 'required|in:Alta,Média,Baixa',
            'relevancia_engenharias_descricao' => 'required|string',
            
            // Bloco 6: Prêmios
            'ganhou_premio_inovacao' => 'required|boolean',
            'descricao_premio_relevante' => 'required_if:ganhou_premio_inovacao,1|nullable|string',
            
            // Bloco 7: Ponto Focal (Contato)
            'ponto_focal_nome' => 'required|string|max:255',
            'ponto_focal_cargo' => 'required|string|max:255',
            'ponto_focal_email' => 'required|email|max:255',
            'ponto_focal_telefone' => 'required|string|max:20',
            'ponto_focal_celular' => 'required|string|max:20',
            
            // Final
            'declaracao_interesse' => 'required|accepted',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'declaracao_interesse.accepted' => 'Você deve aceitar a declaração de interesse para continuar.',
            'prefeito_mandato.in' => 'Selecione um mandato válido.',
            'relevancia_engenharias.in' => 'Selecione uma relevância válida.',
        ];
    }
    
    /**
     * Sanitiza os dados após validação
     *
     * @return array
     */
    protected function passedValidation()
    {
        // Sanitiza campos de texto para remover scripts maliciosos
        $textFields = [
            'municipio_nome', 'prefeito_nome', 'prefeito_mandato', 'orgao_responsavel_cti',
            'relevancia_engenharias_descricao', 'descricao_premio_relevante',
            'ponto_focal_nome', 'ponto_focal_cargo', 'cnpj_fundo_inovacao'
        ];
        
        foreach ($textFields as $field) {
            if ($this->has($field)) {
                $this->merge([
                    $field => strip_tags($this->input($field))
                ]);
            }
        }
    }
}
