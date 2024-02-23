<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PDO;

class User extends Authenticatable
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
    //Followers Relation
    public function followers()
    {
        return $this->belongsToMany(User::class, 'users_followers', 'user_id', 'follower_id')->withTimestamps();
    }
};
