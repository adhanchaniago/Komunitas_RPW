<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use App\User;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(200),
        'vote' => $faker->numberBetween(-100,100),
        'user_id' => function() {
        	return User::all()->random();},
        'post_id' => function() {
        	return Post::all()->random();}
    ];
});
