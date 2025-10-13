<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
// --------------------
// Rotas de posts
// --------------------
// Todas rotas CRUD de posts
Route::resource('posts', PostController::class)->middleware([
    'create' => 'auth',
    'store'  => 'auth',
    'edit'   => 'auth',
    'update' => 'auth',
    'destroy' => 'auth',
]);
