<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('post.posts', compact('posts'));
    }

    public function create()
    {
        return view('post.post_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Post::create($request->only('name', 'description', 'price'));

        return redirect()->route('post.index')->with('success', 'Post created successfully');
    }

    public function edit(Post $post)
    {
        return view('post.post_edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $post->update($request->only('name', 'description', 'price'));

        return redirect()->route('post.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully');
    }
}
