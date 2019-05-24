<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserComunity extends Pivot {
	protected $table = 'usercomunity';
    public $incrementing = true;
}
