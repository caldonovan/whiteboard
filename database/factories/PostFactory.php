<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->words(4, true),
        'body' => $faker->text(),
        'user_id' => function() {
            // * Get all the ID's from the users table, convert to an array and return a single random ID.
            return array_rand(DB::table('users')->pluck('id')->toArray());
        },
        'unique_views' => rand(1, 100)
    ];
});
