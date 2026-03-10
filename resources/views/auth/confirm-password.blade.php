<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmar Senha | Smart Crea Cities</title>
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
                <a href="{{ route('login') }}" class="px-4 md:px-6 py-2 md:py-2.5 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition text-sm md:text-base">Voltar ao Login</a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-4 pt-28 md:pt-36 lg:pt-40 pb-8">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8">
                <div class="text-center mb-6">
                    <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Área Segura</h1>
                    <p class="text-sm text-gray-600">Esta é uma área segura da aplicação. Por favor, confirme sua senha antes de continuar.</p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Senha</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition @error('password') border-red-500 @enderror" placeholder="Digite sua senha">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transform hover:scale-[1.02] transition-all shadow-lg">Confirmar Senha</button>
                </form>

                <div class="mt-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-amber-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <p class="text-sm text-amber-800">
                            <strong>Atenção:</strong> Esta confirmação é necessária para garantir a segurança de suas informações.
                        </p>
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

