<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar E-mail | Smart Crea Cities</title>
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
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
    <nav class="fixed top-0 left-0 right-0 z-50 header-blur shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 md:h-26 lg:h-30">
                <a href="{{ route('home') }}" class="flex items-center transition-opacity hover:opacity-80">
                    <img src="{{ asset('assets/img/card-smart-crea-cities-negativo.png') }}" alt="Smart Crea Cities" class="h-20 sm:h-24 md:h-28 w-auto object-contain">
                </a>
                <div class="flex items-center gap-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 md:px-6 py-2 md:py-2.5 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition text-sm md:text-base">Sair</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-4 pt-28 md:pt-36 lg:pt-40 pb-8">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8">
                <div class="text-center mb-6">
                    <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Verificar E-mail</h1>
                    <p class="text-sm text-gray-600">Obrigado por se cadastrar! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos prazer em enviar outro.</p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm">Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o cadastro.</p>
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded-lg transform hover:scale-[1.02] transition-all shadow-lg">Reenviar E-mail de Verificação</button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full border-2 border-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-50 transition">Sair da Conta</button>
                    </form>
                </div>

                <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <strong>Dica:</strong> Verifique também sua pasta de spam ou lixo eletrônico. Às vezes, e-mails de verificação podem acabar lá.
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">© {{ date('Y') }} Smart Crea Cities - CREA-PR</p>
            </div>
        </div>
    </div>
</body>
</html>

