<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comment>
 */
class commentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Comment::class;


    public function definition(): array
    {
        return [

            'conent' => fake()->paragraph(),
            'user_id' => User::factory(), 
            'post_id' => Post::factory(),           
          
        ];
    }
}
