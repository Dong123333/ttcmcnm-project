<?php
namespace App\Services;

use App\Models\User;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;

class HomeService {
    protected $user;
    protected $post;

    public function __construct(User $user,Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function updateProfile($params)
    {
        try {   
            $user = auth()->user();
            if (!$user) {
                throw new \Exception('Không tìm thấy người dùng');
            }  

            if (isset($params['avatar'])) {
                // Upload ảnh lên Cloudinary
                $uploadedFile = Cloudinary::upload($params['avatar']->getRealPath(), [
                    'folder' => 'avatars/',
                    'verify' => false,
                ]);

                // Lấy URL ảnh sau khi upload
                $avatarUrl = $uploadedFile->getSecurePath();
            } else {
                $avatarUrl = $user->avatar; // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            }

            $user->update([
                'fullName' => $params['fullName'] ?? $user->fullName,
                'nickName' => $params['nickName'] ?? $user->nickName,
                'avatar' => $avatarUrl, // Cập nhật ảnh đại diện
            ]);
            // Lưu lại thông tin người dùng
            $user->save();
    
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
    }
    
    public function getList(){
        $currentUserId = Auth::id();
        $users = $this->user->where('id', '!=', $currentUserId)->get();
        $posts = $this->post->with('user', 'media')->get();
        return [
            'users' => $users,
            'posts' => $posts
        ];
    }
}