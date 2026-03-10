@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Editar Documento</h1>

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
            <p class="text-red-700 font-semibold mb-2">Não foi possível atualizar o documento:</p>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.repository.update', $repository) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
            <input type="text" name="title" value="{{ old('title', $repository->title) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $repository->description) }}</textarea>
            @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Categoria *</label>
            <select name="category" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="oficio" {{ old('category', $repository->category) === 'oficio' ? 'selected' : '' }}>Modelo de Ofício</option>
                <option value="decreto" {{ old('category', $repository->category) === 'decreto' ? 'selected' : '' }}>Decreto</option>
                <option value="lei" {{ old('category', $repository->category) === 'lei' ? 'selected' : '' }}>Lei</option>
                <option value="template" {{ old('category', $repository->category) === 'template' ? 'selected' : '' }}>Template</option>
                <option value="outro" {{ old('category', $repository->category) === 'outro' ? 'selected' : '' }}>Outro</option>
            </select>
            @error('category')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Arquivo Atual</label>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 mb-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">{{ $repository->file_name }}</span>
                    <span class="text-xs text-gray-500">{{ $repository->formatted_size }}</span>
                </div>
            </div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Substituir Arquivo (opcional)</label>
            <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            <p class="text-xs text-gray-500 mt-1">Deixe em branco para manter o arquivo atual (máx. 100MB)</p>
            @error('file')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $repository->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Documento ativo (visível para municípios)</span>
            </label>
            @error('is_active')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.repository.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Cancelar</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Atualizar Documento</button>
        </div>
    </form>
</div>
@endsection
