<?php

namespace Database\Seeders;

use App\Models\DiagnosticQuestion;
use Illuminate\Database\Seeder;

class DiagnosticQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        DiagnosticQuestion::truncate();

        // ESTÍMULO (9 perguntas)
        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Possui Lei de Inovação?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 1,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link da evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Possui Política de Sandbox regulatório em conformidade com a Lei Complementar 182/2021?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 2,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link de evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Possui Política de Governo Digital em conformidade com a Lei 14.129/2021?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 3,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link de evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Já realizou alguma Contratação Pública de Solução Inovadora (CPSI) utilizando a lei complementar 182/2021?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 4,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link de evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Possui Planejamento Estratégico de Longo Prazo (10 anos ou mais)?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 5,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link de evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Possui Normativa regulamentando a Lei Geral de Proteção de Dados (Lei 13.709/2018)?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 6,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O Governo Municipal já realizou algum movimento de inovação (ideathons/hackathons) com algum segmento econômico da cidade?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 7,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com evidências'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O Município Possui alguma Startup legalizada?',
            'type' => 'repeatable_fields',
            'options' => ['Nome da Startup', 'Segmento de Atuação'],
            'requires_evidence' => false,
            'order' => 8,
            'is_active' => true,
            'description' => 'Caso sim, nome da startup e segmento de atuação (botão de inclusão para incluir várias)'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O Governo Municipal possui algum programa para oportunidades aos empreendedores locais?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 9,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com evidências'
        ]);

        // EDUCAÇÃO (11 perguntas)
        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Possui alguma instituição de Ensino Técnico na cidade?',
            'type' => 'repeatable_fields',
            'options' => ['Nome da Instituição', 'Cursos Ofertados (separados por ;)'],
            'requires_evidence' => false,
            'order' => 1,
            'is_active' => true,
            'description' => 'Caso sim, informe nomes de instituições e cursos ofertados (botão de inclusão para várias)'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Possui alguma universidade pública com ensino presencial na cidade?',
            'type' => 'repeatable_fields',
            'options' => ['Nome da Instituição', 'Cursos Ofertados (separados por ;)'],
            'requires_evidence' => false,
            'order' => 2,
            'is_active' => true,
            'description' => 'Caso sim, informe nomes de instituições e cursos ofertados (botão de inclusão para várias)'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Possui alguma universidade privada com ensino presencial na cidade?',
            'type' => 'repeatable_fields',
            'options' => ['Nome da Instituição', 'Cursos Ofertados (separados por ;)'],
            'requires_evidence' => false,
            'order' => 3,
            'is_active' => true,
            'description' => 'Caso sim, informe nomes de instituições e cursos ofertados (botão de inclusão para várias)'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'O Governo Municipal oferta algum programa para Letramento Digital do cidadão?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 4,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link de evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'O Governo Municipal oferta algum programa para Letramento em Soft Skills?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 5,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link de evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'O Governo Municipal oferta algum programa para Letramento em Green Skills?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 6,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link de evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'O Governo Municipal já realizou movimentos de Inovação (Hackathons/Ideathons) na Educação Básica, seja ela pública ou privada?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 7,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com evidências'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Possui algum programa para gestão de talentos (formar, atrair e reter)?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 8,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com evidências'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Faz uso de tecnologia em Sala de Aula na Rede Municipal de Educação?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 9,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com evidências'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Faz uso de métodos ativos em Sala de Aula na Rede Municipal de Educação?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 10,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com evidências'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'A Rede Municipal de Educação aplica STEAM (Ciência, Tecnologia, Engenharia, Artes e Matemática) no processo de aprendizagem do aluno?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 11,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com evidências'
        ]);

        // ESTRUTURAS (15 perguntas)
        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Qual o nível de interoperabilidade dos sistemas de gestão?',
            'type' => 'checkbox',
            'options' => [
                'Educação', 
                'Saúde', 
                'Assistência Social', 
                'Meio Ambiente', 
                'Planejamento e Orçamento', 
                'Finanças e Tributação', 
                'Recursos Humanos', 
                'Obras e Infraestrutura',
                'Transporte e Mobilidade',
                'Cultura e Turismo',
                'Segurança Pública',
                'Agricultura',
                'Habitação'
            ],
            'requires_evidence' => false,
            'order' => 1,
            'is_active' => true,
            'description' => 'Selecione as áreas onde existe interoperabilidade de sistemas'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Possui ambiente promotores de inovação certificados pela Separtec?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 2,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O Governo Municipal possui alguma ferramenta de Gestão de Identidades para promover a interoperabilidade de dados e a individualização das políticas públicas para o cidadão?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 3,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Possui Plano Diretor de Cidade Inteligente?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 4,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Possui Plano Diretor para Comunidade Inteligente?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 5,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui algum projeto voltado para Energias Renováveis?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 6,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município já está fazendo o uso de BIM na elaboração de seus projetos?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 7,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui algum projeto de economia verde?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 8,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui algum projeto de economia azul?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 9,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui algum projeto de Fazenda/Horta Urbana?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 10,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui algum projeto para engajamento digital do cidadão?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 11,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O governo municipal utiliza IoT (Internet of Things) para controle operacionais da cidade?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 12,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui algum projeto com o uso de beacons para o Turismo Inteligente?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 13,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui algum projeto para o fortalecimento do comércio local através do uso de tecnologias?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 14,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui algum projeto para a realização de compras públicas inteligentes (que priorize os negócios locais)?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 15,
            'is_active' => true,
            'description' => 'Caso sim, apresente o link com a evidência'
        ]);
    }
}
