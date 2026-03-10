<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Smart Crea Cities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        .gauge-container {
            position: relative;
            width: 100%;
            max-width: 280px;
            margin: 0 auto;
        }
        
        .status-badge {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 md:h-26 lg:h-30">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('assets/img/card-smart-crea-cities-negativo.png') }}" alt="Smart Crea Cities" class="h-20 sm:h-24 md:h-28 w-auto object-contain">
                    <div class="border-l border-gray-300 h-10"></div>
                    <div>
                        <p class="text-sm text-gray-600">Município</p>
                        <p class="font-bold text-blue-900">{{ $submission->municipio_nome }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ $submission->responsavel_funcao }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Status da Manifestação -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Dashboard - Smart Crea Cities</h1>
                    <p class="text-gray-600">Protocolo: <span class="font-mono font-bold text-blue-600">{{ $submission->protocolo }}</span></p>
                </div>
                <div>
                    @if($submission->status === 'pending')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 status-badge">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            EM ANÁLISE
                        </span>
                    @elseif($submission->status === 'approved')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            APROVADO
                        </span>
                    @elseif($submission->status === 'under_review')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-blue-100 text-blue-800 status-badge">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            EM SELEÇÃO
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-6 mb-8 rounded-lg shadow-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-semibold text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('warning'))
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-8 rounded-lg shadow-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <p class="font-semibold text-yellow-800">{{ session('warning') }}</p>
                </div>
            </div>
        @endif

        <!-- Diagnósticos - 3 Gauge Charts -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Diagnóstico da Trilha Formativa dos 3'Es</h2>
            
            @if(!$submission->isApproved())
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-yellow-800">Aguardando Aprovação</p>
                            <p class="text-sm text-yellow-700">Os diagnósticos estarão disponíveis após aprovação da manifestação pelo CREA-PR.</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Gauge 1: Estímulo -->
                <div class="text-center">
                    <div class="gauge-container">
                        <canvas id="gaugeEstimulo"></canvas>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mt-4 mb-2">Estímulo</h3>
                    <p class="text-sm text-gray-600 mb-4">Fomento à Inovação</p>
                    
                    @if($submission->isApproved())
                        @if($diagnosticStatus['estimulo']['concluido'])
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Concluído
                            </span>
                        @elseif($diagnosticStatus['estimulo']['iniciado'])
                            <a href="{{ route('municipality.diagnostic.estimulo') }}" 
                               class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition font-semibold text-sm">
                                Continuar Diagnóstico
                            </a>
                        @else
                            <a href="{{ route('municipality.diagnostic.estimulo') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                                Iniciar Diagnóstico
                            </a>
                        @endif
                    @else
                        <button disabled class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Bloqueado
                        </button>
                    @endif
                </div>

                <!-- Gauge 2: Educação -->
                <div class="text-center">
                    <div class="gauge-container">
                        <canvas id="gaugeEducacao"></canvas>
                    </div>
                    <h3 class="text-xl font-bold text-green-900 mt-4 mb-2">Educação</h3>
                    <p class="text-sm text-gray-600 mb-4">Capacitação Tecnológica</p>
                    
                    @if($submission->isApproved())
                        @if($diagnosticStatus['educacao']['concluido'])
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Concluído
                            </span>
                        @elseif($diagnosticStatus['educacao']['iniciado'])
                            <a href="{{ route('municipality.diagnostic.educacao') }}" 
                               class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition font-semibold text-sm">
                                Continuar Diagnóstico
                            </a>
                        @else
                            <a href="{{ route('municipality.diagnostic.educacao') }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold text-sm">
                                Iniciar Diagnóstico
                            </a>
                        @endif
                    @else
                        <button disabled class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Bloqueado
                        </button>
                    @endif
                </div>

                <!-- Gauge 3: Estruturas -->
                <div class="text-center">
                    <div class="gauge-container">
                        <canvas id="gaugeEstruturas"></canvas>
                    </div>
                    <h3 class="text-xl font-bold text-purple-900 mt-4 mb-2">Estruturas</h3>
                    <p class="text-sm text-gray-600 mb-4">Infraestrutura Tecnológica</p>
                    
                    @if($submission->isApproved())
                        @if($diagnosticStatus['estruturas']['concluido'])
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Concluído
                            </span>
                        @elseif($diagnosticStatus['estruturas']['iniciado'])
                            <a href="{{ route('municipality.diagnostic.estruturas') }}" 
                               class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition font-semibold text-sm">
                                Continuar Diagnóstico
                            </a>
                        @else
                            <a href="{{ route('municipality.diagnostic.estruturas') }}" 
                               class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold text-sm">
                                Iniciar Diagnóstico
                            </a>
                        @endif
                    @else
                        <button disabled class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Bloqueado
                        </button>
                    @endif
                </div>
            </div>

            <!-- Score Total -->
            @if($submission->isApproved() && ($diagnosticStatus['estimulo']['concluido'] || $diagnosticStatus['educacao']['concluido'] || $diagnosticStatus['estruturas']['concluido']))
                <div class="mt-8 text-center">
                    <div class="inline-block bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 border-2 border-blue-200">
                        <p class="text-sm text-gray-600 mb-1">Pontuação Total</p>
                        <p class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                            {{ $diagnosticStatus['estimulo']['score'] + $diagnosticStatus['educacao']['score'] + $diagnosticStatus['estruturas']['score'] }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">de 300 pontos possíveis</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Calendário de Eventos -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Calendário do Programa
                </h3>

                @if($upcomingEvents->count() > 0)
                    <div class="space-y-3">
                        @foreach($upcomingEvents as $event)
                            <div class="flex items-start space-x-3 p-3 border border-gray-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition">
                                <div class="flex-shrink-0 text-center bg-blue-600 text-white rounded-lg p-2 min-w-[60px]">
                                    <div class="text-xl font-bold">{{ $event->event_date->format('d') }}</div>
                                    <div class="text-xs uppercase">{{ $event->event_date->locale('pt_BR')->format('M') }}</div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900">{{ $event->title }}</p>
                                    <div class="flex items-center gap-2 mt-1 text-sm text-gray-600">
                                        @if($event->event_time)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}
                                        </span>
                                        @endif
                                        @if($event->location)
                                        <span class="text-gray-400">•</span>
                                        <span class="flex items-center gap-1 truncate">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $event->location }}
                                        </span>
                                        @endif
                                    </div>
                                    @if($event->description)
                                    <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ $event->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="font-semibold">Em breve</p>
                        <p class="text-sm">Novos eventos serão publicados aqui</p>
                    </div>
                @endif
            </div>

            <!-- Comitê Smart Crea Cities -->
            <div class="bg-white rounded-xl shadow-lg p-6" x-data="committeeManager()">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Comitê Smart Crea ({{ $committeeMembers->count() }}/5)
                    </h3>
                    @if($committeeMembers->count() < 5)
                        <button @click="showModal = true" class="text-sm bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                            + Adicionar Membro
                        </button>
                    @endif
                </div>

                @if($committeeMembers->count() > 0)
                    <div class="space-y-2">
                        @foreach($committeeMembers as $member)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $member->nome }}</p>
                                    <p class="text-sm text-gray-600">{{ $member->cargo }} - {{ $member->orgao }}</p>
                                    <p class="text-xs text-gray-500">{{ $member->email }}</p>
                                </div>
                                <button @click="deleteMember({{ $member->id }})" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p class="font-semibold mb-2">Nenhum membro cadastrado</p>
                        <p class="text-sm">O comitê deve ser composto por 5 membros</p>
                    </div>
                @endif

                <!-- Modal Adicionar Membro -->
                <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <div @click="showModal = false" class="fixed inset-0 bg-black opacity-50"></div>
                        <div class="relative bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Adicionar Membro do Comitê</h4>
                            <form @submit.prevent="submitMember" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nome Completo *</label>
                                    <input type="text" x-model="form.nome" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">CPF *</label>
                                    <input type="text" x-model="form.cpf" @input="maskCPF" required placeholder="000.000.000-00" maxlength="14" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail *</label>
                                    <input type="email" x-model="form.email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Digite um email válido" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                    <p class="text-xs text-gray-500 mt-1">Ex: nome@exemplo.com</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Telefone *</label>
                                    <input type="text" x-model="form.telefone" @input="maskPhone" required placeholder="(00) 00000-0000" maxlength="15" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Cargo *</label>
                                    <input type="text" x-model="form.cargo" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Órgão *</label>
                                    <input type="text" x-model="form.orgao" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div class="flex space-x-3 mt-6">
                                    <button type="button" @click="showModal = false" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                        Adicionar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Repositório de Documentos -->
        <div class="bg-white rounded-xl shadow-lg p-6 mt-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Repositório de Documentos
                </h3>
                <a href="{{ route('municipality.repository.index') }}" class="text-sm bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition font-semibold">
                    Ver Todos
                </a>
            </div>

            @if($recentDocuments && $recentDocuments->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($recentDocuments as $document)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-purple-400 hover:bg-purple-50 transition">
                            <div class="flex items-start justify-between mb-2">
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                    @if($document->category === 'oficio') bg-blue-100 text-blue-800
                                    @elseif($document->category === 'decreto') bg-purple-100 text-purple-800
                                    @elseif($document->category === 'lei') bg-green-100 text-green-800
                                    @elseif($document->category === 'template') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $document->category_label }}
                                </span>
                                <span class="text-xs text-gray-500">{{ $document->formatted_size }}</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $document->title }}</h4>
                            <a href="{{ route('municipality.repository.download', $document) }}" class="inline-flex items-center text-sm text-purple-600 hover:text-purple-800 font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Baixar
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="font-semibold">Em breve</p>
                    <p class="text-sm">Documentos e templates serão disponibilizados aqui</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Configuração dos Gauge Charts
        const gaugeConfig = (score, color) => ({
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [score, 100 - score],
                    backgroundColor: [color, '#e5e7eb'],
                    borderWidth: 0,
                    circumference: 180,
                    rotation: 270
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                cutout: '75%'
            },
            plugins: [{
                id: 'centerText',
                beforeDraw: (chart) => {
                    const { width, height, ctx } = chart;
                    ctx.restore();
                    const fontSize = (height / 100).toFixed(2);
                    ctx.font = `bold ${fontSize}em sans-serif`;
                    ctx.textBaseline = 'middle';
                    const text = `${score}%`;
                    const textX = Math.round((width - ctx.measureText(text).width) / 2);
                    const textY = height / 1.7;
                    ctx.fillStyle = color;
                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }]
        });

        // Inicializar os 3 gauges
        new Chart(document.getElementById('gaugeEstimulo'), gaugeConfig({{ $diagnosticStatus['estimulo']['score'] }}, '#2563eb'));
        new Chart(document.getElementById('gaugeEducacao'), gaugeConfig({{ $diagnosticStatus['educacao']['score'] }}, '#16a34a'));
        new Chart(document.getElementById('gaugeEstruturas'), gaugeConfig({{ $diagnosticStatus['estruturas']['score'] }}, '#9333ea'));

        // Alpine.js - Gerenciador de Comitê
        function committeeManager() {
            return {
                showModal: false,
                form: {
                    nome: '',
                    cpf: '',
                    email: '',
                    telefone: '',
                    cargo: '',
                    orgao: ''
                },
                // Máscara de CPF: 000.000.000-00
                maskCPF(event) {
                    let value = event.target.value.replace(/\D/g, '');
                    if (value.length > 11) value = value.slice(0, 11);
                    
                    if (value.length > 9) {
                        this.form.cpf = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
                    } else if (value.length > 6) {
                        this.form.cpf = value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
                    } else if (value.length > 3) {
                        this.form.cpf = value.replace(/(\d{3})(\d{1,3})/, '$1.$2');
                    } else {
                        this.form.cpf = value;
                    }
                },
                // Máscara de Telefone: (00) 00000-0000 ou (00) 0000-0000
                maskPhone(event) {
                    let value = event.target.value.replace(/\D/g, '');
                    if (value.length > 11) value = value.slice(0, 11);
                    
                    if (value.length > 10) {
                        this.form.telefone = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                    } else if (value.length > 6) {
                        this.form.telefone = value.replace(/(\d{2})(\d{4})(\d{1,4})/, '($1) $2-$3');
                    } else if (value.length > 2) {
                        this.form.telefone = value.replace(/(\d{2})(\d{1,5})/, '($1) $2');
                    } else if (value.length > 0) {
                        this.form.telefone = value.replace(/(\d{1,2})/, '($1');
                    } else {
                        this.form.telefone = '';
                    }
                },
                // Validar email antes de enviar
                validateEmail(email) {
                    const regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
                    return regex.test(email);
                },
                submitMember() {
                    // Validar email
                    if (!this.validateEmail(this.form.email)) {
                        alert('Por favor, digite um email válido.');
                        return;
                    }
                    
                    // Validar CPF (mínimo 11 dígitos)
                    const cpfDigits = this.form.cpf.replace(/\D/g, '');
                    if (cpfDigits.length !== 11) {
                        alert('Por favor, digite um CPF válido com 11 dígitos.');
                        return;
                    }
                    
                    // Validar telefone (mínimo 10 dígitos)
                    const phoneDigits = this.form.telefone.replace(/\D/g, '');
                    if (phoneDigits.length < 10) {
                        alert('Por favor, digite um telefone válido com DDD.');
                        return;
                    }
                    
                    fetch('{{ route("municipality.committee.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.form)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        }
                    });
                },
                deleteMember(id) {
                    if (confirm('Deseja remover este membro do comitê?')) {
                        fetch(`/municipality/committee/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                            }
                        });
                    }
                }
            };
        }
    </script>
</body>
</html>
