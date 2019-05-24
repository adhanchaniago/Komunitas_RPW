<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunity extends Model {
    protected $fillable = ['type','name','followers'];

    public function event() {
        // return $this->belongsToMany('App\Event')->using('App\EventComunity');
        return $this->belongsToMany('App\Event','eventcomunity');
    }

    public function post() {
        return $this->hasMany(App\Post::class, 'comunity_id', 'id');
    }

    public function user() {
        // return $this->belongsToMany('App\User')->using('App\UserComunity');
        return $this->belongsToMany('App\User','usercomunity');
    }

}
