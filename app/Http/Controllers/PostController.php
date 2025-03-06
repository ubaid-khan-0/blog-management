<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure authentication
    }

    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

 
    public function create()
    {
       
        if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('editor')) {
            abort(403);
        }

        return view('posts.create');
    }


    public function store(Request $request)
    {

        if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('editor')) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif', 
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }
     
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'author_id' => auth()->id()
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }


    public function edit(User $user,Post $post)
    {
        $this->authorize('update', $post); // Using PostPolicy
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); // Using PostPolicy

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        } else {
            $imagePath = $post->image;
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // Using PostPolicy

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
