<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - Smart Crea Cities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,600,700,800,900" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .header-blur {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
    @include('partials.favicons')
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Navbar -->
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

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 pt-28 md:pt-36 lg:pt-40 pb-8">
        <div class="max-w-md w-full">

        <!-- Card de Mudança de Senha -->
        <div class="bg-white rounded-lg shadow-xl p-8" x-data="{ 
            showCurrent: false, 
            showNew: false, 
            showConfirm: false,
            password: '',
            passwordStrength: 0,
            strengthColor: 'bg-gray-300',
            strengthText: '',
            checkStrength() {
                let strength = 0;
                if (this.password.length >= 8) strength++;
                if (/[a-z]/.test(this.password) && /[A-Z]/.test(this.password)) strength++;
                if (/[0-9]/.test(this.password)) strength++;
                if (/[^a-zA-Z0-9]/.test(this.password)) strength++;
                
                this.passwordStrength = strength;
                
                if (strength === 0) {
                    this.strengthColor = 'bg-gray-300';
                    this.strengthText = '';
                } else if (strength === 1) {
                    this.strengthColor = 'bg-red-500';
                    this.strengthText = 'Fraca';
                } else if (strength === 2) {
                    this.strengthColor = 'bg-yellow-500';
                    this.strengthText = 'Média';
                } else if (strength === 3) {
                    this.strengthColor = 'bg-blue-500';
                    this.strengthText = 'Boa';
                } else {
                    this.strengthColor = 'bg-green-500';
                    this.strengthText = 'Forte';
                }
            }
        }">


            <h2 class="text-2xl font-bold text-gray-800 mb-6">Alterar Senha</h2>
            
            <!-- Alerta de Segurança -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            <strong>Segurança:</strong> Por favor, altere sua senha temporária.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mensagens de Erro -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <ul class="text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Formulário -->
            <form method="POST" action="{{ route('change-password.update') }}">
                @csrf

                <!-- Senha Atual -->
                <div class="mb-5">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Senha Atual (Temporária)
                    </label>
                    <div class="relative">
                        <input 
                            :type="showCurrent ? 'text' : 'password'"
                            id="current_password" 
                            name="current_password" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Digite sua senha atual"
                        >
                        <button 
                            type="button"
                            @click="showCurrent = !showCurrent"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                        >
                            <svg x-show="!showCurrent" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showCurrent" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Nova Senha -->
                <div class="mb-5">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Nova Senha
                    </label>
                    <div class="relative">
                        <input 
                            :type="showNew ? 'text' : 'password'"
                            id="new_password" 
                            name="new_password" 
                            required 
                            x-model="password"
                            @input="checkStrength()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Digite sua nova senha"
                        >
                        <button 
                            type="button"
                            @click="showNew = !showNew"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                        >
                            <svg x-show="!showNew" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showNew" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Indicador de Força da Senha -->
                    <div class="mt-2" x-show="password.length > 0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-gray-600">Força da senha:</span>
                            <span class="text-xs font-medium" :class="{'text-gray-500': passwordStrength === 0, 'text-red-500': passwordStrength === 1, 'text-yellow-500': passwordStrength === 2, 'text-blue-500': passwordStrength === 3, 'text-green-500': passwordStrength === 4}" x-text="strengthText"></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full transition-all duration-300" :class="strengthColor" :style="`width: ${passwordStrength * 25}%`"></div>
                        </div>
                    </div>
                </div>

                <!-- Confirmar Nova Senha -->
                <div class="mb-6">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirmar Nova Senha
                    </label>
                    <div class="relative">
                        <input 
                            :type="showConfirm ? 'text' : 'password'"
                            id="new_password_confirmation" 
                            name="new_password_confirmation" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Confirme sua nova senha"
                        >
                        <button 
                            type="button"
                            @click="showConfirm = !showConfirm"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                        >
                            <svg x-show="!showConfirm" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showConfirm" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Requisitos da Senha -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-sm font-medium text-gray-700 mb-2">A nova senha deve conter:</p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li class="flex items-center">
                            <svg class="h-4 w-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Mínimo de 8 caracteres
                        </li>
                        <li class="flex items-center">
                            <svg class="h-4 w-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Letras maiúsculas e minúsculas
                        </li>
                        <li class="flex items-center">
                            <svg class="h-4 w-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Pelo menos um número
                        </li>
                        <li class="flex items-center">
                            <svg class="h-4 w-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Pelo menos um caractere especial (!@#$%^&*)
                        </li>
                    </ul>
                </div>

                <!-- Botão de Submit -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02]"
                >
                    Alterar Senha e Continuar
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 text-center text-sm text-gray-600 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <p class="font-semibold">© {{ date('Y') }} Smart Crea Cities - CREA-PR</p>
            <p class="text-xs mt-1">Conselho Regional de Engenharia e Agronomia do Paraná</p>
            <p class="text-xs mt-1">Programa de Maturidade Tecnológica Municipal</p>
        </div>
    </footer>
</body>
</html>

