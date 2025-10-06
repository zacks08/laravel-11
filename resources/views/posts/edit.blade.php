<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT') <!-- ou PATCH -->

    <input type="text" name="title" value="{{ $post->title }}" required>
    <textarea name="body" required>{{ $post->body }}</textarea>

    <button type="submit">Atualizar</button>
</form>
<a href="{{ route('posts.show', $post) }}">Cancelar</a>