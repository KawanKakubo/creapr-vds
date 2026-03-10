@extends('layouts.municipality')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Repositório de Documentos</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar documentos..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="w-64">
                <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Todas as categorias</option>
                    <option value="oficio" {{ request('category') === 'oficio' ? 'selected' : '' }}>Modelo de Ofício</option>
                    <option value="decreto" {{ request('category') === 'decreto' ? 'selected' : '' }}>Decreto</option>
                    <option value="lei" {{ request('category') === 'lei' ? 'selected' : '' }}>Lei</option>
                    <option value="template" {{ request('category') === 'template' ? 'selected' : '' }}>Template</option>
                    <option value="outro" {{ request('category') === 'outro' ? 'selected' : '' }}>Outro</option>
                </select>
            </div>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Filtrar</button>
            @if(request('search') || request('category'))
                <a href="{{ route('municipality.repository.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Limpar</a>
            @endif
        </form>
    </div>

    @if($repositories->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Nenhum documento encontrado</h3>
            <p class="text-gray-500">{{ request('search') || request('category') ? 'Tente ajustar os filtros de busca.' : 'Ainda não há documentos disponíveis no repositório.' }}</p>
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($repositories as $repository)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                @if($repository->category === 'oficio') bg-blue-100 text-blue-800
                                @elseif($repository->category === 'decreto') bg-purple-100 text-purple-800
                                @elseif($repository->category === 'lei') bg-green-100 text-green-800
                                @elseif($repository->category === 'template') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $repository->category_label }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $repository->formatted_size }}</span>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $repository->title }}</h3>
                        
                        @if($repository->description)
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $repository->description }}</p>
                        @endif

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                </svg>
                                {{ $repository->download_count }} {{ $repository->download_count === 1 ? 'download' : 'downloads' }}
                            </div>
                            <a href="{{ route('municipality.repository.download', $repository) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Baixar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($repositories->hasPages())
            <div class="mt-8">
                {{ $repositories->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
