<?php

namespace App\Models;

use App\Models\PostSaved;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    // public function savedPosts()
    // {
    //     return $this->hasMany(PostSaved::class);
    // }
    public function like(){
        return $this->hasMany(Like::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    // !----------------------------
    

}
