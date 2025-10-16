<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json('users');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json('user');
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // pega as informaçoes do usuario atraves do id

        // Se quiser permitir que só o dono altere:
        if ($request->user()->id !== $user->id) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($user->id)],

        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }
};