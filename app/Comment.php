<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['content', 'user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(Post::class);
    }

    public function posts()
    {
        return $this->belongsTo(User::class);
    }

}
