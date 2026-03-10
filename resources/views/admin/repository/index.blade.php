@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Repositório de Documentos</h1>
        <a href="{{ route('admin.repository.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
            + Adicionar Documento
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Filters -->
    <form method="GET" class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Categoria</label>
                <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Todas</option>
                    <option value="oficio" {{ request('category') === 'oficio' ? 'selected' : '' }}>Modelo de Ofício</option>
                    <option value="decreto" {{ request('category') === 'decreto' ? 'selected' : '' }}>Decreto</option>
                    <option value="lei" {{ request('category') === 'lei' ? 'selected' : '' }}>Lei</option>
                    <option value="template" {{ request('category') === 'template' ? 'selected' : '' }}>Template</option>
                    <option value="outro" {{ request('category') === 'outro' ? 'selected' : '' }}>Outro</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Título ou descrição..." class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div class="flex items-end">
                <button type="submit" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition w-full">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Documents Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tamanho</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Downloads</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($documents as $doc)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $doc->title }}</div>
                            @if($doc->description)
                                <div class="text-sm text-gray-500">{{ Str::limit($doc->description, 60) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $doc->category_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doc->formatted_size }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doc->download_count }}</td>
                        <td class="px-6 py-4">
                            @if($doc->is_active)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Ativo</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inativo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.repository.edit', $doc) }}" class="text-blue-600 hover:text-blue-800" title="Editar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.repository.destroy', $doc) }}" onsubmit="return confirm('Confirma remoção deste documento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Remover">
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
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Nenhum documento encontrado. <a href="{{ route('admin.repository.create') }}" class="text-blue-600 hover:underline">Adicione o primeiro</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($documents->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $documents->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
