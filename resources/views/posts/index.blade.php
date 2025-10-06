@extends('layouts.app')
@section('title', 'Posts')

    <h1>Todos os Posts</h1>
    <a href="{{ route('posts.create') }}" class="text-blue-500">Criar novo post</a>


    @forelse($posts as $post)
        <div class="post mb-4 p-4 border rounded">
            <h2 class="font-bold">{{ $post->title }}</h2>
            <p> {{ $post->body }}</p>
            <form action="POST" method="post">
                @csrf
                <a href="{{ route('posts.show',$post->id) }}" class="text-blue-500">Ler mais</a>
            </form>
        <a href="{{route('users.posts',$post->user->id)}}"> <small>Por: {{ $post->user->name ?? 'Usuário não encontrado' }}</small></a>  
        </div>
    @empty
        <p>Nenhum post encontrado.</p>
    @endforelse

    {{ $posts->links() }}

