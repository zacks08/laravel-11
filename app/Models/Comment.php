<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

    use HasFactory; // <- importante

    protected $fillable = ['body', 'post_id', 'user_id'];//<- importante,faz com que o usuario possa inserir dados

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function edit(Comment $comment)
    {
        // só autor ou admin pode editar
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }

}
