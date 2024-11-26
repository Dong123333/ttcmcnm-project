<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['username', 'email', 'password', 'profile_picture', 'bio', 'code_id', 'expired_id', 'isActive'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}