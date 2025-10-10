<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// --------------------
// Rotas de perfil
// --------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');    
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show'); 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');    
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});