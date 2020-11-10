<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition()
    {
        return [
            'code' => $this->faker->numerify('CSM###'),
            'description' => $this->faker->paragraph(),
        ];
    }
}
