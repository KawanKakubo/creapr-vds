@extends('layouts.admin')

@section('title', 'Detalhes da Submissão - Admin CREA-PR')

@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Detalhes da Submissão</h1>
                <p class="text-gray-600">Protocolo: <span class="font-mono font-bold text-blue-600">{{ $submission->protocolo }}</span></p>
            </div>
            <a href="{{ route('admin.submissoes.index') }}" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar
            </a>
        </div>

        <!-- Informações do Município -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-6 border-l-4 border-blue-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">1</span>
                Informações do Município
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Município</label>
                    <p class="text-lg text-gray-900 mt-1">{{ $submission->municipio_nome }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Número de Habitantes</label>
                    <p class="text-lg text-gray-900 mt-1">{{ number_format($submission->habitantes_num, 0, ',', '.') }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Prefeito</label>
                    <p class="text-lg text-gray-900 mt-1">{{ $submission->prefeito_nome }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Mandato</label>
                    <p class="text-lg text-gray-900 mt-1">{{ $submission->prefeito_mandato }}</p>
                </div>
            </div>
        </div>

        <!-- Marco Legal e Institucional -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-6 border-l-4 border-green-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="bg-green-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">2</span>
                Marco Legal e Institucional
            </h2>
            <div class="space-y-6">
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <h3 class="font-bold text-gray-900 mb-2">Lei de Inovação</h3>
                    <p class="text-gray-700">
                        <span class="font-semibold">Status:</span> 
                        @if($submission->possui_lei_inovacao)
                            <span class="text-green-600 font-bold">✓ Possui</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não possui</span>
                        @endif
                    </p>
                    @if($submission->possui_lei_inovacao && $submission->link_lei_inovacao)
                        <p class="mt-2">
                            <span class="font-semibold">Link:</span> 
                            <a href="{{ $submission->link_lei_inovacao }}" target="_blank" class="text-blue-600 hover:underline break-all">
                                {{ $submission->link_lei_inovacao }}
                            </a>
                        </p>
                    @endif
                </div>

                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <h3 class="font-bold text-gray-900 mb-2">Fundo de Inovação</h3>
                    <p class="text-gray-700">
                        <span class="font-semibold">Status:</span> 
                        @if($submission->possui_fundo_inovacao)
                            <span class="text-green-600 font-bold">✓ Possui</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não possui</span>
                        @endif
                    </p>
                    @if($submission->possui_fundo_inovacao && $submission->cnpj_fundo_inovacao)
                        <p class="mt-2">
                            <span class="font-semibold">CNPJ:</span> 
                            <span class="font-mono">{{ $submission->cnpj_fundo_inovacao }}</span>
                        </p>
                    @endif
                </div>

                <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                    <h3 class="font-bold text-gray-900 mb-2">Conselho de CTI</h3>
                    <p class="text-gray-700">
                        <span class="font-semibold">Status:</span> 
                        @if($submission->possui_conselho_cti)
                            <span class="text-green-600 font-bold">✓ Possui</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não possui</span>
                        @endif
                    </p>
                    @if($submission->possui_conselho_cti && $submission->link_portaria_conselho)
                        <p class="mt-2">
                            <span class="font-semibold">Link da Portaria:</span> 
                            <a href="{{ $submission->link_portaria_conselho }}" target="_blank" class="text-blue-600 hover:underline break-all">
                                {{ $submission->link_portaria_conselho }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Governança e Estrutura -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-6 border-l-4 border-indigo-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="bg-indigo-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">3</span>
                Governança e Estrutura
            </h2>
            <div class="space-y-6">
                <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-200">
                    <h3 class="font-bold text-gray-900 mb-2">Normativa de Governança Digital</h3>
                    <p class="text-gray-700">
                        <span class="font-semibold">Status:</span> 
                        @if($submission->possui_normativa_governanca)
                            <span class="text-green-600 font-bold">✓ Possui</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não possui</span>
                        @endif
                    </p>
                    @if($submission->possui_normativa_governanca && $submission->link_normativa_governanca)
                        <p class="mt-2">
                            <span class="font-semibold">Link:</span> 
                            <a href="{{ $submission->link_normativa_governanca }}" target="_blank" class="text-blue-600 hover:underline break-all">
                                {{ $submission->link_normativa_governanca }}
                            </a>
                        </p>
                    @endif
                </div>

                <div class="bg-teal-50 rounded-lg p-4 border border-teal-200">
                    <h3 class="font-bold text-gray-900 mb-2">Secretaria de CTI</h3>
                    <p class="text-gray-700">
                        <span class="font-semibold">Status:</span> 
                        @if($submission->possui_secretaria_cti)
                            <span class="text-green-600 font-bold">✓ Possui</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não possui</span>
                        @endif
                    </p>
                    @if(!$submission->possui_secretaria_cti && $submission->orgao_responsavel_cti)
                        <p class="mt-2">
                            <span class="font-semibold">Órgão Responsável:</span> 
                            {{ $submission->orgao_responsavel_cti }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contratos e Políticas Públicas -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-6 border-l-4 border-orange-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="bg-orange-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">4</span>
                Contratos e Políticas Públicas
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-orange-50 rounded-lg p-4 border border-orange-200">
                    <h3 class="font-bold text-gray-900 mb-2">Contrato Solução Inovadora</h3>
                    <p class="text-gray-700">
                        @if($submission->rodou_contrato_solucao_inovadora)
                            <span class="text-green-600 font-bold">✓ Sim</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não</span>
                        @endif
                    </p>
                    @if($submission->rodou_contrato_solucao_inovadora && $submission->link_evidencia_contrato)
                        <a href="{{ $submission->link_evidencia_contrato }}" target="_blank" class="text-blue-600 hover:underline text-sm mt-2 block">Ver evidência</a>
                    @endif
                </div>

                <div class="bg-pink-50 rounded-lg p-4 border border-pink-200">
                    <h3 class="font-bold text-gray-900 mb-2">Sandbox Regulatório</h3>
                    <p class="text-gray-700">
                        @if($submission->possui_politica_sandbox)
                            <span class="text-green-600 font-bold">✓ Sim</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não</span>
                        @endif
                    </p>
                    @if($submission->possui_politica_sandbox && $submission->link_evidencia_sandbox)
                        <a href="{{ $submission->link_evidencia_sandbox }}" target="_blank" class="text-blue-600 hover:underline text-sm mt-2 block">Ver evidência</a>
                    @endif
                </div>

                <div class="bg-lime-50 rounded-lg p-4 border border-lime-200">
                    <h3 class="font-bold text-gray-900 mb-2">Living Lab</h3>
                    <p class="text-gray-700">
                        @if($submission->possui_politica_living_lab)
                            <span class="text-green-600 font-bold">✓ Sim</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não</span>
                        @endif
                    </p>
                    @if($submission->possui_politica_living_lab && $submission->link_evidencia_living_lab)
                        <a href="{{ $submission->link_evidencia_living_lab }}" target="_blank" class="text-blue-600 hover:underline text-sm mt-2 block">Ver evidência</a>
                    @endif
                </div>

                <div class="bg-cyan-50 rounded-lg p-4 border border-cyan-200">
                    <h3 class="font-bold text-gray-900 mb-2">Transformação Digital</h3>
                    <p class="text-gray-700">
                        @if($submission->possui_estrategia_transformacao_digital)
                            <span class="text-green-600 font-bold">✓ Sim</span>
                        @else
                            <span class="text-red-600 font-bold">✗ Não</span>
                        @endif
                    </p>
                    @if($submission->possui_estrategia_transformacao_digital && $submission->link_evidencia_estrategia)
                        <a href="{{ $submission->link_evidencia_estrategia }}" target="_blank" class="text-blue-600 hover:underline text-sm mt-2 block">Ver evidência</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Ecossistema de Inovação -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-6 border-l-4 border-purple-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="bg-purple-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">5</span>
                Ecossistema de Inovação
            </h2>
            
            <div class="mb-6">
                <label class="text-sm font-semibold text-gray-600">Número de Startups</label>
                <p class="text-3xl font-bold text-purple-600 mt-1">{{ $submission->startups_num }}</p>
            </div>

            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200 mb-4">
                <h3 class="font-bold text-gray-900 mb-3">Ambientes Promotores de Inovação</h3>
                @if($submission->ambientes_inovacao && count($submission->ambientes_inovacao) > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($submission->ambientes_inovacao as $ambiente)
                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">{{ $ambiente }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhum ambiente selecionado</p>
                @endif
            </div>

            <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                <h3 class="font-bold text-gray-900 mb-3">Hackathons Realizados</h3>
                @if($submission->hackathons_realizados && count($submission->hackathons_realizados) > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($submission->hackathons_realizados as $hackathon)
                            <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-medium">{{ $hackathon }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">Nenhum hackathon realizado</p>
                @endif
            </div>
        </div>

        <!-- Planejamento e Relevância -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-6 border-l-4 border-emerald-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="bg-emerald-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">6</span>
                Planejamento e Relevância
            </h2>
            
            <div class="bg-emerald-50 rounded-lg p-4 border border-emerald-200 mb-4">
                <h3 class="font-bold text-gray-900 mb-2">Planejamento Estratégico para Cidades Inteligentes</h3>
                <p class="text-gray-700">
                    @if($submission->possui_planejamento_estrategico)
                        <span class="text-green-600 font-bold">✓ Possui</span>
                    @else
                        <span class="text-red-600 font-bold">✗ Não possui</span>
                    @endif
                </p>
                @if($submission->possui_planejamento_estrategico && $submission->link_evidencia_planejamento)
                    <a href="{{ $submission->link_evidencia_planejamento }}" target="_blank" class="text-blue-600 hover:underline text-sm mt-2 block">Ver evidência</a>
                @endif
            </div>

            <div class="mb-4">
                <label class="text-sm font-semibold text-gray-600">Relevância das Engenharias</label>
                <p class="text-lg font-bold mt-1">
                    <span class="px-4 py-2 rounded-full
                        @if($submission->relevancia_engenharias == 'Alta') bg-green-100 text-green-800
                        @elseif($submission->relevancia_engenharias == 'Média') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif
                    ">
                        {{ $submission->relevancia_engenharias }}
                    </span>
                </p>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <label class="text-sm font-semibold text-gray-600">Descrição da Relevância</label>
                <p class="text-gray-900 mt-2 leading-relaxed">{{ $submission->relevancia_engenharias_descricao }}</p>
            </div>
        </div>

        <!-- Premiações -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-6 border-l-4 border-yellow-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="bg-yellow-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">7</span>
                Premiações
            </h2>
            
            <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                <h3 class="font-bold text-gray-900 mb-2">Prêmio de Inovação</h3>
                <p class="text-gray-700 mb-2">
                    @if($submission->ganhou_premio_inovacao)
                        <span class="text-green-600 font-bold">✓ Ganhou prêmio</span>
                    @else
                        <span class="text-red-600 font-bold">✗ Não ganhou prêmio</span>
                    @endif
                </p>
                @if($submission->ganhou_premio_inovacao && $submission->descricao_premio_relevante)
                    <div class="bg-white rounded p-3 mt-3">
                        <label class="text-sm font-semibold text-gray-600">Descrição dos Prêmios</label>
                        <p class="text-gray-900 mt-1">{{ $submission->descricao_premio_relevante }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Ponto Focal -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-6 border-l-4 border-red-600">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="bg-red-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">8</span>
                Ponto Focal (Contato)
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Nome Completo</label>
                    <p class="text-lg text-gray-900 mt-1">{{ $submission->ponto_focal_nome }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Cargo</label>
                    <p class="text-lg text-gray-900 mt-1">{{ $submission->ponto_focal_cargo }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">E-mail</label>
                    <p class="text-lg text-gray-900 mt-1">
                        <a href="mailto:{{ $submission->ponto_focal_email }}" class="text-blue-600 hover:underline">
                            {{ $submission->ponto_focal_email }}
                        </a>
                    </p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Telefone</label>
                    <p class="text-lg text-gray-900 mt-1">{{ $submission->ponto_focal_telefone }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Celular</label>
                    <p class="text-lg text-gray-900 mt-1">{{ $submission->ponto_focal_celular }}</p>
                </div>
            </div>
        </div>

        <!-- Informações da Submissão -->
        <div class="bg-gray-100 rounded-xl p-6">
            <h3 class="font-bold text-gray-900 mb-4">Informações da Submissão</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <label class="text-gray-600 font-medium">Data de Envio</label>
                    <p class="text-gray-900">{{ $submission->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
                <div>
                    <label class="text-gray-600 font-medium">Última Atualização</label>
                    <p class="text-gray-900">{{ $submission->updated_at->format('d/m/Y H:i:s') }}</p>
                </div>
                <div>
                    <label class="text-gray-600 font-medium">ID da Submissão</label>
                    <p class="text-gray-900 font-mono">#{{ $submission->id }}</p>
                </div>
            </div>
        </div>

        <!-- Ações -->
        <div class="mt-8 flex gap-4">
            <a href="{{ route('admin.submissoes.index') }}" 
                class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar à Lista
            </a>
            
            <button onclick="window.print()" 
                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Imprimir
            </button>
        </div>
    </div>
</div>

<style>
    @media print {
        button, a {
            display: none;
        }
        body {
            background: white;
        }
    }
</style>
@endsection
