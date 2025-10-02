@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ $post->body }}</p>
<p>Autor: {{ $post->user->name }}</p>

<hr>
<h3>Comentários</h3>
@foreach($post->comments as $comment)
    <div>
        <strong>{{ $comment->user->name }}</strong> — {{ $comment->created_at->diffForHumans() }}
        <p>{{ $comment->body }}</p>

        @auth
            @if(auth()->id() == $comment->user_id || auth()->user()->is_admin || auth()->id() == $post->user_id)
                <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Apagar</button>
                </form>
            @endif
        @endauth
    </div>
@endforeach

@auth
    <form action="{{ route('comments.store', $post) }}" method="POST">
        @csrf
        <textarea name="body" required placeholder="Escreva seu comentário"></textarea>
        <button type="submit">Comentar</button>
    </form>
@else
    <p>Faça login pra comentar.</p>
@endauth
@endsection
