@extends('layouts.public')

@section('title', 'Manifestação de Interesse - CREA-PR')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="bg-white shadow-xl rounded-2xl p-8 mb-8 border-t-4 border-blue-600">
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('assets/img/logo-crea-pr-preto.png') }}" alt="CREA-PR" class="h-32 object-contain">
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900 mb-3">
                    Formulário de Manifestação de Interesse
                </h1>
                <p class="text-xl text-blue-600 font-semibold mb-2">
                    Trilha dos 3E's para Letramento Fundamental em Cidades Inteligentes
                </p>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    <span class="font-semibold">Estímulo • Educação • Estruturas</span>
                </p>
            </div>
        </div>

        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-6 mb-8 rounded-lg shadow-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-semibold text-red-800 mb-2">Atenção! Corrija os seguintes erros:</h3>
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Formulário -->
        <form method="POST" action="{{ route('manifestacao.store') }}" x-data="{
            possuiLeiInovacao: false,
            possuiFundoInovacao: false,
            possuiConselhoCti: false,
            possuiNormativaGovernanca: false,
            possuiSecretariaCti: true,
            rodouContratoSolucao: false,
            possuiPoliticaSandbox: false,
            possuiPoliticaLivingLab: false,
            possuiEstrategiaTransformacao: false,
            possuiPlanejamentoEstrategico: false,
            ganhouPremioInovacao: false
        }" class="space-y-8">
            @csrf

            <!-- Bloco: Informações do Município -->
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">1</span>
                        Informações do Município
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nome do Município *</label>
                        <input type="text" name="municipio_nome" value="{{ old('municipio_nome') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nome do Prefeito *</label>
                        <input type="text" name="prefeito_nome" value="{{ old('prefeito_nome') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mandato do Prefeito *</label>
                        <select name="prefeito_mandato" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                            <option value="">Selecione...</option>
                            <option value="1º Mandato" {{ old('prefeito_mandato') == '1º Mandato' ? 'selected' : '' }}>1º Mandato</option>
                            <option value="2º Mandato" {{ old('prefeito_mandato') == '2º Mandato' ? 'selected' : '' }}>2º Mandato</option>
                            <option value="3º Mandato" {{ old('prefeito_mandato') == '3º Mandato' ? 'selected' : '' }}>3º Mandato</option>
                            <option value="4º Mandato" {{ old('prefeito_mandato') == '4º Mandato' ? 'selected' : '' }}>4º Mandato</option>
                            <option value="5º Mandato ou mais" {{ old('prefeito_mandato') == '5º Mandato ou mais' ? 'selected' : '' }}>5º Mandato ou mais</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Número de Habitantes *</label>
                        <input type="number" name="habitantes_num" value="{{ old('habitantes_num') }}" min="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>
                </div>
            </div>

            <!-- Bloco 1: Lei, Fundo, Conselho -->
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">2</span>
                        Marco Legal e Institucional
                    </h2>
                </div>

                <div class="space-y-6">
                    <!-- Lei de Inovação -->
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui Lei de Inovação? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_lei_inovacao" value="1" 
                                    x-model="possuiLeiInovacao" 
                                    @change="possuiLeiInovacao = true"
                                    {{ old('possui_lei_inovacao') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-blue-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_lei_inovacao" value="0" 
                                    x-model="possuiLeiInovacao" 
                                    @change="possuiLeiInovacao = false"
                                    {{ old('possui_lei_inovacao') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-blue-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="possuiLeiInovacao" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Link da Lei *</label>
                            <input type="url" name="link_lei_inovacao" value="{{ old('link_lei_inovacao') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="https://...">
                        </div>
                    </div>

                    <!-- Fundo de Inovação -->
                    <div class="bg-green-50 rounded-lg p-6 border border-green-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui Fundo de Inovação? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_fundo_inovacao" value="1" 
                                    x-model="possuiFundoInovacao" 
                                    @change="possuiFundoInovacao = true"
                                    {{ old('possui_fundo_inovacao') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-green-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_fundo_inovacao" value="0" 
                                    x-model="possuiFundoInovacao" 
                                    @change="possuiFundoInovacao = false"
                                    {{ old('possui_fundo_inovacao') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-green-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="possuiFundoInovacao" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">CNPJ do Fundo *</label>
                            <input type="text" name="cnpj_fundo_inovacao" value="{{ old('cnpj_fundo_inovacao') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                placeholder="00.000.000/0000-00">
                        </div>
                    </div>

                    <!-- Conselho de CTI -->
                    <div class="bg-purple-50 rounded-lg p-6 border border-purple-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui Conselho de Ciência, Tecnologia e Inovação? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_conselho_cti" value="1" 
                                    x-model="possuiConselhoCti" 
                                    @change="possuiConselhoCti = true"
                                    {{ old('possui_conselho_cti') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-purple-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_conselho_cti" value="0" 
                                    x-model="possuiConselhoCti" 
                                    @change="possuiConselhoCti = false"
                                    {{ old('possui_conselho_cti') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-purple-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="possuiConselhoCti" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Link da Portaria *</label>
                            <input type="url" name="link_portaria_conselho" value="{{ old('link_portaria_conselho') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="https://...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bloco 2: Governança e Estrutura -->
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">3</span>
                        Governança e Estrutura
                    </h2>
                </div>

                <div class="space-y-6">
                    <!-- Normativa de Governança -->
                    <div class="bg-indigo-50 rounded-lg p-6 border border-indigo-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui normativa de Governança Digital? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_normativa_governanca" value="1" 
                                    x-model="possuiNormativaGovernanca" 
                                    @change="possuiNormativaGovernanca = true"
                                    {{ old('possui_normativa_governanca') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-indigo-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_normativa_governanca" value="0" 
                                    x-model="possuiNormativaGovernanca" 
                                    @change="possuiNormativaGovernanca = false"
                                    {{ old('possui_normativa_governanca') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-indigo-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="possuiNormativaGovernanca" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Link da Normativa *</label>
                            <input type="url" name="link_normativa_governanca" value="{{ old('link_normativa_governanca') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                placeholder="https://...">
                        </div>
                    </div>

                    <!-- Secretaria de CTI -->
                    <div class="bg-teal-50 rounded-lg p-6 border border-teal-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui Secretaria de Ciência, Tecnologia e Inovação? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_secretaria_cti" value="1" 
                                    x-model="possuiSecretariaCti" 
                                    @change="possuiSecretariaCti = true"
                                    {{ old('possui_secretaria_cti') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-teal-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_secretaria_cti" value="0" 
                                    x-model="possuiSecretariaCti" 
                                    @change="possuiSecretariaCti = false"
                                    {{ old('possui_secretaria_cti') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-teal-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="!possuiSecretariaCti" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Qual órgão municipal cuida de CTI? *
                            </label>
                            <input type="text" name="orgao_responsavel_cti" value="{{ old('orgao_responsavel_cti') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Ex: Secretaria de Desenvolvimento Econômico">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bloco 3: Contratos e Políticas -->
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">4</span>
                        Contratos e Políticas Públicas
                    </h2>
                </div>

                <div class="space-y-6">
                    <!-- Contrato Solução Inovadora -->
                    <div class="bg-orange-50 rounded-lg p-6 border border-orange-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município já executou contrato com solução inovadora? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="rodou_contrato_solucao_inovadora" value="1" 
                                    x-model="rodouContratoSolucao" 
                                    @change="rodouContratoSolucao = true"
                                    {{ old('rodou_contrato_solucao_inovadora') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-orange-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="rodou_contrato_solucao_inovadora" value="0" 
                                    x-model="rodouContratoSolucao" 
                                    @change="rodouContratoSolucao = false"
                                    {{ old('rodou_contrato_solucao_inovadora') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-orange-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="rodouContratoSolucao" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Link de Evidência *</label>
                            <input type="url" name="link_evidencia_contrato" value="{{ old('link_evidencia_contrato') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                                placeholder="https://...">
                        </div>
                    </div>

                    <!-- Sandbox Regulatório -->
                    <div class="bg-pink-50 rounded-lg p-6 border border-pink-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui política de Sandbox Regulatório? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_politica_sandbox" value="1" 
                                    x-model="possuiPoliticaSandbox" 
                                    @change="possuiPoliticaSandbox = true"
                                    {{ old('possui_politica_sandbox') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-pink-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_politica_sandbox" value="0" 
                                    x-model="possuiPoliticaSandbox" 
                                    @change="possuiPoliticaSandbox = false"
                                    {{ old('possui_politica_sandbox') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-pink-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="possuiPoliticaSandbox" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Link de Evidência *</label>
                            <input type="url" name="link_evidencia_sandbox" value="{{ old('link_evidencia_sandbox') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition"
                                placeholder="https://...">
                        </div>
                    </div>

                    <!-- Living Lab -->
                    <div class="bg-lime-50 rounded-lg p-6 border border-lime-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui política de Living Lab? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_politica_living_lab" value="1" 
                                    x-model="possuiPoliticaLivingLab" 
                                    @change="possuiPoliticaLivingLab = true"
                                    {{ old('possui_politica_living_lab') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-lime-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_politica_living_lab" value="0" 
                                    x-model="possuiPoliticaLivingLab" 
                                    @change="possuiPoliticaLivingLab = false"
                                    {{ old('possui_politica_living_lab') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-lime-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="possuiPoliticaLivingLab" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Link de Evidência *</label>
                            <input type="url" name="link_evidencia_living_lab" value="{{ old('link_evidencia_living_lab') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-lime-500 focus:border-transparent transition"
                                placeholder="https://...">
                        </div>
                    </div>

                    <!-- Transformação Digital -->
                    <div class="bg-cyan-50 rounded-lg p-6 border border-cyan-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui Estratégia de Transformação Digital? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_estrategia_transformacao_digital" value="1" 
                                    x-model="possuiEstrategiaTransformacao" 
                                    @change="possuiEstrategiaTransformacao = true"
                                    {{ old('possui_estrategia_transformacao_digital') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-cyan-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_estrategia_transformacao_digital" value="0" 
                                    x-model="possuiEstrategiaTransformacao" 
                                    @change="possuiEstrategiaTransformacao = false"
                                    {{ old('possui_estrategia_transformacao_digital') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-cyan-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="possuiEstrategiaTransformacao" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Link de Evidência *</label>
                            <input type="url" name="link_evidencia_estrategia" value="{{ old('link_evidencia_estrategia') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition"
                                placeholder="https://...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bloco 4: Ecossistema de Inovação -->
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">5</span>
                        Ecossistema de Inovação
                    </h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Quantas startups o município possui? *
                        </label>
                        <input type="number" name="startups_num" value="{{ old('startups_num', 0) }}" min="0"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-4">
                            Ambientes Promotores de Inovação (marque todos que se aplicam):
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach(['Coworking', 'Espaço Maker', 'Agência de Inovação', 'Parque Tecnológico', 'Centro de Inovação', 'Hub de Inovação', 'Incubadoras', 'Aceleradoras', 'Hotel de Projetos'] as $ambiente)
                            <label class="inline-flex items-center bg-white rounded-lg p-3 border border-gray-200 hover:border-blue-400 hover:bg-blue-50 transition cursor-pointer">
                                <input type="checkbox" name="ambientes_inovacao[]" value="{{ $ambiente }}"
                                    {{ is_array(old('ambientes_inovacao')) && in_array($ambiente, old('ambientes_inovacao')) ? 'checked' : '' }}
                                    class="form-checkbox h-5 w-5 text-blue-600 rounded">
                                <span class="ml-3 text-gray-700 font-medium">{{ $ambiente }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-6 border border-purple-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-4">
                            O Governo Municipal já realizou algum hackathon? (marque todos que se aplicam):
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach(['Com Ensino Superior', 'Com Educação Básica', 'Com Empreendedores', 'Com Agricultores'] as $hackathon)
                            <label class="inline-flex items-center bg-white rounded-lg p-3 border border-gray-200 hover:border-purple-400 hover:bg-purple-50 transition cursor-pointer">
                                <input type="checkbox" name="hackathons_realizados[]" value="{{ $hackathon }}"
                                    {{ is_array(old('hackathons_realizados')) && in_array($hackathon, old('hackathons_realizados')) ? 'checked' : '' }}
                                    class="form-checkbox h-5 w-5 text-purple-600 rounded">
                                <span class="ml-3 text-gray-700 font-medium">{{ $hackathon }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bloco 5: Planejamento e Relevância -->
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">6</span>
                        Planejamento e Relevância
                    </h2>
                </div>

                <div class="space-y-6">
                    <!-- Planejamento Estratégico -->
                    <div class="bg-emerald-50 rounded-lg p-6 border border-emerald-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município possui Planejamento Estratégico para Cidades Inteligentes? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_planejamento_estrategico" value="1" 
                                    x-model="possuiPlanejamentoEstrategico" 
                                    @change="possuiPlanejamentoEstrategico = true"
                                    {{ old('possui_planejamento_estrategico') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-emerald-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="possui_planejamento_estrategico" value="0" 
                                    x-model="possuiPlanejamentoEstrategico" 
                                    @change="possuiPlanejamentoEstrategico = false"
                                    {{ old('possui_planejamento_estrategico') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-emerald-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="possuiPlanejamentoEstrategico" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Link de Evidência *</label>
                            <input type="url" name="link_evidencia_planejamento" value="{{ old('link_evidencia_planejamento') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                                placeholder="https://...">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Relevância das Engenharias para o Município *
                        </label>
                        <select name="relevancia_engenharias" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                            <option value="">Selecione...</option>
                            <option value="Alta" {{ old('relevancia_engenharias') == 'Alta' ? 'selected' : '' }}>Alta</option>
                            <option value="Média" {{ old('relevancia_engenharias') == 'Média' ? 'selected' : '' }}>Média</option>
                            <option value="Baixa" {{ old('relevancia_engenharias') == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Descreva a relevância das Engenharias para o desenvolvimento do município *
                        </label>
                        <textarea name="relevancia_engenharias_descricao" rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>{{ old('relevancia_engenharias_descricao') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Bloco 6: Prêmios -->
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">7</span>
                        Premiações
                    </h2>
                </div>

                <div class="space-y-6">
                    <div class="bg-yellow-50 rounded-lg p-6 border border-yellow-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            O município já ganhou algum prêmio de inovação? *
                        </label>
                        <div class="flex gap-4 mb-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="ganhou_premio_inovacao" value="1" 
                                    x-model="ganhouPremioInovacao" 
                                    @change="ganhouPremioInovacao = true"
                                    {{ old('ganhou_premio_inovacao') == '1' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-yellow-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="ganhou_premio_inovacao" value="0" 
                                    x-model="ganhouPremioInovacao" 
                                    @change="ganhouPremioInovacao = false"
                                    {{ old('ganhou_premio_inovacao') == '0' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-yellow-600" required>
                                <span class="ml-2 text-gray-700 font-medium">Não</span>
                            </label>
                        </div>
                        
                        <div x-show="ganhouPremioInovacao" x-transition class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Descreva os prêmios relevantes *
                            </label>
                            <textarea name="descricao_premio_relevante" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">{{ old('descricao_premio_relevante') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bloco 7: Ponto Focal -->
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">8</span>
                        Ponto Focal (Contato)
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nome Completo *</label>
                        <input type="text" name="ponto_focal_nome" value="{{ old('ponto_focal_nome') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Cargo *</label>
                        <input type="text" name="ponto_focal_cargo" value="{{ old('ponto_focal_cargo') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">E-mail *</label>
                        <input type="email" name="ponto_focal_email" value="{{ old('ponto_focal_email') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Telefone Fixo *</label>
                        <input type="tel" name="ponto_focal_telefone" value="{{ old('ponto_focal_telefone') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="(00) 0000-0000"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Celular *</label>
                        <input type="tel" name="ponto_focal_celular" value="{{ old('ponto_focal_celular') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="(00) 00000-0000"
                            required>
                    </div>
                </div>
            </div>

            <!-- Declaração Final -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-xl rounded-xl p-8 text-white">
                <div class="flex items-start">
                    <input type="checkbox" name="declaracao_interesse" value="1" 
                        {{ old('declaracao_interesse') ? 'checked' : '' }}
                        class="form-checkbox h-6 w-6 text-blue-600 rounded mt-1 flex-shrink-0"
                        required>
                    <label class="ml-4 text-base leading-relaxed">
                        <strong class="text-lg">Declaração de Interesse *</strong><br>
                        Declaro que o município manifesta interesse em participar da <strong>Trilha dos 3E's (Estímulo, Educação e Estruturas) de Letramento Fundamental em Cidades Inteligentes</strong> promovida pelo CREA-PR, e estou ciente de que esta manifestação somente será válida após o envio de ofício oficial do Prefeito autorizando o Ponto Focal no avanço das tratativas.
                    </label>
                </div>
            </div>

            <!-- Botão de Submissão -->
            <div class="flex justify-center pt-4">
                <button type="submit" 
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 px-12 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition duration-200 text-lg">
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Enviar Manifestação de Interesse
                    </span>
                </button>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center mt-12 text-gray-600">
            <p class="text-sm">
                © {{ date('Y') }} CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná
            </p>
        </div>
    </div>
</div>

<script>
// Funções de máscara para formatação de campos
document.addEventListener('DOMContentLoaded', function() {
    // Máscara para CNPJ (00.000.000/0000-00)
    const cnpjInput = document.querySelector('input[name="cnpj_fundo_inovacao"]');
    if (cnpjInput) {
        cnpjInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 14) {
                value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    // Máscara para Telefone Fixo (00) 0000-0000
    const telefoneInput = document.querySelector('input[name="ponto_focal_telefone"]');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 10) {
                value = value.replace(/^(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    // Máscara para Celular (00) 00000-0000
    const celularInput = document.querySelector('input[name="ponto_focal_celular"]');
    if (celularInput) {
        celularInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/^(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    // Máscara para Número de Habitantes (formatação com pontos)
    const habitantesInput = document.querySelector('input[name="habitantes_num"]');
    if (habitantesInput) {
        habitantesInput.addEventListener('blur', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value) {
                e.target.setAttribute('data-original', value);
            }
        });
        
        habitantesInput.addEventListener('focus', function(e) {
            let original = e.target.getAttribute('data-original');
            if (original) {
                e.target.value = original;
            }
        });
    }
});
</script>
@endsection
