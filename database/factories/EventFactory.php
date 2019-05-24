<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Event;
use App\Comunity;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
    	'content' => $faker->realText(200),
    	'type' => $faker->word,
    	'date' => $faker->date('Y-m-d H:i:s','now'),
    ];
});
