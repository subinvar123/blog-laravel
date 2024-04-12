<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'name',
        'user_id',
        'post_status',
        'usertype',
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
