@extends('layouts.public')

@section('title', 'Manifestação Enviada com Sucesso - CREA-PR')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-blue-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full">
        <!-- Card de Sucesso -->
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border-t-8 border-green-500">
            <!-- Header com ícone de sucesso -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-white rounded-full p-4 shadow-lg">
                        <svg class="w-20 h-20 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl font-extrabold text-white mb-2">
                    Manifestação Enviada com Sucesso!
                </h1>
                <p class="text-green-50 text-lg">
                    Obrigado por participar da Trilha dos 3E's
                </p>
            </div>

            <!-- Conteúdo principal -->
            <div class="p-8 md:p-12">
                <!-- Protocolo -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-300 rounded-xl p-8 mb-8 text-center shadow-lg">
                    <p class="text-gray-600 text-sm font-semibold uppercase mb-2 tracking-wide">
                        Seu Número de Protocolo
                    </p>
                    <p class="text-5xl font-black text-blue-600 tracking-wider font-mono mb-2">
                        {{ $submission->protocolo }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        Guarde este número para futuras consultas
                    </p>
                </div>

                <!-- Informações do Município -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Dados da Submissão
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600 font-medium">Município:</span>
                            <p class="text-gray-900 font-semibold">{{ $submission->municipio_nome }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 font-medium">Prefeito:</span>
                            <p class="text-gray-900 font-semibold">{{ $submission->prefeito_nome }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 font-medium">Ponto Focal:</span>
                            <p class="text-gray-900 font-semibold">{{ $submission->ponto_focal_nome }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 font-medium">Data de Envio:</span>
                            <p class="text-gray-900 font-semibold">{{ $submission->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Aviso Importante -->
                <div class="bg-amber-50 border-l-4 border-amber-500 p-6 rounded-lg shadow-md mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-amber-800 mb-2">
                                ⚠️ Importante - Próximos Passos
                            </h3>
                            <div class="text-amber-900 space-y-2">
                                <p class="font-semibold">
                                    A Manifestação de Interesse somente será válida após o CREA-PR receber um <strong>Ofício do Prefeito</strong>, autorizando o Ponto Focal no avanço das tratativas.
                                </p>
                                <div class="bg-white rounded-lg p-4 mt-3 border border-amber-200">
                                    <p class="text-sm text-gray-700 mb-2"><strong>O ofício deve conter:</strong></p>
                                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                                        <li>Número do protocolo: <strong class="text-blue-600">{{ $submission->protocolo }}</strong></li>
                                        <li>Autorização expressa do Prefeito</li>
                                        <li>Identificação do Ponto Focal autorizado</li>
                                        <li>Assinatura e carimbo oficial</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contato -->
                <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                    <h3 class="text-lg font-bold text-blue-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Dúvidas ou Informações
                    </h3>
                    <p class="text-gray-700 text-sm">
                        Em caso de dúvidas sobre o processo, entre em contato com o CREA-PR através dos canais oficiais.
                    </p>
                </div>

                <!-- Botões de Ação -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('manifestacao.show') }}" 
                        class="inline-flex items-center justify-center px-6 py-3 border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nova Manifestação
                    </a>
                    
                    <button onclick="window.print()" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-lg hover:from-green-600 hover:to-emerald-700 transition duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Imprimir Comprovante
                    </button>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                <div class="flex justify-center">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/logo-crea-pr-preto.png') }}" alt="CREA-PR" class="h-28 object-contain mx-auto mb-3">
                        <p class="text-gray-600 text-sm">
                            Conselho Regional de Engenharia e Agronomia do Paraná
                        </p>
                        <p class="text-gray-500 text-xs mt-1">
                            Trilha dos 3E's - Estímulo, Educação e Estruturas
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            background: white;
        }
        button {
            display: none;
        }
    }
</style>
@endsection
