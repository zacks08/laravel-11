<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest('updated_at')->get();

        return UserResource::collection($users);
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $validated = $request->validate([
            'name' => 'string|max:50',
            'email' => 'string|max:255', Rule::unique('users')->ignore($user->id),
        ]);
        $user->update($validated);

        return response()->json([
            'message' => 'seu usuario foi atualizado com sucesso',
            'user' => $user], 201);
    }
}
