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
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
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

    public function hashtags()
    {
        return $this->hasMany(Hashtag::class);
    }
    public function media(){
    return $this->hasMany(Media::class);
    }
    // !-----------
    public function savedPosts()
    {
        return $this->hasMany(PostSaved::class, 'post_id');
    }
    
    public function isSavedByUser($userId)
    {
        return $this->savedPosts()->where('user_id', $userId)->exists();
    }

}
