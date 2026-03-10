<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diagnóstico {{ ucfirst($category) }} | Smart Crea Cities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 md:h-26 lg:h-30">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('municipality.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <img src="{{ asset('assets/img/card-smart-crea-cities-negativo.png') }}" alt="Smart Crea Cities" class="h-20 sm:h-24 md:h-28 w-auto object-contain">
                    <div class="border-l border-gray-300 h-10"></div>
                    <div>
                        <p class="text-sm text-gray-600">Diagnóstico</p>
                        <p class="font-bold text-blue-900">{{ ucfirst($category) }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-900">{{ $submission->municipio_nome }}</p>
                    <p class="text-xs text-gray-500">{{ $questions->count() }} perguntas • 100 pontos</p>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8" x-data="diagnosticForm()">
        <!-- Cabeçalho -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center space-x-4 mb-4">
                @if($category === 'estimulo')
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                @elseif($category === 'educacao')
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </div>
                @else
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Diagnóstico de {{ ucfirst($category) }}</h1>
                    <p class="text-gray-600">Responda as perguntas para avaliar a maturidade do município</p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mt-6">
                <div class="flex justify-between text-sm text-gray-600 mb-2">
                    <span>Progresso</span>
                    <span x-text="answeredCount + ' de ' + totalQuestions"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" 
                         :style="'width: ' + (answeredCount / totalQuestions * 100) + '%'"></div>
                </div>
            </div>
        </div>

        <!-- Formulário -->
        <form @submit.prevent="submitDiagnostic">
            @foreach($questions as $index => $question)
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex items-start space-x-3 mb-4">
                        <span class="flex-shrink-0 w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center font-bold text-sm">
                            {{ $index + 1 }}
                        </span>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">
                                {{ $question->question }}
                                @if($question->requires_evidence)
                                    <span class="text-red-500">*</span>
                                @endif
                            </h3>
                            @if($question->description)
                                <p class="text-sm text-gray-600 mb-4">{{ $question->description }}</p>
                            @endif

                            <!-- YES/NO Questions -->
                            @if($question->type === 'yes_no' || $question->type === 'yes_no_evidence')
                                <div class="space-y-2" x-data="{ selected: '{{ $existingAnswers[$question->id]->answer_yes_no ?? '' }}' }">
                                    <label class="flex items-center p-3 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition"
                                           :class="selected === 'yes' ? 'border-green-500 bg-green-50' : 'border-gray-300'">
                                        <input type="radio" 
                                               :name="'answer_{{ $question->id }}'" 
                                               value="yes" 
                                               x-model="selected"
                                               @change="updateAnswer({{ $question->id }}, '{{ $question->type }}', 'yes')"
                                               class="w-4 h-4 text-green-600">
                                        <span class="ml-3 font-semibold text-gray-900">Sim</span>
                                    </label>
                                    
                                    <label class="flex items-center p-3 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition"
                                           :class="selected === 'no' ? 'border-red-500 bg-red-50' : 'border-gray-300'">
                                        <input type="radio" 
                                               :name="'answer_{{ $question->id }}'" 
                                               value="no" 
                                               x-model="selected"
                                               @change="updateAnswer({{ $question->id }}, '{{ $question->type }}', 'no')"
                                               class="w-4 h-4 text-red-600">
                                        <span class="ml-3 font-semibold text-gray-900">Não</span>
                                    </label>

                                    @if($question->requires_evidence)
                                        <div x-show="selected === 'yes'" x-transition class="mt-3">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                Link de Evidência *
                                            </label>
                                            <input type="url" 
                                                   placeholder="https://exemplo.com/documento.pdf"
                                                   value="{{ $existingAnswers[$question->id]->evidence_url ?? '' }}"
                                                   @input="updateEvidence({{ $question->id }}, $event.target.value)"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- CHECKBOX Questions -->
                            @if($question->type === 'checkbox')
                                <div class="space-y-2">
                                    @php
                                        $existingCheckboxes = $existingAnswers[$question->id]->answer_checkboxes ?? [];
                                    @endphp
                                    @foreach($question->options as $option)
                                        <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                            <input type="checkbox" 
                                                   value="{{ $option }}"
                                                   @change="updateCheckbox({{ $question->id }}, '{{ $option }}', $event.target.checked)"
                                                   {{ in_array($option, $existingCheckboxes) ? 'checked' : '' }}
                                                   class="w-4 h-4 text-blue-600 rounded">
                                            <span class="ml-3 text-gray-900">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif

                            <!-- MULTIPLE INPUT Questions -->
                            @if($question->type === 'multiple_input')
                                <div class="space-y-3">
                                    @php
                                        $existingInputs = $existingAnswers[$question->id]->answer_multiple_input ?? [];
                                    @endphp
                                    @foreach($question->options as $optionKey => $optionLabel)
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                                {{ $optionLabel }}
                                            </label>
                                            <input type="text" 
                                                   placeholder="Digite o valor"
                                                   value="{{ $existingInputs[$optionKey] ?? '' }}"
                                                   @input="updateMultipleInput({{ $question->id }}, '{{ $optionKey }}', $event.target.value)"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- TEXT Questions -->
                            @if($question->type === 'text')
                                <textarea 
                                    rows="4" 
                                    placeholder="Digite sua resposta..."
                                    @input="updateAnswer({{ $question->id }}, 'text', $event.target.value)"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ $existingAnswers[$question->id]->answer_text ?? '' }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Botões de Ação -->
            <div class="bg-white rounded-xl shadow-lg p-6 flex justify-between items-center">
                <button type="button"
                        @click="saveAndExit()"
                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-semibold">
                    Salvar e Sair
                </button>

                <button type="submit" 
                        class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-bold shadow-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Finalizar Diagnóstico
                </button>
            </div>
        </form>
    </div>

    <script>
        function diagnosticForm() {
            return {
                totalQuestions: {{ $questions->count() }},
                answeredCount: 0,
                answers: {},
                
                init() {
                    // Carrega respostas existentes
                    @foreach($existingAnswers as $questionId => $answer)
                        this.answers[{{ $questionId }}] = {
                            type: '{{ $answer->question->type }}',
                            answer: '{{ $answer->answer_yes_no ?? '' }}',
                            checkboxes: @json($answer->answer_checkboxes ?? []),
                            inputs: @json($answer->answer_multiple_input ?? []),
                            text: '{{ $answer->answer_text ?? '' }}',
                            evidence_url: '{{ $answer->evidence_url ?? '' }}'
                        };
                    @endforeach
                    
                    this.updateAnsweredCount();
                    console.log('Respostas carregadas:', this.answers);
                },
                
                updateAnswer(questionId, type, value) {
                    if (!this.answers[questionId]) {
                        this.answers[questionId] = { 
                            type: type,
                            answer: null,
                            checkboxes: [],
                            inputs: {},
                            text: '',
                            evidence_url: ''
                        };
                    }
                    
                    if (type === 'yes_no' || type === 'yes_no_evidence') {
                        this.answers[questionId].type = type;
                        this.answers[questionId].answer = value;
                    } else if (type === 'text') {
                        this.answers[questionId].type = type;
                        this.answers[questionId].text = value;
                    }
                    
                    this.updateAnsweredCount();
                },
                
                updateCheckbox(questionId, option, checked) {
                    if (!this.answers[questionId]) {
                        this.answers[questionId] = { 
                            type: 'checkbox', 
                            checkboxes: [],
                            answer: null,
                            inputs: {},
                            text: '',
                            evidence_url: ''
                        };
                    }
                    
                    if (!this.answers[questionId].checkboxes) {
                        this.answers[questionId].checkboxes = [];
                    }
                    
                    if (checked) {
                        if (!this.answers[questionId].checkboxes.includes(option)) {
                            this.answers[questionId].checkboxes.push(option);
                        }
                    } else {
                        const index = this.answers[questionId].checkboxes.indexOf(option);
                        if (index > -1) {
                            this.answers[questionId].checkboxes.splice(index, 1);
                        }
                    }
                    
                    this.updateAnsweredCount();
                },
                
                updateMultipleInput(questionId, key, value) {
                    if (!this.answers[questionId]) {
                        this.answers[questionId] = { 
                            type: 'multiple_input', 
                            inputs: {},
                            answer: null,
                            checkboxes: [],
                            text: '',
                            evidence_url: ''
                        };
                    }
                    
                    if (!this.answers[questionId].inputs) {
                        this.answers[questionId].inputs = {};
                    }
                    
                    this.answers[questionId].inputs[key] = value;
                    this.updateAnsweredCount();
                },
                
                updateEvidence(questionId, value) {
                    if (!this.answers[questionId]) {
                        this.answers[questionId] = {
                            type: 'yes_no_evidence',
                            answer: null,
                            checkboxes: [],
                            inputs: {},
                            text: '',
                            evidence_url: ''
                        };
                    }
                    this.answers[questionId].evidence_url = value;
                },
                
                updateAnsweredCount() {
                    this.answeredCount = Object.keys(this.answers).filter(id => {
                        const answer = this.answers[id];
                        if ((answer.type === 'yes_no' || answer.type === 'yes_no_evidence') && answer.answer) return true;
                        if (answer.type === 'checkbox' && answer.checkboxes && answer.checkboxes.length > 0) return true;
                        if (answer.type === 'multiple_input' && answer.inputs && Object.keys(answer.inputs).length > 0) return true;
                        if (answer.type === 'text' && answer.text && answer.text.trim() !== '') return true;
                        return false;
                    }).length;
                },
                
                saveAndExit() {
                    console.log('Salvando respostas parciais:', this.answers);
                    console.log('Total de respostas:', Object.keys(this.answers).length);
                    
                    // Salva respostas parciais e redireciona
                    if (Object.keys(this.answers).length === 0) {
                        // Se não há respostas, apenas volta para o dashboard
                        window.location.href = '{{ route("municipality.dashboard") }}';
                        return;
                    }
                    
                    fetch('{{ route("municipality.diagnostic.store", $category) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ 
                            answers: this.answers,
                            partial: true // Indica que é salvamento parcial
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Redireciona independente do resultado
                        window.location.href = '{{ route("municipality.dashboard") }}';
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        // Mesmo com erro, redireciona
                        window.location.href = '{{ route("municipality.dashboard") }}';
                    });
                },
                
                submitDiagnostic() {
                    console.log('Finalizando diagnóstico:', this.answers);
                    console.log('Total de respostas:', Object.keys(this.answers).length);
                    console.log('Respostas contadas:', this.answeredCount);
                    
                    if (this.answeredCount < this.totalQuestions) {
                        if (!confirm(`Você respondeu ${this.answeredCount} de ${this.totalQuestions} perguntas. Deseja continuar mesmo assim?`)) {
                            return;
                        }
                    }
                    
                    fetch('{{ route("municipality.diagnostic.store", $category) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ answers: this.answers })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(`Diagnóstico concluído! Pontuação: ${data.score} pontos`);
                            window.location.href = data.redirect;
                        } else {
                            alert('Erro: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro ao enviar diagnóstico. Tente novamente.');
                    });
                }
            };
        }
    </script>
</body>
</html>
