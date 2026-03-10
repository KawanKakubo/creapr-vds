<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Questão - Admin CREA-PR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @include('partials.favicons')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.questions.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                        ← Voltar para Questões
                    </a>
                    <span class="text-gray-400">|</span>
                    <span class="text-2xl font-bold text-gray-900">Editar Questão</span>
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

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm p-8" 
             x-data="{
                 type: '{{ old('type', $question->type) }}',
                 options: {{ old('options') ? json_encode(old('options')) : json_encode($question->options ?? []) }},
                 addOption() {
                     this.options.push('');
                 },
                 removeOption(index) {
                     this.options.splice(index, 1);
                 },
                 needsOptions() {
                     return ['checkbox', 'multiple_input'].includes(this.type);
                 }
             }">
            
            <form method="POST" action="{{ route('admin.questions.update', $question) }}">
                @csrf
                @method('PATCH')

                <!-- Info Badge -->
                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold">Editando Questão #{{ $question->id }}</p>
                            <p class="mt-1">Criada em {{ $question->created_at->format('d/m/Y H:i') }}</p>
                            @if($question->answers()->count() > 0)
                            <p class="mt-1 text-blue-600 font-medium">
                                ⚠️ Esta questão já possui {{ $question->answers()->count() }} resposta(s). Alterações podem afetar os dados existentes.
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Categoria <span class="text-red-500">*</span>
                    </label>
                    <select name="category" required 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Selecione...</option>
                        <option value="estimulo" {{ old('category', $question->category) === 'estimulo' ? 'selected' : '' }}>Estímulo</option>
                        <option value="educacao" {{ old('category', $question->category) === 'educacao' ? 'selected' : '' }}>Educação</option>
                        <option value="estruturas" {{ old('category', $question->category) === 'estruturas' ? 'selected' : '' }}>Estruturas</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Selecione a qual dos 3 E's esta questão pertence</p>
                </div>

                <!-- Question Text -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Texto da Questão <span class="text-red-500">*</span>
                    </label>
                    <textarea name="question" required rows="3" maxlength="1000"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              >{{ old('question', $question->question) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Máximo 1000 caracteres</p>
                </div>

                <!-- Description (optional) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Descrição/Ajuda (opcional)
                    </label>
                    <textarea name="description" rows="2" maxlength="500"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Texto adicional para ajudar o usuário a entender a questão"
                              >{{ old('description', $question->description) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Máximo 500 caracteres</p>
                </div>

                <!-- Type -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Questão <span class="text-red-500">*</span>
                    </label>
                    <select name="type" required x-model="type"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="yes_no">Sim/Não (resposta simples)</option>
                        <option value="yes_no_evidence">Sim/Não + Evidência (com campo de texto adicional)</option>
                        <option value="checkbox">Checkbox (múltipla escolha)</option>
                        <option value="multiple_input">Múltiplos Inputs (vários campos de texto)</option>
                        <option value="repeatable_fields">Campos Repetíveis (botão de adicionar/remover múltiplas entradas)</option>
                        <option value="text">Texto (resposta aberta)</option>
                    </select>
                    @if($question->answers()->count() > 0)
                    <p class="text-xs text-orange-600 mt-1 font-medium">⚠️ Cuidado ao alterar o tipo - pode afetar respostas existentes</p>
                    @endif
                </div>

                <!-- Options Builder (conditional) -->
                <div x-show="needsOptions()" x-transition class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Opções <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-2 mb-3">
                        <template x-for="(option, index) in options" :key="index">
                            <div class="flex items-center space-x-2">
                                <input type="text" 
                                       :name="'options[' + index + ']'"
                                       x-model="options[index]"
                                       required
                                       maxlength="255"
                                       placeholder="Digite a opção..."
                                       class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="button" 
                                        @click="removeOption(index)"
                                        class="bg-red-100 text-red-700 px-3 py-2 rounded-lg hover:bg-red-200">
                                    Remover
                                </button>
                            </div>
                        </template>
                    </div>
                    <button type="button" 
                            @click="addOption()"
                            class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-100 font-semibold text-sm">
                        + Adicionar Opção
                    </button>
                    <p class="text-xs text-gray-500 mt-2">Mínimo de 2 opções para tipos checkbox e multiple_input</p>
                </div>

                <!-- Order -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Ordem <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="order" required min="1" value="{{ old('order', $question->order) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Número que define a ordem de exibição da questão na categoria</p>
                </div>

                <!-- Checkboxes -->
                <div class="mb-6 space-y-3">
                    <!-- Requires Evidence -->
                    <div class="flex items-start">
                        <input type="checkbox" name="requires_evidence" id="requires_evidence" 
                               {{ old('requires_evidence', $question->requires_evidence) ? 'checked' : '' }}
                               class="mt-1 rounded border-gray-300">
                        <label for="requires_evidence" class="ml-2 text-sm text-gray-700">
                            <span class="font-medium">Requer evidência</span>
                            <p class="text-gray-500">Adiciona campo para upload de arquivo como comprovação</p>
                        </label>
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-start">
                        <input type="checkbox" name="is_active" id="is_active" 
                               {{ old('is_active', $question->is_active) ? 'checked' : '' }}
                               class="mt-1 rounded border-gray-300">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">
                            <span class="font-medium">Questão ativa</span>
                            <p class="text-gray-500">Questões ativas aparecem nos diagnósticos dos municípios</p>
                        </label>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="mb-6 p-6 bg-gray-50 border border-gray-200 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Preview da Questão</h3>
                    <div class="bg-white p-4 rounded border border-gray-300">
                        <p class="text-sm text-gray-900 mb-4" x-text="document.querySelector('textarea[name=question]')?.value || 'Digite uma questão acima...'"></p>
                        
                        <div x-show="type === 'yes_no' || type === 'yes_no_evidence'">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="preview_radio" class="mr-2" disabled>
                                    <span class="text-sm">Sim</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="preview_radio" class="mr-2" disabled>
                                    <span class="text-sm">Não</span>
                                </label>
                            </div>
                            <div x-show="type === 'yes_no_evidence'" class="mt-3">
                                <textarea rows="2" disabled placeholder="Campo para evidência/justificativa" 
                                          class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50"></textarea>
                            </div>
                        </div>

                        <div x-show="type === 'checkbox'">
                            <template x-for="option in options" :key="option">
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" class="mr-2" disabled>
                                    <span class="text-sm" x-text="option || 'Opção vazia'"></span>
                                </label>
                            </template>
                        </div>

                        <div x-show="type === 'multiple_input'">
                            <template x-for="option in options" :key="option">
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-gray-700 mb-1" x-text="option || 'Label'"></label>
                                    <input type="text" disabled class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50">
                                </div>
                            </template>
                        </div>

                        <div x-show="type === 'text'">
                            <textarea rows="3" disabled placeholder="Campo de texto aberto" 
                                      class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" 
                          onsubmit="return confirm('⚠️ Deseja realmente desativar esta questão? Ela não será mais exibida nos diagnósticos.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-6 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-semibold">
                            Desativar Questão
                        </button>
                    </form>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.questions.index') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                            Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

