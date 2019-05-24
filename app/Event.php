<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
	protected $fillable = ['content','type','date'];

    public function comunity() {
        // return $this->belongsToMany('App\Comunity')->using('App\EventComunity');
        return $this->belongsToMany('App\Comunity','eventcomunity');
    }
}
