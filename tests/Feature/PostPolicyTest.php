<?php

namespace Tests\Feature\Auth;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostPolicyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the post author can update their own post.
     *
     * @return void
     */
    public function test_post_author_can_update_their_own_post(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->can('update', $post));
    }

    /**
     * Test that other users cannot update someone else's post.
     *
     * @return void
     */
    public function test_other_users_cannot_update_someone_elses_post(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $postOwner = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $postOwner->id]);

        $this->assertFalse($user->can('update', $post));
    }

    /**
     * Test that the post author can delete their own post.
     *
     * @return void
     */
    public function test_post_author_can_delete_their_own_post(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->can('delete', $post));
    }

    /**
     * Test that other users cannot delete someone else's post.
     *
     * @return void
     */
    public function test_other_users_cannot_delete_someone_elses_post(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $postOwner = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $postOwner->id]);

        $this->assertFalse($user->can('delete', $post));
    }
}