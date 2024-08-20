<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assume each user creates 3 posts
        User::all()->each(function (User $user) {
            $posts = Post::factory(3)->create(['user_id' => $user->id]);

            // Attach categories to each post
            $posts->each(function (Post $post) {
                $categories = Category::inRandomOrder()->take(2)->pluck('id');
                $post->categories()->attach($categories);
            });
        });
    }
}
