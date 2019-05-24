<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\EventComunity;
use Faker\Generator as Faker;
use App\Event;
use App\Comunity;

$factory->define(EventComunity::class, function (Faker $faker) {
    return [
    	'event_id' => function() {
        	return Event::all()->random();
        },
        'comunity_id' => function() {
        	return Comunity::all()->random();
        }
    ];
});
