<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'media_type', 'media_url'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
