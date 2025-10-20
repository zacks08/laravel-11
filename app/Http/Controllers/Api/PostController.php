<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->withCount('comments')->latest('updated_at')->get();

        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::with(['user', 'comments.user'])->withCount('comments')->findOrFail($id);

        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:255',
        ]);

        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        return response()->json([
            'message' => 'Post criado com sucesso',
            'post' => $post,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if (Auth::id() !== $post->user_id) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $post->update($request->validate([
            'title' => 'string|max:50',
            'body' => 'string|max:255',
        ]));

        return response()->json([
            'message' => 'Post atualizado com sucesso',
            'post' => $post]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (Auth::id() !== $post->user_id && !Auth::user()->is_admin) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deletado com sucesso',
            'conteudo do post' => $post]);
    }
}
