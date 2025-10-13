@extends('layouts.posts')

@section('title', 'Posts')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        @auth
        <a href="{{route('profile.show',auth()->user()->id)}}" class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            <span>{{ auth()->user()->name }}</span> <!-- so funciona se estiver nesse formato,pel fato do auth carregar os dados dos usuarios em qualuqer view ,assim n precisando colocar nada no controller --></a>
        </a>
        @endauth
        <a href="{{route('posts.index')}}">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Todos os Posts</h1>
            <a href="{{ route('posts.create') }}"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                Criar novo post
            </a>
    </div>

    @forelse($posts as $post)
    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow mb-5 hover:shadow-lg transition"> 
        <a href="{{ route('profile.show', $post->user->id) }}"
            class="font-medium text-blue-600 hover:text-blue-400">
            {{ $post->user->name ?? 'Usuário não encontrado' }}
        </a>
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
            {{ $post->title }}
        </h2>

        <p class="text-gray-700 dark:text-gray-300 mb-4">
            {{ Str::limit($post->body, 150, '...') }}
        </p>
        <p class="text-gray-400">comentarios {{$post->comments->count()}}</p>

        <div class="flex justify-between items-center text-sm text-gray-600 dark:text-gray-400">
            <div class="flex items-center gap-2">

                <span class="text-gray-400">•</span>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>

            <a href="{{ route('posts.show', $post->id) }}"
                class="text-blue-500 font-medium hover:text-blue-400 transition">
                Ler mais →
            </a>
        </div>
    </div>
    @empty
    <p class="text-gray-500 text-center">Nenhum post encontrado.</p>
    @endforelse

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection