<?php
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;



// Comentários
Route::post('posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store')->middleware('auth');

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])
    ->name('comments.edit')->middleware('auth');


Route::get('/comments/{user}', [CommentController::class, 'show'])
    ->name('comments.show');

Route::put('comments/{comment}', [CommentController::class, 'update'])
    ->name('comments.update')->middleware('auth');

Route::delete('comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')->middleware('auth');
