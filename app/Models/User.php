<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'avatar',
        'fullName',
        'nickName',
        'code_id',
        'expired_id',
        'isActive',
    ];

    protected $casts = [
        'expired_id' => 'datetime',
        'isActive' => 'boolean',
    ];

    protected $hidden = [
        'password',
        'code_id',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function friends()
    {
        return $this->hasMany(Friend::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }
}
