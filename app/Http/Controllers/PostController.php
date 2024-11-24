<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:5000', 
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:10240', 
        ]);

        $path = $request->file('media') ? $request->file('media')->store('uploads', 'public') : null;

        Post::create([
            'content' => $request->input('content'),
            'media' => $path,
        ]);

        return redirect('/')->with('success', 'Bài viết đã được đăng!');
    }
}
