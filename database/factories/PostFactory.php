<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->words(4, true),
        'body' => $faker->text(),
        'user_id' => function() {
            //return array_rand(DB::table('users')->pluck('id')->toArray());
            return App\User::inRandomOrder()->first()->id;
        }
    ];
});
