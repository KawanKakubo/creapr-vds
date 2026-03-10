<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gerenciar Questões - Admin CREA-PR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                        ← Dashboard
                    </a>
                    <span class="text-gray-400">|</span>
                    <span class="text-2xl font-bold text-gray-900">Questões Diagnósticas</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">{{ auth()->user()->email }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Sair</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Actions -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold text-gray-900">Gerenciar Questões do Diagnóstico</h1>
                <p class="text-sm text-gray-600 mt-1">Crie, edite e organize as questões dos diagnósticos dos 3 E's</p>
            </div>
            <a href="{{ route('admin.questions.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                + Nova Questão
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-start">
            <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>{{ session('success') }}</div>
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <form method="GET" action="{{ route('admin.questions.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoria</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Todas</option>
                        <option value="estimulo" {{ request('category') === 'estimulo' ? 'selected' : '' }}>Estímulo</option>
                        <option value="educacao" {{ request('category') === 'educacao' ? 'selected' : '' }}>Educação</option>
                        <option value="estruturas" {{ request('category') === 'estruturas' ? 'selected' : '' }}>Estruturas</option>
                    </select>
                </div>

                <!-- Type Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                    <select name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Todos</option>
                        <option value="yes_no" {{ request('type') === 'yes_no' ? 'selected' : '' }}>Sim/Não</option>
                        <option value="yes_no_evidence" {{ request('type') === 'yes_no_evidence' ? 'selected' : '' }}>Sim/Não + Evidência</option>
                        <option value="checkbox" {{ request('type') === 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                        <option value="multiple_input" {{ request('type') === 'multiple_input' ? 'selected' : '' }}>Múltiplos Inputs</option>
                        <option value="repeatable_fields" {{ request('type') === 'repeatable_fields' ? 'selected' : '' }}>Campos Repetíveis</option>
                        <option value="text" {{ request('type') === 'text' ? 'selected' : '' }}>Texto</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Todos</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Ativo</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>

                <!-- Filter Buttons -->
                <div class="flex items-end space-x-2">
                    <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.questions.index') }}" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 font-semibold text-center">
                        Limpar
                    </a>
                </div>
            </form>
        </div>

        <!-- Bulk Actions -->
        <div x-data="{ selected: [], showBulk: false }" class="mb-6">
            <div x-show="selected.length > 0" 
                 x-transition
                 class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-semibold text-gray-700">
                        <span x-text="selected.length"></span> questão(ões) selecionada(s)
                    </span>
                    <button @click="selected = []" class="text-sm text-gray-600 hover:text-gray-800">
                        Limpar seleção
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.questions.bulkToggle') }}" class="flex items-center space-x-2">
                    @csrf
                    <input type="hidden" name="question_ids" :value="JSON.stringify(selected)">
                    <select name="action" required class="border border-gray-300 rounded px-3 py-1 text-sm">
                        <option value="">Selecione ação...</option>
                        <option value="activate">Ativar</option>
                        <option value="deactivate">Desativar</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 text-sm font-semibold">
                        Aplicar
                    </button>
                </form>
            </div>

            <!-- Questions Table -->
            @if($questions->count() > 0)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <input type="checkbox" 
                                       @change="$event.target.checked ? selected = {{ $questions->pluck('id')->toJson() }} : selected = []"
                                       class="rounded border-gray-300">
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Questão</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($questions as $question)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <input type="checkbox" 
                                       :checked="selected.includes({{ $question->id }})"
                                       @change="$event.target.checked ? selected.push({{ $question->id }}) : selected = selected.filter(id => id !== {{ $question->id }})"
                                       class="rounded border-gray-300">
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="text-sm font-mono text-gray-900">{{ $question->order }}</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($question->category === 'estimulo')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Estímulo</span>
                                @elseif($question->category === 'educacao')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Educação</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Estruturas</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-900 max-w-md">
                                    {{ Str::limit($question->question, 100) }}
                                </div>
                                @if($question->description)
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($question->description, 80) }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="text-xs font-medium text-gray-700">
                                    @if($question->type === 'yes_no')
                                        Sim/Não
                                    @elseif($question->type === 'yes_no_evidence')
                                        Sim/Não + Evidência
                                    @elseif($question->type === 'checkbox')
                                        Checkbox
                                    @elseif($question->type === 'multiple_input')
                                        Múltiplos Inputs
                                    @else
                                        Texto
                                    @endif
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($question->is_active)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Ativo</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inativo</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.questions.edit', $question) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-semibold">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" 
                                          onsubmit="return confirm('Deseja realmente desativar esta questão?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                            Desativar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($questions->hasPages())
            <div class="mt-6">
                {{ $questions->links() }}
            </div>
            @endif
            @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma questão encontrada</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if(request()->has('category') || request()->has('type') || request()->has('status'))
                        Tente ajustar os filtros ou limpe-os para ver todas as questões.
                    @else
                        Comece criando sua primeira questão diagnóstica.
                    @endif
                </p>
                @if(!request()->has('category') && !request()->has('type') && !request()->has('status'))
                <div class="mt-6">
                    <a href="{{ route('admin.questions.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        + Nova Questão
                    </a>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</body>
</html>
