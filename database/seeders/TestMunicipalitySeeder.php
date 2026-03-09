<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Submission;
use Illuminate\Database\Seeder;

class TestMunicipalitySeeder extends Seeder
{
    /**
     * Seed a test municipality user with a submission.
     */
    public function run(): void
    {
        // Criar usuário município de teste (se não existir)
        $user = User::firstOrCreate(
            ['email' => 'curitiba@teste.com'],
            [
                'name' => 'Município de Curitiba',
                'password' => bcrypt('teste123'),
                'role' => 'municipality',
                'is_temporary_password' => false,
                'must_change_password' => false,
            ]
        );

        // Criar submissão de teste para o usuário (se não existir)
        Submission::firstOrCreate(
            ['user_id' => $user->id],
            [
                'protocolo' => 'CREA-TEST-' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
                'status' => 'approved',
                'municipio_nome' => 'Curitiba',
                'habitantes_num' => 1963726,
                'prefeito_nome' => 'Rafael Greca',
                'prefeito_mandato' => '2º Mandato',
                'regional_creapr' => 'Capital',
                'setores_economicos' => json_encode(['Serviços', 'Tecnologia', 'Indústria']),
                'faz_parte_mais_engenharia' => false,
                
                // Dados do Responsável
                'responsavel_nome' => 'João Silva',
                'responsavel_email' => 'joao.silva@curitiba.pr.gov.br',
                'responsavel_telefone' => '(41) 3350-8000',
                'responsavel_cpf' => '123.456.789-00',
                'responsavel_orgao' => 'Secretaria de Inovação',
                'responsavel_funcao' => 'Secretário',
                'orgao_endereco' => 'Rua João Negrão, 255 - Centro - Curitiba/PR',
                
                // Dados do Prefeito
                'prefeito_cpf' => '987.654.321-00',
                'prefeito_telefone' => '(41) 3350-8000',
                
                // Bloco 1: Lei, Fundo, Conselho - CAMPOS OBRIGATÓRIOS
                'possui_lei_inovacao' => true,
                'link_lei_inovacao' => 'https://exemplo.com/lei-inovacao',
                'possui_fundo_inovacao' => false,
                'possui_conselho_cti' => false,
                
                // Bloco 2: Governança e Estrutura - CAMPOS OBRIGATÓRIOS
                'possui_normativa_governanca' => false,
                'possui_secretaria_cti' => true,
                'orgao_responsavel_cti' => 'Secretaria de Inovação',
                
                // Bloco 3: Contratos e Políticas Públicas - CAMPOS OBRIGATÓRIOS
                'rodou_contrato_solucao_inovadora' => false,
                'possui_politica_sandbox' => false,
                'possui_politica_living_lab' => false,
                'possui_estrategia_transformacao_digital' => false,
                
                // Bloco 4: Ecossistema de Inovação
                'startups_num' => 0,
                
                // Bloco 5: Planejamento e Relevância - CAMPOS OBRIGATÓRIOS
                'possui_planejamento_estrategico' => false,
                'relevancia_engenharias' => 'media',
                'relevancia_engenharias_descricao' => 'Curitiba possui diversos projetos que envolvem engenharia.',
                
                // Bloco 6: Prêmios - CAMPOS OBRIGATÓRIOS
                'ganhou_premio_inovacao' => false,
                
                // Bloco 7: Ponto Focal (Contato) - CAMPOS OBRIGATÓRIOS
                'ponto_focal_nome' => 'João Silva',
                'ponto_focal_cargo' => 'Secretário',
                'ponto_focal_email' => 'joao.silva@curitiba.pr.gov.br',
                'ponto_focal_telefone' => '(41) 3350-8000',
                'ponto_focal_celular' => '(41) 99999-9999',
                
                // Final - CAMPOS OBRIGATÓRIOS
                'declaracao_interesse' => true,
                
                // Políticas Públicas (campos novos)
                'possui_politica_governo_digital' => true,
                'link_evidencia_governo_digital' => 'https://exemplo.com/governo-digital',
                'realizou_cpsi' => false,
                'possui_masterplan' => false,
                
                // Estrutura
                'secretaria_inovacao' => true,
                'secretaria_tecnologia_smart' => false,
                'secretaria_engenharia' => true,
                
                // Pontuações iniciais (zeradas)
                'pontuacao_estimulo' => 0,
                'pontuacao_educacao' => 0,
                'pontuacao_estruturas' => 0,
                
                // Diagnósticos não iniciados
                'diagnostico_estimulo_iniciado_em' => null,
                'diagnostico_estimulo_concluido_em' => null,
                'diagnostico_educacao_iniciado_em' => null,
                'diagnostico_educacao_concluido_em' => null,
                'diagnostico_estruturas_iniciado_em' => null,
                'diagnostico_estruturas_concluido_em' => null,
            ]
        );

        $this->command->info('✅ Usuário de teste criado: curitiba@teste.com / teste123');
        $this->command->info('✅ Submissão de teste criada para Curitiba');
    }
}
