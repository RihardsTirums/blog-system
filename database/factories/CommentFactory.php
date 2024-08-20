<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'body_content' => $this->faker->sentence,
            'post_id' => \App\Models\Post::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
