<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manifestação de Interesse | Smart Crea Cities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,600,700,800,900" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .step-indicator {
            transition: all 0.3s ease;
        }
        .step-active {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            scale: 1.1;
        }
        .step-completed {
            background: #10b981;
            color: white;
        }
        .step-inactive {
            background: #e5e7eb;
            color: #6b7280;
        }
        
        /* Header moderno */
        .header-blur {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
        }
        
        /* Botão navbar style */
        .nav-btn {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-btn::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-btn:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Header Moderno e Compacto -->
    <nav class="fixed w-full top-0 z-50 header-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 md:h-26 lg:h-30">
                <!-- Logo Simplificada (sem texto secundário) -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/smart-crea-cities-negativo.png') }}" 
                             alt="Smart Crea Cities" 
                             class="h-20 sm:h-24 md:h-28 w-auto object-contain">
                    </a>
                </div>
                
                <!-- Botões Desktop -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ asset('assets/pdfs/Smart_Crea_Cities_2026_Regulamento_Termo_Manual_COMPLETO.pdf') }}" 
                       target="_blank"
                       class="nav-btn text-white px-2 py-3 font-medium text-sm hover:text-amber-400 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Regulamento
                    </a>
                    <a href="{{ route('login') }}" 
                       class="nav-btn text-white px-2 py-3 font-medium text-sm hover:text-amber-400">
                        Login
                    </a>
                    <a href="{{ route('home') }}" 
                       class="bg-gradient-to-r from-amber-400 to-amber-500 text-slate-900 px-6 py-3 rounded-lg font-bold text-sm hover:from-amber-500 hover:to-amber-600 transition-all shadow-lg hover:shadow-xl hover:scale-105 whitespace-nowrap">
                        Voltar ao Início
                    </a>
                </div>
                
                <!-- Botões Mobile Compactos -->
                <div class="flex md:hidden items-center gap-1.5">
                    <a href="{{ asset('assets/pdfs/Smart_Crea_Cities_2026_Regulamento_Termo_Manual_COMPLETO.pdf') }}" 
                       target="_blank"
                       class="text-white px-2.5 py-2.5 rounded-lg font-semibold text-xs hover:text-amber-400 transition-all flex items-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" 
                       class="text-white px-3 py-2.5 rounded-lg font-semibold text-xs hover:text-amber-400 transition-all">
                        Login
                    </a>
                    <a href="{{ route('home') }}" 
                       class="bg-gradient-to-r from-amber-400 to-amber-500 text-slate-900 px-3 py-2.5 rounded-lg font-semibold text-xs whitespace-nowrap">
                        Início
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Formulário Multi-Step -->
    <div class="max-w-4xl mx-auto px-4 pt-28 md:pt-36 lg:pt-40 pb-8" x-data="manifestacaoForm()">
        <!-- Indicadores de Step -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <template x-for="(step, index) in steps" :key="index">
                    <div class="flex flex-col items-center flex-1">
                        <div 
                            class="step-indicator w-10 h-10 rounded-full flex items-center justify-center font-bold text-base mb-2"
                            :class="{
                                'step-active': currentStep === index + 1,
                                'step-completed': currentStep > index + 1,
                                'step-inactive': currentStep < index + 1
                            }">
                            <span x-show="currentStep <= index + 1" x-text="index + 1"></span>
                            <svg x-show="currentStep > index + 1" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-xs text-center font-medium" :class="currentStep === index + 1 ? 'text-blue-900' : 'text-gray-500'" x-text="step.title"></span>
                    </div>
                </template>
            </div>
        </div>

        <!-- Formulário -->
        <form @submit.prevent="submitForm" class="bg-white rounded-xl shadow-2xl p-6 md:p-8">
            <!-- STEP 1: Dados do Município -->
            <div x-show="currentStep === 1" x-transition>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2">Dados do Município</h2>
                <p class="text-gray-600 mb-8">Informe os dados básicos do seu município</p>

                <div class="space-y-6">
                    <!-- Nome do Município -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nome do Município *</label>
                        <input type="text" x-model="formData.municipio_nome" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Número de Habitantes -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Número de Habitantes *</label>
                        <input type="number" x-model.number="formData.habitantes_num" required min="1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Regional do CREA-PR -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Regional do CREA-PR *</label>
                        <select x-model="formData.regional_creapr" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Selecione a regional</option>
                            <option value="Apucarana">Regional Apucarana</option>
                            <option value="Cascavel">Regional Cascavel</option>
                            <option value="Curitiba">Regional Curitiba</option>
                            <option value="Guarapuava">Regional Guarapuava</option>
                            <option value="Londrina">Regional Londrina</option>
                            <option value="Maringá">Regional Maringá</option>
                            <option value="Pato Branco">Regional Pato Branco</option>
                            <option value="Ponta Grossa">Regional Ponta Grossa</option>
                        </select>
                    </div>

                    <!-- Setores Econômicos (Chips dinâmicos) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Setores Econômicos Relevantes *</label>
                        <p class="text-sm text-gray-500 mb-3">Adicione os principais setores econômicos do município</p>
                        
                        <div class="flex gap-2 mb-3">
                            <input type="text" x-model="newSetor" @keyup.enter.prevent="addSetor"
                                   placeholder="Digite e pressione Enter"
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <button type="button" @click="addSetor" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Adicionar
                            </button>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <template x-for="(setor, index) in formData.setores_economicos" :key="index">
                                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full flex items-center gap-2">
                                    <span x-text="setor"></span>
                                    <button type="button" @click="removeSetor(index)" class="text-blue-600 hover:text-blue-900 font-bold">
                                        ×
                                    </button>
                                </div>
                            </template>
                        </div>
                        <p x-show="formData.setores_economicos.length === 0" class="text-sm text-gray-400 mt-2">Nenhum setor adicionado</p>
                    </div>

                    <!-- Secretarias -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Informe a Secretaria que cuida da pasta de inovação?</label>
                            <input type="text" x-model="formData.secretaria_inovacao"
                                   placeholder="Nome da secretaria responsável pela inovação"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Informe a Secretaria que cuida da pasta de cidade inteligente?</label>
                            <input type="text" x-model="formData.secretaria_tecnologia_smart"
                                   placeholder="Nome da secretaria responsável por cidade inteligente"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Informe a Secretaria que cuida dos projetos de engenharia?</label>
                            <input type="text" x-model="formData.secretaria_engenharia"
                                   placeholder="Nome da secretaria responsável por projetos de engenharia"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 2: Dados do Responsável -->
            <div x-show="currentStep === 2" x-transition>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2">Dados do Responsável</h2>
                <p class="text-sm text-gray-600 mb-6">Informe os dados do responsável pela manifestação</p>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nome Completo *</label>
                            <input type="text" x-model="formData.responsavel_nome" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">CPF *</label>
                            <input type="text" x-model="formData.responsavel_cpf" required
                                   placeholder="000.000.000-00" x-mask="999.999.999-99"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Telefone *</label>
                            <input type="text" x-model="formData.responsavel_telefone" required
                                   placeholder="(00) 00000-0000" x-mask="(99) 99999-9999"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">E-mail *</label>
                            <input type="email" x-model="formData.responsavel_email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Órgão *</label>
                            <input type="text" x-model="formData.responsavel_orgao" required
                                   placeholder="Ex: Secretaria de Educação"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Função/Cargo *</label>
                            <input type="text" x-model="formData.responsavel_funcao" required
                                   placeholder="Ex: Secretário de Inovação"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Endereço do Órgão</label>
                            <input type="text" x-model="formData.orgao_endereco"
                                   placeholder="Rua, número, bairro, cidade"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 3: Dados do Prefeito -->
            <div x-show="currentStep === 3" x-transition>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2">Dados do Prefeito</h2>
                <p class="text-sm text-gray-600 mb-6">Informe os dados do prefeito do município</p>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nome Completo *</label>
                            <input type="text" x-model="formData.prefeito_nome" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">CPF *</label>
                            <input type="text" x-model="formData.prefeito_cpf" required
                                   placeholder="000.000.000-00" x-mask="999.999.999-99"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Telefone *</label>
                            <input type="text" x-model="formData.prefeito_telefone" required
                                   placeholder="(00) 00000-0000" x-mask="(99) 99999-9999"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Período de Mandato *</label>
                            <input type="text" x-model="formData.prefeito_mandato" required
                                   placeholder="Ex: 2021-2024"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 4: Validador "Mais Engenharia" -->
            <div x-show="currentStep === 4" x-transition>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2">Programa "Mais Engenharia"</h2>
                <p class="text-sm text-gray-600 mb-6">Esta informação é essencial para o direcionamento da manifestação</p>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Importante</h3>
                            <p class="mt-2 text-sm text-yellow-700">
                                Municípios que fazem parte do programa "Mais Engenharia" terão acesso completo à plataforma 
                                e poderão realizar o diagnóstico detalhado de maturidade tecnológica. Caso não faça parte, 
                                sua manifestação será registrada para futuras oportunidades.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="block text-lg font-semibold text-gray-700 mb-6">
                        O município faz parte do programa "Mais Engenharia"? *
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Opção SIM -->
                        <label class="cursor-pointer relative group">
                            <input type="radio" x-model="formData.faz_parte_mais_engenharia" value="true" name="mais_engenharia" class="sr-only peer">
                            <div class="p-6 border-2 rounded-xl transition-all duration-300 ease-in-out"
                                 :class="formData.faz_parte_mais_engenharia === 'true' ? 'border-green-500 bg-green-50 shadow-lg' : 'border-gray-300 hover:border-green-400 hover:shadow-md'">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300"
                                             :class="formData.faz_parte_mais_engenharia === 'true' ? 'bg-green-500' : 'bg-green-100'">
                                            <svg class="w-6 h-6 transition-all duration-300" 
                                                 :class="formData.faz_parte_mais_engenharia === 'true' ? 'text-white' : 'text-green-600'"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <span class="text-xl font-bold text-gray-900">Sim</span>
                                    </div>
                                    <!-- Indicador Radio Button -->
                                    <div class="relative w-6 h-6">
                                        <div class="absolute inset-0 rounded-full border-2 transition-all duration-300"
                                             :class="formData.faz_parte_mais_engenharia === 'true' ? 'border-green-500 bg-green-500' : 'border-gray-400 bg-white'">
                                        </div>
                                        <!-- Checkmark interno -->
                                        <svg class="absolute inset-0 w-full h-full text-white transition-all duration-300"
                                             :class="formData.faz_parte_mais_engenharia === 'true' ? 'opacity-100 scale-100' : 'opacity-0 scale-50'"
                                             fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-3 text-sm transition-all duration-300"
                                   :class="formData.faz_parte_mais_engenharia === 'true' ? 'text-gray-700 font-medium' : 'text-gray-600'">
                                    Terei acesso completo à plataforma e poderei realizar o diagnóstico
                                </p>
                            </div>
                        </label>

                        <!-- Opção NÃO -->
                        <label class="cursor-pointer relative group">
                            <input type="radio" x-model="formData.faz_parte_mais_engenharia" value="false" name="mais_engenharia" class="sr-only peer">
                            <div class="p-6 border-2 rounded-xl transition-all duration-300 ease-in-out"
                                 :class="formData.faz_parte_mais_engenharia === 'false' ? 'border-blue-500 bg-blue-50 shadow-lg' : 'border-gray-300 hover:border-blue-400 hover:shadow-md'">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300"
                                             :class="formData.faz_parte_mais_engenharia === 'false' ? 'bg-blue-500' : 'bg-blue-100'">
                                            <svg class="w-6 h-6 transition-all duration-300"
                                                 :class="formData.faz_parte_mais_engenharia === 'false' ? 'text-white' : 'text-blue-600'"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-xl font-bold text-gray-900">Não</span>
                                    </div>
                                    <!-- Indicador Radio Button -->
                                    <div class="relative w-6 h-6">
                                        <div class="absolute inset-0 rounded-full border-2 transition-all duration-300"
                                             :class="formData.faz_parte_mais_engenharia === 'false' ? 'border-blue-500 bg-blue-500' : 'border-gray-400 bg-white'">
                                        </div>
                                        <!-- Checkmark interno -->
                                        <svg class="absolute inset-0 w-full h-full text-white transition-all duration-300"
                                             :class="formData.faz_parte_mais_engenharia === 'false' ? 'opacity-100 scale-100' : 'opacity-0 scale-50'"
                                             fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-3 text-sm transition-all duration-300"
                                   :class="formData.faz_parte_mais_engenharia === 'false' ? 'text-gray-700 font-medium' : 'text-gray-600'">
                                    Minha manifestação será registrada para futuras oportunidades
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Navegação -->
            <div class="flex justify-between mt-12 pt-8 border-t border-gray-200">
                <button type="button" @click="previousStep" 
                        x-show="currentStep > 1"
                        class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-semibold">
                    ← Voltar
                </button>

                <button type="button" @click="nextStep" 
                        x-show="!isLastStep()"
                        class="ml-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg">
                    Próximo →
                </button>

                <button type="button" @click="submitForm"
                        x-show="isLastStep()"
                        class="ml-auto px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-lg">
                    Enviar Manifestação
                </button>
            </div>
        </form>
    </div>

    <script>
        function manifestacaoForm() {
            return {
                currentStep: 1,
                newSetor: '',
                steps: [
                    { title: 'Município' },
                    { title: 'Responsável' },
                    { title: 'Prefeito' },
                    { title: 'Mais Engenharia' }
                ],
                formData: {
                    municipio_nome: '',
                    habitantes_num: null,
                    regional_creapr: '',
                    setores_economicos: [],
                    secretaria_inovacao: '',
                    secretaria_tecnologia_smart: '',
                    secretaria_engenharia: '',
                    faz_parte_mais_engenharia: '',
                    responsavel_nome: '',
                    responsavel_cpf: '',
                    responsavel_telefone: '',
                    responsavel_email: '',
                    responsavel_orgao: '',
                    responsavel_funcao: '',
                    orgao_endereco: '',
                    prefeito_nome: '',
                    prefeito_cpf: '',
                    prefeito_telefone: '',
                    prefeito_mandato: ''
                },
                
                addSetor() {
                    if (this.newSetor.trim()) {
                        this.formData.setores_economicos.push(this.newSetor.trim());
                        this.newSetor = '';
                    }
                },
                
                removeSetor(index) {
                    this.formData.setores_economicos.splice(index, 1);
                },
                
                nextStep() {
                    // Validação de cada step antes de avançar
                    if (this.currentStep === 1) {
                        // Validar Step 1: Município
                        if (!this.formData.municipio_nome || !this.formData.municipio_nome.trim()) {
                            alert('Por favor, informe o nome do município.');
                            return;
                        }
                        if (!this.formData.habitantes_num || this.formData.habitantes_num < 1) {
                            alert('Por favor, informe o número de habitantes.');
                            return;
                        }
                        if (!this.formData.regional_creapr) {
                            alert('Por favor, selecione a regional do CREA-PR.');
                            return;
                        }
                        if (!this.formData.setores_economicos || this.formData.setores_economicos.length === 0) {
                            alert('Por favor, adicione pelo menos um setor econômico.');
                            return;
                        }
                    } else if (this.currentStep === 2) {
                        // Validar Step 2: Responsável
                        if (!this.formData.responsavel_nome || !this.formData.responsavel_nome.trim()) {
                            alert('Por favor, informe o nome completo do responsável.');
                            return;
                        }
                        if (!this.formData.responsavel_cpf || !this.formData.responsavel_cpf.trim()) {
                            alert('Por favor, informe o CPF do responsável.');
                            return;
                        }
                        if (!this.formData.responsavel_telefone || !this.formData.responsavel_telefone.trim()) {
                            alert('Por favor, informe o telefone do responsável.');
                            return;
                        }
                        if (!this.formData.responsavel_email || !this.formData.responsavel_email.trim()) {
                            alert('Por favor, informe o e-mail do responsável.');
                            return;
                        }
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(this.formData.responsavel_email)) {
                            alert('Por favor, informe um e-mail válido.');
                            return;
                        }
                        if (!this.formData.responsavel_orgao || !this.formData.responsavel_orgao.trim()) {
                            alert('Por favor, informe o órgão do responsável.');
                            return;
                        }
                        if (!this.formData.responsavel_funcao || !this.formData.responsavel_funcao.trim()) {
                            alert('Por favor, informe a função/cargo do responsável.');
                            return;
                        }
                    } else if (this.currentStep === 3) {
                        // Validar Step 3: Prefeito
                        if (!this.formData.prefeito_nome || !this.formData.prefeito_nome.trim()) {
                            alert('Por favor, informe o nome completo do prefeito.');
                            return;
                        }
                        if (!this.formData.prefeito_cpf || !this.formData.prefeito_cpf.trim()) {
                            alert('Por favor, informe o CPF do prefeito.');
                            return;
                        }
                        if (!this.formData.prefeito_telefone || !this.formData.prefeito_telefone.trim()) {
                            alert('Por favor, informe o telefone do prefeito.');
                            return;
                        }
                        if (!this.formData.prefeito_mandato || !this.formData.prefeito_mandato.trim()) {
                            alert('Por favor, informe o período de mandato.');
                            return;
                        }
                    }
                    
                    // Avança para próximo step se validação passou
                    if (this.currentStep < 4) {
                        this.currentStep++;
                        // Scroll suave para o topo
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                },
                
                previousStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                        // Scroll suave para o topo
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                },
                
                isLastStep() {
                    return this.currentStep === 4;
                },
                
                submitForm() {
                    // Validação completa de todos os campos obrigatórios
                    
                    // Step 1: Município
                    if (!this.formData.municipio_nome || !this.formData.municipio_nome.trim()) {
                        alert('Por favor, informe o nome do município.');
                        this.currentStep = 1;
                        return;
                    }
                    if (!this.formData.habitantes_num || this.formData.habitantes_num < 1) {
                        alert('Por favor, informe o número de habitantes.');
                        this.currentStep = 1;
                        return;
                    }
                    if (!this.formData.regional_creapr) {
                        alert('Por favor, selecione a regional do CREA-PR.');
                        this.currentStep = 1;
                        return;
                    }
                    if (!this.formData.setores_economicos || this.formData.setores_economicos.length === 0) {
                        alert('Por favor, adicione pelo menos um setor econômico.');
                        this.currentStep = 1;
                        return;
                    }
                    
                    // Step 2: Responsável
                    if (!this.formData.responsavel_nome || !this.formData.responsavel_nome.trim()) {
                        alert('Por favor, informe o nome completo do responsável.');
                        this.currentStep = 2;
                        return;
                    }
                    if (!this.formData.responsavel_cpf || !this.formData.responsavel_cpf.trim()) {
                        alert('Por favor, informe o CPF do responsável.');
                        this.currentStep = 2;
                        return;
                    }
                    if (!this.formData.responsavel_telefone || !this.formData.responsavel_telefone.trim()) {
                        alert('Por favor, informe o telefone do responsável.');
                        this.currentStep = 2;
                        return;
                    }
                    if (!this.formData.responsavel_email || !this.formData.responsavel_email.trim()) {
                        alert('Por favor, informe o e-mail do responsável.');
                        this.currentStep = 2;
                        return;
                    }
                    // Validação básica de email
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(this.formData.responsavel_email)) {
                        alert('Por favor, informe um e-mail válido.');
                        this.currentStep = 2;
                        return;
                    }
                    if (!this.formData.responsavel_orgao || !this.formData.responsavel_orgao.trim()) {
                        alert('Por favor, informe o órgão do responsável.');
                        this.currentStep = 2;
                        return;
                    }
                    if (!this.formData.responsavel_funcao || !this.formData.responsavel_funcao.trim()) {
                        alert('Por favor, informe a função/cargo do responsável.');
                        this.currentStep = 2;
                        return;
                    }
                    
                    // Step 3: Prefeito
                    if (!this.formData.prefeito_nome || !this.formData.prefeito_nome.trim()) {
                        alert('Por favor, informe o nome completo do prefeito.');
                        this.currentStep = 3;
                        return;
                    }
                    if (!this.formData.prefeito_cpf || !this.formData.prefeito_cpf.trim()) {
                        alert('Por favor, informe o CPF do prefeito.');
                        this.currentStep = 3;
                        return;
                    }
                    if (!this.formData.prefeito_telefone || !this.formData.prefeito_telefone.trim()) {
                        alert('Por favor, informe o telefone do prefeito.');
                        this.currentStep = 3;
                        return;
                    }
                    if (!this.formData.prefeito_mandato || !this.formData.prefeito_mandato.trim()) {
                        alert('Por favor, informe o período de mandato.');
                        this.currentStep = 3;
                        return;
                    }
                    
                    // Step 4: Mais Engenharia
                    if (!this.formData.faz_parte_mais_engenharia) {
                        alert('Por favor, informe se o município faz parte do programa "Mais Engenharia".');
                        this.currentStep = 4;
                        return;
                    }
                    
                    // Enviar dados via AJAX
                    fetch('{{ route("manifestacao.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            // Se não é 2xx, tentar ler a resposta como JSON para ver erros de validação
                            return response.json().then(err => {
                                throw new Error(err.message || 'Erro ao processar formulário');
                            }).catch(() => {
                                throw new Error('Erro ao enviar manifestação. Por favor, tente novamente.');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            window.location.href = data.redirect;
                        } else {
                            alert(data.message || 'Erro ao processar formulário.');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert(error.message || 'Erro ao enviar manifestação. Por favor, tente novamente.');
                    });
                }
            };
        }
    </script>
</body>
</html>
