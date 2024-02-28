<?php

// App\Models\PostSaved.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostSaved extends Model
{
    protected $table = 'saved_posts'; // Specify the correct table name

    protected $fillable = ['user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

