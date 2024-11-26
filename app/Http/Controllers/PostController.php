<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Media;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Kiểm tra trạng thái đăng nhập
        // if (!Auth::check()) {
        //     return response()->json(['error' => 'Bạn cần đăng nhập để đăng bài'], 401);
        // }

        // Validate request
        $request->validate([
            'content' => 'required|string|max:5000',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4|max:51200' // 50MB max for each file
        ]);

        try {
            $userId = 1;
            // Save post content
            $post = Post::create([
                'user_id' => $userId,//Auth::id(), // ID của người dùng hiện tại
                'content' => $request->content,
            ]);

            // Handle media upload
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    // Upload file lên Cloudinary
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
                        'folder' => 'SocialNetwork'
                    ])->getSecurePath();

                    // Save media to database
                    Media::create([
                        'post_id' => $post->id,
                        'media_type' => $file->getMimeType() === 'video/mp4' ? 'video' : 'image',
                        'media_url' => $uploadedFileUrl,
                    ]);
                }
            }

            return redirect()->route('home')->with('success', 'Bài viết đã được đăng thành công!');

        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi khi đăng bài: ' . $e->getMessage()], 500);
        }
    }
}