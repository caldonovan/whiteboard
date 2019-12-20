<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ModuleUser;
use App\Module;
use App\User;
use Faker\Generator as Faker;

$factory->define(ModuleUser::class, function (Faker $faker) {
    return [
        DB::table('module_user')->insert(
            [
                'module_id' => Module::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id
                
            ]
        )
    ];
});
