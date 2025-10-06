<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts')); 
        
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $data['user_id'] = Auth::id();
        Post::create($data);

        return redirect()->route('posts.index')->with('success','Post criado');
    }

    public function show(Post $post)
    {         $post->load(['comments.user','user']);
        return view('posts.show', compact('post')); 
    }
    // Posts por usuário
    public function postByUser($userId)
    {
        $posts = Post::where('user_id', $userId)->with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }    



    public function edit(Post $post)
    {
        // só autor ou admin pode editar
        if (Auth::id() !== $post->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id && !Auth::user()->is_admin) abort(403);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update($data);
        return redirect()->route('posts.show', $post)->with('success','Post atualizado');
    }

    public function destroy(Post $post)
    {
        // só autor ou admin
        if (Auth::id() !== $post->user_id && !Auth::user()->is_admin) abort(403);

        $post->delete();
        return redirect()->route('posts.index')->with('success','Post deletado');
    }
}
