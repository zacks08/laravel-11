@extends('layouts.app')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input name="title" placeholder="Título" value="{{ old('title') }}" required>
    <textarea name="body" placeholder="Conteúdo" required>{{ old('body') }}</textarea>
    <button type="submit">Publicar</button>
</form>
@endsection
