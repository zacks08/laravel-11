<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// --------------------
// Rotas de perfil
// --------------------
    Route::middleware('auth')->group(function () {
    // Perfil do usuário logado (edição)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');    
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');    
    // visualizar profile de qualquer usuario 
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show'); 
});