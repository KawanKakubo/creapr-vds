<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - CREA-PR')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/img/logo-crea-pr-preto.png') }}" alt="CREA-PR" class="h-12 object-contain bg-white rounded-lg px-2 py-1 shadow-md">
                    </div>
                    <div class="ml-4">
                        <h1 class="text-white font-bold text-xl">Painel Administrativo</h1>
                        <p class="text-blue-100 text-xs">Trilha dos 3E's</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" 
                        class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg transition font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.submissoes.index') }}" 
                        class="text-white hover:bg-blue-700 px-4 py-2 rounded-lg transition font-medium">
                        Submissões
                    </a>
                    
                    @auth
                    <div class="border-l border-blue-400 pl-4">
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                class="text-white hover:bg-red-600 px-4 py-2 rounded-lg transition font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Sair
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-lg mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-gray-600 text-sm">
                © {{ date('Y') }} CREA-PR - Conselho Regional de Engenharia e Agronomia do Paraná
            </p>
        </div>
    </footer>
</body>
</html>
