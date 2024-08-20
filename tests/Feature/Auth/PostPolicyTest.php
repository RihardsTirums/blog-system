<?php

namespace Tests\Feature\Auth;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_author_can_update_their_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->can('update', $post));
    }

    public function test_other_users_cannot_update_someone_elses_post()
    {
        $user = User::factory()->create();
        $postOwner = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $postOwner->id]);

        $this->assertFalse($user->can('update', $post));
    }

    public function test_post_author_can_delete_their_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->can('delete', $post));
    }

    public function test_other_users_cannot_delete_someone_elses_post()
    {
        $user = User::factory()->create();
        $postOwner = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $postOwner->id]);

        $this->assertFalse($user->can('delete', $post));
    }
}

