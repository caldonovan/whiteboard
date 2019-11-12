<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ModuleUser;
use Faker\Generator as Faker;

$factory->define(ModuleUser::class, function (Faker $faker) {
    return [
        DB::table('module_user')->insert(
            [
                'module_id' => App\Module::inRandomOrder()->first()->id,
                'user_id' => App\User::inRandomOrder()->first()->id
                
            ]
        )
    ];
});
