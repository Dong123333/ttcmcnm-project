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
        if (!Auth::check()) {
            return redirect()->route('form_login')->with('error', 'Bạn cần đăng nhập để thực hiện hành động này.');
        }

        $request->validate([
            'content' => 'required|string|max:5000',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4|max:102400'
        ]);

        try {
            $userId = Auth::id();
            $post = Post::create([
                'user_id' => $userId,
                'content' => $request->content,
            ]);

            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {           
                    try {
                        $isVideo = strpos($file->getMimeType(), 'video') === 0;

                        $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                            'folder' => 'SocialNetwork',
                            'resource_type' => $isVideo ? 'video' : 'image'
                        ]);
                
                        Media::create([
                            'post_id' => $post->id,
                            'media_type' => $file->getMimeType() === 'video/mp4' ? 'video' : 'image',
                            'media_url' => $uploadedFile->getSecurePath(),
                            'public_id' => $uploadedFile->getPublicId(),
                        ]);
                    } catch (\Exception $e) {
                    }
                }
            }         

            return redirect()->route('home')->with('success', 'Bài viết đã được đăng thành công!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Đã xảy ra lỗi khi đăng bài: ' . $e->getMessage());
        }
    }


    public function edit($postId)
    {
        try {
            $post = Post::with('media')->findOrFail($postId);

            if ($post->user_id !== Auth::id()) {
                return redirect()->route('posts.home')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này.');
            }

            return view('update_post', compact('post'));
        } catch (\Exception $e) {            
            return redirect()->route('home')->with('error', 'Không thể tải bài viết: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4|max:51200'
        ]);
    
        try {
            $post = Post::with('media')->findOrFail($postId);
    
            if ($post->user_id !== Auth::id()) {
                return redirect()->route('home')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này.');
            }
    
            $post->content = $request->content;
            $post->save();
    
            if ($request->hasFile('media')) {
                foreach ($post->media as $media) {
                    if (!empty($media->public_id)) {   
                        //Cloudinary::destroy($media->public_id);
                        $resourceType = ($media->media_type === 'video') ? 'video' : 'image';
                        Cloudinary::destroy($media->public_id, ['resource_type' => $resourceType]);
                    }
                    $media->delete();
                }
            
                foreach ($request->file('media') as $file) {
                    $isVideo = strpos($file->getMimeType(), 'video') === 0;

                    $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                        'folder' => 'SocialNetwork',
                        'resource_type' => $isVideo ? 'video' : 'image'
                    ]);
            
                    Media::create([
                        'post_id' => $post->id,
                        'media_type' => $file->getMimeType() === 'video/mp4' ? 'video' : 'image',
                        'media_url' => $uploadedFile->getSecurePath(),
                        'public_id' => $uploadedFile->getPublicId(),
                    ]);
                }
            }
    
            return redirect()->route('home')->with('success', 'Bài viết đã được cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Đã xảy ra lỗi khi cập nhật bài viết: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $postId)
    {
        try {
            $post = Post::with('media')->findOrFail($postId);
    
            if ($post->user_id !== Auth::id()) {
                return response()->json(['error' => 'Bạn không có quyền xóa bài viết này.'], 403);
            }
    
            foreach ($post->media as $media) {
                if (!empty($media->public_id)) {
                    $resourceType = ($media->media_type === 'video') ? 'video' : 'image';
                    Cloudinary::destroy($media->public_id, ['resource_type' => $resourceType]);
                }
                $media->delete();
            }
    
            $post->delete();
    
            return redirect()->route('home')->with('success', 'Bài viết đã được cập nhật thành công!');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi khi xóa bài viết.'], 500);
        }
    }
    
}
