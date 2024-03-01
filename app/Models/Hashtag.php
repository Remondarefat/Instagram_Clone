<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;
    protected $fillable = [
    'post_id',
    'hashtag_name',
    ];

    public function posts() {
        return $this->belongsToMany(Post::class);
    }

}
