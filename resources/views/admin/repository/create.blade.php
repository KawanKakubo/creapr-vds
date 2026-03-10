@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Adicionar Documento ao Repositório</h1>

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
            <p class="text-red-700 font-semibold mb-2">Não foi possível salvar o documento:</p>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.repository.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Ex: Modelo de Ofício para Solicitação de Recursos">
            @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Breve descrição do documento...">{{ old('description') }}</textarea>
            @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Categoria *</label>
            <select name="category" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">Selecione...</option>
                <option value="oficio" {{ old('category') === 'oficio' ? 'selected' : '' }}>Modelo de Ofício</option>
                <option value="decreto" {{ old('category') === 'decreto' ? 'selected' : '' }}>Decreto</option>
                <option value="lei" {{ old('category') === 'lei' ? 'selected' : '' }}>Lei</option>
                <option value="template" {{ old('category') === 'template' ? 'selected' : '' }}>Template</option>
                <option value="outro" {{ old('category') === 'outro' ? 'selected' : '' }}>Outro</option>
            </select>
            @error('category')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Arquivo *</label>
            <input type="file" name="file" required accept=".pdf,.doc,.docx,.xls,.xlsx,.zip" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            <p class="text-xs text-gray-500 mt-1">Formatos aceitos: PDF, DOC, DOCX, XLS, XLSX, ZIP (máx. 100MB)</p>
            @error('file')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Documento ativo (visível para municípios)</span>
            </label>
            @error('is_active')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.repository.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Cancelar</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Adicionar Documento</button>
        </div>
    </form>
</div>
@endsection
