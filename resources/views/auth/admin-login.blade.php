<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrativo | Smart Crea Cities</title>
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
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 min-h-screen">
    <!-- Header -->
    <nav class="fixed top-0 left-0 right-0 z-50 header-blur shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14 sm:h-16 md:h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center transition-opacity hover:opacity-80">
                    <img src="{{ asset('assets/img/card-smart-crea-cities-negativo.png') }}" 
                         alt="Smart Crea Cities" 
                         class="h-10 sm:h-12 md:h-16 w-auto object-contain">
                </a>
                
                <!-- Botões -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" 
                       class="px-4 md:px-6 py-2 md:py-2.5 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition text-sm md:text-base">
                        Login Município
                    </a>
                    <a href="{{ route('home') }}" 
                       class="px-4 md:px-6 py-2 md:py-2.5 border-2 border-gray-600 text-gray-600 rounded-lg font-semibold hover:bg-gray-50 transition text-sm md:text-base">
                        Voltar ao Início
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-4 pt-16 md:pt-20 pb-8">
        <div class="max-w-md w-full">
            <!-- Card de Login -->
            <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8">
                <!-- Cabeçalho -->
                <div class="text-center mb-6">
                    <div class="w-14 h-14 gradient-bg rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Acesso Administrativo</h1>
                    <p class="text-sm text-gray-600">Área restrita para administradores CREA-PR</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Formulário -->
                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">E-mail Administrativo</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                                   placeholder="admin@crea-pr.org.br">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Senha</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                                   placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full gradient-bg text-white font-bold py-3 px-4 rounded-lg transform hover:scale-[1.02] transition-all shadow-lg">
                        Acessar Painel Administrativo
                    </button>
                </form>

                <!-- Aviso de Segurança -->
                <div class="mt-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-amber-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div class="text-xs text-amber-800">
                            <strong>Área Restrita:</strong> Esta é uma área de acesso exclusivo para administradores do sistema CREA-PR. 
                            Todos os acessos são monitorados e registrados.
                        </div>
                    </div>
                </div>

                <!-- Link para login de município -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        É um município? 
                        <a href="{{ route('login') }}" class="text-red-600 font-semibold hover:text-red-700 transition">Acesse aqui</a>
                    </p>
                </div>
            </div>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">© {{ date('Y') }} Smart Crea Cities - CREA-PR</p>
            </div>
        </div>
    </div>
</body>
</html>
