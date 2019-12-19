<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $user_id = App\User::inRandomOrder()->first()->id;
    return [
        'post_id' => App\Post::inRandomOrder()->first()->id,
        'user_id' => $user_id,
        'user_name' => DB::table('users')->where('id', $user_id)->value('name'),
        'body' => $faker->paragraph
    ];
});
