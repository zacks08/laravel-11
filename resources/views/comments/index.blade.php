@foreach($comments as $comment)
    <div>
        <p>{{ $comment->body }}</p>
        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary">Editar</a>
    </div>
@endforeach
