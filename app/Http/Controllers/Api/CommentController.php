<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|string|max:500'
        ]);
        
        $data['user_id'] = Auth::id();
        $data['post_id'] = $post->id;

        $comment = Comment::create($data);
        return response()->json([
            'message' => 'Comentário adicionado com sucesso',
            'comment'=>$comment], 201);
    }

    public function update(Request $request, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) return response()->json(['error' => 'Não autorizado'], 403);

        $comment->update($request->validate(['body' => 'string|max:500']));
        return response()->json($comment);
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) return response()->json(['error' => 'Não autorizado'], 403);

        $comment->delete();
        return response()->json(['message' => 'Comentário removido']);
    }
}
