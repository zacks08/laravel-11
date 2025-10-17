<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// --------------------
// Rotas de publica de usuario
// --------------------
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
