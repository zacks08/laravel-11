@extends('layouts.edit')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Editar Usuário</h1>

    <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nome -->
        <div>
            <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nome</label>
            <input type="text" 
                   name="name" 
                   id="name" 
                   value="{{ old('name', $user->name) }}" 
                   required
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Email</label>
            <input type="email" 
                   name="email" 
                   id="email" 
                   value="{{ old('email', $user->email) }}" 
                   required
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <!-- Botão Atualizar -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                Atualizar
            </button>
        </div>
    </form>
</div>
@endsection
