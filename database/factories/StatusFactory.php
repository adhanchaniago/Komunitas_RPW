<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Status;
use App\User;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'status' => $faker->realText(50),
        'user_id' => $faker->unique()->numberBetween(1,30),
    ];
});
