<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status','user_id'];

    public function user_status() {
    	return $this->belongsTo(App\User::class, 'user_id', 'id');
    }
}
