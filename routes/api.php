<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// 🔓 ROTAS PÚBLICAS (não precisam de token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Exibir posts publicamente
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

/*  🔒 ROTAS PROTEGIDAS (precisam de token Sanctum)
como fazer isso passo a passo
vc vai pegar o token que foi gerado no login e vai colocar ele no header da requisição
tudo isso no postman
e ai vc vai conseguir acessar essas rotas protegidas
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
vai ficar assim la
KEY: Authorization
VALUE: Bearer SEU_TOKEN_AQUI
e ai vc clica em send e vai funcionar TEORICAMENTE  */
Route::middleware('auth:sanctum')->group(function () {
    // ==== USUÁRIOS ====
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);

    // ==== POSTS ====
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    // ==== COMENTÁRIOS ====
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    // ==== LOGOUT ====
    Route::post('/logout', [AuthController::class, 'logout']);
});
