<?php

namespace App\Http\Controllers\V1\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $categories = Category::latest()->get();
        return view('posts.index', compact('posts','categories'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('posts.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photo_path' => 'nullable|image|max:2048',
        ]);
        $photoPath = null;
        if ($request->hasFile('photo_path')) {
            $photoPath = $request->file('photo')->store('posts', 'public');
        }
        Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'photo_path' => $photoPath,
            'category_id' => $request['category_id'],
            'published_at' => $request['published_at'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'پست با موفقیت ایجاد شد.');
    }
    public function search(Request $request)
    {
        $posts = Post::query();

        if (!empty($request['q'])) {
            $posts->where('title', 'like', '%'.$request->q.'%')
                ->orWhere('content', 'like', '%'.$request->q.'%');
        }

        if (!empty($request['category_id'])) {
            $posts->where('category_id', $request['category_id']);
        }

        $posts = $posts->latest()->get();
        $categories = Category::latest()->get();
        return view('posts.index', compact('posts','categories'));
    }

    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){
            abort(403);
        }
        $categories = Category::latest()->get();
        return view('posts.edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id()){
            abort(403);
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo_path')) {
            $photoPath = $request->file('photo_path')->store('posts', 'public');
            $post->photo_path = $photoPath;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'پست ویرایش شد.');
    }

    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id()){
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'پست حذف شد.');
    }
}
