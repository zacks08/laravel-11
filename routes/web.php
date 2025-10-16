<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Posts por usuário


Route::get('/users/{user}/posts', [PostController::class, 'postByUser'])
    ->name('users.posts');
// --------------------
// Rotas públicas
// --------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (apenas usuários logados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --------------------
// Dark, light
// --------------------
Route::post('/togle-darkmode', function () {
    session(['dark_mode' => !session('dark_mode', false)]);
    return back();
})->name('toggle.darkmode');

// --------------------
// Auth routes (login, register etc.)
// --------------------
require __DIR__ . '/auth.php';


//outra forma de fazer a importaçao sem precisar mecher no /RouteServiceProvider.php
// importar o arquivo comments.php
/* require __DIR__.'/posts.php'; */