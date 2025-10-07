<!DOCTYPE html>
<html lang="pt-br" class="{{ session('dark_mode') ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <header class="p-4 bg-white dark:bg-gray-800 shadow">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <h1 class="font-bold text-xl">Meu Blog</h1>
            <!-- Botão toggle dark/light -->
            <form method="POST" action="{{ route('toggle.darkmode') }}">
                @csrf
                <button type="submit" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    {{ session('dark_mode') ? 'Light Mode' : 'Dark Mode' }}
                </button>
            </form>
        </div>
    </header>

    <main class="min-h-screen py-6">
        @yield('content')
    </main>
</body>
</html>
