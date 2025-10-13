@extends('layouts.posts')
@section('title', $post->title)

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-xl shadow">

    <!-- Voltar -->
    <a href="{{ route('posts.index') }}"
        class="text-blue-600 hover:text-blue-400 font-medium mb-4 inline-block">
        ← Voltar
    </a>

    <!-- Post -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $post->title }}</h1>
        <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $post->body }}</p>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Autor: <span class="font-medium">{{ $post->user->name }}</span>
        </p>
        <p class="text-sm text-gray-400">Criado: {{ $post->created_at->diffForHumans() }}</p>
        <p class="text-sm text-gray-400">Atualizado: {{ $post->updated_at->diffForHumans() }}</p>
    </div>

    <!-- Ações do post -->
    @auth
    @if(auth()->id() == $post->user_id || auth()->user()->is_admin)
    <div class="flex gap-4 mb-6">
        <a href="{{ route('posts.edit',$post)}}"
            class="px-4 py-2 bg-none text-blue-500 rounded hover:text-blue-700 transition">
            Editar
        </a>
        <form method="POST" action="{{ route('posts.destroy', $post) }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                onclick="return confirm('Tem certeza que deseja apagar este post?')"
                class="px-4 py-2 bg-none text-red-500 rounded hover:text-red-700 transition">
                Apagar
            </button>
        </form>
    </div>
    @endif
    @endauth

    <hr class="border-gray-300 dark:border-gray-700 mb-6">

    <!-- Comentários -->
    <h3 class="text-xl font-semibold mb-4">Comentários</h3>

@forelse($post->comments as $comment)
<div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm">
    <div class="flex justify-between items-center mb-2">
        <strong class="text-gray-900 dark:text-gray-100">{{ $comment->user->name }}</strong>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
    </div>
    
    <p class="text-gray-700 dark:text-gray-200 mb-2">{{ $comment->body }}</p>

    @auth
    @if(auth()->id() == $comment->user_id || auth()->user()->is_admin || auth()->id() == $post->user_id)
    <div class="flex gap-2 mt-2">
        <a href="{{ route('comments.edit', $comment->id) }}"
           class="px-2 py-1 bg-none text-blue-500 rounded hover:text-blue-700 transition">
           Editar
        </a>        

        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-2 py-1 bg-none text-red-500 rounded hover:text-red-700 transition"
                onclick="return confirm ('Tem certeza que deseja apagar esse comentário?')">
               Apagar 
            </button>
        </form>
    </div>
    @endif
    @endauth
</div>
@empty
<p class="text-gray-500">Nenhum comentário ainda.</p>
@endforelse


    <!-- Formulário de comentário -->
    @auth
    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-6 space-y-2">
        @csrf
        <textarea name="body" required placeholder="Escreva seu comentário..."
            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none h-24"></textarea>
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Comentar
        </button>
    </form>
    @else
    <p class="text-gray-500 mt-4">Faça login para comentar.</p>
    @endauth

</div>
@endsection
