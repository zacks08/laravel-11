<div class="max-w-4xl mx-auto mt-10 p-6 bg-gray-900 text-white rounded-xl">
    <h1 class="text-2xl font-bold mb-4">{{ $user->name }}</h1>
    <p class="text-gray-400 mb-6">Email: {{ $user->email }}</p>

    <h2 class="text-xl font-semibold mb-2">Posts de {{ $user->name }}:</h2>

    @forelse ($user->posts as $post)
        <div class="bg-gray-800 p-4 rounded-lg mb-3">
            <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
            <p class="text-gray-400">{{ Str::limit($post->content, 100) }}</p>

            @if(auth()->id() === $user->id)
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-400 hover:text-blue-300">Editar</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-300">Deletar</button>
                    </form>
                </div>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Esse usuário ainda não postou nada.</p>
    @endforelse
</div>
<a href="{{ route('posts.index') }}" class="text-blue-400 hover:text-blue-300">voltar</a>