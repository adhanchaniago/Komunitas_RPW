<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EventComunity extends Pivot {
	protected $table = 'eventcomunity';
    public $incrementing = true;
}
