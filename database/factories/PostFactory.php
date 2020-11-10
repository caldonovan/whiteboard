<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(4, true),
            'body' => $this->faker->text(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
