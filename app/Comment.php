<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Comment extends Model {
    protected $fillable = ['content','like','dislike','user_id','post_id'];

    public function user() {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post() {
    	return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
