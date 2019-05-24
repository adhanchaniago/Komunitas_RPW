<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use App\User;
use App\Comunity;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'media' => 'avatars/1.png',
        'content' => $faker->realText(200),
        'vote' => $faker->numberBetween(-100,100),
        'view' => $faker->numberBetween(0,1000),
        'user_id' => function() {
        	return User::all()->random();
        },
        'comunity_id' => function() {
        	return Comunity::all()->random();
        }        
    ];
});
