<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $data = $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $comment = Comment::findOrFail($postId);

        if (!$comment) {
            return response()->json(['error' => 'comment não encontrado'], 404);
        }
        $post = Post::findOrFail($postId);
        $data['user_id'] = Auth::id();
        $data['post_id'] = $post->id;

        $comment = Comment::create($data);

        return response()->json([
            'message' => 'Comentário adicionado com sucesso',
            'comment' => $comment], 201);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::id() !== $comment->user_id) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $comment->update($request->validate([
            'body' => 'string|max:255',
        ]));

        return response()->json([
            'message' => 'comment atualizado com sucesso',
            'comment' => $comment]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Comentário removido com sucesso ',
            'comentario' => $comment], 200);
    }
}
