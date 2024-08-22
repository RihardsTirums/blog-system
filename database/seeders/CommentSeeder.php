<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::all()->each(function (Post $post) {
            $commentCount = rand(0, 50);

            Comment::factory($commentCount)->create([
                'post_id' => $post->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        });
    }
}