<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Crea Cities 2026 | CREA-PR</title>
    <meta name="description" content="Programa Smart Crea Cities 2026 - Transformando municípios paranaenses em Territórios Inteligentes">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-2 md:space-x-4">
                    <img src="{{ asset('assets/img/smart-crea-cities.png') }}" alt="Smart Crea Cities" class="h-8 md:h-12">
                    <img src="{{ asset('assets/img/logo-crea-pr-preto.png') }}" alt="CREA-PR" class="h-7 md:h-10">
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
                    <a href="#sobre" class="text-gray-700 hover:text-blue-600 font-medium transition text-sm lg:text-base">Sobre</a>
                    <a href="#objetivos" class="text-gray-700 hover:text-blue-600 font-medium transition text-sm lg:text-base">Objetivos</a>
                    <a href="#etapas" class="text-gray-700 hover:text-blue-600 font-medium transition text-sm lg:text-base">Etapas</a>
                    <a href="#piloto" class="text-gray-700 hover:text-blue-600 font-medium transition text-sm lg:text-base">Piloto</a>
                    <a href="{{ route('manifestacao.show') }}" class="bg-blue-600 text-white px-4 lg:px-6 py-2 lg:py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md hover:shadow-lg text-sm lg:text-base">
                        Manifestar Interesse
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium transition text-sm lg:text-base">Admin</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden border-t border-gray-200 bg-white"
             style="display: none;">
            <div class="px-4 py-3 space-y-3">
                <a href="#sobre" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition">Sobre o Programa</a>
                <a href="#objetivos" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition">Objetivos</a>
                <a href="#etapas" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition">Etapas</a>
                <a href="#piloto" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition">Projeto Piloto</a>
                <a href="{{ route('manifestacao.show') }}" class="block px-4 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition text-center shadow-md">
                    Manifestar Interesse
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition">Painel Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 md:pt-32 pb-12 md:pb-20 bg-gradient-to-br from-blue-50 via-white to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">
                <div>
                    <div class="inline-block bg-blue-100 text-blue-800 px-3 md:px-4 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-4 md:mb-6">
                        Programa CREA-PR 2026
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4 md:mb-6 leading-tight">
                        Smart Crea <span class="text-blue-600">Cities</span>
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl text-gray-600 mb-6 md:mb-8 leading-relaxed">
                        Transformando municípios paranaenses em <strong>Territórios Inteligentes</strong> 
                        através de apoio técnico, metodologia avançada e gestão orientada a resultados.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                        <a href="{{ route('manifestacao.show') }}" class="inline-flex items-center justify-center bg-blue-600 text-white px-6 md:px-8 py-3 md:py-4 rounded-lg font-bold text-base md:text-lg hover:bg-blue-700 transition shadow-lg hover:shadow-xl">
                            Manifestar Interesse
                            <svg class="w-4 h-4 md:w-5 md:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="#sobre" class="inline-flex items-center justify-center border-2 border-gray-300 text-gray-700 px-6 md:px-8 py-3 md:py-4 rounded-lg font-bold text-base md:text-lg hover:border-blue-600 hover:text-blue-600 transition">
                            Saiba Mais
                        </a>
                    </div>
                </div>
                <div class="relative order-first md:order-last">
                    <img src="{{ asset('assets/img/card-smart-crea-cities.png') }}" alt="Smart Crea Cities Card" class="w-full rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 md:py-16 bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 md:gap-8 text-center text-white">
                <div class="p-4">
                    <div class="text-4xl md:text-5xl font-bold mb-2">8</div>
                    <div class="text-lg md:text-xl opacity-90">Municípios no Piloto</div>
                    <div class="text-xs md:text-sm opacity-75 mt-1">1 por regional do CREA-PR</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl md:text-5xl font-bold mb-2">20</div>
                    <div class="text-lg md:text-xl opacity-90">Etapas Programáticas</div>
                    <div class="text-xs md:text-sm opacity-75 mt-1">Do diagnóstico à certificação</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl md:text-5xl font-bold mb-2">2026</div>
                    <div class="text-lg md:text-xl opacity-90">Ciclo Inaugural</div>
                    <div class="text-xs md:text-sm opacity-75 mt-1">Início imediato</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sobre Section -->
    <section id="sobre" class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 md:mb-4">Sobre o Programa</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    Uma iniciativa institucional do CREA-PR com finalidade pública e caráter estratégico
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center mb-12 md:mb-16">
                <div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 md:mb-6">O que é um Território Inteligente?</h3>
                    <p class="text-base md:text-lg text-gray-700 mb-4 leading-relaxed">
                        É o município que, ao longo do Programa, organiza capacidades e processos de 
                        <strong>governança, planejamento, inovação e execução</strong>, com base em 
                        diagnóstico, metas e indicadores claros.
                    </p>
                    <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                        O programa integra o portfólio de ações do CREA-PR observando diretrizes de 
                        <strong>eficiência, transparência, integridade, foco em resultados, inovação 
                        e sustentabilidade</strong>.
                    </p>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 md:p-8 rounded-2xl">
                    <h4 class="text-lg md:text-xl font-bold text-gray-900 mb-4 md:mb-6">Princípios Norteadores</h4>
                    <ul class="space-y-3 md:space-y-4">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm md:text-base text-gray-700">Legalidade, impessoalidade e eficiência</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm md:text-base text-gray-700">Transparência e rastreabilidade</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm md:text-base text-gray-700">Cooperação interinstitucional</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm md:text-base text-gray-700">Sustentabilidade e visão de futuro</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm md:text-base text-gray-700">Valorização da engenharia na gestão pública</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Objetivos Section -->
    <section id="objetivos" class="py-12 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 md:mb-4">Objetivos do Programa</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    Cinco pilares fundamentais para transformação municipal
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3">Diagnóstico Baseado em Evidências</h3>
                    <p class="text-sm md:text-base text-gray-600">
                        Construção de diagnóstico municipal orientado por evidências e indicadores concretos
                    </p>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-xl shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3">Letramento e Capacitação</h3>
                    <p class="text-sm md:text-base text-gray-600">
                        Promoção de letramento em gestão antecipatória e meta-governança
                    </p>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-xl shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3">Cultura de Inovação</h3>
                    <p class="text-sm md:text-base text-gray-600">
                        Estímulo à cultura de inovação e colaboração entre atores do território
                    </p>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-xl shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-100 rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3">Plano Diretor do Território</h3>
                    <p class="text-sm md:text-base text-gray-600">
                        Estruturação do Plano Diretor e ativação de metas prioritárias
                    </p>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-xl shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3">Certificação Multinível</h3>
                    <p class="text-sm md:text-base text-gray-600">
                        Reconhecimento e certificação da evolução em níveis progressivos de maturidade
                    </p>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-indigo-600 p-6 md:p-8 rounded-xl shadow-md hover:shadow-xl transition text-white">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3">Resultados Concretos</h3>
                    <p class="text-sm md:text-base opacity-90">
                        Gestão orientada a resultados com impacto real nos territórios participantes
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Etapas Section -->
    <section id="etapas" class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 md:mb-4">Etapas do Programa</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    Uma jornada completa de transformação territorial em etapas integradas
                </p>
            </div>

            <div class="space-y-4 md:space-y-6">
                <div class="bg-gradient-to-r from-blue-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-blue-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">1</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">Buy-in dos Municípios</h3>
                            <p class="text-sm md:text-base text-gray-700">Sensibilização, engajamento e adesão formal com palestra explicativa sobre propósito, escopo, benefícios e cronograma.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-green-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">2</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">Diagnóstico Municipal</h3>
                            <p class="text-sm md:text-base text-gray-700">Levantamento e análise da realidade local com blocos analíticos e formatos de entrega focados em apoio à decisão.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-purple-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">3</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">Maturidade da Comunidade</h3>
                            <p class="text-sm md:text-base text-gray-700">Classificação do nível de maturidade e agrupamento por portes com diretrizes por nível.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-orange-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-orange-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">4</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">Workshop de Cidades</h3>
                            <p class="text-sm md:text-base text-gray-700">Articulação técnica com Comitê Técnico, oficina com os três melhores territórios e oficina para engenheiros.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-indigo-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-indigo-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">5</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">Letramento em Gestão Antecipatória</h3>
                            <p class="text-sm md:text-base text-gray-700">Capacitação com imersão de 8 horas e oficina prática para estruturação do Plano Diretor.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-pink-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-pink-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-pink-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">6</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">Letramento em Meta-Governança</h3>
                            <p class="text-sm md:text-base text-gray-700">Imersão de 8 horas sobre governança responsiva e transformacional com papéis e mecanismos de prestação de contas.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-red-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">7</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">Jornada de Desafios & Hackathon</h3>
                            <p class="text-sm md:text-base text-gray-700">Mobilização com hackathon voltado à cultura de inovação no sistema educacional e priorização de projetos.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-blue-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">8</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">LaunchPad do Framework</h3>
                            <p class="text-sm md:text-base text-gray-700">Ativação da primeira meta estabelecida no Plano Diretor com plano de execução e acompanhamento por indicadores.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-teal-50 to-white p-4 md:p-6 rounded-xl border-l-4 border-teal-600 hover:shadow-lg transition">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base">9</div>
                        <div class="ml-3 md:ml-4 flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1 md:mb-2">Certificação do Território Inteligente</h3>
                            <p class="text-sm md:text-base text-gray-700">Reconhecimento institucional multinível conforme evolução e cumprimento das metas do Plano Diretor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projeto Piloto Section -->
    <section id="piloto" class="py-12 md:py-20 bg-gradient-to-br from-blue-900 to-indigo-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-16">
                <div class="inline-block bg-white bg-opacity-20 px-3 md:px-4 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4">
                    Fase Inaugural
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-6">Projeto Piloto 2026</h2>
                <p class="text-base md:text-lg lg:text-xl opacity-90 max-w-3xl mx-auto px-4">
                    Validação metodológica com até 8 municípios paranaenses
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-8 md:mb-12">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm p-6 md:p-8 rounded-xl">
                    <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4">🎯 Objetivos do Piloto</h3>
                    <ul class="space-y-2 md:space-y-3 text-sm md:text-base lg:text-lg opacity-90">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Validação metodológica completa</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Consolidação de instrumentos</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Refino de indicadores</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Preparação para escalabilidade</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white bg-opacity-10 backdrop-blur-sm p-6 md:p-8 rounded-xl">
                    <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4">📍 Distribuição Regional</h3>
                    <div class="space-y-3 md:space-y-4">
                        <div class="flex items-center justify-between bg-white bg-opacity-10 p-3 md:p-4 rounded-lg">
                            <span class="text-sm md:text-base lg:text-lg font-semibold">Até 1 município</span>
                            <span class="text-lg md:text-xl lg:text-2xl font-bold">por regional</span>
                        </div>
                        <div class="flex items-center justify-between bg-white bg-opacity-10 p-3 md:p-4 rounded-lg">
                            <span class="text-sm md:text-base lg:text-lg font-semibold">Total de</span>
                            <span class="text-3xl md:text-4xl font-bold">8</span>
                        </div>
                        <div class="text-center text-xs md:text-sm opacity-75 mt-3 md:mt-4">
                            Distribuição equitativa para representatividade regional do Paraná
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white text-gray-900 p-6 md:p-8 rounded-2xl shadow-2xl">
                <h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center">Responsabilidades do Município Participante</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5 md:mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm md:text-base">Designar equipe responsável pela interlocução</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5 md:mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm md:text-base">Fornecer dados e informações necessárias</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5 md:mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm md:text-base">Participar de capacitações e oficinas</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5 md:mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm md:text-base">Elaborar e manter atualizado o Plano Diretor</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5 md:mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm md:text-base">Executar meta prioritária pactuada</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2 md:mr-3 flex-shrink-0 mt-0.5 md:mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm md:text-base">Cooperar com publicidade e prestação de contas</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 md:py-20 bg-gradient-to-r from-blue-600 to-indigo-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 md:mb-6">
                Transforme seu município em um Território Inteligente
            </h2>
            <p class="text-base md:text-lg lg:text-xl text-white opacity-90 mb-6 md:mb-10">
                Manifeste interesse e faça parte do Projeto Piloto 2026
            </p>
            <a href="{{ route('manifestacao.show') }}" class="inline-flex items-center bg-white text-blue-600 px-6 sm:px-8 md:px-10 py-3 sm:py-4 md:py-5 rounded-lg font-bold text-base sm:text-lg md:text-xl hover:bg-gray-100 transition shadow-2xl hover:shadow-3xl transform hover:-translate-y-1">
                Manifestar Interesse Agora
                <svg class="w-5 h-5 md:w-6 md:h-6 ml-2 md:ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
            <p class="text-white opacity-75 mt-4 md:mt-6 text-xs md:text-sm">
                Sem custo de adesão • Apoio técnico completo • Certificação multinível
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-6 md:mb-8">
                <div>
                    <img src="{{ asset('assets/img/smart-crea-cities-negativo.png') }}" alt="Smart Crea Cities" class="h-10 md:h-12 mb-3 md:mb-4">
                    <p class="text-gray-400 text-xs md:text-sm">
                        Programa institucional do CREA-PR para transformação de municípios paranaenses em Territórios Inteligentes.
                    </p>
                </div>
                <div>
                    <h3 class="font-bold text-base md:text-lg mb-3 md:mb-4">Links Rápidos</h3>
                    <ul class="space-y-2 text-gray-400 text-sm md:text-base">
                        <li><a href="#sobre" class="hover:text-white transition">Sobre o Programa</a></li>
                        <li><a href="#objetivos" class="hover:text-white transition">Objetivos</a></li>
                        <li><a href="#etapas" class="hover:text-white transition">Etapas</a></li>
                        <li><a href="#piloto" class="hover:text-white transition">Projeto Piloto</a></li>
                        <li><a href="{{ route('manifestacao.show') }}" class="hover:text-white transition">Manifestar Interesse</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-base md:text-lg mb-3 md:mb-4">Contato CREA-PR</h3>
                    <ul class="space-y-1 md:space-y-2 text-gray-400 text-xs md:text-sm">
                        <li>Conselho Regional de Engenharia</li>
                        <li>e Agronomia do Paraná</li>
                        <li class="pt-1 md:pt-2">Autarquia Federal</li>
                        <li class="pt-1 md:pt-2">
                            <a href="https://crea-pr.org.br" target="_blank" class="hover:text-white transition">
                                www.crea-pr.org.br
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 md:pt-8 text-center text-gray-400 text-xs md:text-sm">
                <p>&copy; 2026 CREA-PR - Smart Crea Cities. Todos os direitos reservados.</p>
                <p class="mt-2">Programa com finalidade pública e caráter estratégico institucional.</p>
            </div>
        </div>
    </footer>

</body>
</html>
