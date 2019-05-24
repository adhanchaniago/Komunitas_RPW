<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\UserComunity;
use App\Comunity;
use App\User;
use Faker\Generator as Faker;

$factory->define(UserComunity::class, function (Faker $faker) {
    return [
        'comunity_id' => function() {
        	return Comunity::all()->random();
        },
        'user_id' => function() {
        	return User::all()->random();
        }
    ];
});
