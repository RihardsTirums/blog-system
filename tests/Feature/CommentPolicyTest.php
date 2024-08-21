<?php

namespace Tests\Feature\Auth;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentPolicyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can add a comment to a post.
     *
     * @return void
     */
    public function test_authenticated_user_can_add_comment_to_a_post(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        Post::factory()->create();

        $comment = Comment::factory()->make(['user_id' => $user->id]);

        $this->assertTrue($user->can('create', $comment));
    }

    /**
     * Test that a user can view a comment.
     *
     * @return void
     */
    public function test_user_can_view_comment(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create(['post_id' => $post->id]);

        $this->assertTrue($user->can('view', $comment));
    }

    /**
     * Test that the comment author can delete their own comment.
     *
     * @return void
     */
    public function test_comment_author_can_delete_their_own_comment(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id, 'post_id' => $post->id]);

        $this->assertTrue($user->can('delete', $comment));
    }

    /**
     * Test that other users cannot delete someone else's comment.
     *
     * @return void
     */
    public function test_other_users_cannot_delete_someone_elses_comment(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $commentOwner = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $commentOwner->id, 'post_id' => $post->id]);

        $this->assertFalse($user->can('delete', $comment));
    }
}