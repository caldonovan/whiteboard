<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail,
            'email_verified_at' => now(),
            'password' => $this->faker->password(),
            'api_token' => Str::random(80),
            'isLecturer' => $this->faker->boolean(),
            'remember_token' => Str::random(10),
        ];
    }
}
