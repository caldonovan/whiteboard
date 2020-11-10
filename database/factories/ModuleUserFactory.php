<?php

namespace Database\Factories;

use App\Models\ModuleUser;
use App\Models\User;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleUser extends Factory
{
    protected $model = ModuleUser::class;

    public function definition()
    {
        return [
            'module_id' => Module::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}

