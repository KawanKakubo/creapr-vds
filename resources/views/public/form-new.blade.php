@extends('layouts.public')

@section('title', 'Manifestação de Interesse - Smart Crea Cities 2026')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="bg-white shadow-xl rounded-2xl p-8 mb-8 border-t-4 border-blue-600">
            <div class="text-center">
                <div class="flex justify-center space-x-4 mb-6">
                    <img src="{{ asset('assets/img/card-smart-crea-cities.png') }}" alt="Smart Crea Cities" class="h-24 object-contain">
                    <img src="{{ asset('assets/img/logo-crea-pr-preto.png') }}" alt="CREA-PR" class="h-24 object-contain">
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900 mb-3">
                    Manifestação de Interesse
                </h1>
                <p class="text-xl text-blue-600 font-semibold mb-2">
                    Projeto Piloto Smart Crea Cities 2026
                </p>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Transformando municípios paranaenses em Territórios Inteligentes
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
        <form method="POST" action="{{ route('manifestacao.store') }}" enctype="multipart/form-data" 
              x-data="{
                  possuiLeiInovacao: {{ old('possui_lei_inovacao') ? 'true' : 'false' }},
                  possuiPoliticaGovDigital: {{ old('possui_politica_governo_digital') ? 'true' : 'false' }},
                  possuiPoliticaSandbox: {{ old('possui_politica_sandbox') ? 'true' : 'false' }},
                  realizouCPSI: {{ old('realizou_cpsi') ? 'true' : 'false' }},
                  possuiMasterplan: {{ old('possui_masterplan') ? 'true' : 'false' }},
                  possuiPlanoDiretorSmart: {{ old('possui_plano_diretor_smart') ? 'true' : 'false' }},
                  possuiNormativaLGPD: {{ old('possui_normativa_lgpd') ? 'true' : 'false' }},
                  realizouHackathonsEducacao: {{ old('realizou_hackathons_educacao') ? 'true' : 'false' }},
                  temUniversidadePresencial: {{ old('tem_universidade_presencial') ? 'true' : 'false' }}
              }" 
              class="space-y-8">
            @csrf

            <!-- Bloco 1: Dados do Município -->
            <div class="bg-white shadow-lg rounded-xl p-6 md:p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">1</span>
                        Dados do Município
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nome do Município *</label>
                        <input type="text" name="municipio_nome" value="{{ old('municipio_nome') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Número de Habitantes *</label>
                        <input type="number" name="habitantes_num" value="{{ old('habitantes_num') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required min="1">
                    </div>
                </div>
            </div>

            <!-- Bloco 2: Responsável pela Manifestação -->
            <div class="bg-white shadow-lg rounded-xl p-6 md:p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">2</span>
                        Responsável pela Manifestação de Interesse
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nome Completo do Responsável *</label>
                        <input type="text" name="responsavel_nome" value="{{ old('responsavel_nome') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">CPF do Responsável *</label>
                        <input type="text" name="responsavel_cpf" value="{{ old('responsavel_cpf') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required maxlength="14" placeholder="000.000.000-00">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Telefone do Responsável *</label>
                        <input type="tel" name="responsavel_telefone" value="{{ old('responsavel_telefone') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required placeholder="(00) 00000-0000">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">E-mail do Responsável *</label>
                        <input type="email" name="responsavel_email" value="{{ old('responsavel_email') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Órgão do Responsável *</label>
                        <input type="text" name="responsavel_orgao" value="{{ old('responsavel_orgao') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required placeholder="Ex: Secretaria de Inovação">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Função do Responsável *</label>
                        <input type="text" name="responsavel_funcao" value="{{ old('responsavel_funcao') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required placeholder="Ex: Secretário">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Endereço do Órgão *</label>
                        <input type="text" name="orgao_endereco" value="{{ old('orgao_endereco') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required placeholder="Rua, número, bairro, cidade, estado, CEP">
                    </div>
                </div>
            </div>

            <!-- Bloco 3: Dados do Prefeito -->
            <div class="bg-white shadow-lg rounded-xl p-6 md:p-8 border border-gray-200">
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3 text-lg">3</span>
                        Dados do Prefeito
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nome do Prefeito *</label>
                        <input type="text" name="prefeito_nome" value="{{ old('prefeito_nome') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">CPF do Prefeito *</label>
                        <input type="text" name="prefeito_cpf" value="{{ old('prefeito_cpf') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required maxlength="14" placeholder="000.000.000-00">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Telefone do Prefeito *</label>
                        <input type="tel" name="prefeito_telefone" value="{{ old('prefeito_telefone') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required placeholder="(00) 00000-0000">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mandato do Prefeito *</label>
                        <select name="prefeito_mandato" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                            <option value="">Selecione...</option>
                            <option value="Primeiro" {{ old('prefeito_mandato') == 'Primeiro' ? 'selected' : '' }}>Primeiro Mandato</option>
                            <option value="Segundo" {{ old('prefeito_mandato') == 'Segundo' ? 'selected' : '' }}>Segundo Mandato</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Continua no próximo arquivo... -->
            <div class="flex justify-center">
                <div class="text-gray-500 text-sm">Formulário continua...</div>
            </div>
        </form>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
