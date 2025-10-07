@extends('layouts.posts')

@section('title', 'Criar Post')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
    
    <!-- Voltar -->
    <a href="{{ route('posts.index') }}" 
       class="text-blue-600 hover:text-blue-400 font-medium mb-4 inline-block">
       ← Voltar
    </a>

    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Criar novo post</h1>

    <!-- Formulário -->
    <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Título -->
        <div>
            <label for="title" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Título</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                placeholder="Digite o título do post" 
                value="{{ old('title') }}" 
                required
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Conteúdo -->
        <div>
            <label for="body" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Conteúdo</label>
            <textarea 
                id="body" 
                name="body" 
                placeholder="Escreva aqui o conteúdo do post..." 
                required
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none h-40 resize-none">{{ old('body') }}</textarea>
        </div>

        <!-- Botão -->
        <div>
            <button type="submit" 
                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                Publicar
            </button>
        </div>
    </form>
</div>
@endsection
