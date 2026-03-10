<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nova QuestÃ£o - Admin CREA-PR</title>
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
                        â† Voltar para QuestÃµes
                    </a>
                    <span class="text-gray-400">|</span>
                    <span class="text-2xl font-bold text-gray-900">Nova QuestÃ£o</span>
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
                 type: '{{ old('type', 'yes_no') }}',
                 options: {{ old('options') ? json_encode(old('options')) : '[]' }},
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
            
            <form method="POST" action="{{ route('admin.questions.store') }}">
                @csrf

                <!-- Category -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Categoria <span class="text-red-500">*</span>
                    </label>
                    <select name="category" required 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Selecione...</option>
                        <option value="estimulo" {{ old('category') === 'estimulo' ? 'selected' : '' }}>EstÃ­mulo</option>
                        <option value="educacao" {{ old('category') === 'educacao' ? 'selected' : '' }}>EducaÃ§Ã£o</option>
                        <option value="estruturas" {{ old('category') === 'estruturas' ? 'selected' : '' }}>Estruturas</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Selecione a qual dos 3 E's esta questÃ£o pertence</p>
                </div>

                <!-- Question Text -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Texto da QuestÃ£o <span class="text-red-500">*</span>
                    </label>
                    <textarea name="question" required rows="3" maxlength="1000"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              >{{ old('question') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">MÃ¡ximo 1000 caracteres</p>
                </div>

                <!-- Description (optional) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        DescriÃ§Ã£o/Ajuda (opcional)
                    </label>
                    <textarea name="description" rows="2" maxlength="500"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Texto adicional para ajudar o usuÃ¡rio a entender a questÃ£o"
                              >{{ old('description') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">MÃ¡ximo 500 caracteres</p>
                </div>

                <!-- Type -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de QuestÃ£o <span class="text-red-500">*</span>
                    </label>
                    <select name="type" required x-model="type"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="yes_no">Sim/NÃ£o (resposta simples)</option>
                        <option value="yes_no_evidence">Sim/NÃ£o + EvidÃªncia (com campo de texto adicional)</option>
                        <option value="checkbox">Checkbox (mÃºltipla escolha)</option>
                        <option value="multiple_input">MÃºltiplos Inputs (vÃ¡rios campos de texto)</option>
                        <option value="repeatable_fields">Campos RepetÃ­veis (botÃ£o de adicionar/remover mÃºltiplas entradas)</option>
                        <option value="text">Texto (resposta aberta)</option>
                    </select>
                </div>

                <!-- Options Builder (conditional) -->
                <div x-show="needsOptions()" x-transition class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        OpÃ§Ãµes <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-2 mb-3">
                        <template x-for="(option, index) in options" :key="index">
                            <div class="flex items-center space-x-2">
                                <input type="text" 
                                       :name="'options[' + index + ']'"
                                       x-model="options[index]"
                                       required
                                       maxlength="255"
                                       placeholder="Digite a opÃ§Ã£o..."
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
                        + Adicionar OpÃ§Ã£o
                    </button>
                    <p class="text-xs text-gray-500 mt-2">MÃ­nimo de 2 opÃ§Ãµes para tipos checkbox e multiple_input</p>
                </div>

                <!-- Order -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Ordem <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="order" required min="1" value="{{ old('order', 1) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">NÃºmero que define a ordem de exibiÃ§Ã£o da questÃ£o na categoria</p>
                </div>

                <!-- Checkboxes -->
                <div class="mb-6 space-y-3">
                    <!-- Requires Evidence -->
                    <div class="flex items-start">
                        <input type="checkbox" name="requires_evidence" id="requires_evidence" 
                               {{ old('requires_evidence') ? 'checked' : '' }}
                               class="mt-1 rounded border-gray-300">
                        <label for="requires_evidence" class="ml-2 text-sm text-gray-700">
                            <span class="font-medium">Requer evidÃªncia</span>
                            <p class="text-gray-500">Adiciona campo para upload de arquivo como comprovaÃ§Ã£o</p>
                        </label>
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-start">
                        <input type="checkbox" name="is_active" id="is_active" 
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="mt-1 rounded border-gray-300">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">
                            <span class="font-medium">QuestÃ£o ativa</span>
                            <p class="text-gray-500">QuestÃµes ativas aparecem nos diagnÃ³sticos dos municÃ­pios</p>
                        </label>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="mb-6 p-6 bg-gray-50 border border-gray-200 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Preview da QuestÃ£o</h3>
                    <div class="bg-white p-4 rounded border border-gray-300">
                        <p class="text-sm text-gray-900 mb-4" x-text="document.querySelector('textarea[name=question]')?.value || 'Digite uma questÃ£o acima...'"></p>
                        
                        <div x-show="type === 'yes_no' || type === 'yes_no_evidence'">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="preview_radio" class="mr-2" disabled>
                                    <span class="text-sm">Sim</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="preview_radio" class="mr-2" disabled>
                                    <span class="text-sm">NÃ£o</span>
                                </label>
                            </div>
                            <div x-show="type === 'yes_no_evidence'" class="mt-3">
                                <textarea rows="2" disabled placeholder="Campo para evidÃªncia/justificativa" 
                                          class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50"></textarea>
                            </div>
                        </div>

                        <div x-show="type === 'checkbox'">
                            <template x-for="option in options" :key="option">
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" class="mr-2" disabled>
                                    <span class="text-sm" x-text="option || 'OpÃ§Ã£o vazia'"></span>
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
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.questions.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                        Criar QuestÃ£o
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

