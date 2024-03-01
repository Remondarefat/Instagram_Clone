<?php

namespace App\Models;

use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'email',
        'fullname',
        'username',
        'password',
        'avatar',
        'website',
        'bio',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function post_saved()
    {
        return $this->hasMany(Post_saved::class);
    }
    public function like()
    {
        return $this->hasMany(Like::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    //Followings Relation
    public function followings()
    {
        return $this->belongsToMany(User::class, 'users_followers', 'follower_id', 'user_id')->withTimestamps();
    }
    //Follow method
    public function follow(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists();
    }
    public function followedBy(User $user)
    {
        return $user->followings()->where('user_id', $this->id)->exists();
    }

    //Followers Relation
    public function followers()
    {
        return $this->belongsToMany(User::class, 'users_followers', 'user_id', 'follower_id')->withTimestamps();
    }
    //Block Relation
    public function block()
    {
        return $this->belongsToMany(User::class, 'users_block', 'user_id', 'blocked_id')->withTimestamps();
    }
    //Block method
    public function blockUser(User $user)
    {
        return $this->block()->where('blocked_id', $user->id)->exists();
    }
    //! -----------------------Saved Posts-----------------------------
    public function savedPosts()
    {
        return $this->hasMany(PostSaved::class, 'post_id');
    }
    public function isSavedByUser($userId)
    {
        return $this->savedPosts()->where('user_id', $userId)->exists();
    }


}
