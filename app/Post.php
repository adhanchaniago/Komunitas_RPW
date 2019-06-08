<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comunity;
use App\User;
use App\Comment;

class Post extends Model {
	protected $fillable = ['content','title','user_id','comunity_id','media'];

    public function comunity() {
    	return $this->belongsTo(Comunity::class, 'comunity_id', 'id');
    }

    // public function comment() {
    //     return $this->hasMany(App\Comment::class, 'post_id', 'id');
    // }

    public function comments() {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function user() {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
