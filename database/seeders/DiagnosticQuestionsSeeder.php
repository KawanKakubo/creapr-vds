<?php

namespace Database\Seeders;

use App\Models\DiagnosticQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosticQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa perguntas existentes
        DiagnosticQuestion::truncate();

        // ========================================
        // CATEGORIA: ESTÍMULO (9 perguntas)
        // ========================================
        
        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O município possui Lei Municipal de Inovação?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 1,
            'is_active' => true,
            'description' => 'Lei que estabelece medidas de incentivo à inovação e à pesquisa científica e tecnológica no ambiente produtivo.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O município possui política de Governo Digital implantada?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 2,
            'is_active' => true,
            'description' => 'Política que orienta a digitalização de serviços públicos e transformação digital da gestão municipal.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Quais ambientes de inovação estão presentes no município?',
            'type' => 'checkbox',
            'options' => ['Incubadora', 'Aceleradora', 'Coworking', 'Hub de Inovação', 'Parque Tecnológico', 'Living Lab', 'Nenhum'],
            'requires_evidence' => false,
            'order' => 3,
            'is_active' => true,
            'description' => 'Selecione todos os ambientes de inovação presentes ou operantes no município.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O município possui Fundo Municipal de Inovação?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 4,
            'is_active' => true,
            'description' => 'Fundo específico para financiamento de projetos de inovação e tecnologia.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O município possui Conselho Municipal de CTI (Ciência, Tecnologia e Inovação)?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 5,
            'is_active' => true,
            'description' => 'Órgão colegiado consultivo ou deliberativo sobre políticas de CTI no município.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O município já executou contratos de soluções inovadoras?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 6,
            'is_active' => true,
            'description' => 'Contratos públicos que envolveram aquisição ou desenvolvimento de soluções tecnológicas inovadoras.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Quantas startups ou empresas de tecnologia estão sediadas no município?',
            'type' => 'multiple_input',
            'options' => ['Startups', 'Empresas de Software', 'Empresas de Tecnologia'],
            'requires_evidence' => false,
            'order' => 7,
            'is_active' => true,
            'description' => 'Informe o número aproximado de empresas em cada categoria.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'O município realizou hackathons ou eventos de inovação nos últimos 2 anos?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 8,
            'is_active' => true,
            'description' => 'Eventos que promovam inovação, empreendedorismo ou desenvolvimento tecnológico.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estimulo',
            'question' => 'Descreva as principais iniciativas de estímulo à inovação no município.',
            'type' => 'text',
            'options' => null,
            'requires_evidence' => false,
            'order' => 9,
            'is_active' => true,
            'description' => 'Descreva brevemente programas, projetos ou ações desenvolvidas pela gestão municipal.'
        ]);

        // ========================================
        // CATEGORIA: EDUCAÇÃO (11 perguntas)
        // ========================================

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Quantas escolas de ensino fundamental (anos iniciais) existem no município?',
            'type' => 'multiple_input',
            'options' => ['Municipais', 'Estaduais', 'Particulares'],
            'requires_evidence' => false,
            'order' => 1,
            'is_active' => true,
            'description' => 'Informe o número de escolas por tipo de rede de ensino.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Quantas escolas de ensino fundamental (anos finais) existem no município?',
            'type' => 'multiple_input',
            'options' => ['Municipais', 'Estaduais', 'Particulares'],
            'requires_evidence' => false,
            'order' => 2,
            'is_active' => true,
            'description' => 'Informe o número de escolas por tipo de rede de ensino.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Quantas escolas de ensino médio existem no município?',
            'type' => 'multiple_input',
            'options' => ['Estaduais', 'Particulares', 'Técnicas'],
            'requires_evidence' => false,
            'order' => 3,
            'is_active' => true,
            'description' => 'Informe o número de escolas por tipo de rede de ensino.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'O município possui instituições de ensino superior presenciais?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 4,
            'is_active' => true,
            'description' => 'Universidades, faculdades ou institutos federais presentes no município.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'As escolas municipais aplicam conceitos de novos letramentos digitais?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 5,
            'is_active' => true,
            'description' => 'Programas de alfabetização digital, pensamento computacional, robótica educacional, etc.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'O município realizou hackathons ou eventos educacionais sobre tecnologia?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 6,
            'is_active' => true,
            'description' => 'Eventos voltados para estudantes sobre programação, inovação ou tecnologia.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Quais recursos tecnológicos estão disponíveis nas escolas municipais?',
            'type' => 'checkbox',
            'options' => ['Laboratórios de Informática', 'Internet de Alta Velocidade', 'Tablets/Chromebooks', 'Lousas Digitais', 'Plataformas de Ensino Online', 'Robótica Educacional', 'Nenhum'],
            'requires_evidence' => false,
            'order' => 7,
            'is_active' => true,
            'description' => 'Selecione todos os recursos disponíveis nas escolas da rede municipal.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Os professores recebem capacitação em tecnologias educacionais?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 8,
            'is_active' => true,
            'description' => 'Programas de formação continuada sobre uso de tecnologias no ensino.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'O município possui parcerias com instituições de ensino para projetos educacionais?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 9,
            'is_active' => true,
            'description' => 'Convênios ou parcerias com universidades, institutos ou organizações educacionais.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Existe um plano municipal de educação que contempla tecnologia e inovação?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 10,
            'is_active' => true,
            'description' => 'Plano que estabeleça metas e estratégias para integração da tecnologia na educação.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'educacao',
            'question' => 'Descreva os principais projetos educacionais relacionados à tecnologia.',
            'type' => 'text',
            'options' => null,
            'requires_evidence' => false,
            'order' => 11,
            'is_active' => true,
            'description' => 'Apresente resumidamente os projetos desenvolvidos na área educacional com foco em tecnologia.'
        ]);

        // ========================================
        // CATEGORIA: ESTRUTURAS (15 perguntas)
        // ========================================

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui Plano Diretor atualizado?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 1,
            'is_active' => true,
            'description' => 'Plano Diretor revisado nos últimos 10 anos conforme Estatuto da Cidade.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O Plano Diretor contempla conceitos de cidades inteligentes?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 2,
            'is_active' => true,
            'description' => 'Diretrizes sobre mobilidade inteligente, infraestrutura digital, IoT, etc.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Quais sistemas de monitoramento urbano estão implantados?',
            'type' => 'checkbox',
            'options' => ['Câmeras de Segurança', 'Sensores de Tráfego', 'Monitoramento Ambiental', 'Iluminação Inteligente', 'Gestão de Resíduos Inteligente', 'Nenhum'],
            'requires_evidence' => false,
            'order' => 3,
            'is_active' => true,
            'description' => 'Selecione todos os sistemas de monitoramento em operação no município.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui cobertura de internet de alta velocidade?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 4,
            'is_active' => true,
            'description' => 'Disponibilidade de fibra óptica ou 4G/5G na área urbana.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Qual a cobertura percentual de rede de fibra óptica na área urbana?',
            'type' => 'multiple_input',
            'options' => ['Percentual de Cobertura (%)'],
            'requires_evidence' => false,
            'order' => 5,
            'is_active' => true,
            'description' => 'Informe o percentual aproximado da área urbana com cobertura de fibra óptica.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui Wi-Fi público gratuito?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 6,
            'is_active' => true,
            'description' => 'Pontos de acesso Wi-Fi livre em praças, parques ou prédios públicos.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Quais infraestruturas tecnológicas estão disponíveis na gestão pública?',
            'type' => 'checkbox',
            'options' => ['Data Center Municipal', 'Nuvem Privada', 'Nuvem Pública', 'Sistemas Integrados de Gestão', 'API de Dados Abertos', 'Plataforma de GIS', 'Nenhum'],
            'requires_evidence' => false,
            'order' => 7,
            'is_active' => true,
            'description' => 'Selecione as infraestruturas tecnológicas utilizadas pela prefeitura.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui normativa de proteção de dados (LGPD)?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 8,
            'is_active' => true,
            'description' => 'Decreto ou normativa municipal sobre tratamento e proteção de dados pessoais.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui DPO (Data Protection Officer) designado?',
            'type' => 'yes_no',
            'options' => null,
            'requires_evidence' => false,
            'order' => 9,
            'is_active' => true,
            'description' => 'Encarregado de dados conforme LGPD.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Os sistemas da prefeitura são interoperáveis?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 10,
            'is_active' => true,
            'description' => 'Sistemas diferentes conseguem trocar informações entre si de forma automatizada.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município utiliza ferramentas de gestão de identidades digitais?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 11,
            'is_active' => true,
            'description' => 'Sistemas de autenticação única (SSO), certificação digital, gov.br, etc.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Quais serviços públicos estão digitalizados?',
            'type' => 'checkbox',
            'options' => ['Emissão de Certidões Online', 'Pagamento de Tributos Online', 'Agendamento Online', 'Protocolo Digital', 'Ouvidoria Digital', 'Portal de Transparência', 'Nenhum'],
            'requires_evidence' => false,
            'order' => 12,
            'is_active' => true,
            'description' => 'Selecione todos os serviços disponíveis online para o cidadão.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui Centro de Operações ou similar?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 13,
            'is_active' => true,
            'description' => 'Centro integrado para monitoramento e gestão de serviços urbanos.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'O município possui estratégia de transformação digital documentada?',
            'type' => 'yes_no_evidence',
            'options' => null,
            'requires_evidence' => true,
            'order' => 14,
            'is_active' => true,
            'description' => 'Plano ou roadmap para digitalização de processos e serviços públicos.'
        ]);

        DiagnosticQuestion::create([
            'category' => 'estruturas',
            'question' => 'Descreva a infraestrutura tecnológica mais relevante do município.',
            'type' => 'text',
            'options' => null,
            'requires_evidence' => false,
            'order' => 15,
            'is_active' => true,
            'description' => 'Apresente resumidamente as principais infraestruturas tecnológicas implantadas.'
        ]);
    }
}
