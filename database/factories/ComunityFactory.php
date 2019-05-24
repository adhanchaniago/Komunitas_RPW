<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comunity;
use Faker\Generator as Faker;

$factory->define(Comunity::class, function (Faker $faker) {
    return [
    	'banner' => 'avatars/1.png',
        'type' => $faker->word,
        'name' => $faker->word,
        'followers' => $faker->numberBetween(0,5000),
    ];
});
