<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Status;
use App\User;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'status' => $faker->realText(30),
        'user_id' => User::all()->random(),
    ];
});
