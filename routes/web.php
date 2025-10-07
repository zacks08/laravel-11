<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfIsAdmin;
// Posts por usuário
Route::get('/profile/{user}', [ProfileController::class, ])
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
// Rotas de posts
// --------------------
// Todas rotas CRUD de posts
Route::resource('posts', PostController::class)->middleware([
    'create' => 'auth',
    'store'  => 'auth',
    'edit'   => 'auth',
    'update' => 'auth',
    'destroy'=> 'auth',
]);

// Comentários
Route::post('posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store')->middleware('auth');

Route::delete('comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')->middleware('auth');

// --------------------
// Rotas admin
// --------------------
Route::middleware(['auth', CheckIfIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Users CRUD
        Route::resource('users', UserController::class)->except(['show']);
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    });

// --------------------
// Rotas de perfil
// --------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --------------------
// Dark, light
// --------------------
Route::post ('/togle-darkmode',function(){
    session (['dark_mode' => !session('dark_mode',false)]);
    return back();
}) ->name('toggle.darkmode');

// --------------------
// Auth routes (login, register etc.)
// --------------------
require __DIR__ . '/auth.php';
