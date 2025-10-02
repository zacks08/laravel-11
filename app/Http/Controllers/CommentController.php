<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $data['user_id'] = Auth::id();
        $data['post_id'] = $post->id;

        Comment::create($data);

        return redirect()->route('posts.show', $post)->with('success','Comentário adicionado');
    }

    public function destroy(Comment $comment)
    {
        // só autor do comentário ou admin ou autor do post pode deletar
        $user = Auth::user();
        if ($user->id !== $comment->user_id && !$user->is_admin && $user->id !== $comment->post->user_id) {
            abort(403);
        }

        $comment->delete();
        return back()->with('success','Comentário removido');
    }
}
