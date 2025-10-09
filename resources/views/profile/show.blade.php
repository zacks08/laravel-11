@extends('layouts.posts')

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-4">

    {{-- Header do perfil --}}
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ auth()->user()->name }}</h1>
            <p class="text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">
                Total de posts: {{ auth()->user()->posts->count() }}
            </p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('profile.edit') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 transition">
               Editar perfil
            </a>
        </div>
    </div>

    {{-- Mensagem de sucesso --}}
    @if(session('status') == 'profile-updated')
        <div class="mb-6 p-4 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 rounded">
            Perfil atualizado com sucesso!
        </div>
    @endif

    {{-- Lista de posts --}}
    <h2 class="text-2xl font-semibold mb-4 text-gray-700 dark:text-gray-200">Meus posts</h2>

    @if(auth()->user()->posts->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">Você ainda não publicou nenhum post.</p>
         <a href="{{route('posts.index')}}">
  
         
        
    @else
        <div class="grid md:grid-cols-2 gap-6">
            @foreach(auth()->user()->posts as $post)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow hover:shadow-lg transition bg-white dark:bg-gray-800">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">{{ Str::limit($post->body, 100) }}</p>
                    <p class="text-sm text-gray-400 dark:text-gray-500">Publicado em: {{ $post->created_at->format('d/m/Y') }}</p>
                    <a href="{{ route('posts.show', $post) }}" 
                       class="mt-3 inline-block text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 font-medium">
                       Ver post completo
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
