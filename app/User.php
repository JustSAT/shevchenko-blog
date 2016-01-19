<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Support\Facades\Crypt;

/**
 * Class User
 *
 * @var string $password
 * @package App
 */
class User extends Model
{

    protected $fillable = [ 'login', 'password', 'name', 'surname' ];

    protected $with = [ 'posts', 'comments'];

    protected $hidden = ['password'];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function posts () {
        return $this->hasMany(Post::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
