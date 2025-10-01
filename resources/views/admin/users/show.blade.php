@extends('admin.layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')


    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
        Detalhes do Usuário {{ $user->name }}
    </h2>

<ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400 mb-6">
    <li>Nome: {{ $user->name }}</li>
    <li>E-mail: {{ $user->email }}</li>
</ul>





<form action="{{ route('users.destroy', $user->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit">Deletar</button>
</form>

@endsection