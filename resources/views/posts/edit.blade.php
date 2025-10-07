@extends('layouts.posts')
@section('title', 'Editar Post')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-xl shadow">

    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Editar Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT') <!-- ou PATCH -->

        <!-- Título -->
        <div>
            <label for="title" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Título</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $post->title) }}" 
                   required
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <!-- Conteúdo -->
        <div>
            <label for="body" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Conteúdo</label>
            <textarea id="body" 
                      name="body" 
                      required
                      class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none h-40 resize-none">{{ old('body', $post->body) }}</textarea>
        </div>

        <!-- Botão Atualizar -->
        <div class="flex gap-4">
            <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Atualizar
            </button>
            <a href="{{ route('posts.show', $post) }}" 
               class="px-6 py-2 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600 transition">
               Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
