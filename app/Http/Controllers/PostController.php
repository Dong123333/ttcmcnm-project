<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Media;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'content' => 'required|string|max:5000',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4|max:51200' // 50MB max for each file
        ]);

        try {
            // Save post content
            $post = new Post();
            $post->user_id = auth()->id(); // Assuming the user is authenticated
            $post->content = $request->content;
            $post->save();

            // Handle media upload
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
                        'folder' => 'SocialNetwork'
                    ])->getSecurePath();

                    // Save media to database
                    Media::create([
                        'post_id' => $post->id,
                        'media_type' => $file->getMimeType() === 'video/mp4' ? 'video' : 'image',
                        'media_url' => $uploadedFileUrl
                    ]);
                }
            }

            return response()->json(['message' => 'Post created successfully!'], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create post: ' . $e->getMessage()], 500);
        }
    }
}
