<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\post>
 */
class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model=Post::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'conent' => fake()->paragraph(),
            'user_id' => User::factory(),
        ];
    }
}
