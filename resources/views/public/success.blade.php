<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManifestaÃ§Ã£o Registrada | Smart Crea Cities</title>
    <link href="https://fonts.bunny.net/css?family=inter:300,400,600,700,800,900" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .header-blur {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
    @include('partials.favicons')
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Header - Mesma da home/manifestacao -->
    <nav class="fixed top-0 left-0 right-0 z-50 header-blur shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 md:h-26 lg:h-30">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center transition-opacity hover:opacity-80">
                    <img src="{{ asset('assets/img/card-smart-crea-cities-negativo.png') }}" 
                         alt="Smart Crea Cities" 
                         class="h-20 sm:h-24 md:h-28 w-auto object-contain">
                </a>
                
                <!-- BotÃµes Desktop -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" 
                       class="nav-btn px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
                        Fazer Login
                    </a>
                    <a href="{{ route('home') }}" 
                       class="nav-btn px-6 py-2.5 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                        Voltar ao InÃ­cio
                    </a>
                </div>
                
                <!-- BotÃµes Mobile -->
                <div class="flex md:hidden items-center space-x-2">
                    <a href="{{ route('login') }}" 
                       class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                    </a>
                    <a href="{{ route('home') }}" 
                       class="p-2 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 pt-28 md:pt-36 lg:pt-40 pb-8">
        @if($submission->faz_parte_mais_engenharia && isset($isComplete) && $isComplete)
            <!-- FLUXO COMPLETO: Credenciais de Acesso -->
            <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2">ManifestaÃ§Ã£o ConcluÃ­da!</h1>
                    <p class="text-sm text-gray-600">Seu municÃ­pio foi registrado no programa Smart Crea Cities</p>
                </div>

                <!-- Protocolo -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8">
                    <div class="flex items-center justify-center">
                        <div class="text-center">
                            <p class="text-sm text-blue-800 font-semibold mb-1">Protocolo da ManifestaÃ§Ã£o</p>
                            <p class="text-3xl font-bold text-blue-900">{{ $submission->protocolo }}</p>
                        </div>
                    </div>
                </div>

                <!-- Credenciais de Acesso -->
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-2 border-yellow-400 rounded-xl p-4 mb-6">
                    <div class="flex items-start mb-3">
                        <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <div>
                            <h3 class="text-base font-bold text-yellow-900 mb-1">Suas Credenciais de Acesso</h3>
                            <p class="text-xs text-yellow-800">Um email com suas credenciais foi enviado para vocÃª.</p>
                        </div>
                    </div>

                    <div class="space-y-3 bg-white rounded-lg p-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">E-mail de Acesso</label>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <code class="text-blue-900 font-mono text-sm">{{ $submission->user->email ?? $submission->responsavel_email }}</code>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Senha TemporÃ¡ria</label>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-600">A senha temporÃ¡ria foi enviada para seu email</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">âš ï¸ VocÃª serÃ¡ solicitado a alterar esta senha no primeiro acesso</p>
                        </div>
                    </div>
                </div>

                <!-- PrÃ³ximos Passos -->
                <div class="mb-6">
                    <h3 class="text-base font-bold text-gray-900 mb-3">PrÃ³ximos Passos</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mr-3">1</div>
                            <p class="text-sm text-gray-700 pt-1">Acesse a plataforma usando suas credenciais</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mr-3">2</div>
                            <p class="text-sm text-gray-700 pt-1">Altere sua senha temporÃ¡ria para uma senha segura</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mr-3">3</div>
                            <p class="text-sm text-gray-700 pt-1">Acompanhe o status da sua manifestaÃ§Ã£o no dashboard</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mr-3">4</div>
                            <p class="text-sm text-gray-700 pt-1">Aguarde a aprovaÃ§Ã£o para iniciar os diagnÃ³sticos de maturidade</p>
                        </div>
                    </div>
                </div>

                <!-- BotÃ£o de Acesso -->
                <div class="text-center">
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg font-bold text-sm shadow-lg hover:from-blue-700 hover:to-indigo-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Acessar a Plataforma
                    </a>
                    <p class="text-sm text-gray-500 mt-4">JÃ¡ pode fazer login usando as credenciais acima</p>
                </div>
            </div>

        @else
            <!-- FLUXO SIMPLES: Apenas ConfirmaÃ§Ã£o -->
            <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2">ManifestaÃ§Ã£o Registrada!</h1>
                    <p class="text-sm text-gray-600">Obrigado pelo interesse no Smart Crea Cities</p>
                </div>

                <!-- Protocolo -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <div class="flex items-center justify-center">
                        <div class="text-center">
                            <p class="text-xs text-blue-800 font-semibold mb-1">Protocolo da ManifestaÃ§Ã£o</p>
                            <p class="text-xl sm:text-2xl font-bold text-blue-900">{{ $submission->protocolo }}</p>
                        </div>
                    </div>
                </div>

                <!-- Mensagem -->
                <div class="bg-gray-50 rounded-xl p-4 mb-6">
                    <p class="text-sm text-gray-700 text-center leading-relaxed">
                        Sua manifestaÃ§Ã£o de interesse foi registrada com sucesso. <br>
                        Como seu municÃ­pio nÃ£o faz parte do programa <strong>"Mais Engenharia"</strong>, 
                        entraremos em contato caso surjam novas oportunidades de participaÃ§Ã£o.
                    </p>
                </div>

                <!-- O que acontece agora -->
                <div class="mb-6">
                    <h3 class="text-base font-bold text-gray-900 mb-3 text-center">O que acontece agora?</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mr-3">1</div>
                            <p class="text-sm text-gray-700 pt-1">Seu interesse foi registrado em nosso banco de dados</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mr-3">2</div>
                            <p class="text-sm text-gray-700 pt-1">VocÃª receberÃ¡ um e-mail de confirmaÃ§Ã£o com o nÃºmero do protocolo</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mr-3">3</div>
                            <p class="text-sm text-gray-700 pt-1">Entraremos em contato caso surjam novas oportunidades de participaÃ§Ã£o</p>
                        </div>
                    </div>
                </div>

                <!-- BotÃ£o Voltar -->
                <div class="text-center">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-bold text-sm shadow-lg hover:bg-blue-700 transition">
                        Voltar ao Site
                    </a>
                </div>
            </div>
        @endif

        <!-- InformaÃ§Ãµes de Contato -->
        <div class="mt-8 text-center">
            <p class="text-gray-600 text-sm">
                DÃºvidas? Entre em contato: <a href="mailto:smartcreacities@crea-pr.org.br" class="text-blue-600 hover:underline">smartcreacities@crea-pr.org.br</a>
            </p>
        </div>
    </div>
</body>
</html>

