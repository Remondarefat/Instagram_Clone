<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'caption',
        'hashtag',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function media(){
        return $this->hasMany(Media::class);
    }
    public function post_saved(){
        return $this->hasMany(Post_saved::class);
    }
    public function like(){
        return $this->hasMany(Like::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
}
