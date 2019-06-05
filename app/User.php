<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Status;
use App\Post;
use App\Comment;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role', 'avatar', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function comunity() {
        // return $this->belongsToMany('App\Comunity')->using('App\UserComunity');
        return $this->belongsToMany('App\Comunity','usercomunity');
    }

    public function post() {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function statuses() {
        return $this->hasOne(Status::class, 'user_id', 'id');
    }
}
