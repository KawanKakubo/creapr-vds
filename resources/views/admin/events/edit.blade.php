<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Evento | Smart Crea Cities</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 md:h-26 lg:h-30">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('assets/img/card-smart-crea-cities-negativo.png') }}" alt="Smart Crea Cities" class="h-20 sm:h-24 md:h-28 w-auto object-contain">
                    <div class="border-l border-gray-300 h-10"></div>
                    <div>
                        <p class="text-sm text-gray-600">Editar</p>
                        <p class="font-bold text-blue-900">Evento do Programa</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                        ← Voltar
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Editar Evento</h2>

            <form method="POST" action="{{ route('admin.events.update', $event) }}">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Título do Evento *
                    </label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('title', $event->title) }}"
                        placeholder="Ex: Workshop de Cidades Inteligentes">
                    @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Descrição
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Descreva os detalhes do evento...">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data e Hora -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="event_date" class="block text-sm font-semibold text-gray-700 mb-2">
                            Data do Evento *
                        </label>
                        <input type="date" name="event_date" id="event_date" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}">
                        @error('event_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="event_time" class="block text-sm font-semibold text-gray-700 mb-2">
                            Horário (opcional)
                        </label>
                        <input type="time" name="event_time" id="event_time"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            value="{{ old('event_time', $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('H:i') : '') }}">
                        @error('event_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tipo e Local -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tipo de Evento *
                        </label>
                        <select name="type" id="type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="workshop" {{ old('type', $event->type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="reuniao" {{ old('type', $event->type) == 'reuniao' ? 'selected' : '' }}>Reunião</option>
                            <option value="capacitacao" {{ old('type', $event->type) == 'capacitacao' ? 'selected' : '' }}>Capacitação</option>
                            <option value="avaliacao" {{ old('type', $event->type) == 'avaliacao' ? 'selected' : '' }}>Avaliação</option>
                            <option value="outro" {{ old('type', $event->type) == 'outro' ? 'selected' : '' }}>Outro</option>
                        </select>
                        @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">
                            Local (opcional)
                        </label>
                        <input type="text" name="location" id="location"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            value="{{ old('location', $event->location) }}"
                            placeholder="Ex: Online (Zoom), Curitiba/PR">
                        @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Publicar -->
                <div class="mb-8">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" 
                            {{ old('is_published', $event->is_published) ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-3 text-sm font-semibold text-gray-700">
                            Publicar evento (visível para os municípios)
                        </span>
                    </label>
                    <p class="mt-2 text-xs text-gray-500">Se desmarcado, o evento ficará como rascunho</p>
                </div>

                <!-- Botões -->
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('admin.events.index') }}" 
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold">
                        Cancelar
                    </a>
                    <button type="submit" 
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-lg">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
