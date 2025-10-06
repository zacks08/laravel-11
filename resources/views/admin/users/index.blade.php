@extends('admin.layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')

<div class="py-1 mb-4 ">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
        Usuários
        
    </h2>

    <a href="{{route('users.create')}}"class="text-white">cadastrar novo usuário
    </a>
</div>

<x-alert />

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-4">nome</th>
                <th scope="col" class="px-6 py-4">e-mail</th>
                <th scope="col" class="px-6 py-4">ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                <td class="px-6 py-4 text-white"  >{{ $user->name }}</td>
                <td class="px-6 py-4  text-white" >{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('users.edit', $user->id) }}" class=" text-white">edit</a>
                    <a href="{{ route('users.show', $user->id) }}"class=" text-white">detalhes</a>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="100">Nenhum usuário no banco</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="py-4">
    {{ $users->links() }}
</div>
@endsection