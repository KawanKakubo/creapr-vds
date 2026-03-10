<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Eventos | Smart Crea Cities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @include('partials.favicons')
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
                        <p class="text-sm text-gray-600">Calendário</p>
                        <p class="font-bold text-blue-900">Eventos do Programa</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                        ← Dashboard
                    </a>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrador</p>
                    </div>
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

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Cabeçalho -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Eventos do Programa</h1>
                <p class="text-gray-600">Gerencie o calendário de eventos que aparecerá para os municípios</p>
            </div>
            <a href="{{ route('admin.events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Novo Evento
            </a>
        </div>

        <!-- Mensagens -->
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Listagem de Eventos -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data/Hora</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Local</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($events as $event)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $event->event_date->format('d/m/Y') }}</div>
                                @if($event->event_time)
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                                @if($event->description)
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($event->description, 60) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                $typeColors = [
                                    'workshop' => 'bg-purple-100 text-purple-800',
                                    'reuniao' => 'bg-blue-100 text-blue-800',
                                    'capacitacao' => 'bg-green-100 text-green-800',
                                    'avaliacao' => 'bg-orange-100 text-orange-800',
                                    'outro' => 'bg-gray-100 text-gray-800',
                                ];
                                $typeLabels = [
                                    'workshop' => 'Workshop',
                                    'reuniao' => 'Reunião',
                                    'capacitacao' => 'Capacitação',
                                    'avaliacao' => 'Avaliação',
                                    'outro' => 'Outro',
                                ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $typeColors[$event->type] }}">
                                    {{ $typeLabels[$event->type] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $event->location ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($event->is_published)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Publicado</span>
                                @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Rascunho</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.events.edit', $event) }}" class="text-blue-600 hover:text-blue-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-lg font-medium">Nenhum evento cadastrado</p>
                                <p class="mt-2">Clique em "Novo Evento" para adicionar um evento ao calendário</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginação -->
        @if($events->hasPages())
        <div class="mt-6">
            {{ $events->links() }}
        </div>
        @endif
    </div>
</body>
</html>

