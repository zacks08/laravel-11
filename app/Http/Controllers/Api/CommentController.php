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

        $post = Post::findOrFail($postId);

        if (!$post) {
            return response()->json(['error' => 'Post não encontrado'], 404);
        }

        $data['user_id'] = Auth::id();
        $data['post_id'] = $post->id;

        $comment = Comment::create($data);

        return response()->json([
            'message' => 'Comentário adicionado com sucesso',
            'comment' => $comment], 201);
    }

    public function update(Request $request, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            abort(403);
        }

        $data = $request->validate([
            'body' => 'required|string|max:200',
        ]);

        $comment->update($data);

        return response()->json([
            'message' => 'Comentário atualizado com sucesso',
            'comment' => $comment,
        ]);
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comentário removido']);
    }
}
