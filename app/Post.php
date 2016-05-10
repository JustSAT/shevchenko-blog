<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 12.01.16
 * Time: 13:30
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [ 'title', 'content', 'user_id', 'small_image', 'big_image' ];
    public function getTestAttribute () {
        return lcfirst($this->attributes['test']);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

}
