<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status'];

    public function user_status() {
    	$this->belongsTo('App\User');
    }
}