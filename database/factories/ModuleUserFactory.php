<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        DB::table('module_user')->insert(
            [
                'module_id' => Module::select('id')->orderByRaw("RAND()")->first()->id,
                'user_id' => User::select('id')->orderByRaw("RAND()")->first()->id
                
            ]
        )
    ];
});
