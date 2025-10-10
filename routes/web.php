<?php

use App\Http\Controllers\Admin\UserController;



use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfIsAdmin;
// Posts por usuário
Route::get('/profile/{user}', [ProfileController::class,])
    ->name('profile.show');

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
// Rotas admin
// --------------------
Route::middleware(['auth', CheckIfIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
});


 


//outra forma de fazer a importaçao sem precisar mecher no /RouteServiceProvider.php
// importar o arquivo comments.php
/* require __DIR__.'/comments.php'; */




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
