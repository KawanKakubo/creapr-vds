<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Smart Crea Cities</title>
    <link href="https://fonts.bunny.net/css?family=inter:300,400,600,700,800,900" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .header-blur {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
    @include('partials.favicons')
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
    <!-- Header -->
    <nav class="fixed top-0 left-0 right-0 z-50 header-blur shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 md:h-26 lg:h-30">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center transition-opacity hover:opacity-80">
                    <img src="{{ asset('assets/img/card-smart-crea-cities-negativo.png') }}" 
                         alt="Smart Crea Cities" 
                         class="h-20 sm:h-24 md:h-28 w-auto object-contain">
                </a>
                
                <!-- BotÃµes -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" 
                       class="px-4 md:px-6 py-2 md:py-2.5 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition text-sm md:text-base">
                        Voltar ao InÃ­cio
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-4 pt-28 md:pt-36 lg:pt-40 pb-8">
        <div class="max-w-md w-full">
            <!-- Card de Login -->
            <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8">
                <!-- CabeÃ§alho -->
                <div class="text-center mb-6">
                    <div class="w-14 h-14 gradient-bg rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Acesso de MunicÃ­pio</h1>
                    <p class="text-sm text-gray-600">Entre com suas credenciais para acessar o sistema</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- FormulÃ¡rio -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            E-mail
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                                   placeholder="seu.email@municipio.pr.gov.br">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Senha
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                                   placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   name="remember"
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-2 transition">
                            <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                               class="text-sm text-blue-600 hover:text-blue-800 font-semibold transition">
                                Esqueceu a senha?
                            </a>
                        @endif
                    </div>

                    <!-- BotÃ£o de Login -->
                    <button type="submit" 
                            class="w-full gradient-bg text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transform hover:scale-[1.02] transition-all shadow-lg">
                        Entrar no Sistema
                    </button>
                </form>

                <!-- Aviso -->
                <div class="mt-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-800">
                                <strong>Novo por aqui?</strong> FaÃ§a sua <a href="{{ route('manifestacao.show') }}" class="underline font-semibold hover:text-blue-900">manifestaÃ§Ã£o de interesse</a> para receber suas credenciais de acesso.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Link para Login Administrativo 
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">
                        Ã‰ um administrador? <a href="{{ route('admin.login') }}" class="text-red-600 font-semibold hover:text-red-700 underline">Acesse o login administrativo</a>
                    </p>
                </div>-->
            </div>

            <!-- Footer -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    Â© {{ date('Y') }} Smart Crea Cities - CREA-PR
                </p>
            </div>
        </div>
    </div>
</body>
</html>

