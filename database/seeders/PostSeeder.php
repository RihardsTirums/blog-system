<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count(50)->create()->each(function ($post) {
            $categories = Category::inRandomOrder()->take(rand(1, 4))->pluck('id');
            $post->categories()->attach($categories);
        });
    }
}